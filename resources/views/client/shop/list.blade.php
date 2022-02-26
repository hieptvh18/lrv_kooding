<main class="body__product">
    <div class="product__header">
        <div class="proH__title">
            <p><?= $data['title'] ?></p>
        </div>
        <div class="proH__text1">
            <p>(<?= $data['count'] ?> mặt hàng)</p>
        </div>
        <div class="proH__text2">
            <p>Bạn đang tìm kiếm những sản phẩm hoàn hảo phù hợp với mọi thứ hay chiếc váy dễ thương nhất lấy cảm
                hứng từ
                KOODING</p>
        </div>
    </div>
    
        <div class="product__content">
            <div class="proC__fist">
                <div class="proC__title">
                    <p>Chọn mua những gì phù hợp với bạn</p>
                </div>
                <!-- pagination -->
                <div id="paging1" class="proC__paging">
                    <nav class="pages">
                        <?php if ($data['current_page'] > 1 && $data['total_page'] > 1) : ?>
                            <a href="productClient?action=viewListProduct&page=<?= ($data['current_page'] - 1) ?><?= $data['filter'] . $data['keys'] ?>" class="pageLeft"><i class="far fa-chevron-left"></i></a>
                        <?php endif; ?>
                        <li class="number__paging">
                            <?php for ($i = 1; $i <= $data['total_page']; $i++) {
                                // Nếu là trang hiện tại thì hiển thị thẻ span
                                // ngược lại hiển thị thẻ a
                                if ($i == $data['current_page']) {
                                    echo '<span class="numB numB__active">' . $i . '</span>';
                                } else {
                                    echo '<a href="productClient?action=viewListProduct&page=' . $i . $data['filter'] . '' . $data['keys'] . '" class="numB">' . $i . '</a>';
                                }
                            } ?>
                        </li>
                        <?php if ($data['current_page'] < $data['total_page'] && $data['total_page'] > 1) : ?>
                            <a href="productClient?action=viewListProduct&page=<?= ($data['current_page'] + 1) ?><?= $data['filter'] . $data['keys'] ?>" class="pageRight"><i class="far fa-chevron-right"></i></a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>


            <div class="proC__filters">
                <form class="form__filter" method="POST">
                    <div class="select__price">
                        <div id="price" class="filter__title">
                            <p>Giá</p>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="box__filter__price none">
                            <!-- khi ng dùng thay đổi value input hidden -> show khoảng giá dưới trên range -->
                            <input type="hidden" name="min_price" id="hidden_minimum_price" value="<?= isset($_POST['min_price'])? $_POST['min_price'] :0 ?>">
                            <input type="hidden" name="max_price" id="hidden_maximum_price" value="<?= isset($_POST['max_price'])? $_POST['max_price'] :10000000 ?>">
                            <p id="price_show">
                                <?php if(isset($_POST['min_price'])){
                                    echo "Từ ".number_format($_POST['min_price'],0,',')." đến ".number_format($_POST['max_price'],0,',');
                                }else{
                                    echo "Từ 10 nghìn đến 10 triệu";
                                } ?>
                            </p>
                            <div class="price_range" id="price_range">

                            </div>
                            <!-- btn filter -->
                            <button type="submit" class="text-center btn btn-secondary mt-2 form-control" name="btn_filter_price">Áp dụng</button>
                           
                        </div>
                    </div>
                </form>
            </div>
            <?php if ($data['count'] > 0) : ?>
            <!-- <div class="" id="test"></div> -->
            <div class="proC__show">
                <div class="proC__allItem">
                    <?php if (!empty($data['msg'])) : ?>
                        <p><?php echo $data['msg'];  ?></p>
                    <?php endif; ?>
                    <?php foreach ($data['list_pro'] as $item) : ?>
                        <form action="productFavoriteClient" method="GET" class="proC__item">
                            <div class="proC__item__img">
                                <a href="productDetail?action=viewDetail&id=<?= $item['id'] ?>">
                                    <img src="public/images/products/<?= $item['avatar'] ?> " alt="" width="100%">
                                </a>
                            </div>
                            <div class="proC__item__Name">
                                <p><?= $item['name'] ?></p>
                            </div>
                            <div class="proC__item__PC">
                                <div class="proC__item__price">
                                    <p><?= number_format($item['price'] - $item['discount'], 0, ',', '.') ?>đ</p>
                                </div>
                                <div class="proC__item__color">
                                    <img src="public/images/layout/colorwheel-2.png" alt="">
                                </div>
                            </div>
                            <div onclick="showLove()" class="proC__love">
                                <span class="proC__love__icon btn_add_fa">
                                    <!-- // xử lí nếu sp đã tồn tại favo thì cho icon heart màu đỏ -->
                                    <i class='far fa-heart'></i>
                                    <input type="hidden" class="pro_id" name="pro_id" value="<?= $item['id'] ?>">
                                </span>
                            </div>
                            <?php if ($item['discount'] > 0) : ?>
                                <div class="proC__sale">
                                    <p class="item__sale">-<?= number_format($item['discount'] / $item['price'] * 100, 0, ',', '.') ?>%</p>
                                </div>
                            <?php endif; ?>
                        </form>

                    <?php endforeach; ?>
                </div>

                <!-- end copy -->
                <div class="proC__fist2">
                    <!-- pagination -->
                    <div id="paging2" class="proC__paging">
                        <nav class="pages">
                            <?php if ($data['current_page'] > 1 && $data['total_page'] > 1) : ?>
                                <a href="productClient?action=viewListProduct&page=<?= ($data['current_page'] - 1) ?><?= $data['filter'] . $data['keys'] ?>" class="pageLeft"><i class="far fa-chevron-left"></i></a>
                            <?php endif; ?>
                            <li class="number__paging">
                                <?php for ($i = 1; $i <= $data['total_page']; $i++) {
                                    // Nếu là trang hiện tại thì hiển thị thẻ span
                                    // ngược lại hiển thị thẻ a
                                    if ($i == $data['current_page']) {
                                        echo '<span class="numB numB__active">' . $i . '</span>';
                                    } else {
                                        echo '<a href="productClient?action=viewListProduct&page=' . $i . $data['filter'] . '' . $data['keys'] . '" class="numB">' . $i . '</a>';
                                    }
                                } ?>
                            </li>
                            <?php if ($data['current_page'] < $data['total_page'] && $data['total_page'] > 1) : ?>
                                <a href="productClient?action=viewListProduct&page=<?= ($data['current_page'] + 1) ?><?= $data['filter'] . $data['keys'] ?>" class="pageRight"><i class="far fa-chevron-right"></i></a>
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div id="toast">
    </div>
</main>
<!-- js -->
<script>
    const proIds = document.querySelectorAll('.pro_id')
    const btn = document.querySelectorAll('.btn_add_fa')

    btn.forEach((index, e) => {
        index.addEventListener('click', function() {
            var toilanghia = proIds[e].value
            var action = "add";
            // gửi value -> php qua ajax (module favorite product)
            $.ajax({
                url: 'productFavoriteClient',
                method: 'GET',
                data: {
                    action: action,
                    pro_id: toilanghia,
                },
                success: function(data) {
                    $('#test').html(data)
                }
            })


        })
    })
</script>