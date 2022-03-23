@extends('layouts.layout-admin')


@section('page-title', 'Them danh muc')
@section('main')
    <div class=" grid-margin p-2">
        <div class="">
            <div class="card-body">
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
                <form action="{{ route('categories.store') }}" id="form_categorys" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputName1">Name</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                                id="exampleInputName1" placeholder="enter sub category name">
                            <small>Enter sub category name *</small>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group col-6">
                            <label for="">Parent Categories</label>
                            <select name="parent_id" id="" class="form-control">

                                <option value="">---select none---</option>
                                @foreach ($listSelectSub as $key=>$item)
                                    <option value="{{$item['id']}}" {{ old('name') == $key ? "selected" : "" }}>{{str_repeat('---',$item['level'])}}{{$item['name']}}</option>
                                @endforeach
    
                            </select>
                            <small>Choose category origin(if you select none, it add categories)*</small>
                            @error('parent_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                   <div class="row">
                        <div class="form-group col-6">
                            <label for="">Category slug</label>
                            <input name="slug" value="{{ old('slug') }}" type="text" class="form-control"
                                id="" placeholder="enter slug : category-clothing-new...">
                            <small>Enter slug(display in url, it must only contain letters, numbers, dashes and
                                underscores)</small>
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-6">
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
                                                @if (is_array(old('attr_id')) && in_array($val->id, old('attr_id'))) checked @endif </label>
                                    </div>
                                    <label class="mr-3"
                                        for="attr{{ $key + 1 }}">{{ $val->name }}</label>
                                </div>
                            @endforeach
                            @error('attr_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>
                    <a href="" class="btn btn-sm btn-light">Cancel</a>
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
                        <th>Parent name</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val['name'] }}</td>
                            <td>...</td>
                            <td>
                                <a href="{{ route('categories.destroy', $val['id']) }}" class="btn btn-sm btn-danger"
                                    onclick="
                                        event.preventDefault();
                                        document.querySelector('#formDelCate{{ $key }}').submit();
                                        ">Remove</a>

                                <form action="{{ route('categories.destroy', $val['id']) }}" method="POST"
                                    id="formDelCate{{ $key }}">
                                    @method('DELETE')
                                    @csrf
                                </form>

                                <a href="{{ route('categories.edit', $val['id']) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
