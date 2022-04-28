<div class="card-body">
    <h4 class="card-title">Danh sách Bình luận</h4>
    <a href="comment?action=view" class=""><i class="fa fa-long-arrow-left mr-1 mb-1"></i>Quay lại trang Tổng hợp bình luận</a>
    <form action="" method="POST">
        <div class="checked text-center mb-3">
            <button id="check-all" type="button" class="btn btn-primary">Chọn tất cả</button>
            <button id="clear-all" type="button" class="btn btn-info" style="display: none;">Bỏ chọn tất cả</button>
            <a href="" onclick="return confirm('Bạn có chắc muốn xóa các sản phẩm đã chọn?')">
                <button id="btn-delete" name="btn_del_cmt" type="submit" class="btn btn-danger ">Xóa các mục chọn<i class="fa fa-trash-o ml-2" aria-hidden="true"></i></button>
            </a>
        </div>
        <?php if (!empty($data['msg'])) : ?>
            <div class="bg-danger p-2 mt-2 text-white">
                <?php echo $data['msg']; ?>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Chọn</th>
                        <th>STT</th>
                        <th>Người bình luận</th>
                        <th>Nội dung</th>
                        <th>Thời gian bình luận</th>
                    </tr>
                </thead>
                <tbody class="list-product">
                    <?php $n = 1;
                    foreach ($data['cmt_of_pros'] as $item) : ?>
                        <tr>
                            <th><input type="checkbox" name="cmt_id[]" value="<?= $item['id'] ?>" class="inpt-checkbox">
                            </th>
                            <td><?php echo $n; ?></td>
                            <td><?= $item['fullname'] ?></td>
                            <td><?= $item['content'] ?></td>
                            <td><?= $item['created_at'] ?></td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </form>
</div>

<!-- js -->
<script>
    $(document).ready(function() {
        $("#check-all").click(function() {

            $(":checkbox").prop("checked", true);
            $('#clear-all').css("display", "inline-block");
            $('#check-all').css("display", "none");
        });
        $("#clear-all").click(function() {
            $(":checkbox").prop("checked", false);
            $('#clear-all').css("display", "none");
            $('#check-all').css("display", "inline-block");
        });
        $("#btn-delete").click(function() {
            if ($(":checked").length === 0) {
                alert("Vui lòng chọn ít nhất một mục!");
                return false;
            }
        });
    });
</script>