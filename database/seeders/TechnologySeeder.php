<?php

namespace Database\Seeders;

use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels = ["HTML 5", "CSS", "Javascript", "PHP", "GIT", "Blade"];

        foreach ($labels as $label) {
            $technology = new Technology();
            $technology->label = $label;
            $technology->color = $faker->hexColor;
            $technology->save();
        }
    }
}
