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

                <form action="{{ route('product.store') }}" id="add_products" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputName1">Tên </label>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                id="exampleInputName1" placeholder="Name">
                        </div>
                        <div class="form-group col-4">
                            <label for="cate" class="">Loại sản phẩm</label>
                            <select id="cate" name="sub_category_id" class="form-control">
                                <option selected disabled value="">---chon danh muc---</option>
                                @foreach ($listCategory as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="price">Giá</label>
                            <input type="number" value="{{ old('price') }}" name="price" class="form-control" id="price"
                                placeholder="Giá sản phẩm">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="" class="">Số lượng</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}"
                                placeholder="Số lượng sản phẩm">
                        </div>
                        <div class="form-group col-4">
                            <label for="" class="">Giam gia</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}"
                                placeholder="Số lượng sản phẩm">
                        </div>
                        <div class="form-group col-4">
                            <label for="" class="">Thuong Hieu</label>
                            <select id="" name="brand_id" class="form-control">
                                <option selected disabled value="">---chon thuong hieu---</option>
                                @foreach($listBrand as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-6" style="display:flex; column-gap:30px; align-items:center;">
                            <label for="">Màu sản phẩm</label>
                            {{-- <?php foreach ($data['color_values'] as $item) : ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="checkbox" type="checkbox" name="color[]" value="<?= $item['id'] ?>">
                                    <?= $item['value'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?> --}}
                            <label for="color[]" class="error"></label>
                        </div>

                        <div class="form-group col-6" style="display:flex; column-gap:30px; align-items:center;">
                            <label for="">Kích cỡ</label>
                            {{-- <?php foreach ($data['size_values'] as $item) : ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="checkbox" type="checkbox" name="size[]" value="<?= $item['id'] ?>">
                                    <?= $item['value'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?> --}}
                            <label for="size[]" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Ảnh đại diện( ảnh)</label>
                            <input type="file" name="avatar" class="form-control" id="upload" onchange="previewImg()">

                            <div id="displayImg" class="" style="width: 200px;">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Ảnh Chi tiết(dưới 5 ảnh)</label>
                            <input type="file" name="avatars[]" class="form-control" id="uploads" multiple="multiple">

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="form-check-inline ">
                                <label for="" class="mr-3"> Kich hoat</label>
                                <input class="form-check-input" value="0" id="special" type="checkbox" name="special"
                                    checked>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Slug</label>
                            <input type="text" name="slug" placeholder="Enter slug: day-la-slug-01" class="form-control">
                            <small>* Hien thi tren url</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="local-upload">Mô tả thông tin sản phẩm</label>
                        <textarea class="form-control" id="local-upload" name="desc" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" name="btn_add" class="btn btn-primary mr-2">Thêm</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
