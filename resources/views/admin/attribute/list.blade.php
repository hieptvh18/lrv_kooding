@extends('layouts.layout-admin')

@section('page-title', 'THUỘC TÍNH SẢN PHẨM')

@section('main')

    <div class="card-body">

        <div class="d-flex justify-content-between">
            <div class="attribute-values">
                {{-- danh ssach giá trị của thuộc tính --}}
                <h4 class="card-title mt-3">Danh sách gía trị của thuộc tính.</h4>
                <!-- Button to Open the Modal -->
                <button type="button" {{ $btnStatus }} class="btn btn-outline-primary" data-toggle="modal"
                    data-target="#myModal">
                    Thêm mới+
                </button>
            </div>
            <div class="add-attribute">
                <h4 class="card-title mt-3"> Thêm mới thuộc tính.</h4>

                <form action="{{route('attribute.store')}}" method="post" class="d-flex">
                    @csrf
                    <div class="">
                        <input type="text" name="name" class="form-control" placeholder="New attribute" required>
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        @if (session('msg-suc'))
                            <small class="text-success">{{session('msg-suc')}}</small>
                        @endif
                    </div>
                    <div class="">
                        <button class="btn btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

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
                                    @foreach ($attributes as $a)
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

                            <button type="submit" class="btn btn-primary mr-2" id="btn-sb-form-attr-value">Submit</button>
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
                        @foreach ($attributeValues as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->attr_name }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->name }}</td>
                                <td>

                                    <a href="{{ route('attributeValue.destroy', $item->id) }}"
                                        onclick="
                                            event.preventDefault();
                                         if(confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
                                             document.querySelector('#form-del-attr-value{{ $key }}').submit()
                                         }
                                    "><i
                                            class="fas fa-trash-alt text-danger fa-2x"></i></a>

                                    <form id="form-del-attr-value{{ $key }}"
                                        action="{{ route('attributeValue.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="paginate">
                    {{ $attributeValues->links() }}
                </div>
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
