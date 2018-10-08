<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
        <link rel="stylesheet" type="text/css" href="/Public/Home/Css/main.css"/>
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
        <div class="banner" style="background-image: url(<?php echo get_catname(5,'thumb');?>)">
        	<div class="warp1300 fs36"><?php echo get_catname(5,'catname');?></div>
        </div>
        <!--Inside Banner end-->        	<div class="tr">            	<div class="warp1300 fs14"><?php echo catpos(5,get_catname(5,'url')); echo get_catname($cate['catid'],'catname');?></div>            </div>
        <!--Inside Content Start-->
        <div class="warp1300 m40">
            <div class="Left box_siz fl">                
                <div class="top_show">
                    <h3><?php echo ($cate["title"]); ?></h3>
                    <div class="Data">
                        <span>阅读量：<?php echo ($cate["views"]); ?></span><span class="Time"><?php echo (date("Y-m-d",$cate["inputtime"])); ?></span>						<span><div class="bshare-custom"><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a>						<a title="分享到人人网" class="bshare-renren"></a>						<a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>						<span class="BSHARE_COUNT bshare-share-count">0</span></div>						<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>						<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>						</span>
                    </div>
                </div>
                <div class="Content">
                    <?php echo ($cate["content"]); ?>				<div>  <div class="bshare-custom icon-medium">   <a title="分享到QQ空间" class="bshare-qzone"></a>   <a title="分享到新浪微博" class="bshare-sinaminiblog"></a>   <a title="分享到人人网" class="bshare-renren"></a>   <a title="分享到腾讯微博" class="bshare-qqmb"></a>   <a title="分享到网易微博" class="bshare-neteasemb"></a>   <a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>   <span class="BSHARE_COUNT bshare-share-count">0</span>  </div>			</div>
                </div>
                <div class="Flip box_siz">
                	<a href="<?php echo ($previous_page[url]); ?>" class="fl">上一篇</a><a href="javascript:history.go(-1)" class="return">返回</a><a href="<?php echo ($next_page[url]); ?>" class="fr">下一篇</a>
                </div>
            </div>
            <div class="Right fr">
                <div class="New_tit"><span>最新新闻</span></div>
                <ul class="New_news">
                    <?php $list=M("Article")->where("catid in (5,22,23,24,25) and status=1")->limit(6)->order("sort desc,id desc")->select();foreach ($list as $k=>$vs):?><li><a href="<?php echo U('News/show',array('id'=>$vs['id']));?>" title="<?php echo ($vs["title"]); ?>"><?php echo ($vs["title"]); ?></a></li><?php endforeach; ?>
                </ul>
                <div class="cl"></div>
                <ul class="Sort_li">
                	<?php $list=M("Category")->where("pid=4 and ishidden=0")->limit(0)->order("sort desc,catid asc")->select();foreach ($list as $k=>$vo): if(substr($vo['url'],0,7) == 'http://' or substr($vo['url'],0,8) == 'https://'): ?><li><a href="<?php echo ($vo["url"]); ?>" class="box_siz"><?php echo ($vo["catname"]); ?></a></li>
                        <?php elseif($vo['url'] == ''): ?>
                            <li><a href="<?php echo U(get_catname(4,'url'),array('catid'=>$vo['catid']));?>" class="box_siz"><?php echo ($vo["catname"]); ?></a></li>
                        <?php elseif($vo['url'] != '' and (substr($vo['url'],0,7) != 'http://' or substr($vo['url'],0,8) != 'https://')): ?>
                            <li><a href="<?php echo U($vo['url'],array('catid'=>$vo['catid']));?>" class="box_siz"><?php echo ($vo["catname"]); ?></a></li><?php endif; endforeach; ?>
                </ul>
            </div>
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

        <!--Footer end-->
    </body>
</html>