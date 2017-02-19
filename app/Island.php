<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    protected $fillable = ['name','country'];

    public function species()
    {
        return $this->belongsToMany('App\Species');
    }
}
