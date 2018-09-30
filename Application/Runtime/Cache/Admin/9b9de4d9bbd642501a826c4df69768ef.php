<?php if (!defined('THINK_PATH')) exit(); $sel = 2; ?>
<!DOCTYPE HTML>
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
        <li><a href="<?php echo U('Banner/index');?>">幻灯片管理</a></li>
        <li>编辑幻灯片</li>
    </ol>
    <div class="content">
        <div class="Config_nav">
            <ul>
                <li><a class="on" href="<?php echo U('Banner/index');?>">幻灯片管理</a></li>
                <li><a href="<?php echo U('Banner/add');?>">添加幻灯片</a></li>
            </ul>
        </div>
        <form action="<?php echo U('Banner/update');?>" method="post"  id="form" enctype="multipart/form-data" >
            <input type="hidden" name="id" value="<?php echo ($detail["id"]); ?>" />
            <input type="hidden" id="thumb"  name="thumb" value="<?php echo ($detail["thumb"]); ?>" />
            <div class="SiteContent">
                <ul>
                    <li class="Name">类型</li>
                    <li class="input">
                        <select name="cid">
                            <option value="0" <?php if($detail['cid'] == 0): ?>selected="selected"<?php endif; ?>>首页幻灯片</option>
                            <option value="1" <?php if($detail['cid'] == 1): ?>selected="selected"<?php endif; ?>>品牌商标</option>
                            <option value="2" <?php if($detail['cid'] == 2): ?>selected="selected"<?php endif; ?>>首页广告图</option>
                        </select>
                    </li>
                </ul>
                <ul>
                    <li class="Name">幻灯片名称</li>
                    <li class="input"><input class="common-text input-text" name="name" value="<?php echo ($detail["name"]); ?>" size="40" type="text"></li>
                </ul>
                <ul>
                    <li class="Name">LOGO</li>
                    <li class="input">
                        <input id="upload_file" type="file">
                        <?php if(!empty($detail["thumb"])): ?><div class="cl" style="margin-top: 5px;"></div>
                            <div class="Pic">
                                <span><img src="<?php echo ($detail["thumb"]); ?>" /></span>
                                <a href="javascript:void(0)" class="pic_img" onclick="delete_thumb(this);">删除</a>
                            </div><?php endif; ?>
                    </li>
                </ul>
                <ul>
                    <li class="Name">网址</li>
                    <li class="input"><input class="common-text input-text" name="url" value="<?php echo ($detail["url"]); ?>" size="40" type="text"></li>
                </ul>
                <ul>
                    <li class="Name">文章简介</li>
                    <li class="input">
                       <textarea name="info" class="common-textarea textarea" cols="30" style="width: 50%;" rows="5"><?php echo unsafe_replace($detail['info']);?></textarea>
                    </li>
                </ul>
                <ul>
                    <li class="Name">状态</li>
                    <li class="input">
                        <div class="radio"><span><input type="radio" name="ishidden" value="1" <?php if($detail['ishidden'] == 1): ?>checked="checked"<?php endif; ?>></span><label for="ishidden1">关闭</label></div>
                        <div class="radio"><span><input type="radio" name="ishidden" value="0" <?php if($detail['ishidden'] == 0): ?>checked="checked"<?php endif; ?>></span><label for="ishidden2">显示</label></div>
                    </li>
                </ul>
                <div class="cl" style="height: 10px;"></div>
                <div class="btn">
                    <input class="btn btn-primary btn6 mr10" value="提交" style="margin-right: 10px;" type="submit">
                    <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
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
<script type="text/javascript">
$(function(){
	$('#upload_file').uploadify({
		'queueSizeLimit'  : 1,
		'swf'             : '/Public/User/uploadify.swf',
		'uploader'        : "<?php echo U('Public/uploadAttach',array('session_id'=>session_id(),'type'=>'1'));?>",
		'fileObjName'     : $('#upload_file').attr('name'),
		'buttonClass'     : 'upload-case',
		'width'           : 150,
		'height'          : 25,
		'removeTimeout'   : 1,
		'buttonText'      : '上传图片',
		'fileTypeExts'    : '*.gif; *.jpg; *.png',
		'onUploadSuccess' : function(file, data, response) {
			//var data = $.parseJSON(data);
			var data=eval("("+data+")");
			if(data.status ==0){
				alert('上传出错，请稍后再试');
				return false;
			}
			if(data.status==1){           	
				var html = '<div class="cl" style="margin-top: 5px;"></div>'
				html += '<div id="attachment">'+'<span><img src="'+data.file+'"></span>' ;
				html += '<a href="javascript:void(0)" onclick="delete_attachment(this);">删除</a>';
				html += '<input type="hidden" name="thumb" value="'+data.file+'" /></div>';
				$('#upload_file').after(html);
			} else {
				alert('上传出错，请稍后再试');
				return false;
			}
		},
		'onSelect' : function(file) {
			var length = $('#attachment').length;
			if(length > 0){
				$('#upload_file').uploadify('cancel')
				$('#upload_file').uploadify('stop');
				alert('附件只允许上传一个');
				return false;
			}
		}
	});
});
function delete_attachment(e){
	var $this = $(e);
	$this.parent('div').remove();
}
function delete_thumb(e){
	var $this = $(e);
	$this.parent('div').remove();
	document.getElementById("thumb").value="";
}
</script>