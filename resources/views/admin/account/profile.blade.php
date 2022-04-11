@extends('layouts.layout-admin')

@section('page-title', 'HỒ SƠ ADMIN')

@section('main')

    <div class="container-fluid mt-5">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Hồ sơ cá nhân</h3>
                <ol class="breadcrumb" style="border: none !important;">
                    <li class="breadcrumb-item"><a href="admin">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>

        </div>
        <!--
                        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="mt-4"> <img src="./public/images/admin/mua_ha_noi.jpg"
                                class="img-circle" width="100%" />
                            <h4 class="card-title mt-2">{{ Auth::user()->name }}</h4>
                            <h6 class="card-subtitle">
                                Welcome admin
                            </h6>

                        </center>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tab panes -->
                    <div class="card-body">
                        @if (session('msg-er'))
                            <div class="text-danger">{{ session('msg-er') }}</div>
                        @endif
                        @if (session('msg-suc'))
                            <div class="text-success">{{ session('msg-suc') }}</div>
                        @endif
                        <form action="{{ route('admin.profile.store') }}" class="form-horizontal form-material mx-2"
                            method="POST" id="profile_admin">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control form-control-line">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input disabled type="email" value="{{ Auth::user()->email }}"
                                        class="form-control form-control-line" name="email" id="example-email">

                                </div>
                            </div>
                            {{-- <div class="form-group">
                            <label for="">Ngày sinh</label>
                            <input type="date" value="" name="birthday" id="birthday" placeholder="Ngày sinh của bạn" class="form-control">
                        </div> --}}
                            <div class="gender col-md-12 mb-4 mt-4">
                                <label for="">Giới tính</label>
                                <div class="form-check-inline">
                                    <input class="form-check-input" {{ Auth::user()->gender == 1 ? 'checked' : '' }}
                                        value="1" id="gender" type="radio" name="gender">
                                    <label for="gender" class="form-check-label mr-4">
                                        Nam
                                    </label>
                                    <input class="form-check-input" {{ Auth::user()->gender == 2 ? 'checked' : '' }}
                                        id="gender2" value="2" type="radio" name="gender">
                                    <label for="gender2" class="form-check-label">
                                        Nữ
                                    </label>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                        class="form-control form-control-line">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </form>

                        <!-- change pass -->
                        <form action="" class="form-horizontal form-material mx-2 mt-5" id="admin_pass">

                            <div class="form-group">
                                <label class="col-md-12">Mật khẩu cũ</label>
                                <div class="col-md-12">
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control form-control-line" placeholder="Mật khẩu cũ">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Mật mới</label>
                                <div class="col-md-12">
                                    <input type="password" name="new_password" value="" placeholder="Nhập mật khẩu mới"
                                        class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Xác nhận mật khẩu mới</label>
                                <div class="col-md-12">
                                    <input type="password" placeholder="Xác nhận mật khẩu mới" name="confirm_password"
                                        value="" class="form-control form-control-line">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="btnChangePass" class="btn btn-success">Thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection
