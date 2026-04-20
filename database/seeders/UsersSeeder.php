<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
     DB::table('users')->insert([
            [
                'name' => 'Client User',
                'email' => 'client@test.com',
                'password' => Hash::make('123456'),
                'phone'=>'0997867898',
                'role' => 'client',
                'city_id' => 1
            ],
            [
                'name' => 'Freelancer User',
                'email' => 'freelancer@test.com',
                'password' => Hash::make('123456'),
                'phone' =>'0987654321',
                'role' => 'freelancer',
                'city_id' => 2
            ],
            [
                'name' => 'yara Client ',
                'email' => 'yara2Client@test.com',
                'password' => Hash::make('123456'),
                'phone' =>'0987654321',
                'role' => 'client',
                'city_id' => 1
            ],
            [
                'name' => 'yara Freelancer ',
                'email' => 'yara2freelancer@test.com',
                'password' => Hash::make('123456'),
                'phone' =>'0987654321',
                'role' => 'freelancer',
                'city_id' => 2
            ]

        ]);
    }
}
