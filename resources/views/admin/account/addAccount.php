<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm tài khoản</h4>
            <p class="card-description">
                Thêm tài khoản tào lao cho vui
            </p>
            <?php if(isset($_GET['msg'])):?>
                <div class="alert alert-success"><?= $_GET['msg'] ?></div>
                <?php endif;?>
            <form action="" method="POST" enctype="multipart/form-data" name="form-register" id="register_user" class="p-5">
                <div class="form-group">
                    <label for="">Tên</label>
                    <input type="text" value="<?= save_value('fullname') ?>" id="fullname" name="fullname" placeholder="Tên đầy đủ" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" value="<?= save_value('email') ?>" name="email" id="email" placeholder="Nhập email" class="form-control">
                    <?php if (!empty($data['errMail'])) : ?>
                        <div class="text-danger"><?= $data['errMail'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input type="password" value="<?= save_value('password') ?>" name="password" placeholder="Nhập mật khẩu" class="form-control">
                </div>
                <div class="gender col-md-12 mb-4 mt-4">
                    <p><label for="">Vai trò</label></p>
                    <div class="form-check-inline">
                        <input class="form-check-input" value="1" id="role" type="radio" name="role" checked>
                        <label for="role" class="form-check-label mr-4">
                            Khách hàng
                        </label>
                        <input class="form-check-input" id="role1" type="radio" name="role" value="2">
                        <label for="role1" class="form-check-label mr-4">
                            Nhân viên
                        </label>
                        <input class="form-check-input" id="role3" value="3" type="radio" name="role">
                        <label for="role3" class="form-check-label">
                            Admin quản trị
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ngày sinh</label>
                    <input type="date" value="<?= save_value('birthday') ?>" name="birthday" id="birthday" placeholder="Ngày sinh của bạn" class="form-control">
                </div>
                <div class="gender col-md-12 mb-4 mt-4">
                    <label for="">Giới tính</label>
                    <div class="form-check-inline">
                        <input class="form-check-input" value="0" id="gender" type="radio" name="gender" checked>
                        <label for="gender" class="form-check-label mr-4">
                            Nam
                        </label>
                        <input class="form-check-input" id="gender2" type="radio" name="gender">
                        <label for="gender2" class="form-check-label">
                            Nữ
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" value="<?= save_value('phone') ?>" name="phone" id="phone" placeholder="Nhập số điện thoại" class="form-control">
                </div>

                <button type="submit" name="btn_add" class="btn btn-primary mr-2">Thêm</button>
                <a href="account" class="btn btn-light">Danh sách</a>

            </form>
        </div>
    </div>
</div>