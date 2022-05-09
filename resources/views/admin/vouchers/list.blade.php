@extends('layouts.layout-admin')

@section('page-title', 'QUẢN LÍ VOUCHERS')

@section('main')
    <div class="card-body">
        <h4 class="card-title">Quản lí Vourcher</h4>

        <div class="" style="display: flex; align-items:center;">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-outline-primary btnAddVoucher mr-3" data-toggle="modal"
                data-target="#modalFormVoucher">
                Thêm mới+
            </button>

            <!-- The Modal -->
            <div class="modal" id="modalFormVoucher">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mã giảm giá </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="formVoucher" action="{{ route('voucher.store') }}" class="forms-sample"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Tên mã</label>
                                        <input name="name" type="text" class="form-control form-control-sm" id=""
                                            placeholder="Name">
                                        <label for="name" class="error" style="display: none !important;"></label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Loại giảm</label>
                                        <select name="category_code" id="category_code"
                                            class="form-control form-control-sm">
                                            <option value="0">Giảm theo %</option>
                                            <option value="1">Giảm tiền trực tiếp</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Mã code</label>
                                        <input name="code" type="text" class="form-control form-control-sm" id=""
                                            placeholder="code(ABCDEF)...">
                                        <label for="code" class="error" style="display: none !important;"></label>
                                        <p class="text-danger er-code"></p>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Số lượng</label>
                                        <input name="quantity" type="number" class="form-control form-control-sm" min="1"
                                            id="" placeholder="Số lượng ">
                                        <label for="quantity" class="error"
                                            style="display: none !important;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Mệnh giá giảm</label>
                                        <input id="discount" name="discount" type="number"
                                            class="form-control form-control-sm" maxlength="2" id="" placeholder="Giá giảm">
                                        <label for="discount" class="error"
                                            style="display: none !important;"></label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Ngày hết hạn</label>
                                        <input id="" name="expired_date" type="datetime-local"
                                            class="form-control form-control-sm" id="">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>

                    </div>
                </div>
            </div>

            <form action="" method="GET">
                <input type="search" value="{{ old('keyword') }}" name="keyword" placeholder="Enter key search"
                    class="form-control-sm" required style="height:33px;border:1px solid #ccc;border-radius:10px">
                <button class="btn btn-outline-info btn-sm">Tìm kiếm</button>
            </form>
        </div>
        @if (session('msg-er'))
            <div class="alert alert-danger">{{ session('msg-er') }}</div>
        @endif
        @if (session('msg-suc'))
            <div class=" alert alert-success">{{ session('msg-suc') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên mã</th>
                        <th>Mã code</th>
                        <th>Loại</th>
                        <th>Số lượng hiện tại
                            <a href="?_sort=true&column=quantity&type={{ $type }}"><i
                                    class="fas fa-sort"></i></a>
                        </th>
                        <th>Ngày tạo
                            <a href="?_sort=true&column=created_at&type={{ $type }}"><i
                                    class="fas fa-sort"></i></a>
                        </th>
                        <th>Ngày hết hạn
                            <a href="?_sort=true&column=expired_date&type={{ $type }}"><i
                                    class="fas fa-sort"></i></a>
                        </th>
                        <th>Tình trạng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vouchers as $key => $voucher)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $voucher->name }}</td>
                            <td>{{ $voucher->code }}</td>
                            <td>{{ $voucher->category_code == 0 ? '%' : 'vnd' }}</td>

                            <td>{{ $voucher->quantity }}</td>
                            <td>{{ $voucher->active_date }}</td>
                            <td>{{ $voucher->expired_date }}</td>
                            <td>
                                @if ($voucher->status == 1)
                                    <div class="badge badge-success">Còn hiệu lực</div>
                                @else
                                    <div class="badge badge-danger">Hết hiệu lực</div>
                                @endif
                            </td>

                            <td>
                                <a href="" onclick="
                                                    event.preventDefault()
                                                                if(confirm('Bạn chắc chắn xóa voucher?')){
                                                                    document.querySelector('#formFakeRemoveVoucher{{ $key }}').submit();
                                                                }
                                                            "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                <a href="" class="btnOpenModalEdit" data-id="{{ $voucher->id }}"><i
                                        class="fas fa-pen-square text-warning fa-2x "></i></a>

                                <form id="formFakeRemoveVoucher{{ $key }}"
                                    action="{{ route('voucher.destroy', $voucher->id) }}" method="post">
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

