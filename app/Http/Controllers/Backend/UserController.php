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
    public function index(Request $rq)
    {
        // list account & option
        $users = User::select('*');
        $searchTitle = '';
        $sortType = 'asc';

        // search
        if($rq -> keyword_user){
            
            $searchTitle = "Kết quả tìm kiếm "."'".$rq -> keyword_user."'";
            $users = $users->where('name','like','%'.$rq->keyword_user.'%');
        }

        // sort 
        if($rq->sortBy && $rq -> sortType){
            $users = $users->orderBy($rq->sortBy,$rq->sortType);
            if($rq->sortType == 'asc'){
                $sortType = 'desc';
            }else{
                $sortType = 'asc';
            }
        }

        $users= $users->paginate(10);

        return view('admin.account.list', compact('users','searchTitle','sortType'));
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
    public function update(UserRequest $request, $id)
    {
        //
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        return redirect(route('user.index'))->with('msg-suc','Cập nhật thành công tài khoản!');
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
        User::destroy($id);
        return redirect(route('user.index'))->with('msg-suc','Xóa thành công tài khoản');
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
