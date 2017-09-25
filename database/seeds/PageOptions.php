<?php

use Illuminate\Database\Seeder;

class PageOptions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutPage = \App\Page::where('title', 'About')->first();
        $aboutPage->options = [
            "asidePage" => 'Welcome',
            "images" => [
                "selection" => "random",
                "number" => 4
            ]
        ];
        $aboutPage->save();
    }
}
