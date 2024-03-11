@extends('layouts.layout-admin')

@section('page-title', 'SỬA SẢN PHẨM')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cập nhật sản phẩm </h4>
                <p class="card-description">
                    Chỉnh sửa thông tin sản phẩm
                </p>

                @if (session('msg-er'))
                    <div class="alert alert-danger">{{ session('msg-er') }}</div>
                @endif
                @if (session('msg-suc'))
                    <div class="alert alert-success">{{ session('msg-suc') }}</div>
                @endif
                <form action="{{ route('product.update', $product->id) }}" id="add_products" class="forms-sample"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputName1">Tên </label>
                            <input type="text" value="{{ $product->name }}" name="name" class="form-control"
                                id="exampleInputName1" placeholder="Name">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="cate" class="">Loại sản phẩm</label>
                            <select name="category_id" id="" class="form-control">

                                @foreach ($listSelectCategory as $key => $item)
                                    <option value="{{ $item['id'] }}"
                                        {{$item['id'] == $product->category_id ?'selected':''}}>
                                        {{ str_repeat('---', $item['level']) }}{{ $item['name'] }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="price">Giá</label>
                            <input type="number" value="{{ $product->price }}" name="price" class="form-control"
                                id="price" placeholder="Giá sản phẩm">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="" class="">Số lượng</label>
                            <input type="number" disabled name="quantity" class="form-control" value="{{$product->quantity}}">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="" class="">Giam gia</label>
                            <input type="number" name="discount" class="form-control" value="{{ $product->discount }}"
                                placeholder="Giá giảm">
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label for="" class="">Thuong Hieu</label>
                            <select id="" name="brand_id" class="form-control">
                                @foreach ($listBrand as $val)
                                    <option value="{{ $val->id }}"
                                        {{ $product->brand_id == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
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
                            <div class="thumbnail-old mb-2">
                                <img src="{{asset('uploads/'.$product->avatar)}}" alt="" width="120px">
                            </div>
                            <input type="hidden" name="avatar" value="{{$product->avatar}}">
                            <input type="file" name="avatar" class="form-control" id="upload" onchange="previewImg()">
                            @error('avatar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div id="displayImg" class="" style="width: 200px;">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Ảnh Chi tiết(dưới 5 ảnh)</label>
                            <div class="thumbnail-old mb-2">
                                @if (\App\Models\Product::find($product->id)->images->count()>0)
                                    
                                    @foreach (\App\Models\Product::find($product->id)->images as $item)
                                        {{-- define input hidden -> update proimg --}}
                                        <input type="hidden" name="avatars[]" value="{{$item->url}}">
                                        <img src="{{asset('uploads/'.$item->url)}}" alt="" width="120px" class="mr-3 mb-2">
                                    @endforeach
                                    
                                @endif
                            </div>
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
                        <label >Tình trạng:</label>
                        <input type="radio" {{$product->status == 1 ? 'checked':''}} value="1" class="ml-3 mr-2" name="status" id="status"><label for="status">Hoạt động</label>
                        <input type="radio" {{$product->status == 0 ? 'checked':''}} value="0" class="ml-3 mr-2" name="status" id="status2"><label for="status2">Ẩn</label>
                    </div>

                    <div class="form-group">
                        <label for="local-upload">Mô tả thông tin sản phẩm</label>
                        <textarea class="form-control" id="local-upload" name="description" rows="4">{{ $product->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning mr-2">Update</button>
                    <a href="{{route('product.index')}}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
