<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'password' => Hash::make('superadmin123'),
            'role' => 'superadmin',
        ]);
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'manager',
            'username' => 'manager',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
        ]);
    }
}
