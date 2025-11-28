<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}