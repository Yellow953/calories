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
                'name' => 'USD',
                'code' => '$',
                'rate' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LBP',
                'code' => 'ل.ل.',
                'rate' => 89500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AED',
                'code' => 'د.إ',
                'rate' => 3.66,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SAR',
                'code' => 'ر. س',
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
