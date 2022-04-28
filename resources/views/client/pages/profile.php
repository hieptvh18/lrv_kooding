<main class="body__acc">
    <?php if (isset($_GET['msg'])) : ?>
        <div class="alert alert-success p-2">
            <?php echo $_GET['msg'] ?>
        </div>
    <?php endif; ?>
    <div class="body__acc__header">

        <div class="body__acc__fist">

            <div class="body__acc__title">
                <div class="acc__title__fist active">

                    <p>Thông tin tài khoản</p>
                </div>
                <div class="acc__title__fist ">
                    <p>Đơn hàng</p>
                </div>
                <div class="acc__title__text mt-3">
                    <p>Chào mừng bạn trở lại <?php if(isset($_SESSION['admin'])){
                        echo $_SESSION['admin']['fullname'];
                    }else{
                        echo $_SESSION['customer']['fullname'];
                    } ?></p>
                </div>
            </div>
            <div class="body__acc__menu">
                <div class="acc__show__menu" onclick="menu();">
                    <div class="show__menu__title">
                        <p>Bảng Điều Khiển</p>
                    </div>
                    <div class="show__menu__icon">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </div>
                </div>
                <nav class="acc__allmenu show__menu">
                    <div class="acc__menu__item active">
                        <a href="">Thông tin tài khoản</a>
                    </div>
                    <div class="acc__menu__item">
                        <a href="">Đơn hàng</a>
                    </div>
                    <div class="acc__line"></div>
                </nav>
            </div>
        </div>
    </div>
    <div class="body__acc__content">
        <div class="acc__tab__menu active">
            <div class="acc__menu__content">
                <div class="acc__donhang">
                    <div class="acc__DH__title">
                        <p>Thông tin tài khoản của bạn</p>
                    </div>
                    <?php if (!empty($data['msg'])) : ?>
                        <div class="bg-success p-2">
                            <?php echo $data['msg'] ?>
                        </div>
                    <?php endif; ?>


                    <div class="acc__DH__content1">
                        <div class="DH__title">
                            <p>Đăng nhập xã hội: </p>
                            <img src="public/images/layout/fb-logo-col.svg" alt="" class="">
                        </div>
                        <div class="DH__form">
                            <form action="" method="POST" id="form_profile">
                                <div class="DH__form1">
                                    <label for="">Họ và tên</label>
                                    <input type="text" name="fullname" value="<?= $_SESSION['customer']['fullname'] ?>">
                                </div>
                                <!-- <div class="DH__form1">
                                    <label for="">Tên hiển thị <i>* Để nhận xét và nhận xét sản phẩm.</i></label>
                                    <input type="text" value="Trương Nghĩa">
                            
                                </div> -->
                                <div class="DH__form1">
                                    <label for="">E-mail <i>* Nơi bạn nhận được thông tin đặt hàng.</i></label>
                                    <input type="email" name="email" disabled value="<?= $_SESSION['customer']['email'] ?>">

                                </div>
                                <div class="DH__form1">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" name="phone" value="<?= $_SESSION['customer']['phone'] ?>">
                                </div>
                                <div class="DH__form1">
                                    <label for="">Ngày sinh</label>
                                    <input type="date" name="birthday" value="<?= $_SESSION['customer']['birthday'] ?>">
                                </div>
                                <div class="DH__form2">
                                    <label class="sex__text" for="">Giới tính</label>
                                    <div class="DH__checkBox">

                                        <div class="pretty p-default">
                                            <input <?= $_SESSION['customer']['gender'] == 0 ? 'checked' : '' ?> type="radio" id="nam" name="gender" value="0" />
                                            <div class="state p-info">
                                                <label for="nam">Nam</label>
                                            </div>
                                        </div>
                                        <div class="pretty p-default">
                                            <input <?= $_SESSION['customer']['gender'] == 1 ? 'checked' : '' ?> type="radio" id="nu" name="gender" value="1" />
                                            <div class="state p-info">
                                                <label for="nu">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="DH__submit">
                                    <button type="submit" name="btn_update">Lưu thông tin của tôi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="acc__donhang">
                    <div id="changePass" class="acc__DH__title">
                        <p>Thay đổi mật khẩu tài khoản</p> <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div id="show" class="acc__DH__content1">
                        <div class="DH__form">
                            <form action="" method="post" id="form_pass">
                                <div class="DH__form1">
                                    <label for="">Mật khẩu cũ</label>
                                    <input name="password" type="password" value="<?= save_value("password") ?>">
                                    <?php if (isset($data['errPass'])) : ?>
                                        <div class="text-danger"><?php echo $data['errPass'] ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="DH__form1">
                                    <label for="">Mật khẩu mới</label>
                                    <input name="password_new" type="password" value="<?= save_value("password_new") ?>">
                                </div>
                                <div class="DH__form1">
                                    <label for="">Xác nhận mật khẩu</label>
                                    <input name="password_comfim" type="password">
                                </div>
                                <?php if ($data['err_pass']) : ?>
                                    <div class="text-danger">
                                        <?php echo $data['err_pass']; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="DH__submit">
                                    <button type="submit" name="btn_change_pass">Cập nhật mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="acc__tab__menu">
            <div class="acc__menu__content">
                <div class="acc__donhang">
                    <div class="acc__DH__title">
                        <p>Lịch sử đơn hàng</p>
                    </div>
                    <?php if (count($data['my_orders']) <= 0) : ?>
                        <div class="acc__DH__content">
                            <div class="DH__content__title">
                                <p>Không tìm thấy đơn hàng</p>
                            </div>
                            <div class="DH__content__body">
                                <img src="public/images/layout/empty-orders.jpg" alt="">
                            </div>
                        </div>
                    <?php else : ?>
                        
                        <div class="acc__DH__content">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>ID </th>
                                            <th>Tổng tiền hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Tình trạng đơn</th>
                                            <!-- <th>Chức năng</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n = 1;
                                        foreach ($data['my_orders'] as $o) : ?>
                                            <tr>
                                                <td><?= $n ?></td>
                                                <td><?= $o['id'] ?></td>
                                                <td class="font-weight-bold"><?= number_format($o['total_price'], 0, ',') ?>đ</td>
                                                <td><?= $o['phone'] ?></td>
                                                <td><?= $o['created_at'] ?></td>
                                                <td class="font-weight-medium">
                                                    <?php if ($o['status'] == 2) : ?>
                                                        <div class="badge badge-success">Đã gửi hàng</div>
                                                    <?php elseif ($o['status'] == 1) : ?>
                                                        <div class="badge badge-warning">Đang xử lí</div>
                                                    <?php elseif($o['status'] == 0) : ?>
                                                        <div class="badge badge-danger">Chưa xác nhận</div>
                                                    <?php else: ?>
                                                        <div class="badge badge-danger">Đã bị hủy</div>
                                                    <?php endif;?>
                                                </td>
                                                <!-- <td>
                                                    <a href="order?action=viewDetail&id=<?= $o['id'] ?>" class="btn btn-primary text-light">Đã nhận được hàng</a>
                                                </td> -->
                                            </tr>
                                        <?php $n++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</main>