<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'country' => $this->country
        ];
    }
}
