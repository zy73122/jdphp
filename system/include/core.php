<?php
/**
 * 框架核心类
 *
 */
class core
{
	//保存autoload单例
	public static $inst_autoload = array();
	//保存单例
	public static $inst_singleton = array();

	/**
	 * 框架开始运行
	 */
	public static function init($autorun = true)
	{
		/**
		 * 动态加载类
		 */
		spl_autoload_register('core::autoload', '.php');

		/**
		 * 错误控制1 捕获Fatal error
		 */
		register_shutdown_function('core::fatal_error');

		/**
		 * 初始化变量与常量 获取并定义配置文件中的配置
		 */
		$GLOBALS['config'] = glb::$config = config::get();
		self::_init_constant();

		/**
		 * session初始化
		 */
		ini_set('session.save_path', PATH_SESSION); //session保存路径
		ini_set('session.save_handler', SESSION_HANDLER); //session存储方式
		session_start();

		/**
		 * 时区定义
		 */
		date_default_timezone_set('PRC');

		/**
		 * PHP错误日志
		 */
		ini_set('error_log', ERROR_LOG); // PHP错误记录日志
		ini_set('log_errors', '1');

		/**
		 * 错误控制
		 */
		if (DEBUG_LEVEL)
			error_reporting(ERROR_LEVEL);
		else
			error_reporting(0);

		/**
		 * 设置默认utf8编码
		 */
		header("content-type:text/html; charset=utf-8");

		/**
		 * 初始化变量与常量 获取并定义数据库中的配置
		 */
		$GLOBALS['dbconfig'] = s("m_config")->get_configs();
		if (isset($GLOBALS['config']['dbconfig']))
		{
			//支持在配置文件中覆盖数据库的配置
			$GLOBALS['dbconfig'] = array_merge($GLOBALS['dbconfig'], $GLOBALS['config']['dbconfig']);
		}
		self::_init_constant_from_other();

		/**
		 * 错误控制2
		 */
		set_error_handler('core::error_handler', ERROR_LEVEL);
		set_exception_handler('core::exception_handler');

		/**
		 * 初始化完毕，开始运行当前控制器的工作
		 */
		if ($autorun)
		{
			self::_run();
		}
	}

	/**
	 * 动态加载类
	 */
	public static function autoload($classname)
	{
		if (!class_exists($classname, false))
		{
			if (substr($classname, 0, 5) == 'm_ex_') //模块模型
			{
				require_once(PATH_SYSTEM.'include/base_model.php');
				require_once(PATH_SYSTEM.'include/base_modelex.php');
				$classfile = $classname . '.php';
				if (is_file(PATH_EXTERNAL_MODEL . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_EXTERNAL_MODEL . $classfile);
				}
				else
				{
					throw new Exception('找不到模型 ' . $classname);
				}
			}
			else if (substr($classname, 0, 2) == 'm_') //模型
			{
				require_once(PATH_SYSTEM.'include/base.php');
				require_once(PATH_SYSTEM.'include/base_model.php');
				$classfile = $classname . '.php';
				if (is_file(PATH_MODEL_APP . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_MODEL_APP . $classfile);
				}
				else if (is_file(PATH_MODEL_BACK . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_MODEL_BACK . $classfile);
				}
				else if (is_file(PATH_MODEL_CORE . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_MODEL_CORE . $classfile);
				}
				else
				{
					throw new Exception('找不到模型 ' . $classname);
				}
			}
			else if (substr($classname, 0, 2) == 'c_') //控制器
			{
				require_once(PATH_SYSTEM.'include/base.php');
				require_once(PATH_SYSTEM.'include/base_controller.php');
				$classfile = $classname . '.php';
				if (is_file(PATH_CONTROLLER . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_CONTROLLER . $classfile);
				}
				else
				{
					throw new Exception('找不到控制器 ' . $classname);
				}
			}
			else if (substr($classname, 0, 7) == 'module_') //模型
			{
				require_once(PATH_SYSTEM.'include/base_module.php');
				$classmodule = substr($classname, 7);
				$position = defined('IN_BACKGROUND') ? 'back' : 'front'; //执行前台或后台的模块 (front or back
				$path_module = PATH_MODULE . "$classmodule/$position.module.php"; //与后台区别
				if (file_exists($path_module))
				{
					self::$inst_autoload[] = $classname;
					require_once($path_module);
					//require_once(PATH_MODEL_CORE . 'm_ex_'.$classmodule.'.php');
				}
				else
				{
					throw new Exception("模块：$classmodule 不存在！");
				}
			}
			else if (substr($classname, 0, 7) == 'widget_') //挂件
			{
				$classwidget = substr($classname, 7);
				$path_widget = PATH_WIDGET . "$classwidget/main.widget.php";
				if (file_exists($path_widget))
				{
					self::$inst_autoload[] = $classname;
					require_once($path_widget);
				}
				else
				{
					throw new Exception("挂件：$classwidget 不存在！");
				}
			}
			else //工具类
			{
				$classfile = $classname . '.php';
				if (is_dir(PATH_TOOL . $classname) && is_file(PATH_TOOL . $classname . '/' . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_TOOL . $classname . '/' . $classfile);
				}
				else if (is_file(PATH_TOOL . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_TOOL . $classfile);
				}
				else
				{
					throw new Exception('找不到工具类 ' . $classname);
				}
			}
	/*		else if (substr($classname, 0, 2) == 't_') //工具类
			{
				$classname = substr($classname, 2);
				$classfile = $classname . '.php';
				if (is_dir(PATH_TOOL . $classname) && !is_file(PATH_TOOL . $classname . '/' . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_TOOL . $classname . '/' . $classfile);
				}
				else if (is_file(PATH_TOOL . $classfile))
				{
					self::$inst_autoload[] = $classname;
					require_once(PATH_TOOL . $classfile);
				}
				else
				{
					throw new Exception('找不到工具类 ' . $classname);
				}
			}*/

		}
	}


