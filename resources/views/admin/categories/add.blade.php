@extends('layouts.layout-admin')


@section('page-title', 'Them danh muc')
@section('main')
    <div class=" grid-margin p-2">
        <div class="">
            <div class="card-body">
                <h4 class="card-title">Add new category</h4>
               <a href="#listCategory" class="btn btn-outline-primary btn-sm" style="scroll-behavior: smooth"> Danh sách danh mục</a>

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

                                <option value="0">---select none---</option>
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

                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>
                             <a href="" class="btn btn-sm btn-outline-light">Cancel</a>
                        </div>

                        
                    </div>

                    
                </form>
            </div>

        </div>

        {{-- list parent categories --}}
        <div class="mt-4" id="listCategory">
            <h6>List categories</h6>
            <form action="" method="GET">
                <input type="search" value="{{old('keyword')}}" name="keyword" placeholder="search category" class="form-control-sm" required style="height:33px;border:1px solid #ccc;border-radius:10px">
                <button class="btn btn-outline-info btn-sm">Tìm kiếm</button>
            </form>

            <div class="title-search mt-4 mb-4">
                @if ($searchTitle)
                    <h4>Kết quả tìm kiếm: " {{$searchTitle}} "</h4>
                @endif
            </div>

        @if ($listCate->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name <a href="?_sort=true&column=name&type={{ $type }}"><i class="fa fa-sort ml-2"
                            aria-hidden="true"></a></th>
                        <th>Quantity product </th>
                        <th>Avatar</th>
                        <th>Slug</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listCate as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val['name'] }}</td>
                            <td>{{ $val -> products->count() }}</td>

                            <td><img src="{{ asset('uploads') }}/{{ $val->avatar }}" alt="" width="50px"></td>
                            <td>{{ $val->slug }}</td>
                           
                            <td>
                                <a href="{{ route('categories.destroy', $val['id']) }}" class="btn btn-sm btn-outline-danger"
                                    onclick="
                                            event.preventDefault();
                                         if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
                                             document.querySelector('#formDelCate{{ $key }}').submit();
                                         }
                                            ">Remove</a>

                                <form action="{{ route('categories.destroy', $val['id']) }}" method="POST"
                                    id="formDelCate{{ $key }}">
                                    @method('DELETE')
                                    @csrf
                                </form>

                                <a href="{{ route('categories.edit', $val['id']) }}"
                                    class="btn btn-outline-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginate">
                {{ $listCate->links() }}
            </div>
            @endif
        </div>
    </div>
@endsection
