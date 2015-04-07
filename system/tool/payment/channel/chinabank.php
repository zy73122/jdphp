<?php
/**
 * 网银在线
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class chinabank extends base_payment
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
		'pay_name' => language::get('chinabank_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('chinabank_desc'),//描述对应的语言项
		'pay_fee' => '1%', //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'yes',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.chinabank.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/chinabank.gif',
		'pay_config' =>  array(		
		array('name_en' => 'chinabank_account', 'name_cn' => '商户编号', 'type' => 'text', 'value' => ''),
		array('name_en' => 'chinabank_key', 'name_cn' => 'MD5 密钥', 'type' => 'text', 'value' => ''),
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
		$data_vid          = trim($payment['pay_config']['chinabank_account']);
		$data_orderid      = $order['order_sn'];
		$data_vamount      = $order['order_amount'];
		$data_vmoneytype   = 'CNY';
		$data_vpaykey      = trim($payment['pay_config']['chinabank_key']);
		$data_vreturnurl   = tool::current_url();
		$remark1           = "";                     //值自定义。
		//$remark2 = '[url:=http://domain/chinabank/AutoReceive.php]'; //服务器异步通知的接收地址。对应AutoReceive.php示例。必须要有[url:=]格式。
		                                             //参照"网银在线支付B2C系统商户接口文档v4.1.doc"中2.3.3.2。


		$MD5KEY =$data_vamount.$data_vmoneytype.$data_orderid.$data_vid.$data_vreturnurl.$data_vpaykey;
		$MD5KEY = strtoupper(md5($MD5KEY));

		$pay_htmlcode  = '<br /><form style="text-align:center;" method=post action="https://pay3.chinabank.com.cn/PayGate" target="_blank">';
		$pay_htmlcode .= "<input type=HIDDEN name='v_mid' value='".$data_vid."'>";
		$pay_htmlcode .= "<input type=HIDDEN name='v_oid' value='".$data_orderid."'>";
		$pay_htmlcode .= "<input type=HIDDEN name='v_amount' value='".$data_vamount."'>";
		$pay_htmlcode .= "<input type=HIDDEN name='v_moneytype'  value='".$data_vmoneytype."'>";
		$pay_htmlcode .= "<input type=HIDDEN name='v_url'  value='".$data_vreturnurl."'>";
		$pay_htmlcode .= "<input type=HIDDEN name='v_md5info' value='".$MD5KEY."'>";
		$pay_htmlcode .= "<input type=HIDDEN name='remark1' value='".$remark1."'>";
		$pay_htmlcode .= "<input type=submit value='" . language::get('chinabank_pay_button'). "'>";
		$pay_htmlcode .= "</form>";

		return $pay_htmlcode;
	}

	/**
	 * 响应操作
	 */
	function respond($payment)
	{
		$order_sn	   = trim($_POST['v_oid']);
		$v_pmode		= trim($_POST['v_pmode']);
		$v_pstatus	  = trim($_POST['v_pstatus']);
		$v_pstring	  = trim($_POST['v_pstring']);
		$v_amount	   = trim($_POST['v_amount']);
		$v_moneytype	= trim($_POST['v_moneytype']);
		$remark1		= trim($_POST['remark1' ]);
		$remark2		= trim($_POST['remark2' ]);
		$v_md5str	   = trim($_POST['v_md5str' ]);

		/**
		 * 重新计算md5的值
		 */
		$key = $payment['pay_config']['chinabank_key'];
		$md5string=strtoupper(md5($order_sn.$v_pstatus.$v_amount.$v_moneytype.$key));

		/* 检查秘钥是否正确 */
		if ($v_md5str==$md5string)
		{
			if ($v_pstatus == '20')
			{
				//支付成功
				$this->setOrderSuccess($order_sn, $_REQUEST);
				return true;
			}
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
