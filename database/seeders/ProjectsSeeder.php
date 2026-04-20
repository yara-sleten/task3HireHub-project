<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([

            [
                'client_id' => 1,
                'title' => 'Build E-commerce Website',
                'description' => 'Need a full e-commerce website using Laravel',
                'budget_type' => 'fixed',
                'budget_amount' => 1500.00,
                'status' => 'open',
                'deadline' => Carbon::now()->addDays(30),
                'attachments' => json_encode([
                    'specs.pdf',
                    'design.png'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'client_id' => 1,
                'title' => 'API Development',
                'description' => 'Develop REST API for mobile app',
                'budget_type' => 'hourly',
                'budget_amount' => 25.00,
                'status' => 'in_progress',
                'deadline' => Carbon::now()->addDays(15),
                'attachments' => json_encode([
                    'api-docs.pdf'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'client_id' => 1,
                'title' => 'Landing Page Design',
                'description' => 'Modern landing page using React',
                'budget_type' => 'fixed',
                'budget_amount' => 300.00,
                'status' => 'closed',
                'deadline' => null,
                'attachments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
