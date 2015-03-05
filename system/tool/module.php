<?php
/**
 * 模块
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class module
{	
	/**
	 * 获取可用的模块列表
	 *
	 * @param string $installed 可用值:on,off 表示模块是否已经安装
	 * @return array
	 */
	public static function get_modules($installed='')
	{
		//看缓存是否存在
		if (($modules_all = cache::instance()->get('modules'))===null)
		{
			$dirs = cfile::ls(PATH_MODULE, 'dir');
			if (!empty($dirs))
			{
				foreach ($dirs as $dir)
				{
					$module_file_info = PATH_MODULE . $dir . '/module.info.php'; //模块信息文件
					$module_file_install = PATH_MODULE . $dir . '/install.php'; //安装文件
					$module_file_uninstall = PATH_MODULE . $dir . '/uninstall.php'; //卸载文件
					$module_file_back = PATH_MODULE . $dir . '/back.module.php'; //后台模块文件
					$module_file_front = PATH_MODULE . $dir . '/front.module.php'; //前台模块文件
					if (!file_exists($module_file_info))
					{
						throw new Exception("模块文件不完整。是否包含以下文件：module.info.php？");
					}
					if (!file_exists($module_file_install))
					{
						throw new Exception("模块文件不完整。是否包含以下文件：install.php？");
					}
					if (!file_exists($module_file_uninstall))
					{
						throw new Exception("模块文件不完整。是否包含以下文件：uninstall.php？");
					}
					if (!file_exists($module_file_back))
					{
						throw new Exception("模块文件不完整。是否包含以下文件：back.module.php？");
					}
					if (!file_exists($module_file_front))
					{
						throw new Exception("模块文件不完整。是否包含以下文件：front.module.php？");
					}
	
					$moduleInfo = require($module_file_info);
					
					if ($moduleInfo['options'])
					{
						foreach ($moduleInfo['options'] as $k=>$one)
						{
							$var_now = self::get_module_arrayfile_conf($moduleInfo['id'], $one['varname']);
							$moduleInfo['options'][$k]['value'] = $var_now ? $var_now : $one['default'];
						}
					}
					$modules_all[] = $moduleInfo;
				}
				
				//存入缓存
				cache::instance()->set('modules', $modules_all);
			}
		}
		if ($modules_all)
		{
			foreach ($modules_all as $one)
			{			
				if ($installed && $one['install']!=$installed)
				continue;
				
				$modules[] = $one;
			}
		}
		return (!empty($modules) ? $modules : array());
	}
	
	/**
	 * 获取单条模块信息
	 *
	 * @param array $sets
	 */
	public static function get_module($module_id)
	{
		if (!$module_id)
		throw new Exception('$module_id不能为空');
		
		$modules = self::get_modules();
		foreach ($modules as $one)
		{
			if ($one['id'] == $module_id)
			return $one;
		}
		
		return false;
	}
	
	/**
	 * 获取data/arrayfile下已经配置好的数据
	 */
	public static function get_module_arrayfile_conf($module_id, $var_name)
	{
//		$module_arrayfile = PATH_DATA_CORE . 'arrayfile/'.$module_id.'.arrayfile.php'; 
//		if (file_exists($module_arrayfile))
//		{
//			$cfg = require($module_arrayfile);
//			if (!empty($cfg) && isset($cfg[$var_name]))
//			{
//				return $cfg[$var_name];
//			}
//		}
		$arrayfile = new arrayfile(PATH_DATA_CORE . 'arrayfile/'.$module_id.'.arrayfile.php'); 
		$v = $arrayfile->getOne($var_name);
	
		return $v ? $v : false;
	}
	
	/**
	 * 设置data/arrayfile
	 */
	public static function set_module_arrayfile_conf($module_id, $var_name, $var_value)
	{
		$arrayfile = new arrayfile(PATH_DATA_CORE . 'arrayfile/'.$module_id.'.arrayfile.php'); 
		$arrayfile->setOne($var_name, $var_value);
		return false;
	}
	

	/**
	 * 修改模块信息
	 *
	 * @param array $sets
	 */
	public static function set_module($module_id, $sets)
	{
		if (!$module_id)
		throw new Exception('$module_id不能为空');
		if (!is_array($sets))
		throw new Exception('$sets必须是数组');

		$module_info = PATH_MODULE . $module_id . '/module.info.php';
		if (file_exists($module_info))
		{
			$arrayfile = new arrayfile($module_info);			
			$data = $arrayfile->getAll();
			foreach ($sets as $k=>$v)
			{
				$data[$k] = $v;
			}
			$arrayfile->setAll($data);
		}
		else
		{
			throw new Exception("模块$module_id不存在");
		}
	}

	/**
	 * 安装模块
	 *
	 * @param string $module_id
	 */
	public static function install_module($module_id)
	{
		//执行安装脚本
		$file_install = PATH_MODULE . $module_id . '/install.php';
		require($file_install);
		
		$sets = array(
		'install'	=> 'on',
		);
		self::set_module($module_id, $sets);
		cache::instance()->delete('modules');
	}

	/**
	 * 卸载模块
	 *
	 * @param string $module_id
	 */
	public static function uninstall_module($module_id)
	{
		//执行卸载脚本
		$file_uninstall = PATH_MODULE . $module_id . '/uninstall.php';
		require($file_uninstall);
		
		$sets = array(
		'install'	=> 'off',
		);
		self::set_module($module_id, $sets);
		cache::instance()->delete('modules');
	}


}
?>