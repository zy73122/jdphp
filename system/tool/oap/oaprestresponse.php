<?php
/*
 * [OAP Server SDK]
 * OAP Server SDK REST响应类
 * $Id: RestResponse.class.php 42506 2011-06-28 15:51:30Z chenbl $
*/

/**
 * REST响应类
 */
class OapRestResponse {

	/**
	 * @access private
	 * @var int 响应码
	 */
	private $responseCode = "";

	/**
	 * @access private
	 * @var string 响应内容
	 */
	private $responseBody = "";

	public function  __construct() {
	}

	/**
	 * 设置响应内容
	 * @param string $msg
	 */
	public function setResponseBody($msg) {
		$this->responseBody = $msg;
	}

	/**
	 * 获取响应内容
	 * @return string
	 */
	public function getResponseBody() {
		return $this->responseBody;
	}

	/**
	 * 设置响应码
	 * @param int $code
	 */
	public function setResponseCode($code) {
		$this->responseCode = $code;
	}

	/**
	 * 获取请求码
	 * @return int
	 */
	public function getResponseCode() {
		return $this->responseCode;
	}
}
