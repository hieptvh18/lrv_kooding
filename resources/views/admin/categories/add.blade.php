@extends('layouts.layout-admin')


@section('page-title', 'Them danh muc')
@section('main')
    <div class=" grid-margin p-2">
        <div class="">
            <div class="card-body">
                <h4 class="card-title">Add new category</h4>
               <a href="#listCategory" class="btn btn-primary btn-sm" style="scroll-behavior: smooth"> Danh sách danh mục</a>

                @if (session('msg-er'))
                    <div class="text-danger">{{ session('msg-er') }}</div>
                @endif
                @if (session('msg-suc'))
                    <div class="text-success">{{ session('msg-suc') }}</div>
                @endif
                <form action="{{ route('categories.store') }}" id="form_categorys" class="forms-sample mt-3" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputName1">Name</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                                id="exampleInputName1" placeholder="enter sub category name">
                            <small>Enter sub category name *</small>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="">Parent Categories</label>
                            <select name="parent_id" id="" class="form-control">

                                <option value="">---select none---</option>
                                @foreach ($listSelectSub as $key => $item)
                                    <option value="{{ $item['id'] }}" {{ old('parent_id') == $item['id'] ? "selected" : "" }}>
                                        {{ str_repeat('---', $item['level']) }}{{ $item['name'] }}</option>
                                @endforeach

                            </select>
                            <small>Choose category origin(if you select none, it add categories)*</small>
                            @error('parent_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                       
                        <div class="form-group col-6">
                            <label>File upload</label>
                            <input name="avatar" type="file" value="{{old('avatar')}}" class="form-control file-upload-info"
                                placeholder="Upload Image" id="upload" onchange="previewImg()">
                            <small>Upload avatar of sub category*</small>
                            @error('avatar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div id="displayImg" class="" style="width: 200px;">

                            </div>
                        </div>

                        <div class="form-group col-6">
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
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>
                    <a href="" class="btn btn-sm btn-light">Cancel</a>
                </form>
            </div>

        </div>

        {{-- list parent categories --}}
        <div class="mt-4" id="listCategory">
            <h6>List parent categories</h6>
            <table class="table table-borderd">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Slug</th>
                        <th>Thuộc tính</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listCate as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val['name'] }}</td>

                            <td><img src="{{ asset('uploads') }}/{{ $val->avatar }}" alt="" width="50px"></td>
                            <td>{{ $val->slug }}</td>
                            <td>
                                @foreach ($val->attributes as $attr)
                                    <p>{{ $attr->name }}</p>
                                @endforeach
                            </td>
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
            <div class="paginate">
                {{ $listCate->links() }}
            </div>
        </div>
    </div>
@endsection
