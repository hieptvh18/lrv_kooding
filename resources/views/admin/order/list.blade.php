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
      <table class="table table-striped table-borderless">
        <thead>
          <tr>
            <th>ID </th>
            <th>Tên </th>
            <th>Tổng tiền</th>
            <th>Thanh toán</th>
            <th>Điện thoại</th>
            <th>Đặt hàng <a href="?_sort=true&column=name&type=asc"><i class="fa fa-sort ml-2"
              aria-hidden="true"></a></th>
            <th>Cập nhật <a href="?_sort=true&column=name&type=asc"><i class="fa fa-sort ml-2"
              aria-hidden="true"></a></th>
            <th>Tình trạng</th>
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
                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection