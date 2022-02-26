<main class="body__details">
    <div class="product-page pt-4">
        <div class="subnav-trail">
            <a href="productClient?action=list">Mặt hàng</a>
            <span class="divider">/</span>
            <a href="#">Quần áo</a>
            <span class="divider">/</span>
            <a href="#">Chi tiết sản phẩm</a>
            <span class="divider">/</span>
            <a href="#pd-info"><?= $data['pros']['name'] ?></a>
        </div>
        <!-- <div class="" id="test"></div> -->

    </div>
    <div class="product-display">
        <div class="pd-content">
            <div class="pd-image">
                <!-- chứa slider và hình ảnh chi tiết -->
                <div class="pd-image__left">
                    <div class="img__scroll">
                        <?php foreach ($data['list_img'] as $item) : ?>
                            <button id="img1" class="thunb__img">
                                <img src="public/images/products/<?= $item['url'] ?>" alt="">
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="pd-image__right">
                    <div class="img__right">
                        <img src="public/images/products/<?= $data['pros']['avatar'] ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="pd-info" id="pd-info">
                <!-- chứa thông tin chi tiết sp -->
                <form class="pd__right" action="cartClient" method="POST" id="form-add-bag">
                    <input type="hidden" id="pro_id" name="id" value="<?= $data['pros']['id'] ?>">
                    <div class="pd-info-head">
                        <div class="pd-brand-sub"><span class="pd-brand-name"><a href="/mind-bridge/b/252">Brand:</a></span></div>
                        <div class="pd-name"><?= $data['pros']['name'] ?></div>
                    </div>
                    <div class="pd-price ">
                        <div id="price-observer">
                            <div class="default-price"><span class="currency lc"></span><span class="number"> <?= number_format($data['pros']['price'] - $data['pros']['discount']) ?>đ</span></div>

                            <?php if ($data['pros']['discount'] > 0) : ?>
                                <div class="price__sale">
                                    <span class="price__sale--fist"><?= number_format($data['pros']['price']) ?>đ</span>
                                    <span class="price__sale--off"><?= number_format($data['pros']['discount'] / $data['pros']['price'] * 100, 0, ',', '.') ?>%</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="pd-sku">
                            <p>Kho : <?= $data['pros']['quantity'] ?></p>
                        </div>
                    </div>
                    <div class="pd-processing-time" data-nosnippet="">
                        <div class="rewards-wrap"><span class="rewards-amount-total">
                                Đặt hàng thuận tiện, sản phẩm đa dạng, chất lượng cao cấp và nhận hàng cực kì nhanh chóng!
                            </span></div>

                    </div>
                    <div class="pd-color">
                        <label for="color">Chọn màu sắc</label> <br>
                        <select border-opacity-50 name="color" id="color">
                            <?php foreach ($data['color'] as $item) : ?>
                                <?php foreach ($item as $c) : ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['value'] ?></option>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="errC text-danger"></div>
                    </div>
                    <div class="pd-color">
                        <div class="size">Kích cỡ</div>
                        <select border-opacity-50 name="size" id="size">
                            <?php foreach ($data['size'] as $item) : ?>
                                <?php foreach ($item as $s) : ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['value'] ?></option>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select> <br>
                        <div class="errS text-danger"></div>

                        <a style="color: #64abd6 !important;" class="size-info" href="#2">Tôi nên lấy kích cỡ nào?</a>
                    </div>
                    <div class="pd-color">
                        <div class="quantity">Số lượng</div>
                        <input type="number" class="quantity" min="1" name="quantity" style="margin-top: 10px;padding: 5px 5px;width: 70px;" value="1" id="quantity">
                        <div class="errQ text-danger"></div>

                        <div class="errQty text-danger"></div>
                    </div>
                    <div class="msg"></div>
                    <div class="er"></div>
                    <div class="fav-forms-wrap">
                        <div class="animate-button-wrap pd-buttons">
                            <input type="hidden" id="storage" name="storage" value="<?= $data['pros']['quantity'] ?>">
                            <button type="submit" id="checkout_0" class="pd-checkout animate black loader">Thêm vào giỏ hàng</button>
                            <span onclick="showLove()" class=" btn_add_fa">
                                <i class="far fa-heart"></i>
                                <input type="hidden" class="pro_id" name="pro_id" value="<?= $data['pros']['id'] ?>">
                            </span>
                        </div>
                    </div>
                    <div class="body__content__detail">
                        <div class="content__detail__info">
                            <div id="1" class="info__title">
                                <p>Thông tin chi tiết</p>
                                <div class="info__icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                            <div class="info__body">
                                <p>Mô tả</p>
                                <span><?= $data['pros']['description'] ?></span>
                            </div>
                        </div>
                        <div class="content__detail__info">
                            <div id="2" class="info__title">
                                <p>Kích thước & phù hợp</p>
                                <div class="info__icon">
                                    <i class="fas fa-plus minus"></i>
                                </div>
                            </div>
                            <div class="info__body">
                                <div class="info_table_size">
                                    <table class="tb_size">
                                        <tbody>
                                            <tr class="tb_title">
                                                <th>Khích thước</th>
                                                <th>inch</th>
                                                <th>cm</th>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Vai</td>
                                                <td>28.4</td>
                                                <td>124.0</td>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Ngực</td>
                                                <td>48.4</td>
                                                <td>122.0</td>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Eo</td>
                                                <td>48.4</td>
                                                <td>124.0</td>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Lỗ cánh tay</td>
                                                <td>18.4</td>
                                                <td>24.0</td>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Tay áo</td>
                                                <td>28.4</td>
                                                <td>124.0</td>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Lỗ tay áo</td>
                                                <td>18.4</td>
                                                <td>24.0</td>
                                            </tr>
                                            <tr class="tb_item">
                                                <td>Chiều dài</td>
                                                <td>38.4</td>
                                                <td>124.0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="content__detail__info">
                            <div id="3" class="info__title">
                                <p>Vật chuyển và trả hàng</p>
                                <div class="info__icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                            <div class="info__body">
                                <p>Có thể trả lại trong vòng 14 ngày kể từ ngày giao hàng. Chính sách hoàn trả</p>
                                <span>Miễn phí vận chuyển có sẵn trên toàn thế giới. Kiểm tra chính sách vận chuyển của chúng tôi để xem yêu cầu đặt hàng tối thiểu của quốc gia bạn. Chính sách vận chuyển .</span>
                            </div>
                        </div>
                        <div class="content__detail__info">
                            <div id="4" class="info__title">
                                <p>Giới thiệu Kooding</p>
                                <div class="info__icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                            <div class="info__body">
                                <span>Đơn giản và bảo thủ, JUSTONE cung cấp một bộ sưu tập đầy đủ quần áo dành cho phụ nữ, thoải mái và không rắc rối. Từ áo phông cổ điển đến quần short và quần lọt khe dài, lựa chọn quần áo thiết thực của JUSTONE là lý tưởng cho cuộc sống hàng ngày.</span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="box__slider__ct">
            <p class="vclll">Bạn cũng có thể thích</p class="vclll">
            <div class="slider-album__content">
                <!-- slider ảnh sp liên quan -->
                <?php foreach ($data['relate_pros'] as $item) : ?>
                    <div class="image-item">
                        <a href="productDetail?action=viewDetail&id=<?= $item['id'] ?>">
                            <div class="item__boxImg">
                                <img src="./public/images/products/<?= $item['avatar'] ?>" alt="">
                            </div>
                        </a>
                        <p><?= $item['name'] ?></p>
                        <span><b><?= number_format($item['price'], 0, ',') ?> VND</b></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="sp-title">
            <p class="vclll">Bình luận của khách hàng</p>
            <div class="form__comment">
                <?php if (isset($_SESSION['customer']) || isset($_SESSION['admin'])) : ?>
                    <div class="form__top" style="display:flex; align-items:center;">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="input__comment">
                                <div class="avatar__comment">
                                    <img src="./public/images/album/ong1.jpg" alt="" width="100%">
                                </div>
                                <div class="input__keys">
                                    <input type="text" name="content" placeholder="Bình luận của bạn">
                                    <div class="input__image">
                                        <input type="file" name="image" value="📁">
                                    </div>
                                    <div class="sub__comment">
                                        <button name="btn_cmt" type="submit"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php if (!empty($data['errCmt'])) : ?>
                            <div class="errCmt text-danger ml-5">
                                <?php echo $data['errCmt']; ?>
                                <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($data['errImg'])) : ?>
                            <div class="errCmt text-danger ml-5">
                                <?php echo $data['errImg']; ?>
                                <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="form__content">
                    <div class="comment__itemAll">
                        <?php foreach ($data['list_cmt'] as $item) : ?>
                            <div class="item__comment">
                                <div class="item__ava">
                                    <img src="./public/images/album/ong1.jpg" alt="" width="100%">
                                </div>
                                <div class="item__right">
                                    <div class="item__name">
                                        <p><?= $item['fullname'] ?></p>
                                    </div>
                                    <div class="item__time">
                                        <i><?= $item['created_at'] ?></i>
                                    </div>
                                    <div class="item__nd">
                                        <p><?= $item['content'] ?></p>
                                    </div>
                                    <div class="item__img">
                                        <img src="./public/images/upload/<?= $item['image'] ?>" alt="" width="100%">
                                    </div>
                                    <div class="item__more">
                                        <?php if (isset($_SESSION['admin'])) : ?>
                                            <a href="comment?action=del&cmt_id=<?= $item['id'] ?>&pro_id=<?= $data['pros']['id'] ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <p class="vclll">Hình ảnh chi tiết</p>
            <div class="full-images">
                <div class="full__box__img">
                    <?php foreach ($data['list_img'] as $item) : ?>
                        <div class="pd__item__img">
                            <img src="./public/images/products/<?= $item['url'] ?>" alt="" width="100%">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="gallery_pros">
                    <div class="control_pros_close">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="gallery_pros_img">
                        <img src="./public/images/products/0c7a6702fb366f8e1047ea5b3bd0eda64b812378 - Copy.jpg" alt="">
                    </div>
                    <div class="control_pros prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="control_pros next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="" id="test"></div> -->
        <div id="toast"></div>
