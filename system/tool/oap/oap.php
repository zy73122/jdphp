<?php
require('oaprestresponse.php');
require('oaprequest.php');

/**
 * OAP Server连接类
 */
class Oap 
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

	// oap instances
	protected static $_instance;

	/**
	 * Singleton pattern
	 *
	 * @return oap
	 */
	public static function instance($inconfig = array())
	{
		if ( ! isset(Oap::$_instance))
		{
			// Load the configuration for this type
			/*$config = array(
				'oapprefix' => "http://192.168.94.21/oap21/",
			);*/		

			// Create a new session instance
			Oap::$_instance = new Oap($inconfig);
		}

		return Oap::$_instance;
	}
	
	/**
	 * 根据URL构造请求连接
	 * @param string $url
	 */
	public function  __construct($config = array()) {
		$url = $config["oapprefix"];
		//$apikey = $config["oap_apikey"];
		
		if($url == null) {
			echo '$url in RestConnection() is empty!';
			exit();
		}
		
		$this->url = $url;
		$this->date = gmdate("Y-m-d H:i:s");
		$this->req = new OapRequest($this->url);
		
	   	//$this->setApikey($apikey);
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
		$response = new OapRestResponse();
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
