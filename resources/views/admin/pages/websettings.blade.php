@extends('layouts.layout-admin')

@section('page-title', 'Giao diện')
@section('main')


    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Quản lí giao diện</h4>
                <p class="card-description">
                    Basic form elements
                </p>
                @if (session('msg-suc'))
                    <div class="alert alert-success">{{ session('msg-suc') }}</div>
                @endif
                @if (session('msg-er'))
                    <div class="alert alert-danger">{{ session('msg-er') }}</div>
                @endif
                <form action="{{ route('websettings.update') }}" id="form_display" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        @csrf
                        @method('put')
                        <label for="">Tên website </label>
                        <input type="text" value="{{ $settings->web_name }}" placeholder="Nhập tên website"
                            class="form-control" name="web_name">
                        @error('web_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Logo website </label>
                        <img src="{{ asset('uploads') }}/{{ $settings->logo }}" alt="" width="200px">
                        <p>Tải logo mới</p>
                        <input type="file" class="form-control" id="upload" onchange="previewImg()" name="logo">
                        @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="logo" value="{{ $settings->logo }}">
                        <div id="displayImg" class="" style="width: 200px;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mr-3" for="special1">Giới thiệu (homepage) </label>
                        <p>Tiêu đề</p>
                        <input type="text" value="{{ $settings->intro_title }}" name="intro_title" class="form-control">
                        @error('intro_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <p>Nội dung</p>
                        <textarea class="form-control" id="local-upload" name="intro_content"
                            rows="5">{{ $settings->intro_content }}</textarea>
                        @error('intro_content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="">Quản lý url(social-footer)</label>
                        <input type="text" value="{{ $settings->fb_url }}" placeholder="url facebook" name="fb_url"
                            class="form-control">
                        @error('fb_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" value="{{ $settings->insta_url }}" name="insta_url" placeholder="url instagram"
                            class="form-control">
                        @error('insta_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" value="{{ $settings->twitter_url }}" name="twitter_url" class="form-control"
                            placeholder="url twitter">
                        @error('twitter_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" value="{{ $settings->pinterest_url }}" name="pinterest_url"
                            class="form-control" placeholder="url pinterest">
                        @error('pinterest_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
