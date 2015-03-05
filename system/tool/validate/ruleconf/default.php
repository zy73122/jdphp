<?php

//参数验证规则
return array(
	'eaction_onget' => array(
		'id' => 'digit len:2-',
		'username' => 'string lenutf8:6-60 not_empty',
		'password' => 'string len:0-60 not_empty',
		'password2' => 'string string equal:$password',
		'email' => 'string email',
		'start' => 'int range:0- default:0',
		'pos' => 'uint range:1-100 default:10',
		'appid' => 'uintnz',
		'flag' => 'uint enum:1,2,3',
		'uids' => 'array count:0-50-uint',
	),
	'eaction_onpost' => array(
		'phone' => 'not_empty mobile',
	),
);
