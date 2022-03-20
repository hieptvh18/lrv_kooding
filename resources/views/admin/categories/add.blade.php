@extends('layouts.layout-admin')


@section('page-title', 'Them danh muc')
@section('main')
    <div class=" grid-margin p-2">
        <div class=" row">
            <div class="card-body col-8">
                <h4 class="card-title">Add sub category</h4>
                <p class="card-description">
                    Basic form elements
                </p>

                @if (session('msg-er'))
                    <div class="text-danger">{{ session('msg-er') }}</div>
                @endif
                @if (session('msg-suc'))
                    <div class="text-success">{{ session('msg-suc') }}</div>
                @endif
                <form action="{{ route('sub-categories.store') }}" id="form_categorys" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                            id="exampleInputName1" placeholder="enter sub category name">
                        <small>Enter sub category name *</small>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Parent category</label>
                       <select name="category_id" id="" class="form-control">
                           <option selected disabled value="">---select sub category---</option>
                           @foreach($parent_categories as $val)
                                <option value="{{$val->id}}">{{$val->parent_name}}</option>
                           @endforeach
                       </select>
                       <small>Choose parent category()*</small>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">Category slug</label>
                        <input name="sub_cate_slug" value="{{ old('sub_cate_slug') }}" type="text" class="form-control"
                            id="" placeholder="enter slug : category-clothing-new...">
                        <small>Enter slug(display in url, it must only contain letters, numbers, dashes and underscores)</small>
                        @error('sub_cate_slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <input name="avatar" type="file" class="form-control file-upload-info" placeholder="Upload Image"
                            id="upload" onchange="previewImg()">
                            <small>Upload avatar of sub category*</small>
                        @error('avatar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div id="displayImg" class="" style="width: 200px;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mr-3" for="special1">Thuộc tính của loại sản phẩm:</label>

                        {{-- loop data --}}
                        <div class="" style="display:flex; column-gap:20px; align-items:center;">
                            @foreach ($listAttr as $key => $val)
                                <div class="" style="display:flex; column-gap:10px; align-items:center;">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input name="attr_id[]" class="checkbox" value="{{ $val->id }}"
                                                type="checkbox" id="attr{{ $key + 1 }}"
                                                @if (is_array(old('attr_id')) && in_array($val->id, old('attr_id'))) checked @endif
                                               
                                        </label>
                                    </div>
                                    <label class="mr-3" for="attr{{ $key + 1 }}">{{ $val->name }}</label>
                                </div>
                            @endforeach
                            @error('attr_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="" class="btn btn-light">Cancel</a>
                </form>
            </div>

            {{-- add parent categories --}}
            <div class=" col-4 col-md-4 mt-3">
                <h3 class="card-title">Add parent categories</h3>
                <p class="card-description">
                    Basic form elements
                </p>
                <form action="{{route('categories.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" placeholder="enter categories name" name="parent_name" class="form-control">
                        @error('parent_name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <small>Enter name parent categories*</small>
                    </div>
                    <button type="submit" class="btn btn-info">Add</button>
                </form>
            </div>
        </div>

        {{-- list parent categories --}}
        <div class="mt-4">
            <h6>List parent categories</h6>
            <table class="table table-borderd">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parent_categories as $key=>$val)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$val->parent_name}}</td>
                        <td>
                            <a href="{{route('categories.destroy',$val->id)}}" class="btn btn-danger" onclick="
                                event.preventDefault();
                                document.querySelector('#formDelCate{{$key}}').submit();
                                ">Remove</a>

                            <form action="{{route('categories.destroy',$val->id)}}" method="POST" id="formDelCate{{$key}}">
                                @method('DELETE')
                                @csrf
                            </form>

                            <a href="{{route('categories.edit',$val->id)}}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
