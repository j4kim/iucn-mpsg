<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Intervention;

class Species extends Model
{
    protected $fillable = ['name','data'];

    // https://www.laravel.com/docs/5.3/eloquent-mutators#array-and-json-casting
    protected $casts = [
        'data' => 'array',
    ];

    public function islands()
    {
        return $this->belongsToMany('App\Island');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function maps()
    {
        return $this->hasMany('App\Map');
    }

    public function addImage($folder, $data){
        $file = $data['file'];
        // $this->images()->create() ou $this->maps()->create()
        $newImage = $this->{$folder}()->create([]);

        $newImage->url = $newImage->createFilename($this->name, $folder, $file->getClientOriginalExtension());
        $newImage->title = $data['title'];
        $newImage->legend =  $data['legend'];

        $imageResource = Intervention::make($file);
        $newImage->width = $imageResource->width();
        $newImage->height = $imageResource->height();
        $newImage->save();

        $save_path = $newImage->baseUrl();
        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }

        $imageResource->save($newImage->originalUrl())
            ->widen(1170)->save($newImage->mediumUrl())
            ->widen(320)->save($newImage->smallUrl());

        if($folder == "images")
            $newImage->pasteCopyright();
    }
}
