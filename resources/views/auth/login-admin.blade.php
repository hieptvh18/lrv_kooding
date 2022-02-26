<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./public/vendors/feather/feather.css">
  <link rel="stylesheet" href="./public/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./public/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./public/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="./public/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <a href="homepage">
                <img src="./public/images/layout/logo-main.png" alt="logo">
                </a>
              </div>
              <h4>Xin chào? Hãy bắt đầu đăng nhập</h4>
              <h6 class="font-weight-light">Đăng nhập quản trị.</h6>
              <form action="?action=loginAdmin" method="POST" class="pt-3">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" value="<?= save_value('email') ?><?= isset($_COOKIE['emailAdmin'])?$_COOKIE['emailAdmin']:'' ?>" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" value="<?= isset($_COOKIE['emailAdmin'])?$_COOKIE['passwordAdmin']:'' ?>" placeholder="Password">
                </div>
                <?php if(!empty($data['err'])):?>
                  <div class="text-danger">
                    <?php echo $data['err']?>
                  </div>
                  <?php endif;?>
                <div class="mt-3">
                  <button type="submit" name="btnLogin" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >ĐĂNG NHẬP</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember"<?= isset($_COOKIE['emailAdmin'])?'checked':'' ?>>
                      Ghi nhớ tài khoản
                    </label>
                  </div>
                  <a href="forgotPass" class="auth-link text-black">Quên mật khẩu?</a>
                </div>
               
               
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="./public/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="./public/js/jsadmin/off-canvas.js"></script>
  <script src="./public/js/jsadmin/hoverable-collapse.js"></script>
  <script src="./public/js/jsadmin/template.js"></script>
  <script src="./public/js/jsadmin/settings.js"></script>
  <script src="./public/js/jsadmin/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
