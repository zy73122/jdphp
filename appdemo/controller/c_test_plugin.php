<?php
/**
 * 插件
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_plugin
{

	function index()
	{

		try
		{
			$plugins = plugin::get_plugins();
			tpl::assign('plugins', $plugins);
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}

	function install()
	{
		try
		{
			$plugin_id = $_GET['id'];
			plugin::install_plugin($plugin_id);
			tool::message("插件".$plugin_id."安装成功");
		}
		catch (Exception $e)
		{
			tool::message("失败.".$e->getMessage());
		}
	}

	function uninstall()
	{
		try
		{
			$plugin_id = $_GET['id'];
			plugin::uninstall_plugin($plugin_id);
			tool::message("插件".$plugin_id."卸载成功");
		}
		catch (Exception $e)
		{
			tool::message("失败.".$e->getMessage());
		}
	}
	/**
	 * pre钩子方法
	 */
	public function pre()
	{
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
		try
		{
			tpl::display(substr(__CLASS__, 2).'.tpl');
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}


}
?>