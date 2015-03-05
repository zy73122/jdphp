<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="keywords" content="{{$keywords}}" />
<meta name="description" content="{{$description}}" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<table width="800" border="1">
  <tr>
	<td>插件名</td>
	<td>描述</td>
	<td>作者</td>
	<td>版本</td>
	<td>操作</td>
  </tr>
  {{foreach from=$plugins item=plugin}}
  {{assign var=id value=$plugin.id}}
  <tr>
	<td>{{$plugin.name}}</td>
	<td>{{$plugin.desc}}</td>
	<td>{{$plugin.author}}</td>
	<td>{{$plugin.version}}</td>
	<td>
		{{if $plugin.install != 'on'}}
		<a href="{{url avg="?c=test_plugin&a=install&id=$id"}}">安装</a> 
		{{else}}
		<a href="{{url avg="?c=test_plugin&a=uninstall&id=$id"}}">卸载</a> 
		{{/if}}
		</td>
  </tr>
  {{/foreach}}
</table>
</body>
</html>
