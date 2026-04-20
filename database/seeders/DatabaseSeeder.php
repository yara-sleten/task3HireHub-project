<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
        CountriesSeeder::class,
        CitiesSeeder::class,
        UsersSeeder::class,
        SkillsSeeder::class,
        FreelancerProfilesSeeder::class,
        FreelancerSkillSeeder::class,
        ProjectsSeeder::class,
        TagsSeeder::class,
        ProjectTagSeeder::class,
        ReviewsSeeder::class,
       
    ]);
    }
}
