<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'dev@dev.com.br')->first()) {
            $root = User::create([
                'name' => 'Root',
                'email' => 'dev@dev.com.br',
                'password' => Hash::make('root', ['rounds' => 12]),
            ]);

            $root->assignRole('root');
        }

        if (!User::where('email', 'admin@admin.com.br')->first()) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com.br',
                'password' => Hash::make('admin', ['rounds' => 12]),
            ]);

            $admin->assignRole('admin');
        }
    }
}
