<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photobook extends Model
{
    protected $fillable = [
        'filename','title','caption'
    ];
}
