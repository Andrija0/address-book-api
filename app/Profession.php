<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public $fillable = [
        'profession'
    ];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'profession' => $this->profession
        ];
    }
}
