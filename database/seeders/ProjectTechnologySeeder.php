<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   

        $projects = Project::all();

        // Ottieni tutti gli id delle tecnologie dal database
        $technologies = Technology::all()->pluck('id');

        foreach ($projects as $project) {

            // Seleziona casualmente 3 id di tecnologie dall'elenco degli id
            $random_technologies = $faker->randomElements($technologies, 3);

            // Associa le tecnologie casuali al progetto corrente
            $project->technologies()->sync($random_technologies);
        }
    }
}
