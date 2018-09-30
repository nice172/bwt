<?php if (!defined('THINK_PATH')) exit(); $sel = 1; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php if($config["ptitle"] != ''): echo ($config["ptitle"]); else: echo getWebSetting('ptitle'); endif; ?> - <?php echo getWebSetting('companyname');?></title>
<meta name="keywords" content="<?php if($config["pkeywords"] != ''): echo ($config["pkeywords"]); else: echo getWebSetting('pkeywords'); endif; ?>">
<meta name="description" content="<?php if($config["pdescription"] != ''): echo ($config["pdescription"]); else: echo getWebSetting('pdescription'); endif; ?>">
<link href="/favicon.ico" rel="shortcut icon">
<link rel="stylesheet" href="/Public/Home/Css/initial.css" />
<link rel="stylesheet" href="/Public/Home/Css/nav-footer.css" />
<link rel="stylesheet" href="/Public/Home/Css/share.min.css" />
<script type="text/javascript" src="/Public/Home/js/jquery-3.0.0.js"></script>
    </head>
    <body>
    	<nav class="nav">
    <div class="navbg">
        <div class="logo"><a href="/"><img src="<?php echo getWebSetting('site_logo');?>" alt="<?php echo getWebSetting('companyname');?>" /></a></div>
        <div class="describe">
            <h2>CCTV品牌影响力推荐企业</h2>
            <h2>正气浩然 ● 事业如虹</h2>
        </div>
        <ul class="column">
            <?php if(is_array($cateone)): foreach($cateone as $k=>$vo): ?><li <?php if(($k+1) == $sel): ?>class="active"<?php endif; ?>>
                    <?php if(substr($vo['url'],0,7) == 'http://' or substr($vo['url'],0,8) == 'https://'): ?><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["catname"]); ?></a>
                    <?php else: ?>
                        <a href="<?php echo U($vo['url']);?>"><?php echo ($vo["catname"]); ?></a><?php endif; ?>
                    <i></i>
                    <?php if(countnum($vo['catid']) != 0): ?><div class="column_SL" <?php if($vo['catid'] == 3): ?>style="left: -45px;"<?php endif; ?>>
                            <div class="column_SL_line"></div>
                            <ul class="column_SL_list clearfix" <?php if($vo['catid'] == 3): ?>style="width: 135px;"<?php endif; ?>>
                                <?php $catid = $vo['catid']; ?>
								<?php $list=M("Category")->where("pid=$catid and ishidden=0")->limit(5)->order("sort desc,catid asc")->select();foreach ($list as $key=>$vs): if($vo["catid"] == $vs['pid']): if(substr($vs['url'],0,7) == 'http://' or substr($vs['url'],0,8) == 'https://'): ?><li><a href="<?php echo ($vs["url"]); ?>"><?php echo ($vs["catname"]); ?></a></li>
                                        <?php elseif($vs['url'] == ''): ?>
                                            <li><a href="<?php echo U($vo['url'],array('catid'=>$vs['catid']));?>"><?php echo ($vs["catname"]); ?></a></li>
                                        <?php elseif($vs['url'] != '' and (substr($vs['url'],0,7) != 'http://' or substr($vs['url'],0,8) != 'https://')): ?>
                                            <li><a href="<?php echo U($vs['url'],array('catid'=>$vs['catid']));?>"><?php echo ($vs["catname"]); ?></a></li><?php endif; endif; endforeach; ?>
                            </ul>
                        </div><?php endif; ?>
                </li><?php endforeach; endif; ?>
            <li <?php if($sel == 6): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Fume/index');?>">油烟专题</a>
                <i></i>
            </li>
            <li <?php if($sel == 7): ?>class="active"<?php endif; ?>>
            	<a href="<?php echo U('Vocs/index');?>">VOCs专题</a>
                <i></i>
            </li>
        </ul>
    </div>
