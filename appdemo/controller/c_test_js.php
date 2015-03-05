<?php
/**
 * 测试 htmlarea
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_js extends base_controller
{
	function jquery_tabs()
	{
		tpl::display('test_jquery.tabs.tpl');				
	}
	
	function jquery_cookie()
	{
		tpl::display('test_jquery.cookie.tpl');	
	}
	
	function selectTypeList()
	{
		tpl::display('test_jquery.select_lsit.tpl');	
	}
	
	function onSubmitSelectTypeList()
	{
		var_dump($_POST['sel1']);
	}	
	
	function map_51map()
	{
		tpl::display('test_js_map_51map.tpl');	
	}
	
	function map_google()
	{
		tpl::display('test_js_map_google.tpl');	
	}
		
	function fckeditor()
	{
		$loadtype = $_GET['loadtype'] ? $_GET['loadtype'] : 'php';		
		if ($loadtype == "html") //html方式载入
		{					
			tpl::display('test_editor_fckeditor.tpl');	
		}		
		else if ($loadtype == "php") //php方式载入
		{
			$cf_name = 'FCKeditor1';
			$cf_value = '<p>This is some <strong>sample text</strong>.</p>';			
						
		?>
		<form action="" method="post" target="_blank">
			<?php
			require_once(PATH_TOOL . "editor.php") ;
			$editor = new editor('Mine', 'white', 'zh-cn');
			$editor->create($cf_name, $cf_value);			
			?>
			<br>
			<input type="submit" value="Submit">
		</form>
		<?php

		}
	}
		
	function datepicker()
	{
		tpl::display('test_jquery.datepicker.tpl');
	}
		
	function ajax()
	{
		tpl::display('test_ajax.tpl');
	}
	
	function jquery_ui_dialog()
	{
		tpl::display('test_jquery.ui.dialog.tpl');
	}
	
	function jquery_common()
	{
		tpl::display('test_jquery.common.tpl');
	}

	function jquery_common_onpost()
	{
		return array('msg' => '参与过的慈善活动特别的多，我能鲜明的对比出哪个好做，哪个难做。人的慈善比动物的慈善要容易的多。首先它有法律依据，人是有人的权力的，有妇女权益保障法，有儿童权益保障法，虽然不够完备还需完备，但是法律在那它有依据，动物保护法和反虐待动物法没有依据，没有法律，你想去做一件事儿连个法律依据都没有，这是它的第一个大难。第二个大难是没有法律有共识也可以，保护人类不能欺负小孩，不能残害妇女，这事儿是有共识的，它是常识每一个人都承认。但是动物保护你跟别人提保护动物，会有人觉得不错，但是一定会有很多人说神经病吧，人的事儿还没管好呢，管动物的事儿干嘛？');
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