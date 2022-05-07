@extends('layouts.layout-admin')

@section('page-title', 'Thêm tin tức')
@section('main')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm tin tức mới</h4>
                <p class="card-description">
                    Basic form elements
                </p>
                @if (session('msg-er'))
                    <div class="alert alert-danger">{{ session('msg-er') }}</div>
                @endif
                <form id="form_news" action="{{ route('news.store') }}" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Tiêu đề </label>
                        <input name="title" type="text" class="form-control" id="exampleInputName1"
                            placeholder="Enter title" value="{{ old('title') }}">

                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <input name="image" type="file" id="upload" onchange="previewImg()"
                            class="form-control file-upload-info" placeholder="Upload Image">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div id="displayImg" class="" style="width: 200px;">

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Mô tả ngắn</label>
                        <textarea class="form-control" id="" name="short_desc" rows="3">{{ old('short_desc') }}</textarea>
                        @error('short_desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="local-upload">Chi tiết nội dung</label>
                        <textarea class="form-control" id="local-upload" name="content" rows="4">{{ old('content') }}</textarea>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="">Submit</button>
                    <a href="{{ route('news.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection
