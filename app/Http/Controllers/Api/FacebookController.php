<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\User;

class FacebookController extends Controller
{
    //define driver
    const DRIVER_TYPE = 'facebook';
    
    public function redirectToFacebookLogin()
    {
        return Socialite::driver(static::DRIVER_TYPE)->stateless()->redirect();
    }

    // xử lí sau khi login facebook (check và lưu thông tin cho lần tới)
    public function facebookCallback(Request $rq)
    {
        try {

            $user = Socialite::driver(static::DRIVER_TYPE)->stateless()->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
            } else {

                // check user exist thi update >< insert
                $userExist = User::where('email',$user->email)->first();

                if($userExist){
                    // update
                    $userExist->facebook_id = $user->id;
                    $userExist->avatar = $user->avatar;

                    $newUser = $userExist->save();
                    Auth::login($userExist);

                }else{
                    $newUser = User::create([
                        "name"=>$user->name,
                        "email"=>$user->email,
                        "facebook_id"=>$user->id,
                        "role_id"=>1,
                        "avatar"=>$user->avatar,
                        "password"=>bcrypt('blablabla'),
                        // "email_verified_at"=>"dd lai $user",
                    ]);

                    $newUser->save();
                    Auth::login($newUser);
                }

            }
            // check role
            if ($this->middleware(['auth.admin'])) {

                return redirect()->intended(route('admin.dashboard'));
            }
            return redirect()->intended(route('client.home'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
