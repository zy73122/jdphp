<?php
/**
 * 挂件 - 广告
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
class widget_advertisement
{
	var $widget_id;
	var $tpl_dir;

	public function __construct()
	{
		$widget_id = "advertisement";
		$this->widget_id = $widget_id;	
		$this->tpl_dir = PATH_WIDGET . $widget_id . '/';
	}
	
	public function pre()
	{
		try
		{
			tpl::assign('url_module', $this->tpl_url);
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}

	public function post()
	{

	}
}

?>