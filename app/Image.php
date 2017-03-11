<?php

namespace App;

use ErrorException;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title','legend','url', 'species_id'];

    public function realDelete($folder="images"){
        try{unlink("uploads/$folder/$this->url");}catch (ErrorException $e){}
        try{unlink("uploads/$folder/small/$this->url");}catch (ErrorException $e){}
        try{unlink("uploads/$folder/medium/$this->url");}catch (ErrorException $e){}
        $this->delete();
    }
}
