<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $fillable = [
        'first_name',
        'last_name',
        'agency_id',
        'email',
        'web',
    ];
    public function phoneNumbers() {
        return $this->morphMany(PhoneNumber::class, 'phonable');
    }

    public function professions() {
        return $this->belongsToMany(Profession::class);
    }

    public function photo() {
        return $this->hasOne(Photo::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'web' => $this->web,
            'phone_numbers' => $this->phoneNumbers,
            'photo' => $this->photo,
            'professions' => $this->professions,
        ];
    }
}
