<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Log;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders.read')->only(['index', 'show']);
        $this->middleware('permission:orders.update')->only('complete');
        $this->middleware('permission:orders.delete')->only('destroy');
        $this->middleware('permission:orders.export')->only('export');
    }

    public function index()
    {
        $orders = Order::select('id', 'order_number', 'payment_method', 'client_id', 'sub_total', 'total', 'products_count', 'status')->filter()->orderBy('id', 'desc')->paginate(10);
        $users = User::select('id', 'name')->get();

        $data = compact('orders', 'users');
        return view('app.orders.index', $data);
    }

    public function show(Order $order)
    {
        return view('app.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $text = ucwords(auth()->user()->name) .  " deleted Order " . $order->id . ", datetime: " . now();

        foreach ($order->items() as $item) {
            $item->delete();
        }

        $order->delete();
        Log::create(['text' => $text]);

        return redirect()->back()->with('success', "Order successfully deleted!");
    } //end of order

    public function complete(Order $order)
    {
        $order->update(['status' => 'completed']);

        $text = ucwords(auth()->user()->name) .  " completed Order " . $order->id . ", datetime: " . now();

        Log::create(['text' => $text]);

        return redirect()->back()->with('success', "Order successfully completed!");
    }

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
}
