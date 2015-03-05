<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="{{$url}}static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{$url}}static/js/jquery.cookie.js"></script>
<script type="text/javascript">
//set cookie
$.cookie('the_cookie1', 'the_value1');
$.cookie('the_cookie2', 'the_value2', { expires: 1 /*day*/, path: '/', domain: '{{$domain}}', secure:false });

//read cookie
alert($.cookie('the_cookie1'));
alert($.cookie('the_cookie2'));

//clear cookie
$.cookie('the_cookie1', null);
$.cookie('the_cookie2', null);
</script>
</head>

<body>
</body>
</html>
