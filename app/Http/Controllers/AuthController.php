<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthServices;

class AuthController extends Controller
{
    public function register(Request $request){
        $response=AuthServices::register($request);
        return jsonResult($response);
    }

    public function login(Request $request){
        $response=AuthServices::login($request);
        return jsonResult($response);
    }

    public function logout(Request $request){
        $response=AuthServices::logout($request);
        return jsonResult($response);
    }
}
