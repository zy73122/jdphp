<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div id="error" >{{$error}}</div>
<div id="sysinfo" >{{$sysinfo}}</div>

<form id="form1" name="form1" method="post" action="">
	<label >验证码：</label>
	<img name="securimage" id="securimage" title="点击刷新" align="absmiddle" style="cursor: pointer; " src="{{url avg='?c=securimage'}}" onclick="this.src='index.php?c=securimage'" /> 
	<input name="authcode" id="authcode" type="text" style="width:65px; margin-right:5px;" />
	<br />
	<input type="submit" name="button" id="button" value="提交" />
</form>
</body>
</html>
