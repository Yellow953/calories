<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Profit
    public function get_profit()
    {
        return $this->price - $this->cost;
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // A product that has been ordered must be kept for order history
    public function can_delete(): bool
    {
        return ! $this->order_items()->exists();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function secondary_images()
    {
        return $this->hasMany(SecondaryImage::class);
    }

    // Filter
    public function scopeFilter($q)
    {
        if (request('name')) {
            $name = request('name');
            $q->where('name', 'LIKE', "%{$name}%");
        }
        if (request('category_id')) {
            $category_id = request('category_id');
            $q->where('category_id', $category_id);
        }
        if (request('description')) {
            $description = request('description');
            $q->where('description', 'LIKE', "%{$description}%");
        }

        return $q;
    }
}
