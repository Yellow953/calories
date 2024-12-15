<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            'users.create',
            'users.read',
            'users.update',
            'users.delete',
            'users.export',

            // Categories
            'categories.create',
            'categories.read',
            'categories.update',
            'categories.delete',
            'categories.export',

            // Products
            'products.create',
            'products.read',
            'products.update',
            'products.delete',
            'products.export',

            // Orders
            'orders.create',
            'orders.read',
            'orders.update',
            'orders.delete',
            'orders.export',

            // Logs
            'logs.read',
            'logs.export',

            // Notifications
            'notifications.read',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        $adminRole->givePermissionTo(Permission::all());

        $staffPermissions = [
            'products.read',
            'categories.read',
        ];
        $staffRole->syncPermissions($staffPermissions);

        User::find(1)->assignRole($adminRole);
        User::find(2)->assignRole($staffRole);
    }
}
