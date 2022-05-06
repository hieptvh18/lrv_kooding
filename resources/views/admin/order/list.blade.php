@extends('layouts.layout-admin')

@section('page-title', 'ORDER MANAGE')

@section('main')


<div class="card">
  <div class="card-body">
    <p class="card-title mb-0">DANH SÁCH ĐƠN HÀNG</p>
    @if (session('msg-suc'))
        <div class="alert alert-success">{{session('msg-suc')}}</div>
    @endif
    @if (session('msg-er'))
        <div class="alert alert-danger">{{session('msg-er')}}</div>
    @endif
    
    <div class="table-responsive">
    <div class="d-flex justify-content-between">
      <form action="" method="GET" class="mt-3">
        <input type="search" value="{{ old('keyword') }}" name="keyword" placeholder="Enter Order ID"
            class="form-control-sm" required style="height:33px;border:1px solid #ccc;border-radius:10px">
        <button class="btn btn-outline-info btn-sm">Tìm kiếm</button>
    </form>
    <div class="">
      <a href="{{route('orders.export')}}" class="btn btn-sm btn-primary">Export excel
        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
      </a>
    </div>
    </div>
    @if ($title)
        <h4 class="text-center">{{$title}}</h4>
    @endif
      <table class="table table-striped table-borderless">
        <thead>
          <tr>
            <th>ID </th>
            <th>Tên </th>
            <th>Tổng tiền <a href="?_sort=true&column=total_price&type={{$type}}"><i class="fa fa-sort ml-2"
              aria-hidden="true"></a></th>
            <th>Thanh toán</th>
            <th>Điện thoại</th>
            <th>Đặt hàng <a href="?_sort=true&column=created_at&type={{$type}}"><i class="fa fa-sort ml-2"
              aria-hidden="true"></a></th>
            <th>Cập nhật <a href="?_sort=true&column=updated_at&type={{$type}}"><i class="fa fa-sort ml-2"
              aria-hidden="true"></a></th>
            <th>Tình trạng <a href="?_sort=true&column=status&type={{$type}}"><i class="fa fa-sort ml-2"
              aria-hidden="true"></a></th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $key=>$o)
            <tr>
              <td>{{$o->id}}</td>
              <td>{{$o->name}}</td>
              <td class="font-weight-bold">{{ number_format($o->total_price, 0, ',') }}đ</td>
              <td>{{$o->payment}}</td>
              <td>{{$o->phone}}</td>
              <td>{{$o->created_at}}</td>
              <td>{{$o->updated_at}}</td>
              <td class="font-weight-medium">
                @if ($o->status == 2) 
                  <div class="badge badge-success">Đã gửi hàng</div>
                @elseif ($o->status == 1) 
                  <div class="badge badge-info">Đang xử lí</div>
                @elseif($o->status == 0) 
                  <div class="badge badge-warning">Chưa xác nhận</div>
                  @else
                    <div class="badge badge-danger">Đã hủy đơn</div>
                  @endif
              </td>
              <td>
                <a href="{{route('admin.order.detail',$o['id'])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="paginate">
        {{ $orders->links() }}
    </div>
    </div>
  </div>
</div>

@endsection