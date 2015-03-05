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

//重写Smarty ，错误处理函数
class MySmarty extends Smarty
{
	function trigger_error($error_msg, $error_type = E_USER_WARNING)
	{
		$spliter = 'unable to read resource: "';
		if (strpos($error_msg, $spliter) !== false)
		{
			$arr = explode($spliter, $error_msg);
			$error_msg = $arr[0] . $spliter . $this->template_dir . $arr[1];
		}
		$errcont = "Smarty error: $error_msg \n";
		echo ($errcont);
		cfile::write(PATH_DATA . 'logs/template_error.log', $errcont, 'ab');
	}
}

class tplcore
{
	protected $_smarty = null;
	protected $config;
	protected static $insts = array();
	
	/**
	 * 实例化
	 *
	 * @return object
	 */
	public static function instance($config = array('path' => PATH_TPLS_CUR), $name = null)
	{
		$config = !empty($config) ? $config : $GLOBALS['config']['tpl'];
		$name = empty($name) ? md5(json_encode($config)) : $name;
		if (empty(self::$insts[$name]))
		{
			self::$insts[$name] = new tplcore($config);
		}
		return self::$insts[$name];
	}
	
	public function __construct($config = array())
	{
		$this->config = $config;
		$path = $config['path'];
		
		$this->_smarty = s('MySmarty');
		//echo 'A|'.$this->_smarty->template_dir.'|'.$path ;;
		
/*			if (!file_exists($path))
		{
			$errcont = "模板目录".$path."找不到";
			echo($errcont);
			cfile::write(PATH_DATA . 'logs/template_error.log', $errcont, 'ab');
		}*/
		
		$this->_smarty->template_dir = $path;
		$this->_smarty->compile_dir = PATH_DATA.'template_compiled';
		$this->_smarty->cache_dir = PATH_DATA.'template_cache';

		$this->_smarty->left_delimiter = '{{';
		$this->_smarty->right_delimiter = '}}';
		$this->_smarty->caching = false;
//			$this->_smarty->caching = true; //默认缓存1个小时
//			$this->_smarty->cache_lifetime = 60;
		$this->_smarty->compile_check = true;
		
		if ($_GET['clear']==1)
		{
			//指定要清理原先的模板缓存
			$this->_smarty->clear_compiled_tpl();
			$this->_smarty->clear_all_cache();
		}
		
		//$this->_smarty->debugging = true;
		//$this->_smarty->load_filter('output', 'trimwhitespace');
		$this->_assign_base();
		
		//自定义smarty函数
		include_once('smarty_function.php');
	}	

	protected function _assign_base()
	{
		$this->_smarty->assign('url', URL);
		$this->_smarty->assign('url_admin', URL_ADMIN);
		$this->_smarty->assign('url_tpl', URL_TPL);
		$this->_smarty->assign('showcode', $_SESSION['showcode'] ? "1":"0");
		$this->_smarty->assign('domain', DOMAIN);
		$this->_smarty->assign('date_format', '%Y-%m-%d %H:%M');
		$this->_smarty->assign('date_format_ymd', '%Y-%m-%d');				
	}
	
	public function getsmarty()
	{
		return $this->_smarty;
		
	}
}

class tpl
{
	public static $_smarty;
	protected $path;
	public static function init($path = PATH_TPLS_CUR)
	{
		$config = array('path' => $path);
		self::$_smarty = tplcore::instance($config)->getsmarty();
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
		$path = self::fetchtpldir();
		self::init($path);
		self::$_smarty->assign($tpl_var, $value);
	}

	public static function display($tpl, $cache_id=null, $compile_id=null, $default_tpl_dir=null)
	{
		$path = self::fetchtpldir($default_tpl_dir);
		self::init($path);
		self::$_smarty->display($tpl, $cache_id , $compile_id);
	}

	public static function fetch($tpl, $cache_id=null, $compile_id=null)
	{
		$path = self::fetchtpldir();
		self::init($path);
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