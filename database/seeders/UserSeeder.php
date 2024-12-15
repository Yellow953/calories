<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'test@test.com',
                'phone' => '70239783',
                'address' => 'test address',
                'password' => bcrypt('qwe123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'phone' => '70239783',
                'address' => 'test address',
                'password' => bcrypt('qwe123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($users as $user) {
            $user = User::create($user);
        }
    }
}
