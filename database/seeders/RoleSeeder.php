<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Role::where('id', 1)->exists()) {
            Role::create([
                'name'=> 'Root',
                'order_roles' => 1,
            ]);
        }

        if (!Role::where('id', 2)->exists()) {
            $admin = Role::create([
                'name'=> 'Admin',
                'order_roles' => 2,
            ]);

            $admin->givePermissionTo([
                'home-index',
                'profile-edit',
                'role-index',
                'role-update',
                'user-index',
                'user-create',
                'user-show',
                'user-edit',
                'user-destroy',
            ]);
        } else {
            $admin = Role::where('name', 'admin')->first();
        }
    }
}
