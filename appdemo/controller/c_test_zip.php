<?php
/**
 * 测试zip
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
include_once(PATH_TOOL . "zip.php");
class c_test_zip
{

	function index()
	{
		if ($_FILES["upfile"])
		{
			$r = tool::unzip(PATH_ROOT.'testzip', $_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]);
			if ($r == -1)
			{
				exit("该文件不是zip文件");
			} else if ($r == 0)
			{
				exit("失败");
			}
			 else if ($r == 1) 
			{
				exit("成功");
			}
			else
			{
				exit("意外的错误！");
			}
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