<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm danh mã giảm giá mới</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <form id="form_vourcher" class="forms-sample" method="POST" enctype="multipart/form-data" >
                <?php if(!empty($data['err'])):?>
                    <div class="text-danger"><?php echo $data['err']; ?></div>
                    <?php endif;?>
                <div class="form-group">
                    <label for="">Tên mã</label>
                    <input name="name_vour" type="text" class="form-control" id="" placeholder="Name">
                    <label for="name_vour" class="error" style="display: none !important;"></label>
                </div>
                <div class="form-group">
                    <label for="">Loại giảm</label>
                  <select name="cate_code" id="driveaway">
                      <option value="y">Giảm theo %</option>
                      <option value="n">Giảm tiền trực tiếp</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="">Mã code</label>
                    <input name="code" type="text" class="form-control" id="" placeholder="code(ABCDEF)...">
                    <label for="code" class="error" style="display: none !important;"></label>
                </div>
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input name="quantity" type="number" class="form-control" min="1" id="" placeholder="Số lượng " value="1">
                    <!-- <label for="code" class="error" style="display: none !important;"></label> -->
                </div>
                <div class="form-group">
                    <label for="">Mệnh giá giảm</label>
                    <input id="driveamount" name="sale" type="number" class="form-control" id="" placeholder="Giá giảm" maxlength="2">
                    <label for="sale" class="error" style="display: none !important;"></label>
                </div>
                <div class="form-group">
                    <label for="">Ngày hết hạn</label>
                    <input id="" name="expired_date" type="datetime-local" class="form-control" id="" >
                    <!-- <label for="sale" class="error" style="display: none !important;"></label> -->
                </div>
                
                <button type="submit" name="btn_add" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>