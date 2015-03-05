<?php
/**
 * 配置信息管理类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class m_config extends db_gate
{
	//指定数据表名
	protected $tableName = "config"; 
	
	//指定主键名，默认值为'id'
	protected $primaryKey = 'id';
	
	/**
	 * 获取某个配置信息
	 */
	public function get_one_config($key)
	{
		if (empty($key)) return false;
		$key = addslashes($key);

		$data = db::instance()->select('config', 'cf_value', "cf_name = '{$key}'");
		return (empty($data)) ? false : $data[0]['cf_value'];
	}

	/**
	 * 读配置
	 *
	 * @param  array
	 * @return array
	 * @throws none
	 */
	public function get_configs( $keys = array() )
	{
		$values = array ();
		if (empty($keys)) //参数为空，则读取全部
		{
			db::instance()->query("select cf_name,cf_value from #PRE#config ");
			while ($row = db::instance()->fetch_row())
			{
				$values[$row['cf_name']] = $row['cf_value'];				
			}
		}
		else
		{			
			foreach( $keys as $current_key )
			{
				db::instance()->query("select cf_value from #PRE#config where `cf_name` = '" . $current_key . "'");
				$current_row = db::instance()->fetch_row();
				$values[$current_key] = $current_row['cf_value'];
			}
		}

		return $values;
	}


	/**
	 * 写配置
	 *
	 * @param  array
	 * @return none
	 * @throws none
	 */
	public function set_configs( $configs = array() )
	{
		foreach( $configs as $current_key => $current_value )
		{
			if( false === strpos( $current_key, 'cf_' ) )
			{
				$current_key = 'cf_' . $current_key;
			}
			db::instance()->query("replace #PRE#config set `cf_value` = '" . $current_value . "', `cf_name` = '" . $current_key . "'");
		}
	}

	public function getall( )
	{
		$basic_keys = array ();
		return self::get_configs( $basic_keys );
	}

	public function setall( $config )
	{
		self::set_configs( $config );
	}
	
	
	/**
	 * 获取ip禁止列表
	 *
	 * @param  none
	 * @return string
	 * @throws none
	 */
	public function get_ip_deny_list()
	{
		$configs = self::get_configs( array('cf_ipban') );
		$ip_deny_list = str_replace( ",", "\n", $configs['cf_ipban'] );
		return $ip_deny_list;
	}


	/**
	 * 设置ip禁止列表
	 *
	 * @param  string
	 * @return boolean
	 * @throws none
	 */
	public function set_ip_deny_list( $ip_deny_list)
	{
		$ip_deny_list = str_replace( array("\r\n", "\n", "\r"), ",", $ip_deny_list );
		self::set_configs( array( 'cf_ipban' => $ip_deny_list) );
	}

}
?>