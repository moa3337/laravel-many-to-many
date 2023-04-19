<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // * Per trasformare id in un Array
        $types = Type::all()->pluck('id');
        $types[] = null;

        for ($i = 0; $i < 40; $i++) {
            $project = new Project;
            $project->type_id = $faker->randomElement($types);
            $project->title = $faker->catchPhrase();
            $project->slug = Str::of($project->title)->slug('-');
            //$project->image = $faker->imageUrl(640, 480, 'animals', true);
            $project->text = $faker->paragraph(40);
            $project->save();
        }
    }
}
