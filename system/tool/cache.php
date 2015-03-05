<?php
/**
 * Cache //缓存类(APC,Memcache,...)
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class cache
{
	public static $insts = array();
	public $cachepre = 'pre__';
	public $cachetype; //memcache,apc,eacc,xcache,wincache,filecache
	
	public static function instance($config = array(), $name = null)
	{
		$config = !empty($config) ? $config : $GLOBALS['config']['cache'];
		$name = empty($name) ? md5(json_encode($config)) : $name;
		$cachetype = $config['cachetype'];
		if (!isset(self::$insts[$name]))
		{
			if ($cachetype == 'apc')
			{
				if (!function_exists('apc_store')) 
					throw new ErrorException("APC扩展未安装");
				self::$insts[$name] = new apcCache($config);
			}
			else if ($cachetype == 'memcache')
			{
				if (!class_exists('Memcache')) 
					throw new ErrorException("Memcache扩展未安装");
				self::$insts[$name] = new mmemCache($config);
			}
			else if ($cachetype == 'mmemCached')
			{
				if (!class_exists('Memcached')) 
					throw new ErrorException("Memcached扩展未安装");
				self::$insts[$name] = new mmemCached($config);
			}
			else if ($cachetype == 'eacc')
			{
				if (!function_exists('eaccelerator_put')) 
					throw new ErrorException("函数未定义：eaccelerator_put");
				self::$insts[$name] = new eacceleratorCache($config);
			}
			else if ($cachetype == 'xcache')
			{
				if (!function_exists('xcache_set')) 
					throw new ErrorException("函数未定义：xcache_set");
				self::$insts[$name] = new xcacheCache($config);
			}
			else if ($cachetype == 'wincache')
			{
				if (!function_exists('wincache_ucache_set'))
					throw new ErrorException("函数未定义：wincache_ucache_set");
				self::$insts[$name] = new wincacheCache($config);
			}
			else if ($cachetype == 'filecache')
			{
				if (!is_writeable($config['file']['path'])) 
					throw new ErrorException("路径不可写：".$config['file']['path']);
				self::$insts[$name] = new fileCache($config);
			}
		}
		return self::$insts[$name];
	}
	
	public function get($key){}
	public function set($key, $value, $timeout=0){}
	public function delete($key){}
}

class wincacheCache extends cache
{
	public $config;
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	/**
	 * 获取缓存
	 */
	public function get($key) 
	{ 
		$val = wincache_ucache_get( $this->cachepre.$key );

		if ( is_string( $val ) ) {
			$val = unserialize( $val );
		}

		return $val;
	}
	
	/**
	 * 缓存设置
	 */
	public function set($key, $value, $timeout=0) 
	{
		return wincache_ucache_set($this->cachepre.$key, serialize($value), $timeout);
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key) 
	{
		return wincache_ucache_delete( $this->cachepre.$key );
	}
	

	public function keys() {
		$info = wincache_ucache_info();
		$list = $info['ucache_entries'];
		$keys = array();

		foreach ( $list as $entry ) {
			$keys[] = $entry['key_name'];
		}

		return $keys;
	}
}

class xcacheCache extends cache
{
	public $config;
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	/**
	 * 获取缓存
	 */
	public function get($key) 
	{ 
		$val = xcache_get( $this->cachepre.$key );

		if ( is_string( $val ) ) {
			$val = unserialize( $val );
		}

		return $val;
	}
	
	/**
	 * 缓存设置
	 */
	public function set($key, $value, $timeout=0) 
	{
		return xcache_set($this->cachepre.$key, serialize($value), $timeout);
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key) 
	{
		return xcache_unset( $this->cachepre.$key );
	}
	
}

class eacceleratorCache extends cache
{
	public $config;
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	/**
	 * 获取缓存
	 */
	public function get($key) 
	{ 
		$val = eaccelerator_get( $this->cachepre.$key );

		if ( is_string( $val ) ) {
			$val = unserialize( $val );
		}

		return $val;
	}
	
	/**
	 * 缓存设置
	 */
	public function set($key, $value, $timeout=0) 
	{
		return eaccelerator_put($this->cachepre.$key, serialize($value), $timeout);
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key) 
	{
		return eaccelerator_rm( $this->cachepre.$key );
	}
	
}

class apcCache extends cache
{
	public $config;
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	/**
	 * 获取缓存
	 */
	public function get($key) 
	{ 
		return apc_fetch($this->cachepre.$key);
	}
	
