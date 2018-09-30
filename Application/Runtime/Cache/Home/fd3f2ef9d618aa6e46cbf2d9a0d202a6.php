<?php if (!defined('THINK_PATH')) exit(); $sel = 7; ?>
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
        <link rel="stylesheet" type="text/css" href="/Public/Home/Css/Vocs.css"/>
		<script type="text/javascript" src="/Public/Home/js/koala.min.1.5.js"></script>
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



        <!--Header end-->
        <div class="banner" style="background-image: url(<?php echo get_catname(41,'thumb');?>)">
			<div class="warp1300 fs36"><?php echo get_catname(41,'catname');?></div>
        	<div style="border-top: 1px solid rgba(237,237,237,0.2);">
            	<div class="warp1300 fs14"><?php echo catpos(41,get_catname(41,'url')); echo ($cate["catname"]); ?></div>
            </div>
		</div>
        <div class="warp1300 fume m50">
			<h1><span>正虹环境VOCs</span>治理技术系列</h1>
            <p class="info">满足不同行业废气治理需求</p>
            <div class="cl"></div>
            <ul class="zljs">
            	<li>
                	<i><img src="/Public/Home/img/zljs.jpg" /></i>
                    <span>喷漆烤漆废气处理</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs1.jpg" /></i>
                    <span>印刷废气处理</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs2.jpg" /></i>
                    <span>污水厂臭气</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs3.jpg" /></i>
                    <span>工业废气</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs4.jpg" /></i>
                    <span>制药废气</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs5.jpg" /></i>
                    <span>食品厂废气</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs6.jpg" /></i>
                    <span>配件表面涂装行业</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs7.jpg" /></i>
                    <span>制鞋厂废气</span>
                </li>
                <li>
                	<i><img src="/Public/Home/img/zljs8.jpg" /></i>
                    <span>涂料废气</span>
                </li>
                <li>
                	<span style="opacity:1;background: #cd181c;">+ 更多</span>
                </li>
            </ul>
        </div>
        <div class="fx_bg">
        	<div  class="warp1300 warp1240">
            	<h2><span>一站式解决VOCs处理难题</span><label>专业 高效 有保障</label></h2>
            	<a href="">了解正虹环境废气解决方案</a>
            </div>
        </div>
        <div class="warp1300" style="margin: 50px auto 0px">
        	<div class="zlys">
            	<img src="/Public/Home/img/zlys1.png" />
            	<div class="zlys_yd">
                	<b>优点</b>
                    <p>
                        高效：废气去除效率高，可达90%以上<br />
                        安全：常温下反应，不添加任何有毒物质<br />
                        无二次污染：净化及运行过程不产生废水、<br />
                        废渣等
                    </p>
                </div>
            </div>
            <div class="zlys_rig">
            	<div class="text">正虹环境VOCs治理技术系列之</div>
                <hr />
                <h2>多相催化氧化技术</h2>
                <p>多相催化氧化技术综合运用UV光量子光解、光催化氧化、高级氧化剂等多种原理，实现多种有机物的高效处理：通过高能射线照射在氧分子上，会产生活性很高的氧原子及臭氧；同时有机物分子曝露在高能射线中，会造成有机物断链，生成活性小分子有机物，活性很强的小分子有机物分子与氧原子、臭氧反应生成水及二氧化碳。同时，紫外光射线照射在催化剂表面，有机物分子及氧分子会在催化剂作用下生成水及二氧化碳。</p>
                <p class="vocs_img"><img src="/Public/Home/img/zlys1_1.png" /></p>
                <p>
                	适应性强：-20℃-70℃温度下均可工作，可适应不同浓度组分的废气净化<br />
