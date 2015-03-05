<?php
/**
 * 模板编辑测试
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
		
class c_edittpl
{
	function index()
	{
	}
	
	function edit_cms_index()
	{
		try
		{
			tpl::clear_compiled_tpl('article_index.tpl');
			tpl::display('article_index.tpl');
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}		
	}	
	
//	function edit_tpl()
//	{
//		try
//		{
//			tpl::display(PATH_TPLS_CURAPP . 'index.tpl');
//		}
//		catch( Exception $e )
//		{
//			tpl::assign('error', $e->getMessage());
//		}		
//	}	
		
	function ajax_save_tpl()
	{
		try
		{
			$tplfilepath = $_GET['tplfilepath'];
			$filecontent = stripslashes($_POST['filecontent']);
			$filecontent = preg_replace('/<div id=(\")?import_edittpl_header(\")?>(.*)<\/div>/isU', '', $filecontent);
			if (!$filecontent)
				throw new Exception("内容不能为空！");				
			if (!$tplfilepath)
				throw new Exception("文件保存路径不存在！");

			cfile::write($tplfilepath, $filecontent, "wb");
			
			//file_put_contents('aaas.log', $filecontent);
			$result['info'] = "修改成功！";
		}
		catch( Exception $e )
		{
			//tpl::assign('error', $e->getMessage());
			$result['info'] = $e->getMessage();
		}
		
		echo json_encode($result);
		exit;
	}	
	
	function get_header()
	{
		try
		{
			//获取所有挂件
			$widgets = widget::get_widgets();
			tpl::assign('widgets', $widgets);
			
			tpl::assign('tplfilepath', $_GET['tplfilepath']);
			tpl::display(PATH_TPLS_BACK.'edittpl_header.tpl' );
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}	

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{	
	}


}
?>