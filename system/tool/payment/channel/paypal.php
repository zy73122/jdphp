<?php
/**
 * paypal插件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class paypal extends base_payment
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
		'pay_name' => language::get('paypal_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('paypal_desc'),//描述对应的语言项
		'pay_fee' => null, //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'yes',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.paypal.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/paypal.jpg',
		'pay_config' =>  array(
		array('name_en' => 'paypal_account', 'name_cn' => '商户帐号', 'type' => 'text', 'value' => '10000432521'),
		array('name_en' => 'paypal_currency', 'name_cn' => '支付货币', 'type' => 'select', 'value' => 'USD',  'value_list' => array(
		array('title'=>'澳元', 'value'=>'AUD'),
		array('title'=>'加元', 'value'=>'CAD'),
		array('title'=>'欧元', 'value'=>'EUR'),
		array('title'=>'英镑', 'value'=>'GBP'),
		array('title'=>'日元', 'value'=>'JPY'),
		array('title'=>'美元', 'value'=>'USD'),
		array('title'=>'港元', 'value'=>'HKD'),)),
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
		$data_order_id	  = $order['order_amount'];
		$data_amount		= $order['order_amount'];
		$data_return_url	= tool::current_url();
		$data_pay_account   = $payment['pay_config']['paypal_account'];
		$currency_code	  = $payment['pay_config']['paypal_currency'];
		$data_notify_url	= tool::current_url();
		$cancel_return	  = tool::current_url();;

		$pay_htmlcode  = '<br /><form style="text-align:center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' .   // 不能省略
			"<input type='hidden' name='cmd' value='_xclick'>" .							 // 不能省略
			"<input type='hidden' name='business' value='$data_pay_account'>" .				 // 贝宝帐号
			"<input type='hidden' name='item_name' value='$order[order_sn]'>" .				 // payment for
			"<input type='hidden' name='amount' value='$data_amount'>" .						// 订单金额
			"<input type='hidden' name='currency_code' value='$currency_code'>" .			// 货币
			"<input type='hidden' name='return' value='$data_return_url'>" .					// 付款后页面
			"<input type='hidden' name='invoice' value='$data_order_id'>" .					  // 订单号
			"<input type='hidden' name='charset' value='utf-8'>" .							  // 字符集
			"<input type='hidden' name='no_shipping' value='1'>" .							  // 不要求客户提供收货地址
			"<input type='hidden' name='no_note' value=''>" .								  // 付款说明
			"<input type='hidden' name='notify_url' value='$data_notify_url'>" .
			"<input type='hidden' name='rm' value='2'>" .
			"<input type='hidden' name='cancel_return' value='$cancel_return'>" .
			"<input type='submit' value='" . language::get('paypal_pay_button') . "'>" .					  // 按钮
			"</form><br />";

		return $pay_htmlcode;
	}

	/**
	 * 响应操作
	 */
	function respond($payment)
	{
		$merchant_id	= $payment['pay_config']['paypal_account'];			   ///获取商户编号

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value)
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) ."\r\n\r\n";
		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

		// assign posted variables to local variables
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		$order_sn = $_POST['invoice'];
		$memo = !empty($_POST['memo']) ? $_POST['memo'] : '';
		$action_note = $txn_id . '（' . language::get('paypal_txn_id') . '）' . $memo;

		if (!$fp)
		{
			fclose($fp);
			
			//支付失败
			$this->setOrderFailed($order_sn, $_REQUEST);
			return false;
		}
		else
		{
			fputs($fp, $header . $req);
			while (!feof($fp))
			{
				$res = fgets($fp, 1024);
				if (strcmp($res, 'VERIFIED') == 0)
				{
					// check the payment_status is Completed
					if ($payment_status != 'Completed' && $payment_status != 'Pending')
					{
						fclose($fp);
						
						//支付失败
						$this->setOrderFailed($order_sn, $_REQUEST);
						return false;
					}

					// check that receiver_email is your Primary PayPal email
					if ($receiver_email != $merchant_id)
					{
						fclose($fp);
						
						//支付失败
						$this->setOrderFailed($order_sn, $_REQUEST);
						return false;
					}

					/* 检查支付的金额是否相符 */
					if (!$this->check_money($order_sn, $payment_amount))
					{
						fclose($fp);

						  //支付失败
						  $this->setOrderFailed($order_sn, $_REQUEST);
						return false;
					}
					
					if ($payment['pay_config']['paypal_currency'] != $payment_currency)
					{
						fclose($fp);
						
						//支付失败
						$this->setOrderFailed($order_sn, $_REQUEST);
						return false;
					}
					
					fclose($fp);

					//支付成功
					$this->setOrderSuccess($order_sn, $_REQUEST);
					return true;
				}
				elseif (strcmp($res, 'INVALID') == 0)
				{
					// log for manual investigation
					fclose($fp);
					
					//支付失败
					$this->setOrderFailed($order_sn, $_REQUEST);
					return false;
				}
			}
		}
		
	}
}
?>