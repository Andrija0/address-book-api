<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    public function countries() {
        $countries = Country::all();

        return response($countries, Response::HTTP_OK);
    }

    public function cities(Country $country) {
        $cities = $country->cities;

        return response($cities, Response::HTTP_OK);
    }
}
