<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function cities() {
        return $this->hasMany(City::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'country' => $this->country
        ];
    }
}
