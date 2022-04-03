function confirmRemove(event){
    if(!confirm('Bạn có chắc chắn xóa? Các mục liên quan cũng sẽ biến mất!')){
        event.preventDefault();
        return false;
    }
}