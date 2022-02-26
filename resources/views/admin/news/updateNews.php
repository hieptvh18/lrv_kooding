<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cập nhật tin tức</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <?php if (!empty($data['msg'])) : ?>
                <div class="alert alert-warning"><?php echo $data['msg'] ?></div>
            <?php endif; ?>

            <form id="form_news" class="forms-sample" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Tiêu đề </label>
                    <input name="title" type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="<?= $data['newsDetail']['title'] ?><?= save_value('title') ?>">
                </div>
                <div class="form-group">
                    <label class="mr-3" for="special1">Tin tức đặc biệt ? </label>


                    <input name="special" <?= $data['newsDetail']['special'] == 0 ? 'checked' : '' ?> type="radio" value="0" id="special2">
                    <label for="special2" class="mr-3">Không</label>

                    <input name="special" <?= $data['newsDetail']['special'] == 1 ? 'checked' : '' ?> type="radio" id="special" value="1">
                    <label class="mr-3" for="special">Có</label>

                </div>
                <div class="form-group">
                    <label>File upload</label>
                    <label for="">Avatar cũ:</label>
                    <img src="./public/images/upload/<?= $data['newsDetail']['image'] ?>" width="200px" alt="">
                    <p>Upload avatar mới</p>
                    <input name="avatar" id="upload" onchange="previewImg()" type="file" class="form-control file-upload-info" placeholder="Upload Image">
                    <input type="hidden" name="avatar" value="<?= $data['newsDetail']['image'] ?>">
                    <?php
                    if (!empty($data['err'])) {
                        echo '<label class="text-danger">' . $data['err'] . '</label>';
                    }
                    ?>
                    <div id="displayImg" class="" style="width: 200px;">

                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea class="form-control" id="" name="shortdesc" rows="3"><?= $data['newsDetail']['shortdesc'] ?><?= save_value('shortdesc') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="local-upload">Chi tiết nội dung</label>
                    <textarea class="form-control" id="local-upload" name="desc" rows="7"><?= $data['newsDetail']['content'] ?><?= save_value('desc') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2" name="btn_update">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>