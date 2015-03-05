<?php
/**
 * memcache缓存
 *
 */
class memc
{
	public $mem;
	public $cachetime;
	public $cachepre;
	public $config;
	
	public function __construct()
	{
		$this->cachetime = 0;
		$this->cachepre = '';
		$this->config = glb::$config['cache']['memcached'];
	}
	
	public function init_memcache() 
	{
		if (is_object($this->mem)) return TRUE;
		$persistent = $this->config['servers']['persistent'];
		if ($persistent) {
			$this->mem = new Memcached('story_pool');
		} else {
			$this->mem = new Memcached();
		}

		$this->mem->setOption(Memcached::OPT_HASH, Memcached::HASH_FNV1A_32);
		$this->mem->setOption(Memcached::OPT_DISTRIBUTION, Memcached::DISTRIBUTION_CONSISTENT);
		//开启二进制协议，导致getMulti()出错，http://pecl.php.net/bugs/bug.php?id=16959
		//所以不使用getMulti()
		$this->mem->setOption(Memcached::OPT_BINARY_PROTOCOL, TRUE);
		if (!count($this->mem->getServerList())) {
			$this->mem->addServers($this->config['servers']);
		}
		return TRUE;
	}
	
	public function set($key, $value, $timeout=0) 
	{
		if (!$this->mem OR !is_object($this->mem)) $this->init_memcache();
		if( !empty($timeout) ) {
			$this->cachetime = $timeout;
		}
		if( !$this->mem->set($this->cachepre.$key, $value, $this->cachetime) ) {
			return false;
		}
		return true;
	}

	public function get($key, $type = CACHE_MEMCACHE)
	{
		if (!$this->mem OR !is_object($this->mem)) $this->init_memcache();
		if ((($return = $this->mem->get($this->cachepre.$key)) !== false)) {
			return $return;
		}
		return NULL;
	}
	
	public function delete($key, $timeout=0) 
	{
		if (!$this->mem OR !is_object($this->mem)) $this->init_memcache();
		$this->mem->delete( $this->cachepre.$key, $timeout );
	}
	
}
?>