<?php
/**
 * 模块
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_module
{

	function index()
	{
		try
		{
			$modules = module::get_modules();
			tpl::assign('modules', $modules);
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
			$module_id = $_GET['id'];
			module::install_module($module_id);
			tool::message("模块".$module_id."安装成功");
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
			$module_id = $_GET['id'];
			module::uninstall_module($module_id);
			tool::message("模块".$module_id."卸载成功");
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