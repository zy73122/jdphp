<?php
/**
 * 插件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class plugin
{
	/**
	 * 获取可用的插件列表
	 *
	 * @param string $installed 可用值:on,off 表示插件是否已经安装
	 * @return array
	 */
	public static function get_plugins($installed='')
	{
		if (($plugins_all = cache::instance()->get('plugins'))===null)
		{
			$dirs = cfile::ls(PATH_PLUGIN, 'dir');
			if (!empty($dirs))
			{
				foreach ($dirs as $dir)
				{
					$plugin_cls = PATH_PLUGIN . $dir . '/main.plugin.php';
					$plugin_info = PATH_PLUGIN . $dir . '/plugin.info.php';
					if (file_exists($plugin_cls) && file_exists($plugin_info))
					{
						require_once($plugin_cls);
						$plugins_all[] = require_once($plugin_info);
					}
					else
					{
						throw new Exception("插件文件不完整。是否包含main.plugin.php，plugin.info.php？");
					}
				}
				cache::instance()->set('plugins', $plugins_all);
			}
		}
		if ($plugins_all)
		{
			foreach ($plugins_all as $one)
			{			
				if ($installed && $one['install']!=$installed)
				continue;
				
				$plugins[] = $one;
			}	
		}
		return (!empty($plugins) ? $plugins : array());
	}

	/**
	 * 获取控制器对应当插件
	 *
	 * @param string $controller
	 * @return 
	 */
	public static function run_controller_plugin($controller, $action, $funcName)
	{
		if (!$controller)
		{
			throw new Exception("参数$controller不能为空");
		}
		$plugins = self::get_plugins('on');
		$testarr = array(
		'controller' => $controller,
		'action' => $action,
		);
		foreach ($plugins as $plugin)
		{
			if (in_array($testarr, $plugin['runat']))
			{
				require_once(PATH_PLUGIN . $plugin['id'] . '/main.plugin.php');
				$pluginClassname = "plugin_" . $plugin['id'];
				$obj = s($pluginClassname);
				if (method_exists($obj, $funcName))
				{
					s($pluginClassname)->$funcName();
				}
			}
		}
	}

	/**
	 * 获取模块对应当插件
	 *
	 * @param string $module
	 * @return 
	 */
	public static function run_module_plugin($module, $action, $funcName)
	{
		if (!$module)
		{
			throw new Exception("参数$module不能为空");
		}
		$plugins = self::get_plugins('on');
		$testarr = array(
		'module' => $module,
		'action' => $action,
		);
		foreach ($plugins as $plugin)
		{
			if (in_array($testarr, $plugin['runat']))
			{				
				if ((defined('IN_BACKGROUND') && $plugin['doat']=='back')				//由后台模块 触发
				|| (!defined('IN_BACKGROUND') && $plugin['doat']=='front'))	//由前台模块 触发
				{
					require_once(PATH_PLUGIN . $plugin['id'] . '/main.plugin.php');
					$pluginClassname = "plugin_" . $plugin['id'];
					$obj = s($pluginClassname);
					if (method_exists($obj, $funcName))
					{
						s($pluginClassname)->$funcName();
					}
				}
			}
		}
	}

	/**
	 * 修改插件信息
	 *
	 * @param array $sets
	 */
	public static function set_plugin($plugin_id, $sets)
	{
		if (!$plugin_id)
		throw new Exception('$plugin_id不能为空');
		if (!is_array($sets))
		throw new Exception('$sets必须是数组');

		$plugin_info = PATH_PLUGIN . $plugin_id . '/plugin.info.php';
		if (file_exists($plugin_info))
		{
			$arrayfile = new arrayfile($plugin_info);			
			$data = $arrayfile->getAll();
			foreach ($sets as $k=>$v)
			{
				$data[$k] = $v;
			}
			$arrayfile->setAll($data);
		}
		else
		{
			throw new Exception("插件$plugin_id不存在");
		}
	}

	/**
	 * 安装插件
	 *
	 * @param string $plugin_id
	 */
	public static function install_plugin($plugin_id)
	{
		//执行安装脚本
		$file_install = PATH_PLUGIN . $plugin_id . '/install.php';
		if (file_exists($file_install))
		{
			require($file_install);
		}
		
		$sets = array(
		'install'	=> 'on',
		);
		self::set_plugin($plugin_id, $sets);
		cache::instance()->delete('plugins');
	}

	/**
	 * 卸载插件
	 *
	 * @param string $plugin_id
	 */
	public static function uninstall_plugin($plugin_id)
	{
		//执行卸载脚本
		$file_uninstall = PATH_PLUGIN . $plugin_id . '/uninstall.php';
		if (file_exists($file_uninstall))
		{
			require($file_uninstall);
		}
		
		$sets = array(
		'install'	=> 'off',
		);
		self::set_plugin($plugin_id, $sets);
		cache::instance()->delete('plugins');
	}


}
?>