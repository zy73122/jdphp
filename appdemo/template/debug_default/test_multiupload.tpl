<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<style type="text/css">
body,td,th {
	font-size: 12px;
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="{{$url_tpl}}js/main.js"></script>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>

<!--jquery-ui-->
<link href="{{$url}}static/jquery-ui-1.11.0/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$url}}static/jquery-ui-1.11.0/jquery-ui.min.js"></script>
<!--jquery-ui end-->

<!--jquery-fancyBox-->
<script type="text/javascript" src="{{$url}}static/other/jquery_fancybox/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="{{$url}}static/other/jquery_fancybox/fancybox/jquery.fancybox-1.3.1.mine.css" media="screen" />
<link rel="stylesheet" type="text/css" href="{{$url}}static/other/jquery_fancybox/style.css" media="screen" />
<!--jquery-fancyBox end-->

<script type="text/javascript">
$(function(){
	// Dialog
	$('#dialog1').dialog({
		autoOpen: false,
		modal: true,
		width: 500,
		height: 400,
		title: '图片上传',
		buttons: {
			"确定": function() { 
				$(this).dialog("close"); 
			}, 
			"取消": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	// Dialog Link
	$('#dialog_link1').click(function(){
		$('#dialog1').dialog('open');
		return false;
	});

	$('#dialog_link2').click(function(){
		popUpWindow('{{$url}}static/swfupload/mine/index_style2.php', 200, 50, 400, 400 );
		return false;
	});

	//fancyBox方式打开
	$("#various3").fancybox({
		'width'				: '50%',
		'height'			: '50%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
});

</script>
<title>无标题文档</title>
</head>

<body>
<a href="static/swfupload/" >swfupload原例</a>
<input type="button" id="dialog_link1" value="ui.dialog" />
<input type="button" id="dialog_link2" value="window.open" />
<a id="various3" href="static/swfupload/mine/index_style3.php">fancyBox(iframe)方式</a>
<div id="dialog1">
<iframe src="{{$url}}static/swfupload/mine/index.php" width="480" height="280" frameborder="0" scrolling="yes" ></iframe>
</div>
<form id="form1" action="?c=test_multiupload&a=dopost" method="post" enctype="multipart/form-data">
<span id="uploadResult"></span>
<input type="submit" name="button" id="button" value="提交" />
</form>


</body>
</html>
