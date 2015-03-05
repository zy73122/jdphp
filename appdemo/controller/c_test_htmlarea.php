<?php
/**
 * 测试 htmlarea
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_htmlarea
{
	function index()
	{
	}
	
	function doPost()
	{
		$post_cont = $_POST['ta'];
		
		echo("下面是你提交的值：<br>" . $post_cont);
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
			tpl::display('test_editor_htmlarea.tpl');
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}


}
?>