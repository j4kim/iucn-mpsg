<?php

namespace App;

use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Intervention;

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

    public function baseUrl(){
        return "uploads/species/" . $this->species->id . "/images/";
    }

    public function originalUrl(){
        return $this->baseUrl() . $this->url;
    }

    public function mediumUrl(){
        return $this->baseUrl() . "m_" . $this->url;
    }

    public function smallUrl(){
        return $this->baseUrl() . "s_" . $this->url;
    }

    public function assetUrl($size="o"){
        switch ($size){
            case "m": return asset($this->mediumUrl());
            case "s": return asset($this->smallUrl());
            default: return asset($this->originalUrl());
        }
    }

    public function createFilename($species_name, $folder, $ext){
        $date = str_slug($this->created_at);
        $name = str_slug($species_name);
        $opt = $folder == "maps" ? "_map" : "";
        return $this->id . '_' . $date . '_' . $name . $opt . '.' . $ext;
    }

    public function writeDimensions(){
        $url = public_path($this->originalUrl());
	        echo($url . "\n");
        $resource = Intervention::make($url);
        $this->width = $resource->width();
        $this->height = $resource->height();
        $this->save();
    }

    public function pasteCopyright(){
        $url = public_path($this->originalUrl());
        $image = Intervention::make($url);
        $image->insert(public_path('images/copyright.png'), 'bottom-left');
        $image->save();
    }
}
