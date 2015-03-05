<?php
/**
 * YeePay易宝插件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class yeepay extends base_payment
{
	public $config;
	/**
	 * 构造函数
	 */
	function __construct()
	{
		//载入语言文件
		$lang = language::load('payment.lang.php');
		//配置
		$this->config = array(
		'pay_name' => language::get('yeepay_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('yeepay_desc'),//描述对应的语言项
		'pay_fee' => null, //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'no',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.yeepay.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/yeepay.gif',
		'pay_config' =>  array(
		array('name_en' => 'yeepay_merchant', 'name_cn' => '商户编号', 'type' => 'text', 'value' => '10000432521'),
		array('name_en' => 'yeepay_key', 'name_cn' => '商户key', 'type' => 'text', 'value' => '8UPp0KE8sq73zVP370vko7C39403rtK1YwX40Td6irH216036H27Eb12792t'),
		array('name_en' => 'yeepay_acturl', 'name_cn' => '提交表单地址', 'type' => 'select', 'value'=>'http://tech.yeepay.com:8080/robot/debug.action', 'value_list' => array(
		array('title'=>'常规', 'value'=>'https://www.yeepay.com/app-merchant-proxy/node'),
		array('title'=>'测试', 'value'=>'http://tech.yeepay.com:8080/robot/debug.action'),)),//这个选项将生成隐藏的表单项。且在后可以配置
		), 
		);
	}

	/**
	 * 生成支付代码
	 * @param array $order 订单信息
	 * @param array $payment 支付方式信息（可以从payment::getinfo($pay_code)获得）
	 */
	function get_code($order, $payment)
	{
		$data_merchant_id = $payment['pay_config']['yeepay_merchant'];
		$data_order_id	= $order['order_sn'];
		$data_amount	  = $order['order_amount'];
		$message_type	 = 'Buy';
		$data_cur		 = 'CNY';
		$product_id	   = '';
		$product_cat	  = '';
		$product_desc	 = '';
		$address_flag	 = '0';

		$data_return_url  = tool::current_url();
		$data_pay_key	 = $payment['pay_config']['yeepay_key'];
		$data_pay_account = $payment['pay_config']['yeepay_merchant'];
		$mct_properties   = $order['order_sn'];
		$pd_FrpId		 = '1000000-NET';
		$pr_NeedResponse  =	'1';
		$pay_htmlcode = $message_type . $data_merchant_id . $data_order_id . $data_amount . $data_cur . $product_id . $product_cat
		. $product_desc . $data_return_url . $address_flag . $mct_properties .$pd_FrpId . $pr_NeedResponse;
		$MD5KEY = HmacMd5($pay_htmlcode, $data_pay_key);
		$action_url = $payment['pay_config']['yeepay_acturl'];

		$pay_htmlcode  = "\n<form action='".$action_url."' method='post' target='_blank'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p0_Cmd' value='".$message_type."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p1_MerId' value='".$data_merchant_id."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p2_Order' value='".$data_order_id."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p3_Amt' value='".$data_amount."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p4_Cur' value='".$data_cur."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p5_Pid' value='".$product_id."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p6_Pcat' value='".$product_cat."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p7_Pdesc' value='".$product_desc."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p8_Url' value='".$data_return_url."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='p9_SAF' value='".$address_flag."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='pa_MP' value='".$mct_properties."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='pd_FrpId' value='".$pd_FrpId."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='pr_NeedResponse' value='".$pr_NeedResponse."'>\n";
		$pay_htmlcode .= "<input type='hidden' name='hmac' value='".$MD5KEY."'>\n";
		$pay_htmlcode .= "<input type='submit' value='".language::get('yeepay_pay_button')."'>";
		$pay_htmlcode .= "</form>\n";

		return $pay_htmlcode;
	}

	/**
	 * 响应操作
	 */
	function respond($payment)
	{
		$merchant_id	= $payment['pay_config']['yeepay_merchant'];	   // 获取商户编号
		$merchant_key   = $payment['pay_config']['yeepay_key'];		   // 获取秘钥

		$message_type   = trim($_REQUEST['r0_Cmd']);
		$succeed		= trim($_REQUEST['r1_Code']);   // 获取交易结果,1成功,-1失败
		$trxId		  = trim($_REQUEST['r2_TrxId']);
		$amount		 = trim($_REQUEST['r3_Amt']);	// 获取订单金额
		$cur			= trim($_REQUEST['r4_Cur']);	// 获取订单货币单位
		$product_id	 = trim($_REQUEST['r5_Pid']);	// 获取产品ID
		$orderid		= trim($_REQUEST['r6_Order']);  // 获取订单ID
		$userId		 = trim($_REQUEST['r7_Uid']);	// 获取产品ID
		$merchant_param = trim($_REQUEST['r8_MP']);	 // 获取商户私有参数
		$bType		  = trim($_REQUEST['r9_BType']);  // 获取订单ID
		$order_sn		 = $orderid;

		$mac			= trim($_REQUEST['hmac']);	  // 获取安全加密串

		///生成加密串,注意顺序
		$ScrtStr  = $merchant_id . $message_type . $succeed . $trxId . $amount . $cur . $product_id .
		$orderid . $userId . $merchant_param . $bType;
		$mymac	= HmacMd5($ScrtStr, $merchant_key);

		$v_result = false;

		if (strtoupper($mac) == strtoupper($mymac))
		{
			if ($succeed == '1')
			{
				/* 检查支付的金额是否相符 */
				if (!$this->check_money($order_sn, $amount))
				{
					//支付失败
					$this->setOrderFailed($order_sn, $_REQUEST);
					return false;
				}
				
				//支付成功
				$this->setOrderSuccess($order_sn, $_REQUEST);
				return true;
			}
			else
			{
				//支付失败
				$this->setOrderFailed($order_sn, $_REQUEST);
				return false;
			}
		}
	}
}

function HmacMd5($data,$key)
{
	// RFC 2104 HMAC implementation for php.
	// Creates an md5 HMAC.
	// Eliminates the need to install mhash to compute a HMAC
	// Hacked by Lance Rushing(NOTE: Hacked means written)

	//需要配置环境支持iconv，否则中文参数不能正常处理
	$key = iconv("GB2312","UTF-8",$key);
	$data = iconv("GB2312","UTF-8",$data);

	$b = 64; // byte length for md5
	if (strlen($key) > $b) {
		$key = pack("H*",md5($key));
	}
	$key = str_pad($key, $b, chr(0x00));
	$ipad = str_pad('', $b, chr(0x36));
	$opad = str_pad('', $b, chr(0x5c));
	$k_ipad = $key ^ $ipad ;
	$k_opad = $key ^ $opad;

	return md5($k_opad . pack("H*",md5($k_ipad . $data)));
}
?>