@extends('layouts.layout-admin')

@section('page-title', 'TÀI KHOẢN NGƯỜI DÙNG')

@section('main')

    <div class="card-body">

        {{-- danh ssach giá trị của thuộc tính --}}
        <h4 class="card-title mt-3"> Quản lý tài khoản người dùng.</h4>
        <!-- Button to Open the Modal -->
        <a href="{{route('user.create')}}" class="btn btn-outline-primary">
            Tạo mới+
        </a>

        <div class="card-body">
            @if (session('msg-er'))
                <div class="text-danger">{{ session('msg-er') }}</div>
            @endif
            @if (session('msg-suc'))
                <div class="text-success">{{ session('msg-suc') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th> Họ tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Vai trò 
                                <a href="?sortBy=name&sortType=desc"><i
                                    class="fas fa-sort"></i></a>
                            </th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUser as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <div class="badge badge-success">
                                        {{ $user->roles->name }}
                                    </div>
                                </td>
                                <td>

                                    <a href="{{ route('attributeValue.destroy', $user->id) }}" onclick="
                                                event.preventDefault();
                                             if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
                                                 document.querySelector('#form-del-user{{ $key }}').submit()
                                             }
                                        "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                                        <a href="{{route('user.edit',$user->id)}}"><i class="fas fa-pen-square text-warning fa-2x "></i></a>

                                    <form id="form-del-user{{ $key }}"
                                        action="{{ route('user.destroy', $user->id) }}" method="POST">
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
