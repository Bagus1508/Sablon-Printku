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
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@takon.com',
            'password' => Hash::make('password'),
            'id_level_user' => 1,
        ]);
        $midAdmin = User::create([
            'name' => 'Mid Admin',
            'email' => 'midadmin@takon.com',
            'password' => Hash::make('password'),
            'id_level_user' => 2,
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@takon.com',
            'password' => Hash::make('password'),
            'id_level_user' => 3,
        ]);
    }
}
