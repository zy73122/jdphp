module.info.php文件说明：

<?php 
return array (
  'id' => 'samplemodule',		//模块名
  'name' => language::get('samplemodule_name', PATH_MODULE . 'samplemodule/language/'),
  'desc' => language::get('samplemodule_desc'),
  'version' => '1.0',
  'author' => 'yy',
  'website' => 'http://locahlhost',
  'menu' => 				//后台菜单
  array (
    0 => 
    array (
      'text' => '菜单一',
      'url' => '?m=samplemodule&a=index',
    ),
    1 => 
    array (
      'text' => '菜单二',
      'url' => '?m=samplemodule&a=index',
	  'target' => '_blank',
    ),
  ),
  'install' => 'on',			//是否已安装。可用值：on,off
);
?>
