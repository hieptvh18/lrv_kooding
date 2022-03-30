@extends('layouts.layout-admin')

@section('page-title', 'THÊM SẢN PHẨM')
@section('plugin-css')
    <style>
        .icon-color{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 1px solid #ccc;
        margin: 0 10px;
}
    </style>
@endsection
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm sản phẩm vào kho</h4>
                <p class="card-description">
                    Thêm sản phẩm mới vào kho hàng
                </p>
                <h5>Tên sản phẩm: {{$product->name}}</h5>

                <div class="info-product mb-3 mt-3">
                    {{-- loop attr added stock --}}
                    @if(count($productAttribute) > 0)
                    Biến thể đã thêm:
                 
                    @foreach ($productAttribute as $key => $val)
                        <p>{{$key +1 }}.
                                <b>Màu sắc</b>: <span class="icon-color" style="background-color: {{getAttributeValue($val->color_id)->value}}"></span>{{getAttributeValue($val->color_id)->name}} - 
                                <b>Kích cỡ</b>: {{getAttributeValue($val->size_id)->name}} ({{getAttributeValue($val->size_id)->value}}) - 
                                <b>Chất liệu</b>: {{getAttributeValue($val->material_id)->name}} ({{getAttributeValue($val->material_id)->value}}) - 
                                <b>Số lượng</b>: {{$val->quantity}}
                        </p>
                    @endforeach 
                    
                    @else
                        <span>Biến thể đã thêm: 0</span>
                    @endif
                </div>

                <form action="{{route('stock.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="pro_id" value="{{$product->id}}">
                    <div class="content-attribute">
                        <p class="ml-3">Thuộc tính sản phẩm</p>
                        {{-- loop attribute òf product category & attribute value --}}
                        <div class="row">
                            <div class="form-group col-3">
                                <select id="" name="color_id" class="form-control">
                                    <option selected disabled value="">---Chọn màu sắc---</option>
                                    @foreach (\App\Models\Attribute::find(1)->attributeValues as $val)
                                        <option value="{{ $val->id }}"
                                            {{ old('color_id') == $val->id ? 'selected' : '' }}>
                                            {{ $val->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-3">
                                <select id="" name="size_id" class="form-control">
                                    <option selected disabled value="">---Chọn kích cỡ---</option>
                                    @foreach (\App\Models\Attribute::find(2)->attributeValues as $val)
                                        <option value="{{ $val->id }}"
                                            {{ old('size_id') == $val->id ? 'selected' : '' }}>
                                            {{ $val->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-3">
                                <select id="" name="material_id" class="form-control">
                                    <option selected disabled value="">---Chọn Chất liệu---</option>
                                    @foreach (\App\Models\Attribute::find(3)->attributeValues as $val)
                                        <option value="{{ $val->id }}"
                                            {{ old('material_id') == $val->id ? 'selected' : '' }}>
                                            {{ $val->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('material_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-3">
                                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}"
                                    placeholder="Số lượng sản phẩm">
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a href="{{route('product.create')}}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script>
        $(document).ready(function() {
            $('select[name="category_id"]').change(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('ajax.get-attr-of-category') }}",
                    type: "POST",
                    data: {
                        "category_id": $('select[name="category_id"]').val(),

                    },
                    success: function(data) {
                        $('.content-attribute').html(data)
                    },
                    error: function(err) {
                        console.log('err -' + err)
                    }
                })

            })
        })
    </script> --}}
@endsection
