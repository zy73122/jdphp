<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{include file="test_inc_highlighter.tpl"}}
<title>无标题文档</title>
</head>

<body>

<h3>最终效果</h3>
这是模板文件<br />
{{$test_var}}

<h3>PHP源代码</h3>
<pre class="brush: php;">

	function index()
	{
		tpl::assign('test_var', "测试变量");
	}

</pre>

<h3>模板源代码</h3>
<pre class="brush: php;">

	这是模板文件<br />
	{{$test_var} }

</pre>
</body>
</html>
