<main class="forgot_password">
    <div class="forgot_content">
        <div class="forgot_title">
            <p>Quên mật khẩu</p>
        </div>
        <div class="forgot_text">
            <p>Không vấn đề gì! Chỉ cần nhập email của bạn bên dưới và chúng tôi sẽ gửi cho bạn mật khẩu mới.</p>
        </div>
        <form action="" class="forgot_form" method="POST">
            <div class="forgot_input">
                <input type="text" class="forgot" value="<?= save_value("email") ?>" name="email" placeholder="Nhập email của bạn">
            </div>
            <?php if(!empty($data['err'])):?>
                <div class="text-danger mb-2"><?= $data['err'] ?></div>
                <?php endif;?>
            <div class="result">
                <?php if(!empty($data['output'])):?>
                    <div class="alert alert-success">Mật khẩu mới của bạn là: <?= $data['output'] ?></div>
                    <?php endif;?>
            </div>
            <button type="submit" class="forgot_btn" name="forgot_btn">Giử ngay bây giờ</button>
        </form>
    </div>
</main>