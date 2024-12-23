<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Filter
    public function scopeFilter($q)
    {
        if (request('order_number')) {
            $order_number = request('order_number');
            $q->where('order_number', $order_number);
        }
        if (request('payment_method')) {
            $payment_method = request('payment_method');
            $q->where('payment_method', $payment_method);
        }
        if (request('client_id')) {
            $client_id = request('client_id');
            $q->where('client_id', $client_id);
        }
        if (request('notes')) {
            $notes = request('notes');
            $q->where('notes', 'LIKE', "%{$notes}%");
        }
        if (request('status')) {
            $status = request('status');
            $q->where('status', $status);
        }

        return $q;
    }
}
