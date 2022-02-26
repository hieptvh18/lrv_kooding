$(document).ready(function(){
    $('#categories').change(function(){
        var categories = $(this).val();
        var action = 'filter_pro_admin';
        // use ajax jqr đẩy data , so khớp sql
        $.ajax({
            url: "product",
            method: 'GET',
            data:{
                action:action,
                categories :categories
            },
            // nếu gửi vào xử lí  thành cồng thì đổ dt vào 
            success: function(data){
                $('.list-product').html(data)
            },

        })
    })
});