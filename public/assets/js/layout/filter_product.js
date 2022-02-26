$(document).ready(function () {
    //   hàm xử lí data + ajax
    // alert('haha');
    // filter_data();
    // function filter_data() {
    //     var filter = "price";
    //     var minimum_price = $('#hidden_minimum_price').val();
    //     var maximum_price = $('#hidden_maximum_price').val();
       
    //     // dùng ajax đẩy data từ client-> server
    //     $.ajax({
    //         url: "product?action=viewListProduct",
    //         method: "GET",
    //         data: {
    //             filter: filter,
    //             minimum_price: minimum_price,
    //             maximum_price: maximum_price,
              
    //         },
    //         // nếu gửi và xử lí thành công thì đổ data vào div filter_data
    //         success: function (data) {
    //             $('.proC__allItem').html(data)
    //         }
    //     })
    // }

    // input range
    $('#price_range').slider({
        range: true,
        min: 10000,
        max: 10000000,
        values: [10000, 10000000],
        step: 50000,
        stop: function (event, ui) {
            $('#price_show').html('Từ :' + ui.values[0] + '-' + ui.values[1])
            $('#hidden_minimum_price').val(ui.values[0])
            $('#hidden_maximum_price').val(ui.values[1])
            // filter_data();
        }
    })
});