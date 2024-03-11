@extends('layouts.layout-client')

@section('page-title', 'Cửa hàng | Kooding')
@section('main')
    <main class="body__order">
        @if (session('payment-success'))
            <div class="bg-success p-2 text-light">{{ session('payment-success') }}</div>
        @elseif(session('payment-error'))
            <div class="bg-danger p-2 text-light">{{ session('payment-error') }}</div>
        @endif
        <form action="{{ route('client.handleCheckout') }}" id="checkout" class="body__order__content" method="POST">
            @csrf
            <div class="body__order__left">
                <div class="order__left__title">
                    <h3>1. Địa chỉ giao hàng</h3>
                </div>
                <!-- address -->
                <div class="form__address">
                    <div class="address">
                        <div class="nation">
                            <p>Quốc gia của bạn</p>
                            <div class="vn">
                                <img src="{{ asset('assets/images/layout/vn.svg') }}" alt="">
                                <span>Việt Nam</span>
                            </div>
                        </div>
                    </div>
                    <div class="address">
                        <label for="">Họ tên</label>
                        <input name="fullname" id="fullname" type="text" value="{{ Auth::check() ?? Auth::user()->name }}">
                        <label for="fullname" class="error" style="display: none;"></label>

                    </div>
                    {{-- <div class="address">
                        <label for="">Email</label>
                        <input name="email" id="email" type="text" value="{{ Auth::check() ?? Auth::user()->email }}">
                    </div> --}}

                    <div class="address">
                        <label for="">Địa chỉ</label>
                        <div class="input__auto">
                            <input name="fakeInput" type="text" placeholder="Tỉnh/ Thành phố, Quận/Huyện, Phường/Xã"
                                disabled>
                        </div>
                        <div class="auto__address">

                            <div class="select__allAdd">
                                <div class="input__address none ">
                                    <p class="tinhAdd"></p>
                                    <p class="huyenAdd"></p>
                                    <p class="xaAdd"></p>
                                    <div class="close">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                                <div class="itemAll__address ">
                                    <div class="select__address">
                                        <div class="item__address tinh">
                                            <select onchange="innerHTML_tinh()" name="tinh" id="tinh">
                                                <option value="" disabled selected>Chọn tỉnh</option>
                                                @foreach ($provinces as $item)
                                                    <option {{ $item->proviceid == old('tinh') }}
                                                        value="<?= $item['provinceid'] ?>"><?= $item['name'] ?></option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="item__address">
                                            <select onchange="innerHTML_huyen()" name="huyen" id="huyen">
                                                <option value="" selected disabled>Chưa chọn tỉnh</option>
                                            </select>
                                        </div>
                                        <div class="item__address">
                                            <select onchange="innerHTML_xa()" name="xa" class="xa" id="village">
                                                <option value="" selected disabled>Chưa chọn quận huyện</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <label for="xa" class="error" style="display: none;"></label>
                    </div>

                    <div class="address">
                        <label for="">Địa chỉ cụ thể</label>
                        <textarea name="address" id="" cols="30" rows="3" class=""
                            style="border:1px solid #d7d7d7;border-radius: 5px;">{{ old('address') }}</textarea>
                        <label for="address" class="error" style="display: none;"></label>

                    </div>
                    <div class="address">
                        <label for="">Số điện thoại</label>
                        <input name="phone" value="{{ old('phone') }}" type="text">
                        <label for="phone" class="error" style="display: none;"></label>

                    </div>
                </div>
                <!-- pro odder -->
                <div class="order__bottom">
                    <div class="order__bottom__title">
                        <h3>2. Mặt hàng thanh toán</h3>
                    </div>
                    <div class="order__bottom__content">

                        @php $total = 0; @endphp
                        @foreach (session('carts') as $item)
                            @php
                                $tt = ($item['price'] - $item['discount']) * $item['quantity'];
                            @endphp
                            <div class="order__bottom__item">
                                <img src="{{ asset('uploads') }}/{{ $item['avatar'] }}" alt="" width="70px">
                                <div class="order__info">
                                    <div class="order__name">
                                        <p>{{ \App\Models\Product::find($item['product_id'])->name }}</p>
                                    </div>
                                    <div class="order__text">
                                        <p> {{ \App\Models\AttributeValue::find($item['color_id'])->name }}</p>
                                        <p>|</p>
                                        <p>Size {{ \App\Models\AttributeValue::find($item['size_id'])->name }}</p>
                                        <p>|</p>
                                        <p>Qty {{ $item['quantity'] }}</p>
                                        <p>|</p>
                                        <p>{{ number_format($tt, 0, ',') }}đ</p>
                                    </div>
                                </div>
                            </div>
                            @php $total += $tt;@endphp
                        @endforeach
                        <input type="hidden" name="total"
                            value="{{ session('newPrice') ? session('newPrice') : $total }}">

                        <div class="order__chage">
                            <a href="{{ route('client.cart') }}" class="text-primary">Chỉnh sửa giỏ hàng</a>
                        </div>
                    </div>
                </div>

                {{-- method payment --}}
                <div class="order__method">
                    <div class="order__method__title">
                        <h3>3. Phương thức thanh toán</h3>
                    </div>
                    <div class="order__method__content">

                        <div class="order__bottom__item d-flex align-items-center pt-3 pb-3">
                            <input type="radio" name="method" id="method1" value="0" checked> <label for="method1"
                                class="m-0 pl-3">Thanh toán khi nhận
                                hàng</label>
                        </div>


                        <div class="order__bottom__item mt-3 d-flex align-items-center justify-content-between">
                            <span> <input type="radio" name="method" id="method3" value="2"> <label class="m-0 pl-3"
                                    for="method3">Thanh toán
                                    Vnpay</label></span>
                            <div>
                                <img src="{{ asset('assets/images/layout/vnpay.png') }}" alt="" width="100px">
                            </div>
                        </div>

                        <div class="order__bottom__item mt-3 d-flex align-items-center justify-content-between">
                            <span> <input type="radio" name="method" id="method2" value="1"> <label class="m-0 pl-3"
                                    for="method2">Thanh toán
                                    Paypal</label></span>
                            <div>
                                {{-- <img src="{{ asset('assets/images/layout/paypal.png') }}" alt="" width="100px"> --}}
                                <div id="paypal-button"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="body__order__right">
                <!-- bill -->
                <div class="order__right__content">
                    <div class="right__content__title">
                        <h3>Tóm tắt nhanh</h3>
                    </div>
                    <div class="right__content__body">
                        <div class="content__input--vocher" style="border:1px solid #d7d7d7;border-radius: 5px;">
                            <input id="vocher" name="code" value="" type="text" placeholder="Nhập phiếu giảm giá">
                            <div class="sub__vorcher">
                                <button type="submit" name="btn_apply_voucher" value="true">Áp dụng</button>
                            </div>
                        </div>

                        {{-- er vc --}}
                        @if (session('er-voucher'))
                            <small class="text-danger ml-3">{{ session('er-voucher') }}</small>
                        @endif
                        <!-- <label for="vocher" class="error" style="display: none; margin-left: 20px !important;"></label> -->
                        <div class="content__subtotal">
                            <span>Tổng giá:</span>
                            <p>{{ number_format($total, 0, ',') }}đ</p>
                        </div>
                        <div id="shiping" class="content__subtotal">
                            <span>Phí chuyển hàng:</span>
                            <p>30,000đ</p>
                        </div>

                        @if (session('newPrice'))
                            <div class="content__subtotal">
                                <span>Mã giảm giá: {{ session('codeVoucher') }}</span>
                            </div>
                        @endif
                        <div class="contnet__all">

                            <span><b>Số tiền phải thanh tóan</b>:
                                {{ session('newPrice') ? number_format(session('newPrice'), 0, ',') : number_format($total, 0, ',') }}
                                đ</span>

                            <p></p>
                        </div>
                        <div class="content__note">
                            <div id="note" class="note">
                                <p><i class="fas fa-plus"></i> Thêm ghi chú vào đơn hàng này</p>
                            </div>
                            <div id="input_note" class="note__input">
                                <input type="text" name="note" placeholder="Lưu ý của khách hàng">
                            </div>
                        </div>
                        <div class="content__ok">
                            <div class="pretty p-default">
                                <input type="checkbox" name="agree" checked />
                                <div class="state p-info">
                                    <label>Tôi chấp nhận các Điều khoản và Chính sách Bảo mật.</label>
                                </div>
                            </div>
                            <a style="font-size: 12px;" class="text-primary"
                                href="{{ route('client.termsofuse') }}">Điều
                                khoản và Chính sách Bảo mật.</a>
                            <label for="agree" class="error" style="display: none;"></label>
                        </div>
                        <div class="content__submitAll">
                            <button type="submit" name="btn_payment_tt">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </main>
