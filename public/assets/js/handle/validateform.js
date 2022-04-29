// form add vourcher
$("#form_vourcher").validate({
    rules: {
        name: {
            required: true,
            minlength: 10,
        },
        code: {
            required: true,
            minlength: 6,
            vourcher: true,
        },
        quantity: {
            required: true,
            number: true,
        },
        expired_date: {
            required: true,
            date: true,
            nghiadz: true,
        },
        discount: {
            required: true,
        },
    },

    messages: {
        name: {
            required: "Vui lòng nhập tên mã giảm giá !",
            minlength: "Tên giảm  quá ngắn",
        },
        code: {
            required: "Vui lòng nhập mã code !",
            minlength: "Mã code tối thiểu 6 ký tự",
        },
        quantity: {
            required: "Vui lòng nhập số lượng",
            number: "Vui lòng nhập chữ số",
            min: "Vui lòng nhập giá trị lớn hơn 0",
        },
        discount: {
            required: "Vui lòng nhập mệnh giá !",
            maxlength: "Vui lòng nhập giá trị từ 1% -> 99%",
        },
        expired_date: {
            required: "Vui lòng nhập ngày hết hạn",
            date: "Vui lòng nhập định dạng ngày tháng",
        },
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#checkout").validate({
    rules: {
        fullname: {
            required: true,
            minlength: 6,
            maxlength: 225,
        },
        xa: {
            required: true,
        },
        address: {
            required: true,
            minlength: 10,
            maxlength: 225,
        },
        phone: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
        agree: {
            required: true,
        },
    },
    messages: {
        agree: {
            required: "Bạn phải chấp nhận điều khoản của chúng tôi!",
        },
        phone:"Số điện thoại có độ dài 10-11 kí tự số!",
        fullname:{
            required:true,
            minlength:"Tên người nhận ít nhất 6 kí tự",
            maxlength:"Tên người nhận tối đa nhất 225 kí tự",
        },
        address:{
            required:"Địa chỉ cụ thể bắt buộc nhập",
            minlength:"Địa chỉ cụ thể ít nhất 10 kí tự",
            maxlength:"Địa chỉ cụ thể tối đa 225 kí tự",
        },
        xa:{
            required:"Địa chỉ bắt buộc chọn!"
        }
    },
});
