<div class="card-body">
    <h4 class="card-title">Danh sách Thuộc tính</h4>
    <div class="" style="display: flex;">
        <a href="product?action=addAttr" class="text-light btn btn-primary">Thêm mới</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Giá trị</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1;
                foreach ($data['listAttr'] as $item) : ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?= $item['name']?></td>
                        <td><?= $item['value'] ?></td>
                        <td>
                            <a href="#update"><i class="fas fa-pen-square text-warning fa-2x "></i></a>
                            <a href="#del" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                        </td>
                    </tr>
                <?php $n++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>