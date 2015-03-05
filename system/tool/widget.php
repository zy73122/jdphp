<?php
/**
 * 挂件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class widget
{
	/**
	 * 获取可用的挂件列表
	 *
	 * @return array
	 */
	public static function get_widgets()
	{
		//看缓存是否存在
		if (($widgets_all = cache::instance()->get('widgets'))===null)
		{
			$dirs = cfile::ls(PATH_WIDGET, 'dir');
			if (!empty($dirs))
			{
				foreach ($dirs as $dir)
				{
					$widget_info = PATH_WIDGET . $dir . '/widget.info.php'; //挂件信息文件
					$widget_cls = PATH_WIDGET . $dir . '/main.widget.php'; //挂件类文件
					if (!file_exists($widget_info))
					{
						throw new Exception("挂件文件不完整。是否包含以下文件：widget.info.php？");
					}
					if (!file_exists($widget_cls))
					{
						throw new Exception("挂件文件不完整。是否包含以下文件：main.widget.php？");
					}
	
					require_once($widget_cls);
					$widgetInfo = require($widget_info);
					
					if ($widgetInfo['options'])
					{
						foreach ($widgetInfo['options'] as $k=>$one)
						{
							$var_now = module::get_module_arrayfile_conf($widgetInfo['id'], $one['varname']);
							$widgetInfo['options'][$k]['value'] = $var_now ? $var_now : $one['default'];
						}
					}
					$widgets_all[] = $widgetInfo;
				}
				//存入缓存
				cache::instance()->set('widgets', $widgets_all);
			}
		}
		if ($widgets_all)
		{
			foreach ($widgets_all as $one)
			{			
				if ($installed && $one['install']!=$installed)
				continue;
				
				$widgets[] = $one;
			}	
		}
		return (!empty($widgets) ? $widgets : array());
	}
		
	/**
	 * 获取单个挂件
	 *
	 * @param int $widget_id 
	 * @return array
	 */
	public static function get_widget($widget_id)
	{
		$widget = array();
		$widgets = self::get_widgets();
		if (!empty($widgets))
		{
			foreach ($widgets as $one)
			{
				if ($one['id'] == $widget_id)
				{
					$widget = $one;
					$widget['filename_php'] = PATH_WIDGET . $widget_id . '/main.widget.php';
					$widget['filename_tpl'] = PATH_WIDGET . $widget_id . '/widget.tpl';
					$widget['content_php'] = file_get_contents($widget['filename_php']);
					$widget['content_tpl'] = file_get_contents($widget['filename_tpl']);
					break;
				}
			}
		}
		return (!empty($widget) ? $widget : array());
	}

	/**
	 * 修改挂件信息
	 *
	 * @param array $sets
	 */
	public static function set_widget($widget_id, $sets)
	{
		if (!$widget_id)
		throw new Exception('$widget_id不能为空');
		if (!is_array($sets))
		throw new Exception('$sets必须是数组');

		$widget_info = PATH_WIDGET . $widget_id . '/widget.info.php';
		if (file_exists($widget_info))
		{
			$arrayfile = new arrayfile($widget_info);			
			$data = $arrayfile->getAll();
			foreach ($sets as $k=>$v)
			{
				$data[$k] = $v;
			}
			$arrayfile->setAll($data);
		}
		else
		{
			throw new Exception("挂件$widget_id不存在");
		}
	}

	/**
	 * 配置挂件
	 *
	 * @param string $widget_id
	 */
	public static function config_widget($widget_id)
	{
		$widget_info = require(PATH_WIDGET . $widget_id . '/widget.info.php');
		unset($_POST['submit']);
		$widget_info['options'] = $_POST; 
		self::set_widget($widget_id, $sets);
	}
	
}
?>