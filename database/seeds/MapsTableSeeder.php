<?php

use App\Map;
use Illuminate\Database\Seeder;

class MapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                "title"=>"",
                "legend"=>"",
                "url"=>"Abies_map_1.png",
                "species_id"=>1
            ],[
                "title"=>"",
                "legend"=>"",
                "url"=>"Aethionema_map_1.jpg",
                "species_id"=>2
            ]
        ];
        foreach($images as $image){
            $img = Map::create($image);
            $img->writeDimensions();
        }
    }
}
