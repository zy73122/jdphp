<?php
/**
 * 支付宝插件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class alipay extends base_payment
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
		'pay_name' => language::get('alipay_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('alipay_desc'),//描述对应的语言项
		'pay_fee' => null, //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'yes',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.alipay.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/alipay.gif',
		'pay_config' =>  array(		
		array('name_en' => 'alipay_account', 'name_cn' => '支付宝帐户', 'type' => 'text', 'value' => ''),
		array('name_en' => 'alipay_key', 'name_cn' => '交易安全校验码', 'type' => 'text', 'value' => ''),
		array('name_en' => 'alipay_partner', 'name_cn' => '合作者身份ID', 'type' => 'text', 'value' => ''),
		array('name_en' => 'alipay_pay_method', 'name_cn' => '选择接口类型', 'type' => 'select', 'value' => '0', 'value_list' => array(
		array('title'=>'使用标准双接口', 'value'=>0),
		array('title'=>'使用担保交易接口', 'value'=>1),
		array('title'=>'使用即时到帐交易接口', 'value'=>2),
		)),	
		//array('name_en' => 'alipay_real_method', 'name_cn' => '商户key', 'type' => 'text', 'value' => ''),
		//array('name_en' => 'alipay_virtual_method', 'name_cn' => '商户key', 'type' => 'text', 'value' => ''),
		//array('name_en' => 'is_instant', 'name_cn' => '商户key', 'type' => 'text', 'value' => ''),			
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
		$real_method = $payment['pay_config']['alipay_pay_method'];
		switch ($real_method){
			case '0':
				$service = 'trade_create_by_buyer';
				break;
			case '1':
				$service = 'create_partner_trade_by_buyer';
				break;
			case '2':
				$service = 'create_direct_pay_by_user';
				break;
		}

		$agent = 'C4335319945672464113';

		$parameter = array(
			'agent'			 => $agent,
			'service'		   => $service,
			'partner'		   => $payment['pay_config']['alipay_partner'],
			//'partner'		   => ALIPAY_ID,
			'_input_charset'	=> CHARSET,
			'notify_url'		=> tool::current_url(),
			'return_url'		=> tool::current_url(),
			/* 业务参数 */
			'subject'		   => $order['order_sn'],
			'out_trade_no'	  => $order['order_sn'] . $order['order_sn'],
			'price'			 => $order['order_amount'],
			'quantity'		  => 1,
			'payment_type'	  => 1,
			/* 物流参数 */
			'logistics_type'	=> 'EXPRESS',
			'logistics_fee'	 => 0,
			'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
			/* 买卖双方信息 */
			'seller_email'	  => $payment['pay_config']['alipay_account']
		);

		ksort($parameter);
		reset($parameter);

		$param = '';
		$sign  = '';

		foreach ($parameter AS $key => $val)
		{
			$param .= "$key=" .urlencode($val). "&";
			$sign  .= "$key=$val&";
		}

		$param = substr($param, 0, -1);
		$sign  = substr($sign, 0, -1). $payment['pay_config']['alipay_key'];
		//$sign  = substr($sign, 0, -1). ALIPAY_AUTH;

		$pay_htmlcode = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="' .language::get('alipay_pay_button'). '" /></div>';

		return $pay_htmlcode;
	}

	/**
	 * 响应操作
	 */
	function respond($payment)
	{

		if (!empty($_POST))
		{
			foreach($_POST as $key => $data)
			{
				$_GET[$key] = $data;
			}
		}
		$seller_email = rawurldecode($_GET['seller_email']);
		$order_sn = str_replace($_GET['subject'], '', $_GET['out_trade_no']);
		$order_sn = trim($order_sn);

		/* 检查支付的金额是否相符 */
		if (!$this->check_money($order_sn, $_GET['total_fee']))
		{
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}

		/* 检查数字签名是否正确 */
		ksort($_GET);
		reset($_GET);

		$sign = '';
		foreach ($_GET AS $key=>$val)
		{
			if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
			{
				$sign .= "$key=$val&";
			}
		}

		$sign = substr($sign, 0, -1) . $payment['pay_config']['alipay_key'];
		//$sign = substr($sign, 0, -1) . ALIPAY_AUTH;
		if (md5($sign) != $_GET['sign'])
		{
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}

		if ($_GET['trade_status']=='WAIT_SELLER_SEND_GOODS' || $_GET['trade_status']=='TRADE_SUCCESS')
		{
			//支付成功
			$this->setOrderSuccess($order_sn, $_REQUEST);
			return true;
		}
		elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
		{
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

?>