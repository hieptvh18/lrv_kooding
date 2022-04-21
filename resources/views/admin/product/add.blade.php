@extends('layouts.layout-admin')

@section('page-title', 'THÊM SẢN PHẨM')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm sản phẩm mới</h4>
                <p class="card-description">
                    Thêm sản phẩm mới vào kho hàng
                </p>
                @if (session('msg-er'))
                    <div class="alert alert-danger">{{ session('msg-er') }}</div>
                @endif
                @if (session('msg-suc'))
                    <div class="alert alert-success">{{ session('msg-suc') }}</div>
                @endif

                <form action="{{ route('product.store') }}" id="add_products" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputName1">Tên </label>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                id="exampleInputName1" placeholder="Name">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="cate" class="">Loại sản phẩm</label>
                            <select name="category_id" id="" class="form-control">

                                <option value="" selected disabled>---select none---</option>
                                @foreach ($listSelectCategory as $key => $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ old('category_id') == $item['id'] ? 'selected' : '' }}>
                                        {{ str_repeat('---', $item['level']) }}{{ $item['name'] }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="price">Giá</label>
                            <input type="number" value="{{ old('price') }}" name="price" class="form-control"
                                id="price" placeholder="Giá sản phẩm">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- <div class="form-group col-4">
                            <label for="" class="">Số lượng</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}"
                                placeholder="Số lượng sản phẩm">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        <div class="form-group col-4">
                            <label for="" class="">Giam gia</label>
                            <input type="number" name="discount" class="form-control" value="{{ old('quantity') }}"
                                placeholder="Giá giảm">
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="" class="">Thuong Hieu</label>
                            <select id="" name="brand_id" class="form-control">
                                <option selected disabled value="">---chon thuong hieu---</option>
                                @foreach ($brands as $val)
                                    <option value="{{ $val->id }}"
                                        {{ old('brand_id') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label>Ảnh đại diện( ảnh)</label>
                            <input type="file" name="avatar" class="form-control" id="upload" onchange="previewImg()">
                            @error('avatar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div id="displayImg" class="" style="width: 200px;">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Ảnh Chi tiết(dưới 5 ảnh)</label>
                            <input type="file" name="avatars[]" class="form-control" id="uploads" multiple="multiple">
                            @error('avatars')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if (session('err-avatars'))
                                <small class="text-danger">{{ session('err-avatars') }}</small>
                            @endif('err-avatars')

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="local-upload">Mô tả thông tin sản phẩm</label>
                        <textarea class="form-control" id="local-upload" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
