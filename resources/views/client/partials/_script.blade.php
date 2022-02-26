<!-- jqr ui-->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- js boostrap 4 -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<!-- lib js query validate cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- js -->
<script src="{{asset('assets/js/layout/main.js')}}"></script>
<script src="{{asset('assets/js/layout/backtop.js')}}"></script>
<script src="{{asset('assets/js/layout/popupLogin.js')}}"></script>
<!-- pro -->
<script src="{{asset('assets/js/layout/products.js')}}"></script>
<script src="{{asset('assets/js/layout/filter_product.js')}}"></script>
<script src="{{asset('assets/js/layout/checkout.js')}}"></script>
<script src="{{asset('assets/js/layout/product-details.js')}}"></script>
<script src="{{asset('assets/js/layout/profile.js')}}"></script>
<script src="{{asset('assets/js/layout/mess.js')}}"></script>
<!-- <script src="./public/js/layout/client.js"></script> -->

<!-- validate form -->
<script src="{{asset('assets/js/validate/validatorClients/validator__profile.js')}}"></script>
<script src="{{asset('assets/js/validate/validatorClients/validator_register.js')}}"></script>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('assets/js/layout/slide_lib.js')}}"></script>
<script type='text/javascript'>
    $(document).ready(function() {

        $("#lightgallery").lightGallery();

    });
</script>

</body>
<script src="https://dl.dropboxusercontent.com/s/6x9xf4l912dcp1d/Lightgallery.js"></script>
<script>
$(document).ready(function() {
    $('#login_user').submit(function(e) {
        e.preventDefault();
        var action = 'loginClient';
        var email = $('#email_login').val();
        var password = $('#password_login').val();
        var remember = $('#remember')
        if (remember.prop("checked") == true) {
            remember = "check";
        } else {
            remember = "null";
        }
        if (email == '' || password == '') {
            $('.errLogin').html('Nhập đầy đủ thông tin');
            return false;
        } else {
            $("#loading_spinner").css({
                "display": "block"
            });
            $.ajax({
                url: "accountClient",
                method: "GET",
                data: {
                    action: action,
                    email: email,
                    mk: password,
                    remember: remember
                },
                success: function(data) {
                    $('.errLogin').html(data)
                }

            })
        }
    })
    // handle register
    $('#register_user').submit(function(e) {
        e.preventDefault();
        var action = 'register';
        var fullname = $('#fullname').val()
        var birthday = $('#birthday').val()
        var email = $('#email_register').val();
        var password = $('#pass_register').val();
        var gender = $('#gender')
        var male = '';
        var female = '';
        // ktra có dc check
        if (gender.prop("checked") == true) {
            male = "check";
            female = null;
        } else {
            female = "check";
            male = null;
        }
        if (email == '' || password == '' || fullname == '' || birthday == '') {
            return false;
        } else {
            $("#loading_spinner").css({
                "display": "block"
            });
            $.ajax({
                url: "accountClient",
                method: "GET",
                data: {
                    action: action,
                    fullname: fullname,
                    birthday: birthday,
                    email: email,
                    mk: password,
                    male: male,
                    female: female

                },
                success: function(data) {
                    $('.errRegister').html(data)
                }

            })
        }
    })

})
</script>