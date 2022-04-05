@extends('layouts.layout-admin')

@section('page-title', 'QUẢN LÍ KHO HÀNG')

@section('main')

    <div class="card-body">
        <h4 class="card-title">KHO HÀNG</h4>
        @if (session('msg-er'))
            <div class="alert alert-danger">{{ session('msg-er') }}</div>
        @endif
        @if (session('msg-suc'))
            <div class="alert alert-success">{{ session('msg-suc') }}</div>
            @endif
        <div class="mess-alert"></div>

        <div class="search col-4">
            <form action="">
                <label for="">Tìm kiếm sản phẩm trong kho</label>
                <input type="search" name="keyword_stock" class="form-control form-control-sm" placeholder="Search product">
            </form>
        </div>
        
            
        <form action="" method="POST" class="table-responsive">
            <div class="d-flex justify-content-between">
                <div class=""></div>
                <button type="submit" class="btn btn-info btn-sm ">Cập nhật SL số mới</button>
            </div>
            <table class="table table-list-product">
                <thead >
                    <tr class="">
                        <th>STT</th>
                        <th>Sản phẩm <a href="{{route('stock.index')}}?sort="><i class="fa fa-sort ml-2" aria-hidden="true"></a></i>
                        </th>
                        <th>Loại sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Tình trạng</th>
                        <th>Số lượng hiện tại</th>
                        <th>Cập nhật lại số lượng</th>
                    </tr>
                </thead>
                <tbody class="list-product">
                    @foreach ($listProductStock as $key=>$val )
                        <tr>
                            <td>{{$key+1}}</td>
                            <td class="d-flex align-item-center">
                                <div class="mr-2">
                                    <img src="" width="50px" alt="">
                                </div>
                                <div class="">
                                    <h6>Name</h6>
                                    <span>M</span> - <span>Đỏ cam</span>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="number" name="restore_quantity" placeholder="SL" style="width:70px;"></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="paginate">
                {{ $listProductStock->links() }}
            </div>

        </div>

    </div>
    <div id="output"></div>

    <!-- js -->

    {{-- form fake method remove --}}
    <form id="" name="formFakeRemoveMuntiple" method="POST">
        @method('DELETE')
        @csrf
        <input type="hidden" value="" name="pro_id">
    </form>
@endsection

@section('script')
    
@endsection