	/**
	 * 初始化常量1
	 */
	public static function _init_constant()
	{
		//后台目录名
		define('ADMIN', glb::$config['admin_dir']); //admin
		define('PATH_APP_BASEDIR',	glb::$config['app_basedir']); //应用程序根目录
		
		//初始化其他常量
		define('DEF_TPLNAME', 		glb::$config['default_tplname']); //default
		define('DEF_CONTROLLER', 	glb::$config['default_controller']);
		define('DEF_ACTION', 		glb::$config['default_action']);
		define('VIRTUAL_DIR', 		url::get_virtual_dir()); //虚拟目录
		define('VIRTUAL_DIR_FISRT', url::get_virtual_dir_fisrt()); //虚拟目录
		define('URL_BASE_ROOT', 	url::get_base_url()); //Example:http://www.jdphp.com/
		define('URL_BASE', 			URL_BASE_ROOT . VIRTUAL_DIR); //Example:http://www.jdphp.com/trunk/
		define('TPL_URL', 			URL_BASE . PATH_APP_BASEDIR . 'template/'.DEF_TPLNAME.'/'); //Example:http://www.jdphp.com/trunk/admin1314/template/default/
		//define('JS_URL', URL_BASE . 'static/js/');
		//define('CSS_URL', URL_BASE . 'static/css/');
		//define('IMG_URL', URL_BASE . 'static/images/');

		define('PATH_MODEL_BACK', 		PATH_ROOT . ADMIN . '/model/');

		//define('PATH_CONTROLLER_CORE', PATH_ROOT . 'controller/');
		define('PATH_MODEL_CORE', 		PATH_SYSTEM . 'model/');
		define('PATH_DATA_CORE', 		PATH_ROOT . 'data/');
		
		define('PATH_CONTROLLER_APP', 	PATH_APP . 'controller/');
		define('PATH_MODEL_APP', 		PATH_APP . 'model/');
		define('PATH_DATA_APP', 		PATH_APP . 'data/');

		define('PATH_EXTERNAL', 		PATH_SYSTEM . 'external/');
		define('PATH_EXTERNAL_MODEL', 	PATH_EXTERNAL . 'model/');
		define('PATH_PLUGIN', 			PATH_EXTERNAL . 'plugin/');
		define('PATH_MODULE', 			PATH_EXTERNAL . 'module/');
		define('PATH_WIDGET', 			PATH_EXTERNAL . 'widget/');

		//COOKIE相关
		define('AUTH_KEY', $GLOBALS['config']['cookie']['auth_key']);
		define('PATH_COOKIE',  $GLOBALS['config']['cookie']['cookie_path']); //Cookie路径
		define('COOKIE_PREFIX',  $GLOBALS['config']['cookie']['cookie_prefix']);
		define('COOKIE_DOMAIN',  $GLOBALS['config']['cookie']['cookie_domain'] ? $GLOBALS['config']['cookie']['cookie_domain'] : null);
		//SESSION相关
		define('PATH_SESSION', $GLOBALS['config']['session']['save_path']); //Session路径
		define('SESSION_HANDLER', $GLOBALS['config']['session']['save_handler']); //

		define('ERROR_LOG', $GLOBALS['config']['log']['error_log']);
		define('VAR_MD5KEY', $GLOBALS['config']['md5_key']);
		define('INSTALLED', $GLOBALS['config']['installed']); //是否已经安装
		define('PAGE_ROWS', $GLOBALS['config']['page_rows']); // 分页
		define('LANGUAGE', $GLOBALS['config']['language'] ? $GLOBALS['config']['language'] : 'zhCN');
		define('CHARSET', $GLOBALS['config']['charset']);

		define('MYSQL_CACHE', $GLOBALS['config']['mysql_cache']); //mysql缓存
		define('EVAL_PHP_TIME', $GLOBALS['config']['eval_php_time']); //计算页面的php解析时间
		define('CUR_VERSION', $GLOBALS['config']['version']);
		define('SOURCE_URL', $GLOBALS['config']['update_url']);
	}

