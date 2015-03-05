<?php
/**
 * 支付方式
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
require('base_payment.php');

/**
 * 挂件
 *
 * 由该类再去调用子支付类
 * 使用例子：
 * payment::get_code('yeepay');
 * payment::respond('yeepay');
 */
class payment
{
	public static $isInit = false;
	public static $cls_payment;


	/**
	 * 生成支付代码
	 *
	 * @param string $order 订单
	 * @param string $payment 含支付类信息的数组
	 * @return string
	 */
	public static function get_code($order, $payment)
	{
		if (!$isInit) self::_init($payment['pay_code']);
		return self::$cls_payment->get_code($order, $payment);
	}

	/**
	 * 响应操作
	 *
	 * @param string $payment 含支付类信息的数组
	 * @return bool
	 */
	public static function respond($payment)
	{
		if (!$isInit) self::_init($payment['pay_code']);
		return self::$cls_payment->respond($payment);
	}

	/**
	 * 获取所有支付方式
	 *
	 * @return array
	 */
	public static function get_payments()
	{
		$files = cfile::ls(PATH_TOOL . 'payment/channel/', 'file');
		if (!empty($files))
		{
			$payments = array();
			foreach ($files as $onefile)
			{
				if (strpos($onefile, ".php")===false) continue;
				$cls_name = str_replace(".php", "", $onefile);
				require_once(PATH_TOOL . 'payment/channel/' . $onefile);
				$payments[] = s($cls_name)->get_config();
			}
		}
		return (!empty($payments) ? $payments : array());
	}

	/**
	 * 获取已安装的支付方式
	 *
	 * @return array
	 */
	public static function get_activity_payments()
	{
		$payments = m_shop_payment::get_list("1 and enable='yes'");
		return (!empty($payments['data']) ? $payments['data'] : array());
	}

	/**
	 * 获取某支付方式的信息
	 *
	 * @param unknown_type $payment_code
	 */
	public static function getinfo($payment_code)
	{
		$payment = m_shop_payment::get_one("1 and pay_code='$payment_code'");
		if (!empty($payment['pay_config']))
		{
			foreach (unserialize($payment['pay_config']) as $one)
			{
				$newconfig[$one['name_en']] = $one['value'];
			}
			$payment['pay_config'] = $newconfig;
		}
		return (!empty($payment) ? $payment : array());
	}

	/**
	 * 判断该支付方式是否已经安装
	 *
	 * @param unknown_type $payment_code
	 * @return unknown
	 */
	public static function isActived($payment_code)
	{
		$data = db::instance()->select('shop_payment', "*", "1 and pay_code='".$payment_code."'");
		if (!empty($data) && $data[0]['enable']=='yes')
		return true;
		return false;
	}

	/**
	 * 安装
	 *
	 * @param string $payment_code 支付类名
	 * @return unknown
	 */
	public static function install($payment_code)
	{
		if (!$isInit) self::_init($payment_code);
		return self::$cls_payment->install();
	}

	/**
	 * 卸载
	 *
	 * @param string $payment_code 支付类名
	 * @return unknown
	 */
	public static function uninstall($payment_code)
	{
		if (!$isInit) self::_init($payment_code);
		return self::$cls_payment->uninstall();
	}

	/**
	 * 初始化
	 *
	 * @param unknown_type $payment
	 */
	private function _init($payment_code)
	{
		//载入支付处理文件 例如：model/payment/yeepay.php
		include_once(PATH_TOOL . 'payment/channel/' . $payment_code . '.php');
		self::$cls_payment = s($payment_code);
		//判断支付类方法是否存在
		if (!method_exists($payment_code, 'get_code'))
		{
			throw new Exception("支付方式$payment_code不包含方法get_code");
		}
		if (!method_exists($payment_code, 'respond'))
		{
			throw new Exception("支付方式$payment_code不包含方法respond");
		}
	}

}
?>