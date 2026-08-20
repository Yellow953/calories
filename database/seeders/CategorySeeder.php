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
            [
                'name' => 'Cosmetics',
                'description' => 'Paraben-free, vegan and cruelty-free skincare, haircare and body care.',
                'image' => 'assets/images/Cosmetics.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Protein',
                'description' => 'High-protein drinks, cookies, pancakes, gummies and whey with no added sugar.',
                'image' => 'assets/images/Protein.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NABAT',
                'description' => 'Bio organic fruit, vegetable and superfood powders and natural sweeteners.',
                'image' => 'assets/images/NABAT.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sweeteners',
                'description' => 'Natural low-calorie sweeteners and organic syrups — allulose, xylitol, erythritol, stevia, agave and more.',
                'image' => 'assets/images/Sweeteners.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sea Salt',
                'description' => 'Premium grade natural salts — Himalayan pink and black, Mediterranean and Atlantic sea salt, and Celtic grey.',
                'image' => 'assets/images/Sea Salt.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mrs Taste',
                'description' => 'Zero-calorie, sugar-free and sodium-free syrups, sauces and dressings — ketchup, mayo, barbecue, ranch, chocolate, caramel and more.',
                'image' => 'assets/images/Mrs Taste.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Organic Flour',
                'description' => 'Stone-ground organic flours and starches — barley, rice, chickpea, oat, quinoa, almond, spelt, corn, tapioca, whole wheat and more.',
                'image' => 'assets/images/Organic Flour.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Organic Rice',
                'description' => 'Whole grain organic rice — short grain brown, super basmati brown, mixed rice, and low-calorie konjac rice.',
                'image' => 'assets/images/Organic Rice.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
