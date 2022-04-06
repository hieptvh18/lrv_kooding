@extends('layouts.layout-admin')

@section('page-title', 'QUẢN LÍ SẢN PHẨM')

@section('main')

    <div class="card-body">
        <h4 class="card-title">Danh sách sản phẩm</h4>
        @if (session('msg-er'))
            <div class="alert alert-danger">{{ session('msg-er') }}</div>
        @endif
        @if (session('msg-suc'))
            <div class="alert alert-success">{{ session('msg-suc') }}</div>
            @endif
        <div class="mess-alert"></div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <a href="{{ route('product.create') }}" class="text-light btn btn-primary btn-sm">Thêm mới +</a>
                {{-- filter by category --}}
                <div class="dropdown ml-2 mr-2">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" id="dropDownCate" aria-expanded="false">
                      Filter by category
                    </button>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        @foreach ($listCategory as $key=>$category)
                            <a href="{{route('product.index')}}?filterByCategory={{$category->id}}" class="dropdown-item">{{$category->name}}</a>
                        @endforeach

                    </div>
                  </div>
                <form action="" method="GET">
                        <input type="search" value="{{old('keyword')}}" name="keyword" placeholder="Enter key search" class="form-control-sm" style="height:33px;border:1px solid #ccc;border-radius:10px">
                        <button class="btn btn-info btn-sm">Tìm kiếm</button>
                </form>
            </div>
            <div class="">
                <button class="btn btn-sm btn-danger" id="btnRemoveAll">Xóa tất cả</button>
                <input type="checkbox" class="form-check-label" id="btnCheck"> <label for="btnCheck" >
                    check all</label>
            </div>
        </div>

        <div class="title-search mt-4 mb-4">
            @if ($title)
                <h4> {{$title}}</h4>
            @endif
        </div>

        @if ($listProduct->count() > 0)
            
        <div class="table-responsive">
            <table class="table table-list-product">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Tên 
                            <a href="{{route('product.index')}}?sortName={{$sortName}}"><i class="fas fa-sort"></i></a>
                        </th>
                        <th>Thương hiệu</th>
                        <th>Danh mục</th>
                        <th>Giá.
                        </th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                        <th>Tình trạng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="list-product">
                    @foreach ($listProduct as $key => $val)
                        <tr>
                            <td>
                                <input type="checkbox" data-id={{$val->id}} value="{{$val->id}}">
                            </td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->brands->name }}</td>
                            <td>{{ $val->categories->name }}</td>
                            <td>{{ number_format($val->price, 0) }}vnd</td>
                            <td><img src="{{ asset('uploads/' . $val->avatar) }}" alt=""> </td>
                            <td>{{$val->quantity}}</td>
                            <td>
                                @if ($val->quantity == 0)
                                    <label class="badge badge-danger">Hết hàng</label>
                                @else
                                    <label class="badge badge-success">Còn hàng</label>
                                @endif

                            </td>
                            <td>
                                <a  href="{{ route('stock.create', $val->id) }}"><i
                                        class="fas fa-eye text-info fa-2x "></i></a>
                                <a href="{{ route('product.edit', $val->id) }}"><i
                                        class="fas fa-pen-square text-warning fa-2x "></i></a>
                                <a href="{{ route('product.destroy', $val->id) }}" onclick="
                                        event.preventDefault();
                                         if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
                                             document.querySelector('#formFakeRemovePro{{ $key }}').submit()
                                         }
                                        "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                {{-- form fake method remove --}}
                                <form action="{{ route('product.destroy', $val->id) }}"
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
                {{ $listProduct->links() }}
            </div>

        </div>
        @else
            <p class="mt-5 text-center">Không tìm thấy sản phẩm nào!</p>
        @endif

    </div>
    <div id="output"></div>

    <!-- js -->

    {{-- form fake method remove --}}
    <form id="" name="formFakeRemoveMuntiple" method="POST">
        @method('DELETE')
        @csrf
        <input type="hidden" value="" name="pro_id">
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("#btnCheck").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $('#btnRemoveAll').click(function(){
                if(!$('table input:checkbox').is(':checked')){
                    alert('Cần chọn ít nhất 1 sản phẩm để xóa!')
                    return false;
                }

                // thực hiện gửi data và xóa mảng
                if (confirm("Bạn chắc chắn xóa các sản phẩm đã chọn?")) {
                    var idArr = [];
                    $('table input:checked').each(function(){
                        idArr.push($(this).attr('data-id'))
                    });

                    // use form fake 
                    formFakeDelMuntiple = document.forms['formFakeRemoveMuntiple']
                    formFakeDelMuntiple.action = "{{route('product.removeMuntiple')}}";
                    $('input[name="pro_id"]').attr('value',idArr)
                    formFakeDelMuntiple.submit();
                   
                    // use ajax -> controller
                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });
                    // $.ajax({
                    //     url:'{{route('product.removeMuntiple')}}',
                    //     type:"DELETE",
                    //     data:"id="+idArr,
                    //     success:function(data){
                    //         $('.mess-alert').html(data),

                    //     },
                    //     error:function(er){
                    //         console.log(er)
                    //     }
                    // })

                }
                 
            })
        });
    </script>
@endsection
