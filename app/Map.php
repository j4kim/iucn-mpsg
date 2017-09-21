<?php

namespace App;

use ErrorException;

class Map extends Image
{

    public function realDelete($folder="maps"){
        try{unlink($this->originalUrl());}catch (ErrorException $e){}
        try{unlink($this->mediumUrl());}catch (ErrorException $e){}
        try{unlink($this->smallUrl());}catch (ErrorException $e){}
        $this->delete();
    }

    protected function baseUrl(){
        return "uploads/species/" . $this->species->id . "/maps/";
    }
}
