<?php
/**
 * Cookie加密解密
 * 支持到二维数组
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

/**
 * 
 * 		使用示例：
		require_once(PATH_ROOT . "cookie.php");
		$data = array(
		'username' => 'username_example',
		'password' => 'password_example',
		);

		//设置Cookie
		cookie::setCookie('auth_name', $data);
		//cookie::setCookie('auth_name', null); //设置Cookie值无效
		//cookie::setCookie('auth_name', $data, time()+3600); //设置Cookie过期时间
		var_dump($_COOKIE['auth_name']);

		//读取Cookie
		$r = cookie::getCookie('auth_name');
		var_dump($r);
 */

class cookie
{
	//public static $split = '#@232SA';
	public static $split = '|#|';

	/**
	 * cookie 加密
	 *
	 * @param string $cookie_name
	 * @param array $arr_data
	 * @param time() $expire
	 */
	public static function setCookie($cookie_name, $arr_data, $expire=null, $path=PATH_COOKIE, $domain=COOKIE_DOMAIN, $secure=false )
	{   
		self::checkCookie();
		if (empty($arr_data))
		{
			$cookie_value = null;
			$cookie_expire = time() - 3600;
		}
		else
		{
			$auth_key = md5("key".microtime());
			foreach ($arr_data as $k=>$one)
			{
				if (is_array($one))
				{
					$arr_data[$k] = "|##|" .serialize($one);
				}
			}
			
			$data = implode(self::$split, $arr_data);
			//加密
			$cookie_value = s('encrypt')->encode($data);
			if ($expire)
			{
				$cookie_expire = $expire;
			}
			else
			{
				$cookie_expire = time() + 3600;
			}
		}
		//设置Cookie
		$_COOKIE[COOKIE_PREFIX . $cookie_name] = $cookie_value; //可以让Cookie马上生效而不需要刷新页面
		setcookie(COOKIE_PREFIX . $cookie_name, $cookie_value, $cookie_expire, $path, $domain, $secure);
		//setrawcookie($key, $value, $expire, '/', '.91.com');
	}

	/**
	 * cookie 解密
	 * 未设置的cookie的话返回null
	 *
	 * @param string $cookie_name
	 * @return array 
	 */
	public static function getCookie($cookie_name)
	{
		if (!isset($_COOKIE[COOKIE_PREFIX . $cookie_name]))
			return null;
		//解密
		$data = s('encrypt')->decode($_COOKIE[COOKIE_PREFIX . $cookie_name]);
		$arr = explode(self::$split, $data);
		foreach ($arr as $k=>$one)
		{
			if (strpos($one, "|##|")!==false)
			{
				$a = unserialize(substr($one, 4));
				$arr[$k] = $a;
			}
		}
		return $arr;
	}

	public static function checkCookie()
	{
		/*
		setcookie("CookieCheck", "OK" , time()+60);
		if (!isset($_COOKIE["CookieCheck"]))
		{
			header("Content-type: text/html; charset=utf-8");
			exit("您浏览器的 cookie 功能被禁用，请启用此功能。");				
		}
		setcookie("CookieCheck", null, time()-3600);
		*/
	}
}
?>