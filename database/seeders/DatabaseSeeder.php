<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeSeeder::class,
            ProjectSeeder::class,
            UserSeeder::class,
            TechnologySeeder::class,
            ProjectTechnologySeeder::class,
        ]);
    }
}
