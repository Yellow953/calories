<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all()->map(function ($product) {
            return [
                'category' => $product->category->name,
                'name' => $product->name,
                'stock' => $product->stock,
                'cost' => $product->cost,
                'price' => $product->price,
                'description' => $product->description,
                'created_at' => $product->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Category',
            'Name',
            'Stock',
            'Cost',
            'Price',
            'Description',
            'Created At',
        ];
    }
}
