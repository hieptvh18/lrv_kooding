@extends('layouts.layout-admin')

@section('page-title', 'PRODUCT BRAND')

@section('main')

    <div class="card-body">
        <h4 class="card-title">Danh sách Thuong hieu</h4>
        <div class="row">
            <div class="col-8">
                @if (session('msg-suc'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                @if (session('msg-er'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Anh</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $val->name }}</td>
                                <td>
                                    <img src="{{asset('uploads')}}/{{$val->avatar}}" width="40px" alt="">
                                </td>
                                <td>
                                   
                                        <a href="{{ route('brand.destroy', $val->id) }}" onclick="
                                             event.preventDefault();
                                            if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
                                                document.querySelector('#form-del-brand{{ $key }}').submit()
                                            }
                                                    "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                                        <form id="form-del-brand{{ $key }}"
                                            action="{{ route('brand.destroy', $val->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <h5>Them moi thuong hieu thoi trang</h5>
                <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Ten thuong hieu</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="Enter name brand" class="form-control">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>   
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <input name="avatar" type="file" class="form-control file-upload-info" placeholder="Upload Image"
                            id="upload" onchange="previewImg()">
                            <small>Upload avatar of brand*</small>
                        @error('avatar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div id="displayImg" class="" style="width: 200px;">

                        </div>
                    </div>

                    <button class="mt-3 btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>

@endsection


