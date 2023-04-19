<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //$projects = Project::all()->pluck('id');
        $technologies = Technology::all()->pluck('id'); // [1, 2, ...7]

        for ($i = 1; $i < 40; $i++) {
            $project = Project::find($i);
            $project->technologies()->attach($faker->randomElement($technologies, 3));

            //$project->save();
        }
    }
}
