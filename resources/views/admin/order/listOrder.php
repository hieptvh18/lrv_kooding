<div class="card">
  <div class="card-body">
    <p class="card-title mb-0">DANH SÁCH ĐƠN HÀNG</p>
    <?php if (isset($_GET['msg'])) : ?>
      <div class="alert alert-danger"><?= $_GET['msg'] ?></div>
    <?php endif; ?>
    <div class="table-responsive">
      <table class="table table-striped table-borderless">
        <thead>
          <tr>
            <th>STT</th>
            <th>ID </th>
            <th>Tên khách hàng</th>
            <th>Tổng tiền hàng</th>
            <th>Số điện thoại</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn</th>
            <th>Xem</th>
          </tr>
        </thead>
        <tbody>
          <?php $n = 1;
          foreach ($data['list_order'] as $o) : ?>
            <tr>
              <td><?= $n ?></td>
              <td><?= $o['id'] ?></td>
              <td><?= $o['fullname'] ?></td>
              <td class="font-weight-bold"><?= number_format($o['total_price'], 0, ',') ?>đ</td>
              <td><?= $o['phone'] ?></td>
              <td><?= $o['created_at'] ?></td>
              <td class="font-weight-medium">
                <?php if ($o['status'] == 2) : ?>
                  <div class="badge badge-success">Đã gửi hàng</div>
                <?php elseif ($o['status'] == 1) : ?>
                  <div class="badge badge-info">Đang xử lí</div>
                <?php elseif($o['status'] == 0) : ?>
                  <div class="badge badge-warning">Chưa xác nhận</div>
                  <?php else: ?>
                    <div class="badge badge-danger">Đã hủy đơn</div>
                  <?php endif;?>
              </td>
              <td>
                <a href="order?action=viewDetail&id=<?= $o['id'] ?>" class="btn btn-primary">Chi tiết</a>
              </td>
            </tr>
          <?php $n++;
          endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>