<?php
require('uaprestresponse.php');
require('uaprequest.php');

/**
 * UAP Server连接类
 */
class uap 
{

/**
 * @access private
 * @var string 请求URL
 */
	private $url = "";

	/**
	 * @access private
	 * @var int 响应码
	 */
	private $response = "";

	/**
	 * @access private
	 * @var string 响应内容
	 */
	private $responseBody = "";

	/**
	 * @access private
	 * @var object 请求对象
	 */
	private $req = null;

	/**
	 * @access private
	 * @var date 请求时间
	 */
	private $date = "";

	// uap instances
	protected static $_instance;

	/**
	 * Singleton pattern
	 *
	 * @return uap
	 */
	public static function instance($inconfig = array())
	{
		if ( ! isset(Uap::$_instance))
		{
			// Load the configuration for this type
			/*$config = array(
				'uapprefix'=>"http://192.168.94.19/uaps33/",
				'uap_apikey'=>"Cc907E88a37cdDaA013cC761129654AEcddAa013",
			);*/			

			// Create a new session instance
			Uap::$_instance = new Uap($inconfig);
		}

		return Uap::$_instance;
	}
	
	/**
	 * 根据URL构造请求连接
	 * @param string $url
	 */
	public function  __construct($config = array()) {
		$url = isset($config["uapprefix"]) ? $config["uapprefix"] : null;
		//$apikey = isset($config["uap_apikey"]) ? $config["uap_apikey"] : null;
		
		if($url == null) {
			echo '$url in RestConnection() is empty!';
			exit();
		}
		
		$this->url = $url;
		$this->date = gmdate("Y-m-d H:i:s");
		$this->req = new UapRequest($this->url);
		
//		if ($apikey) {
//	   	$this->setApikey($apikey);
//		}
	}

	/**
	 * 获取当前时间
	 * @return date
	 */
	public function getDate() {
		return $this->date;
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
		$this->response = $this->req->sendRequest();
		$response = new UapRestResponse();
		if (!is_object($this->response)) {
			$response->setResponseCode(503);
			$response->setResponseBody(array('msg' => '服务器没有响应'));
		} else {
			$this->responseBody = $this->response->getResponseBody();
		}
		$response->setResponseCode($this->response->getResponseCode());
		$response->setResponseBody(json_decode($this->response->getResponseBody(), true));

		return $response;
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
}
