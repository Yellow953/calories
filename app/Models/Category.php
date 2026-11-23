<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // A category that still has products cannot be deleted
    public function can_delete(): bool
    {
        return ! $this->products()->exists();
    }

    // Filter
    public function scopeFilter($q)
    {
        if (request('name')) {
            $name = request('name');
            $q->where('name', 'LIKE', "%{$name}%");
        }
        if (request('description')) {
            $description = request('description');
            $q->where('description', 'LIKE', "%{$description}%");
        }

        return $q;
    }
}
