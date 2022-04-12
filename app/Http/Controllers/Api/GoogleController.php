<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // xử lí sau khi login google (check và lưu thông tin cho lần tới)
    public function googleCallback(Request $rq)
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
            } else {

                // check user exist thi update >< insert
                $userExist = User::where('email',$user->email)->first();

                if($userExist){
                    // update
                    $userExist->google_id = $user->id;
                    $userExist->avatar = $user->avatar;

                    $newUser = $userExist->save();
                    Auth::login($userExist);

                }else{
                    $newUser = User::create([
                        "name"=>$user->name,
                        "email"=>$user->email,
                        "google_id"=>$user->id,
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
