<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Log;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders.read')->only('index');
        $this->middleware('permission:orders.create')->only(['new', 'create']);
        $this->middleware('permission:orders.update')->only(['edit', 'update']);
        $this->middleware('permission:orders.delete')->only('destroy');
        $this->middleware('permission:orders.export')->only('export');
    }

    public function index()
    {
        $orders = Order::select('id', 'order_number', 'cashier_id', 'currency_id', 'sub_total', 'tax', 'discount', 'total', 'products_count')->filter()->orderBy('id', 'desc')->paginate(25);
        $users = User::select('id', 'name')->where('business_id', auth()->user()->business_id)->get();

        $data = compact('orders', 'users');
        return view('app.orders.index', $data);
    }

    public function show(Order $order)
    {
        return view('app.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        if ($order->can_delete()) {
            $text = ucwords(auth()->user()->name) .  " deleted Order " . $order->id . ", datetime: " . now();

            foreach ($order->items() as $item) {
                $item->delete();
            }

            $order->delete();
            Log::create(['text' => $text]);

            return redirect()->back()->with('success', "Order successfully deleted!");
        } else {
            return redirect()->back()->with('danger', 'Unable to delete');
        }
    } //end of order

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
