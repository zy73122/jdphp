<?php
/**
 * 模板类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class tpl_dz 
{
	var $tpldir;
	var $objdir;

	var $tplfile;
	var $objfile;
	var $langfile;

	var $vars;
	var $force = 0;

	var $var_regexp = "\@?\\\$[a-zA-Z_]\w*(?:\[[\w\.\"\'\[\]\$]+\])*";
	var $vtag_regexp = "\<\?=(\@?\\\$[a-zA-Z_]\w*(?:\[[\w\.\"\'\[\]\$]+\])*)\?\>";
	var $const_regexp = "\{([\w]+)\}";

	var $languages = array();
	var $sid;
	
	public function __construct()
	{
		ob_start();
		$this->defaulttpldir = PATH_TPLS_CUR;
		$this->tpldir = PATH_TPLS_CUR;
		$this->objdir = PATH_DATA.'template_compiled/';
		$this->langfile = PATH_TPLS_CUR.'templates.lang.php';
		if (version_compare(PHP_VERSION, '5') == -1) {
			register_shutdown_function(array(&$this, '__destruct'));
		}
		//强制清理模版缓存（切换模版时用）
		if (isset($_GET['clear']) && $_GET['clear'] == 1) {
			$files = scandir($this->objdir);
			foreach ($files as $one) {
				if (is_file($this->objdir.$one) && $one!='.' && $one!='..') {
					@unlink($this->objdir.$one);	
				}
			}
		}
	}

	function assign($k, $v)
	{
		$this->vars[$k] = $v;
	}

	function display($file)
	{
		if ($this->vars) extract($this->vars, EXTR_SKIP);
		include $this->gettpl($file);
		exit;
	}

	function gettpl($file)
	{
		isset($_REQUEST['inajax']) && ($file == 'header' || $file == 'footer') && $file = $file.'_ajax';
		isset($_REQUEST['inajax']) && ($file == 'admin_header' || $file == 'admin_footer') && $file = substr($file, 6).'_ajax';
		$this->tplfile = $this->tpldir.$file.'.htm';
		$this->objfile = $this->objdir.$file.'.php';
		$tplfilemtime = @filemtime($this->tplfile);
		if($tplfilemtime === FALSE) {
			$this->tplfile = $this->defaulttpldir.$file.'.htm';
		}
		if($this->force || !file_exists($this->objfile) || @filemtime($this->objfile) < filemtime($this->tplfile)) {
			if(empty($this->languages)) {
				@include $this->langfile;
				if(is_array($languages)) {
					$this->languages += $languages;
				}
			}
			$this->complie();
		}
		return $this->objfile;
	}

	function complie()
	{
		$template = file_get_contents($this->tplfile);
		$template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template);
		$template = preg_replace("/\{lang\s+(\w+?)\}/ise", "\$this->lang('\\1')", $template);

		$template = preg_replace("/\{($this->var_regexp)\}/", "<?=\\1?>", $template);
		$template = preg_replace("/\{($this->const_regexp)\}/", "<?=\\1?>", $template);
		$template = preg_replace("/(?<!\<\?\=|\\\\)$this->var_regexp/", "<?=\\0?>", $template);

		$template = preg_replace("/\<\?=(\@?\\\$[a-zA-Z_]\w*)((\[[\\$\[\]\w]+\])+)\?\>/ies", "\$this->arrayindex('\\1', '\\2')", $template);

		$template = preg_replace("/\{\{eval (.*?)\}\}/ies", "\$this->stripvtag('<?php \\1?>')", $template);
		$template = preg_replace("/\{eval (.*?)\}/ies", "\$this->stripvtag('<?php \\1?>')", $template);
		$template = preg_replace("/\{for (.*?)\}/ies", "\$this->stripvtag('<?php for(\\1) {?>')", $template);

		$template = preg_replace("/\{elseif\s+(.+?)\}/ies", "\$this->stripvtag('<?php } elseif(\\1) { ?>')", $template);

		for($i=0; $i<2; $i++) {
			$template = preg_replace("/\{loop\s+$this->vtag_regexp\s+$this->vtag_regexp\s+$this->vtag_regexp\}(.+?)\{\/loop\}/ies", "\$this->loopsection('\\1', '\\2', '\\3', '\\4')", $template);
			$template = preg_replace("/\{loop\s+$this->vtag_regexp\s+$this->vtag_regexp\}(.+?)\{\/loop\}/ies", "\$this->loopsection('\\1', '', '\\2', '\\3')", $template);
		}
		$template = preg_replace("/\{if\s+(.+?)\}/ies", "\$this->stripvtag('<?php if(\\1) { ?>')", $template);

		$template = preg_replace("/\{template\s+(\w+?)\}/is", "<?php include \$this->gettpl('\\1');?>", $template);
		$template = preg_replace("/\{template\s+(.+?)\}/ise", "\$this->stripvtag('<?php include \$this->gettpl(\\1); ?>')", $template);


		$template = preg_replace("/\{else\}/is", "<?php } else { ?>", $template);
		$template = preg_replace("/\{\/if\}/is", "<?php } ?>", $template);
		$template = preg_replace("/\{\/for\}/is", "<?php } ?>", $template);

		$template = preg_replace("/$this->const_regexp/", "<?=\\1?>", $template);
 
		$template = preg_replace("/\<\?=/is", "<?php echo ", $template);
		$template = preg_replace("/(\\\$[a-zA-Z_]\w+\[)([a-zA-Z_]\w+)\]/i", "\\1'\\2']", $template);

		umask(002);
		$fp = fopen($this->objfile, 'w');
		fwrite($fp, $template);
		fclose($fp);
	}

	function arrayindex($name, $items)
	{
		$items = preg_replace("/\[([a-zA-Z_]\w*)\]/is", "['\\1']", $items);
		return "<?=$name$items?>";
	}

	function stripvtag($s)
	{
		return preg_replace("/$this->vtag_regexp/is", "\\1", str_replace("\\\"", '"', $s));
	}

	function loopsection($arr, $k, $v, $statement)
	{
		$arr = $this->stripvtag($arr);
		$k = $this->stripvtag($k);
		$v = $this->stripvtag($v);
		$statement = str_replace("\\\"", '"', $statement);
		return $k ? "<?php foreach((array)$arr as $k => $v) {?>$statement<?php }?>" : "<?php foreach((array)$arr as $v) {?>$statement<?php } ?>";
	}

	function lang($k) {
		return !empty($this->languages[$k]) ? $this->languages[$k] : "{ $k }";
	}

	function _transsid($url, $tag = '', $wml = 0)
	{
		$sid = $this->sid;
		$tag = stripslashes($tag);
		if(!$tag || (!preg_match("/^(http:\/\/|mailto:|#|javascript)/i", $url) && !strpos($url, 'sid='))) {
			if($pos = strpos($url, '#')) {
				$urlret = substr($url, $pos);
				$url = substr($url, 0, $pos);
			} else {
				$urlret = '';
			}
			$url .= (strpos($url, '?') ? ($wml ? '&amp;' : '&') : '?').'sid='.$sid.$urlret;
		}
		return $tag.$url;
	}

	function __destruct()
	{
		/*if(isset($_COOKIE['sid']) && $_COOKIE['sid']) {
			return;
		}
		$sid = rawurlencode($this->sid);
		$searcharray = array(
			"/\<a(\s*[^\>]+\s*)href\=([\"|\']?)([^\"\'\s]+)/ies",
			"/(\<form.+?\>)/is"
		);
		$replacearray = array(
			"\$this->_transsid('\\3','<a\\1href=\\2')",
			"\\1\n<input type=\"hidden\" name=\"sid\" value=\"".rawurldecode(rawurldecode(rawurldecode($sid)))."\" />"
		);
		$content = preg_replace($searcharray, $replacearray, ob_get_contents());*/
		$content = ob_get_contents();
		ob_end_clean();
		echo $content;
		// 出错退出时自动调用提示信息页面
/*		if (!$_GET['ajax']) {
			$this->view->assign('msg', $content);
			$this->display('msg');
		} else {
			echo $content;
		}*/
	}

}

/*

Usage:
require_once 'lib/tpl_dz.php';
$this->view = new tpl_dz();
$this->view->assign('page', $page);
$this->view->assign('userlist', $userlist);
$this->view->display("user_ls");

tpl::assign('page', $page);
tpl::display("user_ls");
*/

?>
