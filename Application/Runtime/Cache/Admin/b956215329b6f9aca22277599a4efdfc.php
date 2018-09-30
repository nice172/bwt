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


    <ol class="breadcrumb">
        <li><a href="<?php echo U('Index/summarize');?>">首页</a></li>
        <li>菜单管理</li>
    </ol>
    <div class="content">
        <div class="Config_nav">
            <ul>
                <li><a class="on" href="<?php echo U('Menu/index');?>">菜单管理</a></li>
                <li><a href="<?php echo U('Menu/add');?>">添加菜单</a></li>
            </ul>
        </div>
        <form action="<?php echo U('Menu/listorder');?>" method="post" >
            <div class="List">
                <div class="table-list">
                    <ul>
                        <li class="ID">ID</li>
                        <li class="Name">菜单名称</li>
                        <li class="S_Order">排序</li>
                        <li class="Property">模块</li>
                        <li class="Status">状态</li>
                        <li class="Oper">管理操作</li>
                    </ul>
                </div>
                <?php if(is_array($list)): foreach($list as $k=>$vo): ?><div class="ProList">
                        <ul>
                            <li class="ID"><?php echo ($vo["id"]); ?></li>
                            <li class="Name">
                                <?php echo str_repeat("└─ ",$vo['level']);?><a href="<?php echo U('Menu/edit',array('id'=>$vo['id']));?>"><?php echo (str_cut($vo["name"],80)); ?></a>
                            </li>
                            <li class="S_Order">
                                <input type="text" class="sInput" name="sort[<?php echo ($vo["id"]); ?>]" value="<?php echo ($vo["sort"]); ?>" />
                            </li>
                            <li class="Property"><?php echo ($vo["url"]); ?></li>
                            <li class="Status"><?php echo ($vo['status']==1?'正常':'禁用'); ?></li>
                            <li class="Oper">
                            	<div>
                                    <a href="<?php echo U('Menu/edit',array('id'=>$vo['id']));?>">编辑</a>
                                    <span>|</span>
                                    <a  href="<?php echo U('Menu/delete',array('id'=>$vo['id']));?>" onclick="return confirm('确认是否删除?')">删除</a>
                                </div>
                            </li>
                        </ul>
                    </div><?php endforeach; endif; ?>
                <div class="cl" style="margin-top: 15px;"></div>
                <div class="Order_submit"><input class="btn btn-primary btn6 mr10" type="submit" value="排序" /></div>
            </div>
        </form>           
        <!-- Footer Start -->
<footer>
    技术支持：<a href="http://www.macroblue.net/" title="广州宏蓝计算机科技有限公司" target="_blank">宏蓝科技</a> 1.1.1.100305版本 &copy; 2016 - 2018
</footer>
<!-- Footer End -->	

    </div>