<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','content','options'];

    protected $casts = [
        'options' => 'array',
    ];
}
