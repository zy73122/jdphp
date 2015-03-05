<?php
/**
 * HTTP请求
 */
class rest_request {

	/**
	 * @access private
	 * @var string URL
	 */
	private $_url = '';
	/**
	 * @access private
	 * @var object 响应对象
	 */
	private $_response;

	/**
	 * @access private
	 * @var string 请求方法
	 */
	private $_method = 'GET';

	/**
	 * @access private
	 * @var string 请求内容
	 */
	private $_body = '';

	/**
	 * @access private
	 * @var string 请求Cookie
	 */
	private $_cookie = '';

	/**
	 * @access private
	 * @var string 请求资源
	 */
	private $_object = '';
	
	/**
	 * @access private
	 * @var string 请求字符串
	 */
	private $_query = '';

	/**
	 * @access private
	 * @var string session_id
	 */
	private $_sid = '';

	/**
	 * @access private
	 * @var string
	 */
	private $_apikey = '';
	
	/**
	 * 根据URL初始化对象
	 * @param string $url URL
	 */
	public function __construct($url) {
		$this->_url = $url;
	}

	/**
	 * 设置URL
	 * @param string $url URL
	 */
	public function setURL($url) {
		$this->_url = $url;
	}

	/**
	 * 设置请求方法
	 * @param string $method 方法
	 */
	public function setMethodType($method) {
		$this->_method = $method;
	}

	/**
	 * 设置内容
	 * @param string $data 内容
	 */
	public function setBody($data) {
		$this->_body = $data;
	}

	/**
	 * 设置Cookie
	 * @param string $cookie Cookie
	 */
	public function setCookieContent($cookie) {
		$this->_cookie = $cookie;
	}

	/**
	 * 设置请求资源
	 * @param string $request_object 请求资源
	 */
	public function setRequest($request) {
		$request_array = explode("?", $request);
		$request_object = isset ($request_array[0]) ? $request_array[0] : '';
		$query_string = isset ($request_array[1]) ? $request_array[1] : '';
		if(strrpos($request_object, '/') == (strlen($request_object)-1)) {
			$request_object = substr($request_object, 0, strlen($request_object)-1);
		}
		if(strpos($request_object, '/') === 0) {
			$request_object = substr($request_object, 1, strlen($request_object));
		}
		$this->_object = $request_object;
		$this->_query = $query_string;
	}

	/**
	 * 设置session_id
	 * @param string $sid session_id
	 */
	public function setSid($sid) {
		if($sid) {
			//$this->setCookieContent('sid='.$sid);
			$this->setCookieContent('PHPSESSID='.$sid.';');
		} else {
			$this->setCookieContent('');
		}
		$this->_sid = $sid;
	}

	/**
	 * 设置apikey
	 * @param string $apikey
	 */
	public function setApikey($apikey) {
		$this->_apikey = $apikey;
	}

	/**
	 * 获取URL
	 * @return string
	 */
	public function getURL() {
		return $this->_url;
	}

	/**
	 * 获取请求方法
	 * @return string
	 */
	public function getMethodType() {
		return $this->_method;
	}

	/**
	 * 获取请求内容
	 * @return string
	 */
	public function getBody() {
		return $this->_body;
	}

	/**
	 * 获取Cookie
	 * @return string
	 */
	public function getCookieContent() {
		return $this->_cookie;
	}

	/**
	 * 获取请求资源
	 * @return string
	 */
	public function getRequestObject() {
		return $this->_object;
	}

	/**
	 * 获取查询字符串
	 * @return string
	 */
	public function getQueryString() {
		return $this->_query;
	}

	/**
	 * 获取session_id
	 * @param string $sid session_id
	 */
	public function getSid() {
		return $this->_sid;
	}

	/**
	 * 获取apikey
	 * @param string $apikey
	 */
	public function getApikey() {
		return $this->_apikey;
	}

	/**
	 * 发送请求，返回响应对象
	 * @return object
	 */
	public function sendRequest() {

		$result = $this->_uc_fopen();
		$this->_response = new rest_response();
		if (empty($result))
		{
			$this->_response->setResponseCode('500');
			$this->_response->setResponseBody('internal error');
		}
		else
		{
			preg_match('|HTTP/1\.1\s+(\d+)|', $result['header'], $m);
			$this->_response->setResponseCode($m[1]);
			$this->_response->setResponseBody(json_decode($result['data'], true));
		}
		
		return ($this->_response);
	}

	/**
	 * 发送请求给服务器，返回响应头和内容的数组（内部函数，参数使用默认值）
	 * @access private
	 * @param int $limit 数据大小限制
	 * @param string $ip 服务器IP
	 * @param int $timeout 超时设置
	 * @param bool $block 是否阻塞模式
	 * @return array
	 */
	private function _uc_fopen($limit = 0, $ip = '', $timeout = 15, $block = TRUE) {
		$type = $this->getMethodType();
		$hd = '';
		//$post = json_encode($this->getBody(), JSON_FORCE_OBJECT);
		$post = json_encode($this->getBody());
		$return = '';
		$matches = parse_url($this->getURL());
		!isset($matches['host']) && $matches['host'] = '';
		!isset($matches['port']) && $matches['port'] = '';
		!isset($matches['path']) && $matches['path'] = '';
		$matches['path'] .= $this->getRequestObject();
		$matches['query'] = '';

		$cookie = $this->getCookieContent();
			
		if($this->getSid() && !$this->getApikey()) {
		   $matches['query'] = 'sid='.$this->getSid();
		} else {
			$matches['query'] =  'apikey='.$this->getApikey();
		}
		if ($this->getQueryString()) {
			$matches['query'] .= '&'.$this->getQueryString();
		}
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;

		if($type == 'POST' || $type == 'PUT') {
			$out = "$type $path HTTP/1.0\r\n";
			$out .= "Accept: application/json\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= 'Content-Length: '.strlen($post)."\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cache-Control: no-cache\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
			$out .= $post;
		} else {
			$out = "$type $path HTTP/1.0\r\n";
			$out .= "Accept: application/json\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
		}
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		if(!$fp) {
			return '';//note $errstr : $errno \r\n
		} else {
			stream_set_blocking($fp, $block);
			stream_set_timeout($fp, $timeout);
			@fwrite($fp, $out);
			$status = stream_get_meta_data($fp);
			if(!$status['timed_out']) {
				while (!feof($fp)) {
					if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
						break;
					}
					$hd .= $header;
				}
				$stop = false;
				while(!feof($fp) && !$stop) {
					$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
					$return .= $data;
					if($limit) {
						$limit -= strlen($data);
						$stop = $limit <= 0;
					}
				}
			}
			@fclose($fp);

			return array('header'=>$hd, 'data'=>$return);
		}
	}
}