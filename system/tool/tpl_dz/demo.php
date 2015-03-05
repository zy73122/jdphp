<?php
define('PATH_TPLS_CUR', realpath('./').'/view/default/'); //模板目录
define('PATH_DATA', realpath('./').'/view/'); //输出文件目录
require_once 'tpl_dz.php';

$applist = array(
	't1' => 'php', 
	't2' => 'css',
);

$view = new tpl_dz();
$view->assign('status', 105);
$view->assign('choose', 1);
$view->assign('applist', $applist);
$view->display('demo');

?>