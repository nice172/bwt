function IEVersion() {
    var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串  
    var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器  
    var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器  
    var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
    if (isIE) {
        var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
        reIE.test(userAgent);
        var fIEVersion = parseFloat(RegExp["$1"]);
        if (fIEVersion == 7) {
            return 0;
        } else if (fIEVersion == 8) {
            return 0;
        } else if (fIEVersion == 9) {
            return 9;
        } else if (fIEVersion == 10) {
            return 10;
        } else {
            return 0;//IE版本<=7
        }
    } else if (isEdge) {
        return 'edge';//edge
    } else if (isIE11) {
        return 11; //IE11  
    } else {
        return 1;//不是ie浏览器
    }
}
if (IEVersion() == 0) {
    alert('请使用IE9或IE9+以及非IE浏览器！');
}

var width = $(window).width();

$(window).resize(function () {
    width = $(window).width();
    windowsize_nf();
});
$(function () {
    windowsize_nf();
})
 
function windowsize_nf() {
    
    //if (width > 1750) {
    //    $('.hotline-search').css('right', (width - 1300 - 220) * 0.2);
    //}
    //else if (width > 1450 && width < 1750) {
    //    $('.hotline-search').css('right', 10);
    //}
    //else if (width >= 1300 && width < 1450) {
    //    $('.hotline-search').css('right', 10);
    //}

    $('.index_contact').width(width);

    var a = (width - 1300) / 2;
    $('.index_contact .contact_content div.links,.index_contact .contact_content div.record_other').css({ 'paddingLeft': a, 'marginLeft': -a, 'paddingRight': a });
}

$('.code-top .code').hover(function () {
    $(this).find('.code_bg').stop(true, true).fadeIn(400);
}, function () {
    $(this).find('.code_bg').stop(true, true).fadeOut(400);
});
$('.code-top .top').hover(function () {
    $(this).find('.top_bg').stop(true, true).fadeIn(400);
}, function () {
    $(this).find('.top_bg').stop(true, true).fadeOut(400);
});
$(window).scroll(function () {
    if ($(window).scrollTop() > 350) {
        $('.code-top .top').fadeIn();
    } else {
        $('.code-top .top').fadeOut();
    }
});
//回到顶部
$('.code-top .top').click(function () {
    $('body,html').stop(true, true);
    $('body,html').animate({
        'scrollTop': 0
    }, 1000);
});
function isContains(substr, str) {
    return new RegExp(substr).test(str);
}


////百度商桥
//var _hmt = _hmt || [];
//(function () {
//    var hm = document.createElement("script");
//    hm.src = "https://hm.baidu.com/hm.js?b09b7600ef4abf38285888420f1c26d0";
//    var s = document.getElementsByTagName("script")[0];
//    s.parentNode.insertBefore(hm, s);
//})();

////百度内容抓取推送
//$(function () {
//    (function () {
//        var bp = document.createElement('script');
//        var curProtocol = window.location.protocol.split(':')[0];
//        if (curProtocol === 'https') {
//            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
//        }
//        else {
//            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
//        }
//        var s = document.getElementsByTagName("script")[0];
//        s.parentNode.insertBefore(bp, s);
//    })();
//})






