//$("body").hide();
function getScrollWidth() {
    var noScroll, scroll, oDiv = document.createElement("DIV");
    oDiv.style.cssText = "position:absolute;top:-1000px;width:100px;height:100px; overflow:hidden;";
    noScroll = document.body.appendChild(oDiv).clientWidth;
    oDiv.style.overflowY = "scroll";
    scroll = oDiv.clientWidth;
    document.body.removeChild(oDiv);
    return noScroll - scroll;
}
$(function () {
    var scroolwidth = getScrollWidth();
    var width = document.body.clientWidth - scroolwidth;
    windowsize_SL();
    $(window).resize(function () {
        width = document.body.clientWidth - scroolwidth;
        windowsize_SL();
    });

    function windowsize_SL() {
        if (width >= 1300) {
            $('.content .content_bg').css('margin-left', (1300 - width) / 2)
            $('body,html').css('overflow-x', 'hidden');
        } else {
            width = 1300;
            $('body,html').css('overflow-x', 'initial');
            $('.content .content_bg').css('margin-left', 0)
        }
        $('.content .content_bg').width(width).height(width * 300 / 1920);
        $('.content h2').css('top', (width * 300 / 1920 - 30) * 0.8);
        $('.content .crumbs').css({ 'padding-left': (width - $('.content .crumbs').width() + 200) * 0.5, 'padding-right': (width - $('.content .crumbs').width()) * 0.5-100, 'margin-left': $('.content .content_bg').css('margin-left') });
        $('.content>h3').css('top', (width * 300 / 1920 - 90));
        $('.content>.title,.title_top').css('top', (width * 300 / 1920 - 90 + 151));
        $("body").show();
        $('body .content .stress_top_left').css('top', parseInt($('.content>.title,.title_top').css('top')) );
    }
})
