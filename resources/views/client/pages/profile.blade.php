@extends('layouts.layout-client')

@section('page-title', 'Profile | Kooding')
@section('main')

    <main class="body__acc">

        <div class="body__acc__header">

            <div class="body__acc__fist">

                <div class="body__acc__title">
                    <div class="acc__title__fist active">

                        <p>Thông tin tài khoản</p>
                    </div>
                    <div class="acc__title__fist ">
                        <p>Đơn hàng</p>
                    </div>
                    <div class="acc__title__text mt-3">
                        <p>Chào mừng bạn trở lại {{ Auth::user()->name }}</p>
                    </div>
                </div>
                @if (session('msg-suc'))
                    <div class="bg-success p-2 text-light">{{ session('msg-suc') }}</div>
                @elseif (session('msg-er'))
                    <div class="bg-danger p-2 text-light">{{ session('msg-er') }}</div>
                @endif
                <div class="body__acc__menu">
                    <div class="acc__show__menu" onclick="menu();">
                        <div class="show__menu__title">
                            <p>Bảng Điều Khiển</p>
                        </div>
                        <div class="show__menu__icon">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </div>
                    <nav class="acc__allmenu show__menu">
                        <div class="acc__menu__item active">
                            <a href="#account">Thông tin tài khoản</a>
                        </div>
                        <div class="acc__menu__item">
                            <a href="#order">Đơn hàng</a>
                        </div>
                        <div class="acc__line"></div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="body__acc__content">
            <div class="acc__tab__menu active">
                <div class="acc__menu__content">
                    <div class="acc__donhang">
                        <div class="acc__DH__title">
                            <p>Thông tin tài khoản của bạn</p>
                        </div>

                        <div class="acc__DH__content1">
                            <div class="DH__title">
                                <p>Đăng nhập xã hội: </p>
                                <img src="{{ asset('assets') }}/images/layout/fb-logo-col.svg" alt=""
                                    class="">
                            </div>
                            <div class="DH__form">
                                <form action="{{ route('client.updateProfile') }}" method="POST" id="form_profile">
                                    @csrf
                                    @method('PUT')
                                    <div class="DH__form1">
                                        <label for="">Họ và tên</label>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- <div class="DH__form1">
                                                                    <label for="">Tên hiển thị <i>* Để nhận xét và nhận xét sản phẩm.</i></label>
                                                                    <input type="text" value="Trương Nghĩa">
                                                            
                                                                </div> -->
                                    <div class="DH__form1">
                                        <label for="">E-mail <i>* Nơi bạn nhận được thông tin đặt hàng.</i></label>
                                        <input type="email" name="email" disabled value="{{ Auth::user()->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="DH__form1">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" name="phone"
                                            value="{{ Auth::user()->phone ? Auth::user()->phone : '' }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="DH__form1">
                                        <label for="">Ngày sinh</label>
                                        <input type="date" name="birthday">
                                    </div> --}}
                                    <div class="DH__form2">
                                        <label class="sex__text" for="">Giới tính</label>
                                        <div class="DH__checkBox">

                                            <div class="pretty p-default">
                                                <input {{ Auth::user()->gender == 0 ? 'checked' : '' }} type="radio"
                                                    id="nam" name="gender" value="0" />
                                                <div class="state p-info">
                                                    <label for="nam">Nam</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-default">
                                                <input {{ Auth::user()->gender == 1 ? 'checked' : '' }} type="radio"
                                                    id="nu" name="gender" value="1" />
                                                <div class="state p-info">
                                                    <label for="nu">Nữ</label>
                                                </div>
                                            </div>

                                        </div>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="DH__submit">
                                        <button type="submit">Lưu thông tin của tôi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="acc__donhang">
                        <div id="changePass" class="acc__DH__title">
                            <p>Thay đổi mật khẩu tài khoản</p> <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </div>
                        <div id="show" class="acc__DH__content1">
                            <div class="DH__form">
                                <form action="{{ route('client.changePassword') }}" method="post" id="form_pass">
                                    @csrf
                                    <div class="DH__form1">
                                        <label for="">Mật khẩu cũ</label>
                                        <input name="password" type="password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="DH__form1">
                                        <label for="">Mật khẩu mới</label>
                                        <input name="password_new" type="password" value="{{ old('password_new') }}">
                                    </div>
                                    <div class="DH__form1">
                                        <label for="">Xác nhận mật khẩu</label>
                                        <input name="password_comfim" type="password">
                                    </div>
                                    @error('password_confirm')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="DH__submit">
                                        <button type="submit">Cập nhật mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="acc__tab__menu">
                <div class="acc__menu__content">
                    <div class="acc__donhang">
                        <div class="acc__DH__title">
                            <p>Lịch sử mua hàng</p>
                        </div>
                        @if (count($orders) == 0)

                            <div class="acc__DH__content">
                                <div class="DH__content__title">
                                    <p>Không tìm thấy đơn hàng</p>
                                </div>
                                <div class="DH__content__body">
                                    <img src="public/images/layout/empty-orders.jpg" alt="">
                                </div>
                            </div>
                        @else
                            <div class="acc__DH__content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tổng tiền </th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Số điện thoại</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Tình trạng đơn</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $o)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="font-weight-bold">
                                                        {{ number_format($o->total_price, 0, ',') }}đ
                                                    </td>
                                                    <td>{{ $o->payment }}</td>
                                                    <td>{{ $o->phone }}</td>
                                                    <td>{{ $o->created_at }}</td>
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
                                                        <button data-id="{{ $o->id }}"
                                                            class="btn btn-outline-info btn btnOpenModal"><i
                                                                class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="modalOrderDetail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">CHI TIẾT ĐƠN HÀNG </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h3 class="text-center">Chi tiết đơn hàng </h3>

                        <h4>Ngày tạo đơn</h4>
                        <p class="createdAtOrder"></p>

                        <h4>Thông tin nhận hàng:</h4>
                        <table class="table table-striped table-borderless">

                            <tbody>
                                <tr>
                                    <td>Họ tên:</td>
                                    <td class="info-order-name"></td>
                                </tr>
                                <tr>
                                    <td>Điện thoại:</td>
                                    <td class="info-order-phone"></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ nhận hàng:</td>
                                    <td class="info-order-address"></td>
                                </tr>
                                <tr>
                                    <td>Ghi chú:</td>
                                    <td class="info-order-note"></td>
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
                                <tbody class="bill-detail-data">
                                    
                                </tbody>
                                <tr>
                                    <th class="bg-light">Tổng: <span class="info-order-total"></span></th>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>

                </div>
            </div>
        </div>

    </main>

