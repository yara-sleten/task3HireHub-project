<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreelancerSkillSeeder extends Seeder
{
    public function run()
    {
        DB::table('freelancer_skill')->insert([

            [
                'freelancer_profile_id' => 1,
                'skill_id' => 1,
                'years_of_experience' => 3,
            ],

            [
                'freelancer_profile_id' => 1,
                'skill_id' => 2,
                'years_of_experience' => 2,
            ],

          


        ]);
    }
}
