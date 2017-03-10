<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
