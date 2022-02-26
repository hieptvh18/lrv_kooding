<div class="card">
    <div class="card-body">
        <form action="" method="POST">
            <h3 class="text-center">Chi tiết đơn hàng </h3>
            <h5 class="text-center">"Mã đơn hàng: <?= $data['receiver']['id'] ?>"</h5>
            <?php if (isset($_GET['msg'])) : ?>
                <div class="alert alert-success"><?= $_GET['msg'] ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['danger'])) : ?>
                <div class="alert alert-danger"><?= $_GET['danger'] ?></div>
            <?php endif; ?>
            <h4>Ngày tạo đơn</h4>
            <p><?= $data['receiver']['created_at'] ?></p>

            <h4>Thông tin nhận hàng:</h4>
            <table class="table table-striped table-borderless">

                <tbody>
                    <tr>
                        <td>Họ tên:</td>
                        <td><?= $data['receiver']['receiver'] ?></td>
                    </tr>
                    <tr>
                        <td>Điện thoại:</td>
                        <td><?= $data['receiver']['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ nhận hàng:</td>
                        <td><?= $data['receiver']['address'] ?></td>
                    </tr>
                    <tr>
                        <td>Ghi chú:</td>
                        <td><?= $data['receiver']['note'] == '' ? $data['receiver']['note'] : 'Không có ghi chú' ?></td>
                    </tr>

                </tbody>
            </table>
            <h3 class="card-title mb-0">Các sản phẩm mua</h3>
            <div class="table-responsive">
                <!-- list sp mua -->
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Màu sắc</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1;
                        $total = 0;
                        $tt = 0;
                        foreach ($data['bill'] as $item) : $tt = $item['price'] * $item['quantity'] ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><img src="./public/images/products/<?= $item['avatar'] ?>" width="" alt=""></td>
                                <td class="font-weight-bold"><?= number_format($item['price'], 0, ',') ?>đ</td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= $item['color'] ?></td>
                                <td><?= $item['size'] ?></td>

                            </tr>
                        <?php $n++;
                            $total += $tt;
                        endforeach; ?>
                        <tr>
                            <th class="" colspan="">Tổng tiền đơn hàng:</th>
                            <th><?= number_format($total, 0, ',') ?>đ</th>
                        </tr>

                    </tbody>
                </table>

            </div>
            <!-- trạng thái đơn hàng -->
            <h4 class="mt-2">TRẠNG THÁI ĐƠN HÀNG</h4>
            <p class="" style="display:<?= $data['receiver']['status'] > 0 ? 'none' : 'block' ?>">
                <input type="radio" <?= $data['receiver']['status'] == 0 ? 'checked' : '' ?> name="status" id="st1" class="mr-2" value="0"><label for="st1">Chưa xử lý</label>
            </p>
            <p class="" style="display:<?= $data['receiver']['status'] > 1 ? 'none' : 'block' ?>">
                <input type="radio" <?= $data['receiver']['status'] == 1 ? 'checked' : '' ?> name="status" id="st2" class="mr-2" value="1"><label for="st2">Đang xử lý</label>
            </p>
            <p class="" style="display:<?= $data['receiver']['status'] > 2 ? 'none' : 'block' ?>">
                <input type="radio" name="status" <?= $data['receiver']['status'] == 2 ? 'checked' : '' ?> id="st3" class="mr-2" value="2"><label for="st3">Đã xử lý</label>
            </p>
            <p class="" style="display:<?= $data['receiver']['status'] > 3 ? 'none' : 'block' ?>">
                <input type="radio" <?= $data['receiver']['status'] == 3 ? 'checked' : '' ?> name="status" id="st4" class="mr-2" value="3"><label for="st4">Hủy đơn</label>
            </p>
            <input type="hidden" name="bill_id" value="<?= $data['receiver']['id'] ?>">
            <button type="submit" class="btn btn-primary" name="btn_sb">Xác nhận</button>
            <a href="order" class="btn btn-info">Danh sách đơn</a>
        </form>
    </div>
</div>