</nav>



        <link rel="stylesheet" href="/Public/Home/Css/index.css" />
		<script type="text/javascript" src="/Public/Home/js/jquery.easing.1.3.js"></script>
        <script>
            $('body,html').css('overflow', 'hidden');
        </script>
		<section class="index_banner clearfix">
        <!--banner图片-->
            <ul class="banner_ul">
                <li style="display: block;">
                    <img src="/Public/Home/img/banner3.jpg" class="bg" />
                    <img src="/Public/Home/img/banner3_txt.png" class="banner_1 banner_other" />
                    <a class="more" href="">了解更多</a>
                </li>
                <li style="display: none;">
                    <img src="/Public/Home/img/banner1.jpg" class="bg" />
                    <img src="/Public/Home/img/banner1_txt.png" class="banner_1 banner_other" />
                    <img src="/Public/Home/img/banner1_equipment.png" class="banner_2 banner_other" />
                    <img src="/Public/Home/img/banner1_other.png" class="banner_3 banner_other" />
                    <a class="more" href="">了解更多</a>
                </li>
                <li style="display: none;">
                    <img src="/Public/Home/img/banner2.jpg" class="bg" />
                    <img src="/Public/Home/img/banner2_txt.png" class="banner_1 banner_other" />
                    <img src="/Public/Home/img/banner2_equipment.png" class="banner_2 banner_other" />
                    <a class="more" href="">了解更多</a>
                </li>
            </ul>
            <div class="btn absolute clearfix">
                <div class="pre"></div>
                <div class="next"></div>
            </div>
        </section>
<!--关于正虹-->
<section class="index_about">
    <img class="bg" src="/Public/Home/img/about.jpg" />
    <img class="logo ico" src="/Public/Home/img/about_bg1.png" />
    <img class="logo" src="/Public/Home/img/about_bg2.png" />
    <div>
    	<?php $list=M("Category")->where("pid=2 and ishidden=0")->limit(4)->order("sort desc,catid asc")->select();foreach ($list as $k=>$vo): if(substr($vo['url'],0,7) == 'http://' or substr($vo['url'],0,8) == 'https://'): ?><a href="<?php echo ($vo["url"]); ?>" class="ico<?php echo ($k+1); ?>"><p><?php echo ($vo["catname"]); ?></p></a>
            <?php elseif($vo['url'] == ''): ?>
                <a href="<?php echo U(get_catname(2,'url'),array('catid'=>$vo['catid']));?>" class="ico<?php echo ($k+1); ?>"><p><?php echo ($vo["catname"]); ?></p></a>
            <?php elseif($vo['url'] != '' and (substr($vo['url'],0,7) != 'http://' or substr($vo['url'],0,8) != 'https://')): ?>
                <a href="<?php echo U($vo['url'],array('catid'=>$vo['catid']));?>" class="ico<?php echo ($k+1); ?>"><p><?php echo ($vo["catname"]); ?></p></a><?php endif; endforeach; ?>
    </div>
	<a class="more" href="<?php echo U(get_catname(2,'url'));?>">深入了解</a>
</section>
<!--产品中心-->
<section class="index_product" id="product">
	<img class="bg" src="/Public/Home/img/product.jpg" />
    <div class="product_content">
        <div class="product_list">
            <?php $list=M("Category")->where("pid=3 and ishidden=0")->limit(0)->order("sort desc,catid asc")->select();foreach ($list as $k=>$vo): if(substr($vo['url'],0,7) == 'http://' or substr($vo['url'],0,8) == 'https://'): ?><a href="<?php echo ($vo["url"]); ?>">
                        <div class="ico"><img src="/Public/Home/img/<?php echo ($k+1); ?>.png" class="absolute" /></div>
                        <h3><?php echo ($vo["catname"]); ?></h3>
                        <img src="<?php echo ($vo["thumb"]); ?>" class="img">
                    </a>
                <?php elseif($vo['url'] == ''): ?>
                    <a href="<?php echo U(get_catname(3,'url'),array('catid'=>$vo['catid']));?>">
                        <div class="ico"><img src="/Public/Home/img/<?php echo ($k+1); ?>.png" class="absolute" /></div>
                        <h3><?php echo ($vo["catname"]); ?></h3>
                        <img src="<?php echo ($vo["thumb"]); ?>" class="img">
                    </a>
                <?php elseif($vo['url'] != '' and (substr($vo['url'],0,7) != 'http://' or substr($vo['url'],0,8) != 'https://')): ?>
                    <a href="<?php echo U($vo['url'],array('catid'=>$vo['catid']));?>">
                        <div class="ico"><img src="/Public/Home/img/<?php echo ($k+1); ?>.png" class="absolute" /></div>
                        <h3><?php echo ($vo["catname"]); ?></h3>
                        <img src="<?php echo ($vo["thumb"]); ?>" class="img">
                    </a><?php endif; endforeach; ?>
        </div>
        <div class="product_btn absolute">
            <div class="pre" style="display: none;"></div>
            <div class="next"></div>
        </div>
    </div>
	<a class="more" href="<?php echo U('Product/index');?>">深入了解</a>
