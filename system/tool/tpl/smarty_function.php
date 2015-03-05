<?php
/**
 * Smarty 自定义函数
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

/**
 * 调用方式: {{url avg="?c=url_submit&a=index&..."}}
 */
$smarty->register_function("url", "smarty_function_url");
function smarty_function_url($params)
{
	extract($params);
	$url = $avg ? $avg : "?c=index";
	
	if(ENABLE_REWRITE || ENABLE_HTML)
	{
		$url = tool::url($url);
	}
	
	return $url;
}

/**
 * 语言
 * 调用方式: {{l n="lang_name" t="zhCN" d="DIR"}}
 */
$smarty->register_function("l", "smarty_function_lang");
function smarty_function_lang($params)
{
	extract($params);
	$t = $t ? $t : LANGUAGE;
	return language::get($n, $d, $t);
}

/**
 * 文章模板的模板标签方式调用
 * 需要安装CMS模块
 * 调用方式: 参考http://yourdomain/jdphp/?m=cms&a=sample_tags_call
 * 1、{{cms id="myname" cid="*" title_len="20"}}
 * 2、{{cms id="myname" aid="" img_width="70" img_height="23" has_img="1" has_title="1" display_type="t_i"}}
 * 3、{{cms id="myname" cid="" orderby="click|created|displayorder" limit="10"}}
 
 标签参数说明：
 id="myname"							为html标签的id，每个必须都不同
 cid、aid 								二选一，cid有值时为列表，aid有值时为单条信息；cid为类别id，aid为文章id；多个以,号隔开;为"*"时匹配全部类别或文章
 has_title="1"							默认 显示标题 可用值：0,1
 	title_len="15" 						标题长度
 has_img="1" 							显示图片 可用值：0,1 开启该项时，每篇文章都会返回['has_imgs']形式的图片数组
	img_count="4"						图像个数 默认为1
	img_width="70"						图像宽度
	img_height="23"						图像高度
 has_cont="1" 							显示文章内容 可用值：0,1
 	cont_len="115" 						内容长度
 orderby="click|created|displayorder"	为排序字段
 limit="10"
 display_type="mytype"					显示样式， 要在对应的模板文件里定义
 onlyimg="1"							只显示带图片的文章 可用值：0,1
 */
$smarty->register_function("cms", "smarty_function_cms");
function smarty_function_cms($params)
{
	$htmldata = s('m_ex_cms')->tag_call_article_list($params);
	return $htmldata;
}

/**
 * 文章评论的模板标签方式调用
 * 需要安装CMS模块
 * 调用方式: 
 * 1、{{cms_comment id="myname" aid="" len="" page="0" pageSize="" type="1"}}
 * ......
 * id为html标签的id，每个必须都不同
 * aid为文章id 
 * len为标题长度
 * page为分页标识 表示第几页 0-n
 * pagesize为分页标识 表示分页大小
 * orderby为排序字段
 * type默认为1
 */
$smarty->register_function("cms_comment", "smarty_function_cms_comment");
function smarty_function_cms_comment($params)
{
	if ($params['aid'])
	{
		$htmldata = s('m_ex_cms')->tag_call_comment_list($params);
	}
	return $htmldata;
}



/**
 * 文章模板（多语言版）的模板标签方式调用
 * 需要安装CMS模块（多语言版）
 * 调用方式: 参考smarty_function_cms
 */
$smarty->register_function("cmsml", "smarty_function_cmsml");
function smarty_function_cmsml($params)
{
	$htmldata = m_ex_cmsml::tag_call_article_list($params);
	return $htmldata;
}

/**
 * 文章评论（多语言版）的模板标签方式调用
 * 需要安装CMS模块（多语言版）
 * 调用方式: 
 * 1、{{cmsml_comment id="myname" aid="" len="" page="0" pageSize="" type="1"}}
 * ......
 * id为html标签的id，每个必须都不同
 * aid为文章id 
 * len为标题长度
 * page为分页标识 表示第几页 0-n
 * pagesize为分页标识 表示分页大小
 * orderby为排序字段
 * type默认为1
 */
$smarty->register_function("cmsml_comment", "smarty_function_cmsml_comment");
function smarty_function_cmsml_comment($params)
{
	if ($params['aid'])
	{
		$htmldata = m_ex_cmsml::tag_call_comment_list($params);
	}
	return $htmldata;
}

/**
 * 友情链接的模板标签方式调用
 * 需要安装friendlink模块
 * 调用方式: {{friendlink id="myname" len="" img_width="70" img_height="23" type="1|2"}}
 * id为html标签的id，每个必须都不同
 * len为标题长度
 * type为1表示文字形式，2表示图片，3表示图文形
 * onlyimg="1" 只显示带图片的友情链接 可用值：0,1式
 */
$smarty->register_function("friendlink", "smarty_function_friendlink");
function smarty_function_friendlink($params)
{			
	$htmldata = m_ex_friendlink::tag_call_friendlink_list($params);
	return $htmldata;
}

/**
 * 图片导航的模板标签方式调用
 * 需要安装cycleimage模块
 * 调用方式: {{cycleimage id="myname" len="" img_width="70" img_height="23" type="1|2"}}
 * id为html标签的id，每个必须都不同
 * len为标题长度
 * type为样式类型，模板里面自行处理，目前可用值：1,2
 */
$smarty->register_function("cycleimage", "smarty_function_cycleimage");
function smarty_function_cycleimage($params)
{
	$htmldata = m_ex_cycleimage::tag_call_cycleimage_list($params);
	return $htmldata;
}

/**
 * 挂件 标签方式调用
 * 需要先安装挂件
 * 调用方式: {{widget id="myname" widget_id="advertisement" type="1"}}
 * id为html标签的id，每个必须都不同
 * advertisement为挂件ID
 */
$smarty->register_function("widget", "smarty_function_widget");
function smarty_function_widget($params)
{
	$modname = "m_ex_".$params['widget_id'];
	$m = new $modname;
	$htmldata = $m->tag_call_widget($params);
	return $htmldata;
}


/**
 * 文章模板的模板标签方式调用
 * 需要安装onlinecs模块
 * 调用方式: 参考http://yourdomain/jdphp/?m=onlinecs&a=sample_tags_call
 * 1、{{onlinecs id="myname" count="5" show="qq|tel|mobile|email" display_type=""}}
 */
$smarty->register_function("onlinecs", "smarty_function_onlinecs");
function smarty_function_onlinecs($params)
{
	$htmldata = m_ex_onlinecs::tag_call_onlinecs_list($params);
	return $htmldata;
}


//.... picturegroup 未做标签功能
?>