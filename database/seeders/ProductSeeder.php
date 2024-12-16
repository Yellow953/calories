<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'category_id' => random_int(1, Category::count()),
                'name' => $faker->words(3, true),
                'stock' => $faker->randomFloat(2, 10, 500),
                'cost' => $faker->randomFloat(2, 1, 50),
                'price' => $faker->randomFloat(2, 10, 100),
                'compare_price' => $faker->optional()->randomFloat(2, 50, 150),
                'description' => $faker->sentence(10),
                'image' => 'assets/images/no_img.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
