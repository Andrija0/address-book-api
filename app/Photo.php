<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $fillable = [
        'path',
        'user_id',
    ];
}
