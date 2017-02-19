<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIslandSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('island_species', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('island_id')->unsigned();
            $table->foreign('island_id')->references('id')->on('islands');

            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')->references('id')->on('species');

            $table->unique(['species_id', 'island_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('island_species');
    }
}
