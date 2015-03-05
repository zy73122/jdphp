<?php
/**
 * 快钱
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class kuaiqian extends base_payment
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
		'pay_name' => language::get('kuaiqian_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('kuaiqian_desc'),//描述对应的语言项
		'pay_fee' => null, //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'yes',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.99bill.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/kuaiqian.gif',
		'pay_config' =>  array(		
		array('name_en' => 'kq_account', 'name_cn' => '收款帐号', 'type' => 'text', 'value' => ''),
		array('name_en' => 'kq_key', 'name_cn' => '商户密钥', 'type' => 'text', 'value' => ''),	
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
	   $merchant_acctid	= trim($payment['pay_config']['kq_account']);				 //人民币账号 不可空
	   $key				= trim($payment['pay_config']['kq_key']);
	   $input_charset	  = 1;												//字符集 默认1=utf-8
	   $page_url		   = tool::current_url();
	   $bg_url			 = '';
	   $version			= 'v2.0';
	   $language		   = 1;
	   $sign_type		  = 1;												//签名类型 不可空 固定值 1:md5
	   $payer_name		 = '';
	   $payer_contact_type = '';
	   $payer_contact	  = '';
	   $order_id		   = $order['order_sn'];								  //商户订单号 不可空
	   $order_amount	   = $order['order_amount'] * 100;						//商户订单金额 不可空
	   $order_time		 = tool::get_date($order['created'], 'YmdHis');		//商户订单提交时间 不可空 14位
	   $product_name	   = '';
	   $product_num		= '';
	   $product_id		 = '';
	   $product_desc	   = '';
	   $ext1			   = '';
	   $ext2			   = '';
	   $pay_type		   = '00';												//支付方式 不可空
	   $bank_id			= '';
	   $redo_flag		  = '0';
	   $pid				= '';

		/* 生成加密签名串 请务必按照如下顺序和规则组成加密串！*/
		$signmsgval = '';
		$signmsgval = $this->append_param($signmsgval, "inputCharset", $input_charset);
		$signmsgval = $this->append_param($signmsgval, "pageUrl", $page_url);
		$signmsgval = $this->append_param($signmsgval, "bgUrl", $bg_url);
		$signmsgval = $this->append_param($signmsgval, "version", $version);
		$signmsgval = $this->append_param($signmsgval, "language", $language);
		$signmsgval = $this->append_param($signmsgval, "signType", $sign_type);
		$signmsgval = $this->append_param($signmsgval, "merchantAcctId", $merchant_acctid);
		$signmsgval = $this->append_param($signmsgval, "payerName", $payer_name);
		$signmsgval = $this->append_param($signmsgval, "payerContactType", $payer_contact_type);
		$signmsgval = $this->append_param($signmsgval, "payerContact", $payer_contact);
		$signmsgval = $this->append_param($signmsgval, "orderId", $order_id);
		$signmsgval = $this->append_param($signmsgval, "orderAmount", $order_amount);
		$signmsgval = $this->append_param($signmsgval, "orderTime", $order_time);
		$signmsgval = $this->append_param($signmsgval, "productName", $product_name);
		$signmsgval = $this->append_param($signmsgval, "productNum", $product_num);
		$signmsgval = $this->append_param($signmsgval, "productId", $product_id);
		$signmsgval = $this->append_param($signmsgval, "productDesc", $product_desc);
		$signmsgval = $this->append_param($signmsgval, "ext1", $ext1);
		$signmsgval = $this->append_param($signmsgval, "ext2", $ext2);
		$signmsgval = $this->append_param($signmsgval, "payType", $pay_type);
		$signmsgval = $this->append_param($signmsgval, "bankId", $bank_id);
		$signmsgval = $this->append_param($signmsgval, "redoFlag", $redo_flag);
		$signmsgval = $this->append_param($signmsgval, "pid", $pid);
		$signmsgval = $this->append_param($signmsgval, "key", $key);
		$signmsg	= strtoupper(md5($signmsgval));	//签名字符串 不可空


		$pay_htmlcode  = '<div style="text-align:center"><form name="kqPay" style="text-align:center;" method="post" action="https://www.99bill.com/gateway/recvMerchantInfoAction.htm" target="_blank">';
		$pay_htmlcode .= "<input type='hidden' name='inputCharset' value='" . $input_charset . "' />";
		$pay_htmlcode .= "<input type='hidden' name='bgUrl' value='" . $bg_url . "' />";
		$pay_htmlcode .= "<input type='hidden' name='pageUrl' value='" . $page_url . "' />";
		$pay_htmlcode .= "<input type='hidden' name='version' value='" . $version . "' />";
		$pay_htmlcode .= "<input type='hidden' name='language' value='" . $language . "' />";
		$pay_htmlcode .= "<input type='hidden' name='signType' value='" . $sign_type . "' />";
		$pay_htmlcode .= "<input type='hidden' name='signMsg' value='" . $signmsg . "' />";
		$pay_htmlcode .= "<input type='hidden' name='merchantAcctId' value='" . $merchant_acctid . "' />";
		$pay_htmlcode .= "<input type='hidden' name='payerName' value='" . $payer_name . "' />";
		$pay_htmlcode .= "<input type='hidden' name='payerContactType' value='" . $payer_contact_type . "' />";
		$pay_htmlcode .= "<input type='hidden' name='payerContact' value='" . $payer_contact . "' />";
		$pay_htmlcode .= "<input type='hidden' name='orderId' value='" . $order_id . "' />";
		$pay_htmlcode .= "<input type='hidden' name='orderAmount' value='" . $order_amount . "' />";
		$pay_htmlcode .= "<input type='hidden' name='orderTime' value='" . $order_time . "' />";
		$pay_htmlcode .= "<input type='hidden' name='productName' value='" . $product_name . "' />";
		$pay_htmlcode .= "<input type='hidden' name='payType' value='" . $pay_type . "' />";
		$pay_htmlcode .= "<input type='hidden' name='productNum' value='" . $product_num . "' />";
		$pay_htmlcode .= "<input type='hidden' name='productId' value='" . $product_id . "' />";
		$pay_htmlcode .= "<input type='hidden' name='productDesc' value='" . $product_desc . "' />";
		$pay_htmlcode .= "<input type='hidden' name='ext1' value='" . $ext1 . "' />";
		$pay_htmlcode .= "<input type='hidden' name='ext2' value='" . $ext2 . "' />";
		$pay_htmlcode .= "<input type='hidden' name='bankId' value='" . $bank_id . "' />";
		$pay_htmlcode .= "<input type='hidden' name='redoFlag' value='" . $redo_flag ."' />";
		$pay_htmlcode .= "<input type='hidden' name='pid' value='" . $pid . "' />";
		$pay_htmlcode .= "<input type='submit' name='submit' value='" . language::get('kuaiqian_pay_button') . "' />";
		$pay_htmlcode .= "</form></div></br>";

		return $pay_htmlcode;
	}

	/**
	 * 响应操作
	 */
	function respond($payment)
	{
		$merchant_acctid	 = $payment['pay_config']['kq_account'];				 //人民币账号 不可空
		$key				 = $payment['pay_config']['kq_key'];
		$get_merchant_acctid = trim($_REQUEST['merchantAcctId']);
		$pay_result		  = trim($_REQUEST['payResult']);
		$version			 = trim($_REQUEST['version']);
		$language			= trim($_REQUEST['language']);
		$sign_type		   = trim($_REQUEST['signType']);
		$pay_type			= trim($_REQUEST['payType']);
		$bank_id			 = trim($_REQUEST['bankId']);
		$order_id			= trim($_REQUEST['orderId']);
		$order_time		  = trim($_REQUEST['orderTime']);
		$order_amount		= trim($_REQUEST['orderAmount']);
		$deal_id			 = trim($_REQUEST['dealId']);
		$bank_deal_id		= trim($_REQUEST['bankDealId']);
		$deal_time		   = trim($_REQUEST['dealTime']);
		$pay_amount		  = trim($_REQUEST['payAmount']);
		$fee				 = trim($_REQUEST['fee']);
		$ext1				= trim($_REQUEST['ext1']);
		$ext2				= trim($_REQUEST['ext2']);
		$err_code			= trim($_REQUEST['errCode']);
		$sign_msg			= trim($_REQUEST['signMsg']);

		//生成加密串。必须保持如下顺序。
		$merchant_signmsgval = '';
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"merchantAcctId",$merchant_acctid);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"version",$version);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"language",$language);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"signType",$sign_type);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"payType",$pay_type);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"bankId",$bank_id);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"orderId",$order_id);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"orderTime",$order_time);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"orderAmount",$order_amount);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"dealId",$deal_id);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"bankDealId",$bank_deal_id);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"dealTime",$deal_time);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"payAmount",$pay_amount);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"fee",$fee);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"ext1",$ext1);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"ext2",$ext2);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"payResult",$pay_result);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"errCode",$err_code);
		$merchant_signmsgval = $this->append_param($merchant_signmsgval,"key",$key);
		$merchant_signmsg	= md5($merchant_signmsgval);

		//首先对获得的商户号进行比对
		if ($get_merchant_acctid != $merchant_acctid)
		{
			//商户号错误
			return false;
		}

		if (strtoupper($sign_msg) == strtoupper($merchant_signmsg))
		{
			if ($pay_result == 10 || $pay_result == 00)
			{
				/* 检查支付的金额是否相符 */
				if (!$this->check_money($order_sn, $pay_amount))
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
		else
		{
			//'密钥校对错误';
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}			
	}
	
	/**
	* 将变量值不为空的参数组成字符串
	* @param   string   $strs  参数字符串
	* @param   string   $key   参数键名
	* @param   string   $val   参数键对应值
	*/
	function append_param($strs,$key,$val)
	{
		if($strs != "")
		{
			if($key != '' && $val != '')
			{
				$strs .= '&' . $key . '=' . $val;
			}
		}
		else
		{
			if($val != '')
			{
				$strs = $key . '=' . $val;
			}
		}
		return $strs;
	}


}

?>