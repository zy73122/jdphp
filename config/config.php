<?php

$config = array(
	//注册的应用列表 （这边添加后，后台的清理缓存会生效）
	'apps' => array(
		'appdemo', 'appdemo_small'
	),
	
	//日志记录
	'log' => array(
		'global' => PATH_DATA . 'logs/global.log', //clog默认日志路径
		'operation' => PATH_DATA . 'logs/operation.log', //数据库操作记录日志
		'exception' => PATH_DATA . 'logs/exception.log',
		'error' => PATH_DATA . 'logs/error.log',
		'error_log' => PATH_DATA . 'logs/phperr.log', // PHP错误记录日志
	),
	
	//路由相关配置
	'admin_dir' => 'admin1314', //后台目录
	'default_tplname' => 'default', //默认模板
	'default_controller' => 'index', //默认控制器
	'default_action' => 'index', //默认动作
	
	//数据库连接信息
	'database' => array(
		'default' => array( //主从从..
			array(
				'hostname'   => 'localhost',
				'port'   => 3306,
				'database'   => 'jdphp108',
				'username'   => 'root',
				'password'   => '1',
				'persistent' => false,
				'charset'	  => 'utf8',
				'table_prefix' => 'jd_',
			),
		 ),
		'yx' => array( //主从从..
			array(
				'hostname'   => 'localhost',
				'port'   => 3306,
				'database'   => 'yx',
				'username'   => 'root',
				'password'   => '1',
				'persistent' => false,
				'charset'	  => 'utf8',
				'table_prefix' => '',
			),
		 ),
	),
	
	//COOKIE相关
	'cookie'	=> array(
		'auth_key' 			=> 'auth3423',
		'cookie_path' 		=> '/', //Cookie路径
		'cookie_prefix' 	=> 'jdphp_',
		'cookie_domain'		=> '', //byy1.08
	),
		
	//SESSIO相关
	'session'	=> array(
		'save_handler'		=> 'files', //存储方式 files,memcache
		'save_path' 		=> PATH_DATA . 'session', //Session路径，
		//存储memcache例子
		//'save_handler'		=> 'memcache',
		//'save_path' 		=> 'tcp://host:port?persistent=1&weight=2&timeout=2&retry_interval=15,tcp://host2:port2',
	),
	
	//cache
	'cache'	=> array(
		//缓存类型
		'cachetype' => 'filecache', //memcache,memcached,apc,eacc,xcache,wincache,filecache
		//Memcache 服务器配置
		'memcache' => array(
			'servers' => array(
				array('127.0.0.1', 11211),
				array('127.0.0.1', 11211),
			),
		),
		//Memcached 服务器配置
		'memcached' => array(
			'servers' => array(
				array('127.0.0.1', 11211),
				array('127.0.0.1', 11211),
			),
			'persistent' => false,
		),
		//文件缓存设置
		'file' => array(
			'expire' => 3600, //s
			'path' => PATH_DATA . 'cache/', //缓存目录
		),
	),
	
	//tpl
	'tpl' => array(
		//'template_dir' => PATH_DATA . 'template/',
		//'compile_dir' => PATH_DATA . 'template_compiled/',
		//'cache_dir' => PATH_DATA . 'template_cache/',
		'left_delimiter' => '{{',
		'right_delimiter' => '}}',
		'caching' => false,
		'compile_check' => true,
	),
	
	//其他
	'installed' 			=> false,
	'table_prefix' 			=> 'jd_',
	'verify_code' 			=> true,
	'enable_rewrite' 		=> false,
	'enable_html' 			=> false,
	'debug_level' 			=> 1, //1,0
	'md5_key' 				=> '#&*$^!% ￣!^@', //md5密匙
	'language'				=> 'zhCN', //zhCN,enUS,zhTW
	'charset' 				=> 'utf-8', //utf-8,gbk,big5
	'page_rows' 			=> 15, // 分页
	'mysql_cache' 			=> false, //mysql缓存
	'eval_php_time' 		=> false, //计算页面的php解析时间
	'version' 				=> '1.08', //当前版本
	'update_url' 			=> 'http://localhost/jdphp1.08/update_server/', //升级地址

	//yx36
	'sdkurl' => array(
		//'prefix'=>"http://www.test.com/", //内网
		'prefix'=>"http://api.yx36.com/", //外网
	),
	
	
);
?>