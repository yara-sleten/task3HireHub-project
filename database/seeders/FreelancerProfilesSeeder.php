<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreelancerProfilesSeeder extends Seeder
{
    public function run()
    {
        DB::table('freelancer_profiles')->insert([

            [
                'user_id' => 2,
                'bio' => 'Full Stack Developer متخصص في Laravel و Vue.js',
                'hourly_rate' => 25.00,
                'phone' => '0790000000',
                'avatar' => 'avatars/user2.png',
                'availability' => 'available',
                'is_verified' => false,
                'portfolio_url' => 'https://portfolio1.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'user_id' => 4,
                'bio' => 'Vue.js',
                'hourly_rate' => 35.00,
                'phone' => '0880000000',
                'avatar' => 'avatars/user2.png',
                'availability' => 'available',
                'is_verified' => true,
                'portfolio_url' => 'https://portfolio1.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],

          

        ]);
    }
}