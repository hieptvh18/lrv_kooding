@extends('layouts.layout-admin')

@section('page-title', 'QUẢN LÍ KHO HÀNG')

@section('main')

    <div class="card-body">
        <h4 class="card-title text-center">KHO HÀNG</h4>
        @if (session('msg-er'))
            <div class="alert alert-danger">{{ session('msg-er') }}</div>
        @endif
        @if (session('msg-suc'))
            <div class="alert alert-success">{{ session('msg-suc') }}</div>
        @endif
        <div class="mess-alert"></div>

        <div class="search ">
            <form action="" method="GET" class="d-flex">
                <input type="search" value="{{ old('keyword_stock') }}" name="keyword_stock" placeholder="search category"
                    class="form-control-sm" style="height:33px;border:1px solid #ccc;border-radius:10px">
                <button class="btn btn-outline-info btn-sm">Tìm kiếm</button>
            </form>
        </div>

        @if ($listProductStock->count() > 0)

            <form action="{{ route('stock.updateAll') }}" method="POST" class="table-responsive mt-2">
                @csrf
                @method('put')
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ml-2">
                        @if ($searchTitle)
                            <h6>{{ $searchTitle }}</h6>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-info btn-sm mb-2 ">Cập nhật SL số mới</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr class="">
                            <th>STT</th>
                            <th>Sản phẩm <a href="?sort_by=name&sort_type={{ $sortType }}"><i class="fa fa-sort ml-2"
                                        aria-hidden="true"></a></i>
                            </th>
                            <th>Loại sản phẩm</th>
                            <th>Sku</th>
                            {{-- <th>Tình trạng</th> --}}
                            <th>Số lượng hiện tại<a href="?sort_by=quantity&sort_type={{ $sortType }}"><i
                                        class="fa fa-sort ml-2" aria-hidden="true"></a></th>
                            <th>Thêm số lượng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="list-product">
                        @foreach ($listProductStock as $key => $val)
                            <tr>
                                <input type="hidden" name="stock_id[]" value="{{ $val->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td class="d-flex align-item-center">
                                    <div class="mr-2">
                                        <img src="{{ asset('uploads') }}/{{ $val->products->avatar }}" width="50px"
                                            alt="">
                                    </div>
                                    <div class="">
                                        <h6>{{ $val->products->name }}</h6>
                                        <span>{{ getAttributeValue($val->size_id)->value }}</span> -
                                        <span>{{ getAttributeValue($val->color_id)->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $val->products->categories->name }}</td>
                                <td>{{ $val->sku }}</td>
                                {{-- <td></td> --}}
                                <td>{{ $val->quantity }}</td>
                                <td><input type="number" min="0" value="0" name="new_quantity[]" placeholder="SL"
                                        style="width:70px;">
                                    @error('new_quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    {{-- remove item --}}
                                    <a href="{{ route('stock.destroyVariant', $val->id) }}" onclick="
                                            event.preventDefault();
                                            if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){

                                                document.querySelector('#formFakeRemovePro{{ $key }}').submit()
                                            }
                                            "><i class="fas fa-trash-alt text-danger fa-1x ml-3"></i></a>

                                    {{-- form fake method remove --}}
                                    <form action="{{ route('stock.destroyVariant', $val->id) }}"
                                        id="formFakeRemovePro{{ $key }}" method="POST">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <div class="paginate">
                    {{ $listProductStock->links() }}
                </div>

            </form>
        @else
            <p class="mt-5 text-center">Không tìm thấy sản phẩm nào!</p>
        @endif

    </div>

    <!-- js -->

@endsection

@section('script')

@endsection
