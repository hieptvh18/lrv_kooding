<main class="body__like">
    <div class="title__like">
        <p>Các mặt hàng yêu thích của bạn!</p>
    </div>
    <div class="content__like">

        <?php if (isset($data['list_favo']) && (count($data['list_favo']) > 0)) : ?>
            <section class="like__Allitem">
                <?php foreach ($data['list_favo'] as $item) : ?>
                    <form id="favorite" action="cartClient" class="like__item" method="POST">
                        <div class="c">
                            <a href="productDetail?action=viewDetail&id=<?= $item['pro_id'] ?>" class="like__img">
                                <img src="public/images/products/<?= $item['avatar'] ?>" alt="" width="100%">
                            </a>
                        </div>

                        <div class="like__name">
                            <p><?= $item['name'] ?></p>
                        </div>
                        <div class="like__price">
                            <p><?= number_format($item['price'], 0, ',') ?>d</p>
                        </div>
                        <div class="like__filters">
                            <!-- case -> save session -->
                            <?php if (isset($_SESSION['favorite'])) : ?>
                                <div class="like__filter__color">
                                    <select class="filter__select" name="color">
                                        <?php foreach ($item['color_name'] as $i) : ?>
                                            <?php foreach ($i as $c) : ?>
                                                <option value="<?= $c['id'] ?>"><?= $c['value'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="like__filter__color">
                                    <select class="filter__select" name="size">
                                        <?php foreach ($item['size_name'] as $i) : ?>
                                            <?php foreach ($i as $c) : ?>
                                                <option value="<?= $c['id'] ?>"><?= $c['value'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            <?php else : ?>
                                <?php
                                $color_id = [];
                                $size_id = [];
                                $color_name = [];
                                $size_name = [];
                                // chuyển mảng 2 chieefu về thành chuỗi

                                foreach (color_select_pro($item['pro_id']) as $c) {
                                    array_push($color_id, $c['value_id']);
                                }
                                foreach (size_select_pro($item['pro_id']) as $s) {
                                    array_push($size_id, $s['value_id']);
                                }
                                // lặp và lấy name bỏ vào mảng;
                                foreach ($color_id as $c) {
                                    array_push($color_name, select_name_value_pro($c)); // lại là mảng 3 chìu
                                }
                                foreach ($size_id as $s) {
                                    array_push($size_name, select_name_value_pro($s)); // lại là mảng 3 chìu
                                }
                                ?>
                                <!-- save db -->
                                <div class="like__filter__color">
                                    <select class="filter__select" name="color">
                                        <?php foreach ($color_name as $i) : ?>
                                            <?php foreach ($i as $c) : ?>
                                                <option value="<?= $c['id'] ?>"><?= $c['value'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="like__filter__color">
                                    <select class="filter__select" name="size">
                                        <?php foreach ($size_name as $i) : ?>
                                            <?php foreach ($i as $c) : ?>
                                                <option value="<?= $c['id'] ?>"><?= $c['value'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                            <?php endif; ?>


                            <div class="like__filter__color">
                                <input type="number" name="quantity" class="filter__select" value="1" name="" id="">
                                <input type="hidden" name="pro_id" value="<?= $item['pro_id'] ?>">
                            </div>


                        </div>
                        <a href="productFavoriteClient?action=del&id=<?= $item['pro_id'] ?>" onclick="showError();" class="like__close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <div onclick="showSuccess();" class="like__addCart">
                            <button type="submit" name="action">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                <?php endforeach; ?>



                <div class="itemm"></div>
                <div class="itemm"></div>
                <div class="itemm"></div>
                <div class="itemm"></div>

            </section>
        <?php endif; ?>
    </div>
    <div id="toast">
    </div>
</main>