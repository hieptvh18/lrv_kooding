$(document).ready(function () {
    $('#vocher').keydown(function () {
        $('.sub__vorcher').addClass('ys');
    });
    $('#note').click(function (e) {
        e.preventDefault();
        $('.note__input').toggle('none');
    });
    // $('.body__order__content').scroll(function () {
    //     var pos_body = $(window).scrollTop();
    //     if (pos_body > 20) {
    //         $('.body__order__right').addClass('moc-up');
    //     } else {
    //         $('.body__order__right').removeClass('moc-up');
    //     }
    // });
    // select
    
    // close address
    $('.close').click(function (e) { 
        e.preventDefault();
        $('.input__address p').empty();
        $('.input__address').addClass('none');
        $('.itemAll__address').removeClass('none');
        $('.input__auto').removeClass('none');
        $('#tinh').prop('selectedIndex',0);
        $('#huyen').prop('selectedIndex',0);
        $('.xa').prop('selectedIndex',0);
    });

});

function innerHTML_tinh() {
    $('.input__address').removeClass('none');
    $('.input__auto').addClass('none');
    const opList = document.querySelector('#tinh');
    const opValue = opList.options[opList.selectedIndex].text;
    const spanSlec = document.querySelector('.tinhAdd')
    spanSlec.innerText = opValue + ` /`;
    // if(opList.value != '01TTT'){
    //     $('#shiping').show();
    //     $('#input_shiping').attr('value', 30000);
    // }
    // if(opList.value == '01TTT'){
    //     $('#shiping').hide();
    //     $('#input_shiping').attr('value', 0);
    // }

}
function innerHTML_huyen() {
    const opList = document.querySelector('#huyen');
    const opValue = opList.options[opList.selectedIndex].text;
    const spanSlec = document.querySelector('.huyenAdd')
    spanSlec.innerText = opValue + ` /`;

}
function innerHTML_xa() {
    const opList = document.querySelector('.xa');
    const opValue = opList.options[opList.selectedIndex].text;
    const spanSlec = document.querySelector('.xaAdd');
    spanSlec.innerText = opValue;
    if(opList != ""){
        $('.itemAll__address').addClass('none');
    }
    
}