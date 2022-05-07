@extends('layouts.layout-admin')

@section('page-title', 'News')
@section('main')


<div class="card-body">
    <h4 class="card-title">Danh sách Tin tức</h4>
    <div class="" style="display: flex;">
        <a href="{{route('news.create')}}" class="text-light btn btn-primary">Thêm mới</a>

    </div>
    @if (session('msg-suc'))
        <div class="alert alert-success">{{session('msg-suc')}}</div>
    @endif
    @if (session('msg-er'))
    <div class="alert alert-danger">{{session('msg-er')}}</div>
@endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ảnh đại diện</th>
                    <th>Ngày viết</th>
                    <th>Ngày cập nhật</th>
                    <!-- <th>Số lượng</th> -->
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $key=>$item) 
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->authors->name}}</td>
                        <td><img src="{{asset('uploads')}}/{{$item->image}}" alt=""></td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>

                        <td>
                            <a href="{{route('news.edit',$item->id)}}"><i class="fas fa-pen-square text-warning fa-2x "></i></a>
                            <a href="{{route('news.destroy',$item->id)}}" onclick="
                            event.preventDefault()
                            if(confirm('Bạn chắc chắn muốn xóa sản phẩm?')){
                                document.getElementById('formFakeRemoveNews{{$key}}').submit()
                            }
                            "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                            <form action="{{route('news.destroy',$item->id)}}" method="post" id="formFakeRemoveNews{{$key}}">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection