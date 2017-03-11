<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PagesTableSeeder::class);
        $this->call(IslandsTableSeeder::class);
        $this->call(SpeciesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(MapsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
