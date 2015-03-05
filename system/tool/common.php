<?php
/**
 * 通用类
 *
 */
class common
{
	public static function debug($str='')
	{
		if ($_GET['debug']) echo $str.'<hr size=1 />';
	}
		
	/**
	 * 消息显示
	 * 支持json，根据$_GET['ajax']判断
	 * 
	 * @param string | array  $data
	 */
	public static function msg($data)
	{
		$msg = $data;
		if (!empty($_GET['ajax'])) {
			if (is_array($data)) {
				//兼容：
				// array('id'=>'username', 'msg'=>'xiaoxi')
				// array('username'=>'xiaoxi')
				if (!isset($data['msg'])) {
					//$msg = implode(',', $data);
					$keys = array_keys($data);
					$id = $keys[0];
					//只取第一个提示信息
					$msg = array(
						'id' => $id, //定位到HTML元素，在其后面显示提示信息
						'msg' => $data[$id],
					);
				} 
			}
			rest::sendResponse(200, $msg);
		} else {
			if (is_array($data)) {
				//兼容：
				// array('id'=>'username', 'msg'=>'xiaoxi')
				// array('username'=>'xiaoxi')
				if (!isset($data['msg'])) {
					//$msg = implode(',', $data);
					$keys = array_keys($data);
					$id = $keys[0];
					//只取第一个提示信息
					$msg = array(
						'id' => $id, //定位到HTML元素，在其后面显示提示信息
						'msg' => $data[$id],
					);
				} 
			}
			$tpl = s('tpl');
			$tpl->assign('msg', $msg);
			$tpl->display('msg');
		}
	}
		
	/**
	 * 获取客户端IP
	 *
	 * @return unknown
	 */
	public static function get_client_ip()
	{
		return $_SERVER['REMOTE_ADDR'];
	}
	
	/**
	 * 对用户传入的变量进行转义操作。
	 */
	public static function chk_request_data()
	{
		if (!empty($_GET))
		{
			$_GET  = self::addslashes_deep($_GET);
		}
		if (!empty($_POST))
		{
			$_POST = self::addslashes_deep($_POST);
		}
		$_COOKIE   = self::addslashes_deep($_COOKIE);
		$_REQUEST  = self::addslashes_deep($_REQUEST);
	}

	public static function addslashes_deep($value)
	{
		if (empty($value))
		{
			return $value;
		}
		else
		{
			if(is_array($value))
			{
				return array_map(array(__CLASS__, 'addslashes_deep'), $value);
			}
			else
			{
				if (!get_magic_quotes_gpc())
				$value_tmp = addslashes($value);
				else
				$value_tmp = $value;
				return self::clrvar($value_tmp);
			}
		}
	}

	/**
	 * 过滤字符串
	 */
	public static function clrvar($str)
	{
		$strstr = trim($str);
		$strstr = preg_replace('/(insert.*into)|(select.*from)|(update.*set)/isU', '', $strstr);
		//$strstr = str_replace('insert ','',$strstr);
		//$strstr = str_replace('update ','',$strstr);
		//$strstr = str_replace('select ','',$strstr);
		return $strstr;
	}
	
	/**
	 * 由于该框架默认情况下POST、GET数据会进行addslashes处理，该函数用在某些不要addslashes的情况。
	 */
	public static function unaddslashes($value)
	{
		if (empty($value))
		{
			return $value;
		}
		else
		{
			return stripslashes($value);
		}
	}
	public static function unaddslashes_deep($value)
	{
		if (empty($value))
		{
			return $value;
		}
		else
		{
			if(is_array($value))
			{
				return array_map(array(__CLASS__, 'unaddslashes_deep'), $value);
			}
			else
			{
				return stripslashes($value);
			}
		}
	}

}
	
?>