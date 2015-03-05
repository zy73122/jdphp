<?php
/**
 * HTTP REST
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class rest
{
	/**
	 * 发送响应
	 * @param int $code HTTP状态码
	 * @param string $content 内容
	 * @param string $json
	 */
	public static function sendResponse($code = 200, $content = '', $json=true) 
	{
		/* 
		//之前有缓存输出的话，清空 
		if (ob_get_length () > 0)
		{
			ob_end_clean ();
		}*/
		ob_start();
		header("HTTP/1.1 $code " . self::httpcode($code));
		if ($json && !empty($content))
		{
			header('Content-type: application/json');
			if (is_object($content)) {
				$content = (array)$content;
			}
			if (is_array($content)) {
// 				//兼容：
// 				// array('id'=>'username', 'msg'=>'xiaoxi')
// 				// array('username'=>'xiaoxi')
// 				if (!isset($content['msg'])) {
// 					$keys = array_keys($content);
// 					$id = $keys[0];
// 					//只取第一个提示信息
// 					$content = array(
// 						'id' => $id, //定位到HTML元素，在其后面显示提示信息
// 						'msg' => $content[$id],
// 					);
// 				}
				echo json_encode($content);
			} else {
				echo json_encode(array('msg'=>$content));
			}
		}
		else
		{
			header('Content-type: text/html');
			echo $content;
		}

		header('Content-Length: ' . ob_get_length());
		ob_end_flush();
		exit();
	}
	
	/**
	 * 获取状态码对应内容
	 * @param int $code HTTP状态码
	 * @return string 状态码对应内容
	 */
	public static function httpcode($code) 
	{
		$descs = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			423 => 'Locked',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);

		return (isset($descs[$code])) ? $descs[$code] : '';
	}
	
	
}
