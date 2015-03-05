<?php
/**
 * 测试文件操作
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */

class c_test_file
{
	function index()
	{
		$cfile = s("cfile");
		// 递归方式生成目录结构
		//$cfile->mkdir_recursive('xxx/xx/x', 0700);
		
		// 列出目录下面的文件
		$files = cfile::ls('./', 'file');
		tool::print_r($files);
		$files = $cfile->ls('./', 'dir');
		tool::print_r($files);
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