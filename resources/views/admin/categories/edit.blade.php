<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cập nhật - chỉnh sửa danh mục sản phẩm</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <?php if (isset($_GET['msg'])) : ?>
                <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
            <?php endif; ?>
            <form id="form_Ucategorys" class="forms-sample" method="POST" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input name="name_cate" value="<?= $data['cate_detail']['name'] ?><?= save_value("name_cate") ?>" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>File upload</label>
                    <p>Ảnh đại diện cũ:</p>
                    <img src="./public/images/products/<?= $data['cate_detail']['avatar'] ?>" alt="" width="200px">
                    <input type="hidden" name="avatar" value="<?= $data['cate_detail']['avatar'] ?>">

                    <input name="img_cate" type="file" class="form-control file-upload-info" placeholder="Upload Image" id="upload" onchange="previewImg()">
                    <?php
                    if (!empty($data['errImg'])) {
                        echo '<p class="text-danger">' . $data['errImg'] . '</p>';
                    }
                    ?>
                    <div id="displayImg" class="" style="width: 200px;">

                    </div>
                </div>
                <div class="form-group">
                    <label class="mr-3" for="special1">Danh mục đặc biệt ? (hiển thị img banner)</label>

                    <input name="special" <?= $data['cate_detail']['special'] == 1?'checked': '' ?> value="1" type="radio" id="special" >
                    <label class="mr-3" for="special">Có</label>

                    <input name="special" <?= $data['cate_detail']['special'] == 0?'checked': '' ?>  value="0" type="radio" id="special2">
                    <label for="special2">Không</label>
                </div>
                <button type="submit" name="btn_update" class="btn btn-primary mr-2">Submit</button>
                <a href="category" class="btn btn-light">Danh sách</a>
            </form>
        </div>
    </div>
</div>