<?php
/**
 * 默认控制器
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_index
{
	/**
	 * 首页
	 */
	public function index()
	{
		header("Content-type: text/html; charset=utf-8");
		echo "<h3>程序员单件调试</h3>";
		echo "<ul>";
		echo "<li><a href='".tool::url("?c=test_index&dirtplmain=debug_default&clear=1")."'>DEBUG</a></li>";
		echo "<li><a href='".tool::url("?c=hello&dirtplmain=debug_default&clear=1")."'>Hello World</a></li>";
		echo "</ul>";
	}

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
		//默认首页修改 这里这里
		//header("location:?c=jdjieyinte");
		//header("location:?c=jdshop");
		//header("location:?c=jdlzzj");
		//header("location:?c=jdjcpj");
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
	}


}
?>