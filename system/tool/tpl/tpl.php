<?php
/**
 * Smarty 模板引擎
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */

defined('JDPHP_MAKER') || exit('Forbidden');
require_once('Smarty.class.php'); //smarty

class tplcore
{
	protected static $config;
	protected static $smarty;
	protected static $insts = array();
		
	/**
	 * 实例化
	 *
	 * @return object smarty句柄
	 */
	public static function instance($config = array('path' => PATH_TPLS_CUR), $name = null)
	{
		$config = !empty($config) ? $config : $GLOBALS['config']['tpl'];
		$name = empty($name) ? md5(serialize($config)) : $name;
		if (empty(self::$insts[$name]))
		{
			$smarty = new Smarty();
			self::$config = $config;
			$path = $config['path'];
			if (!file_exists($path))
			{
				throw new Exception("模板路径不存在($path)");
			}
			
			$smarty->template_dir = $path;
			$smarty->compile_dir = PATH_DATA.'template_compiled';
			$smarty->cache_dir = PATH_DATA.'template_cache';
	
			$smarty->left_delimiter = '{{';
			$smarty->right_delimiter = '}}';
			$smarty->caching = false;
			//$smarty->caching = true; //默认缓存1个小时
			//$smarty->cache_lifetime = 60;
			//$smarty->debugging = true;
			//$smarty->load_filter('output', 'trimwhitespace');
			$smarty->compile_check = true;
			
			if ($_GET['clear']==1)
			{
				//指定要清理原先的模板缓存
				$smarty->clear_compiled_tpl();
				$smarty->clear_all_cache();
			}
			
			self::assign_base($smarty);
			
			//自定义smarty函数
			include_once('smarty_function.php');
			
			self::$smarty = $smarty;
			self::$insts[$name] = $smarty;
		}
		return self::$insts[$name];
	}
	
	protected static function assign_base(& $smarty)
	{
		//长地址
		//$smarty->assign('url', URL_BASE);
		//$smarty->assign('url_admin', URL_ADMIN);
		//$smarty->assign('url_tpl', URL_TPL);
		//改用短地址
		$smarty->assign('url', URL_BASE_SHORT_ROOT);
		$smarty->assign('url_app', URL_BASE_SHORT_APP);
		$smarty->assign('url_admin', URL_ADMIN_SHOT); 
		$smarty->assign('url_tpl', URL_TPL_SHORT_APP);
		$smarty->assign('showcode', $_SESSION['showcode'] ? "1":"0");
		$smarty->assign('domain', DOMAIN);
		$smarty->assign('date_format', '%Y-%m-%d %H:%M');
		$smarty->assign('date_format_ymd', '%Y-%m-%d');				
	}
}
//
////重写Smarty ，错误处理函数
//class MySmarty extends Smarty
//{
//	function trigger_error($error_msg, $error_type = E_USER_WARNING)
//	{
//		$spliter = 'unable to read resource: "';
//		if (strpos($error_msg, $spliter) !== false)
//		{
//			$arr = explode($spliter, $error_msg);
//			$error_msg = $arr[0] . $spliter . $this->template_dir . $arr[1];
//		}
//		$errcont = "Smarty error: $error_msg \n";
//		echo ($errcont);
//		cfile::write(PATH_DATA . 'logs/template_error.log', $errcont, 'ab');
//	}
//}

class tpl
{
	protected $path;
	public static $_smarty;
	public static $tpl_vars = array();
	public static function init($path = PATH_TPLS_CUR)
	{
		$config = array('path' => $path);
		self::$_smarty = tplcore::instance($config);
	}
	
	public static function fetchtpldir($default_tpl_dir = null)
	{
		$path = empty($default_tpl_dir) ? PATH_TPLS_CUR : $default_tpl_dir;
		//如果存在公共文件夹，则设为默认模板目录
		$pathcommon = realpath($path . '../common/');
		if (file_exists($pathcommon))
		$path = $pathcommon;
		return $path;
	}
	
	public static function assign($tpl_var, $value)
	{
		//$path = self::fetchtpldir();
		//self::init($path);
		//self::$_smarty->assign($tpl_var, $value);
		self::$tpl_vars[$tpl_var] = $value;
	}

	public static function display($tpl, $cache_id=null, $compile_id=null, $default_tpl_dir=null)
	{
		$path = self::fetchtpldir($default_tpl_dir);
		self::init($path);
		foreach (self::$tpl_vars as $key => $val)
		{
			self::$_smarty->assign($key, $val);
		}
		self::$tpl_vars = array();
		self::$_smarty->display($tpl, $cache_id , $compile_id);
	}

	public static function fetch($tpl, $cache_id=null, $compile_id=null)
	{
		$path = self::fetchtpldir();
		self::init($path);
		foreach (self::$tpl_vars as $key => $val)
		{
			self::$_smarty->assign($key, $val);
		}
		self::$tpl_vars = array();
		return self::$_smarty->fetch($tpl, $cache_id , $compile_id);
	}
	
	public static function clear_cache($tpl, $cache_id=null, $compile_id=null)
	{
		$path = self::fetchtpldir();
		self::init($path);
		return self::$_smarty->clear_cache($tpl, $cache_id , $compile_id);
	}
	public static function clear_compiled_tpl($tpl=null)
	{
		$path = self::fetchtpldir();
		self::init($path);
		return self::$_smarty->clear_compiled_tpl($tpl);
	}
	public static function clear_all_cache()
	{
		$path = self::fetchtpldir();
		self::init($path);
		return self::$_smarty->clear_all_cache();
	}
}
?>