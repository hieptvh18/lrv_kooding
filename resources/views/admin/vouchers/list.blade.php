@extends('layouts.layout-admin')

@section('page-title', 'QUẢN LÍ VOUCHERS')

@section('main')
    <div class="card-body">
        <h4 class="card-title">Quản lí Vourcher</h4>
        <div class="" style="display: flex; align-items:center;">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
                Thêm mới+
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mã giảm giá </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="form_vourcher" action="" class="forms-sample" method="POST">
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
                                        <select name="category_code" id="driveaway" class="form-control form-control-sm">
                                            <option value="y">Giảm theo %</option>
                                            <option value="n">Giảm tiền trực tiếp</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Mã code</label>
                                        <input name="code" type="text" class="form-control form-control-sm" id=""
                                            placeholder="code(ABCDEF)...">
                                        <label for="code" class="error" style="display: none !important;"></label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Số lượng</label>
                                        <input name="quantity" type="number" class="form-control form-control-sm" min="1"
                                            id="" placeholder="Số lượng " value="1">
                                        <label for="quantity" class="error"
                                            style="display: none !important;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Mệnh giá giảm</label>
                                        <input id="discount" name="discount" type="number"
                                            class="form-control form-control-sm" id="" placeholder="Giá giảm" maxlength="2">
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

            <div class="filter ml-3">
                <select name="filter_status" id="">
                    <option value="" disabled selected>Lọc mã</option>
                    <option value="1">Còn hiệu lực</option>
                    <option value="0">Hết hiệu lực</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên mã</th>
                        <th>Mã code</th>
                        <th>Giá giảm</th>
                        <th>Số lượng hiện tại</th>
                        <th>Ngày tạo</th>
                        <th>Ngày hết hạn</th>
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
                            <td><?php if ($item['cate_code'] == 1) {
                                echo $item['discount'] . '%';
                            } else {
                                echo $item['discount'] . 'vnd';
                            } ?></td>

                            <td>{{ $voucher->quantity }}</td>
                            <td>{{ $voucher->active_date }}</td>
                            <td>{{ $voucher->expired_date }}</td>
                            <td>
                                <?php if ($item['status'] == 1) : ?>
                                <div class="badge badge-success">Còn hiệu lực</div>
                                <?php else : ?>
                                <div class="badge badge-danger">Hết hiệu lực</div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i
                                        class="fas fa-trash-alt text-danger fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('plugin-script')
    {{-- <script src="{{asset('assets/js/handle/validateform.js')}}"></script> --}}

    <script>
        $("#form_vourcher").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 6
                },
                code: {
                    required: true,
                    minlength: 6,
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 1
                },
                expired_date: {
                    required: true,
                    date: true,
                    dateValidate:true
                },
                discount: {
                    required: true,
                }
            },

            messages: {
                name: {
                    required: "Vui lòng nhập tên mã giảm giá !",
                    minlength: "Tên giảm  quá ngắn",
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
                discount: {
                    required: "Vui lòng nhập mệnh giá !",
                    maxlength: "Vui lòng nhập giá trị từ 1% -> 99%"
                },
                expired_date: {
                    required: "Vui lòng nhập ngày hết hạn",
                    date: "Vui lòng nhập định dạng ngày tháng"
                }
            },
            // submitHandler: function(form) {
            //     form.preventDefault();
            //     // check exist = ajax
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({

            //         url: "{{ route('ajax.voucherExist') }}",
            //         type: "POST",
            //         data: {
            //             "code": $('input[name"code"]').val()
            //         },
            //         success: function(data) {
            //             console.log(data)
            //             if (data == 'not-exist') {
            //                 form.submit();
            //             } else {
            //                 console.log(data)
            //             }
            //         },
            //         error: function(error) {

            //         }
            //     })
            // }
        });

        // add method validate
        var today = new Date();
        // const dateNow = new date();
        $.validator.addMethod("dateValidate", function(value) {
            var values = new Date(value);
            if (values < today) {
                return false
            }
            return true
        }, "Vui lòng nhập ngày lớn hơn hiện tại !");
    </script>
@endsection
