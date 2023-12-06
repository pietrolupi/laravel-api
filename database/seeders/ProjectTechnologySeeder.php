<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 30; $i++){

            $project = Project::inRandomOrder()->first();
            $technology_id = Technology::inRandomOrder()->first()->id;
            $project->technologies()->attach($technology_id);
        }
    }
}
