<?php

/**
 * URL解析
 *
 */
class url
{

	public static function parse($url, $default_controller, $default_action)
	{
		$virtual = VIRTUAL_DIR . PATH_APP_BASEDIR;
		//$url = $_SERVER['REQUEST_URI'];
			
		/*$uri = $_SERVER['REQUEST_URI'];
			if (strpos($uri, PATH_APP_BASEDIR) === 0) {
				$uri = substr($uri, strlen(PATH_APP_BASEDIR));
			}*/
		//去除virtual_dir
		if (strpos($url, $virtual) !== false)
		{
			$url = substr($url, strlen($virtual));
		}
		//去除末尾的/
		if (substr($url, - 1) == '/')
		{
			$url = substr($url, 0, strlen($url) - 1);
		}
		$result = array();
		if (preg_match("|/?([^/\?]*)/?([^/\?]*)/?([^/\?]*)/?([^/\?]*)/?([^/\?]*)/?(.*)|i", $url, $match))
		{
			$result = array(
				0 => ! empty($match[1]) ? str_replace('.php', '', $match[1]) : $default_controller, //c
				1 => ! empty($match[2]) ? $match[2] : $default_action, //a
				2 => ! empty($match[3]) ? $match[3] : null, //args
				3 => ! empty($match[4]) ? $match[4] : null, //args
				4 => ! empty($match[5]) ? $match[5] : null, //args
				5 => ! empty($match[6]) ? $match[6] : null //args
			);
		}
		
		//$tmp = explode('/', $url);
		//		$result = array();
		//		if (!empty($tmp[1])) {
		//			$result['controller'] = $tmp[1];
		//		}
		//		if (!empty($tmp[2])) {
		//			$result['model'] = $tmp[2];
		//		}
		

		return $result;
	}

	public static function get_virtual_dir()
	{
		$v = self::get_virtual_dir_fisrt();
		if (defined('IN_BACKGROUND'))
		{
			//$v .= ADMIN . '/';
		}
		return $v;
	}

	public static function get_virtual_dir_fisrt()
	{
		//虚拟目录
		$v = str_replace("\\", "/", __FILE__);
		$v = str_replace(str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT']), "", $v);
		$v = str_replace("/system/tool/url.php", "", $v);
		$v = str_replace("system/tool/url.php", "", $v);
		$v = $v ? "/" . $v . "/" : "/";
		$v = str_replace("//", "/", $v);
		/*
		//获取方式2
		$shorturi = self::get_shoturi();
		$tmp = explode('/', $shorturi);
		$v = $tmp[1] . '/';
		if (defined('IN_BACKGROUND'))
		{
			//$v .= ADMIN . '/';
		}
		*/
		return $v;
	}

	public static function get_base_url()
	{
		$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$url = $protocol . $_SERVER['HTTP_HOST'];
		if ($_SERVER['SERVER_PORT'] != 80 && $protocol == 'http://')
		{
			$url .= ':' . $_SERVER['SERVER_PORT'];
		}
		if ($_SERVER['SERVER_PORT'] != 443 && $protocol == 'https://')
		{
			$url .= ':' . $_SERVER['SERVER_PORT'];
		}
		return $url . '/';
	}

	public static function get($urlvar = null)
	{
		if (strpos($urlvar, 'http') === 0)
		{ //mabe: /index/login, index/login
			return $urlvar;
		}
		else
		{
			if (substr($urlvar, 0, 1) == '/')
			{ //
				$urlvar = substr($urlvar, 1, strlen($urlvar) - 1);
			}
			$urlvar = self::get_virtual_dir() . $urlvar;
			return URL_BASE_ROOT . $urlvar;
		}
	}

	public static function go($urlvar)
	{
		echo '<script>';
		echo 'self.location.href="' . self::get($urlvar) . '"';
		echo '</script>';
		//header("Location:".common::url($urlvar)."");
		exit();
	}

	public static function redirect($url)
	{
		@header("location:{$url}");
		exit();
	}

	/**
	 * 获取当前页面地址
	 *
	 * @return string
	 */
	public static function get_current_url()
	{
		$url = self::get_base_url();
		$url .= $_SERVER['REQUEST_URI'];
		return $url;
	}

	/**
	 * 获取当前请求短地址，不包含请求参数
	 * 
	 * @return string
	 */
	public static function get_shoturi()
	{
		$uri = $_SERVER['REQUEST_URI'];
		if (strpos($uri, '?') !== false)
		{
			$tmp = explode('?', $uri);
			$shorturi = $tmp[0];
		}
		else
		{
			$shorturi = $uri;
		}
		return $shorturi;
	}
}
?>