<?php
/**
 * 模板测试
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */

class c_test_tpl
{
	function index()
	{
		tpl::assign('test_var', "测试变量");
	}
	
	/**
	 * pre钩子方法
	 */
	public function pre()
	{
		tpl::assign('keywords', "关键字,...");
		tpl::assign('description', "说明,...");
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