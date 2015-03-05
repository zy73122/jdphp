
main.plugin.php方法：
1、pre
2、post


//控制器插件 plugin.info.php定义
return array (
  'id' => 'samplecontrollerplugin',
  'install' => 'off',			//插件文件夹名， 前面加"plugin_"后就是插件类名字
  'controller' => 'c_test_file',	//可取值：on,off
  'action' => 'index',			//controller
  'name' => '这是一个测试控制器插件',	//action
  'desc' => '该插件作用于c_test_file::index.<a href="../index.php?c=test_file">测试</a>',
  'author' => 'yy',
  'version' => '1.0',
);


//模块插件
return array (
  'id' => 'samplemoduleplugin',
  'install' => 'on',
  'module' => 'module_samplemodule',	//模块名文件夹名， 前面加"module_"后就是插件类名字
  'action' => 'index',
  'doat' => 'front',					//在前台模块触发，可取值：front、back
  'name' => '这是一个测试模块插件',
  'desc' => '该插件作用于module_samplemodule::index.<a href="index.php?m=samplemodule">测试</a>',
  'author' => 'yy',
  'version' => '1.0',
);