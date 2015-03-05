<?php
/**
 * 多文件上传 swfupload
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
 
class c_test_multiupload
{
	function index()
	{			
	}
	function dopost()
	{			
	var_dump($_POST);
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