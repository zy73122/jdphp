<?php
/**
 * 测试页首页
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
		
class c_test_index
{

	function index()
	{
	}
	

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
		//系统设置变量
		$sysconfig = s("m_config")->get_configs();
		tpl::assign('sysconfig', $sysconfig);
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
		try
		{
			tpl::display(substr(__CLASS__, 2).'.tpl'); //index.tpl
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}


}
?>