<?php
/**
 * 默认控制器
 *
 * @copyright JDphp框架
 * @version 1.0.7
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_hello
{
	/**
	 * 默认动作
	 */
	public function index()
	{
		echo "<h1>hello world.</h1>";
		echo "<ul>";
		echo "<li>该页面由c_index::index()所调用.</li>";
		echo "<li>控制器类c_index的文件位置：appdemo\controller\c_hello.php</li>";
		echo "</ul>";
	}

	/**
	 * 模板示例
	 */
	public function template()
	{
		$data = "<h1>这是一个Smarty模板示例</h1>";
		$data .= "<ul>";
		$data .= "<li>该页面由c_index::template()所调用.</li>";
		$data .= "<li>模板文件sample_template.tpl存放位置：template\default\sample_template.tpl</li>";
		$data .= "</ul>";
		tpl::assign('test_var', $data);
		tpl::display('test_tpl.tpl');
	}
	
	/**
	 * 数据库实例
	 * 您需要先修改数据库配置.config/config.php
	 */
	public function db()
	{
		$data = db::instance()->getall("show tables");
		echo "<br>这个页面由c_index::db()所调用.";
		echo  "您的数据库".$GLOBALS['database']['db_name']."里有这些表：<br>".d($data);
	}
	
	/**
	 * 模型示例
	 */
	public function callmodel()
	{
		echo "<h1>这个一个模型使用示例</h1>";
		echo "<ul>";
		echo "<li>该页面由c_index::callmodel()所调用.</li>";
		echo "<li>控制器类c_index的文件位置：application\controller\c_index.php</li>";
		echo "<li>模型类m_sample_dbgate的文件位置：application\model\m_sample_dbgate.php</li>";
		echo "</ul>";
		$m_sample_dbgate = core::getSingleton("m_sample_dbgate");
		$m_sample_dbgate->echoData();
	}
	
	public function menu()
	{
		$html = "<ul>
		<li><a href='?c=hello'>Hello World!</a></li>
		<li><a href='?c=hello&a=template&dirtplmain=debug_default&clear=1'>Smarty示例!</a></li>
		<li><a href='?c=hello&a=db'>Mysql示例!</a></li>
		<li><a href='?c=hello&a=callmodel'>模型调用示例!</a></li>
		<li><a href='?c=test_index&dirtplmain=debug_default&clear=1'>更多示例（您需要先解压extends_example.rar）</a></li>
		</ul>";
		echo $html;
	}

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
		header("Content-Type:text/html; charset=utf-8");
		//显示菜单
		self::menu();
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
	}


}
?>