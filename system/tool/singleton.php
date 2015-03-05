<?php
/**
 * 单例
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class singleton
{
	/**
	 * 从对象实例容器中取出指定名字的对象实例
	 */
	public static function & get($name)
	{
		if (isset($GLOBALS['config']['OBJECTS'][$name]) && is_object($GLOBALS['config']['OBJECTS'][$name])) 
		{
			return $GLOBALS['config']['OBJECTS'][$name];
		}
	}

	/**
	 * 将一个对象实例注册到对象实例容器
	 */
	public static function & set(& $obj, $name)
	{
		if (!isset($GLOBALS['config']['OBJECTS'][$name])) 
		{			
			$GLOBALS['config']['OBJECTS'][$name] =& $obj;
			return $obj;
		}
	}
	
	/**
	 * 加载类文件
	 * @param string $className
	 * @param string $path 类所在的目录
	 * @return bool
	 */	
	public static function loadClass($className, $path='')
	{
		$classfile = $className . '.php';
		if ($path)
		{
			if (is_file($path . $classfile))
			{
				require_once($path . $classfile);
				return true;
			}
		}
		else
		{
			//要搜索的路径
			$searchPaths = array(
			PATH_CONTROLLER_APP,
			PATH_MODEL_APP,
			PATH_MODEL_BACK,
			PATH_MODEL_CORE,
			PATH_SYSTEM . 'include/',
			);
			foreach ($searchPaths as $onepath)
			{
				if (is_file($onepath . $classfile))
				{
					require_once($onepath . $classfile);
					return true;
				}
			}
		}
		return false;
	}
	
	/**
	 * 获取单件
	 * @param string $className
	 * @param string $path 类所在的目录
	 * @return object,bool
	 */	
	public static function getSingleton($className, $path='')
	{
		static $instances = array();
		if (isset($GLOBALS['config']['OBJECTS'][$className])) 
		{
			// 返回已经存在的对象实例
			return self::get($className);
		}
		if (!class_exists($className)) {
			if (!self::loadClass($className, $path)) {
				return false;
			}
		}
		$instances[$className] = new $className();
		self::set($instances[$className], $className);
		return $instances[$className];
	}
	
	public static function s($className)
	{
		return self::getSingleton($className);
	}
}
?>