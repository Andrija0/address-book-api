<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $fillable = [
        'path',
        'user_id',
    ];

    public function contact() {
        return $this->hasOne(User::class);
    }
}
