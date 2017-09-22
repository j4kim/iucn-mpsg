<?php

use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
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
                "title"=>"Abies Nebrodensis",
                "legend"=>"2012 - Le Locle",
                "url"=>"Abies_1.jpg",
                "species_id"=>1
            ],[
                "title"=>"",
                "legend"=>"",
                "url"=>"Abies_2.jpg",
                "species_id"=>1
            ],[
                "title"=>"",
                "legend"=>"",
                "url"=>"Aethionema_1.jpg",
                "species_id"=>2
            ],[
                "title"=>"",
                "legend"=>"",
                "url"=>"Aethionema_2.jpg",
                "species_id"=>2
            ],[
                "title"=>"",
                "legend"=>"",
                "url"=>"Aethionema_3.jpg",
                "species_id"=>2
            ]
        ];

        foreach($images as $image){
            $img = Image::create($image);
            $img->writeDimensions();
        }
    }
}
