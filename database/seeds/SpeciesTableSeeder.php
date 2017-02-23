<?php

use App\Island;
use App\Species;
use Illuminate\Database\Seeder;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $species = json_decode(file_get_contents(database_path("seeds/species_sample.json")));
        foreach($species as $name => $data){
            $s = Species::create(compact(['name','data']));
            foreach ($data->Islands as $islandName){
                $island = Island::where('name',$islandName)->first();
                $s->islands()->attach($island);
            }
        }
    }
}
