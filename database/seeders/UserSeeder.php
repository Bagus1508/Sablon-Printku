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
        $accounts = [
            [
                'name' => 'Admin',
                'email' => 'admin',
            ],
            [
                'name' => 'PIRDAUS',
                'email' => 'pirdaus',
            ],
            [
                'name' => 'NANDA',
                'email' => 'nanda',
            ],
            [
                'name' => 'WOWO',
                'email' => 'wowo',
            ],
            [
                'name' => 'ABDUL',
                'email' => 'abdul',
            ],
            [
                'name' => 'VIKRI',
                'email' => 'vikri',
            ],
        ];

        foreach ($accounts as $key => $account) {
            User::create([
                'name' => $account['name'],
                'email' => $account['email'],
                'password' => Hash::make('123456'),
                'id_level_user' => 1,
            ]);
        }
    }
}
