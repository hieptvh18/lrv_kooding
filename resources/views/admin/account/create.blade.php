@extends('layouts.layout-admin')

@section('page-title', 'THÊM NGƯỜI DÙNG')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm tài khoản</h4>
                <p class="card-description">
                    Thêm tài khoản tào lao cho vui
                </p>
                @if (session('msg-er'))
                <div class="text-danger">{{ session('msg-er') }}</div>
            @endif
            @if (session('msg-suc'))
                <div class="text-success">{{ session('msg-suc') }}</div>
            @endif
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" name="form-register"
                    id="register_user" class="p-5">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Tên</label>
                            <input type="text" value="{{ old('name') }}" id="name" name="name" placeholder="Tên đầy đủ"
                                class="form-control form-control-sm">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="Nhập email"
                                class="form-control form-control-sm">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Mật khẩu</label>
                            <input type="password" value="{{ old('password') }}" name="password" placeholder="Nhập mật khẩu"
                                class="form-control form-control-sm">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="">Số điện thoại</label>
                            <input type="phone" value="{{ old('phone') }}" name="phone" id="phone"
                                placeholder="Nhập số điện thoại" class="form-control form-control-sm">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="gender col-md-12 mb-4 mt-4">
                        <p><label for="">Vai trò</label></p>
                        <div class="form-check-inline">
                            @foreach ($roles as $key=>$role)
                                <input class="form-check-input" {{ old('role_id') == $role->id ? 'checked' : '' }} id="role{{$key}}"
                                    value="{{$role->id}}" type="radio" name="role_id">
                                <label for="role{{$key}}" class="form-check-label mr-3">
                                    {{$role->name}}
                                </label>
                            @endforeach
                            @error('role_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                 
                        <div class="gender col-md-12 mb-4 mt-4">
                            <label class="form-check-label mr-3" for="">Giới tính</label>
                            <br>
                            <br>    
                            <input class="" {{old('gender') == 0 ?'checked':''}} value="0" id="gender" type="radio" name="gender" checked>
                            <label for="gender" class="form-check-label mr-4">
                                Nam
                            </label>
                            <input class="" value="1" id="gender2" {{old('gender') == 1 ?'checked':''}} type="radio" name="gender">
                            <label for="gender2" class="form-check-label">
                                Nữ
                            </label>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                    <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                    <a href="{{ route('user.index') }}" class="btn btn-light">Danh sách</a>

                </form>
            </div>
        </div>
    </div>
@endsection
