<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function shop(Category $category, Product $product)
    {
        $categories = Category::all();
        $products = Product::paginate(12);
        return view('frontend.shop', compact('categories', 'products'));
    }
    public function setLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
