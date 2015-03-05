<?php
return array(
	'eaction' => array(
		'get' => array(
			'id' => array(
				'not_empty' => null,
				'digit' => null,
				'min_length' => array(2),
				'range' => array(10, 15),
			),
		),
		'post' => array(
			'phone' => array(
				'not_empty' => null,
				'mobile' => null,
			),
		),
	),
);
