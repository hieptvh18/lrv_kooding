<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    // màn hình login admin
    public function login(){

        return view('auth.login-admin');
    }

    // handle post login
    public function postLogin(Request $rq){

        dd($rq->all());
    }
}
