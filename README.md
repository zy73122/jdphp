# jdphp框架 v1.0.9 core

## 简介 
基于MVC架构，精简的内核，辅助以模块化的工具组件，让你的开发更简单、灵活。

## 快速安装  
* 下载项目文件，放在web服务器的目录下面  
```shell
git clone https://github.com/zy73122/jdphp.git  
mv jdphp /data/wwwroot/jdphp  
```

* 你可能需要手工创建下面两个文件夹  
```shell
mkdir 700 app/data/logs  
mkdir 700 app/data/template_compiled  
```

* 导入MySQL数据库  
 * 创建数据库  
```shell
> create database jdphp109 charset=utf8  
mysql -uxx -pxx jdphp109 < jdphp108.sql  
```

* 使用浏览器浏览，打开 http://localhost/appdemo/ 查看效果   

## 快速创建一个你自己的应用
* 新建控制器文件c_hello.php，路径为appdemo\controller\c_hello.php
```php
<?php
/**
 * 测试控制器
 *
 * @copyright JDphp框架
 * @version 1.0.7
 * @author yy
 */
class c_hello
{
	/**
	 * 默认动作
	 */
	public function index()
	{
		echo "<h1>hello world.</h1>";
		echo "<ul>";
		echo "<li>该页面由c_hello::index()所调用.</li>";
		echo "<li>控制器类c_index的文件位置：appdemo\controller\c_hello.php</li>";
		echo "</ul>";
	}
?>
```

* 查看效果 http://localhost/appdemo/?c=hello&a=index
* 更多例子，请查看appdemo

# 目录结构    
    ├─appdemo              应用名称（示例）  
    │  ├─config            应用的配置目录  
    │  ├─controller        控制器  
    │  ├─model             模型  
    │  ├─data  
    │  │  ├─arrayfile      文件配置  
    │  │  ├─cache          文件缓存  
    │  │  ├─logs           日志
    │  │  ├─session        会话  
    │  │  └─template_compiled    编译后的模板文件  
    │  ├─language          语言  
    │  │  ├─enUS  
    │  │  ├─zhCN  
    │  │  └─zhTW  
    │  └─template          模板  
    ├─config               配置目录  
    ├─static               静态文件  
    │  ├─css  
    │  ├─images  
    │  └─js  
    └─system               框架核心目录  
        ├─external         扩展组件  
        │  ├─model         扩展组件模型  
        │  ├─module        模块  
        │  ├─plugin        插件  
        │  └─widget        挂件  
        ├─include          系统包含文件  
        ├─model            模型  
        └─tool             工具目录  

        
# 联系方式  
Author：zhangyu  
E-mail：396772873@qq.com  
