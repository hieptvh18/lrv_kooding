@extends('layouts.layout-admin')

@section('page-title', 'Dashboard | KOODING')

@section('main')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome </h3>
                        <h6 class="font-weight-normal mb-0">Chào mừng admin quay lại!<span class="text-primary">!</span>
                        </h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Thống kê theo năm
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="?_year=2022">Năm hiện tại {{ date('Y') }}</a>
                                    <a class="dropdown-item" href="?_year=2021">Năm 2021</a>
                                    <a class="dropdown-item" href="?_year=2020">Năm 2020</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="{{ asset('assets/images/admin/mua_ha_noi.jpg') }}" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>18<sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal text-danger">
                                        {{ $currentLocation->countryName }}
                                    </h4>
                                    <h6 class="font-weight-normal text-light">{{ $currentLocation->regionName }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Tổng đơn hàng</p>
                                <p class="fs-30 mb-2">{{ $totalOrder }}</p>
                                <!-- <p>10.00% (30 days)</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Đơn hàng chưa xử lí</p>
                                <p class="fs-30 mb-2">{{ $donChuaXuLi }}</p>
                                <p>
                                    @if ($totalOrder > 0)
                                        {{ number_format(($donChuaXuLi / $totalOrder) * 100,2) }}
                                    @else
                                        0
                                    @endif % (Tổng đơn hàng)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Tổng doanh thu (năm {{!empty($_GET['_year']) ? $_GET['_year'] : date('Y')}})</p>
                                <p class="fs-30 mb-2">
                                    {{ number_format($tongDoanhThuNam) }}
                                    đ
                                </p>
                                <!-- <p>2.00% (30 days)</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Số lượng sản phẩm</p>
                                <p class="fs-30 mb-2">{{ $totalProduct }}</p>
                                <!-- <p>0.22% (30 days)</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- chart -->
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Doanh thu bán hàng</p>
                    <p class="font-weight-500">Tổng số doanh thu bán ra theo từng tháng trong năm {{!empty($_GET['_year']) ? $_GET['_year'] : date('Y')}}</p>
                    <form action="" method="post">
                        <div class="form-group d-flex align-items-center col-6">
                            <span class="mr-2">Từ</span>
                            <input type="date" name="start_date" class="form-control form-control-sm mr-2" required>
                            <span class="mr-2">Đến</span>
                            <input type="date" name="end_date" class="form-control form-control-sm" required>
                            <button type="button" id="btnFilter" class="btn btn-sm btn-secondary">Lọc</button>
                        </div>
                    </form>
                    <canvas id="doanhthu" width="400" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Số lượng hàng hóa theo danh mục</p>
                            <a href="#" class="text-info"></a>
                        </div>
                        <p class="font-weight-500">Tất cả số lượng hàng hóa theo danh mục hiện có </p>
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="soluonghang" width="500" height="180"></canvas>

                    </div>
                </div>
            </div>
        </div>

        <!-- thống kê đơn hàng -->
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Thống kê đơn hàng</p>
                    <p class="font-weight-500">Thống kê đơn hàng trong năm {{!empty($_GET['_year']) ? $_GET['_year'] : date('Y')}}</p>
                    <div class="d-flex flex-wrap mb-5">
                        <div class="mr-5 mt-3">
                            <p class="text-muted">Tổng đơn hàng</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{$totalOrder}}</h3>
                        </div>
                        <div class="mr-5 mt-3">
                            <p class="text-muted">Đơn đã hủy</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{$cancel_order}}</h3>
                        </div>
                        <div class="mr-5 mt-3">
                            <p class="text-muted">Đơn chờ xác nhận</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{$unprocess_order}}</h3>
                        </div>
                        <div class="mr-5 mt-3">
                            <p class="text-muted">Đơn đang xử lí</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{$processing_order}}</h3>
                        </div>
                        <div class="mt-3">
                            <p class="text-muted">Đơn đã gửi đi</p>
                            <h3 class="text-primary fs-30 font-weight-medium">{{$sent_order}}</h3>
                        </div>
                    </div>
                    <canvas id="donhang" width="400" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
    @endsection
    @section('plugin-script')
        <script>
            // doanh thu theo từng tháng
            const doanhThu = document.getElementById('doanhthu').getContext('2d');
            urlYear = new URLSearchParams(window.location.search).get('_year');
            const dateNow = new Date();
            urlYear = urlYear ?? dateNow.getFullYear();

            axios.get('/api/get-doanh-thu-tung-thang-trong-nam')
                .then(res => {
                    if (res.data.success) {
                        let labels = [];

                        res.data.data.map(val => {
                            let arrDate = val.ngay.split('-');
                            console.log(arrDate);
                            if (arrDate.includes(`${urlYear}`)) {
                                labels.push(val.ngay)
                            }
                        });

                        let dataRow = [];
                        res.data.data.map(val => {
                            let arrDate = val.ngay.split('-');
                            if (arrDate.includes(`${urlYear}`)) {
                                dataRow.push(val.doanhthu)
                            }
                        });

                        chartDoanhThu(labels, dataRow)
                    }
                    // return response.json({
                    //     'message':'status fail'
                    // })

                    // filter theo date
                    document.querySelector('#btnFilter').onclick = function() {
                        const startDate = document.querySelector('input[name="start_date"]');
                        const endDate = document.querySelector('input[name="end_date"]');

                        if (!startDate.value || !endDate.value) {
                            alert('Vui lòng chọn thời gian')
                            return;
                        }

                        let labelData = res.data.data.filter(val => val.ngay >= startDate.value && val.ngay <= endDate
                            .value)

                        let labels = [];
                        labelData.map(val => {
                            labels.push(val.ngay)
                        });

                        let dataRow = [];
                        labelData.map(val => {
                            dataRow.push(val.doanhthu)
                        });
                        chartDoanhThu(labels, dataRow)
                    }

                })

            // func render chart
            const chartDoanhThu = function(labels, dataRow) {
                new Chart(doanhThu, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Doanh thu',
                            data: dataRow,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        </script>

        <!-- số lg hàng theo danh mục -->
        <script>
            const slhang = document.getElementById('soluonghang').getContext('2d');
            axios.get('/api/get-so-luong-hang-hoa-theo-danh-muc')
                .then(res => {
                    if (res.statusText == 'OK') {
                        let labels = [];

                        res.data.data.map(val => {
                            labels.push(val.category_name)
                        });

                        let dataRow = [];
                        res.data.data.map(val => {
                            dataRow.push(val.qty)
                        });

                        myChart_slhang(labels,dataRow)
                    }
                    // ...
                })

            const myChart_slhang = (labels, dataRow) => {
                new Chart(slhang, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Số lượng',
                            data: dataRow,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        </script>

        {{-- slg hang ban ra tung thang --}}
        <script>
            //<!-- dh bán ra hàng tháng -->
            const spbanra = document.getElementById('spbanra').getContext('2d');
            const myChart_spbanra = new Chart(spbanra, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Số lượng đơn',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <!-- tk đơn hàng -->
        <script>
            const donhang = document.getElementById('donhang').getContext('2d');
            const myChart_donhang = new Chart(donhang, {
                type: 'pie',
                data: {
                    labels: ['Đơn đã hủy', 'Đơn chưa xác nhận', 'Đơn đang xử lí', 'Đơn đã gửi đi'],
                    datasets: [{
                        label: 'Số sản phẩm',
                        data: [{{$cancel_order}},{{$unprocess_order}},{{$processing_order}},{{$sent_order}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
