@extends('layouts.layout-admin')

@section('page-title', 'Bình luận sản phẩm')
@section('main')

    <div class="card-body">
        <h4 class="card-title">Tổng hợp bình luận</h4>
        <div class="" style="display: flex;">
            <select name="categories" id="categories" style="border-radius: 15px;">
                <option value="" disabled selected>Lọc theo danh mục</option>
                <option value="">Tất cả sản phẩm</option>

            </select>
        </div>
        @if (session('msg-suc'))
            <div class="alert alert-success">{{ session('msg-suc') }}</div>
        @endif
        @if (session('msg-er'))
            <div class="alert alert-danger">{{ session('msg-er') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Số bình luận</th>
                        <th>Mới nhất</th>
                        <th>Cũ nhất</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="list-product">
                    @foreach ($productComments as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->cmt_new }}</td>
                                <td>{{ $item->cmt_old }}</td>
                                <td>
                                    <a href="{{route('comment.detail',$item->id)}}" class="btn btn-primary">Danh sách bình luận</a>
                                </td>
                            </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="paginate">
                {{ $productComments->links() }}
            </div>
        </div>
    </div>
    <div id="output"></div>

    <!-- js -->
@endsection
