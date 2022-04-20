@extends('layouts.app')

@section('page-title', 'Đăng nhập')

@section('content')
    <h4>Xin chào? Hãy bắt đầu đăng nhập</h4>
    @if (session('err-login'))
        <div class="alert alert-danger">{{session('err-login')}}</div>
    @endif
    <form action="{{ route('login') }}" method="POST" class="pt-3">

        @csrf
        <div class=" mb-2">
            <label for="email" class=" col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class=" mb-2">
            <label for="password" class=" col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class=" mb-2">
            <div class=" offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="" for="remember">
                        Nhớ cho lần sau!
                    </label>
                </div>
            </div>
        </div>

        <div class=" mb-0">
            <div class=" offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>


            </div>
        </div>
        <div class="d-flex justify-content-between">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            @endif
            <a href="{{ route('register') }}" class="btn btn-link">Đăng kí</a>
        </div>
        <div class="mt-3 d-flex justify-content-between">
            <a href="{{route('login.google')}}" class=""> <i class="fa fa-google ml-2 fa-2x" aria-hidden="true"></i>
            </a>
            <a href="{{route('login.facebook')}}" class=""> <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
    
            </a>
        </div>
    

    </form>
@endsection
