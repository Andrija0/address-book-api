<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    const CITIES = [
        'Serbia' => [
            'Belgrade',
            'Novi Sad',
            'Niš',
            'Subotica',
            'Kragujevac',
            'Jagodina'
        ],
        'Montenegro' => [
            'Podgorica',
            'Kotor',
            'Budva',
            'Ulcinj',
        ],
        'Russia' => [
            'Moscow',
            'Saint Petersburg',
            'Krasnodar',
            'Sevastopol',
            'Yekaterinburg',
            'Volgograd',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::CITIES as $countryName => $cities) {
            $country = factory(\App\Country::class)->create(['country' => $countryName]);
            foreach ($cities as $cityName) {
                factory(\App\City::class)->create(['city' => $cityName, 'country_id' => $country->id ]);
            }
        }
    }
}
