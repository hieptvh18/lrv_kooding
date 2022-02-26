<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Quản lí giao diện</h4>
            <p class="card-description">
                Basic form elements
            </p>
           <?php if(isset($_GET['msg'])):?>
            <div class="alert alert-success"><?= $_GET['msg'] ?></div>
            <?php endif;?>
            <form id="form_display" class="forms-sample" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="">Tên website </label>
                    <input type="text" value="<?= $data['display']['web_name'] ?>" placeholder="Nhập tên website" class="form-control" name="web_name">
                </div>
                <div class="form-group">
                    <label for="">Logo website </label>
                    <img src="./public/images/layout/<?= $data['display']['logo'] ?>" alt="" width="200px">
                    <p>Tải logo mới</p>
                    <input type="file" class="form-control" id="upload" onchange="previewImg()" name="logo" >
                    <input type="hidden" name="logo" value="<?= $data['display']['logo'] ?>">
                    <?php if($data['er']):?>
                        <div class="text-danger"><?= $data['er'] ?></div>
                        <?php endif; ?>
                    <div id="displayImg" class="" style="width: 200px;"> </div>
                </div>
                <div class="form-group">
                    <label class="mr-3" for="special1">Giới thiệu (homepage) </label>
                    <p>Tiêu đề</p>
                    <input type="text" value="<?= $data['display']['title_intro'] ?>" name="title_intro" class="form-control">
                    <p>Nội dung</p>
                    <textarea class="form-control" id="local-upload" name="content_intro" rows="5"><?= $data['display']['content_intro'] ?></textarea>

                </div>
                <div class="form-group">
                    <label for="">Quản lý url(social-footer)</label>
                    <input type="text" value="<?= $data['display']['fb_url'] ?>" placeholder="url facebook" name="fb_url" class="form-control">
                    <input type="text" value="<?= $data['display']['insta_url'] ?>" name="insta_url" placeholder="url instagram" class="form-control">
                    <input type="text" value="<?= $data['display']['twitter_url'] ?>" name="twitter_url" class="form-control" placeholder="url twitter">
                    <input type="text" value="<?= $data['display']['pinterest_url'] ?>" name="pinterest_url" class="form-control" placeholder="url pinterest">
                </div>

                <button type="submit" class="btn btn-primary mr-2" name="btn_update">Submit</button>
            </form>
        </div>
    </div>
</div>