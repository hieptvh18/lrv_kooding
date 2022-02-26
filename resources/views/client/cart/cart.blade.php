<main class="body__cart">
    <div class="body__cart__title">
        <h3>Giỏ hàng mua sắm</h3>
        <?php if (isset($_GET['msg'])) : ?>
            <div class="bg-success p-2 text-light"><?= $_GET['msg'] ?></div>
        <?php endif; ?>
        <?php if (!empty($data['msg'])) : ?>
            <div class="bg-success p-2 text-light"><?= $data['msg'] ?></div>
        <?php endif; ?>
    </div>
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) : ?>
        <div class="cart__content">
            <div class="cart__checkout">
                <div class="cart__checkout__title">
                    <span class="cart__title__text1">Những hạng mục của bạn</span>
                    <span class="cart__title__text2">Số lượng</span>
                    <span class="cart__title__text3">Giá vật phẩm</span>
                </div>
                <div class="cart__checkout__content">
                    <ul class="cart__items">
                        <?php $tt = 0;
                        foreach ($_SESSION['cart'] as $item) : $thanhtien = $item['price'] * $item['quantity'] ?>
                            <li class="ci__wrap">
                                <div class="ci__wrap__content">
                                    <div class="cart__left">
                                        <div class="cart__left__img">
                                            <a href="productDetail?action=viewDetail&id=<?= $item['id'] ?>">
                                                <img src="./public/images/products/<?= $item['avatar'] ?>" alt="" width="100%"></a>
                                        </div>
                                        <div class="cart__left__info">
                                            <p><?= $item['name'] ?></p>
                                            <span class="db">Thường giao hàng trong 4-8 ngày làm việc</span>
                                            <div class="cart__info__size">
                                                <span>Màu <?= attr_value_select_id($item['color']) ?></span>
                                                <span>|</span>
                                                <span>Size <?= attr_value_select_id($item['size']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart__quanty">
                                        <form action="" method="POST">
                                            <input type="hidden" name="action" value="update_cart">
                                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                            <input type="hidden" name="pro_id" value="<?= $item['id'] ?>">
                                            <input type="number" name="quantity" min="1" step="0" value="<?= $item['quantity'] ?>">
                                            <button type="submit" name="btn_update_qty" class="btn btn-info"><i class="fa fa-refresh" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="cart__price">
                                        <span><?= number_format($thanhtien, 0, ',') ?>đ</span>
                                    </div>
                                </div>
                                <div class="cart__remove">
                                    <a href="cartClient?action=del&id=<?= $item['cart_id'] ?>" class="text-danger">Xóa</a>
                                </div>
                            </li>
                        <?php $tt += $thanhtien;
                        endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="cart__order">
                <div class="cart__order__title">
                    <span>Tóm tắt theo thứ tự</span>
                </div>
                <div class="cart__order__content">
                    <div class="cart__sum__price">
                        <div class="sum__price__text">
                            <span>Tổng phụ</span>
                        </div>
                        <div class="sum__price__dola">
                            <span><?= number_format($tt, 0, ',') ?>đ</span>
                        </div>
                    </div>
                    <div class="cart__btn__order">
                        <a href="checkoutClient?action=checkout">
                            <button type="button">Thủ tục thanh toán</button>
                        </a>
                    </div>
                    <div class="cart__bottom">
                        <span>Bạn kiếm được 3,92 đô la phần thưởng cho đơn đặt hàng này!</span> <br> <br>
                        <span>Phần thưởng sẽ được thêm vào tài khoản của bạn sau khi đơn hàng đã được vận chuyển đầy
                            đủ. Số
                            tiền thưởng có thể thay đổi.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="body__cart__title" id="title2">
            <h3>Đề xuất cho bạn</h3>
        </div>
        <div class="slick__slider">
            <div class="cart__allItem slide-news">
                <?php foreach($data['recommened'] as $item):?>
                <div class="cart__item">
                    <div class="cart__item__img">
                        <a href="productDetail?action=viewDetail&id=<?= $item['id'] ?>">
                            <img src="./public/images/products/<?= $item['avatar'] ?>" alt="" width="100%">
                        </a>
                    </div>
                    <div class="cart__item__Name">
                        <p><?= $item['name'] ?></p>
                    </div>
                    <div class="cart__item__PC">
                        <div class="cart__item__price">
                            <p><?= number_format($item['price']-$item['discount'],0,',') ?>đ</p>
                        </div>
                        <div class="cart__item__color">
                            
                            <img src="public/images/layout/colorwheel-2.png" alt="">
                        </div>
                    </div>
                </div>
                    <?php endforeach;?>
                
            </div>
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
</main>
<?php if(!empty($data['toggle_modal'])){echo $data['toggle_modal'];}?>
<!-- end main -->