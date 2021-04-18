<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::all();

        return response($professions, Response::HTTP_OK);
    }
}
