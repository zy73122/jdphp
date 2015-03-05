<?php
/**
 * 默认控制器
 *
 * @copyright JDphp框架
 * @version 1.0.6
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_db_gate
{
	/**
	 * 默认动作
	 */
	public function index()
	{
		$m_sample_dbgate = s("m_sample_dbgate");
		$m_sample_dbgate->echoData();
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