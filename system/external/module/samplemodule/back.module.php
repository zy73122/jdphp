<?php
/**
 * 后台模块
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
class module_samplemodule extends base_module
{
	
	public function __construct()
	{
		$moduletplname = 'back';
		$modulename = 'samplemodule';								
		parent::init_var($moduletplname, $modulename);	
	}

	public function index()
	{
		try
		{
			$modules = module::get_modules();
			tpl::assign('modules', $modules);
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
		//调用方式一：
		tpl::display($this->tpl_dir . 'samplemodule.index.html', null, "admin");
		
		//调用方式二：
		//tpl::display($this->tpl_dir . 'samplemodule.index.html', null, "admin", $this->tpl_dir);
		/*
		 这样调用，可以在模板中用这种方式包含同级目录文件：
		{{include file=header.html}}
		*/
	}

	public function testEcho()
	{
		try 
		{
			tool::message('测试完毕');
		}
		catch (Exception $e)
		{
			tpl::assign('error', $e->getMessage());			
		}
	}
}

?>