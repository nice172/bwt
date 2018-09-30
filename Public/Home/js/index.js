var page = 0;
var bool = true;
var slide_bool = true;
$(window).on('load', function () {
    $('body,html').animate({
        'scrollTop': [0, 'easeOutCubic']
    }, 1);
});
var height = $(window).height();
var width = $(window).width();
$('html').width(width).scrollTop(0);
$('body').width(width).scrollTop(0);
windowsize();

$(window).resize(function () {
    height = $(window).height();
    width = $(window).width();
    windowsize();
});

function windowsize() {
    if (height < 750 && bool) {
        //alert('请全屏浏览网站或更换分辨率！');
        bool = !bool;
    }
    if (width >= 1300) {
        $('body,html').removeAttr('style');
        $('body,html').css('overflow', 'hidden');
    } else {
        width = 1300;
        $('body,html').removeAttr('style');
        $('body,html').width(width).css('overflow-x', 'auto');
        $('body,html').width(width).css('overflow-y', 'hidden');
    }
    //$('.slide').css({ 'top': height - 40, 'left': (width - $('.slide').width()) / 2 });
    $('.index_banner .banner_ul').width(width);
    $('.index_banner .banner_ul li,.index_banner .banner_ul').height(height - 82).width(width);
    $('.index_about').height(height - 82).width(width);
    $(".nav .bg").width(width).css({
        'left': -(width - 1300) / 2
    });
    $('.index_banner,.index_product,.index_stress,.index_info,.index_project').height(height - 82).width(width);
    $(".index_product .bg,.index_stress .bg,.index_project .bg").width(width).css({
        "height": height - 82
    });

    $('.index_product .product_content').css({
        'marginTop': (height - 82 - $('.index_product .product_content').height()) / 2
    });
    $('.index_project .project_content').css({
        'top': (height - 82 - $('.index_project .project_content').height()) / 2 - 100
    });
    if (height > 900) {
        $('.index_info .info_class').css({
            'marginTop': (height - 800) / 2
        });
        $('.index_stress .stress_content').css({
            'marginTop': (height - 82 - $('.index_stress .stress_content').height()) / 2
        });

    } else {
        $('.index_info .info_class').removeAttr('style');
        $('.index_stress .stress_content').removeAttr('style');
        $('.index_info .info_class').css({
            'marginTop': 35
        });
    }
    $('.page_show').css('top', (height - $('.page_show').height()) / 2);
    $('.index_banner .banner_ul li img').css('overflow', 'hidden');
    $(".index_banner .banner_ul li img").removeAttr("style");
    if ($('.index_banner .banner_ul li').width() / $('.index_banner .banner_ul li').height() >= 1920 / 991) {
        $('.index_banner .banner_ul li img').css({ 'width': width });
    } else {
        $('.index_banner .banner_ul li img').css('height', '100%');
    };
    if ($('.index_banner .banner_ul li').height() * 1920 / 991 >= $('.index_banner .banner_ul li').width()) {
        $('.index_banner .banner_ul li img').css('marginLeft', -($('.index_banner .banner_ul li').height() * 1920 / 991 - $('.index_banner .banner_ul li').width()) / 2);
    }
    $('.mask').width(width).height(height);
    $('.mask .mask_close').css('left', 0.9 * width - 50);
    $('.mask ul.list li p.title').width($('.mask ul.list li').width() - 125);
    $('.mask ul.list li p.key_word').width($('.mask ul.list li').width() - 211);
    var Top = $('html').scrollTop() > $('body').scrollTop() ? $('html').scrollTop() : $('body').scrollTop();
    $('.mask').css('top', Top);
    $('#video').width((width * 0.8 - 60) * 0.6 * 0.95).height((height * 0.8 - 90) * 0.8);
    page_scroll();
}
//导航栏标签添加index
$('.page_show li.show').each(function (index, elemet) {
    $(elemet).attr({
        'index': index
    });
});
$('.page_show li.show').each(function (index, elemet) {
    $(elemet).attr({
        'index': index
    });
});
//侧栏显示屏数、导航栏点击滑动
$('.page_show li.show').click(function () {
    page = $(this).attr('index');
    page_scroll();
});

$('.nav ul.column li,.page_show li.show').hover(function () {
    $(this).find('span').stop(true, true);
    $(this).find('span').fadeIn();
}, function () {
    $(this).find('span').stop(true, true);
    if (!$(this).hasClass("cur")) {
        $(this).find('span').fadeOut();
    }
});

