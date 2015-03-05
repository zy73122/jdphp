<?php
/**
 * 测试cookie加密解密
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_cookie_encode
{
	function index()
	{
		$data = array(
		'username' => 'username_example',
		'password' => 'password_example',
		);

		//设置Cookie
		cookie::setCookie('auth_name', $data);
		//cookie::setCookie('auth_name', null); 设置Cookie值无效
		//cookie::setCookie('auth_name', $data, time()+3600); //设置Cookie过期时间
		var_dump($_COOKIE[COOKIE_PREFIX.'auth_name']);

		//读取Cookie
		$r = cookie::getCookie('auth_name');
		var_dump($r);
		
		var_dump($_COOKIE);
		
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