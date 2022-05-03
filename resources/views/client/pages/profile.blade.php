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
                                                <th>ID </th>
                                                <th>Tổng tiền hàng</th>
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
                                                    <td><?= $o['id'] ?></td>
                                                    <td class="font-weight-bold">
                                                        {{ number_format($o->total_price, 0, ',') }}đ
                                                    </td>
                                                    <td>{{ $o->phone }}</td>
                                                    <td>{{ $o->created_at }}</td>
                                                    <td class="font-weight-medium">
                                                        {{-- <?php if ($o['status'] == 2) : ?>
                                                        <div class="badge badge-success">Đã gửi hàng</div>
                                                        <?php elseif ($o['status'] == 1) : ?>
                                                        <div class="badge badge-warning">Đang xử lí</div>
                                                        <?php elseif($o['status'] == 0) : ?>
                                                        <div class="badge badge-danger">Chưa xác nhận</div>
                                                        <?php else: ?>
                                                        <div class="badge badge-danger">Đã bị hủy</div>
                                                        <?php endif;?> --}}
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-primary text-light"><small>Đã nhận được hàng</small></a>
                                                        <a href="" class="btn btn-outline-info btn"><i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
