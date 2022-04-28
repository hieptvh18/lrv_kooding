<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class LoginController1 extends Controller
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

        // check login
        if(Auth::attempt(['email' => $rq->email, 'password' => $rq->password])){

           $user = User::where('email',$rq->email)->first();
           Auth::login($user);
          
           if(Auth::user()->role_id == 1){
               return redirect(route('client.home'));
            }
            return redirect(route('admin.dashboard'));
        }
        return back()->with('err-login','Email hoặc mật khẩu không chính xác!');

        
    }

    public function logout(){
        Auth::logout();
        return redirect(route('client.home'))->with('msg-suc','Đăng xuất thành công!');
    }

    

}
