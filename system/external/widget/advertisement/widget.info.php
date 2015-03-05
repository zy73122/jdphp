<?php 
return array (
  'id' => 'advertisement',
  'name' => '广告挂件',
  'desc' => '显示一个广告（包括图片广告、文字广告、代码广告和flash广告）',
  'version' => '1.0',
  'author' => 'yy',
  'website' => 'http://locahlhost', 
  'options' =>
  array (
	0 => 
	array (
	  'text' => '缓存时间',
	  'desc' => '',
	  'varname' => 'cache_time',
	  'default' => 60,
	),
	1 => 
	array (
	  'text' => '广告一',
	  'desc' => '',
	  'varname' => 'ad_img_url1',
	  'textarea' => true, //用<textarea ..>方式显示
	  'default' => '<a href="#"><img src="template/shop_laozihao/images/xads1.gif" /></a>',
	),
	2 => 
	array (
	  'text' => '广告二',
	  'desc' => '',
	  'varname' => 'ad_img_url2',
	  'textarea' => true, 
	  'default' => '<a href="#"><img src="template/shop_laozihao/images/xads2.gif" /></a>',
	),
	3 => 
	array (
	  'text' => '广告三',
	  'desc' => '',
	  'varname' => 'ad_img_url3',
	  'textarea' => true, 
	  'default' => '<a href="#"><img src="template/shop_laozihao/images/xads3.gif" /></a>',
	),
	4 => 
	array (
	  'text' => '广告四（文章页面）',
	  'desc' => '',
	  'varname' => 'ad_img_url4',
	  'textarea' => true, 
	  'default' => '<a href="#"><img src="template/shop_laozihao/images/xads4.jpg" width="210" /></a>',
	),
	5 => 
	array (
	  'text' => '广告五（文章页面）',
	  'desc' => '',
	  'varname' => 'ad_img_url5',
	  'textarea' => true, 
	  'default' => '<a href="#"><img src="template/shop_laozihao/images/xads5.jpg" width="210" /></a>',
	),
	6 => 
	array (
	  'text' => '广告六（文章页面）',
	  'desc' => '',
	  'varname' => 'ad_img_url6',
	  'textarea' => true, 
	  'default' => '<a href="#"><img src="template/shop_laozihao/images/xads5.jpg" width="730" height="60" /></a>',
	),
  ),
  'configurable'  => true,
);
?>