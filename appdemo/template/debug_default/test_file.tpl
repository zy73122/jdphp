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

<h3>PHP源代码</h3>
<pre class="brush: php;">

	function index()
	{
		$cfile = s("cfile");
		// 递归方式生成目录结构
		//$cfile->mkdir_recursive('xxx/xx/x', 0700);

		// 列出目录下面的文件
		$files = cfile::ls('./', 'file');
		tool::print_r($files);
		$files = $cfile->ls('./', 'dir');
		tool::print_r($files);
	}

</pre>

</body>
</html>
