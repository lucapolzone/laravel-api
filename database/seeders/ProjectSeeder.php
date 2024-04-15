<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
// use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	// public function run(Faker $faker)
	public function run()
	{
		// for ($i = 0; $i < 10; $i++) {
		$project = new Project;
		$project->title = 'Vite Boolando';
		// $project->type->label = 'Frontend';
		$project->content = 'Create un nuovo progetto utilizzando Vite e Vue 3 e definite i componenti necessari per strutturare il layout.';
		$project->link = 'https://github.com/lucapolzone/vite-boolando';
		$project->save();

		$project = new Project;
		$project->title = 'Vue Email List';
		// $project->type->label = 'Frontend';
		$project->content = "Attraverso l'apposita API di Boolean generare 10 indirizzi email e stamparli in pagina all'interno di una lista.";
		$project->link = 'https://github.com/lucapolzone/vue-email-list';
		$project->save();

		// }
	}
}
