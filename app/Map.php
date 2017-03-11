<?php

namespace App;

use ErrorException;

class Map extends Image
{

    public function realDelete($folder="maps"){
        try{unlink("uploads/$folder/$this->url");}catch (ErrorException $e){}
        try{unlink("uploads/$folder/small/$this->url");}catch (ErrorException $e){}
        try{unlink("uploads/$folder/medium/$this->url");}catch (ErrorException $e){}
        $this->delete();
    }
}