</section>
<!--重点工程-->
<section class="index_stress" id="stress">
	<img class="bg" src="/Public/Home/img/stress__bg.jpg" />
    <div class="stress_content">
        <div class="stress_btn absolute">
            <div class="pre"></div>
            <div class="next"></div>
        </div>
        <div class="stress_a">
        	<?php $list=M("Article")->where("catid in (21,35,36,37,38,39) and status=1")->limit(5)->order("sort desc,id desc")->select();foreach ($list as $k=>$vs):?><a href="<?php echo U('Case/show',array('id'=>$vs['id']));?>">
                    <div><img src="<?php echo ($vs["thumb"]); ?>" alt="<?php echo ($vs["title"]); ?>" title="<?php echo ($vs["title"]); ?>"/></div>
                    <p><?php echo ($vs["title"]); ?></p>
                </a><?php endforeach; ?>
        </div>
    </div>
	<a class="more" href="<?php echo U('Case/lists','catid=21');?>">更多工程</a>
</section>
<!--资讯中心-->
<section class="index_info" id="app">
    <div class="info_class">
        <?php $list=M("Category")->where("pid=5 and ishidden=0")->limit(0)->order("sort desc,catid asc")->select();foreach ($list as $k=>$vo):?><div <?php if(($k+1) == 1): ?>class="cur"<?php endif; ?>><?php echo ($vo["catname"]); ?></div><?php endforeach; ?>
    </div>
    <?php $list=M("Category")->where("pid=5 and ishidden=0")->limit(0)->order("sort desc,catid asc")->select();foreach ($list as $k=>$vo):?><article class="info_content clearfix cla<?php echo ($k+1); ?>" <?php if(($k+1) == 1): ?>style="display: block;"<?php else: ?>style="display: none;"<?php endif; ?>>
            <div class="left">
                <div class="img"></div>
                <div class="txt">
                    <h3></h3>
                    <p></p>
                    <a class="more_btn">阅读详情<i></i></a>
                </div>
            </div>
            <div class="right">
                <?php $catid = $vo['catid']; ?>
                <?php $list=M("Article")->where("catid in ($catid) and status=1")->limit(6)->order("sort desc,id desc")->select();foreach ($list as $k=>$vs):?><a href="<?php echo U('News/show',array('id'=>$vs['id']));?>" title="<?php echo ($vs["title"]); ?>" hrefid="<?php echo ($vs["id"]); ?>" firstimg="<img src='<?php echo ($vs["thumb"]); ?>' />" brief="<?php echo unsafe_replace($vs['info']);?>">
                    <div class="date"><?php echo (date("Y-m-d",$vs["inputtime"])); ?></div>
                    <p class="txt"><?php echo ($vs["title"]); ?></p>
                </a><?php endforeach; ?>
            </div>
            <ul class="info_list_dot"></ul>
        </article><?php endforeach; ?>
	<a class="info_more" href="<?php echo U('News/index','catid=22');?>">更多新闻</a>
	<a class="info_more" href="<?php echo U('News/index','catid=23');?>">更多动态</a>
	<a class="info_more" href="<?php echo U('News/index','catid=24');?>">更多法规</a>
	<a class="info_more" href="<?php echo U('News/index','catid=25');?>">更多百科</a>
</section>
<!--项目案例-->
<section class="index_project" id="APP">
    <img class="bg" src="/Public/Home/img/project_bg.jpg" />
    <div class="project_content clearfix">
        <?php $list=M("Article")->where("catid in (20,31,32,34,54) and status=1")->limit(4)->order("sort desc,id desc")->select();foreach ($list as $k=>$vs):?><a href="<?php echo U('Case/show',array('id'=>$vs['id']));?>">
                <i><img src="<?php echo ($vs["thumb"]); ?>" alt="<?php echo ($vs["title"]); ?>" title="<?php echo ($vs["title"]); ?>" /></i>
                <h4><?php echo ($vs["title"]); ?></h4>
                <p><?php echo ($vs["info"]); ?></p>
                <label><?php echo ($vs["views"]); ?></label>
            </a><?php endforeach; ?> 
    </div>
    <a class="more" href="<?php echo U('Case/lists','catid=20');?>">更多案例</a>
    <div class="mask_bg"></div>
</section>
<!--二维码-->
<!--
	<div class="code-top">
		<div class="code">
			<i class="btn"></i>
			<i class="code_bg"></i>
		</div>
		<div class="top">
			<span class="top_btn">TOP</span>
			<span class="top_bg">返回顶部</span>
		</div>
	</div>
