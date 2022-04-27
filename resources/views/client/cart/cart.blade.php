@extends('layouts.layout-client')

@section('page-title', 'Cửa hàng | Kooding')
@section('main')

    <main class="body__cart">
        <div class="body__cart__title">
            <h3>Giỏ hàng mua sắm</h3>
        </div>

        {{-- 2 case login or session --}}
        @if (session('msg-suc'))
            <div class="bg-success text-light p-2">{{ session('msg-suc') }}</div>
        @elseif (session('msg-er'))
            <div class="bg-danger text-light p-2">{{ session('msg-er') }}</div>
        @endif
        @if (session('carts') && count(session('carts')) != 0)
            <div class="cart__content">
                <div class="cart__checkout">
                    <div class="cart__checkout__title">
                        <span class="cart__title__text1">Những hạng mục của bạn</span>
                        <span class="cart__title__text2">Số lượng</span>
                        <span class="cart__title__text3">Giá vật phẩm</span>
                    </div>
                    <div class="cart__checkout__content">
                        <ul class="cart__items">
                            @php
                                $total = 0;
                            @endphp
                            @foreach (session('carts') as $key => $item)
                                @php
                                    $thanhtien = $item['price'] * $item['quantity'];
                                @endphp
                                <li class="ci__wrap">
                                    <div class="ci__wrap__content">
                                        <div class="cart__left">
                                            <div class="cart__left__img">
                                                <a
                                                    href="{{ route('client.shop.detail', ['slug' => $item['slug'], 'id' => $item['product_id']]) }}">
                                                    <img src="{{ asset('uploads') }}/{{ $item['avatar'] }}" alt=""
                                                        width="100%"></a>
                                            </div>
                                            <div class="cart__left__info">
                                                <p>{{ \App\Models\Product::find($item['product_id'])->name }}</p>
                                                <span class="db">Thường giao hàng trong 4-8 ngày làm việc</span>
                                                <div class="cart__info__size">
                                                    <span>Màu
                                                        {{ \App\Models\AttributeValue::find($item['color_id'])->name }}</span>
                                                    <span>|</span>
                                                    <span>Size
                                                        {{ \App\Models\AttributeValue::find($item['size_id'])->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart__quanty">
                                            <form action="{{route('client.cart.update')}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                                <input type="hidden" name="color_id" value="{{ $item['color_id'] }}">
                                                <input type="hidden" name="size_id" value="{{ $item['size_id'] }}">
                                                <input type="number" name="quantity" min="1" step="0"
                                                    value="{{ $item['quantity'] }}">
                                                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="cart__price">
                                            <span>{{ number_format($thanhtien, 0, ',') }}đ</span>
                                        </div>
                                    </div>
                                    <div class="cart__remove">
                                        <a href="{{ route('client.cart.remove', $item['id']) }}" onclick="
                                                    event.preventDefault();
                                                    document.forms['formFakeRemoveCart'].submit();
                                                " class="text-danger">Xóa</a>
                                        {{-- form fake --}}
                                        <form action="{{ route('client.cart.remove', $item['id']) }}"
                                            name="formFakeRemoveCart" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </li>
                                @php
                                    $total += $thanhtien;
                                @endphp
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="cart__order">
                    <div class="cart__order__title">
                        <span>Tóm tắt theo thứ tự</span>
                    </div>
                    <div class="cart__order__content">
                        <div class="cart__sum__price">
                            <div class="sum__price__text">
                                <span>Tổng phụ</span>
                            </div>
                            <div class="sum__price__dola">
                                <span><?= number_format($total, 0, ',') ?>đ</span>
                            </div>
                        </div>
                        <div class="cart__btn__order">
                            <a href="checkoutClient?action=checkout">
                                <button type="button">Thủ tục thanh toán</button>
                            </a>
                        </div>
                        <div class="cart__bottom">
                            <span>Bạn kiếm được 3,92 đô la phần thưởng cho đơn đặt hàng này!</span> <br> <br>
                            <span>Phần thưởng sẽ được thêm vào tài khoản của bạn sau khi đơn hàng đã được vận chuyển đầy
                                đủ. Số
                                tiền thưởng có thể thay đổi.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="body__cart__title" id="title2">
                <h3>Đề xuất cho bạn</h3>
            </div>
            <div class="slick__slider">
                <div class="cart__allItem slide-news">
                    @foreach ($recommened as $item)
                        <div class="cart__item">
                            <div class="cart__item__img">
                                <a href="{{ route('client.shop.detail', ['slug' => $item->slug, 'id' => $item->id]) }}">
                                    <img src="{{ asset('uploads') }}/{{ $item->avatar }}" alt="" width="100%">
                                </a>
                            </div>
                            <div class="cart__item__Name">
                                <p>{{ $item->name }}</p>
                            </div>
                            <div class="cart__item__PC">
                                <div class="cart__item__price">
                                    <p>{{ number_format($item->price - $item->discount, 0, ',') }}đ</p>
                                </div>
                                <div class="cart__item__color">

                                    <img src="{{ asset('assets/images/layout/colorwheel-2.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @else
            <div class="DH__content__body">
                <div class="">
                    <h3 class="" style="color:#FFBC7F;">Giỏ hàng của bạn đang rỗng!</h3>
                    <a href="{{ route('client.shop') }}" class="text-primary text-center">Mua sắm ngay</a>
                </div>
                <div class="">
                    <img src="{{asset('assets/images/layout/empty-orders.jpg')}}" alt="">
                </div>
            </div>
        @endif
    </main>
    <?php if (!empty($data['toggle_modal'])) {
        echo $data['toggle_modal'];
    } ?>
    <!-- end main -->
@endsection
@section('plugin-script')


@endsection
