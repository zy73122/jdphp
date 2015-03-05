<?php
/**
 * 前台模块
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
class module_samplemodule extends base_module
{
	
	public function __construct()
	{
		//$m_ex_samplemodule = s("m_ex_samplemodule");
		$moduletplname = 'front';
		$modulename = 'samplemodule';
		parent::init_var($moduletplname, $modulename); 	
	}

	public function index()
	{
		try
		{
			tpl::assign('data', $data);
			//tpl::display($this->tpl_dir . 'samplemodule.index.html', null, "index");
			tpl::display($this->tpl_dir . 'samplemodule.index.html', null, "index", $this->tpl_dir);
		}
		catch (Exception $e)
		{
			tool::message($e->getMessage());
		}
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