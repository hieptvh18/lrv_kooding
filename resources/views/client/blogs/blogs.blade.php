
@extends('layouts.layout-client')

@section('page-title', 'Tin tức | Kooding')
@section('main')

<main class="container">
    <div class="mainheading">
        <h1 class="sitetitle"><a href="index.html">Blog Kooding</a></h1>
        <p class="lead">
            Cập nhận tin tức mới nhất của chúng tôi để biết thêm nhiều chương trình khuyến mãi
        </p>
    </div>
    <section class="featured-posts">
        <div class="section-title">
            <h2><span>Bài viết mới nhất</span></h2>
        </div>
        <div class="card-columns listfeaturedtag">
            @foreach ($newPosts as $item)
                
                <!-- begin post -->
                <div class="card">
                    <div class="row">
                        <div class="col-md-5 wrapthumbnail">
                            <a href="{{route('client.post',$item->id)}}">
                                <div class="thumbnail" style="background-image:url('{{asset('uploads')}}/{{$item->image}}');">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-7">
                            <div class="card-block">
                                <h2 class="card-title"><a href="{{route('client.post',$item->id)}}">{{$item->title}}</a></h2>
                                <h4 class="card-text">{{ substr($item->short_desc,0,100) }}...</h4>
                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="author-meta">
                                            <span class="post-name">{{$item->authors->name}}</span><br />
                                            <span class="post-date">{{$item->created_at}}</span><span class="dot"></span><span class="post-read"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end post -->
                @endforeach

        </div>
    </section>
    <section class="recent-posts">
        <div class="section-title">
            <h2><span>Tất cả bài viết</span></h2>
        </div>
        <div class="card-columns listrecent">
            @foreach ($blogs as $item)
                
                <!-- begin post -->
                <div class="card">
                    <a href="">
                        <div class="img_huan_hoa_hong">
                            <img class="img-fluid" src="{{asset('uploads')}}/{{$item->image}}" alt="">
                        </div>
                    </a>
                    <div class="card-block">
                        <h2 class="card-title"><a href="{{route('client.post',$item->id)}}">{{$item->title}}</a>
                        </h2>
                        <h4 class="card-text">{{ substr($item->short_desc,0,100) }}...</h4>
                        <div class="metafooter">
                            <div class="wrapfooter">
                                <span class="author-meta">
                                    <span class="post-name">{{$item->authors->name}}</span><br />
                                    <span class="post-date">{{$item->created_at}}</span><span class="dot"></span><span class="post-read"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end post -->
                 @endforeach

        </div>
    </section>
</main>


@endsection