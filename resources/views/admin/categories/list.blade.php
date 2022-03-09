<div class="card-body">
    <h4 class="card-title">Danh sách sản phẩm</h4>
    <div class="" style="display: flex;">
        <a href="category?action=addCategory" class="text-light btn btn-primary">Thêm mới</a>
    </div>
    <?php if (isset($_GET['msg'])) : ?>
        <div class="alert alert-danger"><?php echo $_GET['msg']; ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <!-- <th>Số lượng</th> -->
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1;
                foreach ($data['list_cate'] as $item) : ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><img src="./public/images/categories/<?= $item['avatar'] ?>" alt=""></td>
                        <!-- <td><?= $item['qty'] ?></td> -->

                        <td>
                            <a href="category?action=update&id=<?= $item['id'] ?>"><i class="fas fa-pen-square text-warning fa-2x "></i></a>
                            <a href="category?action=del&id=<?= $item['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                        </td>
                    </tr>
                <?php $n++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>