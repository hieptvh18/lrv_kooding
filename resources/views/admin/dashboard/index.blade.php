<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Welcome <?= $_SESSION['admin']['fullname'] ?></h3>
          <h6 class="font-weight-normal mb-0">Chào mừng admin quay lại!<span class="text-primary">!</span></h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="mdi mdi-calendar"></i> Today ( <?= date('D') ?> - <?= date('M') ?> - <?= date('Y') ?> )
              </button>
              <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div> -->
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
          <img src="./public/images/admin/mua_ha_noi.jpg" alt="people">
          <div class="weather-info">
            <div class="d-flex">
              <div>
                <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>18<sup>C</sup></h2>
              </div>
              <div class="ml-2">
                <h4 class="location font-weight-normal">Ha Noi</h4>
                <h6 class="font-weight-normal">VietNam</h6>
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
              <p class="fs-30 mb-2"><?= $data['total_orders'] ?></p>
              <!-- <p>10.00% (30 days)</p> -->
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4">Đơn hàng chưa xử lí</p>
              <p class="fs-30 mb-2"><?= $data['unprocess_order'] ?></p>
              <p><?= $data['percent_un_order'] ?>% (Tổng đơn hàng)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Tổng doanh thu (năm <?= date('Y') ?>)</p>
              <p class="fs-30 mb-2"><?= number_format($data['doanh_thu_nam'], 0, ',') ?>đ</p>
              <!-- <p>2.00% (30 days)</p> -->
            </div>
          </div>
        </div>
        <div class="col-md-6 stretch-card transparent">
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">Số lượng sản phẩm</p>
              <p class="fs-30 mb-2"><?= $data['qty_all_pros']; ?></p>
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
        <p class="font-weight-500">Tổng số doanh thu bán ra theo từng tháng trong năm <?= date('Y') ?></p>
        
        <canvas id="doanhthu" width="400" height="150"></canvas>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Tổng đơn hàng bán ra trong năm </p>
          <p class="font-weight-500">Tổng đơn hàng bán ra trong năm <?= date('Y') ?></p>
          <!-- <div class="d-flex flex-wrap mb-5">
            <div class="mr-5 mt-3">
              <p class="text-muted">Order value</p>
              <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
            </div>
            <div class="mr-5 mt-3">
              <p class="text-muted">Orders</p>
              <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
            </div>
            <div class="mr-5 mt-3">
              <p class="text-muted">Users</p>
              <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
            </div>
            <div class="mt-3">
              <p class="text-muted">Downloads</p>
              <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
            </div>
          </div> -->
          <canvas id="spbanra" width="400" height="250"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <p class="card-title">Số lượng hàng hóa theo danh mục</p>
            <a href="#" class="text-info"></a>
          </div>
          <p class="font-weight-500">Tất cả số lượng hàng hóa theo danh mục hiện có </p>
          <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
          <canvas id="soluonghang" width="400" height="235"></canvas>

        </div>
      </div>
    </div>
  </div>
 
  <!-- thống kê đơn hàng -->
  <div class="col-md-12 ">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Thống kê đơn hàng</p>
          <p class="font-weight-500">Thống kê đơn hàng trong năm <?= date('Y') ?></p>
          <div class="d-flex flex-wrap mb-5">
          <div class="mr-5 mt-3">
            <p class="text-muted">Tổng đơn hàng</p>
            <h3 class="text-primary fs-30 font-weight-medium"><?= $data['total_orders_year'] ?></h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Đơn đã hủy</p>
            <h3 class="text-primary fs-30 font-weight-medium"><?= $data['cancel_order'] ?></h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Đơn chờ xác nhận</p>
            <h3 class="text-primary fs-30 font-weight-medium"><?= $data['unprocess_order'] ?></h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Đơn đang xử lí</p>
            <h3 class="text-primary fs-30 font-weight-medium"><?= $data['processing_order'] ?></h3>
          </div>
          <div class="mt-3">
            <p class="text-muted">Đơn đã gửi đi</p>
            <h3 class="text-primary fs-30 font-weight-medium"><?= $data['sent_order'] ?></h3>
          </div>
        </div>
          <canvas id="donhang" width="400" height="100"></canvas>
        </div>
      </div>
    </div>
  


  
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->