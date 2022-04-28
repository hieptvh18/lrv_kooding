function toast({
    title = '',
    mess = '',
    type = 'info',
    duration = 3000
}){
    const main = document.getElementById('toast')
    if(main){
        const toast = document.createElement('div')
        const autoRemove = setTimeout(function(){
            main.removeChild(toast);
        }, duration + 1000)
        toast.onclick = function(e){
            if(e.target.closest('.toast__close')){
                main.removeChild(toast);
                clearTimeout(autoRemove);
            }
        }
        const icons = {
        success: 'fas fa-check',
        error: 'fas fa-exclamation',
        waring: 'fas fa-exclamation-triangle'
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
        toast.classList.add('toast', `toast__${type}`)
        toast.style.animation = `duma ease .5s, fadeOut linear 1s ${delay}s  forwards`
        toast.innerHTML = `
            <div class="toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class="toast__body">
                <h3>${title}</h3>
                <p>${mess}</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        `;
        main.appendChild(toast);
    };
};

function showSuccess(){
    toast({
    title: '',
    mess: 'Thêm giỏ hàng thành công !',
    type: 'success',
    duration: 3000
    });
}
function showError(){
    toast({
    title: '',
    mess: 'Xóa thành công!',
    type: 'error',
    duration: 3000
    });
}
function showLove(){
    toast({
    title: '',
    mess: 'Thêm sản sản phẩm yêu thích thành công!',
    type: 'success',
    duration: 3000
    });
}