<?php if (!defined('THINK_PATH')) exit(); $sel = 2; ?>
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
<script type="text/javascript" src="/Public/Home/js/jquery-3.0.0.js"></script><!--[if lt IE 8]><script>	alert('已不支持IE6-8，请使用谷歌、火狐等浏览器\n或360、QQ等国产浏览器的极速模式浏览本页面！');</script><![endif]-->
        <link rel="stylesheet" type="text/css" href="/Public/Home/Css/main.css"/>
		<script type="text/javascript"> 
			$(function(){
				systole();
			});
			function systole(){
				if(!$(".history").length){
					return;
				}
				var $warpEle = $(".history-date"),
				$targetA = $warpEle.find("h2 a"),
				parentH,
				eleTop = [];
				parentH = $warpEle.parent().height();
				$warpEle.parent().css({"height": 69});
				setTimeout(function(){
					$warpEle.find("ul").children(":not('h2:first')").each(function(idx){
						eleTop.push($(this).position().top);
						$(this).css({"margin-top":-eleTop[idx]}).children().hide();
					}).animate({"margin-top":0}, 1000).children().fadeIn();
					$warpEle.parent().animate({"height": parentH+69+74}, 3000);
					$warpEle.find("ul").children(":not('h2:first')").addClass("bounceInDown").css({"-webkit-animation-duration":"2s","-webkit-animation-delay":"0","-webkit-animation-timing-function":"ease","-webkit-animation-fill-mode":"both"}).end().children("h2").css({"position":"relative"});
					
				}, 600);
				$targetA.click(function(){
					$(this).parent().css({"position":"relative"});
					$(this).parent().siblings().slideToggle();
					$warpEle.parent().removeAttr("style");
					return false;
				});
			};
        </script>
    </head>
    <body>
    	<!--Header Start-->
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
                    <?php if(IS_SHOW && countnum($vo['catid']) != 0): ?><div class="column_SL" <?php if($vo['catid'] == 3): ?>style="left: -45px;"<?php endif; ?>>
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



        <!--Header end-->
        <!--Inside Banner Start-->
        <div class="banner" style="background-image: url(<?php echo get_catname(2,'thumb');?>)">        <!-- <div class="warp1300 fs36" style="background:#333;"><?php echo get_catname(2,'catname');?></div> -->		<div class="menus">            <div class="menuk">                <ul class="servmen">                <?php $list=M("Category")->where("pid=2 and ishidden=0")->limit(0)->order("sort asc")->select();foreach ($list as $k=>$vs): if(substr($vs['url'],0,7) == 'http://' or substr($vs['url'],0,8) == 'https://'): ?><li><a href="<?php echo ($vs["url"]); ?>" <?php if($vs['catid'] == $cate['catid']): ?>class="xm"<?php endif; ?>><?php echo ($vs["catname"]); ?><br /><?php echo ($vs["ecatname"]); ?></a></li>                    <?php elseif($vs['url'] == ''): ?>                        <li><a href="<?php echo U(get_catname(2,'url'),array('catid'=>$vs['catid']));?>" <?php if($vs['catid'] == $cate['catid']): ?>class="xm"<?php endif; ?>><?php echo ($vs["catname"]); ?><br /><?php echo ($vs["ecatname"]); ?></a></li>                    <?php elseif($vs['url'] != '' and (substr($vs['url'],0,7) != 'http://' or substr($vs['url'],0,8) != 'https://')): ?>                        <li><a href="<?php echo U($vs['url'],array('catid'=>$vs['catid']));?>" <?php if($vs['catid'] == $cate['catid']): ?>class="xm"<?php endif; ?>><?php echo ($vs["catname"]); ?><br /><?php echo ($vs["ecatname"]); ?></a></li><?php endif; endforeach; ?>                             </ul>            </div>        </div>        </div>

        <!--Inside Banner end-->       	<div class="tr">           	<div class="warp1300 fs14"><?php echo catpos(2,get_catname(2,'url')); echo ($cate["catname"]); ?></div>        </div>
        <!--Inside Content Start-->
        <div class="warp1300 m40">
        	<div class="Tar">
            	<h2><?php echo ($cate["catname"]); ?></h2>
            </div>
            <?php if($cate["ismodel"] == 0): ?><div class="Content">
                    <?php echo ($cate["content"]); ?>
                </div>
            <?php elseif($cate["ismodel"] == 1): ?>
            	<?php if($cate["catid"] == 9): ?><style>				.sub_cate {border-bottom:1px solid #ddd;margin-top:30px;}				.sub_cate ul li{display:inline-block;height:40px;font-size:14px;}				.sub_cate ul li a {display:block;line-height:40px;padding:0 10px;}				.sub_cate ul li a:hover,.sub_cate ul li a.current{background:#CD161C;color:#fff;}				.cate_com li {margin-top:15px;}				.cate_com li i img,.cate_com li i{height:220px;}				</style>				<div class="sub_cate">					<ul>						<?php if(is_array($sub_cate)): foreach($sub_cate as $key=>$v): ?><li><a href="<?php echo U('About/index',['catid' => $catid,'subid' => $v['catid']]);?>" <?php if($v['catid'] == $subid): ?>class="current"<?php endif; ?>><?php echo ($v["catname"]); ?></a></li><?php endforeach; endif; ?>					</ul>				</div>
                    <div class="">            <ul class="cate_com">                <?php if(is_array($lists)): foreach($lists as $key=>$vs): ?><li>                        <a href="<?php echo ($vs["thumb"]); ?>" target="_blank">                            <i><img src="<?php echo ($vs["thumb"]); ?>" alt="<?php echo ($vs["title"]); ?>" title="<?php echo ($vs["title"]); ?>" /></i>                        </a>                    </li><?php endforeach; endif; ?>                <div class="cl"></div>            </ul>
                                    <div class="page">                <div class="pages"><?php echo ($pages); ?></div>            </div>            <div class="cl"></div>                        
                    </div>
                     <script src="/Public/Home/js/roundabout.min.js" type="text/javascript" charset="utf-8"></script>
                    <script type="text/javascript" src="/Public/Home/js/jquery.easing.1.3.js" ></script>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        /*调用
                        $('.about2 ul').roundabout({
                           startingChild:0,
                            autoplay:false,
                            autoplayDuration:4000,
                            btnPrev: ".ban_r_btn", // 右按钮
                            btnNext: ".ban_l_btn", // 左按钮
                            easing: 'easeOutInCirc',
                            autoplayInitialDelay:0,
                            duration: 600 //切换一张所花费的时间，而不是 每隔多少秒切换一张
                        });                    	*/
                    
                    });
                    </script>
                <?php elseif($cate["catid"] == 11): ?>
                <div class="history">
                <?php $catid = $cate['catid']; ?>
                <?php $list=M("Category")->where("pid=$catid and ishidden=0")->limit(0)->order("sort desc,catid desc")->select();foreach ($list as $k=>$vo):?><div class="history-date">
                        <ul>
                            <h2>
                                <a href="#nogo"><?php echo ($vo["catname"]); ?></a>
                                <?php if(($k+1) == 1): ?><div class="company">
                                        <span>2000年-<?php echo (date('Y',time(date('Y-m-d g:i a',time())))); ?>年</span>
                                        <p>正虹环境</p>
                                    </div><?php endif; ?>
                            </h2>
                            <?php $cateid = $vo['catid']; ?>
                            <?php $list=M("Article")->where("catid in ($cateid) and status=1")->limit(0)->order("sort desc,id desc")->select();foreach ($list as $k=>$vs):?><li>
                                    <h3><?php echo (date("m.d",$vs["inputtime"])); ?><span><?php echo (date("Y",$vs["inputtime"])); ?></span></h3>
                                    <div class="Root fl">
                                        <i><img src="<?php echo ($vs["thumb"]); ?>" /></i>
                                        <div class="Text">
                                            <h4><?php echo ($vs["title"]); ?></h4>
                                            <p><?php echo ($vs["info"]); ?></p>
                                        </div>
                                    </div>
                                </li><?php endforeach; ?>
                        </ul>
                    </div><?php endforeach; ?>
                </div>
                <?php elseif($cate["catid"] == 42): ?>
                	<div class="cl" style="height: 15px;"></div>
                	<div class="Bus_img"><?php echo ($cate["content"]); ?></div>
                    <ul class="Range">
                    	<?php $catid = $cate['catid']; ?>
                    	<?php $list=M("Article")->where("catid in ($catid) and status=1")->limit(0)->order("sort desc,id desc")->select();foreach ($list as $k=>$vo):?><li>
                                <label><?php echo ($vo["title"]); ?></label>
                                <p><?php echo ($vo["info"]); ?></p>
                            </li><?php endforeach; ?>
                    </ul><?php endif; endif; ?>
            
            <div class="cl"></div>
        </div>
        <!--Inside Content end-->
        <!--Footer Start-->
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

    </body>
</html>