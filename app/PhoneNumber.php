<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    public $fillable = [
        'phone_number'
    ];

    public function toArray()
    {
        return $this->phone_number;
    }
}
