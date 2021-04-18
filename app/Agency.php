<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    public $fillable = [
        'name',
        'address',
        'city_id',
        'email',
        'web'
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function phoneNumbers() {
        return $this->morphMany(PhoneNumber::class, 'phonable');
    }

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'phone_numbers' => $this->phoneNumbers,
            'email' => $this->email,
            'web' => $this->web,
        ];
    }
}
