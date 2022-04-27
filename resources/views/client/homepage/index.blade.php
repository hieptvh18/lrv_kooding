@extends('layouts.layout-client')

@section('page-title', 'Trang chủ | Kooding')
@section('main')

    <main class="body__index">

        <div class="banner single-item">
            <div class="banner-item">
                <div class="banner_imgBox">
                    <img src="public/images/categories/1" alt="" width="100%">
                </div>
            </div>
            <div class="banner-item">
                <div class="banner_imgBox">
                    <img src="public/images/categories/1" alt="" width="100%">
                </div>
            </div>
        </div>
        <!-- end banner -->
        <div class="category-banner">
            @foreach ($categoryRandom as $category)
                <a href="{{ route('client.shop.category', $category->slug) }}" class="box-cate">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
        <!-- end category-banner -->
        <div class="theme-hot">
            @foreach ($categoryTop as $category)
                <div class="theme-hot__item">
                    <div class="box-img">
                        <img src="{{asset('uploads')}}/{{$category->avatar}}" alt="">
                    </div>
                    <div class="theme-hot__title mt-3">
                        {{$category->name}}
                    </div>
                    <span>Bộ sưu tập hàng cao cấp</span>
                    <a href="{{ route('client.shop.category', $category->slug) }}" class="btn-theme">Khám phá ngay</a>
                </div>
            @endforeach
        </div>
        <!-- end theme hot -->
        <div class="product-news">
            <div class="product-news__title mb-3">
                <div class="title-text">
                    mới: 10+ sản phẩm mới hàng ngày
                </div>
                <!-- <div class="toggle-filter " style="display: flex;align-items: center;">
                            <span class="pb-2 pr-3">Nam</span>
                            <div class="ckbx-style-8">
                                <input type="checkbox" id="filter_new" value="0" name="ckbx-style-8">
                                <label for="filter_new"></label>
                            </div>
                            <span class="pb-2 pl-4">Nữ</span>
                        </div> -->
            </div>
            <div class="slick__slider">

                <div class="pro-news-slider slide-news" id="slide-top-pros">

                    @foreach ($productsNew as $pro)
                        <a href="{{ route('client.shop.detail', ['slug' => $pro->slug, 'id' => $pro->id]) }}"
                            class="pro-news-item">
                            <img src="{{ asset('uploads') }}/{{ $pro->avatar }}" alt="">
                            <div class="">
                                <div class="pro-name bg-white pt-2 text-center">
                                    {{ $pro->name }}
                                </div>
                                <div class="pro-des bg-white">
                                    <span> {{ number_format($pro->price - $pro->discount, 0, ',') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
        <!-- end pro-news -->
        <!--  -->
        <div class="news-main">
            <div class="col-news left">

                {{-- loop --}}
                <div class="news-item mb-4">
                    <a href="newsClient?action=viewDetail&id=" class="box-img">
                        <div class="box_newsImg">
                            <!-- <img src="public/images/layout/188906b2571586bae5d3dd009b56647f019b6145.jpg" alt=""> -->
                            <img src="./public/images/upload/" alt="">
                        </div>

                    </a>
                    <div class="pro-name">
                        pro name
                    </div>
                    <span><?= substr('bl abl short desc', 0, 200) ?></span>
                    <a href="newsClient?action=viewDetail&id=" class="btn-discover mt-2">
                        KHÁM PHÁ
                    </a>
                </div>
            </div>
            <div class="col-news right">
                <div class="news-item">
                    <a href="newsClient?action=viewDetail&id=" class="box-img">
                        <div class="box_newsImg ss2">
                            <!-- <img src="public/images/layout/261d0a0ba82f5e1c2b6b03fb85b850b687c0e93f.jpg" alt=""> -->
                            <img src="./public/images/upload/" alt="">
                        </div>
                    </a>
                    <div class="pro-name">
                        pro name
                    </div>
                    <span><?= substr('short desc bla bla', 0, 200) ?></span>
                    <a href="newsClient?action=viewDetail&id=" class="btn-discover mt-2">
                        KHÁM PHÁ
                    </a>
                </div>
            </div>
        </div>
        <!-- end new-main -->
        <div class="product-news trending">
            <div class="product-news__title mb-3">
                <div class="title-text">
                    Đang là xu hướng
                </div>
                <!-- <div class="toggle-filter " style="display: flex;align-items: center;">
                            <span class="pb-2 pr-3">Nam</span>
                            <div class="ckbx-style-8">
                                <input type="checkbox" id="trending" value="0" name="ckbx-style-8">
                                <label for="trending"></label>
                            </div>
                            <span class="pb-2 pl-4">Nữ</span>
                        </div> -->
            </div>
            <!-- xu hướng -->
            <div class="slick__slider">
                <div class="pro-news-slider slide-news" id="slide-trending">

                    @foreach ($productsTopView as $pro)
                        {{-- loop top view --}}
                        <a href="{{ route('client.shop.detail', ['slug' => $pro->slug, 'id' => $pro->id]) }}"
                            class="pro-news-item">
                            <img src="{{ asset('uploads') }}/{{ $pro->avatar }}" alt="">
                            <div class="pro-name bg-white pt-2 text-center">
                                {{ $pro->name }}
                            </div>
                            <div class="pro-des bg-white">
                                <?= substr($pro->description, 0, 25) . '...' ?>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- end trending -->
        <div class="about-us" id="introduce">
            <div class="title text-center">
                <h5>render title</h5>
            </div>
            <div id="times" class="btn__times">+</div>
            <div id="minus" class="btn__minus none">-</div>
            <div class="background__overlay"></div>
            <div class="site__intro show1">
                render intro
            </div>
        </div>

        <!-- end album ,slider 3 -->

        <div class="slider-album pb-4">
            <div class="slide-title text-center pt-4 pb-2 text-light">
                <h3>#render web name</h3>
                <p>Chia sẽ khoảnh khắc của bạn với KOODING TRÊN <i class="fab fa-instagram text-light"
                        aria-hidden="true"></i> hoặc <i class="fab fa-twitter text-light" aria-hidden="true"></i>

                </p>
            </div>
            <!-- album -->
            <div class="slick__slider">
                <div class="slider-album__content pb-3">
                    <a href="{{ route('client.social') }}#lg=1&slide=0" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 282
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/1.jpg') }}" alt="">
                        </div>

                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=2" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 228
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/3.jpg') }}" alt="">
                        </div>

                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=3" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 18
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/4.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=11" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 338
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/12.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=1" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 48
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/2.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=8" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 298
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/15.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=15" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 280
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/17.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=17" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 28
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/19.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=16" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 21
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/18.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="{{ route('client.social') }}#lg=1&slide=10" class="album_link">
                        <div class="album__overlay">
                            <div class="album__overlay_icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="album__overlay_tim">
                                ♥ 58
                            </div>
                        </div>
                        <div class="slider_album_boxImg">
                            <img src="{{ asset('assets/images/album/11.jpg') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
            <a href="{{ route('client.social') }}" class="album-button ">
                Xem thư viện
            </a>
        </div>
        <!-- end slide album -->
        <div class="press-bar">
            <a href="">
                <img src="{{ asset('assets') }}/images/layout/soompi.png" alt="">
            </a>
            <a href="">
                <img src="{{ asset('assets') }}/images/layout/buzzfeed.png" alt="">
            </a>
            <a href="">
                <img src="{{ asset('assets') }}/images/layout/klog.png" alt="">
            </a>
            <a href="">
                <img src="{{ asset('assets') }}/images/layout/chinabrands.png" alt="">
            </a>
        </div>
        <!-- end press -->
    </main>
    <!-- end main -->

@endsection
<!-- js -->
