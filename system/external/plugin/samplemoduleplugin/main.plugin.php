<?php
/**
 * 模块插件测试
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
class plugin_samplemoduleplugin
{
	public function pre()
	{
		echo "exec {plugin_samplemoduleplugin::pre}";	  
	}
	public function post()
	{
		echo "exec {plugin_samplemoduleplugin::post}";		  
	}
}
?>