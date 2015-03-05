<?php

define('JDPHP_MAKER', 1);
require 'validate.php';

//example1:
//http://www.jdphp.com/system/tool/validate/demo.php?id=2
$rulefile = dirname(__FILE__) . '/' . 'ruleconf/default';
$rulekey = 'eaction' . '_on' . strtolower($_SERVER['REQUEST_METHOD']);
$validation = validate::instance($rulefile, $rulekey);
$firtmsg = $validation->validate($_REQUEST);
$allmsg = $validation->get_valid_result();
if (!empty($firtmsg)) {
	echo '<h3>所有的错误：</h3>';
	print_r($allmsg);
	echo '<h3>第一个错误：</h3>';
	print_r($firtmsg);
	echo '<h3>最终得到值：</h3>';
	print_r($_REQUEST);
	exit;
} 

//example2:
//http://www.jdphp.com/system/tool/validate/demo.php?id=2
$validation = validate::instance($rulefile, $rulekey, $_REQUEST);
$firtmsg = $validation->validate();
$allmsg = $validation->get_valid_result();

?>