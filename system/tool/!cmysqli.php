<?php
/**
 *  Netap Web framework. 
 *  (C)1999-2011 ND Inc.
 *  2011-03-25 11:13:25
 *  cmysqli 模块组件
 */

class cmysqli {
	//存放共用连接
	private static $pool_link = array ();
	
	//存放共用连接的数据库名称
	private static $pool_dbname = array ();
	
	private static $current_link = null;
	
	private $current_dsn = null;
	
	private $insert_id = null;
	
	// mysql instances
	protected static $_instance;
	
	//事务开始值
	private $trans_flag = false;
	
	function __construct($dsn = NULL)
	{
		if ($dsn == NULL || $dsn == 'default') {
			$dsn = Netap_Config::config( 'database' );
			$dsn = $dsn['default'];
		}
		
		if (! isset( $dsn["hostname"] ) || ! isset( $dsn["port"] )) {
			$this->halt( "数据库配置不合法 : config=" . $dsn );
		}
		$linkkey = $dsn['hostname'] . '_' . $dsn['port'];
		
		$this->current_dsn = $dsn;
		
		if (! array_key_exists( $linkkey, self::$pool_link )) {
			self::$current_link = new mysqli( $dsn["hostname"], $dsn["username"], $dsn["password"], $dsn['database'], $dsn["port"] );
			if (self::$current_link->connect_error) {
				$this->halt( "数据库连接失败 :errorno=" . self::$current_link->connect_errno . ',error=' . self::$current_link->connect_error );
			} else {
				self::$pool_link[$linkkey] = self::$current_link;
				self::$pool_dbname[$linkkey] = $dsn['database'];
			}
		} else {
			if ($dsn['database'] != self::$pool_dbname[$linkkey]) {
				$this->changeDatabase();
			} else {
				self::$current_link = self::$pool_link[$linkkey];
			}
		}
	}

	/**
	 * Singleton pattern
	 * $var $flag 强制重新实例化数据库
	 * @return mysql
	 */
	public static function instance($dsn = NULL, $flag = false)
	{
		if ( ! isset(self::$_instance) || $flag)
		{
			// Create a new session instance
			self::$_instance = new self($dsn);
		}

		return self::$_instance;
	}
	
	/**
	 * 设置事务是否为自动提交,默认不自动提交
	 *
	 * @param bool $onoff  true turns it on, false turns it off
	 *
	 */
	public function trans_begin()
	{
		$this->trans_flag = true;
		return mysqli_autocommit( self::$current_link, FALSE );
	}
	
	/**
	 * 事务回滚
	 */
	public function trans_rollback()
	{
		$this->trans_flag = false;
		$result = mysqli_rollback( self::$current_link );
		mysqli_autocommit( self::$current_link, TRUE );
		if (! $result) {
			$this->halt( "事务回滚失败" );
		}
		return $result;
	}
	
	/**
	 * 事务提交处理
	 * @return boolean
	 */
	public function trans_commit()
	{
		$this->trans_flag = false;
		$result = mysqli_commit( self::$current_link );
		mysqli_autocommit( self::$current_link, TRUE );
		
		if (! $result) {
			$this->halt( "事务处理失败" );
		}
		return $result;
	}
	
	public function fetch_array($query, $result_type = MYSQLI_ASSOC)
	{
		return mysqli_fetch_array( $query, $result_type );
	}
	
	public function fetch_first($sql)
	{
		$query = $this->_query( $sql );
		return $this->fetch_array( $query );
	}
	
	public function fetch_all($sql, $id = '', $multi = FALSE)
	{
		$arr = array ();
		if ($multi) {
			if ($this->_multi_query( $sql )) {
				$i = 0;
				do {
					/* 数据结果集 */
					if ($result = mysqli_store_result( self::$current_link )) {
						while ( $row = $this->fetch_array( $result ) ) {
							$id ? $arr[$i][$row[$id]] = $row : $arr[$i][] = $row;
						}
						
						$this->free_result( $result );
						$i++;
					}
					
					/* 判断还有没有结果集 */
					if (! mysqli_more_results( self::$current_link )) {
						break;
					}
				} while ( mysqli_next_result( self::$current_link ) );
			}
		} else {
			$query = $this->_query( $sql );
			while ( $data = $this->fetch_array( $query ) ) {
				$id ? $arr[$data[$id]] = $data : $arr[] = $data;
			}
		}
		return $arr;
	}
	
	public function query($sql, $type = "SELECT", $multi = FALSE, $id = '')
	{
		$type = in_array( $type, array ("SELECT", "UPDATE", "INSERT", "DELETE" ) ) ? $type : "SELECT";
		if (isset($_GET['debug'])) {
			error_log("[".date('Y-m-d H:i:s')."]".$sql."\n", 3, 'sql.log');	
		}
		if ($type == 'UPDATE' || $type == 'DELETE') {
			if ($multi) {
				$result = $this->_multi_query( $sql );

				//修复多个时事务Commands out of sync; you can't run this command now
				while (mysqli_more_results( self::$current_link ) && mysqli_next_result( self::$current_link ));
				
				return $result;
			} else {
				return $this->_query( $sql );
			}
			
		} elseif ($type == 'INSERT') {
			
			return $this->_query( $sql );
			//return $this->insert_id();
		}
		
		return $this->fetch_all( $sql, $id, $multi );
	}
	
	public function affected_rows()
	{
		return mysqli_affected_rows( self::$current_link );
	}
	
	public function error()
	{
		//return ((self::$current_link) ? mysqli_error( self::$current_link ) : mysqli_error());
		return  mysqli_error( self::$current_link );
	}
	
