<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            [
                'name' => 'US Dollar',
                'code' => '$',
                'rate' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lebanese Lira',
                'code' => 'LBP',
                'rate' => 89500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UAE Dirham',
                'code' => 'AED',
                'rate' => 3.66,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Saudi Riyal',
                'code' => 'SAR',
                'rate' => 3.76,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
