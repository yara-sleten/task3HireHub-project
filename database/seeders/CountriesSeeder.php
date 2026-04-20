<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name' => 'Jordan'],
            ['name' => 'Saudi Arabia'],
            ['name' => 'UAE'],
        ]);
    }
}