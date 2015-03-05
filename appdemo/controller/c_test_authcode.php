<?php
/**
 * 测试验证码
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */

class c_test_authcode
{
	function index()
	{
		try
		{
			if (isset($_POST['authcode']))
			{
				if (!$_POST['authcode'])
				{
					throw new Exception("请输入验证码");
				}
				else
				{
					$secimg = s('securimage');
					if (!$secimg->check($_POST['authcode']))
					{
						throw new Exception("验证码不正确");
					}
				}
				tpl::assign('sysinfo', '验证通过');
			}
		}
		catch (Exception $e)
		{
			tpl::assign('error', $e->getMessage());
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