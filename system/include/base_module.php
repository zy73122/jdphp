<?php
/**
 * 模块基类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class base_module
{
	public $lang_dir;
	public $tpl_dir;
	public $tpl_url;
	public $model;
	
	public function __construct()
	{
	}
	
	public function init_var($tplname, $modulename)
	{
		$this->lang_dir = PATH_MODULE . "$modulename/language/";		
		if (strpos($_GET['a'], 'sample_call')!==0 && file_exists(PATH_TPLS_CURAPP . "module_$modulename/$tplname/"))
		{
			$tpl_url_front = URL . 'template/' . $GLOBALS['dbconfig']['cf_dirtplmain'] . "/module_$modulename/";
			$relativepath = "module_$modulename/$tplname/";
			$this->tpl_dir = PATH_TPLS_CURAPP . $relativepath;
		}
		else if (file_exists(PATH_MODULE . "$modulename/template/$tplname/"))
		{
			$tpl_url_front = URL . "external/module/$modulename/template/";
			$relativepath = "$modulename/template/$tplname/";
			$this->tpl_dir = PATH_MODULE . $relativepath;
		}
		$this->tpl_url = $tpl_url_front . (defined('IN_BACKGROUND') ? "back/" : "$tplname/");
	}
}

?>