<?php
/**
 * 测试gzip
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

/**
 * 输出gzip文件
 *
 * @param string $filename
 * @param string $dump_buffer
 * @param int $partsize
 */

class c_test_download
{
	function index()
	{
		/*
		//文件内容
		$dump_buffer = "文件内容aaaaaaaa";
		//文件名字
		$filename = "test";
		
		//存为sql
		tool::download($filename, $dump_buffer, 'sql');
		
		//存为gzip
		tool::download($filename, $dump_buffer, 'sql', 'gzip');
		*/
		
		$filename = "test";
		$data = file_get_contents("static/images/watermark.png");
		//存为jpg		
		tool::download($filename, $data, 'jpg');
		
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
	}


}
?>