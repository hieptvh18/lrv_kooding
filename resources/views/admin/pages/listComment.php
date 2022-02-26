<div class="card-body">
    <h4 class="card-title">Danh sách Bình luận</h4>
    <div class="" style="display: flex;">
        <!-- <select name="categories" id="categories" style="border-radius: 15px;">
            <option value="" disabled selected>Lọc theo danh mục</option>
            <option value="">Tất cả sản phẩm</option>
            <?php foreach ($data['list_cate'] as $item) : ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            <?php endforeach; ?>
        </select> -->
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
                    <th>Tên sản phẩm</th>
                    <th>Số bình luận</th>
                    <th>Mới nhất</th>
                    <th>Cũ nhất</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody class="list-product">
                <?php $n = 1;
                foreach ($data['syn_cmts'] as $item) : ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?= $item['pro_name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['bl_moinhat'] ?></td>
                        <td><?= $item['bl_cunhat'] ?></td>
                        <td>
                            <a href="comment?action=viewDetail&id=<?= $item['id'] ?>"><i class="fas fa-pen-square text-warning fa-2x "></i></a>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<div id="output"></div>

<!-- js -->