</main>
<!-- end main -->
<script>
    const proIds = document.querySelector('.pro_id')
    const btn = document.querySelector('.btn_add_fa')
    btn.addEventListener('click', function() {
        var id = proIds.value
        var action = "add";
        // gửi value -> php qua ajax (module favorite product)
        $.ajax({
            url: 'productFavoriteClient',
            method: 'GET',
            data: {
                action: "add",
                pro_id: id,
            },
            success: function(data) {
                $('#test').html(data)
            },
            error: function(data) {
                $('#test').html(data)
            }
        })


    })
</script>
<!-- add to bag -->
<script>
    $(document).ready(function() {
        $('#form-add-bag').submit(function(e) {
            e.preventDefault()

            var action = "addBag";
            var pro_id = $('#pro_id').val()
            var color = $('#color').val()
            var size = $('#size').val()
            var quantity = $('#quantity').val()
            var storage = $('#storage').val()

            // check nếu sl chọn mua nhỏ vượt qua slg trong kho thì mess err

            if(quantity > storage){
                // alert('đù lớn hơn r')
                $('.errQty').html('Số lượng sản phẩm còn lại không đủ để bán cho bạn!')
            }else{
                showSuccess()
                $.ajax({
                url: 'cartClient',
                method: 'POST',
                data: {
                    action: action,
                    pro_id: pro_id,
                    color:color,
                    size:size,
                    quantity:quantity
                },
                success: function(data){
                    $('#test').html(data)
                }
            })
            }

           
        })
    })
</script>