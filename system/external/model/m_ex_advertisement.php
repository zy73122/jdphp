<?php
/**
 * advertisement挂件
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
class m_ex_advertisement
{	
	static $this_tpl_dir = '';
	
	function tag_call_widget($params)
	{
		$id = $params['id'];
		
		//如果有缓存的话 
		if (($c = cache::instance()->get("advertisement_".$id))!==null)
		{
			return ($c); exit;
		}
	
		tpl::assign('type', $params['type']);
		$widget = widget::get_widget('advertisement');
		if (!empty($widget['options']))
		{
			tpl::assign('options', $widget['options']);
		}
		
		
		$this_tpl_dir = PATH_WIDGET . 'advertisement/';		
		$htmldata = tpl::fetch($this_tpl_dir.'widget.tpl', $id, "index");
		
		//存入缓存
		cache::instance()->set("advertisement_".$id, $htmldata, $GLOBALS['config']['advertisement.arrayfile']['cache_time']); 
		
		return $htmldata;
	}

}

?>