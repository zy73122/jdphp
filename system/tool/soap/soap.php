<?php
require_once('soap.class.php');
require_once('common.php');
require_once('MD5Crypt.class.php');
class soap extends NDSoapClient {	

	//91接口测试 “预分配91账号ID”方式注册

	/**
	 * 91获取预注册编号
	 */
	public static function GetUserIdPre(& $errmsg = '')
	{
		$config = glb::$config;
		$params['Action'] = 'GetUserIdPre';
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['CheckCode'] = md5($params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['regpre_sdk_url'];
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if (empty($resultdata->UserId)) {
			$errmsg = $resultdata->Code.$resultdata->Message;
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		return $resultdata->UserId;
	}
	
	/**
	 * 91使用预注册编号注册帐号
	 */
	public static function RegUserWithUserIdPre($preuserid, $userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (empty($preuserid)) {
			$errmsg = '预申请到的用户编号不能为空';
			return false;
		}
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '账号名称为空';
			return false;
		}
		if (empty($userinfo['password'])) {
			$errmsg = '密码为空';
			return false;
		}
		$params['Action'] = 'RegUserWithUserIdPre';
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['UserId'] = intval($preuserid);
		$params['Password'] = MD5Crypt::encrypt($userinfo['password']);
		$params['NickName'] = strval($userinfo['nickname']);
		$params['RealName'] = strval($userinfo['realname']);
		$params['IdCard'] = strval($userinfo['idcard']);
		$params['Mobile'] = strval($userinfo['mobile']);
		$params['Tel'] = strval($userinfo['tel']);
		$params['IpAddress'] = strval(common::get_client_ip());
		$params['Sex'] = intval($userinfo['sex']);
		$params['Birthday'] = strval($userinfo['birthday']);
		$params['RegPlat'] = empty($userinfo['regplat']) ? 0 : 1;
		$params['NType'] = empty($userinfo['ntype']) ? 0 : intval($userinfo['ntype']);
		$params['SiteFlag'] = empty($userinfo['siteflag']) ? '' : intval($userinfo['siteflag']); //=124 91.com 接口分配的站点 ID
		$params['RecordFlag'] = empty($userinfo['recordflag']) ? 0 : 1; //记住密码（0不记住，1记住一个月；可以留空）
		$params['CheckCode'] = md5($params['AccountName'].$params['UserId'].$params['Password'].$params['NickName']
		.$params['RealName'].$params['IdCard'].$params['Mobile'].$params['Tel'].$params['IpAddress'].$params['Sex']
		.$params['Birthday'].$params['RegPlat'].$params['NType'].$params['SiteFlag'].$params['RecordFlag']
		.$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['regpre_sdk_url'];
		
		//var_dump($params);exit;
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if ($resultdata->Code != 27000) {
			$errmsg = $resultdata->Code.$resultdata->Message;
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		$result = array(
			'uin' => $resultdata->UserId,
			'username' => $resultdata->UserName,
			'regtime' => time(),
			//'ip' => $resultdata->ClientIp,
			//'message' => $resultdata->Message,
		);
		return $result;
	}
	
	//通过密保手机重设密码
	public static function PasswordChangeByMobile($userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '用户账号不能为空';
			return false;
		}
		if (empty($userinfo['verifycode'])) {
			$errmsg = '验证码不能为空';
			return false;
		}
		if (empty($userinfo['password'])) {
			$errmsg = '新密码不能为空';
			return false;
		}
		
		$params['Action'] = 'PasswordChangeByMobile';
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['MobileCheckCode'] = strval($userinfo['verifycode']);
		$params['Password'] = MD5Crypt::encrypt($userinfo['password']);
		$params['CheckCode'] = md5($params['AccountName'].$params['MobileCheckCode'].$params['Password'].$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['userinfo_sdk_url'];
		
		//var_dump($params);
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if ($resultdata->Code != 24001) {
			$errmsg = $resultdata->Code.$resultdata->Message;
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		/*$result = array(
			'phone' => $resultdata->UserId,
		);*/
		return true;
	}
	
	//绑定密保手机
	public static function BindMobileForUAP($userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '用户账号不能为空';
			return false;
		}
		if (empty($userinfo['secphone'])) {
			$errmsg = '密保手机不能为空';
			return false;
		}
		
		$params['Action'] = 'MobileBind'; // MobileBind
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['Mobile'] = strval($userinfo['secphone']);
		$params['CheckCode'] = md5($params['AccountName'].$params['Mobile'].$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['momo_sdk_url'];
		
		//var_dump($params);
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if ($resultdata->Code != 23001) {
			if ($resultdata->Code == 21003) {
				$errmsg = '该账号不是91应用中心注册的用户，请到<a href="https://aq.91.com/NDUser_ResetPassword.aspx"><span class="blue">91账号中心</span></a>绑定密保手机';
			} else {
				$errmsg = $resultdata->Code.$resultdata->Message;
			}
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		/*$result = array(
			'phone' => $resultdata->UserId,
		);*/
		return true;
	}
	
	//改绑密保手机
	public static function ChangeMobileForUAP($userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '用户账号不能为空';
			return false;
		}
		if (empty($userinfo['oldphone'])) {
			$errmsg = '旧密保手机不能为空';
			return false;
		}
		if (empty($userinfo['secphone'])) {
			$errmsg = '新密保手机不能为空';
			return false;
		}
		
		$params['Action'] = 'MobileChangeBind'; //MobileChangeBind
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['MobileOld'] = strval($userinfo['oldphone']);
		$params['Mobile'] = strval($userinfo['secphone']);
		$params['CheckCode'] = md5($params['AccountName'].$params['MobileOld'].$params['Mobile'].$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['momo_sdk_url'];
		
		//var_dump($params);
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if ($resultdata->Code != 23001) {
			if ($resultdata->Code == 21003) {
				$errmsg = '该账号不是91应用中心注册的用户，请到<a href="https://aq.91.com/NDUser_ResetPassword.aspx"><span class="blue">91账号中心</span></a>改绑密保手机';
			} else {
				$errmsg = $resultdata->Code.$resultdata->Message;
			}
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		/*$result = array(
			'phone' => $resultdata->UserId,
		);*/
		return true;
	}
	
	//根据帐号获取手机密保
	public static function GetUserShowMobileByUserName($userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '账号名称为空';
			return false;
		}
		
		$params['Action'] = 'GetUserShowMobileByUserName';
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['CheckCode'] = md5($params['AccountName'].$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['userinfo_sdk_url'];
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if ($resultdata->Code != 21001) {
			$errmsg = $resultdata->Code.$resultdata->Message;
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		$result = array(
			'phone' => $resultdata->Mobile,
		);
		return $result;
	}
	
	//发送重置密码链接邮件 通过邮箱重置密码
	public static function SendResetPasswordEmailLink($userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '账号名称不能为空';
			return false;
		}
		if (empty($userinfo['email'])) {
			$errmsg = '密保邮箱不能为空';
			return false;
		}
		
		$params['Action'] = 'SendResetPasswordEmailLink';
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['Email'] = strval($userinfo['email']);
		$params['CheckCode'] = md5($params['AccountName'].$params['Email'].$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['userinfo_sdk_url'];
		
		//var_dump($params);exit;
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}
		if ($resultdata->Code != 21001) {
			$errmsg = $resultdata->Code.$resultdata->Message;
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		/*$result = array(
			'phone' => $resultdata->UserId,
		);*/
		return true;
	}
	
	//发送短信
	public static function SendMessage($userinfo, & $errmsg = '')
	{
		$config = glb::$config;
		if (!is_array($userinfo) || empty($userinfo)) {
			$errmsg = '用户数据错误';
			return false;
		}
		if (empty($userinfo['username'])) {
			$errmsg = '账号名称不能为空';
			return false;
		}
		if (empty($userinfo['phone'])) {
			$errmsg = '手机号码不能为空';
			return false;
		}
		if (!in_array($userinfo['btype'], array(0, 1, 2, 11))) {
			$errmsg = '发送业务类型不合法';
			return false;
		}
		
		$params['Action'] = 'SendMessage';
		$params['TimeStamp'] = date("YmdHis");
		$params['UserName'] = $config['passport']['interface']['user'];
		$params['AccountName'] = strval($userinfo['username']);
		$params['Mobile'] = strval($userinfo['phone']);
		$params['BusinessType'] = intval($userinfo['btype']); //0 手机绑定申请发送校验码； 1 校验旧手机号发送校验码；2 校验新手机号发送校验码；11 手机取回密码发送校验码
		$params['MsgSourceType'] = 1; //来源类型：短信平台提供。  ＝>SourceType
		$params['MsgBusinessCode'] = 90047; //业务代码：短信平台提供。	 =>业务代码
		$params['MsgKey'] = '824ec1c9-9c99-4c70-a5e4-093295e52ae1'; // 用来运算校验码的 Key：短信平台提供。 ＝>key值
		$params['CheckCode'] = md5($params['AccountName'].$params['Mobile'].$params['BusinessType'].$params['MsgSourceType'].$params['MsgBusinessCode'].$params['MsgKey'].$params['TimeStamp'].$config['passport']['interface']['pass'].$config['passport']['key'][$params['Action']]);
		$params['Format'] = 'json';
		$sdk_url = $config['passport']['userinfo_sdk_url'];
		
		//var_dump($params);
		
		$result = req::fspost($sdk_url, http_build_query($params), 10, true, 0, $errmsg);
		if (!($resultdata = self::_doerror($result, $errmsg))) {
			return false;	
		}		
		if ($resultdata->Code != 22000) {
			$errmsg = $resultdata->Code.$resultdata->Message;
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		/*$result = array(
			'phone' => $resultdata->UserId,
		);*/
		return true;
	}
	
	/**
	 * 统一错误处理
	 *
	 * @param array $result 
	 * @param string $errmsg
	 * @return bool
	 */
	private static function _doerror($result, & $errmsg='')
	{
		if (empty($result)) {
			$errmsg = '网络错误('.$errmsg.')';
			return false;
		}
		if (!isset($result['code']) || $result['code']!=200) {
			$errmsg = '返回码错误('.$errmsg.')';
			return false;
		}
		if (empty($result['data'])) {
			$errmsg = '返回数据错误('.$errmsg.')';
			return false;
		}
		$resultdata = json_decode($result['data']);
		if (json_last_error() != JSON_ERROR_NONE) {
			$errmsg = '返回数据错误.';
			return false;
		}
		return $resultdata;
	}


}

?>