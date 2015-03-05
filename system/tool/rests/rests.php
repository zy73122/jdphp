<?php
/**
 * REST
 */
/*
$config = array(
	'prefix' => "http://192.168.94.19/uaps/",
	'apikey' => "",
);
rest::instance($config)->get('');
*/

require('restrequest.php');
require('restresponse.php');
class rests
{
	/**
	 * @access private
	 * @var string 请求URL
	 */
	private $url = "";

	/**
	 * @access private
	 * @var object 请求对象
	 */
	private $req = null;

	// instances
	protected static $_instance;

	/**
	 * Singleton pattern
	 *
	 * @return inst
	 */
	public static function instance($inconfig = array())
	{
		if ( ! isset(self::$_instance))
		{
			// Load the configuration for this type
			/*$config = array(
				'prefix' => "http://192.168.94.21/oap21/",
			);*/		

			// Create a new session instance
			self::$_instance = new rest($inconfig);
		}

		return self::$_instance;
	}
	
	/**
	 * 根据URL构造请求连接
	 * @param string $url
	 */
	public function  __construct($config = array()) {
		$url = $config["prefix"];
		//$apikey = $config["oap_apikey"];
		
		if($url == null) {
			exit('$url in RestConnection() is empty!');
		}
		
		$this->url = $url;
		$this->req = new rest_request($this->url);
		
	   	//$this->setApikey($apikey);
	}

	/**
	 * GET方式请求资源
	 * @param string $request_object 请求资源
	 * @return object 返回响应对象
	 */
	public function get($request) {
		$this->req->setRequest($request);
		$this->req->setMethodType("GET");
		return $this->_connect();
	}

	/**
	 * PUT方式请求资源
	 * @param string $request_object 请求资源
	 * @param string $data 请求数据
	 * @return object 返回响应对象
	 */
	public function put($request, $data = '') {
		$this->req->setRequest($request);
		$this->req->setMethodType("PUT");
		if ($data) {
			$this->req->setBody($data);
		}
		return $this->_connect();
	}

	/**
	 * POST方式请求资源
	 * @param string $request_object 请求资源
	 * @param string $data 请求数据
	 * @return object 返回响应对象
	 */
	public function post($request, $data ='') {
		$this->req->setRequest($request);
		$this->req->setMethodType("POST");
		if ($data) {
			$this->req->setBody($data);
		}
		return $this->_connect();
	}

	/**
	 * DELETE方式请求资源
	 * @param string $request_object 请求资源
	 * @return object 返回响应对象
	 */
	public function delete($request) {
		$this->req->setRequest($request);
		$this->req->setMethodType("DELETE");
		return $this->_connect();
	}

	/**
	 * 发送请求返回响应对象
	 * @@access private
	 * @return object 返回响应对象
	 */
	private function _connect() {
		return $this->req->sendRequest();
	}

	/**
	 * 设置sessionid
	 * @param string $sid
	 */
	public function setSid($sid) {
		$this->req->setSid($sid);
	}

	/**
	 * 获取sessionid
	 * @return string
	 */
	public function getSid() {
		return $this->req->getSid();
	}

	/**
	 * 设置apikey
	 * @param string $apikey
	 */
	public function setApikey($apikey) {
		$this->req->setApikey($apikey);
	}

	/**
	 * 获取apikey
	 * @return string
	 */
	public function getApikey() {
		return $this->req->getApikey();
	}
	
	/**
	 * 发送响应
	 * @param int $code HTTP状态码
	 * @param string $content 内容
	 * @param string $json
	 */
	public function sendResponse($code = 200, $content = '', $json=true) 
	{
		ob_start();
		header("HTTP/1.1 $code " . $this->getStatusCodeMessage($code));
		header('Content-type: application/json');

		if ($json)
		{
			echo json_encode($content);
		}
		else
		{
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
	public function getStatusCodeMessage($code) 
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
