<?php
/**
 * 加密解密 可逆 加密后的串不变
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class en_easy
{
	public static $key1 = 5; //算法1key
	public static function encode($txt)
	{
		$newtxt = '';
		for($i=0;$i<strlen($txt);$i++)
		{
			$newtxt .= chr(ord(substr($txt, $i, 1))+self::$key1);
		}
		return urlencode(base64_encode(urlencode($newtxt)));
	}

	public static function decode($txt)
	{
		$newtxt = '';
		$txt=urldecode(base64_decode(urldecode($txt)));
		for($i=0;$i<strlen($txt);$i++)
		{
			$newtxt .= chr(ord(substr($txt, $i, 1))-self::$key1);
		}
		return $newtxt;
	}
}
?>