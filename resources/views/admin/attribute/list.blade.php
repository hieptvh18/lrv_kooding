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
                                    <a href="#del" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i
                                            class="fas fa-trash-alt text-danger fa-2x"></i></a>
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
                        <form id="form-add-attr_value" action="{{ route('attributeValue.store') }}" class="forms-sample" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Thuộc tính</label>
                                <select name="attr_id" id="attr_id" class="form-control">
                                    @foreach ($listAttr as $a)
                                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- input-other --}}
                            <div class="form-group input-other" id="input-value">
                                <label for="">Giá trị</label>
                                <input type="text" class="form-control" name="value"
                                    placeholder="Nhập màu giá trị của thuộc tính(M, l, đỏ cam...)">
                            </div>

                                {{-- color --}}
                                <div class="color-value">
                              
                                </div>

                            <div class="form-group" id="">
                                <label for="">Tên gọi</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Nhập tên gọi của giá trị (đỏ cam đỏ đậm...)">
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
                            <th>Tên thuộc tính</th>
                            <th>Giá trị</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_attr_value as $key => $item)
                            : ?>
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->value }}</td>
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

    </div>

@endsection

@section('plugin-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            const color_input = `
            <div class="color-value-box">
                                    <div class="form-group" id="input-value-color">
                                        <label for="">Giá trị</label>
                                        <input type="color" class="form-control" name="value">
                                    </div>

                                  
                               </div>
            `;
            if($('select[name="attr_id"]').val() == 1){
                $('.color-value').append(color_input);
            }

            $('#attr_id').change(function(){
                var attr_value = $('#attr_id').val()
                if(attr_value == 1){
                    // color
                    $('.color-value').append(color_input);

                    $('.input-other').hide()
                }else{
                    // size and chất vải
                    $('.color-value-box').remove();
                    $('.input-other').show()
                }
            });

            // validate with jqr validation
            $('#form-add-attr_value').validate([
                // define rules and message
                rules:{
                    name:{
                        'required':true,
                    },
                    value:{
                        'required':true
                    }
                },
                messages:{
                    name:{
                       required: "Vui lòng nhập tên giá trị"
                    },
                    value:{
                        required: "Vui lòng nhập giá trị"
                    }
                }

            ]);
        })
    </script>
@endsection