	public function errno()
	{
		return intval( (self::$current_link) ? mysqli_errno( self::$current_link ) : mysqli_errno() );
	}
	
	public function num_rows($query)
	{
		$query = mysqli_num_rows( $query );
		return $query;
	}
	
	public function num_fields($query)
	{
		return mysqli_num_fields( $query );
	}
	
	public function free_result($query)
	{
		return mysqli_free_result( $query );
	}
	
	public function insert_id()
	{
		return mysqli_insert_id( self::$current_link );
	}
	
	public function fetch_row($query)
	{
		$query = mysqli_fetch_row( $query );
		return $query;
	}
	
	public function fetch_fields($query)
	{
		return mysqli_fetch_field( $query );
	}
	
	public function version()
	{
		return mysqli_get_server_info( self::$current_link );
	}
	
	public function close()
	{
		return mysqli_close( self::$current_link );
	}
	
	public function halt($message = '', $sql = '', $privage = 1)
	{
		if ($this->trans_flag) {
			$this->trans_rollback();
		}
		
		throw new Exception( "[" . $message . "] " . $this->error() . " -- " . $sql, $this->errno() );
	}
	
	public function get_currrent_dsn()
	{
		return $this->current_dsn;
	}
	
	private function _query($sql, $type = '', $cachetime = FALSE)
	{
		$this->check();
		if (! ($query = mysqli_query( self::$current_link, $sql )) && $type != 'SILENT') {
			$this->halt( 'MySQLi Query Error', $sql );
		}
		
		return $query;
	}
	
	/**
	 * 一次执行多条SQL语句
	 */
	private function _multi_query($sql)
	{
		$this->check();
		if (! ($query = mysqli_multi_query( self::$current_link, $sql ))) {
			$this->halt( 'MySQLi Multi Query Error', $sql );
		}
		
		return $query;
	}
	
	private function check()
	{
		$linkkey = $this->current_dsn['hostname'] . '_' . $this->current_dsn['port'];
		if ($this->current_dsn['database'] != self::$pool_dbname[$linkkey]) {
			$this->changeDatabase();
		} else {
			mysqli_query( self::$current_link, "SET NAMES {$this->current_dsn['charset']}" );
		}
	}
	
	private function changeDatabase()
	{
		$linkkey = $this->current_dsn['hostname'] . '_' . $this->current_dsn['port'];
		if (! mysqli_select_db( self::$pool_link[$linkkey], $this->current_dsn['database'] )) {
			$this->halt( "数据库切换失败 :host=" . $linkkey . ",dbname=" . $this->current_dsn['database'] );
		} else {
			self::$current_link = self::$pool_link[$linkkey];
			
			self::$pool_dbname[$linkkey] = $this->current_dsn['database'];
			mysqli_query( self::$current_link, "SET NAMES {$this->current_dsn['charset']}" );
		}
	}
	
	
	
	//==================================
	//补充函数 byy
	//==================================
	
	/**
	 * 查询数据库记录，以数组方式返回数据
	 *
	 * @param string $table
	 * @param string $fields
	 * @param string $condition
	 * @return array
	 */
	public function select($table, $fields = '*', $condition = '1')
	{
		if (empty($table) || empty($fields))
		{
			$this->halt('查询数据的表名，字段不能为空');
		}

		$sql = "SELECT {$fields} FROM `{$table}` WHERE {$condition}";
		return $this->query( $sql, 'SELECT' );
	}


	/**
	 * 更新数据库记录 UPDATE，返回更新的记录数量
	 *
	 * @param string $table
	 * @param array $data
	 * @param string $condition
	 * @return int
	 */
	public function update($table, $data, $condition)
	{
		if (empty($table) || empty($data) || empty($condition))
		$this->halt('更新数据的表名，数据，条件不能为空');

		if(!is_array($data))
		$this->halt('更新数据必须是数组');
		
		//过滤字段
		//..

		$set = '';
		foreach ($data as $k => $v) {
			if ($v === null) unset($data[$k]);
			$set .= empty($set) ? ("`{$k}` = '{$v}'") : (", `{$k}` = '{$v}'");
		}

		if (empty($set)) $this->halt('更新数据格式化失败');

		$sql = "UPDATE `{$table}` SET {$set} WHERE {$condition}";
		$query = $this->query( $sql, 'UPDATE' );

		return true;
	}


	/**
	 * 插入数据
	 *
	 * @param string $table
	 * @param array $data
	 * @return boolean
	 */
	public function insert($table, $data)
	{
		if (empty($table) || empty($data)) {
			$this->halt('插入数据的表名，数据不能为空');
		}

		if (!is_array($data))
		{
			$this->halt('插入数据必须是数组');
		}
		
		$fields = array_keys($data);
		$datas = array_values($data);
		
		//过滤字段..

		// 格式化字段
		$_fields = '`' . implode('`, `', $fields) . '`';

		// 格式化需要插入的数据
		$_data = '(\'' . implode("', '", $datas) . '\')';

		if (empty($_fields) || empty($_data))
		{
			$this->halt('插入数据不能为空');
		}

		$sql = "INSERT INTO `{$table}` ({$_fields}) VALUES {$_data}";
		$query = $this->_query( $sql, 'INSERT' );

		return true;
	}

	/**
	 * 删除记录
	 *
	 * @param string $table
	 * @param string $condition
	 * @return num
	 */
	public function delete($table, $condition)
	{
		if (empty($table) || empty($condition))
		{
			$this->halt('表名和条件不能为空');
		}

		$sql = "DELETE FROM `{$table}` WHERE {$condition}";
		$query = $this->query( $sql, 'DELETE' );

		return true;
	}


}