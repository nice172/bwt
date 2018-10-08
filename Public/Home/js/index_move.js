$(function () {
    var banner_bool = true;

    var banner_spend = 0;
    var index_Banner = setInterval(index_banner_next,30000);
    function index_banner_next() {
        banner_spend++;
        if (banner_spend == $('.index_banner .banner_ul li').length) {
            banner_spend = 0;
        }
        index_banner();
    }

    function index_banner_pre() {
        banner_spend--;
        if (banner_spend == -1) {
            banner_spend = $('.index_banner .banner_ul li').length - 1;
        }
        index_banner();
    }

    function index_banner() {
        $('.index_banner .banner_ul li').each(function (i, ele) {
            if (i != banner_spend) {
                $(ele).delay(300).fadeOut(400);
                if (i == 0) {
                    $(ele).find('.banner_1').removeClass().addClass('banner_1 banner_other fadeOutUp');
                }
                else if (i == 1) {
                    $(ele).find('.banner_1').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0s' }).addClass('banner_1 banner_other fadeOutUp');
                    $(ele).find('.banner_2').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0s' }).addClass('banner_2 banner_other fadeOutLeft');
                    $(ele).find('.banner_3').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0s' }).addClass('banner_3 banner_other fadeOutUpRight');
                }
                else{
                    $(ele).find('.banner_1').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0s' }).addClass('banner_1 banner_other fadeOutRight');
                    $(ele).find('.banner_2').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0s' }).addClass('banner_2 banner_other fadeOutLeft');
                    $(ele).find('.banner_3').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0s' }).addClass('banner_3 banner_other fadeOutRight');
                }
                
            } else {
                $(ele).fadeIn(600);
                if (i == 0) {
                    $(ele).find('.banner_1').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0.4s' }).addClass('banner_1 banner_other fadeInDown');
                }
                else if (i == 1) {
                    $(ele).find('.banner_1').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0.4s' }).addClass('banner_1 banner_other fadeInUp');
                    $(ele).find('.banner_2').removeClass().css({ 'animation-duration': '1.5s', 'animation-delay': '0.6s' }).addClass('banner_2 banner_other fadeInLeft');
                    $(ele).find('.banner_3').removeClass().css({ 'animation-duration': '2s','animation-delay':'1s' }).addClass('banner_3 banner_other fadeInUpRight');
                }
                else {
                    $(ele).find('.banner_1').removeClass().css({ 'animation-duration': '1s', 'animation-delay': '0.4s' }).addClass('banner_1 banner_other fadeInRight');
                    $(ele).find('.banner_2').removeClass().css({ 'animation-duration': '1.5s', 'animation-delay': '0.8s' }).addClass('banner_2 banner_other fadeInLeft');
                    $(ele).find('.banner_3').removeClass().css({ 'animation-duration': '2s','animation-delay':'1s' }).addClass('banner_3 banner_other fadeInRight');
                }
                
            }
        });
    }
    $('.index_banner .btn .pre').click(function () {
        clearInterval(index_Banner);
        banner_bool = true;
        index_banner_pre();
        index_Banner = setInterval(index_banner_next, 8000);
    });
    $('.index_banner .btn .next').click(function () {
        clearInterval(index_Banner);
        banner_bool = false;
        index_banner_next();
        index_Banner = setInterval(index_banner_next, 8000);
    });
    //回到顶部
    $('.code-top .top').click(function () {
        page = 0;
        //page_scroll();
    });

    //重点工程上一张
    $('.stress_btn .pre').click(function () {
        $('.stress_a a:last').insertBefore($('.stress_a a:first'));
    });
    //重点工程下一张
    $('.stress_btn .next').click(function () {
        $('.stress_a a:first').insertAfter($('.stress_a a:last'));
    });
	
    var product_num = 0;
    //产品中心上一张
    $('.product_btn .pre').click(function () {
        $('.product_btn .next').fadeIn();
        product_num++;
        if (product_num == 0) {
            $('.product_btn .pre').fadeOut();
        }
        $('.product_list>a').each(function (i, ele) {
            $(ele).animate({
                'left': (i + product_num) * $(ele).width()
            }, 0);
        });
    });
    //产品中心下一张
    $('.product_btn .next').click(function () {
        product_num--;
        $('.product_btn .pre').fadeIn();
        if (product_num == -$('.product_content  div>a').length + 5) {
            product_num = -$('.product_content  div>a').length + 5;
            $('.product_btn .next').fadeOut();
        }
        $('.product_content  div>a').each(function (i, ele) {
            $(ele).animate({ 'left': (i + product_num) * $(ele).width() }, 0);
        });
    });
});