@endsection
@section('plugin-script')

    <script>
        $(document).ready(function() {

            const modal = document.querySelectorAll('.btnOpenModal');

            modal.forEach((val, index) => {
                val.onclick = function() {
                    
                    const apiFindOrder = '/api/order/' + val.dataset.id;
                    const api = '/api/order-detail/' + val.dataset.id;

                    axios.get(apiFindOrder)
                    .then(res=>{
                        $('.createdAtOrder').html(res.data.data.created_at)
                        $('.info-order-name').html(res.data.data.name)
                        $('.info-order-phone').html(res.data.data.phone)
                        $('.info-order-address').html(res.data.data.address)
                        $('.info-order-total').html(res.data.data.total_price + 'đ')

                        if(!res.data.data.note){
                            $('.info-order-note').html('Không có ghi chú')
                        }else{
                            $('.info-order-note').html(res.data.data.note)
                        }
                    })

                    axios.get(api)
                        .then(res => {

                            // render data to modal
                            html = '';
                            res.data.forEach((val,index)=>{

                                const apiFindProduct = '/api/product/'+val.product_id;
                                axios.get(apiFindProduct)
                                .then(res2=>{

                                    // get attribute
                                    const apiFindColor = 'attribute-value/'+res.data.color_id;
                                    const apiFindSize = 'attribute-value/'+res.data.size_id;

                                    // gan thuoc tinh kieu j ?

                                    html += `
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${res2.data.name}</td>
                                            <td><img src="/uploads/${res2.data.avatar}" alt="" width="50px"></td>
                                            <td>${res2.data.price}</td>
                                            <td>${val.quantity}</td>
                                            <td></td>
                                            <td></td>
                                            </tr>
                                    `;
                                    $('.bill-detail-data').html(html)
                                })

                            })

                            $('#modalOrderDetail').modal('toggle');

                        })


                }
            })
        })
    </script>

@endsection
