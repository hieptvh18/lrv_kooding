<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;

use Auth;
use Illuminate\Validation\Rule;
use App\Http\Requests\Backend\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list account
        $listUser = User::all();

        return view('admin.account.list', compact('listUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get data
        $roles = Role::all();

        return view('admin.account.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $newUser = new User();
        
        $newUser->fill($request->all());
        $newUser->password = bcrypt($request->password);
        $newUser -> save();

        return redirect(route('user.index'))->with('msg-suc','Thêm thành công tài khoản mới');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get data
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.account.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // profile
    public function profileDisplay()
    {
        return view('admin.account.profile');
    }

    public function profileStore(Request $request)
    {
    
        $request->validate(
            [
                "name" => "required",
                "phone" => "required|regex:/^0[0-9]{9,15}$/|".Rule::unique('users')->ignore(Auth::user()->id),
                "gender" => "required"
            ],
            [
                "name.required" => "Bắt buộc nhập tên",
                "phone.regex" => "Số điện thoại không hợp lệ"
            ]
        );

        $user = User::find(Auth::user()->id);
        $user->fill($request->all());
        $user -> gender = $request->gender;
        $user->save();

        return redirect(route('admin.profile'))->with('msg-suc', 'Cập nhật thành công hồ sơ admin');
    }

    // change my pass

}
