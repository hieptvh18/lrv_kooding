<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    // login
    public function showLoginForm (Request $rq){
        return view('auth.login');
    }

    public function login(Request $rq){

        $rq->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // // get info
        if(Auth::atempt(['email'=>$rq->email,'password'=>$rq->password,'role_id'=>1])){
            // client

            dd('client');
        }else if(Auth::atempt(['email'=>$rq->email,'password'=>$rq->password,'role_id'=>2])){
            // admin
            dd('admin');


        }else{
            dd('invalid');
        }

    }

    

}
