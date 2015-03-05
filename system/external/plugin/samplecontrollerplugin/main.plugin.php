<?php
/**
 * 插件测试
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
class plugin_samplecontrollerplugin
{
	public function pre()
	{
		echo "exec {plugin_sampleplugin::pre}";	  
	}
	public function post()
	{
		echo "exec {plugin_sampleplugin::post}";		  
	}
}

?>