<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDimToImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        function add_dim($imgs, $folder){
            if (Schema::hasColumn($folder, 'width')) {
            }else{
                Schema::table($folder, function (Blueprint $table) {
                    $table->integer('width')->default(-1);
                    $table->integer('height')->default(-1);
                });
            }

            foreach ($imgs as $img) {
                $img->writeDimensions();
            }

        }

        add_dim(\App\Image::all(), "images");
        add_dim(\App\Map::all(), "maps");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        function drop_dim($folder){
            if (Schema::hasColumn($folder, 'width')) {
                Schema::table($folder, function (Blueprint $table) {
                    echo "suppression des colonnes width et height de la table\n";
                    $table->dropColumn('width');
                    $table->dropColumn('height');
                });
            }else{
                echo "la table $folder n'a pas les colonnes width et height\n";
            }
        }
        drop_dim("images");
        drop_dim("maps");
    }
}
