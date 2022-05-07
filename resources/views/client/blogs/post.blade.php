
@extends('layouts.layout-client')

@section('page-title', 'Tin tức | Kooding')
@section('main')

<main class="container">
    <div class="mainheading">
        <h1 class="sitetitle concax"><a href="{{route('client.news')}}">Blog Kooding</a></h1>
        <p class="lead">
            {{$post->short_desc}}
        </p>
    </div>
    <div class="conten_news">
        {{$post->content}}
    </div>
    <div class="graybg">
        <div class="container">
            <div class="row listrecent listrelated">
                @foreach ($postRelate as $item)
                    
                    <!-- begin post -->
                    <div class="col-md-4">
                        <div class="card">
                            <a class="post_link_img" href="post.html">
                                <img class="img-fluid img-thumb" src="{{asset('uploads')}}/{{$item->image}}" alt="">
                            </a>
                            <div class="card-block">
                                <h2 class="card-title"><a href="">{{ substr($item->title,0,30) }}</a></h2>
                                <h4 class="card-text">
                                {{ substr($item->short_desc,0,120) }}...
                                </h4>
                                <div class="metafooter">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end post -->
              @endforeach


            </div>
        </div>
    </div>
</main>

@endsection