<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return checkForm()">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	</p>
	<p>请选择文件类型</p>
	<p>
		<select name="group" id="group">
			<option value="FILE">普通文件</option>
			<option value="MEDIA">媒体</option>
			<option value="FLASH">flash</option>
			<option value="PIC">图片</option>
		</select>
	</p>
	<p>请选择你要上传的文件</p>
	<p>
	<input type="file" name="upfile" id="upfile" />
	</p>
	<p>
		<input type="submit" name="button" id="button" value="提交" />
	</p>
</form>
</body>
</html>