@section('plugin-script')
    {{-- axios --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        const erCodeEl = $('.er-code');

        function validateAddVoucher() {
            $("#formVoucher").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 6,
                        maxlength: 30,

                    },
                    code: {
                        required: true,
                        minlength: 6,
                        voucher: true
                    },
                    quantity: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    expired_date: {
                        required: true,
                        date: true,
                        dateValidate: true
                    },
                    discount: {
                        required: true,
                    }
                },

                messages: {
                    name: {
                        required: "Vui lòng nhập tên mã giảm giá !",
                        minlength: "Tên mã giảm giá ít nhất 6 kí tự!",
                        maxlength: "Tên giảm không dài quá 30 kí tự!",
                    },
                    code: {
                        required: "Vui lòng nhập mã code !",
                        minlength: "Mã code tối thiểu 6 ký tự",
                    },
                    quantity: {
                        required: "Vui lòng nhập số lượng",
                        number: "Vui lòng nhập chữ số",
                        min: "Vui lòng nhập giá trị lớn hơn 0"
                    },
                    expired_date: {
                        required: "Vui lòng nhập ngày hết hạn",
                        date: "Vui lòng nhập định dạng ngày tháng"
                    },
                    discount: {
                        required: "Vui lòng nhập giá giảm",
                        maxlength: "Vui lòng nhập giá giảm theo % từ 1-99%"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    const code = $('input[name="code"]').val();
                    // check exist = ajax
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({

                        url: "{{ route('ajax.voucherExist') }}",
                        type: "POST",
                        data: {
                            "code": code
                        },
                        success: function(data) {
                            if (data == 'not-exist') {
                                form.submit();
                            } else {
                                erCodeEl.html('Mã code đã tồn tại!')
                            }
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    })
                }
            });

            // add method validate

            // check voucher hợp lệ
            $.validator.addMethod("voucher", function(value, element) {
                return this.optional(element) || /^(?=.*[A-Za-z\d])[A-Za-z\d]{6,}$/.test(value);
            }, "Vui lòng nhập Vourcher không chứa ký tự đặc biệt");

            // check date > now date
            const today = new Date();
            // const dateNow = new date();
            $.validator.addMethod("dateValidate", function(value) {
                let values = new Date(value);
                if (values < today) {
                    return false
                }
                return true
            }, "Vui lòng nhập ngày lớn hơn hiện tại !");


            // check cate & discount
            $("#category_code").change(function() {
                var category = $(this).children("option:selected").val();
                if (category == "0") {
                    $('input[name="discount"]').prop('maxlength', "2");
                } else if (category == "1") {
                    $('input[name="discount"]').removeAttr('maxlength', "2");

                }
            });
        }

        validateAddVoucher();
    </script>

    {{-- update voucher use modal boostrap --}}
    <script>
        const modal = document.getElementById('modalFormVoucher')
        const formVoucher = document.getElementById('formVoucher')
        const btnEditModal = document.querySelectorAll('.btnOpenModalEdit');
        const apiVoucher = '/api/vouchers';
        const btnAddVoucher = document.querySelector('.btnAddVoucher');
        const titleModal = document.querySelector('.modal-title')

        // reset value khi an add
        btnAddVoucher.onclick = function() {
            formVoucher.action = '{{ route('voucher.store') }}';
            formVoucher.removeAttribute('id');
            formVoucher.setAttribute('id', 'formVoucher');

            document.querySelector('input[name="name"]').value = ''
            document.querySelector('input[name="code"]').value = ''
            document.querySelector('input[name="discount"]').value = ''
            document.querySelector('input[name="quantity"]').value = ''
            document.querySelector('input[name="expired_date"]').value = '';
        }

        // get data update voucher
        const dataVoucher = axios.get(apiVoucher)
            .then(res => {

                // get id voucher
                btnEditModal.forEach((val, index) => {
                    val.onclick = function(e) {
                        e.preventDefault();

                        // get voucher by id
                        const voucherId = val.dataset.id;
                        voucher = res.data.find(data => data.id == voucherId)
                        // open modal & render data
                        renderUpdate(voucher);

                        // handle update


                    }
                });
            })
            .catch(er => console.log(er))

        // render
        function renderUpdate(data) {
            titleModal.innerHTML = 'Chỉnh sửa mã giảm giá!';
            formVoucher.action = '';
            formVoucher.removeAttribute('id');
            formVoucher.setAttribute('id', 'formVoucherUpdate');
            elCateCode = document.querySelector('#category_code');

            // render data to modal
            let expired_date = new Date(data.expired_date);

            document.querySelector('input[name="name"]').value = data.name

            elCateCode.innerHTML = `
                <option value="0" ${data.category_code == 0 ?'selected':''}>Giảm theo %</option>
                <option value="1" ${data.category_code == 1 ?'selected':''}>Giảm tiền trực tiếp</option>
            `;

            document.querySelector('input[name="code"]').value = data.code
            document.querySelector('input[name="discount"]').value = data.discount
            document.querySelector('input[name="quantity"]').value = data.quantity
            document.querySelector('input[name="expired_date"]').value = expired_date.toISOString().slice(0, 19);
            $('#modalFormVoucher').modal('toggle');
        }
    </script>
@endsection
