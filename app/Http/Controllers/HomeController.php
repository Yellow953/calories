<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

        return view('frontend.thankyou');
    }
}
