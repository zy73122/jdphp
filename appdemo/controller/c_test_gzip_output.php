<?php
/**
 * 测试 GZIP压缩输出
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
		
class c_test_gzip_output
{
	//注意：如果已经在后台开启了“gzip压缩输出”，可能导致两次压缩，而出现错误。 可以先关闭后台"gzip压缩输出"

	function index()
	{
		try
		{
			//准备一些待压缩的内容
			for($i=0; $i<10; $i++)
			{
				echo('页面内容');
			}
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}
	

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
		//启用一个带有ob_gzip压缩机的工作台
		ob_start(array(tool, 'ob_gzip'));
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
		//输出压缩成果
		ob_end_flush();
	}


}


?>