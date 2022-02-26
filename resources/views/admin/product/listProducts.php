<div class="card-body">
    <h4 class="card-title">Danh sách sản phẩm</h4>
    <div class="" style="display: flex;">
        <a href="product?action=addProduct" class="text-light btn btn-primary">Thêm mới</a>

        <select name="categories" id="categories" style="border-radius: 15px;">
            <option value="" disabled selected>Lọc theo danh mục</option>
            <?php foreach ($data['list_cate'] as $item) : ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php if (isset($_GET['msg'])) : ?>
        <div class="bg-danger p-2 mt-2 text-white">
            <?php echo $_GET['msg']; ?>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá.</th>
                    <th>Ảnh</th>
                    <th>Giá giảm</th>
                    <!-- <th>Mô tả</th> -->
                    <th>Tình trạng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody class="list-product">
                <?php if (!isset($_GET['action'])) : ?>
                    <?php $n = 1;
                    foreach ($data['list_pro'] as $item) : ?>
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td><?= $item['pr_name'] ?></td>
                            <td><?= $item['ca_name'] ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> vnd</td>
                            <td><img src="./public/images/products/<?= $item['avatar'] ?>" alt=""> </td>
                            <td><?= $item['discount'] ?>vnd</td>
                            <td>
                                <?php if ($item['status']  == 0) : ?>
                                    <label class="badge badge-danger">Hết hàng</label>
                                <?php else : ?>
                                    <label class="badge badge-success">Còn hàng</label>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="product?action=update&id=<?= $item['pro_id'] ?>"><i class="fas fa-pen-square text-warning fa-2x "></i></a>
                                <a href="?action=del&id=<?= $item['pro_id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                            </td>
                        </tr>
                    <?php $n++; endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<div id="output"></div>

<!-- js -->