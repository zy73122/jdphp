<?php
/**
 * 配置读取
 *
 */
class config
{
	public static function get($key = null)
	{
		global $config;
		global $config_app;
		$config = array_merge($config, $config_app);
		if (!empty($key))
		{
			return $config[$key];
		}
		else
		{
			return $config;
		}
	}
}

?>