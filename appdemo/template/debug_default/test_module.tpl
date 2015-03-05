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
		<td>模块名</td>
		<td>描述</td>
		<td>作者</td>
		<td>版本</td>
		<td>操作</td>
	</tr>
	{{foreach from=$modules item=module}}
	{{assign var=id value=$module.id}}
	<tr>
		<td>{{$module.name}}</td>
		<td>{{$module.desc}}</td>
		<td>{{$module.author}}</td>
		<td>{{$module.version}}</td>
		<td> {{if $module.install != 'on'}} <a href="{{url avg="?c=test_module&a=install&id=$id"}}">安装</a> {{else}} <a href="{{url avg="?c=test_module&a=uninstall&id=$id"}}">卸载</a> {{/if}}
			{{foreach from=$module.menu item=menu}}
			{{assign var=url value=$menu.url}} <a href="{{url avg="$url"}}">{{$menu.text}}</a> {{/foreach}} </td>
	</tr>
	{{/foreach}}
</table>
</body>
</html>
