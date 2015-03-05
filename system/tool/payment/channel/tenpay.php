<?php
/**
 * 财付通
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class tenpay extends base_payment
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
		'pay_name' => language::get('tenpay_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('tenpay_desc'),//描述对应的语言项
		'pay_fee' => null, //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'yes',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.tenpay.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/tenpay.gif',
		'pay_config' =>  array(		
		array('name_en' => 'tenpay_account', 'name_cn' => '财付通商户号', 'type' => 'text', 'value' => ''),
		array('name_en' => 'tenpay_key', 'name_cn' => '财付通密钥', 'type' => 'text', 'value' => ''),
		array('name_en' => 'magic_string', 'name_cn' => '自定义签名', 'type' => 'text', 'value' => ''),			
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
		$cmd_no = '1';

		/* 获得订单的流水号，补零到10位 */
		$sp_billno = $order['order_sn'];

		/* 交易日期 */
		$today = date('Ymd');

		/* 将商户号+年月日+流水号 */
		$bill_no = str_pad($order['order_sn'], 10, 0, STR_PAD_LEFT);
		$transaction_id = $payment['pay_config']['tenpay_account'].$today.$bill_no;

		/* 银行类型:支持纯网关和财付通 */
		$bank_type = '0';

		/* 订单描述，用订单号替代 */
		$desc = $order['order_sn'];
		$attach = '';
		
		/* 编码标准 */
		if (CHARSET)
		{
			$desc = iconv('utf-8', 'gbk', $desc);
		}

		/* 返回的路径 */
		$return_url = tool::current_url();

		/* 总金额 */
		$total_fee = floatval($order['order_amount']) * 100;

		/* 货币类型 */
		$fee_type = '1';

		/* 重写自定义签名 */
		//$payment['pay_config']['magic_string'] = abs(crc32($payment['pay_config']['magic_string']));

		/* 数字签名 */
		$sign_text = "cmdno=" . $cmd_no . "&date=" . $today . "&bargainor_id=" . $payment['pay_config']['tenpay_account'] .
		  "&transaction_id=" . $transaction_id . "&sp_billno=" . $sp_billno .
		  "&total_fee=" . $total_fee . "&fee_type=" . $fee_type . "&return_url=" . $return_url .
		  "&attach=" . $attach . "&key=" . $payment['pay_config']['tenpay_key'];
		$sign = strtoupper(md5($sign_text));

		/* 交易参数 */
		$parameter = array(
			'cmdno'			 => $cmd_no,					 // 业务代码, 财付通支付支付接口填  1
			'date'			  => $today,					  // 商户日期：如20051212
			'bank_type'		 => $bank_type,				  // 银行类型:支持纯网关和财付通
			'desc'			  => $desc,					   // 交易的商品名称
			'purchaser_id'	  => '',						  // 用户(买方)的财付通帐户,可以为空
			'bargainor_id'	  => $payment['pay_config']['tenpay_account'],  // 商家的财付通商户号
			'transaction_id'	=> $transaction_id,			 // 交易号(订单号)，由商户网站产生(建议顺序累加)
			'sp_billno'		 => $sp_billno,				  // 商户系统内部的定单号,最多10位
			'total_fee'		 => $total_fee,				  // 订单金额
			'fee_type'		  => $fee_type,				   // 现金支付币种
			'return_url'		=> $return_url,				 // 接收财付通返回结果的URL
			'attach'			=> $attach,					 // 用户自定义签名
			'sign'			  => $sign,					   // MD5签名
			//'sys_id'			=> '542554970',				 //ecshop C账号 不参与签名
			//'sp_suggestuser'	=> '1202822001'				 //财付通分配的商户号

		);

		$pay_htmlcode = '<br /><form style="text-align:center;" action="https://www.tenpay.com/cgi-bin/v1.0/pay_gate.cgi" target="_blank" style="margin:0px;padding:0px" >';
		foreach ($parameter as $key=>$val)
		{
			$pay_htmlcode .= "<input type='hidden' name='$key' value='$val' />";
		}
		$pay_htmlcode .= '<input type="image" src="'.URL.$payment['logo'].'" title="' .language::get('tenpay_pay_button'). '" /></form><br />';

		return $pay_htmlcode;
	}

	/**
	 * 响应操作
	 */
	function respond($payment)
	{
		/*取返回参数*/
		$cmd_no		 = $_GET['cmdno'];
		$pay_result	 = $_GET['pay_result'];
		$pay_info	   = $_GET['pay_info'];
		$bill_date	  = $_GET['date'];
		$bargainor_id   = $_GET['bargainor_id'];
		$transaction_id = $_GET['transaction_id'];
		$sp_billno	  = $_GET['sp_billno'];
		$total_fee	  = $_GET['total_fee'];
		$fee_type	   = $_GET['fee_type'];
		$attach		 = $_GET['attach'];
		$sign		   = $_GET['sign'];
		$order_sn 		= $sp_billno;

		/* 如果pay_result大于0则表示支付失败 */
		if ($pay_result > 0)
		{
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}

		/* 检查支付的金额是否相符 */
		if (!$this->check_money($order_sn, $total_fee / 100))
		{
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}

		/* 检查数字签名是否正确 */
		$sign_text  = "cmdno=" . $cmd_no . "&pay_result=" . $pay_result .
						  "&date=" . $bill_date . "&transaction_id=" . $transaction_id .
							"&sp_billno=" . $sp_billno . "&total_fee=" . $total_fee .
							"&fee_type=" . $fee_type . "&attach=" . $attach .
							"&key=" . $payment['tenpay_key'];
		$sign_md5 = strtoupper(md5($sign_text));
		if ($sign_md5 != $sign)
		{
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}
		else
		{
			//支付成功
			$this->setOrderSuccess($order_sn, $_REQUEST);
			return true;
		}
	}

}

?>