@extends('layouts.layout-client')

@section('page-title', 'Chi tiết sản phẩm | Kooding')
@section('main')

<main>
    <div class="d-flex jsutify-content-center align-items-center text-light p-3">
        @if (session('msg-suc'))
            <div class="bg-success text-light p-2">{{session('msg-suc')}}</div>
            <a href="{{route('client.profile')}}">Theo dõi đơn của bạn!</a>
        @endif
    </div>
</main>


@endsection