<?php

use Illuminate\Database\Seeder;
use App\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = json_decode(file_get_contents(database_path("seeds/pages.json")));

        foreach($pages as $title => $content){
            Page::create(compact(['title','content']));
        }
    }
}
