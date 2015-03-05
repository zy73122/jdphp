<?php
/*
* [UAP Server] (C)1999-2009 ND Inc.
* UAP Soap ND Soap类
* @TODO：
* $Id: soap.class.php 111701 2010-07-14 06:13:52Z zhangrr $
*/

class NDSoapClient {

	function __construct() {
		global $CONFIG;
		$CheckCode = time().rand();
		$this->config = & $CONFIG;

		$this->_header = array(
					'UserName' => $this->config['passport']['interface']['user'],
					'Password' =>md5($this->config['passport']['interface']['pass'].$CheckCode),
					'CheckCode'  =>$CheckCode
					);

		$this->_urls = parse_url($this->config['passport']['interface']['wsdl']);
		$this->_host = $this->_urls['host'];
		$this->_path = $this->_urls['path'];
	}

	//手机业务--注册与绑定
	function Register4Mobile($params) {
		$result = $this->_do($this->_host,$this->_path,'Register4Mobile',$params,$this->_header,80);
		return (object)$result;
	}

	//手机业务--更新业务绑定手机号
	function UpdateMobile4MapInfo($params) {
		$result = $this->_do($this->_host,$this->_path,'UpdateMobile4MapInfo',$params,$this->_header,80);
		return (object)$result;
	}

	//手机门业务--登录
	function Login4Mobile($params) {
		$result = $this->_do($this->_host,$this->_path,'Login4Mobile',$params,$this->_header,80);
		return (object)$result;
	}

	//手机业务--用户信息获取
	function GetUserMapInfo($params) {
		$result = $this->_do($this->_host,$this->_path,'GetUserMapInfo',$params,$this->_header,80);
		return (object)$result;
	}

	//手机业务--重置密码
	function ResetPasswordByMobile($params) {
		$result = $this->_do($this->_host,$this->_path,'ResetPasswordByMobile',$params,$this->_header,80);
		return (object)$result;
	}

	function RegisterUserInfo_Common($params) {
		$result = $this->_do($this->_host,$this->_path,'RegisterUserInfo_Common',$params,$this->_header,80);
		return (object)$result;
	}

	//普通登录
	function CheckUserLogin_Common($params) {
		$result = $this->_do($this->_host,$this->_path,'CheckUserLogin_Common',$params,$this->_header,80);
		return (object)$result;
	}

	//Cookie登录
	function CheckUserLogin_ByCookie($params) {
		$result = $this->_do($this->_host,$this->_path,'CheckUserLoginByCookie',$params,$this->_header,80);
		return (object)$result;
	}

	function GetUserInfo_ForOtherSys_Sync_ByUserName($params) {
		$result = $this->_do($this->_host,$this->_path,'GetUserInfo_ForOtherSys_Sync_ByUserName',$params,$this->_header,80);
		return (object)$result;
	}

	function GetUserInfo_ForOtherSys_ByUserId($params) {
		$result = $this->_do($this->_host,$this->_path,'GetUserInfo_ForOtherSys_ByUserId',$params,$this->_header,80);
		return (object)$result;
	}

	//生成单点登录 Cookie
	function CheckUserLoginForUAPAuto($params) {
		$result = $this->_do($this->_host,$this->_path,'CheckUserLoginForUAPAuto',$params,$this->_header,80, true);
		return $result;
	}

	function GetUserMapInfo4Channel($params) {
		$result = $this->_do($this->_host,$this->_path,'GetUserMapInfo4Channel',$params,$this->_header,80);
		return (object)$result;
	}

	function Register4Channel($params) {
		$result = $this->_do($this->_host,$this->_path,'Register4Channel',$params,$this->_header,80);
		return (object)$result;
	}

	function _do($interface,$uri,$op,$args, $args2,$part=80,$extra=false) {

		$content = '';

		$fp = fsockopen($interface, $part, $errno, $errstr);
		if (!$fp){
			return false;
		}else
		{
			$content .= '<?xml version="1.0" encoding="utf-8"?>';
			$content .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
			$content .= '<soap:Header>';
			$content .='<UserNameToken xmlns="http://tempuri.org/">';
			if(is_array($args2))
			{
				foreach ( $args2 as $key2=>$value2)
					$content .= '<' . $key2 . '>' . $value2 . '</' . $key2 . '>';
			}
			$content .= '</UserNameToken>';
			$content .= '</soap:Header>';
			$content .= '<soap:Body>';
			$content .= '<' . $op . ' xmlns="http://tempuri.org/">';
			if ( is_array($args))
			{
				foreach ( $args as $key=>$value)
					$content .= '<' . $key . '>' . $value . '</' . $key . '>';
			}
			$content .= '</' . $op . '>';
			$content .= '</soap:Body>';
			$content .= '</soap:Envelope>';

			//die;
			$out = "POST /".$uri." HTTP/1.1\r\n";
			$out .= "Host: " .$interface . "\r\n";
			$out .= "Content-Type: text/xml; charset=utf-8\r\n";
			$out .= "Content-Length: " . strlen($content) . "\r\n";
			$out .= "Connection: Close \r\n";
			$out .= "SOAPAction: \"http://tempuri.org/" . $op . "\"\r\n\r\n";

			fwrite($fp, $out . $content);
			$ret = '';
			while (!feof($fp))
			{
				$ret .= fgets($fp, 128);
			}
			//$ret = fread($fp, 10240);
			fclose($fp);

			if ( preg_match('/<soap:Body>(.+)<\/soap:Body>/', $ret, $mc) )
				preg_match_all('/<([^>\/]+)>([^<]+)<\/([^>\/]+)>/', $mc[1], $tmp);

			if ( count($tmp) != 4 )
				return false;
			else {
				if ($extra)
					return $tmp;
				else
					return array_combine($tmp[1], $tmp[2]);
			}
		}

	}
}
?>