-->
	<!--视频-->
    <!--
	<div class="video">
		<img src="/Public/Home/img/video.jpg" />
		<div class="btn"></div>
	</div>
    -->
	<!--遮罩层-->
    <!--
	<div class="mask">
		<div class="mask_close" title="关闭当前弹出窗口">×</div>
		<div class="video_open" id="VideoList">
			<h3 class="title"></h3>
			<div class="play">
				<div id="video" style="width: 600px; height: 400px;"></div>
				<p class="key_word"><span>关键词：</span></p>
				<p class="video_visit">访问量：</p>
			</div>
			<ul class="list">

				<?php $list=M("Video")->where("status=1")->limit(10)->order("sort desc,id desc")->select();foreach ($list as $k=>$vs):?><li url="<?php echo ($vs["videourl"]); ?>">
                        <div><img src="<?php echo ($vs["thumb"]); ?>" /></div>
                        <p class="title"><?php echo ($vs["title"]); ?></p>
                        <p class="key_word"><span>关键词：</span><?php echo ($vs["info"]); ?></p>
                        <p class="video_visit">访问量：<?php echo ($vs["views"]); ?></p>
                    </li><?php endforeach; ?>
			</ul>
		</div>
	</div>
    -->
	<ul class="page_show">
		<li class="dot"></li>
		<li class="cur show"><span>首 页 </span></li>
		<li class="show"><span>关于正虹 </span></li>
		<li class="show"><span>产品中心 </span></li>
		<li class="show"><span>重点工程 </span></li>
		<li class="show"><span>资讯中心 </span></li>
		<li class="show"><span>项目案例 </span></li>
		<li class="show"><span>联系我们 </span></li>
	</ul>
	<script type="text/javascript" src="/Public/Home/js/index.js"></script>
	<script src="/Public/Home/js/index_move.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$(function () {
			$(' .nav .column  .index').addClass('cur');
			if ($('.index_product .product_content .product_list a').length <= 5) {
				$('.index_product .product_content .product_btn').hide();
			};
			$('.index_product .product_content .product_list a').each(function (i, ele) {
				$(ele).css('left', i * $(ele).width());
			});
			$('.index_info .info_class div').each(function (index, elemet) {
				$(elemet).attr({ 'index': index + 1 });
			});
			var info_num = 0, InfoImgMove = '', InfoImgNum = 0, info_cla = 1;
			info(info_cla);
			function info(cla) {
				$('.index_info .info_more').hide().eq(cla - 1).show();
				clearInterval(InfoImgMove);
				InfoImgNum = 0;
				var info_right_a = $('.index_info .info_content.cla' + cla + ' .right a').eq(info_num);
				var infoleftimglist = info_right_a.attr('firstimg').toString().split('#').join("");
				$('.index_info .info_content.cla' + cla + ' .left div.img').html(infoleftimglist);
				$('.index_info .info_content.cla' + cla + ' .left .txt h3').text(info_right_a.find('.txt').text());
				$('.index_info .info_content.cla' + cla + ' .left .txt p').text(info_right_a.attr('brief').replace('"', "%26quot%3B"));
				$('.index_info .info_content.cla' + cla + ' .left .txt .more_btn').attr('href', "/News/show/id/" + info_right_a.attr('hrefid'));
				$('.index_info .info_content.cla' + cla + ' .left .img img').each(function (i, ele) {
					$(ele).css({ 'left': (i - InfoImgNum) * 370 });
				});
				for (var i = 0; i < info_right_a.attr('firstimg').split('#').length; i++) {
					if (i == 0) {
						$('.index_info .info_content .info_list_dot').html('');
						$('.index_info .info_content .info_list_dot').html('<li class="cur"></li>');
					}
					else {
						$('.index_info .info_content .info_list_dot').append('<li></li>');
					}
				}
				InfoImgMove = setInterval(function () {
					$('.index_info .info_content.cla' + cla + ' .left .img img').each(function (i, ele) {
						$(ele).css({ 'left': (i - InfoImgNum) * 370 });
					});
					InfoImgNum++;
					if (InfoImgNum >= $('.index_info .info_content.cla' + cla + ' .left .img img').length) {
						InfoImgNum = 0;
					}
					$('.index_info .info_content.cla' + cla + ' .left .img img').each(function (i, ele) {
						$(ele).animate({ 'left': [(i - InfoImgNum) * 370, 'easeOutCubic'] }, 400);
					});
					$('.index_info .info_content.cla' + cla + ' .info_list_dot li').removeClass('cur').eq(InfoImgNum).addClass('cur');
				}, 4000);
			};
			$('.index_info .info_content .right a').mouseenter(function () {
				if (info_num != $(this).index()) {
					info_num = $(this).index();
					$('.index_info .info_content .left>div').removeClass('fadeInRight').css('animation-duration', '0.5s').addClass('fadeOutLeft');
					setTimeout(function () {
						info(info_cla);
						$('.index_info .info_content .left>div').removeClass('fadeOutLeft').css('animation-duration', '0.5s').addClass('fadeInRight');
					}, 500);
				}
			});
			$('body').on('mouseenter', '.index_info .info_content .left .img img', function () {
				clearInterval(InfoImgMove);
			});
			$('body').on('mouseleave', '.index_info .info_content .left .img img', function () {
				InfoImgMove = setInterval(function () {
					$('.index_info .info_content.cla' + info_cla + ' .left .img img').each(function (i, ele) {
						$(ele).css({ 'left': (i - InfoImgNum) * 370 });
					});
					InfoImgNum++;
					if (InfoImgNum >= $('.index_info .info_content.cla' + info_cla + ' .left .img img').length) {
						InfoImgNum = 0;
					}
					$('.index_info .info_content.cla' + info_cla + ' .left .img img').each(function (i, ele) {
						$(ele).animate({ 'left': [(i - InfoImgNum) * 370, 'easeOutCubic'] }, 400);
					});
					$('.index_info .info_content.cla' + info_cla + ' .info_list_dot li').removeClass('cur').eq(InfoImgNum).addClass('cur');
				}, 4000);
			});
			$('body').on('click', '.index_info .info_content .info_list_dot li', function () {
				info_list_dot_li_click(info_cla, $(this).index());
			});
			function info_list_dot_li_click(cla, num) {
				clearInterval(InfoImgMove);
				InfoImgNum = num;
				$('.index_info .info_content.cla' + cla + ' .left .img img').each(function (i, ele) {
					$(ele).animate({ 'left': [(i - InfoImgNum) * 370, 'easeOutCubic'] }, 400);
				});
				$('.index_info .info_content.cla' + cla + ' .info_list_dot li').removeClass('cur').eq(InfoImgNum).addClass('cur');

				InfoImgMove = setInterval(function () {
					InfoImgNum++;
					if (InfoImgNum >= $('.index_info .info_content.cla' + cla + ' .left .img img').length) {
						InfoImgNum = 0;
					}
					$('.index_info .info_content.cla' + cla + ' .left .img img').each(function (i, ele) {
						$(ele).animate({ 'left': [(i - InfoImgNum) * 370, 'easeOutCubic'] }, 400);
					});
					$('.index_info .info_content.cla' + cla + ' .info_list_dot li').removeClass('cur').eq(InfoImgNum).addClass('cur');
				}, 4000);
			}
			$('.index_info .info_class div').click(function () {
				$('.index_info .info_class div').removeClass('cur');
				$('.index_info .info_class div').eq($(this).attr('index') - 1).addClass('cur');
				$('.index_info .info_content').stop(true, true);
				var _this = this;
				var index = $(_this).attr('index');
				if ($('.index_info .info_content.cla' + index + '').is(':hidden')) {
					clearInterval(InfoImgMove);
					info_num = 0; InfoImgNum = 0;
					$('.index_info article.info_content').fadeOut(400)
					setTimeout(function () {
						info_cla = index;
						info(info_cla);
						$('.index_info .info_content').eq(info_cla - 1).fadeIn(400);
					}, 400);
				}
			});
			/*
			video(0);
			function video(value) {
				$('.mask .video_open h3.title').text($('.mask .video_open ul.list li').eq(value).find('p.title').text());
				$('.mask .video_open .play  p.key_word').html($('.mask .video_open ul.list li').eq(value).find('p.key_word').html());
				$('.mask .video_open .play  p.video_visit').html($('.mask .video_open ul.list li').eq(value).find('p.video_visit').html());
				var Url = $('.mask .video_open ul.list li').eq(value).attr('Url');
				//if (Url.search(".mp4") != -1) {
					//$('.play #video').html('');
				//}
				//else {
					$('.play #video').html('');
					var a = '<embed ref="play_embed" src="' + Url + '" type="application/x-shockwave-flash" class="video_play" pluginspage="http://www.macromedia.com/go/getflashplayer" width="480" height="380" wmode="transparent" play="true" loop="false" menu="false" allowscriptaccess="never" allowfullscreen="true"></embed>';
					$('.play #video').html(a);
				//}
			}
			$('.mask .video_open ul.list li').click(function () {
				$(this).parents().find('li').removeClass('cur');
				$(this).addClass('cur');
				$(this).parents('#VideoList').find('.play').css({ 'opacity': 0 });
				video($(this).index());
				$(this).parents('#VideoList').find('.play').animate({ 'opacity': 1 });
			});
			*/
			$('body').on('mouseenter', '.index_product .product_content .product_list a', function () {
				$(this).find('.ico').attr('src', $(this).attr('ico2'));
			});
			$('body').on('mouseleave', '.index_product .product_content .product_list a', function () {
				$(this).find('.ico').attr('src', $(this).attr('ico1'));
			});
		});
	</script>
    <!--
    <div class="code-top">
		<div class="code">
			<i class="btn"></i>
			<i class="code_bg"></i>
		</div>
		<div class="top" style="display: none;">
			<span class="top_btn">TOP</span>
			<span class="top_bg">返回顶部</span>
		</div>
	</div>
    -->
    <!--联系我们-->