	/**
	 * 运行当前控制器的工作
	 */
	public static function _run()
	{
		self::_write_run_log("系统开始==============================".url::get_current_url()."\n");

		/**
		 * 计算页面的php解析时间 - 记录开始时间
		 */
		if (EVAL_PHP_TIME) tool::evaltime_start();

		/**
		 * 实例化模板引擎
		 */
		//tplcore::instance();

		/**
		 * 自动转义、安全过滤
		 */
		common::chk_request_data();

		/**
		 * 安全防护
		 */
		defend::start();

		/**
		 * 计划任务
		 */
		s("m_plan")->check_plan();
		
		/**
		 * mysql缓存
		 */
		if (MYSQL_CACHE)
		{
			$d = db::instance()->getrow("show variables like 'query_cache_type%'");
			if ($d["Value"]!="ON")
			{
				//query_cache_type值：
				//0-表示缓存已关闭
				//1(ON)-代表缓存开启缓存除了使用sql_no_cache的所有语句。
				//2(DEMAND)-表示根据自己需要来决定此语句是否使用缓存，仅对以SELECT SQL_CACHE开始的那些查询语句启用缓存
				db::instance()->query("set query_cache_type = 1");
				db::instance()->query("set global query_cache_size = 104857600");//100M
				db::instance()->query("set global query_cache_limit = 2097152");//2M
			}
		}

		/**
		 * 启用一个带有ob_gzip压缩机的工作台
		 */
		if ($GLOBALS['dbconfig']['cf_obstart'])
		ob_start(array(tool, 'ob_gzip'));

		/**
		 * 开始控制器
		 */
		self::_router();

		/**
		 * 计算页面的php解析时间 - 输出时间
		 */
		if (EVAL_PHP_TIME) echo "<br>该页面PHP解析时间：" . tool::evaltime_end().'ms';

		/**
		 * 输出压缩成果
		 */
		if ($GLOBALS['dbconfig']['cf_obstart'])
		ob_end_flush();

		self::_write_run_log("系统结束==============================\n\n");
	}