@endsection

@section('plugin-script')
    <script src="{{ asset('assets/js/handle/validateform.js') }}"></script>
    <!-- gửi value address -->
    <script>
        $(document).ready(function() {
            $('#tinh').change(function() {
                var provinceId = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    }
                })
                $.ajax({
                    url: "/api/get-geography",
                    method: "POST",
                    // mặc định dữ liệu luân chuyễn dưới dạng đối tg, nếu gửi DOM thì cho = fasle
                    data: {
                        provinceId: provinceId
                    },
                    // nếu gửi và xử lí thành công thì đổ data vào div filter_data
                    success: function(data) {
                        $('#huyen').html(data)
                    }
                })
            })
            // lấy xã phưuogfn từ quận huyện
            $('#huyen').change(function() {
                // lấy id quận huyện
                var districtId = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    }
                })
                $.ajax({
                    url: "{{ route('api.renderGeography') }}",
                    method: "POST",
                    data: {
                        districtId: districtId
                    },
                    // nếu gửi và xử lí thành công thì đổ data vào div filter_data
                    success: function(data) {
                        console.log(data);
                        $('#village').html(data)
                    }
                })
            })
            // 

        })
    </script>

    {{-- paypal --}}
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        // acc login paypal: hiep18@gmail.com mk 0989581167hiep


        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AU-ccb20J5AMLn9ocWbg8hNouac6VeRno-ESrE0oSy4dbjecN3jycTVEaVY1uxyE_b9RPQp1O4td7fps',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: '0.01',
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    window.alert('Thank you for your purchase!');
                });
            }
        }, '#paypal-button');
    </script>

@endsection
