<?php
/**
 * 基类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class base
{
	public $rest;
	public function __construct()
	{
		$this->rest = s('rests', glb::$config['sdkurl']);
	}
	
	public function dorest($return, &$code = null, &$msg = null, &$data = null)
	{
		if (!$return || !is_object($return)) {
			return false;
		}
		$code = $return->getResponseCode();
		$body = $return->getResponseBody();
		if ($code != 200) {
			return false;
		}
		$code = $body['code'];
		$data = $body['data'];
		$msg = $body['msg'];
		if ($body['code'] != 2000 && $body['code'] != 2001) {
			return false;
		}
		return true;
	}
}

?>