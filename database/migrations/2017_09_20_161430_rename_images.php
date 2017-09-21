<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

class RenameImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "coucou je vais essayer de renommer les photos\n";

        function rename_move($imgs, $folder){
            $fs = new Filesystem();
            foreach ($imgs as $img) {
                $path_original = "uploads/$folder/$img->url";
                $path_medium = "uploads/$folder/medium/$img->url";
                $path_small = "uploads/$folder/small/$img->url";
                $ext = $fs->extension($path_original);
                $dir = "uploads/species/" . $img->species->id . "/$folder";
                $date = str_slug($img->created_at);
                $name = str_slug($img->species->name);
                $opt = $folder == "maps" ? "_map" : "";
                $filename = $img->id . '_' . $date . '_' . $name . $opt . '.' . $ext;
                Storage::move($path_original, "$dir/$filename");
                Storage::move($path_medium, "$dir/m_$filename");
                Storage::move($path_small, "$dir/s_$filename");
                $img->url = $filename;
                $img->save();
            }
        }

        rename_move(\App\Image::all(), "images");
        rename_move(\App\Map::all(), "maps");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo("je vais essayer de derénommer les images mais bon...\n");

        function derename_demove($imgs, $folder){
            echo("FOLDER:$folder\n");
            $fs = new Filesystem();

            foreach ($imgs as $img) {
                $dir = "uploads/species/" . $img->species->id . "/$folder";
                $filename = $img->url;

                $ext = $fs->extension("$dir/$filename");
                $new_url = uniqid() . '.' . $ext;

                $path_original = "uploads/$folder/$new_url";
                $path_medium = "uploads/$folder/medium/$new_url";
                $path_small = "uploads/$folder/small/$new_url";

                try{
                    Storage::move("$dir/$filename", $path_original);
                    Storage::move("$dir/m_$filename", $path_medium);
                    Storage::move("$dir/s_$filename", $path_small);

                    $img->url = $new_url;
                    $img->save();
                }catch (Exception $e){

                }
            }
        }

        derename_demove(\App\Image::all(), "images");
        derename_demove(\App\Map::all(), "maps");
    }
}
