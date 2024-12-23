<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name', 'image')->get();
        $products = Product::select('id', 'name', 'image')->limit(10)->get();

        $data = compact('categories', 'products');
        return view('index', $data);
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function shop(Request $request)
    {
        $categories = Category::select('id', 'name', 'image')->get();

        if ($request->input('category')) {
            $category = Category::where('name', $request->input('category'))->firstOrFail();
            $products = Product::select('id', 'name', 'category_id', 'image')->where('category_id', $category->id)->paginate(12);
        } else {
            $products = Product::select('id', 'name', 'category_id', 'image')->paginate(12);
        }

        $data = compact('categories', 'products');
        return view('frontend.shop', $data);
    }

    public function product(Product $product)
    {
        $products = Product::select('id', 'name', 'image')->where('category_id', $product->category_id)->limit(8)->get();

        $data = compact('product', 'products');
        return view('frontend.product', $data);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->take(10)
            ->get(['id', 'name', 'image']);

        $products = $products->map(function ($product) {
            $product->url = route('product', $product->name);
            return $product;
        });

        return response()->json($products);
    }

    public function preferences(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|string|in:en,ar',
            'currency' => 'required|string|in:usd,lbp',
        ]);

        $language = $validated['language'];
        $currency = $validated['currency'];

        App::setLocale($language);

        $cookieLang = cookie('language', $language, 60 * 24 * 30);
        $cookieCurrency = cookie('currency', $currency, 60 * 24 * 30);

        return redirect()->back()->withCookies([$cookieLang, $cookieCurrency]);
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function order(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cart = $request->input('cart', []);

        if (!$cart || empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $subTotal = 0;
        $productsCount = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
            $productsCount += $item['quantity'];
        }
        $shippingFee = 10;
        $total = $subTotal + $shippingFee;

        DB::beginTransaction();

        try {
            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'password' => bcrypt('password'),
                ]
            );

            $order = Order::create([
                'client_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'payment_method' => $request->payment_method,
                'sub_total' => $subTotal,
                'total' => $total,
                'products_count' => $productsCount,
                'notes' => $request->notes,
                'status' => 'new',
            ]);

            // Create order items
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            $this->sendOrderEmails($order, $user);

            setcookie('cart', '', time() - 3600, '/');

            return redirect()->back()->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:12',
            'message' => 'required|string',
        ]);

        $data = $request->all();

        Mail::send('emails.contact', ['data' => $data,], function ($message) {
            $message->to('fatimakhansa97@gmail.com')
                ->subject('New Contact');
        });

        return redirect()->back()->with('success', 'Contact Form Submitted Successfully');
    }

    private function sendOrderEmails(Order $order, User $user)
    {
        Mail::send('emails.order-confirmation', ['order' => $order, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Order Confirmation');
        });

        Mail::send('emails.order-notification', ['order' => $order], function ($message) {
            $message->to('Fatimakhansa97@gmail.com')
                ->subject('New Order Notification');
        });
    }
}
