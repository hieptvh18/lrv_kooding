@extends('layouts.layout-admin')

@section('page-title', 'TÀI KHOẢN NGƯỜI DÙNG')

@section('main')

    <div class="card-body">

        {{-- danh ssach giá trị của thuộc tính --}}
        <h4 class="card-title mt-3">  Quản lý tài khoản người dùng.</h4>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Thêm giá trị mới
        </button>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th> Họ tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Vai trò</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUser as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->roles->name }}</td>
                                <td>

                                    <a href="{{ route('attributeValue.destroy', $item->id) }}" onclick="
                                            event.preventDefault();
                                         if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
                                             document.querySelector('#form-del-user{{ $key }}').submit()
                                         }
                                    "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                    <form id="form-del-user{{ $key }}"
                                        action="{{ route('user.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="paginate">
                    {{-- {{ $list_attr_value->links() }} --}}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('plugin-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
