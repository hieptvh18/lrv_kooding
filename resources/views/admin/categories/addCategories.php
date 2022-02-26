<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm danh mục sản phẩm mới</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <?php if (isset($_GET['msg'])) : ?>
                <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
            <?php endif; ?>
            <form id="form_categorys" class="forms-sample" method="POST" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input name="name_cate" value="<?= save_value("name_cate") ?>" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>File upload</label>
                    <input name="img_cate" type="file" class="form-control file-upload-info" placeholder="Upload Image" id="upload" onchange="previewImg()">
                    <div id="displayImg" class="" style="width: 200px;">

                    </div>
                </div>
                <div class="form-group">
                    <label class="mr-3" for="special1">Danh mục đặc biệt ? (hiển thị img banner)</label>

                    <input name="special" value="1" type="radio" id="special" >
                    <label class="mr-3" for="special">Có</label>

                    <input name="special" value="0" checked type="radio" id="special2">
                    <label for="special2">Không</label>
                </div>
                <button type="submit" name="btn_add" class="btn btn-primary mr-2">Submit</button>
                <a href="category" class="btn btn-light">Danh sách</a>
            </form>
        </div>
    </div>
</div>