<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
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
        $currency = Currency::where('name', Cookie::get('currency', 'usd'))->first();

        $data = compact('product', 'products', 'currency');
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
        $request->validate([
            'language' => 'required|string',
            'currency' => 'required|string',
        ]);

        $language = $request->input('language', 'en');
        $currency = $request->input('currency', 'USD');

        App::setLocale($language);

        Cookie::queue('language', $language, 60 * 24 * 30);
        Cookie::queue('currency', $currency, 60 * 24 * 30);

        return redirect()->back();
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function checkout()
    {
        $countries = [
            "Afghanistan",
            "Albania",
            "Algeria",
            "American Samoa",
            "Andorra",
            "Angola",
            "Anguilla",
            "Antarctica",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Aruba",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bermuda",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei Darussalam",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cabo Verde",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cayman Islands",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombia",
            "Comoros",
            "Congo",
            "Congo (DRC)",
            "Costa Rica",
            "Côte d'Ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czechia",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Eswatini",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guam",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hong Kong",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea (North)",
            "Korea (South)",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Montenegro",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Palestine",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Samoa",
            "San Marino",
            "São Tomé and Príncipe",
            "Saudi Arabia",
            "Senegal",
            "Serbia",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Sudan",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Timor-Leste",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe",
        ];

        return view('frontend.checkout', compact('countries'));
    }

    public function order(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30|unique:users,phone',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zip' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
            'shipping' => 'required|numeric|min:1',
        ]);

        $cart = json_decode($request->cart, true);
        if (!$cart || empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $subTotal = 0;
        $productsCount = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
            $productsCount += $item['quantity'];
        }
        $shippingFee = $request->shipping;
        $total = $subTotal + $shippingFee;

        DB::beginTransaction();

        try {
            $user = User::firstOrCreate(
                ['phone' => $request->phone],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'zip' => $request->zip,
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
        if ($user->email) {
            Mail::send('emails.order-confirmation', ['order' => $order, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Order Confirmation');
            });
        }

        Mail::send('emails.order-notification', ['order' => $order], function ($message) {
            $message->to('Fatimakhansa97@gmail.com')
                ->subject('New Order Notification');
        });
    }
}
