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
			<li><a href='<?php echo U('Index/summarize');?>'>首页</a></li>
            <li><a href='<?php echo U('Category/index');?>'>栏目管理</a></li>
            <li>添加栏目</li>
		</ol>
        <div class="content">
        	 <div class="Config_nav">
                <ul>
                    <li><a href="<?php echo U('Category/index');?>">栏目管理</a></li>
                    <li><a class="on" href="<?php echo U('Category/add');?>">添加栏目</a></li>
                    <li><a href="<?php echo U('Category/addBatch');?>">批量添加</a></li>
                </ul>
            </div>
            <form action="<?php echo U('Category/insert');?>" method="post"  id="formdata" enctype="multipart/form-data" >      
                <div class="Save">
                    <div id=cpxqcon>
                        <div id="cpxqcontags">
                            <ul id="cpxqtags">
                                <li class="selectTag"><A onClick="selectTag('cpxqtagContent0',this)" href="javascript:void(0)">常规选项</A></li>
                                <li><A onClick="selectTag('cpxqtagContent1',this)" href="javascript:void(0)">SEO设置</A></li>
                                <li><A onClick="selectTag('cpxqtagContent2',this)" href="javascript:void(0)">栏目内容</A></li>
                                <!--<li><A onClick="selectTag('cpxqtagContent3',this)" href="javascript:void(0)">多图设置</A></li>-->
                            </ul>
                        </div>
                        <div id="cpxqtagContent"> 
                            <div class="cpxqtagContent selectTag" id="cpxqtagContent0" style="display:block;">
                                <input type="hidden" name="catid" value="<?php echo ($detail["catid"]); ?>" />
                                <ul>
                                    <li class="Name">上级栏目</li>
                                    <li class="input">
                                        <select name="pid">
                                            <option value="0">顶级栏目</option>
                                            <?php if(is_array($list)): foreach($list as $k=>$vo): ?><option value="<?php echo ($vo["catid"]); ?>"><?php echo str_repeat("└─",$vo['level']); echo ($vo["catname"]); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="Name">栏目名称</li>
                                    <li class="input"><input class="common-text input-text"  name="catname" size="40" datatype="*2-16" nullmsg="请填写栏目名称" value=""  type="text"></li>
                                </ul>
                                <ul>
                                    <li class="Name">栏目名称(英)</li>
                                    <li class="input"><input class="common-text input-text"  name="ecatname" size="40" value=""  type="text"></li>
                                </ul>
                                <ul>
                                    <li class="Name">栏目链接</li>
                                    <li class="input"><input class="common-text input-text"  name="url" size="40" value="" nullmsg="请填写栏目链接"  type="text"></li>
                                </ul>
                                <ul>
                                    <li class="Name">分页数目</li>
                                    <li class="input"><input class="common-text input-text"  name="page" size="10" value="" nullmsg="请填写分页数目"  type="text"></li>
                                </ul>
                                <ul>
                                    <li class="Name">模型</li>
                                    <li class="input">
                                    	<div class="radio"><span><input type="radio" name="ismodel" value="0"></span><label for="ismodel0">单页</label></div>
                                        <div class="radio"><span><input type="radio" name="ismodel" value="1" checked="checked"></span><label for="ismodel1">文章</label></div>
                                        <div class="radio"><span><input type="radio" name="ismodel" value="2"></span><label for="ismodel2">产品</label></div>
                                        <div class="radio"><span><input type="radio" name="ismodel" value="3"></span><label for="ismodel3">视频</label></div>
                                        <div class="radio"><span><input type="radio" name="ismodel" value="4"></span><label for="ismodel4">下载</label></div>
                                        <div class="radio"><span><input type="radio" name="ismodel" value="5"></span><label for="ismodel5">招聘</label></div>
                                        <div class="radio"><span><input type="radio" name="ismodel" value="6"></span><label for="ismodel6">链接</label></div>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="Name">支持评论</li>
                                    <li class="input">
                                        <div class="radio"><span><input type="radio" name="issend" value="0" checked="checked"></span><label for="issend1">不支持</label></div>
                                        <div class="radio"><span><input type="radio" name="issend" value="1"></span><label for="issend2">支持</label></div>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="Name">隐藏栏目</li>
                                    <li class="input">
                                        <div class="radio"><span><input type="radio" name="ishidden" value="1" ></span><label for="ishidden1">隐藏</label></div>
                                        <div class="radio"><span><input type="radio" name="ishidden" value="0" checked="checked"></span><label for="ishidden2">显示</label></div>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="Name">封面图片</li>
                                    <li class="input"><input id="upload_file" type="file"></li>
                                </ul>
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
                                <ul>
                                    <li class="Name">栏目属性</li>
                                    <li class="input">
                                        <div class="radio"><span><input type="radio" name="ispart" value="0" checked="checked"></span><label for="ispart1">最终列表</label></div>
                                        <div class="radio"><span><input type="radio" name="ispart" value="1"></span><label for="ispart2">频道封面</label></div> 
                                    </li>
                                </ul>
                            </div>
                            <div class="cpxqtagContent" id="cpxqtagContent1">
                            	<ul>
                                    <li class="Name">SEO标题</li>
                                    <li class="input"><input class="common-text input-text"  name="ptitle" value="" size="50"  type="text"></li>
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
                            <div class="cpxqtagContent" id="cpxqtagContent2">
                                <ul>
                                    <li class="Name">简介</li>
                                    <li class="input"><textarea name="info" class="common-textarea textarea"  cols="30" style="width: 50%;" rows="5"></textarea></li>
                                </ul>
                                <ul>
                                    <li class="Name">栏目内容</li>
                                    <li class="input">
                                        <script type="text/plain" id="editor" style="width: 100%;height: 350px;"></script>
                                    </li>
                                </ul>
                            </div>
                            <!--
                            <div class="cpxqtagContent" id="cpxqtagContent3">
                                <ul>
                                    <li class="Name">组图</li>
                                    <li class="input"><input id="upload_gallery" type="file"></li>
                                </ul>
                            </div>
                            -->
                            <div class="cl" style="height: 10px;"></div>
                            <div class="btn">
                                <input class="btn btn-primary btn6 mr10" value="提交" style="margin-right: 10px;" type="submit"><input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
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
		});
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