<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><?php echo ($config["companyname"]); ?>-后台管理系统</title>
<!--[if lt IE 8]>
<script>
	alert('H+已不支持IE6-8，请使用谷歌、火狐等浏览器\n或360、QQ等国产浏览器的极速模式浏览本页面！');
</script>
<![endif]-->
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="/Public/assets/css/Css.css" />
<link href="/Public/assets/css/font-awesome.min.css" rel="stylesheet">
<?php if($sel == 1 || $sel == 3 || $sel == 4): ?><script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.parse.js"></script>
    <script type="text/javascript" src="/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>
    <!--<script type="text/javascript" charset="utf-8" src="/Public/Ueditor/ueditor.config.min.js"></script>--><?php endif; ?>
<?php if($sel == 2 || $sel == 3 || $sel == 4): ?><link rel="stylesheet" type="text/css" href="/Public/User/css/uploadify.css" />
	<script src="/Public/assets/js/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/User/js/jquery.uploadify-3.1.js"></script>
    <link href="/Public/assets/js/css/style.css" rel="stylesheet" type="text/css"/>
	<script src="/Public/assets/js/jquey-bigic.js"></script> 
    <script>
        $(function(){
            $('span img').bigic();
        });
    </script><?php endif; ?>
<?php if($sel == 4): ?><link href="/Public/assets/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<link href="/Public/assets/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/assets/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script><?php endif; ?>
</head>
<body>

</body>
</html>
<block name="body">
	<ol class="breadcrumb">
		<li><a href="<?php echo U('Index/summarize');?>">首页</a></li>
		<li>产品管理</li>
	</ol>
	<div class="content">
		<div class="Config_nav">
			<ul>
				<li><a href="<?php echo U('Product/index');?>">产品管理</a></li>				<li><a class="on" href="<?php echo U('Product/apply');?>">案例管理</a></li>
				<li><a href="<?php echo U('Product/add_case',['goodsid' => $_GET['id']]);?>">添加案例</a></li>
			</ul>
		</div>
		<div class="Search">
			<form action="" method="get">
				<div class="JianSuo">
					<select name="status" id="">
						<option>发布状态</option>
						<option value="1">已发布</option>
						<option value="0">未发布</option>
					</select>
				</div>
				<div class="keyword"><input class="common-text input-text" size="16" placeholder="关键字" name="q" value=""  type="text"></div>
				<div class="btn1"><input class="btn btn-primary btn6 mr10" value="查询" type="submit" /></div>
			</form>
		</div>
		<form action="<?php echo U('Product/sortBatchs');?>" name="myform" id="myform" method="post">
			<div class="List">
				<div class="table-list">
					<ul>
						<li class="ID">ID</li>
						<li class="Name">标题</li>
						<li class="Property">所属产品</li>
						<li class="S_Order">排序</li>
						<li class="Status">是否发布</li>
						<li class="Oper">管理操作</li>
					</ul>
				</div>
				<?php if(is_array($lists)): foreach($lists as $k=>$vo): ?><div class="ProList">
						<ul>
							<li class="ID"><?php echo ($vo["id"]); ?></li>
							<li class="Name"><a href="<?php echo U('Product/edit_case',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li>
							<li class="Property"><?php echo ($vo["goods_name"]); ?></li>
							 <li class="S_Order">
								<input type="text" class="sInput" name="sort[<?php echo ($vo["id"]); ?>]" value="<?php echo ($vo["sort"]); ?>" />
							</li>
							<li class="Status"><?php echo ($vo[status]==1?'已发布':'<font color=red>未发布</font>'); ?></li>
							<li class="Oper">
                                <div>
                                	
                                    <a href="<?php echo U('Product/edit_case',array('id'=>$vo['id']));?>">编辑</a>                                    <span>|</span>
                                    <a href="<?php echo U('Product/delete_case',array('id'=>$vo['id']));?>" onclick="return confirm('确认是否删除?')">删除</a>
                                </div>
							</li>
						</ul>
					</div><?php endforeach; endif; ?>
			   
				<div class="cl" style="margin-top: 15px;"></div>
				<div class="Order_submit">
					<input class="btn btn-primary btn6 mr10" type="submit" value="排序" /><div class="tp_pages"><?php echo ($page); ?></div>
				</div>
			</div>
		</form>           
		<!-- Footer Start -->
<footer>
    技术支持：<a href="http://www.macroblue.net/" title="广州宏蓝计算机科技有限公司" target="_blank">宏蓝科技</a> 1.1.1.100305版本 &copy; 2016 - 2018
</footer>
<!-- Footer End -->	

	</div>
</black>