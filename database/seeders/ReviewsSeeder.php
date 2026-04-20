<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('reviews')->insert([
            [
                'project_id'=>1,
                'client_id' => 1,
                'freelancer_id' => 2,
                'freelancer_profile_id'=>1,
                'rating' => 5,
                'comment' => 'Excellent work!'
            ]
        ]);
    }
}
