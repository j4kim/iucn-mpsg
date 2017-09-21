<?php

namespace App;

use ErrorException;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title','legend','url', 'species_id'];

    public function realDelete($folder="images"){
        try{unlink($this->originalUrl());}catch (ErrorException $e){}
        try{unlink($this->mediumUrl());}catch (ErrorException $e){}
        try{unlink($this->smallUrl());}catch (ErrorException $e){}
        $this->delete();
    }

    public function species()
    {
        return $this->belongsTo('App\Species');
    }

    protected function baseUrl(){
        return "uploads/species/" . $this->species->id . "/images/";
    }

    protected function originalUrl(){
        return $this->baseUrl() . $this->url;
    }

    protected function mediumUrl(){
        return $this->baseUrl() . "m_" . $this->url;
    }

    protected function smallUrl(){
        return $this->baseUrl() . "s_" . $this->url;
    }

    public function assetUrl($size="o"){
        switch ($size){
            case "m": return asset($this->mediumUrl());
            case "s": return asset($this->smallUrl());
            default: return asset($this->originalUrl());
        }
    }
}