	/**
	 * 缓存设置
	 */
	public function set($key, $value, $timeout=0) 
	{
		return apc_store($this->cachepre.$key, $value, $timeout);
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key) 
	{
		return apc_delete( $this->cachepre.$key );
	}
	
}

class mmemCache extends cache
{
	public $config;
	public $mem;
	public function __construct($config)
	{
		$this->config = $config;
		//if (is_object($this->mem)) return;
		$this->mem = new Memcache();
		foreach($this->config['memcache']['servers'] as $m) $this->mem->addServer($m[0], $m[1]);
	}
	
	/**
	 * 获取缓存
	 */
	public function get($key) 
	{ 
		return $this->mem->get($this->cachepre.$key);
	}
	
	/**
	 * 缓存设置 不管Key有没有存在,都重新存入
	 */
	public function set($key, $value, $timeout=0) 
	{
		return $this->mem->set($this->cachepre.$key, $value, 0, $timeout);
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key) 
	{
		return $this->mem->delete($this->cachepre.$key);
	}

}

class mmemCached extends cache
{
	public $config;
	public $mem;
	public function __construct($config)
	{
		$this->config = $config;
		//if (is_object($this->mem)) return;
		$persistent = $this->config['memcached']['persistent'];
		if ($persistent) {
			$this->mem = new Memcached('pool');
		} else {
			$this->mem = new Memcached();
		}
		if (!$this->mem->getServerList())
		$this->mem->addServers($this->config['memcached']['servers']);
	}
	
	/**
	 * 获取缓存
	 */
	public function get($key) 
	{ 
		return $this->mem->get($this->cachepre.$key);
	}
	
	/**
	 * 缓存设置 不管Key有没有存在,都重新存入
	 */
	public function set($key, $value, $timeout=0) 
	{
		return $this->mem->set($this->cachepre.$key, $value, $timeout);
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key) 
	{
		return $this->mem->delete( $this->cachepre.$key);
	}

}

//附加了缓存过期自动清除
class fileCache extends cache
{
	public $config;
	public $default_expire;
	public $spliter;
	public $cachedir;
	public function __construct($config)
	{
		$this->config = $config;
		$this->spliter = "\n";
		$this->default_expire = $this->config['file']['expire'] ? (int)$this->config['file']['expire'] : 60;
		$this->cachedir = $config['file']['path'];
	}
	
	/**
	 * 获取缓存
	 * null表示未设置或已过期
	 */
	public function get($key) 
	{
		$filepath = $this->getfilename($key);
		if (!file_exists($filepath))
		{
			return null;
		}
		
		$cont = file_get_contents($filepath);
		if (is_string($cont))
		{
			$cont = unserialize($cont);
		}
		else
		{
			return null;
		}

		$expire = $cont['expire'];
		if ($expire < time()) //已过期
		{
			return null;
		}
		
		return $cont['value'];
	}
	
	/**
	 * 缓存设置 不管Key有没有存在,都重新存入
	 */
	public function set($key, $value, $timeout=0) 
	{
		$expire = $timeout ? $timeout : $this->default_expire;
		$expire += time();		
		$cont = serialize(array(
			'expire' => $expire,
			'value' => $value,
		));
		$filepath = $this->getfilename($key);
		//if (!is_dir(dirname($filepath))) {
		//	if (!cfile::mkdir_recursive($filepath)) return false;
		//}

		file_put_contents($filepath, $cont);
		return true;
	}
	
	/**
	 * 删除缓存
	 */
	public function delete($key = '') 
	{
		if ($key)
		{
			$filepath = $this->getfilename($key);
			@unlink($filepath);
		}
		else //删除全部
		{
			$files = scandir($this->cachedir);
			foreach ($files as $file) {
				if ($file == '.' || $file == '..') continue;
				//unlink($this->cachedir.$file);
				cfile::rm_recurse($this->cachedir.$file);
			}
		}
		return true;
	}
	
	protected function getfilename($key)
	{
		//替换$key中的特殊字符，然后作为缓存文件名
		$filename = str_replace(array('\\', '/', ' '), '_', $key);
		
		//按文件名生成缓存目录
		$strhash = md5($filename);
		$cachedir = substr($strhash, 0, 2) . '/' . substr($strhash, 2, 2) . '/';
		$cachedir_full = $this->cachedir . $cachedir ;
		if (!file_exists($cachedir_full)) {
			cfile::mkdir_recursive($cachedir_full, 0700);
		}
		//return $this->cachedir . md5($key) . '.cache';
		return $cachedir_full . $filename . '.cache';
	}
	
}

?>