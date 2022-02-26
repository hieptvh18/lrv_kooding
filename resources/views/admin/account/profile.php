<div class="container-fluid mt-5">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Hồ sơ cá nhân</h3>
            <ol class="breadcrumb" style="border: none !important;">
                <li class="breadcrumb-item"><a href="admin">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>

    </div>
    <!-- 
                    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"> <img src="./public/images/admin/mua_ha_noi.jpg" class="img-circle" width="100%" />
                        <h4 class="card-title mt-2"><?= $_SESSION['admin']['fullname'] ?></h4>
                        <h6 class="card-subtitle">
                            <?php if ($_SESSION['admin']['role_id'] == 3) {
                                echo "Xin chào Admin quản lý";
                            } else
                                echo "Xin chào admin nhân viên";

                            ?>
                        </h6>
                        
                    </center>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tab panes -->
                <div class="card-body">
                    <?php if(isset($_GET['msg'])):?>
                        <div class="alert alert-success"><?= $_GET['msg'] ?></div>
                        <?php endif;?>
                        <?php if(!empty($data['msg'])):?>
                        <div class="alert alert-success"><?= $data['msg'] ?></div>
                        <?php endif;?>
                    <form action="" class="form-horizontal form-material mx-2" method="POST" id="profile_admin">
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name="fullname" value="<?= $_SESSION['admin']['fullname'] ?>" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input disabled type="email" value="<?= $_SESSION['admin']['email'] ?>" class="form-control form-control-line" name="email" id="example-email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ngày sinh</label>
                            <input type="date" value="<?= $_SESSION['admin']['birthday'] ?>" name="birthday" id="birthday" placeholder="Ngày sinh của bạn" class="form-control">
                        </div>
                        <div class="gender col-md-12 mb-4 mt-4">
                            <label for="">Giới tính</label>
                            <div class="form-check-inline">
                                <input class="form-check-input" <?= $_SESSION['admin']['gender'] == 0 ? 'checked' : ''  ?> value="0" id="gender" type="radio" name="gender">
                                <label for="gender" class="form-check-label mr-4">
                                    Nam
                                </label>
                                <input class="form-check-input" <?= $_SESSION['admin']['gender'] == 1 ? 'checked' : ''  ?> id="gender2" value="1" type="radio" name="gender">
                                <label for="gender2" class="form-check-label">
                                    Nữ
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" name="phone" value="<?= save_value("phone") ?><?= $_SESSION['admin']['phone'] ?>" class="form-control form-control-line">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="btnUpdate" class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>

                    <!-- change pass -->
                    <form action="" class="form-horizontal form-material mx-2 mt-5" id="admin_pass">
                        
                        <div class="form-group">
                            <label class="col-md-12">Mật khẩu cũ</label>
                            <div class="col-md-12">
                                <input type="password"  name="password" value="<?= save_value("password") ?>" class="form-control form-control-line" placeholder="Mật khẩu cũ">
                                <?php if(!empty($data['errPass'])):?>
                                    <div class="text-danger"><?= $data['errPass'] ?></div>
                                    <?php endif;?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Mật mới</label>
                            <div class="col-md-12">
                                <input type="password" name="new_password" value="<?= save_value("new_password") ?>" placeholder="Nhập mật khẩu mới" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Xác nhận mật khẩu mới</label>
                            <div class="col-md-12">
                                <input type="password" placeholder="Xác nhận mật khẩu mới" name="confirm_password" value="<?= save_value("confirm_password") ?>" class="form-control form-control-line">
                                <?php if(!empty($data['errPassNew'])):?>
                                    <div class="text-danger"><?= $data['errPassNew'] ?></div>
                                    <?php endif;?>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" name="btnChangePass" class="btn btn-success">Thay đổi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->