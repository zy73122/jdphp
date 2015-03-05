<?php
/**
 * 控制器基类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class base_controller extends base
{
	public $controller;
	public $action;
	//public $model;
	//public $view;
	//public $validation;
	public $cache;
	public function __construct()
	{
		parent::__construct();
		$this->controller = glb::$controller;
		$this->action = glb::$action;
		//$this->view = s('tpl');
		//$this->validation = s('validation', $this->controller, $this->action, $_SERVER['REQUEST_METHOD']);
		$this->cache = cache::instance();
		
		if (defined('IN_BACKGROUND'))
		{
			// 登录页面、验证码页面不需要"登录验证"
			if ((empty($_GET['c']) && empty($_GET['m']) && empty($_GET['w'])) || ($_GET['c'] ==
					'login' and (empty($_GET['a']) || $_GET['a'] == 'login')) ||
					$_GET['c'] == 'securimage')
			{}
			else
			{
				s("m_login")->chklogin(); // 登录验证
				//session_write_close();
			}
		}
	}
	
	public function __get($name)
	{
		if (isset($this->$name)) 
		{
			return $this->$name;
		} 
		else 
		{
			switch ($name)
			{
				case 'model':
					$this->model = s('m_'.$this->controller);
					break;
			}
			return $this->$name;
		}
	}
	
	
// 	public function assign($varname, $value)
// 	{
// 		$this->view->assign($varname, $value);
// 	}
	
// 	public function display($tplname)
// 	{
// 		$this->view->display($tplname);
// 	}
}

?>