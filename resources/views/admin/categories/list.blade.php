@extends('layouts.layout-admin')

@section('page-title', 'Quan li danh muc');
@section('main')
    <div class="card-body">
        <h4 class="card-title">Danh sách danh muc</h4>
        <div class="" style="display: flex;">
            <a href="{{ route('categories.create') }}" class="text-light btn btn-primary">Thêm mới</a>
        </div>


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Thuoc tinh</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $cate)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $cate->name }}</td>
                            <td><img src="{{ asset('uploads') }}/{{ $cate->avatar }}" alt="" width="50px"></td>
                            <td>
                                @foreach (getAttrByCate($cate->id) as $attr)
                                    <p>{{ $attr->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $cate->id) }}"><i
                                        class="fas fa-pen-square text-warning fa-2x "></i></a>
                                <a href="{{ route('categories.destroy', $cate->id) }}" onclick="
                                    event.preventDefault();
                                    document.querySelector('#form-del-cate{{ $key }}').submit()
                            "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                {{-- fake method --}}
                                <form id="form-del-cate{{ $key }}"
                                    action="{{ route('categories.destroy', $cate->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
