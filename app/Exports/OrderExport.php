<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return  Order::all()->map(function ($order) {
            return [
                'client' => $order->client->name,
                'status' => $order->status,
                'payment_method' => $order->payment_method,
                'order_number' => $order->order_number,
                'sub_total' => $order->sub_total,
                'total' => $order->total,
                'products_count' => $order->product_count,
                'notes' => $order->notes,
                'created_at' => $order->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Client',
            'Status',
            'Payment Method',
            'Order Number',
            'Sub Total',
            'Total',
            'Products Count',
            'Notes',
            'Created At',
        ];
    }
}
