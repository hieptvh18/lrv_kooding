<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\Backend\UserRequest;

class ProfileController extends Controller
{
    //view profile client
    public function index()
    {
        // get orders
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(15);

        return view('client.pages.profile',compact('orders'));
    }

    // update profiel
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'=>'required|min:6|max:60',
            'phone'=>'required|numeric',
            'gender'=>'required'
        ]);

        $user = User::where('email',Auth::user()->email);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;

        try{
            $user->save();
            return redirect()->back()->with('msg-succ','Cập nhật tài khoản thành công!');
        }catch(\Throwable $e){
            report($e);
            return false;
        }
    }   

    // change pass
    public function changePassword(Request $request)
    {
        $request->validate([
            'password'=>'required',
            'password_new'=>'required|min:6|max:30',
            'password_confirm'=>'required'
        ],[
            'password.required'=>'Không được để trống trường này!',
            'password_new.required'=>'Không được để trống trường này!',
            'password_confirm.required'=>'Không được để trống trường này!',
            'password_new.min'=>'Mật khẩu mới chấp nhận từ 6-30 kí tự!',
            'password_new.max'=>'Mật khẩu mới chấp nhận từ 6-30 kí tự!',
        ]);

        $passwordOld = Auth::user()->password;
        if(Auth::attempt([
            'password'=>$passwordOld
        ])){
            
            if($request->password_new == $request->password_confirm){
                // success
                $user = User::where('email',Auth::user()->email);
                $user->password = bcrypt($request->password_new);
                try{
                    $user->save();
                    return redirect()->back()->with('msg-succ','Cập nhật thành công mật khẩu mới!');
                }catch(\Throwable $e){
                    report($e);
                    return false;
                }
            }
            return redirect()->back()->with('msg-er','Mật khẩu mới không khớp');
        }
        return redirect()->back()->with('msg-er','Mật khẩu chưa chính xác!');

    }

    
}
