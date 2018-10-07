<?php if (!defined('THINK_PATH')) exit(); $sel = 3; ?>
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


	<ol class="breadcrumb">
		<li><a href="<?php echo U('Index/summarize');?>">首页</a></li>
		<li><a href="<?php echo U('Product/index');?>">产品管理</a></li>
		<li>添加案例</li>
	</ol>
	<div class="content">
		 <div class="Config_nav">
			<ul>
				<li><a href="<?php echo U('Product/index');?>">产品管理</a></li>				<li><a href="<?php echo U('Product/apply');?>">案例管理</a></li>
				<li><a class="on" href="<?php echo U('Product/add_case');?>">添加案例</a></li>
			</ul>
		</div>
		<form action="<?php echo U('Product/add_case');?>" method="post" id="form"  enctype="multipart/form-data">     
			<div class="Save">
				<div id=cpxqcon>
					<div id="cpxqcontags">
						<ul id="cpxqtags">
							<li class="selectTag"><A onClick="selectTag('cpxqtagContent0',this)" href="javascript:void(0)">常规选项</A></li>
							<li><A onClick="selectTag('cpxqtagContent1',this)" href="javascript:void(0)">SEO设置</A></li>
						</ul>
					</div>
					<div id="cpxqtagContent"> 
						<div class="cpxqtagContent selectTag" id=cpxqtagContent0 style="display:block;">
							<ul>
								<li class="Name">所属商品</li>
								<li class="input">
									<select name="catid">
										<option>选择商品</option>
										<?php if(is_array($goods_list)): foreach($goods_list as $k=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; ?>
									</select>
								</li>
							</ul>
						
							<ul>
								<li class="Name">案例名称</li>
								<li class="input"><input class="common-text input-text" name="title" size="40" datatype="*1-100" value=""  type="text"></li>
							</ul>
							<ul>
								<li class="Name">缩略图</li>
								<li class="input"><input id="upload_file" type="file"></li>
							</ul>
							<ul>
								<li class="Name">案例简介</li>
								<li class="input">
								   <textarea name="info" class="common-textarea textarea" cols="30" style="width: 50%;" rows="5"></textarea>
								</li>
							</ul>
							<ul>
								<li class="Name">详细内容</li>
								<li class="input"><script type="text/plain" id="editor" style="width: 100%;height: 350px;"></script></li>
							</ul>
							<style>.icheckbox_square-aero {margin: 1.5px 0px;}</style>
							<ul>
								<li class="Name">是否发布</li>
								<li class="input">
									<div class="radio"><span><input type="radio" name="status" value="1" checked="checked"></span><label for="status1">已发布</label></div>
									<div class="radio"><span><input type="radio" name="status" value="0"></span><label for="status2">未发布</label></div> 
								</li>
							</ul>
						</div>
					   
						<div class="cpxqtagContent" id=cpxqtagContent1>
                        	<ul>
								<li class="Name">SEO标题</li>
								<li class="input"><input class="common-text input-text" name="ptitle" value="" size="50" type="text"></li>
							</ul>
							<ul>
								<li class="Name">SEO关键词</li>
								<li class="input"><input class="common-text input-text" name="pkeywords" value="" size="50" type="text"></li>
							</ul>
							<ul>
								<li class="Name">SEO描述</li>
								<li class="input"><textarea name="pdescription" class="common-textarea textarea" cols="30" style="width: 50%;" rows="5"></textarea></li>
							</ul>
						</div>
						<div class="cl" style="height: 10px;"></div>
						<div class="btn">
							<input class="btn btn-primary btn6 mr10" name="submit" value="保存后关闭" style="margin-right: 10px;" type="submit"><input class="btn btn-primary btn6 mr10" name="submit_continue" style="margin-right: 10px;" value="保存后继续" type="submit"><input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
						</div>
					</div>
				</div>
			</div>    
		</form>           
		<!-- Footer Start -->
<footer>
    技术支持：<a href="http://www.macroblue.net/" title="广州宏蓝计算机科技有限公司" target="_blank">宏蓝科技</a> 1.1.1.100305版本 &copy; 2016 - 2018
</footer>
<!-- Footer End -->	

	</div>
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
</script>
<script type="text/javascript">
	$(function(){
		$('#upload_gallery').uploadify({
			'queueSizeLimit' : 10,
			'swf'             : '/Public/User/uploadify.swf',
			'uploader'        : "<?php echo U('Public/uploadAttach',array('session_id'=>session_id(),'type'=>'1'));?>",
			'fileObjName'     : $('#upload_gallery').attr('name'),
			'buttonClass'     : 'upload-case',
			'width'           : 150,
			'height'          : 25,
			'removeTimeout'   : 1,
			'buttonText'      : '上传多图',
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
					html += '<input type="hidden" name="gallery[]" value="'+data.file+'" /></span>';
					$('#upload_gallery').after(html);
				} else {
					alert('上传出错，请稍后再试');
					return false;
				}
			},
			'onSelect' : function(file) {
				var length = $('#attachment').length;
				if(length > 0&&lengh<11){
					$('#upload_gallery').uploadify('cancel')
					$('#upload_gallery').uploadify('stop');
					alert('附件只允许上传10个');
					return false;
				}
			}
		});		$('#upload_gallery2').uploadify({			'queueSizeLimit' : 10,			'swf'             : '/Public/User/uploadify.swf',			'uploader'        : "<?php echo U('Public/uploadAttach',array('session_id'=>session_id(),'type'=>'1'));?>",			'fileObjName'     : $('#upload_gallery2').attr('name'),			'buttonClass'     : 'upload-case',			'width'           : 150,			'height'          : 25,			'removeTimeout'   : 1,			'buttonText'      : '上传多图',			'fileTypeExts'    : '*.gif; *.jpg; *.png',			'onUploadSuccess' : function(file, data, response) {				//var data = $.parseJSON(data);				var data=eval("("+data+")");				if(data.status ==0){					alert('上传出错，请稍后再试');					return false;				}				if(data.status==1){           						var html = '<div class="cl" style="margin-top: 5px;"></div>'					html += '<div id="attachment2">'+'<span><img src="'+data.file+'"></span>' ;					html += '<a href="javascript:void(0)" onclick="delete_attachment(this);">删除</a>';					html += '<input type="hidden" name="gallery2[]" value="'+data.file+'" /></span>';					$('#upload_gallery2').after(html);				} else {					alert('上传出错，请稍后再试');					return false;				}			},			'onSelect' : function(file) {				var length = $('#attachment2').length;				if(length > 0&&lengh<11){					$('#upload_gallery2').uploadify('cancel')					$('#upload_gallery2').uploadify('stop');					alert('附件只允许上传10个');					return false;				}			}		});
	});
</script>
<script type="text/javascript" src="/Public/assets/js/selectTag/selectTag.js"></script>
<?php if($sel == 1 || $sel == 3 || $sel == 4): ?><script type="text/javascript">
    	var ue = UE.getEditor('editor');
		function setContent(isAppendTo) {
			var arr = [];
			arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
			UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
			alert(arr.join("\n"));
		}
    </script><?php endif; ?>