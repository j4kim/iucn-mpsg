<?php

use App\Island;
use Illuminate\Database\Seeder;

class IslandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $islands = json_decode(file_get_contents(database_path("seeds/islands.json")));

        foreach($islands as $name => $country){
            Island::create(compact(['name','country']));
        }
    }
}
