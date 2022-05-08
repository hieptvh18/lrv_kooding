@extends('layouts.layout-admin')

@section('page-title', 'Đơn hàng')
@section('main')

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.order.changeStatus',$receiver->id)}}" name="formUpdateStatusOrder" method="POST" id="formUpdateStatusOrder">
                @csrf
                @method('put')
                <h3 class="text-center">Chi tiết đơn hàng </h3>
                <h5 class="text-center">"Mã đơn hàng: {{ $receiver->id }}"</h5>

                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4>Ngày tạo đơn</h4>
                        <p>
                            {{ $receiver->created_at }} </p>
                    </div>
                    <div class="">
                        {{-- <button class="btn btn-primary">Export</button> --}}
                    </div>
                </div>

                <h4>Thông tin nhận hàng:</h4>
                <table class="table table-striped table-borderless">

                    <tbody>
                        <tr>
                            <td>Họ tên:</td>
                            <td>{{ $receiver->name }}</td>
                        </tr>
                        <tr>
                            <td>Điện thoại:</td>
                            <td>{{ $receiver->phone }}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ nhận hàng:</td>
                            <td>{{ $receiver->address }}</td>
                        </tr>
                        <tr>
                            <td>Ghi chú:</td>
                            <td>{{ $receiver->note == '' ? $receiver->note : 'Không có ghi chú' }}</td>
                        </tr>

                    </tbody>
                </table>
                <h3 class="card-title mb-0">Các sản phẩm mua</h3>
                <div class="table-responsive">
                    <!-- list sp mua -->
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Màu sắc</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($bill as $key => $item)
                                @php $tt = $item->price  * $item->quantity @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \App\Models\Product::find($item->product_id)->name }}</td>
                                    <td><img src="{{ asset('uploads') }}/{{ \App\Models\Product::find($item->product_id)->avatar }} "
                                            width="" alt="">
                                    </td>
                                    <td class="font-weight-bold">{{ number_format($item->price, 0, ',') }}đ</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ \App\Models\AttributeValue::find($item->color_id)->name }}</td>
                                    <td>{{ \App\Models\AttributeValue::find($item->size_id)->name }}</td>
                                </tr>
                                @php$n++;
                                                                                                                    $total += $tt;
                                                                                                        @endphp 
                            @endforeach
                            <tr>
                                <th class="" colspan="">Tổng tiền đơn hàng:</th>
                                <th>{{ number_format($receiver->total_price, 0, ',') }}đ</th>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <!-- trạng thái đơn hàng -->
                <h4 class="mt-2">TRẠNG THÁI ĐƠN HÀNG</h4>
                <p class="" style="display:{{ $receiver->status > 0 ? 'none' : 'block' }}">
                    <input type="radio" {{ $receiver->status == 0 ? 'checked' : '' }} name="status" id="st1"
                        class="mr-2" value="0"><label for="st1">Chưa xử lý</label>
                </p>
                <p class="" style="display:{{ $receiver->status > 1 ? 'none' : 'block' }}">
                    <input type="radio" {{ $receiver->status == 1 ? 'checked' : '' }} name="status" id="st2"
                        class="mr-2" value="1"><label for="st2">Đang xử lý</label>
                </p>
                <p class="" style="display:{{ $receiver->status > 2 ? 'none' : 'block' }}">
                    <input type="radio" name="status" {{ $receiver->status == 2 ? 'checked' : '' }} id="st3"
                        class="mr-2" value="2"><label for="st3">Đã xử lý</label>
                </p>
                <p class="" style="display:{{ $receiver->status > 3 ? 'none' : 'block' }}">
                    <input type="radio" {{ $receiver->status == 3 ? 'checked' : '' }} name="status" id="st4"
                        class="mr-2" value="3"><label for="st4">Hủy đơn</label>
                </p>
                <input type="hidden" name="bill_id" value="{{ $receiver->id }}">
                <button type="submit" class="btn btn-primary" name="btn_sb">Xác nhận</button>
                <a href="{{route('admin.order.index')}}" class="btn btn-info">Danh sách đơn</a>
            </form>
        </div>
    </div>


@endsection
@section('plugin-script')

    <script>
        $(document).ready(function(){
            $('#formUpdateStatusOrder').submit(function(e){
                e.preventDefault();

                if($('input[name="statu"]').val() == 3){
                    if(confirm('Bạn chắc chắn hủy đơn? đơn hàng sẽ không thể xử lí nữa!')){
                        document.forms['formUpdateStatusOrder'].submit();
                    }
                    return;
                }
                document.forms['formUpdateStatusOrder'].submit();

            })
        })
    </script>
@endsection
