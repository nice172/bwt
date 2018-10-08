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
        <div class="banner" style="background-image: url(<?php echo get_catname(7,'thumb');?>)">
        	<div class="warp1300 fs36"><?php echo get_catname(7,'catname');?></div>
        	<div class="tr">
            	<div class="warp1300 fs14"><?php echo catpos(7,get_catname(7,'url')); echo ($cate["catname"]); ?></div>
            </div>
        </div>
        <!--Inside Banner end-->
        <!--Inside Content Start-->
        <div class="warp1300" style="margin: 40px auto 30px;">
            <div class="Tar"><h2><?php echo get_catname(7,'catname');?></h2></div>
            <h4 class="Tit">欢迎您浏览正虹官网，如果您遇到的问题，请在下方寻找对应的联系方式</h4>
			<ul class="Contact">
            	<li>
                	<i></i>
                	<h5>地址</h5>
                    <p>广州高新技术开发区科学城科学大道182号创新大厦C1座7楼701</p>
                </li>
                <li>
                	<i></i>
                	<h5>电话</h5>
                    <p>400-060-2822/ 020-89232836</p>
                </li>
                <li>
                	<i></i>
                	<h5>邮箱</h5>
                    <p>zhkj@zhenghongkeji.com</p>
                </li>
                <li>
                	<i></i>
                	<h5>公众号</h5>
                    <p>微信搜索“正虹环境”关注</p>
                </li>
            </ul>
			<div class="cl"></div>
        </div>
        <h3 class="root">地址地图</h3>
        <div class="a button-row"></div>
        <div class="modal fade">
			<div  id="container"></div>
			<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=4d57777becc438ccd14e00f013243166"></script>
            <script type="text/javascript">
                var map = new AMap.Map('container',{
                    zoom: 16,
                    center: [113.456502,23.167185]//new AMap.LngLat(116.39,39.9)
                });
                marker = new AMap.Marker({
                    position: [113.456502,23.167185],  //标记的地图坐标 
                    map: map
                });
                var marker = new AMap.Marker({
                        icon : 'http://vdata.amap.com/icons/b18/1/2.png',//24px*24px      //自定义图标
                        position : provinces[i].center.split(','),
                        offset : new AMap.Pixel(-12,-12),
                        map : mapObj
                });
            </script>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">关闭</span></button>
        </div>
        <div class="warp1300" style="margin: 30px auto 40px;">
            <h3 class="root">在线留言</h3>
            <div class="Feedback">
                <form action="<?php echo U('Contact/insert');?>" method="post">
                    <div class="row">
                        <div class="fl Input wow bounceInLeft"><input name="name" class="iInput box_siz border" placeholder="姓名 *" id="name" type="text" /></div>
                        <div class="fr Input wow bounceInRight"><input name="qq" class="iInput box_siz border" placeholder="微信 *" type="text"  id="qq" /></div>
                    </div>
                    <div class="row">
                        <div class="fl Input wow bounceInLeft"><input name="telephone"  class="iInput box_siz border" placeholder="手机 *" type="text" id="telephone" /></div>
                        <div class="fr Input wow bounceInRight"><input name="email" class="iInput box_siz border" placeholder="邮箱" type="text" id="email" /></div>
                    </div>
                    <div class="wow bounceInUp">
                        <div class="row cl6"><input name="title" class="iInput box_siz border" placeholder="标题 *" id="title" type="text" /></div>
                        <div class="row cl6"><textarea name="content" id="content" rows="4" placeholder="留言内容 *" class="iInput box_siz text border"></textarea></div>
                        <div class="row cl6">
                            <div class="fl fiel"><input  name="code" class="iInput box_siz border" placeholder="验证码" type="text" ></div>
                            <div class="fl code_img"><img src="<?php echo U('Public/verify');?>" title="看不清？点击刷新" style="display:inline;" onclick="this.src=this.src+'?'" /></div>
                        </div>
                        <div class="simple_name">
                            <button name="submit" class="submit border" type="submit">提 交</button>
                        </div>
                    </div>
                </form>
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
		<script type="text/javascript" src="/Public/Home/js/script.js"></script>
    </body>
</html>