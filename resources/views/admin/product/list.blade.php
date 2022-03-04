@extends('layouts.layout-admin')

@section('page-title','QUẢN LÍ SẢN PHẨM')

@section('main')

<div class="card-body">
    <h4 class="card-title">Danh sách sản phẩm</h4>
    <div class="" style="display: flex;">
        <a href="{{route('product.create')}}" class="text-light btn btn-primary">Thêm mới</a>

        <select name="categories" id="categories" style="border-radius: 15px;">
            <option value="" disabled selected>Lọc theo danh mục</option>

        </select>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá.</th>
                    <th>Ảnh</th>
                    <th>Giá giảm</th>
                    <!-- <th>Mô tả</th> -->
                    <th>Tình trạng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody class="list-product">
                @foreach($listProduct as $key=>$val)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->cate_name}}</td>
                        <td>{{number_format($val->price,0)}}vnd</td>
                        <td><img src="{{asset('uploads/'.$val->avatar)}}" alt=""> </td>
                        <td>{{$val->discount}}vnd</td>
                        <td>
                            @if ($val->status == 0)
                                 <label class="badge badge-danger">Hết hàng</label>
                            @else
                                <label class="badge badge-success">Còn hàng</label>
                            @endif
                         
                        </td>
                        <td>
                            <a href="product?action=update&id={{$val->id}}"><i
                                    class="fas fa-pen-square text-warning fa-2x "></i></a>
                            <a href="?action=del&id={{$val->id}}"
                                onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i
                                    class="fas fa-trash-alt text-danger fa-2x"></i></a>
                        </td>
                    </tr>

                @endforeach
                
            </tbody>
        </table>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
    </div>
</div>
<div id="output"></div>

<!-- js -->
@endsection
