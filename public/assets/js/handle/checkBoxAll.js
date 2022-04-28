$(document).ready(function() {

    $("#btnCheck").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#btnRemoveAll').click(function() {
        if (!$('table input:checkbox').is(':checked')) {
            alert('Cần chọn ít nhất 1 sản phẩm để xóa!')
            return false;
        }

        // thực hiện gửi data và xóa mảng
        if (confirm("Bạn chắc chắn xóa các sản phẩm đã chọn?")) {
            var idArr = [];
            $('table input:checked').each(function() {
                idArr.push($(this).attr('data-id'))
            });

            // use form fake 
            formFakeDelMuntiple = document.forms['formFakeRemoveMuntiple']
            formFakeDelMuntiple.action = "{{ route('product.removeMuntiple') }}";
            $('input[name="pro_id"]').attr('value', idArr)
            formFakeDelMuntiple.submit();

        }

    })
});