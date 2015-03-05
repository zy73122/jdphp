<?php
return array(
	'eaction' => array(					   //action
		'get' => array(					   //method
			'id' => array(					//var
				'digit' => 'id必须是数字',	 //validmethod => onerule
				'not_empty' => 'id不能为空',
				'min_length' => 'id长度至少为%d',
				'range' => 'id大小范围%d,%d',
			),
		),
		'post' => array(
			'phone' => array(
				'not_empty' => 'phone不为空',
				'mobile' => 'phone必须是手机格式',
			),
		),
	),
);