	/**
	 * 路由转发
	 */
	public static function _router()
	{
		if (isset($_GET['m']) && $_GET['m'])
		{
			$controller = (isset($_GET['m'])&&$_GET['m']) ? $_GET['m'] : null;
			$action = (isset($_GET['a'])&&$_GET['a']) ? $_GET['a'] : DEF_ACTION;
			glb::$controller = $controller;
			glb::$action = $action;

			$controllername = 'module_' . $controller;
			if (!$ctl_module = s($controllername))
			{
			}
			if (!method_exists($controllername, $action))
			throw new Exception("模块方法：$controllername::$action 不存在！");
			if (method_exists($controllername, 'pre'))
			{
				$ctl_module->pre();
			}
			plugin::run_module_plugin($controllername, $action, 'pre');//调用插件
			$ctl_module->$action();
			plugin::run_module_plugin($controllername, $action, 'post');//调用插件
			if (method_exists($controllername, 'post'))
			{
				$ctl_module->post();
			}
		}
		else if (isset($_GET['w']) && $_GET['w'])
		{
			$controller = (isset($_GET['w'])&&$_GET['w']) ? $_GET['w'] : null;
			$action = (isset($_GET['a'])&&$_GET['a']) ? $_GET['a'] : DEF_ACTION;
			glb::$controller = $controller;
			glb::$action = $action;

			$controllername = 'widget_' . $controller;
			if (!$ctl_widget = s($controllername))
			{
			}

			if (!method_exists($controllername, $action))
			throw new Exception("模块方法：$controllername::$action 不存在！");
			if (method_exists($controllername, 'pre'))
			{
				$ctl_widget->pre();
			}
			$ctl_widget->$action();
			if (method_exists($controllername, 'post'))
			{
				$ctl_widget->post();
			}
		}
		else if (isset($_GET['c']) && $_GET['c'])
		{
			$controller = (isset($_GET['c'])&&$_GET['c']) ? $_GET['c'] : DEF_CONTROLLER;
			$action = (isset($_GET['a'])&&$_GET['a']) ? $_GET['a'] : DEF_ACTION;
			glb::$controller = $controller;
			glb::$action = $action;
			$method = $_SERVER['REQUEST_METHOD'];

			$controllername = 'c_'.$controller;
			$c_inst = s($controllername); //, $arg1, $arg2
			if (method_exists($c_inst, 'pre')) {
				$c_inst->pre();
			}
			plugin::run_controller_plugin($controllername, $action, 'pre');//调用插件
			//增加 action_onpost 支持
			if (method_exists($c_inst, $action.'_on'.$method))
			{
				$action = $action.'_on'.$method;
				$ret = $c_inst->$action();
			}
			else 
			{
				$ret = $c_inst->$action();
			}
			plugin::run_controller_plugin($controllername, $action, 'post');//调用插件
			if (method_exists($c_inst, 'post')) {
				$c_inst->post();
			}
			//如果是ajax提交时，返回json格式
			if ($ret)
			{
				rest::sendResponse(200, $ret, isset($_GET['ajax']) ? true : false);
			}
		} else {
			$rdata = url::parse($_SERVER['REQUEST_URI'], DEF_CONTROLLER, DEF_ACTION);
			$controller = $rdata[0];
			$action = $rdata[1];
			$arg1 = $rdata[2];
			$arg2 = $rdata[3];
			glb::$controller = $controller;
			glb::$action = $action;

			$controllername = 'c_'.$controller;
			$c_inst = s($controllername); //, $arg1, $arg2
			if (method_exists($c_inst, 'pre')) {
				$c_inst->pre();
			}
			$c_inst->$action($arg1, $arg2);
			if (method_exists($c_inst, 'post')) {
				$c_inst->post();
			}
		}
	}

