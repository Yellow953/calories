<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
