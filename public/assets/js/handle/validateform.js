// form add vourcher
$("#form_vourcher").validate({
    rules: {
        name: {
            required : true,
            minlength : 10
        },
        code: {
            required : true,
            minlength : 6,
            vourcher :true
        },
        quantity: {
            required: true,
            number: true
        },
        expired_date:{
            required: true,
            date: true,
            nghiadz: true
        },
        discount: {
            required : true,
        }
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
        quantity:{
            required: "Vui lòng nhập số lượng",
            number: "Vui lòng nhập chữ số",
            min: "Vui lòng nhập giá trị lớn hơn 0"
        },
        discount: {
            required: "Vui lòng nhập mệnh giá !",
            maxlength: "Vui lòng nhập giá trị từ 1% -> 99%"
        },
        expired_date:{
            required: "Vui lòng nhập ngày hết hạn",
            date: "Vui lòng nhập định dạng ngày tháng"
        }
    },
    submitHandler: function(form) {
      form.submit();
    }
 });