<header>

    <div class="header-top swiper mySwiper">
        <div class="swiper-wrapper">
            <a href="#" class="swiper-slide slider-top1">
                <!-- nếu có vourcher thì hiển thị nhiều nhất 2 cái -->
                <?php if (is_array($data['vourchers']) > 0) {
                    echo "Nhanh tay nhập mã giảm giá để giảm giá cho đơn hàng! - ";
                    echo $data['vourchers']['code'];
                    if ($data['vourchers']['cate_code'] == 0) {
                        echo "- giảm " . number_format($data['vourchers']['discount'], 0, ',') . 'đ cho đơn hàng.';
                    } else {
                        echo "- giảm " . $data['vourchers']['discount'] . '% cho đơn hàng.';
                    }
                } else {
                    echo "Covid-19";
                } ?>
            </a>
            <a href="#" class="swiper-slide slider-top2">Vận chuyển nhanh chóng và tin cậy 🚛</a>
        </div>
    </div>
    <!-- end header-top -->
    <div class="header-main">
        <div class="box-header-main">
            <div class="box-header-main__start">
                <div class="bars">
                    <div class="menu__bars">
                        <div class="btn__burger"></div>
                    </div>
                </div>
                <a href="index" class="logo">
                    <img src="public/images/layout/<?= $data['display']['logo'] ?>" alt="" class="logo-img">
                </a>
            </div>
            <div class="search">
                <form action="productClient" class="form-search" method="GET">
                    <div class="pop-input">
                        <select name="filter-cate" class="filter-cate">
                            <option value="all"><a href="">Tất cả</a></option>
                            <?php foreach ($data['list_cate'] as $item) : ?>
                                <option <?= isset($_GET['filter-cate']) && $_GET['filter-cate'] == $item['id'] ? 'selected' : '' ?> value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="search" name="keyword" placeholder="Tìm kiếm" required>
                    </div>
                    <button type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="user-options">
                <div class="search-rp"></div>

                <?php if (isset($_SESSION['customer'])) : ?>
                    <div class="profile pt-4 pb-4">
                        <span class="title-pop-user">Hồ sơ<i class="fa fa-angle-down ml-2" aria-hidden="true"></i></span>
                        <div class="pop-profile">
                            <a href="accountClient?action=viewProfileClient">Bảng điều khiển</a>

                            <a href="accountClient?action=logoutClient" onclick="return confirm('Bạn chắc chắn muốn đăng xuất')">Đăng xuất</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="account pt-4 pb-4" id="popup-user" data-toggle="modal" data-target="#box-login-register">
                        <span class="title-pop-user">Đăng nhập / Đăng ký</span>
                        <span class="icon__account"><i class="fas fa-user-circle"></i></span>
                    </div>
                <?php endif; ?>
                <!-- pops up login -->
                <div class="modal fade " role="dialog" id="box-login-register" style="z-index: 100;">
                    <div class="modal-dialog">
                        <div class="modal-content box-content-user mt-5">
                            <div class="modal-header" style="border:none;padding-bottom:0;">
                                <button type="button" class="close" data-dismiss="modal" style="outline:none;">&times;</button>
                            </div>

                            <div class="modal-body box-user">
                                <div class="title">
                                    <span class="title-sign_in">Đăng nhập</span>
                                    <span class="title-register">Đăng ký</span>
                                </div>
                                <div class="welcome">
                                    Chào mừng bạn!
                                </div>
                                <?php if(!empty($data['msg_login'])): ?>
                                    <div class="bg-danger"><?= $data['msg_login'] ?></div>
                                    <?php endif;?>
                                <form method="POST" name="form-login" class="p-5" id="login_user">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Nhập email" value="<?= isset($_COOKIE['emailClient']) ? $_COOKIE['emailClient'] : '' ?>" class=" email" id="email_login" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Nhập mật khẩu" class="password" value="<?= isset($_COOKIE['passwordClient']) ? $_COOKIE['passwordClient'] : '' ?>" id="password_login">
                                    </div>
                                    <div class="pretty p-default mb-4 mt-4">
                                        <input type="checkbox" <?= isset($_COOKIE['emailClient']) ? 'checked' : '' ?> id="remember" name="remember" />
                                        <div class="state">
                                            <label>Nhớ thông tin</label>
                                        </div>
                                    </div>
                                    <div class="errLogin text-danger pb-2">

                                    </div>
                                    <button type="submit" class="col-md-12 btn btn-secondary p-2" id="btn_login_client">Đăng
                                        nhập</button>
                                    <div class="forgot-pass text-center m-3">
                                        <a href="forgotPass">Bạn quên mật khẩu?</a>
                                    </div>
                                    <div class="err" style="color:red;">

                                    </div>
                                </form>
                                <!-- register -->
                                <form action="" method="POST" enctype="multipart/form-data" name="form-register" id="register_user" class="p-5">
                                    <div class="errRegister" style="color:red;">

                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="fullname" id="fullname" placeholder="Tên đầy đủ" class="fullname">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email_register" placeholder="Nhập email" class=" email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Nhập mật khẩu" class=" password" id="pass_register">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="birthday" id="birthday" placeholder="Ngày sinh của bạn" class="birthday">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" id="phone" placeholder="Số điện thoại của bạn" class="phone">
                                    </div>
                                    <div class="gender col-md-12 mb-4 mt-4">
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

                                    <button type="submit" class="col-md-12 btn btn-secondary p-2" id="btn_register">Tạo tài khoản</button>
                                    <div class="forgot-pass text-center m-3">
                                        <p>Bạn chắc chắn rằng sẽ đồng ý với những điều khoản của chúng tôi!</p>
                                    </div>

                                </form>
                            </div>

                            <div class="modal-footer" style="display:block;">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal login-->
                <a href="#lang" class="lang pt-4 pb-4">
                    <img src="public/images/layout/vietnam.png" alt="">
                </a>
                <div class="box-favorite-pro pt-4 pb-4">
                    <a href="productFavoriteClient" class="favorite-pro">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </a>
                    <div class="notifi">
                        <?= $data['count_favo']; ?>
                    </div>
                </div>
                <div class="box-cart pt-4 pb-4">
                    <a href="cartClient" class="cart">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    </a>
                    <div class="notifi">
                        <?php if (isset($_SESSION['cart'])) {
                            echo count($_SESSION['cart']);
                        } else {
                            echo "0";
                        } ?>
                    </div>
                    <!-- start popup-cart -->
                    <div class="pop-cart">
                        <?php if (isset($_SESSION['cart'])) : ?>
                            <div class="pop-cart__top">
                                <div class="left">
                                    <div class=""> <i class="fa fa-shopping-bag " aria-hidden="true"></i></div>
                                </div>
                                <div class="right">
                                    <span class="total">Tổng tiền:</span>
                                    <span class="total-price"></span>
                                </div>
                            </div>

                            <?php $tt = 0;
                            foreach ($_SESSION['cart'] as $item) : $thanhtien = $item['quantity'] * $item['price']; ?>
                                <div class="pop-cart__main row p-3">
                                    <div class="col-3 col-md-3">
                                        <a href="productDetail?action=viewDetail&id=<?= $item['id'] ?>">
                                            <img src="public/images/products/<?= $item['avatar'] ?>" alt="" width="100%">
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="pro-name mb-2"><?= $item['name'] ?></div>
                                        <div class="desc">
                                            <?= attr_value_select_id($item['color']) ?> | Size <?= attr_value_select_id($item['size']) ?> | SL <?= $item['quantity'] ?>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-3 cart-option">
                                        <div class="pro-price mb-5"><?= $thanhtien ?>đ</div>
                                        <a href="cartClient?action=del&id=<?= $item['cart_id'] ?>" class="text-danger">Hủy bỏ</a>
                                    </div>
                                </div>
                            <?php $tt += $thanhtien;
                            endforeach; ?>

                            <div class="pop-cart__bottom">
                                <a href="checkoutClient?action=checkout" class="text-white bg-secondary">Thanh toán</a>
                                <a href="cartClient" class="">Vào giỏ hàng</a>

                            </div>
                        <?php else : ?>
                            <div class="DH__content__body">
                                <div class="">
                                    <h3 class="" style="color:#FFBC7F;">Giỏ hàng của bạn đang rỗng!</h3>
                                    <a href="productClient?action=viewListProduct" class="text-primary text-center">Mua sắm ngay</a>
                                </div>
                                <div class="">
                                    <img src="./public/images/layout/empty-orders.jpg" alt="">
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-menu">
            <ul class="sub-nav m-0">
                <li><a href="productClient?action=list">#ALL</a></li>
                <?php foreach ($data['list_cate'] as $c) : ?>
                    <li><a href="productClient?action=list&filtercate=<?= $c['id'] ?>"><?= $c['name'] ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <li class="view_admin">
                        <a href="admin">Vào trang quản trị<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <li><a href="newsClient">Tin tức</a></li>
                <li><a href="albumClient">#KOODING</a></li>
            </ul>
        </div>

    </div>
    <!-- end header-main -->

</header>
<script>
    $(document).ready(function() {
        $('.total-price').html(<?= $tt ?>);
    })
</script>