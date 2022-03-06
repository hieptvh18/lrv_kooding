<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    // xử lí sau khi login google (check và lưu thông tin cho lần tới)
    public function googleCallback(){
        $user = Socialite::driver('google')->stateless()->user();
        // dd($user);
        // lưu : check xem email này đã đăng kí tài khoản hay chưa, chưa thì tạo mới còn rồi thì tạo đăng nhập:
        if(User::where('email',$user->email)){
                
            
        }else{

        }



        return redirect(route('client.home'))->with('msg','Đăng nhập thành công');
    }


}
