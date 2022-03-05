@extends('layouts.layout-admin')

@section('page-title', 'THUỘC TÍNH SẢN PHẨM')

@section('main')

    <div class="card-body">
        <h4 class="card-title">Danh sách Thuộc tính</h4>

        <div class="row">
            <div class="col-8">
                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listAttr as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $val->name }}</td>
                                <td>
                                    <a href="#update"><i class="fas fa-pen-square text-warning fa-2x "></i></a>
                                    <a href="{{ route('attribute.destroy', $val->id) }}" onclick="
                                                        event.preventDefault();
                                                        document.querySelector('#form-del-attr{{ $key }}').submit()
                                                "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                    <form id="form-del-attr{{ $key }}"
                                        action="{{ route('attribute.destroy', $val->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="table-responsive col-4">
                <h4 class="card-title">Thêm mới Thuộc tính</h4>

                <form action="{{ route('attribute.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên thuộc tính sản phẩm">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>


        {{-- danh ssach giá trị của thuộc tính --}}
        <h4 class="card-title mt-5">Danh sách gía trị của thuộc tính.</h4>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Thêm giá trị mới
        </button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm giá trị thuộc tính </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="form-add-attr_value" action="{{ route('attributeValue.store') }}" class="forms-sample"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Thuộc tính</label>
                                <select name="attr_id" id="attr_id" class="form-control">
                                    @foreach ($listAttr as $a)
                                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- color --}}
                            <div class="form-group" id="input-value-color">
                                <label for="">Giá trị</label>
                                <input type="text" class="form-control" name="value" placeholder="Nhập giá trị ">
                                <span class="erValue text-danger"></span>
                            </div>

                            <div class="form-group" id="">
                                <label for="">Tên gọi</label>
                                <input type="text" class="form-control" name="value_name"
                                    placeholder="Nhập tên gọi của giá trị (đỏ cam đỏ đậm...)">
                                <span class="erName text-danger"></span>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2"
                                class="btn-sb-form-attr-value">Submit</button>
                            <a href="" class="btn btn-light">Hủy</a>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Thuộc tính</th>
                            <th>Giá trị</th>
                            <th>Tên gọi</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_attr_value as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->attr_name }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->name }}</td>
                                <td>

                                    <a href="{{ route('attributeValue.destroy', $val->id) }}" onclick="
                                            event.preventDefault();
                                            document.querySelector('#form-del-attr-value{{ $key }}').submit()
                                    "><i class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                    <form id="form-del-attr-value{{ $key }}"
                                        action="{{ route('attributeValue.destroy', $val->id) }}" method="POST">
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

    </div>

@endsection

@section('plugin-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            if ($('select[name="attr_id"]').val() == 1) {
                $('input[name="value"]').attr('type', 'color');
            } else {
                $('input[name="value"]').attr('type', 'text');
                $('input[name="value"]').attr('value', '');
            }

            $('#attr_id').change(function() {
                var attr_value = $('#attr_id').val()
                if (attr_value == 1) {
                    // color
                    $('input[name="value"]').attr('type', 'color');
                } else {
                    // size and chất vải
                    $('input[name="value"]').attr('type', 'text');
                    $('input[name="value"]').attr('value', '');
                }
            });

            // validate with jqr validation
            $('#btn-sb-form-attr-value').click(function(e) {
                e.preventDefault();

                if ($('input[name="value_name"]').val() == '') {
                    $('input[name="value_name"]').css('border', '2px solid red');
                    $('.erName').html('Nhập thông tin')
                } else {
                    $('input[name="value_name"]').css('border', '2px solid #07E454');
                    $('.erName').html('')
                }

                if ($('input[name="value"]').val() == '') {

                    $('input[name="value"]').css('border', '2px solid red');
                    $('.erValue').html('Nhập thông tin')
                } else {
                    $('input[name="value"]').css('border', '2px solid #07E454');
                    $('.erValue').html('')
                }
                if ($('input[name="value_name"]').val() != '' && $('input[name="value"]').val() != '') {
                    $('input[name="value_name"]').css('border', '2px solid #07E454');
                    $('input[name="value"]').css('border', '2px solid #07E454');
                    $('.erName').html('')
                    $('.erValue').html('')


                    // check giá trị đã tồn tại
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('ajax.attr-value-exist') }}",
                        type: 'POST',
                        data: {
                            'name': $('input[name="value_name"]').val(),
                            'value': $('input[name="value"]').val(),
                            'attr_id': $('select[name="attr_id"]').val(),
                        },
                        success: function(data) {
                            console.log(data)
                            if (data == 0) {
                                // ko tồn tại
                                $('input[name="value_name"]').css('border',
                                '2px solid #07E454');
                                $('.erValue').html('')
                                $('#form-add-attr_value').submit();
                                return;
                            } else {
                                // tồn tại
                                console.log('đã tồn tại value cuả attr -> err')
                                $('input[name="value_name"]').css('border', '2px solid red');
                                $('.erValue').html('Giá trị của thuộc tính đã tồn tại!')
                            }
                        },
                        error: function(er) {
                            // console.log(er)
                        }
                    });
                }

            });
        });
    </script>

@endsection
