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
                <a href="{{ route('product.create') }}" class="text-dark btn btn-outline-primary btn-sm">Thêm mới +</a>
                {{-- filter by category --}}
                <div class="dropdown ml-2 mr-2">
                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                        id="dropDownCate" aria-expanded="false">
                        Filter by category
                    </button>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="notificationDropdown">
                        @foreach ($listCategory as $key => $category)
                            <a href="{{ route('product.index') }}?filterByCategory={{ $category['id'] }}"
                                class="dropdown-item">{{ str_repeat('---', $category['level']) }}{{ $category['name'] }}</a>
                        @endforeach

                    </div>
                </div>
                <form action="" method="GET">
                    <input type="search" value="{{ old('keyword') }}" name="keyword" placeholder="Enter key search"
                        class="form-control-sm" required style="height:33px;border:1px solid #ccc;border-radius:10px">
                    <button class="btn btn-outline-info btn-sm">Tìm kiếm</button>
                </form>
            </div>
            <div class="">
                <button class="btn btn-sm btn-outline-danger" id="btnRemoveAll">Xóa tất cả</button>
                <input type="checkbox" class="form-check-label" id="btnCheckAll"> <label for="btnCheckAll">
                    check all</label>
            </div>
        </div>

        <div class="mt-2 d-flex justify-content-end">
            <a href="{{ route('products.export') }}" class="btn btn-sm btn-primary mr-3">Export excel
                <i class="far fa-file-export"></i>
            </a>

            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalImport">
                Import excel
                <i class="far fa-file-import"></i>
            </button>

            <!-- Modal -->
            <div class="modal" id="modalImport">
                <div class="modal-dialog modal-md   ">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Nhập dữ liệu từ file </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="formImport" name="formImport" action="{{ route('products.import') }}" class="forms-sample"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="file" name="file" id="file" class="form-control form-control-sm">
                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                </div>
                                <small class="er-file-import text-danger"></small>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="title-search mt-4 mb-4">
            @if ($title)
                <h4> {{ $title }}</h4>
            @endif
        </div>

        @if ($products->count() > 0)

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Tên
                                <a href="{{ route('product.index') }}?_sort=true&column=name&type={{ $type }}"><i
                                        class="fas fa-sort"></i></a>
                            </th>
                            <th>Thương hiệu</th>
                            <th>Danh mục</th>
                            <th>Giá.
                                <a href="{{ route('product.index') }}?_sort=true&column=price&type={{ $type }}"><i
                                        class="fas fa-sort"></i></a>
                            </th>
                            <th>Ảnh</th>
                            <th>Số lượng
                                <a
                                    href="{{ route('product.index') }}?_sort=true&column=quantity&type={{ $type }}"><i
                                        class="fas fa-sort"></i></a>
                            </th>
                            <th>Tình trạng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="list-product">
                        @foreach ($products as $key => $val)
                            <tr>
                                <td>
                                    <input type="checkbox" data-id={{ $val->id }} name="proIds[]"
                                        value="{{ $val->id }}">
                                </td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->brands->name }}</td>
                                <td>{{ $val->categories->name }}</td>
                                <td>{{ number_format($val->price, 0) }}vnd</td>
                                <td><img src="{{ asset('uploads/' . $val->avatar) }}" alt=""> </td>
                                <td>{{ $val->quantity }}</td>
                                <td>
                                    @if ($val->status == 0)
                                        <button class="badge badge-danger status btn-status" data-status="1"
                                            data-id="{{ $val->id }}">Ẩn</button>
                                    @else
                                        <button class="badge badge-success status btn-status" data-status="0"
                                            data-id="{{ $val->id }}">Hiện</button></label>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <div class="mr-2">
                                        <a href="{{ route('stock.create', $val->id) }}"><i
                                                class="fa fa-plus text-info fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="mr-2">
                                        <a href="{{ route('product.edit', $val->id) }}"><i
                                                class="fas fa-pen-square text-warning fa-2x "></i></a>
                                    </div>
                                    <div class="">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="paginate">
                    {{ $products->links() }}
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
            const proIdsEl = $('input[name="proIds[]"]');
            const btnChangeStatus = document.querySelectorAll('.btn-status');
            const formImport = $('#formImport');

            // change status product
            btnChangeStatus.forEach((val, index) => {
                const status = val.dataset.status;
                const proId = val.dataset.id;

                val.onclick = function() {

                    if (!confirm('Bạn chắc chắn thay đổi trạng thái?')) {
                        return;
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    $.ajax({
                        url: '/api/ajax/change-status-product',
                        type: 'POST',
                        data: {
                            proId: proId,
                            status: status
                        },
                        success: function(data) {
                            if (data == 1) {
                                window.location.reload();
                            } else {
                                alert(
                                    'Không thể thay đổi trạng thái active cho sản phẩm không tồn tại trong kho!'
                                );
                            }
                        },
                        error: function(er) {
                            console.log(er);
                            alert('Có lỗi xảy ra! vui lòng thử lại!');
                        }
                    })
                }
            })

            $("#btnCheckAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
                disabledCheckAll()
            });

            proIdsEl.click(function() {
                disabledCheckAll()
            })

            $('#btnRemoveAll').click(function() {
                if (!$('table input:checkbox').is(':checked')) {
                    alert('Cần chọn ít nhất 1 sản phẩm để xóa!')
                    return false;
                }

                // thực hiện gửi data và xóa mảng
                if (confirm("Bạn chắc chắn xóa các sản phẩm đã chọn?")) {
                    var idArr = [];
                    $('table input:checked').each(function() {
                        idArr.push($(this).attr('data-id'))
                    });

                    // use form fake 
                    formFakeDelMuntiple = document.forms['formFakeRemoveMuntiple']
                    formFakeDelMuntiple.action = "{{ route('product.removeMuntiple') }}";
                    $('input[name="pro_id"]').attr('value', idArr)
                    formFakeDelMuntiple.submit();

                }

            })

            // count checked disabled checkall
            function disabledCheckAll() {
                if ($('table input:checked').length !== $('table input:checkbox').length) {
                    $("#btnCheckAll").prop('checked', false)
                } else {
                    $("#btnCheckAll").prop('checked', true)

                }
            }


            // validate form import
            formImport.submit(function(e) {
                e.preventDefault();

                const input_element = $('#file');
                var fileName = input_element.val();
                var allowed_extensions = new Array("xlsx", "csv");
                var file_extension = fileName.split('.').pop();
                for (var i = 0; i < allowed_extensions.length; i++) {
                    if (allowed_extensions[i] == file_extension) {
                        // true 
                        document.forms['formImport'].submit();
                        return;
                    }
                }

                // false
                $('.er-file-import').html('Chỉ chấp nhận file .csv hoặc xlsx');
            })
        });
    </script>
@endsection
