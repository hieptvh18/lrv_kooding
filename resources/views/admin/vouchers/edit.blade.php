@extends('layouts.layout-admin')

@section('page-title', 'CẬP NHẬT VOUCHER')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cập nhật voucher</h4>
                <p class="card-description">

                </p>
                @if (session('msg-er'))
                    <div class="alert alert-danger">{{ session('msg-er') }}</div>
                @endif
                @if (session('msg-suc'))
                    <div class=" alert alert-success">{{ session('msg-suc') }}</div>
                @endif


                <form id="" action="{{ route('voucher.update', $voucher->id) }}" class="forms-sample" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Tên mã</label>
                            <input name="name" type="text" value="{{ $voucher->name }}" class="form-control form-control-sm"
                                id="" placeholder="Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="">Loại giảm</label>
                            <select name="category_code" id="category_code" class="form-control form-control-sm">
                                <option value="0" {{ $voucher->category_code == 0 ? 'selected' : '' }}>Giảm theo %</option>
                                <option value="1" {{ $voucher->category_code == 1 ? 'selected' : '' }}>Giảm tiền trực tiếp
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Mã code</label>
                            <input name="code" type="text" class="form-control form-control-sm" id=""
                                placeholder="code(ABCDEF)..." value="{{ $voucher->code }}">
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="">Số lượng</label>
                            <input name="quantity" type="number" value="{{ $voucher->quantity }}"
                                class="form-control form-control-sm" min="1" id="" placeholder="Số lượng ">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Mệnh giá giảm</label>
                            <input id="discount" value="{{ $voucher->discount }}" name="discount" type="number"
                                class="form-control form-control-sm" maxlength="2" id="" placeholder="Giá giảm">
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="">Ngày hết hạn</label>
                            <input id="" name="expired_date" type="datetime-local"
                                value="{{ date('Y-m-d\TH:i', strtotime($voucher->expired_date)) }}"
                                class="form-control form-control-sm" id="">
                            @error('expired_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