	public static function _init_constant_from_other()
	{
		$dbconfig = $GLOBALS['dbconfig'];
		/*
		$u = $dbconfig['cf_sysurl']; //废弃
		$d = preg_match("|http://(.*)|i", $u, $match);
		define('URL', 					$u);
		define('DOMAIN', 				$d ? $match[1] : $_SERVER['HTTP_HOST']); //example:www.xx.com
		define('URL_ADMIN',				URL . ADMIN . '/');
		*/
		$d = preg_match("|http://(.*)|i", URL_BASE, $match);
		define('URL', 					URL_BASE); //http://www.jdphp.com/trunk/
		define('DOMAIN', 				$d ? $match[1] : $_SERVER['HTTP_HOST']); //example:www.xx.com
		define('URL_ADMIN',				URL_BASE . ADMIN . '/');
		define('URL_BASE_SHORT_ROOT',		VIRTUAL_DIR);
		define('URL_BASE_SHORT_APP',		VIRTUAL_DIR . PATH_APP_BASEDIR); //Example:/trunk/appdemo/
		define('URL_ADMIN_SHOT',		VIRTUAL_DIR . ADMIN . '/'); //Example:/trunk/admin1314/

		//设置配置到数据库
		$set = array();
		if (!empty($_GET['dirtpladmin']))
		{
			$set['cf_dirtpladmin'] = $_GET['dirtpladmin'];
		}
		if (!empty($_GET['dirtplmain']))
		{
			$set['cf_dirtplmain'] = $_GET['dirtplmain'];
		}
		if (!empty($set))
		{
			s("m_config")->set_configs($set);
			$dbconfig = $GLOBALS['dbconfig'] = array_merge($dbconfig, $set);
		}

		//模板目录
		define('PATH_TPLS_ADMIN_ROOT', 		PATH_ROOT . ADMIN . '/template/');
		$dirtpladmin = $dbconfig['cf_dirtpladmin'];
		$dirtplmain = $dbconfig['cf_dirtplmain'] ? $dbconfig['cf_dirtplmain'] : DEF_TPLNAME;
		if (defined('IN_BACKGROUND') && IN_BACKGROUND == 1) //当前使用的模板目录
		{
			define('PATH_TPLS_CUR',			PATH_APP . 'template/' . $dirtpladmin . '/');
			define('URL_TPL', 				URL_ADMIN . 'template/' . $dirtpladmin . '/');
			define('URL_TPL_SHORT_APP', 		URL_BASE_SHORT_APP . 'template/' . $dirtpladmin . '/');
		}
		else
		{
			define('PATH_TPLS_CUR',			PATH_APP . 'template/' . $dirtplmain . '/');
			define('URL_TPL', 				TPL_URL); //Example:http://www.jdphp.com/trunk//appdemo/template/default/
			define('URL_TPL_SHORT_APP', 		URL_BASE_SHORT_APP . 'template/' . $dirtplmain . '/');
		}
		
		$path_tpls_back = PATH_TPLS_ADMIN_ROOT . $dirtpladmin . '/';
		define('PATH_TPLS_BACK', 		$path_tpls_back);
		define('PATH_TPLS_CURAPP', 		PATH_TPLS_CUR);
		//如果存在公共文件夹，则设为默认模板目录
		$path_tpls_common_back = realpath($path_tpls_back . '../common/');
		define('PATH_TPLS_COMMON_BACK', 		file_exists($path_tpls_common_back) ? $path_tpls_common_back . '/' : '');
		$path_tpls_curapp_common = realpath(PATH_TPLS_CUR . '../common/');
		define('PATH_TPLS_CURAPP_COMMON', 		file_exists($path_tpls_curapp_common) ? $path_tpls_curapp_common . '/' : '');

		define('VERIFY_CODE',			$dbconfig['cf_verify_code'] && function_exists('gd_info'));// 启用验证码
		define('ENABLE_REWRITE',		$GLOBALS['config']['enable_rewrite']);// 启用伪静态
		define('ENABLE_HTML',			$GLOBALS['config']['enable_html']);// 启用静态
		//define('DEBUG_LEVEL',			$dbconfig['cf_debug'));// 可用值:1,0


		//上传设置
		define('WATERMARK_SWITCH',		$dbconfig['cf_watermark_switch']); //水印开关
		define('WATERMARK_POS',			$dbconfig['cf_watermark_pos']); //水印位置
		define('UPLOAD_SWITCH',			$dbconfig['cf_upload_switch']); //上传开关
		define('UPLOAD_ALLOW_TYPE',		$dbconfig['cf_upload_allow_type']); //允许上传的格式


		//从数组文件中获取配置

		//从缓存读取配置信息
		$arrayfiles = cfile::ls(PATH_APP . 'data/arrayfile', 'file');
		if ($arrayfiles)
		{
			foreach ($arrayfiles as $onefile)
			{
				$arrayfile = new arrayfile(PATH_APP . 'data/arrayfile/' . $onefile);
				$confData = $arrayfile->getAll();
				$var_name = str_replace(".php", "", $onefile);
				$GLOBALS[$var_name] = array();
				foreach ($confData as $key=>$value)
				{
					$GLOBALS['config'][$var_name][$key] = $value;
				}
			}
		}
		unset($arrayfiles);
	}

