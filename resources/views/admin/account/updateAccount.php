<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cập nhật tài khoản</h4>
            <p class="card-description">
                Thêm tài khoản tào lao cho vui
            </p>
            <form action="" method="POST" enctype="multipart/form-data" name="form-register" id="update_user" class="p-5">
                <div class="form-group">
                    <label for="">Tên</label>
                    <input type="text" id="fullname" name="fullname" value="<?= $data['accDetail']['fullname'] ?>" placeholder="Tên đầy đủ" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" disabled value="<?= $data['accDetail']['email'] ?>" name="email" id="email" placeholder="Nhập email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input type="password" value="<?= save_value("password") ?>" name="password" placeholder="Nhập mật khẩu" class="form-control">
                </div>
                <div class="gender col-md-12 mb-4 mt-4">
                    <p><label for="">Vai trò</label></p>
                    <div class="form-check-inline">
                        <input class="form-check-input" <?= $data['accDetail']['role_id'] == 1 ? 'checked' : '' ?> value="1" id="role" type="radio" name="role" >
                        <label for="role" class="form-check-label mr-4">
                            Khách hàng
                        </label>
                        <input class="form-check-input" <?= $data['accDetail']['role_id'] == 2 ? 'checked' : '' ?> id="role1" type="radio" name="role" value="2">
                        <label for="role1" class="form-check-label mr-4">
                            Nhân viên
                        </label>
                        <input class="form-check-input" <?= $data['accDetail']['role_id'] == 3 ? 'checked' : '' ?> id="role3" value="3" type="radio" name="role">
                        <label for="role3" class="form-check-label">
                            Admin quản trị
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ngày sinh</label>
                    <input type="date" value="<?= $data['accDetail']['birthday'] ?>" name="birthday" id="birthday" placeholder="Ngày sinh của bạn" class="form-control">
                </div>
                <div class="gender col-md-12 mb-4 mt-4">
                    <label for="">Giới tính</label>
                    <div class="form-check-inline">
                        <input class="form-check-input" <?= $data['accDetail']['gender'] == 0 ? 'checked' : '' ?> value="0" id="gender" type="radio" name="gender">
                        <label for="gender" class="form-check-label mr-4">
                            Nam
                        </label>
                        <input class="form-check-input" <?= $data['accDetail']['gender'] == 1 ? 'checked' : '' ?> id="gender2" type="radio" name="gender" value="1">
                        <label for="gender2" class="form-check-label">
                            Nữ
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" value="<?= $data['accDetail']['phone'] ?>" name="phone" id="phone" placeholder="Nhập số điện thoại" class="form-control">
                </div>

                <button type="submit" name="btn_update" class="btn btn-primary mr-2">Cập nhật</button>
                <a href="account" class="btn btn-light">Danh sách</a>

            </form>
        </div>
    </div>
</div>