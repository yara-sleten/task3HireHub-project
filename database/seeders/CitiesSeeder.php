<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('cities')->insert([
            ['name' => 'Amman', 'country_id' => 1],
            ['name' => 'Riyadh', 'country_id' => 2],
            ['name' => 'Dubai', 'country_id' => 3],
        ]);
    }
}
