<?php if (!defined('THINK_PATH')) exit(); $sel = 6; ?>
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
        <link rel="stylesheet" type="text/css" href="/Public/Home/Css/style.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/Home/Css/Fume.css"/>
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
        <div class="banner" style="background-image: url(<?php echo get_catname(40,'thumb');?>)">
        	<div class="warp1300 fs36"><?php echo get_catname(40,'catname');?></div>
        	<div class="tr">
            	<div class="warp1300 fs14"><?php echo catpos(40,get_catname(40,'url')); echo ($cate["catname"]); ?></div>
            </div>
        </div>
        <div class="warp1300 fume m50">
			<h1><span>全国物联网应用示范工程，</span>全国生态城市建设榜样工程</h1>
            <p class="info">正虹环境，中国油烟在线监控实力品牌</p>
            <div class="cl"></div>
            <ul class="video">
            	<li>
                	<i><a href="http://player.youku.com/embed/XMzcyNjU1NTgzNg==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_1.jpg" /></a></i>
                    <p><a href="http://player.youku.com/embed/XMzcyNjU1NTgzNg==" class="fancybox" data-width="1080" data-height="608">正虹油烟监控，向餐饮油烟说不</a></p>
                </li>
                <li>
                	<i><a href="http://player.youku.com/embed/XMzcyNzY0NTM3Ng==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_2.jpg" /></a></i>
                    <p><a href="http://player.youku.com/embed/XMzcyNzY0NTM3Ng==" class="fancybox" data-width="1080" data-height="608">为什么要做油烟监控？</a></p>
                </li>
                <li>
                	<i><a href="http://player.youku.com/embed/XMzcyNzYzOTUwNA==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_3.jpg" /></a></i>
                    <p><a href="http://player.youku.com/embed/XMzcyNzYzOTUwNA==" class="fancybox" data-width="1080" data-height="608">正虹油烟监控，无锡物联网应用工程</a></p>
                </li>
            </ul>
        </div>
        <div class="hzdwBg">
        	<div class="warp1300 hzdw">
            	<a href="">CCTV品牌影响力推荐企业</a>
                <a href="">《中国环境报》专题报道</a>
                <a href="">《南方日报》专题报道</a>
                <a href="">广东省推荐示范工程</a>
            </div>
        </div>
        <div class="warp1300 fume m50">
			<h1><span>投身餐饮油烟在线监控的</span>四大理由</h1>
            <p class="info">餐饮油烟已成为城市大气重要污染源</p>
            <div class="cl"></div>
            <div class="sdlyBg">
            	<div class="fl">
                	<div class="sdly">
                    	<b>1</b>
                        <p>
                        	<span>油烟扰民 危害严重</span>
                        	餐饮油烟中含有三百多种污染物，是继工业废<br />气、机动车尾气之后的城市空气第三大"污染<br />杀手"，对人体造成危害的同时，也是构成<br />城市PM2.5的来源之一。
                        </p>
                    </div>
                    <div class="cl" style="height: 90px;"></div>
                    <div class="sdly">
                    	<b>2</b>
                        <p>
                        	<span>传统监管 力不从心</span>
                        	目前政府对油烟的监管大都处于人工监管的<br />传统阶段，常常是执法人员到现场，违规排放<br />行为已停止，难以取证，油烟监管陷入困局。
                        </p>
                    </div>
                </div>
                <div class="sdlyBox absolute"></div>
                <div class="fr">
                	<div class="sdly sdlyfr">
                    	<b>3</b>
                        <p>
                        	<span>油烟治理 乱象丛生</span>
                        	尽管在环保政策的要求下，餐饮企业普遍安装<br />了油烟净化器，但大部分餐饮企业仍存在着油<br />烟未经处理直接排放，油烟治理设施运行不<br />正常等诸多问题。
                        </p>
                    </div>
                    <div class="cl" style="height: 90px;"></div>
                    <div class="sdly sdlyfr">
                    	<b>4</b>
                        <p>
                        	<span>生态城市 保驾护航</span>
                        	正虹油烟监控，打破传统油烟监管僵局，创<br />新性利用物联网技术，对餐饮油烟处理进行监<br />管，助力城市"生态文明"的建设。
                        </p>
                    </div>
                </div>
                <div class="cl"></div>
            </div>
        </div>
        <div class="cl"></div>
        <div class="zfzcBg">
        	<div class="warp1300 fume">
            	<h1><span>政策所指，</span>民心所向</h1>
                <p class="info" style="margin-bottom: 20px;">多地政府出台餐饮油烟整治措施</p>
                <div class="cl"></div>
                <ul class="zfzc">
                	<li>
                    	<h2><a href="">《"十三五"挥发性有机物污染防治工作方案》</a></h2>
                        <p>开展其他生活源VOCs治理。城市建成区餐饮企业应安装高效油烟净化设施，并确保正常使用。开展规模以上餐饮企业污染物排放自动监测试点，推广使用高效净化型家用吸油烟机。</p>
                    </li>
                    <li>
                    	<h2><a href="">《广东省大气污染防治行动方案（2014-2017年）》</a></h2>
                        <p>加强餐饮油烟污染治理，2015年底前，珠三角地区城市建成区内所有排放油烟的餐饮企业和单位食堂安装高效油烟净化设施，设施正常使用率不低于95%；2017年底前，各地级以上市至少选择一个典型区域开展规模化餐饮企业在线监控试点，建立长效监管机制。</p>
                    </li>
                    <li>
                    	<h2><a href="">广东省大气污染防治强化措施及分工方案</a></h2>
                        <p>全面加强饮食油烟治理。2017年底前所有排放油烟的餐饮企业和单位食堂应安装高效油烟净化措施，大型餐饮业户加装油烟在线监控监测设备，确保油烟净化措施正常使用。</p>
                    </li>
                    <li>
                    	<h2><a href="">成都市环境保护 "十三五"规划：</a></h2>
                        <p>升级餐饮油烟在线监控管理系统，郊区 （市）县参照中心城区餐饮油烟整治标准全面开展餐饮油烟整治，提高中型以上饮食企业油烟净化设施安装比例，开展特大型饮食企业安装油烟在线监控设施试点；</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="warp1300 fume">
        	<h1><span>正虹油烟在线监控系统</span>5大优势</h1>
            <p class="info wd">从源头降低城市PM2.5，解决油烟扰民和监管难问题</p>
            <div class="cl"></div>
            <div class="Brands ppys1">
            	<h2>中国油烟监控实力品牌<br />亚运会空气质量保障合作单位</h2>
                <p>承接亚运会空气质量保障项目的油烟在线监控环保企业，具有良好的口碑和信誉。</p>
            </div>
        </div>
        <div class="ysbg">
        	<div class="warp1300">
                <div class="Brands ppys2">
                    <h2>5项国家发明专利<br />铸就正虹油烟监控行业实力品牌地位</h2>
                    <p>拥有"油烟在线监控系统"5大核心专利技术！品质为真，值得信赖。</p>
                </div>
            </div>
        </div>
        <div class="warp1300">
            <div class="Brands ppys3">
                <h2>油烟监控"三大体系"，<br />成熟的管理经验</h2>
                <p>基于物联网的油烟在线监控技术体系，主动式运营维护的服务体系，协助柔性执法的管理体系，让每一个合作伙伴更省心。</p>
            </div>
        </div>
        <div class="ysbg">
        	<div class="warp1300">
                <div class="Brands ppys4">
                    <h2>持续的核心研发力，<br />让技术精益求精</h2>
                    <p>具有油烟监控系统自主研发实力，从V1.0到V5.0升级换代，专注于技术上的精益求精和优质的服务，让合作伙伴项目拓展更省心。</p>
                </div>
            </div>
        </div>
        <div class="warp1300">
            <div class="Brands ppys5">
                <h2>秉承"莲英精神"<br />为您提供全方位贴心服务</h2>
                <p>您听不到、看不到、想不到、做不到的，正虹替您听到、看到、想到、做到！主动运营，保障系统正常持续高效运行及时解决油烟监管难题！</p>
            </div>
        </div>
        <div class="ysbg" style=" padding: 30px 0px 60px;">
        	<div class="warp1300 fume">
                <h1><span>权威媒体</span>报道</h1>
                <p class="info wd">品牌的力量，您坚强的后盾</p>
                <div class="cl"></div>
                <div class="video">
                    <div class="spbox">
                    	<h3>对话央视</h3>
                        <div>
                        	<i><a href="http://player.youku.com/embed/XMzcyNjUxNzcxMg==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_4.jpg" /></a></i>
                            <p><a href="http://player.youku.com/embed/XMzcyNjUxNzcxMg==" class="fancybox" data-width="1080" data-height="608">中央电视台《影响力对话》栏目</a></p>
                        </div>
                        <div>
                        	<i><a href="http://player.youku.com/embed/XMzcyNjQ1MzQ1Mg==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_5.jpg" /></a></i>
                            <p><a href="http://player.youku.com/embed/XMzcyNjQ1MzQ1Mg==" class="fancybox" data-width="1080" data-height="608">在中央电视台对话著名主持人阿丘</a></p>
                        </div>
                    </div>
                    <div class="fgx"></div>
                    <div class="spbox">
                    	<h3>地方电视台对正虹环保事业的报道</h3>
                    	<div>
                        	<i><a href="http://player.youku.com/embed/XMzcyNjU5ODAwMA==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_6.jpg" /></a></i>
                            <p><a href="http://player.youku.com/embed/XMzcyNjU5ODAwMA==" class="fancybox" data-width="1080" data-height="608">杭州电视台</a></p>
                        </div>
                        <div>
                        	<i><a href="http://player.youku.com/embed/XMzcyNjU2Nzc3Ng==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_7.jpg" /></a></i>
                            <p><a href="http://player.youku.com/embed/XMzcyNjU2Nzc3Ng==" class="fancybox" data-width="1080" data-height="608">晋城城区《新视界》栏目</a></p>
                        </div>
                    </div>
                    <div class="fgx"></div>
                    <div class="spbox">
                    	<h3>环博会现场采访报道</h3>
                        <div>
                        	<i><a href="http://player.youku.com/embed/XMzcyNTkyMTAxMg==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_8.jpg" /></a></i>
                            <p><a href="http://player.youku.com/embed/XMzcyNTkyMTAxMg==" class="fancybox" data-width="1080" data-height="608">中国环保在线网《高端访谈》栏目</a></p>
                        </div>
                        <div>
                        	<i><a href="http://player.youku.com/embed/XMzcyNTkyMDk2OA==" class="fancybox" data-width="1080" data-height="608"><img src="/Public/Home/img/video_9.jpg" /></a></i>
                            <p><a href="http://player.youku.com/embed/XMzcyNTkyMDk2OA==" class="fancybox" data-width="1080" data-height="608">CCTV《匠人·匠心》栏目</a></p>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
        <div class="ljjm_bg">
        	<div class="warp1300 warp1000">
            	<h2><span>携手共创碧水蓝天 绿色家园</span>正虹环境诚邀您的加盟</h2>
                <a href="">立即加盟</a>
            </div>
        </div>
        <div class="warp1300 fume m40 N_news">
        	<h2>相关新闻资讯</h2>
            <div class="cl"></div>
            <ul class="news_ul">
            	<?php $list=M("Article")->where("catid in (5,22,23,24,25) and status=1")->limit(3)->order("sort desc,id desc")->select();foreach ($list as $k=>$vo):?><li class="box_siz">
                        <a href="<?php echo U('News/show',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>">
                            <i><img src="<?php echo ($vo["thumb"]); ?>" class="absolute" alt="<?php echo ($vo["title"]); ?>" /></i>
                            <div class="N_Info">
                                <h5><?php echo (str_cut($vo["title"],60)); ?></h5>
                                <p><?php echo ($vo["info"]); ?></p>
                                <label><?php echo (date("Y-m-d",$vo["inputtime"])); ?></label>
                            </div>
                        </a>
                    </li><?php endforeach; ?>
            </ul>
        </div>
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
        <link rel="stylesheet" href="/Public/Home/Css/jquery.fancybox.css">
        <script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
        <script type="text/javascript" src="/Public/Home/js/jwplayer.js"></script>
        <script type="text/javascript" src="/Public/Home/js/jquery.fancybox.js"></script>
        <script>
            $(document).ready(function () {
                $(".fancybox").fancybox({
                    fitToView: false,
                    content: '<span></span>',
                    afterLoad: function () {
                        var $width = $(this.element).data('width');
                        var $height = $(this.element).data('height');
						if (this.href){
                        	this.content = "<iframe frameborder='0' width='" + $width + "' height='" + $height + "' src='" + this.href + "' scrolling='no'></iframe>";
						//} else {
							//this.content = "<iframe frameborder='0' width='" + $width + "' height='" + $height + "' src='<?php echo U('public/Error');?>' scrolling='no'></iframe>";
						}
                    }
                });
            });
        </script>
    </body>
</html>