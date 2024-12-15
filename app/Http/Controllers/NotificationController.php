<?php

namespace App\Http\Controllers;

use App\Models\Product;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:notifications.read')->only('index');
    }

    public function index()
    {
        $notifications = $this->get_notifications();

        return view('app.notifications.index', compact('notifications'));
    }

    // Private
    private function get_notifications()
    {
        $products = Product::all();
        $notifications = [];

        $i = 0;
        foreach ($products as $product) {
            if ($product->quantity == 0) {
                $notifications[$i] = "Product " . $product->name . " quantity is 0. Please Import Urgently!";
                $i++;
            } else if ($product->quantity < 10) {
                $notifications[$i] = "Product " . $product->name . " quantity is below 10. Please Import Soon!";
                $i++;
            }
        }

        return $notifications;
    }
}
