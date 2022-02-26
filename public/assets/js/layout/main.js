$(document).ready(function () {
    $('#times').click(function (e) { 
        e.preventDefault();
        $('.site__intro').removeClass('show1');
        $('.background__overlay').addClass('none');
        $('.btn__times').addClass('none');
        $('.btn__minus').removeClass('none');
    });
    $('#minus').click(function (e) { 
        e.preventDefault();
        $('.btn__times').removeClass('none');
        $('.btn__minus').addClass('none');
        $('.site__intro').addClass('show1');
        $('.background__overlay').removeClass('none');
    });

    // responsive main
    $('.search-rp').click(function(){
        $('.search').toggleClass("active")
    })
    $('.bars').click(function(){
        $('.header-menu').toggleClass("active-menu")
        
    })

    // javaScript menu burger
    const menuBtn = document.querySelector('.menu__bars');
    let menuOpen = false;
    menuBtn.addEventListener('click', () => {
    if(!menuOpen) {
        menuBtn.classList.add('open');
        menuOpen = true;
    } else {
        menuBtn.classList.remove('open');
        menuOpen = false;
    }
});
   
});