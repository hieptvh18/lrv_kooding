$(document).ready(function () {
    // code javascript ảnh
    const thumbImg = document.querySelectorAll('.thunb__img');
    const ImgAttr = document.querySelectorAll('.thunb__img img');
    const imgIndex = document.querySelector('.img__right img');
    // console.log(thumbImg);
    thumbImg.forEach((thumb, index) =>{
        const attr = ImgAttr[index].getAttribute("src");
        thumb.onclick = function (){
            imgIndex.setAttribute("src", attr);
        }
    })
    // code xem ảnh chi tiết
    const gallery = document.querySelector('.gallery_pros')
    const image = document.querySelectorAll('.pd__item__img img')
    const prev = document.querySelector('.prev')
    const next = document.querySelector('.next')
    const close = document.querySelector('.control_pros_close')
    const galleryImg = document.querySelector('.gallery_pros_img img')
    var crunrenIndex = 0;
    function showGallerly(){
        if(crunrenIndex == 0){
            prev.classList.add('gallery_hiden')
        }else{
            prev.classList.remove('gallery_hiden')
        }

        if(crunrenIndex == image.length - 1){
            next.classList.add('gallery_hiden')
        }else{
            next.classList.remove('gallery_hiden')
        }
        galleryImg.src = image[crunrenIndex].src
        gallery.classList.add('gallery_show')
    }

    image.forEach((item, index) =>{
        item.addEventListener('click', function(){
            crunrenIndex = index;
            showGallerly();
        })
    })
    close.addEventListener('click', function(){
        gallery.classList.remove('gallery_show')
    })
    document.addEventListener('keydown', function(e){
        if(e.keyCode == 27){
            gallery.classList.remove('gallery_show')
        }
    })
    prev.addEventListener('click', function(){
        if(crunrenIndex > 0){
            crunrenIndex--
            showGallerly()
        }
    })
    next.addEventListener('click', function(){
        if(crunrenIndex < image.length - 1){
            crunrenIndex++
            showGallerly()
        }
    })

    gallery.onclick = function(e){
        if(!e.target.closest('.control_pros_close, .gallery_pros_img, .control_pros')){
            gallery.classList.remove('gallery_show')
        }
    }
    // code javascript tim
    $('.animate-button-wrap i').click(function (e) { 
        e.preventDefault();
        $(this).addClass('far');
        $(this).addClass('fas');
        $(this).addClass('favorite')
    });
    // $('.pd-buttons button').click(function (e) { 
    //     e.preventDefault();
    //     $(this).removeAttr("onclick")
    //     $(this).css({'opacity' : '0.4', 'cursor' : 'no-drop'})
    // });
    $('span.btn_add_fa').click(function (e) { 
        e.preventDefault();
        $(this).removeAttr("onclick")
        $(this).css('cursor', 'default')
    });
    // code javascript cho product details
    $('#1').click(function (e) { 
        e.preventDefault();
        $('#2').next().removeClass('show__detail');
        $('#3').next().removeClass('show__detail');
        $('#4').next().removeClass('show__detail');
        $(this).next().toggleClass('show__detail');
    });
    $('#2').click(function (e) { 
        e.preventDefault();
        $('#1').next().removeClass('show__detail');
        $('#3').next().removeClass('show__detail');
        $('#4').next().removeClass('show__detail');
        $(this).next().toggleClass('show__detail');
    });
    $('#3').click(function (e) { 
        e.preventDefault();
        $('#1').next().removeClass('show__detail');
        $('#2').next().removeClass('show__detail');
        $('#4').next().removeClass('show__detail');
        $(this).next().toggleClass('show__detail');
    });
    $('#4').click(function (e) { 
        e.preventDefault();
        $('#1').next().removeClass('show__detail');
        $('#3').next().removeClass('show__detail');
        $('#2').next().removeClass('show__detail');
        $(this).next().toggleClass('show__detail');
    });
});