<section class="index_contact">
    <div class="contact_content clearfix">
        <?php if(is_array($cateth)): foreach($cateth as $k=>$vo): if(($k+1) != 1): ?><div>
                    <h3><?php echo ($vo["catname"]); ?></h3>
                    <?php $catid = $vo['catid']; ?>
					<?php $list=M("Category")->where("pid=$catid and ishidden=0")->limit(4)->order("sort desc,catid asc")->select();foreach ($list as $key=>$vs): if($vo["catid"] == $vs['pid']): if(substr($vs['url'],0,7) == 'http://' or substr($vs['url'],0,8) == 'https://'): ?><a href="<?php echo ($vs["url"]); ?>"><?php echo ($vs["catname"]); ?></a>
                            <?php elseif($vs['url'] == ''): ?>
                                <a href="<?php echo U($vo['url'],array('catid'=>$vs['catid']));?>"><?php echo ($vs["catname"]); ?></a>
                            <?php elseif($vs['url'] != '' and (substr($vs['url'],0,7) != 'http://' or substr($vs['url'],0,8) != 'https://')): ?>
                                <a href="<?php echo U($vs['url'],array('catid'=>$vs['catid']));?>"><?php echo ($vs["catname"]); ?></a><?php endif; endif; endforeach; ?>
                </div><?php endif; endforeach; endif; ?>
        <div class="contact_code">
            <img src="/Public/Home/img/code.jpg" />
            <p>关注正虹环境</p>
        </div>
        <div class="contact_phone">
            <a class="on_line" href="http://p.qiao.baidu.com/cps/chat?siteId=11788570&userId=6675475" target="_blank"><i></i><span>在线咨询</span></a>
            <p class="time">周一至日&nbsp;8:30-18:00</p>
            <p class="phone"><?php echo getWebSetting('site_phone');?></p>
        </div>
        <div class="record_other clearfix">
            <img class="other clearfix" src="/Public/Home/img/other.jpg" />
        </div>
        <div class="links">
            <span>友情链接</span>
            <?php $list=M("Flink")->where("cid=0 and ishidden=0")->limit(0)->order("sort desc,linkid asc")->select();foreach ($list as $k=>$vo):?><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; ?>
        </div>
        <div class="record_number">COPYRIGHT&copy;12014&nbsp;正虹科技,ALL&nbsp;RIGHTS&nbsp;RESERVED&nbsp;<a href="http://www.miitbeian.gov.cn/"><?php echo getWebSetting('site_filing');?></a></div>
    </div>
</section>
<script src="/Public/Home/js/nav-footer.js" type="text/javascript" charset="utf-8"></script>

<script>
	$('.nav .column > li').hover(function () {
			$(this).find('.column_SL').stop(true, true).slideDown(400);
		}, function () {
			$(this).find('.column_SL').stop(true, true).slideUp(400);
		});
		$('.nav .column > li > .column_SL > .column_SL_list > li').hover(function () {
			$(this).parents(".column_SL").find(".column_SL_line").css('top', $(this).index() * 30 + 20);
		}, function () {
	});
</script>

	<script src="/Public/Home/js/SL.js" type="text/javascript" charset="utf-8"></script> 
    </body>
</html>