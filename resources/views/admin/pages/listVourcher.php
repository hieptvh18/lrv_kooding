<div class="card-body">
    <h4 class="card-title">Quản lí Vourcher</h4>
    <div class="" style="display: flex; align-items:center;">
        <a href="vourcher?action=add" class="text-light btn btn-primary">Thêm mới</a>
        <div class="filter ml-3">
            <select name="filter_status" id="">
                <option value="" disabled selected>Lọc mã</option>
                <option value="1">Còn hiệu lực</option>
                <option value="0">Hết hiệu lực</option>
            </select>
        </div>
    </div>
    <?php if (isset($_GET['msg'])) : ?>
        <div class="bg-success p-2">
            <?php echo $_GET['msg']; ?>
        </div>
    <?php endif; ?>
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
                <?php $n = 1;
                foreach ($data['list_vour'] as $item) : ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['code'] ?></td>
                        <td><?php if ($item['cate_code'] == 1) {
                                echo $item['discount'] . "%";
                            } else {
                                echo $item['discount'] . "vnd";
                            } ?></td>

                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['active_date'] ?></td>
                        <td><?= $item['expired_date'] ?></td>
                        <td>
                            <?php if ($item['status'] == 1) : ?>
                                <div class="badge badge-success">Còn hiệu lực</div>
                            <?php else : ?>
                                <div class="badge badge-danger">Hết hiệu lực</div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="vourcher?action=del&id=<?= $item['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                        </td>
                    </tr>
                <?php $n++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>