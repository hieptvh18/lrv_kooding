@extends('layouts.layout-admin')


@section('page-title', 'Them danh muc')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm danh mục sản phẩm mới</h4>
                <p class="card-description">
                    Basic form elements
                </p>

                <form action="{{route('categories.store')}}" id="form_categorys" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                            id="exampleInputName1" placeholder="Name">

                            @error('name')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input name="avatar" type="file" class="form-control file-upload-info" placeholder="Upload Image"
                            id="upload" onchange="previewImg()">
                            @error('avatar')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <div id="displayImg" class="" style="width: 200px;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mr-3" for="special1">Thuộc tính của loại sản phẩm:</label>

                        {{-- loop data --}}
                        <div class="" style="display:flex; column-gap:20px; align-items:center;">
                            @foreach ($listAttr as $key=>$val)
                                <div class="" style="display:flex; column-gap:10px; align-items:center;">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input name="attr_id[]" class="checkbox" value="{{ $val->id }}"
                                                type="checkbox" id="attr{{$key+1}}" @if(is_array(old('attr_id')) && in_array($val->id, old('attr_id'))) checked @endif>
                                        </label>
                                    </div>
                                    <label class="mr-3" for="attr{{$key+1}}">{{ $val->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('attr_id')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    </div>
                    <button type="submit"class="btn btn-primary mr-2">Submit</button>
                    <a href="" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
