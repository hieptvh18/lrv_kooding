$(document).ready(function () {
    $('.title-register').click(function () {
        $('.title-register').css('border-bottom','2px solid #6b7c88')
        $('.title-sign_in').css('border-bottom','0')
        $('#register_user').css('display','block');
        $('#login_user').css('display','none');

    })
    $('.title-sign_in').click(function () {
        $('.title-register').css('border-bottom','0')
        $('.title-sign_in').css('border-bottom','2px solid #6b7c88')
        $('#login_user').css('display','block');
        $('#register_user').css('display','none');
    })
})
