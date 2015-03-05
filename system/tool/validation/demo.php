<?php
//建议废弃，改用validate

define('JDPHP_MAKER', 1);
define('PATH_APP', realpath('./').'/');
require 'validation.php';

//example1:
$errmsg = validation::instance('example', 'eaction', $_SERVER['REQUEST_METHOD'], $_REQUEST)->validate();
if (!empty($errmsg)) {
	print_r($errmsg);exit;
}

//example2:
$validation = validation::instance('example', 'eaction', $_SERVER['REQUEST_METHOD']);
$validata = $_SERVER['REQUEST_METHOD'] == 'GET' ? $_GET : $_POST;
//获取验证错误信息的第一条
$errmsg = $validation->validate($validata);
if (!empty($errmsg)) {
	print_r($errmsg);exit;
}
?>