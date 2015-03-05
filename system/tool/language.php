<?php
/**
 * 语言
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class language
{
	/**
	 * 载入语言文件
	 *
	 * @param string $filename example: 'common.lang.php'
	 * @param string $lanType 可用值：zhCN,enUS,zhTW
	 * @return array
	 */
	public static function load($filename, $lang_base_dir=null, $lanType=LANGUAGE)
	{
		if (!$filename)
		throw new Exception("语言文件{$filename}不能为空！");

		if (($lang_all = cache::instance()->get("langs"."[".$filename."][".$lanType."]"))===null)
		{
			//载入公共语言文件
			if (!$lang_base_dir)
			$lang_base_dir = PATH_APP . 'language/';
			$lang_common = include_once($lang_base_dir . $lanType . '/common.lang.php');
			$lang = include_once($lang_base_dir . $lanType . '/' . $filename);
	
			if (is_array($lang_common) && is_array($lang))
			{
				$lang_all = array_merge($lang_common, $lang);
			}
			else if (is_array($lang_common))
			{
				$lang_all = $lang_common;
			}
			else if (is_array($lang))
			{
				$lang_all = $lang;
			}
			else
			{
				$lang_all = array();
			}
			cache::instance()->set("langs"."[".$filename."][".$lanType."]", $lang_all);
		}
		foreach ($lang_all as $k=>$v)
		{
			//存入全局变量中，以后需要的时候可以节省载入时间
			$GLOBALS['config']['lang'][$lanType][$k] = $v;
		}

		return $lang_all;
	}

	/**
	 * 获取语言
	 * 如果没有检测到语言缓存 或 已指定语言文件夹时 需要重新载入文件
	 *
	 * @param string $langName
	 * @param string $lanType
	 * @return string
	 */
	public static function get($langName, $lang_base_dir=null, $lanType=LANGUAGE)
	{
		
		//如果没有检测到语言缓存 或 已指定语言文件夹时 需要重新载入文件
		if (!isset($GLOBALS['config']['lang'][$lanType][$langName]) || $lang_base_dir)
		{
			//读取该类型语言的所有语言文件
			if (!$lang_base_dir)
			$lang_base_dir = PATH_APP . 'language/';
			$files = cfile::ls($lang_base_dir . $lanType , 'file');
			if (!empty($files))
			{
				foreach ($files as $one)
				{
					self::load($one, $lang_base_dir, $lanType);
				}
			}
		}

		$lang_value = $GLOBALS['config']['lang'][$lanType][$langName];
		return $lang_value ? $lang_value : "undefined($lanType):$langName";
	}

	/**
	 * 清除语言缓存
	 *
	 */
	public static function clear_cache()
	{
		unset($GLOBALS['config']['lang']);
	}
	
	/**
	 * 设置js语言
	 * 在js中调用方式： lang.key
	 *
	 */
	public static function js_lang($lang)
	{
		echo "<script type='text/javascript'>\n";
		echo "var lang = ".json_encode($lang).";\n";
		echo "lang.get = function(key){
	eval('var langKey = lang.' + key);
	if (typeof(langKey)=='undefined') {
		return 'undefined:'+key;
	} else {
		return langKey;
	}
};\n";
		echo "</script>\n";
	}
	

}
?>