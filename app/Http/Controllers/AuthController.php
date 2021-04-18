<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

        if (! Auth::attempt($request->only(['email', 'password']))) {
            return response(['message' => 'Invalid email or password'], Response::HTTP_BAD_REQUEST);
        }


        return response([
            'user' => Auth::user(),
//            'api_token' => $token
        ], Response::HTTP_OK);
    }

}
