<?php
/**
 * 语言测试
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_lang
{

	function index()
	{
		self::php_lang();
	}


	/**
	 * js方式调用语言
	 */
	public function js_lang()
	{
		try
		{		
			$lang = language::load(substr(__CLASS__, 3).'.lang.php');
			//定义js语言
			language::js_lang($lang);
			
			//调用js语言方式有两种：1、lang.key 2、lang.get('key')
			echo '<script>';
			echo 'alert(lang.get("owner_name"));';
			echo '</script>';			
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}


	/**
	 * php方式调用语言
	 */
	public function php_lang()
	{
		try
		{
			//载入语言文件
			$lang = language::load(substr(__CLASS__, 3).'.lang.php');
			tpl::assign('lang', $lang);
			var_dump($lang);
			
			//获取某个单词的语言
			$s = language::get('input_store_info'); //默认语言在config.php中定义 既：LANGUAGE
			$s = language::get('mail_send_succeed', null, 'zhCN');
			$s = language::get('mail_send_succeed', null, 'enUS');
			var_dump($s);
	
			//指定language目录
			$s = language::get('input_store_info', PATH_ROOT.'language/', 'zhTW');
			var_dump($s);
			
			
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}
	
	/**
	 * pre钩子方法
	 */
	public function pre()
	{
		try
		{			
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
		try
		{
			tpl::display(substr(__CLASS__, 2).'.tpl');
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}


}
?>