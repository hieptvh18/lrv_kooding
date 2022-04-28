$(document).ready(function() {
	$(window).scroll(function(event) {
		var pos_body = $('html,body').scrollTop();
		// if(pos_body>10){
		// 	// $('.header-top').addClass('co-dinh-menu');
		// 	$('.bars').addClass('co-dinh-menu');
		// }
		// else {
		// 	// $('.header-top').removeClass('co-dinh-menu');
		// 	$('.bars').removeClass('co-dinh-menu');
		// }
		if(pos_body>500){
			$('.back-to-top').addClass('show');
		}
		else{
			$('.back-to-top').removeClass('show');
		}
	});
	$('.back-to-top').click(function(event) {
		$('html,body').animate({
			scrollTop: 0},
			500);
	});
});