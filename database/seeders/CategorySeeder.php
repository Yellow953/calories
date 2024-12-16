<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Supplies',
                'description' => 'Essential goods and tools for everyday use.',
                'image' => 'assets/images/Supplies.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Freezed Dried Fruits',
                'description' => 'Crispy and flavorful fruits preserved through freeze-drying.',
                'image' => 'assets/images/Freezed Dried Fruits.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dried Fruits',
                'description' => 'Naturally preserved fruits with intense sweetness and flavor.',
                'image' => 'assets/images/Dried Fruits.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Freezed Dried Icecream',
                'description' => 'Light and crunchy freeze-dried ice cream treats.',
                'image' => 'assets/images/Freezed Dried Icecream.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Protein Snacks',
                'description' => 'High-protein snacks to fuel your active lifestyle.',
                'image' => 'assets/images/Protein Snacks.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sugar Free/Healthy Snacks',
                'description' => 'Delicious snacks made without added sugar for a healthier choice.',
                'image' => 'assets/images/Sugar Free Healthy Snacks.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Honey',
                'description' => 'Pure and natural honey for a sweet, healthy touch.',
                'image' => 'assets/images/Honey.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kids',
                'description' => 'Nutritious and tasty snacks designed for kids.',
                'image' => 'assets/images/Kids.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Organic',
                'description' => 'Certified organic products made from natural ingredients.',
                'image' => 'assets/images/Organic.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Weight Loss Supplements',
                'description' => 'Supplements to support your weight loss journey.',
                'image' => 'assets/images/Weight Loss Supplements.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
