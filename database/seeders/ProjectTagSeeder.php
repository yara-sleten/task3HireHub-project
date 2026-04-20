<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProjectTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('project_tag')->insert([
            ['project_id' => 1, 'tag_id' => 1],
            ['project_id' => 1, 'tag_id' => 2],
        ]);
    }
}