//视屏点击展开
$('.video .btn').click(function () {
    slide_bool = !slide_bool;
    $('.video').fadeOut();
    var Top = $('html').scrollTop() > $('body').scrollTop() ? $('html').scrollTop() : $('body').scrollTop();
    $('.mask').css('top', Top).fadeIn();
    $('.video_open').fadeIn();
    $('.mask ul.list li p.title').width($('.mask ul.list li').width() - 125);
    $('.mask ul.list li p.key_word').width($('.mask ul.list li').width() - 211);
});

//遮罩层点击关闭
$('.mask_close').click(function () {
    $('.mask').fadeOut();
    $('.video').fadeIn();
    slide_bool = !slide_bool;
});

//滚轮滑动函数
var scrollStop = true;

function page_scroll() {
    if (scrollStop) {
        scrollStop = false;
        $('.page_show li.show').removeClass('cur');
        $('.page_show li.show').find('span').fadeOut();
        $('.page_show li.show').find('span').find('span').stop(true, true);
        $('.page_show li.show').eq(page).find('span').fadeIn();
        $('.page_show li.show').eq(page).addClass('cur');
        $('.page_show li.dot').animate({
            'top': [page * 52, 'easeOutCubic']
        }, 1200);
        //$('.nav ul.column li').each(function (index, elemet) {
        //    if (index == page) {
        //        $(elemet).addClass('cur');
        //    } else {
        //        $(elemet).removeClass('cur');
        //    }
        //});
        var num;
        if (page != 6) {
            num = page * (height - 82);
            //$('.slide').fadeIn();
            $('.video').fadeIn();
            $('.code').fadeIn();
            $('.code-top .top').removeClass('cur');
            $('.index_project .mask_bg').fadeOut();
        } else {
            num = parseInt(5 * (height - 82));
            //$('.slide').fadeOut();
            $('.video').fadeOut();
            $('.code').fadeOut();
            $('.code-top .top').addClass('cur');
            $('.index_project .mask_bg').fadeIn();
        }
        if (page == 6) {
            $('.project_content').animate({ 'marginTop': [100 - $('.index_contact').height(), 'easeOutCubic'] }, 800);
            if (height > 900) {
                $('.index_project .more').animate({ 'bottom': [100 + $('.index_contact').height(), 'easeOutCubic'] }, 800);
            }
            else if (height <= 900 && height > 800) {
                $('.index_project .more').animate({ 'bottom': [60+ $('.index_contact').height(), 'easeOutCubic'] }, 800);
            }
            else {
                $('.index_project .more').animate({ 'bottom': [40 + $('.index_contact').height(), 'easeOutCubic'] }, 800);
            }
            
            $('.index_contact').animate({ 'marginTop': [- $('.index_contact').height(), 'easeOutCubic'] }, 800);
        }
        else {
            $('.project_content').animate({ 'marginTop': [100, 'easeOutCubic'] }, 800);
            if (height > 900) {
                $('.index_project .more').animate({ 'bottom': [100, 'easeOutCubic'] }, 800);
            }
            else if (height <= 900 && height > 800) {
                $('.index_project .more').animate({ 'bottom': [60, 'easeOutCubic'] }, 800);
            }
            else {
                $('.index_project .more').animate({ 'bottom': [40, 'easeOutCubic'] }, 800);
            }
            $('.index_contact').animate({ 'marginTop': [0, 'easeOutCubic'] }, 800);
        }
        $('body,html').animate({
            'scrollTop': [num, 'easeOutCubic']
        }, 800, function () {
            scrollStop = true;
        });
        //$('.slide').css({ 'top': num + height - 60, 'left': (width - 144) / 2 });
    }
}
//兼容滚轮
var oDiv = document.body;

function onMouseWheel(ev) {
    var ev = ev || window.event;
    var down = true;
    down = ev.wheelDelta ? ev.wheelDelta < 0 : ev.detail > 0;
    if (slide_bool) {
        if (scrollStop) {
            if (down) { //向下
                page++;
                if (page >= 6) {
                    page = 6;
                }
                    page_scroll();
                
            }
            else { //向上
                page--;
                if (page <= 0) {
                    page = 0;
                }
                page_scroll();
            }
        }
    }

    if (ev.preventDefault) {
        ev.preventDefault();
    }
    return false;
}

function addEvent(obj, xEvent, fn) {
    if (obj.attachEvent) {
        obj.attachEvent('on' + xEvent, fn);
    } else {
        obj.addEventListener(xEvent, fn, false);
    }
}
addEvent(oDiv, 'mousewheel', onMouseWheel);
addEvent(oDiv, 'DOMMouseScroll', onMouseWheel);