	/**
	 * 捕获fatal错误
	 *
	 */
	public static function fatal_error()
	{
		if(is_null($e = error_get_last()) === false)
		{
			if($e['type'] == 1){
				$msgstr = "[Fatal] {$e['message']} {$e['file']}[{$e['line']}]";
				trigger_error($msgstr, E_USER_ERROR);
			}
		}
	}

	public static function exception_handler($e)
	{
		$config = glb::$config;
		$errcont = "[EXC] " . $e->getMessage() . "\n " . $e->getFile() . "[" . $e->getLine() . "] Errno:" . $e->getCode() . "\n" . $e->getTraceAsString();
		clog::write($errcont, $config['log']['exception']);
		if (DEBUG_LEVEL)
		{
			echo '<pre>';
			echo $errcont;
			echo '</pre>';
		}
		exit;
	}

	public static function error_handler($errno, $errstr, $errfile, $errline)
	{
		if (!(error_reporting() & $errno)) {
			// This error code is not included in error_reporting
			return;
		}

		$config = glb::$config;
		//记日志
		$errcont = "[ERR] " . $errstr . " " . $errfile . "[" . $errline . "] Errno:" . $errno;
		clog::write($errcont, $config['log']['error']);
		//提示
		if (DEBUG_LEVEL)
		{
			$debug_trace = debug_backtrace();
			array_shift($debug_trace);
			$errcont = "[ERR] " . $errstr . " \n" . $errfile . "[" . $errline . "] Errno:" . $errno . "\n";
			foreach ($debug_trace as $k=>$row)
			{
				$row['class'] = isset($row['class']) ? $row['class'] : '';
				$row['type'] = isset($row['type']) ? $row['type'] : '';
				$row['file'] = isset($row['file']) ? $row['file'] : '';
				$row['line'] = isset($row['line']) ? $row['line'] : '';
				$row['function'] = isset($row['function']) ? $row['function'] : '';
				if (!empty($row['file']))
				$errcont .= "#{$k} {$row['file']}:[{$row['line']}] {$row['class']}{$row['type']}{$row['function']}()\n";
				else
				$errcont .= "#{$k} {$row['class']}{$row['type']}{$row['function']}()\n";
			}
			echo '<pre>';
			echo $errcont;
			echo '</pre>';
		}
		exit;
	}

	/**
	 * 记录框架运行时间
	 */
	private static function _write_run_log($msg)
	{
		if (DEBUG_LEVEL)
		{
			$fp = fopen(PATH_DATA . 'logs/jdphp.log', 'ab');
			if ($fp)
			{
				$msg = tool::microtime_string() . $msg;
				fwrite($fp, $msg);
				fclose($fp);
			}
		}
	}

	/**
	 * 计算页面的php解析时间 - 记录开始时间
	 *
	 * 示例：
		 tool::evaltime_start();
		 echo "<br>该模块解析时间：" . tool::evaltime_end().'ms';
	 */
	private static function evaltime_start()
	{
		$GLOBALS['config']['time_start'] = $this->microtime_float();
	}

	/**
	 * 计算页面的php解析时间 ms
	 */
	private static function evaltime_end()
	{
		$GLOBALS['config']['time_end'] = $this->microtime_float();
		$timediff = number_format(($GLOBALS['config']['time_end'] - $GLOBALS['config']['time_start']) * 1000, 2, '.', '') ;
		$GLOBALS['config']['time_start'] = $this->microtime_float();
		return $timediff;
	}

	/**
	 * 获取系统时间-微秒
	 *
	 * @return float
	 */
	private static function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	/**
	 * 获取单例
	 */
	public static function getSingleton($classname, $arg1=null, $arg2=null, $arg3=null, $arg4=null)
	{
		$flag = $classname.md5(serialize($arg1).serialize($arg2).serialize($arg3).serialize($arg4));
		if (!isset(self::$inst_singleton[$flag]) || empty(self::$inst_singleton[$flag]))
		{
			if (!class_exists($classname))
			{
				throw new Exception('类找不到'.$classname);
			}
			self::$inst_singleton[$flag] = new $classname($arg1, $arg2, $arg3, $arg4);
		}
		return self::$inst_singleton[$flag];
	}
}

?>