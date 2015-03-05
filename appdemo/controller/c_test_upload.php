<?php
/**
 * 测试 上传
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_upload
{

	function index()
	{
		if ($_FILES["upfile"])
		{
			$group = $_POST['group'] ? $_POST['group'] : 'FILE';
			
			//重命名
			//upload::start($_FILES["upfile"], PATH_ROOT.'testupload/aa.html', $group);
			
			//默认名字
			upload::start($_FILES["upfile"], PATH_DATA.'upload/'.$_FILES["upfile"]["name"], $group);
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