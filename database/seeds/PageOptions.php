<?php

use Illuminate\Database\Seeder;
use \App\Page;

class PageOptions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutPage = Page::where('title', 'About')->first();
        $aboutPage->options = [
            "images" => [
                "selection" => "random",
                "number" => 4
            ]
        ];
        $aboutPage->save();

        $homePage = Page::where('title', 'Home')->first();
        $homePage->options = [
            "background" => [
                "http://iucn-mpsg.org/uploads/species/50/images/163_2017-07-18-202324_silene-hicesiae.jpg",
                "http://iucn-mpsg.org/uploads/species/26/images/67_2017-04-05-081053_diplotaxis-siettiana.JPG",
                "http://iucn-mpsg.org/uploads/species/28/images/96_2017-04-25-125021_euphorbia-margadiliana.JPG"
            ],
            "stylesheet" => "homepage.css"
        ];
        $homePage->save();

        $contactPage = Page::where('title', 'Contact')->first();
        $contactPage->options = [
            "header" => ["http://www.ps-ge.ch/wp-content/uploads/2017/06/Banner_Contact_ph.jpg"]
        ];
        $contactPage->save();
    }
}
