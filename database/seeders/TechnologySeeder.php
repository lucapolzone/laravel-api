<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technology_data = ['HTML', 'CSS', 'Bootstrap', 'JavaScript ES5', 'VueJS3', 'Axios', 'RESTful API', 'JSON', 'SQL', 'PHP', 'Laravel']; 
        
        foreach ($technology_data as $_technology) {
            $technology = new Technology;
            $technology->label = $_technology;
            $technology->color = $faker->hexColor(); //metodo di FakerPHP
            $technology->save();
        }

    }
}
