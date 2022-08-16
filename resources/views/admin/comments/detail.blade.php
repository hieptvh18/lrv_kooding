@extends('layouts.layout-admin')

@section('page-title', 'Bình luận sản phẩm')
@section('main')
    <div class="card-body">
        <h4 class="card-title">Danh sách Bình luận</h4>
        <a href="{{ route('comment.index') }}" class=""><i class="fa fa-long-arrow-left mr-1 mb-1"></i>Quay lại trang
            Tổng hợp
            bình luận</a>
        <form action="{{ route('comment.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="checked text-center mb-3">
                <button id="check-all" type="button" class="btn btn-primary">Chọn tất cả</button>
                <button id="clear-all" type="button" class="btn btn-info" style="display: none;">Bỏ chọn tất cả</button>

                <button onclick="
                    event.preventDefault();
                    if(confirm('Bạn chắc chắn muốn xóa comment đã chọn?')){
                        this.form.submit();
                    }
                " id="btn-delete" name="btn_del_cmt" type="submit" class="btn btn-danger ">Xóa các mục chọn<i
                        class="fa fa-trash-o ml-2" aria-hidden="true"></i></button>
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
                            <th>Chọn</th>
                            <th>ID</th>
                            <th>Người bình luận</th>
                            <th>Nội dung</th>
                            <th>Thời gian bình luận</th>
                        </tr>
                    </thead>
                    <tbody class="list-product">
                        @foreach ($comments as $comment)
                            <tr>
                                <th><input type="checkbox" name="cmt_id[]" value="{{ $comment->id }}"
                                        class="inpt-checkbox">
                                </th>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ $comment->created_at }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <!-- js -->
    <script>
        $(document).ready(function() {
            $("#check-all").click(function() {

                $(":checkbox").prop("checked", true);
                $('#clear-all').css("display", "inline-block");
                $('#check-all').css("display", "none");
            });
            $("#clear-all").click(function() {
                $(":checkbox").prop("checked", false);
                $('#clear-all').css("display", "none");
                $('#check-all').css("display", "inline-block");
            });
            $("#btn-delete").click(function() {
                if ($(":checked").length === 0) {
                    alert("Vui lòng chọn ít nhất một mục!");
                    return false;
                }
            });
        });
    </script>

@endsection