运维简单、费用低：遇故障自动报警，运行费用低，低耗节能<br />
防腐耐用：设备采用304不锈钢，防腐性能高，寿命长达15年
                </p>
            </div>
            <div class="cl"></div>
            <a href="" class="botton">这种技术适合你吗？点此咨询</a>
        </div>
        <div style="background: #f7f7f7;">
        	<div class="warp1300" style="padding: 40px 0px;">
                <div class="zlys_rig zlys_fl fl">
                    <div class="text tr">正虹环境VOCs治理技术系列之</div>
                    <hr />
                    <h2 class="tr" style="padding: 5px 0px;">沸石转轮+蓄热催化燃烧（RCO）技术</h2>
                    <p>该套组合技术首先通过沸石转轮吸附-浓缩含有VOCs的废气，然后对浓缩后的VOCs进行脱附处理，再进入后段处理装置----蓄热催化燃烧（RCO）设备进行燃烧生产二氧化碳和水，达到彻底净化的目的。这样可以大幅降低运行成本。相比单独使用沸石转轮吸附或RCO技术，该种组合技术具有运行成本低、耗能少、净化率高、热回收率高、性价比高等突出优势。</p>
                    <p class="vocs_img" style="padding: 15px 0px"><img src="/Public/Home/img/zlys2_1.png" /></p>
                    <div class="zlys_yd">
                        <b style="padding: 0px;">优点</b>
                        <p style="padding: 2px 0px;">
                            高效、低耗：废气净化率高，可达95%以上，热回收率高<br />
                            安全：低温反应，配有阻火系统、报警装置等保护措施<br />
                            无二次污染：不产生氮氧化物等二次污染物，所有过程不造成二次污染
                        </p>
                    </div>
                </div>
                <div class="zlys fr">
                    <img src="/Public/Home/img/zlys2.png" />
                    <p style=" font-size: 14px; line-height: 24px; padding-top: 10px;">
                	适应性强：-20℃-70℃温度下均可工作，可适应不同浓度组分的废气净化<br />
                    运维简单、费用低：遇故障自动报警，运行费用低，低耗节能<br />
                    防腐耐用：设备采用304不锈钢，防腐性能高，寿命长达15年
                    </p>
                </div>
                <div class="cl"></div>
                <a href="" class="botton" style="margin: 40px auto 0px">立即在线咨询，了解详情</a>
            </div>
        </div>
        <div class="warp1300" style="margin: 50px auto 0px">
        	<div class="zlys">
            	<img src="/Public/Home/img/zlys3.png" />
            </div>
            <div class="zlys_rig">
            	<div class="text">正虹环境VOCs治理技术系列之</div>
                <hr />
                <h2 style="padding: 3px 0px;">等离子催化氧化技术</h2>
                <p>有机废气经等离子激发、离解活化，然后活化的废气经高能射线照射在稀有金属氧化物表面，与废气中的氧气发生催化氧化反应，最终转化为CO2和H2O等物质，从而达到净化废气的目的。等离子与催化氧化技术的结合解决了单一用等离子时能量利用率、处理效率低及应用条件高的缺陷。</p>
                <p class="vocs_img" style="padding: 11px 0px 10px"><img src="/Public/Home/img/zlys3_1.jpg" /></p>
                <div class="zlys_yd">
                	<b>优点</b>
                    <p>
                        高效：废气去除效率高，可达90%以上<br />
                        安全：常温下反应，不添加任何有毒物质<br />
                        无二次污染：净化及运行过程不产生废水、<br />
                        废渣等
                    </p>
                </div>
            </div>
            <div class="cl"></div>
            <a href="" class="botton">立即在线咨询，了解详情</a>
        </div>
        <div class="hgzy">
            <div class="warp1300 fume" style="padding: 60px 0px;">
                <h1><span>完善的售后服务体系</span>只为解决您的后顾之忧</h1>
                <p class="info wd" style="margin-bottom: 60px;">设备无需专人管理维护 专业售后7*24小时在线服务</p>
                <div class="cl"></div>
                <div class="zhcn fl"><b>正虹承诺</b></div>
                <ul class="zhcn_fr fr">
                	<li>
                    	<label>01</label>
                        <span>提供优质产品设备，具有质量保证，符合国家相关技术标准；</span>
                    </li>
                    <li>
                    	<label>02</label>
                        <span>在设备质保期内，承担运维服务义务，包括非人为因素的问题、零部件免费更换服务等；</span>
                    </li>
                    <li>
                    	<label>03</label>
                        <span>提供免费升级服务。对仪器设备及时进行免费升级，提高设备运行效率而不影响系统正常运行；</span>
                    </li>
                    <li>
                    	<label>04</label>
                        <span>提供免费技术培训。免费培训采购人的运行和维护人员，并使采购人的这些人员能熟练得操作、维护设备；</span>
                    </li>
                    <li>
                    	<label>05</label>
                        <span>提供远程服务，让客户的疑问能够随时随地得到解决；</span>
                    </li>
                    <li>
                    	<label>06</label>
                        <span>以ISO9001质量管理体系和OHSMS18001职业健康安全管理体系为工程实施目标，严格控制、监督、检查工程质量。</span>
                    </li>
                </ul>
                <div class="cl"></div>
                <h3 class="zhcn_tel">全国服务热线：4006-060-2822</h3>
			</div>
        </div>
        <div class="warp1300 fume m50">
        	<div class="fume_info"><h1 style="margin-bottom: 0px;"><span>技术应用</span>工程示例</h1></div>
            <div class="cl"></div>
            <div class="warp1300 zjjt">
            	<h2>中集集团VOCs废气处理<span>风量：720000m³/h</span><span>喷漆烤漆行业案例</span></h2>
                <div class="ov">
                	<i><img src="/Public/Home/img/ov1.jpg" /></i>
                    <div class="ov_info">
                    	<b>客户简介：</b>
                        <p>中国国际海运集装箱（集团）股份有限公司（简称：中集集团），是世界领先的物流装备和能源装备供应商，总部位于中国深圳。为响应国家环保号召，集团拟对生产车间喷涂废气进行治理，委托正虹为其进行废气治理方案设计并施工。</p>
                        <br />
                        <b>废气成分：</b>
                        <p>丙二醇甲醚醋酸酯、乙二醇丁醚、丙二醇等有机废气</p>
                        <br />
                        <b>定制方案：</b>
                        <p>经过反复实地勘测，并结合当前中集实际情况，正虹废气治理团队为其设计了一套废气处理方案。通过采用多相催化氧化设备，综合应用紫外光光解、UV光量子光解以及催化剂等多种技术氧化分解有机废气，生成CO2和H2O，达到净化的目的。</p>
                        <br />
                        <b>排放标准：</b>
                        <p>《大气污染物综合排放标准GB 16297-1996》和《恶臭污染物排放标准》</p>
                    </div>
                    <div class="cl"></div>
                </div>
            </div>
            <div class="warp1300 zjjt">
            	<h2>上海太太乐食品有限公司VOCs废气处理<span>风量：400000m³/h</span><span>食品行业案例</span></h2>
                <div class="ov E">
                	<i class="fr"><img src="/Public/Home/img/ov2.jpg" /></i>
                    <div class="ov_info">
                    	<b>客户简介：</b>
                        <p>上海太太乐食品有限公司是一家生产调味品的公司，共计调味品生产线20条，每处废气量20000m3/h。该厂废气经处理排出后仍有较明显气味，被周边居民投诉。因此，公司领导层决定更换原有净化设备，为此委托正虹为其设计一套行之有效的废气处理方案并负责施工。</p>
                        <br />
                        <b>废气成分：</b>
                        <p>酯类、醇类、芳烃类等具有异味的挥发性有机废气</p>
                        <br />
                        <b>定制方案：</b>
                        <p>经过现场勘查，工程师设计方案如下：收集好的废气，先通过喷淋塔装置，采用天然植物液作为添加剂，进行预处理，并除去废气中颗粒物等物质，废气经除水后再进入净化装置，通过低温等离子和多相催化氧化的协同作用，是废气物质降解转化成低分子化合物、并最终氧化为水和二氧化碳，达到脱除有机废气的目的，达标排放。</p>
                        <br />
                        <b>排放标准：</b>
                        <p>上海市《恶臭（异味）污染物排放标准》、上海市《大气污染物综合排放标准》</p>
                    </div>
                    <div class="cl"></div>
                </div>
            </div>
            <a href="" class="botton">查看更多技术应用工程</a>
            <div class="cl"></div>
        </div>
        <div class="made_bg">
        	<div  class="warp1300">
            	<h2>"一企一案 "<span>个性化定制废气解决方案</span><span>专业处理VOCs废气难题</span></h2>
            	<a href="">立即获取定制方案</a>
            </div>
        </div>
        <div class="warp1300 fume m50">
        	<div class="fume_info"><h1 style="margin-bottom: 0px;">专利证书与资质</h1></div>
            <div class="cl"></div>
           	<div class="honor">
            	<ul>
                	<li><img src="/Public/Home/img/honor1.jpg" /></li>
                    <li><img src="/Public/Home/img/honor2.jpg" /></li>
                    <li><img src="/Public/Home/img/honor3.jpg" /></li>
                    <li><img src="/Public/Home/img/honor4.jpg" /></li>
                    <li><img src="/Public/Home/img/honor5.jpg" /></li>
                </ul>
            </div>
            <div class="cl" style="height: 40px;"></div>
            <div class="honor">
            	<ul>
                	<li><img src="/Public/Home/img/honor6.jpg" /></li>
                    <li><img src="/Public/Home/img/honor7.jpg" /></li>
                    <li><img src="/Public/Home/img/honor8.jpg" /></li>
                    <li><img src="/Public/Home/img/honor9.jpg" /></li>
                    <li><img src="/Public/Home/img/honor10.jpg" /></li>
                </ul>
            </div>
        </div>
        <div style="background: #f7f7f7;">
        	<div class="warp1300 fume" style=" padding: 50px 0px 60px;">
                <div class="fume_info E"><h1 style="margin-bottom: 0px;">涉VOCs污染物排放相关法律法规</h1></div>
                <div class="cl"></div>
				<div class="flfg">
                	<i><img src="/Public/Home/img/flfg.jpg" /></i>
                    <p>
                    	2010年，《关于推进大气污染联防联控工作改善区域空气质量指导意见的通知》在国家层面首次将VOCs列为防控重点污染物；<br />
                        2013年，《大气污染防治计划行动》将VOCs纳入排污费征收范围；<br />
                        2015年，《挥发性有机物排污收费试点办法》在石油化工和包装印刷行业试点征览VOCs排污费；<br />
                        2016年，《"十三五"生态环境保护规划》要求涂装领域的汽车、船舶、家具等七大重点行业必须实施VOCs综合治理；<br />
                        2016年，《重点行业挥发性有机物削减行动计划》提出到2018年，工业行业VOCs排放量比2015年削减330万吨以上；<br />
                        2017年，《"十三五"挥发性有机物污染防治工作方案》中要求，实施重点地区、重点行业VOCs污染减排，到2020年，排放总量下降10%以上。
                    </p>
                </div>
            </div>
        </div>
        <div class="warp1300 fume hzlc" style=" padding: 50px 0px 60px;">
            <div class="fume_info R"><h1 style="margin-bottom: 0px;"><span>VOCs废气处理</span>合作流程</h1></div>
            <div class="cl"></div>
            <ul>
            	<li>
                	<div><label>01</label><span>项目询盘</span></div>
                    <i></i>
                </li>
                <li>
                	<i></i>
                	<div><label>02</label><span>场地勘察</span></div>
                </li>
                <li>
                	<div><label>03</label><span>制作方案</span></div>
                    <i></i>
                </li>
                <li>
                	<i></i>
                	<div><label>04</label><span>案例考察</span></div>
                </li>
                <li>
                	<div><label>05</label><span>确认合作</span></div>
                    <i></i>
                </li>
                <li>
                	<i></i>
                	<div><label>06</label><span>安装设备</span></div>
                </li>
                <li>
                	<div><label>07</label><span>环保验收</span></div>
                    <i></i>
                </li>
            </ul>
        </div>
        <div style="background: #f7f7f7;">
        	<div class="warp1300 fume" style=" padding: 40px 0px 60px;">
                <h1>关于正虹环境</h1>
                <p class="fume_info">CCTV品牌影响力推荐品牌</p>
                <div class="cl"></div>
                <div class="About">
                	<div class="About_img">  
                        <div id="fsD1" class="focus">  
                            <div id="D1pic1" class="fPic">
                                <div class="fcon"><img src="/Public/Home/img/About_img.jpg" style="opacity: 1; "></div>
                                <div class="fcon"><img src="/Public/Home/img/About_img1.jpg" style="opacity: 1; "></div>
                                <div class="fcon"><img src="/Public/Home/img/About_img2.jpg" style="opacity: 1; "></div>
                            </div> 
                            <div class="fbg">  
                                <div class="D1fBt" id="D1fBt"> 
                                    <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>0</i></a>  
                                    <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>1</i></a>  
                                    <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>2</i></a>  
                                </div>  
                            </div> 
                        </div>  
                        <script type="text/javascript">
                            Qfast.add('widgets', { path: "/Public/Home/js/terminator2.2.min.js", type: "js", requires: ['fx'] });  
                            Qfast(false, 'widgets', function () {
                                K.tabs({
                                    id: 'fsD1',   //焦点图包裹id  
                                    conId: "D1pic1",  //** 大图域包裹id  
                                    tabId:"D1fBt",  
                                    tabTn:"a",
                                    conCn: '.fcon', //** 大图域配置class       
                                    auto: 1,   //自动播放 1或0
                                    effect: 'fade',   //效果配置
                                    eType: 'click', //** 鼠标事件
                                    pageBt:true,//是否有按钮切换页码
                                    // bns: ['.prev', '.next'],//** 前后按钮配置class                          
                                    interval: 3000  //** 停顿时间  
                                }) 
                            })
                        </script>
                    </div>
                    <div class="About_con">
                    	<p>广州正虹环境科技有限公司是一家由国资参股的高新技术企业，公司自2000年成立至今，致力于环境治理与环境监测技术的研发与应用，是一家从事环保产品研发、工程应用、运营维护，涵盖VOCs治理与油烟在线监测、环保平台、水质监测等方面的专业环保企业。</p>
