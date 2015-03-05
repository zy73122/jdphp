<?php
return array(
	'id' => 'samplemodule',
	'name' => '测试模块名称',
	'desc' => '这里是描述，该模块将安装表(specialpage)',
	'version' => '1.0',
	'author' => 'yy',
	'website' => 'http://locahlhost',
	'menu' => array(
		0 => array(
			'text' => '菜单一',
			'url' => '?m=samplemodule&a=index'
		),
		1 => array(
			'text' => '菜单二',
			'url' => '../?m=samplemodule&a=index'
		),
		2 => array(
			'text' => 'testEcho',
			'url' => '?m=samplemodule&a=testEcho'
		)
	),
	'install' => 'on'
);
?>