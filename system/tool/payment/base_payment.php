<?php
/**
 * 基类 - 支付方式
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class base_payment
{
	public $config;
	/**
	 * 构造函数
	 */
	function __construct()
	{
		$this->config = array();
	}

	/**
	 * 生成支付代码
	 * @param array $order 订单信息
	 * @param array $payment 支付方式信息（可以从payment::getinfo($pay_code)获得）
	 */
	function get_code($order, $payment)
	{
		throw new Exception("请重写该虚函数".__CLASS__."->".__FUNCTION__."()");
		return false;
	}
	
	/**
	 * 响应操作
	 */
	function respond($payment)
	{
		return false;
	}
	
	/**
	 * respond里调用这个函数检查已支付的金额是否正确
	 */
	function check_money($order_sn, $responseAmount)
	{
		//从数据库获取应付金额
		$needAmount = db::instance()->getone("select order_amount from #PRE#shop_order where order_sn='$order_sn' ");
		if (!$needAmount || $needAmount!=$responseAmount)
		return false;
		else
		return true;
	}
	
	
	/**
	 * 支付成功 后继处理
	 */
	function setOrderSuccess($order_sn, $request)
	{
		if (DEBUG_LEVEL)
		cfile::write(PATH_DATA_CORE . 'log/pay.log', serialize($request), "ab");
		//设置订单状态
		m_shop_order::set_order($order_sn, 'pay_success');
	}
	
	/**
	 * 支付失败 后继处理
	 */
	function setOrderFailed($order_sn, $request)
	{
		if (DEBUG_LEVEL)
		cfile::write(PATH_DATA_CORE . 'log/pay.log', serialize($request), "ab");
		m_shop_order::set_order($order_sn, 'pay_failed');
	}

	/**
	 * 安装
	 */
	function install()
	{
		$data = db::instance()->select('shop_payment', "*", "1 and pay_code='".$this->config['pay_code']."'");
		if (!empty($data)) return; //已经安装了

		$adddata = $this->config;
		$adddata['pay_config'] = serialize($this->config['pay_config']);
		$adddata['updated'] = null;
		$adddata['created'] = time();
		$adddata['enable'] = 'yes';
		db::instance()->insert('shop_payment', $adddata);
	}

	/**
	 * 卸载
	 */
	function uninstall()
	{
		db::instance()->delete('shop_payment', "1 and pay_code='".$this->config['pay_code']."'");
	}

	/**
	 * 获取配置信息
	 *
	 * @return array
	 */
	function get_config()
	{
		return $this->config;
	}

}

?>