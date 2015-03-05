<?php
define('PATH_ROOT', 		realpath('../') . '/'); //后台和前台区别
define('PATH_APP', 			realpath('./') . '/'); //应用程序根目录
define('PATH_SYSTEM', 		PATH_ROOT . 'system/');
define('PATH_TOOL', 		PATH_SYSTEM . 'tool/');
define('PATH_CONTROLLER', 	PATH_APP . 'controller/');
define('PATH_MODEL', 		PATH_APP . 'model/');
define('PATH_DATA', 		PATH_APP . 'data/');
define('ERROR_LEVEL',		E_ALL ^ E_NOTICE); //E_ERROR | E_STRICT
define('DEBUG_LEVEL',		1);// 可用值:1,0
define('JDPHP_MAKER', 		1);

require(PATH_SYSTEM . 'include/common.php');
require(PATH_SYSTEM . 'include/core.php');
require(PATH_SYSTEM . 'include/glb.php');
require(PATH_ROOT . 'config/config.php');
require(PATH_APP . 'config/config_app.php');

//框架开始运行
core::init();

?>