<p>公司总部位于广州市科学城，是广州市认定的科技创新小巨人企业和广州市企业研究开发机构。公司通过了ISO9001、ISO14001及OHSMS18001认证，具备环境监测运营和环保工程承建等资质，拥有5项发明专利、12项广东省高新技术产品、44项国家软件著作权，具有先进的技术水平和雄厚的研发实力。</p>
<p>公司在有机废气治理领域拥有多项专利技术，主要产品有多相催化氧化设备、蓄热催化燃烧（RCO）设备、等离子催化氧化设备等。</p>
<p>公司一直以来秉着"莲英精神——我们的合作伙伴对象听不到、看不到、想不到、做不到的，我们替他听到看到想到做到"的主动式服务理念，用心为用户提供高附加值的服务，积极创新开拓环保技术新领域，完成了多地挥发性有机物（VOCs）废气治理工程，并通过环保验收。正虹环境致力于为合作伙伴提供专业全面的环保解决方案，真正想环保所想，用技术与服务武装核心竞争力，打造品牌化智慧生态环境服务体系。</p>
                    </div>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
         <div class="fdback_bg">
    <div class="warp1300 fd">
        <h5>选择正虹，和我们一起治理环境</h5>
        <p>我们视口碑为生命，视服务为根本</p>
        <div class="cl"></div>
        <div class="fl fdback">
            <h6>留言让专业顾问联系您</h6>
            <form method="post" name="myform" id="myform" action="<?php echo U('Contact/feedb');?>">
                <div class="row">
                    <div class="fl Input"><input name="name" class="iInput border" placeholder="姓名 *" id="name" type="text" /></div>
                    <div class="fr Input"><input name="telephone"  class="iInput border" placeholder="手机 *" type="text" id="telephone" /></div>
                </div>
                <div class="row">
                    <div class="fl Input"><input name="qq" class="iInput border" placeholder="微信 *" type="text"  id="qq" /></div>
                    <div class="fr Input"><input name="title" class="iInput border" placeholder="标题 *" id="title" type="text" /></div>
                </div>
                <div class="row">
                    <textarea name="content" id="content" rows="4" placeholder="留言内容 *" class="iInput text border"></textarea>
                </div>
                <div class="cl" style="height: 20px;"></div>
                <div>
                    <button name="submit" class="submit border" type="submit">提 交</button>
                </div>
            </form>
        </div>
        <div class="fr ly">
            <h6>留言让专业顾问联系您</h6>
            <div id="demo">
                <div id="indemo">
                    <div id="demo1">
                        <ul>
                        	<?php $list=M("Guestbook")->where("status = 1")->limit(0)->order("id desc")->select();foreach ($list as $k=>$vo):?><li>
                                    <div class="ip">(来自<?php echo ($vo["city"]); ?>的用户)<?php echo ($vo["name"]); ?></div>
                                    <div class="fd_con"><?php echo ($vo["content"]); ?></div>
                                </li><?php endforeach; ?>
                        </ul>
                    </div>
                    <div id="demo2"></div>
                </div>
            </div>
        </div>
        <div class="cl"></div>
    </div>
</div>
<script>
    var speed=100;
    var tab=document.getElementById("demo");
    var tab1=document.getElementById("demo1");
    var tab2=document.getElementById("demo2");
    
    tab2.innerHTML=tab1.innerHTML;
    function Marquee(){
        if(tab2.offsetHeight-tab.scrollTop<=0)
            tab.scrollTop-=tab1.offsetWidth
        else{
            tab.scrollTop++;
        }
    }
    var MyMar=setInterval(Marquee,speed);
    tab.onmouseover=function() {clearInterval(MyMar)};
    tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
</script>
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