<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div id="error" >{{$error}}</div>
<div id="sysinfo" >{{$sysinfo}}</div>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
	<p> <a class="addUpload">[+]</a>
		<input type="file" name="upimage[]" id="upimage" />
	</p>
	<br />
	<input type="submit" name="button" id="button" value="上传" />
</form>
</body>
</html>

<!--添加图片上传框-->
<script type="text/javascript">
$(function(){
	$('.addUpload').click(function(){
		$(this).parent().append('<br><a class="addUpload">[+]</a> <input type="file" name="upimage[]" id="upimage" />');
	});
});
</script>
<!--添加图片上传框 end-->