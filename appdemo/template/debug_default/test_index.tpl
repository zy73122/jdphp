<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>

<pre>模块测试</pre>
<p><a href="{{url avg='?c=test_tpl'}}" >模板</a>
  <a href="{{url avg='?c=test_file'}}" >目录读取</a>
  <a href="{{url avg='?c=test_upload'}}" >文件上传</a>
  <a href="{{url avg='?c=test_download'}}" >下载</a>
  <a href="{{url avg='?c=test_image'}}" >图像处理</a>
  <a href="{{url avg='?c=test_authcode'}}" >验证码</a>
  <a href="{{url avg='?c=test_cookie_encode'}}" >Cookie设置(加密解密)</a>  
</p>
<p><a href="{{url avg='?c=test_db'}}" >数据库</a>
  <a href="{{url avg='?c=test_db_gate'}}" >数据库接口</a>
  <a href="{{url avg='?c=test_lang'}}" >语言</a>
  <a href="{{url avg='?c=test_plugin'}}" >插件</a>
  <a href="{{url avg='?c=test_module'}}" >模块</a>
  <a href="{{url avg='?c=test_mail'}}" >邮件</a>
  <a href="{{url avg='?c=edittpl&a=edit_cms_index&editmode=1&dirtplmain=article_ecms'}}" >模板编辑</a>
  <a href="{{url avg='?c=test_gzip_output'}}" >GZIP压缩输出</a>
  <a href="{{url avg='?c=test_zip'}}" >ZIP压缩包上传/解压</a>
</p>

<!--统计代码--> 
{{$sysconfig.cf_ipstat}} 
<!--统计代码 end--> 

</body>
</html>
