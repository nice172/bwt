$(function(){
	resizew();
	function resizew(){
		winh=$(window).height();
		$(".mobile-nav-box").height(winh-60);
	}
});
$(function(){
	$('.mobile-nav-box h2').on('click',function(){
		if (!$(this).hasClass("cur")) {
			$(this).addClass("cur").parent("li").siblings("li").find("h2").removeClass("cur");
			$(this).next('.con').slideDown().parent("li").siblings("li").find('.con').slideUp();
		}else{
			$(this).removeClass("cur");
			$(this).next('.con').slideUp()
		}
	})
	$('.mobile-nav').on('click',function(){
		if (!$(this).hasClass("on")) {
			$(this).addClass("on");
			$(".mobile-nav-box").slideDown();
		}else{
			$(this).removeClass("on");
			$(".mobile-nav-box").slideUp();
		}
	})
});
 $(function(){
	$('#i_pro').owlCarousel({
		loop: true, //是否重复 默认 false
		nav: false,  //显示上下按钮 默认false
		responsive: { 640: { items: 3},480: { items: 3},320: { items: 2},0: { items: 2 }},   //显示个数
		margin: 20, //右边距 默认 0 
		slideBy: 1, //每次一下个轮播个数 默认 1
		autoplay: false, //是否自动轮播，默认 false
		autoplayTimeout: 3000,  //轮播间隔时间,
		smartSpeed: 250,   //轮播速度 默认250
		autoplayHoverPause: true    //鼠标停留是否暂停
	})
	var owl = $("#i_pro").data('owlCarousel');
	$("#nexts").click(function () {
		owl.next();
	})
	$("#pres").click(function () {
		owl.prev();
	})
}); 