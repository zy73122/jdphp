<?php
/**
 * 银行汇款（转帐）插件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class bank extends base_payment
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
		'pay_name' => language::get('bank_name'),//名称
		'pay_code' => basename(__FILE__, '.php'),//代码
		'pay_desc' => language::get('bank_desc'),//描述对应的语言项
		'pay_fee' => null, //支付手续费 如：'1%'
		'is_cod' => 'no',//是否支持货到付款  可取值：'no' or 'yes'
		'is_online' => 'no',//是否支持在线支付
		'author' => 'yy',//作者
		'website' => 'http://www.jdphp.com',
		'version' => '1.0.0',
		'logo' => 'static/images/payment/bank.gif',
		'pay_config' =>  array(),
		);
	}

	/**
	 * 生成支付代码
	 */
	function get_code()
	{
		return '';
	}

	/**
	 * 响应操作
	 */
	function respond()
	{
		return;
	}	
}

?>