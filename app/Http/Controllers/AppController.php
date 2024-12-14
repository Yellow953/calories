<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $users_count = User::count();
        $orders_count = Order::count();

        $data = compact('categories_count', 'products_count', 'users_count', 'orders_count');
        return view('app.index', $data);
    }
}
