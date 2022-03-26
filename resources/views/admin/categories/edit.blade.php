@extends('layouts.layout-admin')


@section('page-title', 'Them danh muc')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cap nhat danh mục sản phẩm mới</h4>
                <p class="card-description">
                    Basic form elements
                </p>

                @if (session('msg-er'))
                    <div class="alert alert-danger">{{ session('msg-er') }}</div>
                @endif
                @if (session('msg-suc'))
                    <div class="text-success">{{ session('msg-suc') }}</div>
                @endif

                <form action="{{ route('categories.update', $myCategory->id) }}" id="form_categorys" class="forms-sample"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input name="name" value="{{ $myCategory->name }}" type="text" class="form-control"
                                    id="exampleInputName1" placeholder="Name">

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Parent Categories</label>
                                <select name="parent_id" id="" class="form-control">
    
                                    <option value="">---select none---</option>
                                    @foreach ($listSelectSub as $key => $item)
                                        <option  value="{{ $item['id'] }}" 
                                        {{--disable chinh no =))--}}
                                        {{$myCategory->id == $item['id'] ? 'disabled':''}} {{--selected parent_id--}}
                                        {{$myCategory->parent_id == $item['id'] ? 'selected':''}}>
                                            {{ str_repeat('---', $item['level']) }}{{ $item['name'] }}</option>
                                    @endforeach
    
                                </select>
                                <small>Choose category origin(if you select none, it add categories)*</small>
                                @error('parent_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Image old</label>
                                <div class="">
                                    <img src="{{ asset('uploads') }}/{{ $myCategory->avatar }}" width="80px" alt="">
                                    <input type="hidden" name="avatar" value="{{ $myCategory->avatar }}">
                                </div>
                                <label>File upload</label>
                                <input name="avatar" type="file" value="{{old('avatar')}}" class="form-control file-upload-info"
                                    placeholder="Upload Image" id="upload" onchange="previewImg()">
                                @error('avatar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div id="displayImg" class="" style="width: 200px;">

                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Category slug</label>
                                <input name="slug" value="{{ $myCategory->slug }}" type="text" class="form-control" id=""
                                    placeholder="enter slug : category-clothing-new...">
                                <small>Enter slug(display in url, it must only contain letters, numbers, dashes and
                                    underscores)</small>
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="mr-3" for="special1">Thuộc tính của loại sản phẩm:</label>
                                {{-- loop data --}}
                                <div class="">
                                    @foreach ($listAttr as $key => $val)
                                        <div class=""
                                            style="display:flex; column-gap:10px; align-items:center;">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input name="attr_id[]" class="checkbox"
                                                        value="{{ $val->id }}" type="checkbox" id="attr{{ $key + 1 }}"
                                                        @foreach ($attrOfCategories as $val2)
                                                            {{$val2->id == $val->id ? 'checked' : ''}}
                                                        @endforeach
                                                        >

                                                </label>
                                            </div>
                                            <label class="mr-3"
                                                for="attr{{ $key + 1 }}">{{ $val->name }}</label>

                                           
                                        </div>
                                    @endforeach
                                    @error('attr_id')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="" class="btn btn-light">Cancel</a>
                    <a href="{{route('categories.create')}}" class="btn btn-info">Danh sách</a>
                </form>

                
            </div>
        </div>
    </div>
@endsection
