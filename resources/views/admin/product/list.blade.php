@extends('layouts.layout-admin')

@section('page-title', 'QUẢN LÍ SẢN PHẨM')

@section('main')

    <div class="card-body">
        <h4 class="card-title">Danh sách sản phẩm</h4>
        <div class="d-flex justify-content-between">
            <div class="">
                <a href="{{ route('product.create') }}" class="text-light btn btn-primary">Thêm mới</a>
                <select name="categories" id="categories" style="border-radius: 15px;">
                    <option value="" disabled selected>Danh mục</option>
                </select>
            </div>
            <div class="">
                <input type="checkbox" class="form-check-label" id="btnCheck"> <label for="btnCheck">
                    check all</label>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-list-product">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Tên</th>
                        <th>Thương hiệu</th>
                        <th>Danh mục</th>
                        <th>Giá.</th>
                        <th>Ảnh</th>
                        <!-- <th>Mô tả</th> -->
                        <th>Tình trạng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="list-product">
                    @foreach ($listProduct as $key => $val)
                        <tr>
                            <td>
                                <input type="checkbox" name="pro_id[]">
                            </td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->brands->name }}</td>
                            <td>{{ $val->categories->name }}</td>
                            <td>{{ number_format($val->price, 0) }}vnd</td>
                            <td><img src="{{ asset('uploads/' . $val->avatar) }}" alt=""> </td>
                            <td>
                                @if ($val->status == 0)
                                    <label class="badge badge-danger">Hết hàng</label>
                                @else
                                    <label class="badge badge-success">Còn hàng</label>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('stock.create',$val->id)}}"><i
                                    class="fas fa-eye text-info fa-2x "></i></a>
                                <a href="{{route('product.edit',$val->id)}}"><i
                                        class="fas fa-pen-square text-warning fa-2x "></i></a>
                                <a href="?action=del&id={{ $val->id }}"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i
                                        class="fas fa-trash-alt text-danger fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="paginate">
                {{ $listProduct->links() }}
            </div>
            
        </div>
    </div>
    <div id="output"></div>

    <!-- js -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("#btnCheck").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });


        });
    </script>
@endsection
