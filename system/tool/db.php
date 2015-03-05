<?php

///*
////测试主从分离
//输出：
//array(2) {
//  ["127.0.0.1:3306"]=>
//  array(2) {
//	["linker"]=>
//	resource(3) of type (mysql link)
//	["database"]=>
//	string(2) "gm"
//  }
//  ["localhost:3306"]=>
//  array(2) {
//	["linker"]=>
//	resource(5) of type (mysql link)
//	["database"]=>
//	string(2) "gm"
//  }
//}
//即连接池中存在两个连接，一写一读
//*/
//$db2 = db::instance('default');
//$sql = "insert into test values(1) ";
//$db2->query($sql);
//$sql = "select * from test ";
//$db2->query($sql);
//$data = $db2->fetch_all();
//var_dump($db2::$links);exit;
//
///*
////测试一主多从
//输出：
//string(9) "localhost" 
//或者
//string(9) "192.168.1.145"
//*/
//$db1 = db::instance();
//$sql = "select * from test ";
//$db1->query($sql);
//$current_config = $db1->get_current_config();
//var_dump($current_config['hostname']);exit;
//
//
///*
//测试单件, 
//输出：
//bool(false)
//bool(true)
//bool(true)
//*/
//$db1 = db::instance('yx');
//$db2 = db::instance();
//$db3 = db::instance();
//$db4 = db::instance('yx');
//var_dump($db1 === $db2);
//var_dump($db3 === $db2);
//var_dump($db1 === $db4);exit;
//
//
//
//class glb
//{
//	public static $config = array(
//
//		//数据库连接信息
//		'database' => array(
//			'default' => array( //主从从..
//				array(
//					'hostname'   => '127.0.0.1',
//					'port'   => 3306,
//					'database'   => 'gm',
//					'username'   => 'root',
//					'password'   => '1',
//					'persistent' => false,
//					'charset'	  => 'utf8',
//					'table_prefix' => 'jd_',
//				),
//				array(
//					'hostname'   => 'localhost',
//					'port'   => 3306,
//					'database'   => 'gm',
//					'username'   => 'root',
//					'password'   => '1',
//					'persistent' => false,
//					'charset'	  => 'utf8',
//					'table_prefix' => 'jd_',
//				),
//				array(
//					'hostname'   => '192.168.1.145',
//					'port'   => 3306,
//					'database'   => 'yx',
//					'username'   => 'root',
//					'password'   => '1',
//					'persistent' => false,
//					'charset'	  => 'utf8',
//					'table_prefix' => '',
//				),
//			 ),
//			'yx' => array( //主从从..
//				array(
//					'hostname'   => '192.168.1.145',
//					'port'   => 3306,
//					'database'   => 'yx',
//					'username'   => 'root',
//					'password'   => '1',
//					'persistent' => false,
//					'charset'	  => 'utf8',
//					'table_prefix' => '',
//				),
//			 ),
//		),
//		'charset' => 'utf-8', //utf-8,gbk,big5
//	);
//}

/**
 * 数据库扩展 mysql
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class db
{
	/**
	 */
	protected $sql = '';
	protected $current_link; // 当前连接标识
	protected $query;
	protected $query_count = 0;
	protected $config;
	public static $inst;
	public static $links; //链接池
	
	/**
	 * 实例化
	 *
	 * @return object
	 */
	public static function instance($name = 'default')
	{
		$config = glb::$config['database'][$name];
		if (empty(self::$inst[$name]))
		{
			self::$inst[$name] = new db($config);
		}
		return self::$inst[$name];
	}
	
	public function __construct($config = array())
	{
		$this->mainconfig = $config;
	}
	
	public function get_current_config()
	{
		return $this->config;
	}

	/**
	 * 连接数据库
	 *
	 * @return void
	 */
	protected function connect($is_master = false)
	{
		//如果有设置主库
		if ($is_master) 
		{
			if (isset($this->mainconfig[0])) {
				$this->config = $this->mainconfig[0];
			}
		} 
		else 
		{
			//如果有设置从库
			if (isset($this->mainconfig[1])) {
				$count = count($this->mainconfig) - 1;
				$index = rand(1, $count);
				$this->config = $this->mainconfig[$index];
			} 
			else if (isset($this->mainconfig[0]))
			{
				$this->config = $this->mainconfig[0];
			}
		}
		$linkname = $this->config['hostname'].':'.$this->config['port'];
		#var_dump($this->config['database']);
		try
		{	
			//如果链接不存在，则新建链接并连接数据库
			if (empty(self::$links[$linkname]))
			{		
				//这里这里 是否影响性能
				if ($this->config['persistent']) {
					$fun_connect = 'mysql_pconnect';
				} else {
					$fun_connect = 'mysql_connect';
				}
				$linker = @$fun_connect($this->config['hostname'].':'.$this->config['port'], $this->config['username'], $this->config['password']);
				//define('CLIENT_MULTI_RESULTS', 131072);
				//$linker = @mysql_connect(DB_HOST, DB_USER, DB_PASS, 1, CLIENT_MULTI_RESULTS);
				if (empty($linker))
				{
					throw new Exception(mysql_error(), 10);
				}
				else
				{
					if (mysql_get_server_info() > '4.1')
					{
						$charset = str_replace('-', '', strtolower($this->config['charset']));
						mysql_query("SET character_set_connection=" . $charset . ", character_set_results=" . $charset . ", character_set_client=binary");
					}
					if (mysql_get_server_info() > '5.0')
					{
						mysql_query("SET sql_mode=''");
					}
					if (!@mysql_select_db($this->config['database']))
					{
						throw new Exception(mysql_error(), 11);
					}
				}
				self::$links[$linkname] = array(
					'linker' => $linker,
					'database' => $this->config['database'],
				);
			}
			//如果链接已经存在，但是数据库改变了
			else if (self::$links[$linkname]['database'] != $this->config['database'])
			{
				if (!@mysql_select_db($this->config['database']))
				{
					throw new Exception(mysql_error(), 11);
				}
				//更新链接池中该链接的数据库名
				self::$links[$linkname]['database'] = $this->config['database'];
			}	
		}
		catch (Exception $e)
		{
			$this->halt($e, '');
			exit;
		}
		$this->current_link = self::$links[$linkname]['linker'];
		return $this->current_link;
	}

	/**
	 * 查询
	 *
	 * @param  string $sql
	 * @return bool
	 */
	public function query($sql)
	{		
		try		
		{
			$sql = trim($sql);
			/*//自动给表名添加前缀
			if ($this->config['table_prefix'])
			{
				if (preg_match("/select(.*)from\s*(`?)(.*)/i", $sql, $match)) 
				{
					$sql = "SELECT ".$match[1]." FROM ".$match[2].$this->config['table_prefix'].$match[3];
				}
				else if (preg_match("/(update|insert)\s*(.*)/i", $sql, $match)) 
				{
					$sql = $match[1]." ".$this->config['table_prefix'].$match[2];
				}
			}*/
			
			$is_master = false;
				
			//写操作 
			if (preg_match("/(delete|update|insert|replace)/i", $sql))
			{
				$is_master = true;
	
				//操作记录
				clog::write($this->sql, glb::$config['log']['operation']);
			}
	
			$this->connect($is_master);
			
			//表前缀替换
			$sql = str_replace('#PRE#', $this->config['table_prefix'], $sql);
			
			if (DEBUG_LEVEL) 
			{
				error_log($sql."\n", 3, 'sql.log');
			}
			
			$this->sql = $sql;
			$this->query = @mysql_query($sql, $this->current_link);
			if (!$this->query)
			{
				throw new Exception(mysql_error(), 443);
			}
			else
			{
				$this->query_count++;
				return $this->query;
			}
		}
		catch (Exception $e)
		{
			$this->halt($e, $sql);
			return false;
		}
	}


	/**
	 * 取得最后一次插入记录的ID值
	 *
	 * @return int
	 */
	public function insert_id()
	{
		return mysql_insert_id($this->current_link);
	}


	/**
	 * 返回受影响数目
	 *
	 * @return init
	 */
	public function affected_rows()
	{
		return mysql_affected_rows($this->current_link);
	}


	/**
	 * 返回本次查询所得的总记录数...
	 *
	 * @return int
	 */
	public function num_rows($query = false)
	{
		(empty($query)) && $query = $this->query;
		return mysql_num_rows($query);
	}

	/********** 方式一 **********/
	/**
	 * (读)返回单条中第一个记录数据
	 *
	 * @param  int   $result_type
	 * @return mixed
	 */
	public function fetch_one($query = false)
	{
		(empty($query)) && $query = $this->query;
		$row = mysql_fetch_array($query, MYSQL_NUM);
		return (empty($row)) ? false : $row[0];
	}

	/**
	 * (读)返回单条记录数据
	 *
	 * @deprecated   MYSQL_ASSOC==1 MYSQL_NUM==2 MYSQL_BOTH==3
	 * @param  int   $result_type
	 * @return array
	 */
	public function fetch_row($query = false)
	{
		(empty($query)) && $query = $this->query;
		return mysql_fetch_array($query, MYSQL_ASSOC);
	}


	/**
	 * (读)返回多条记录数据
	 *
	 * @deprecated	MYSQL_ASSOC==1 MYSQL_NUM==2 MYSQL_BOTH==3
	 * @param   int   $result_type
	 * @return  array
	 */
	public function fetch_all($query = false)
	{
		(empty($query)) && $query = $this->query;
		$row = $rows = array();
		while ($row = mysql_fetch_array($query, MYSQL_ASSOC))
		{
			$rows[] = $row;
		}
		return (empty($rows)) ? false : $rows;
	}

	/********** 方式二 **********/

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
		try
		{
			if (empty($table) || empty($fields) || empty($condition))
			{
				throw new Exception('查询数据的表名，字段，条件不能为空', 444);
			}

			$this->sql = "SELECT {$fields} FROM `#PRE#{$table}` WHERE {$condition}";
			$result = $this->query($this->sql);
			return $this->fetch_all();
		}
		catch (Exception $e)
		{
			$this->halt($e, $this->sql);
			return false;
		}
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
		try
		{
			if (empty($table) || empty($data) || empty($condition))
			throw new Exception('更新数据的表名，数据，条件不能为空', 444);

			if(!is_array($data))
			throw new Exception('更新数据必须是数组', 444);
			
			/*//过滤字段
			if ($columns = $this->get_column($table))
			{
				foreach ($data as $k=>$v)
				{
					if (!in_array($k, $columns))
					unset($data[$k]);
				}
			}*/

			$set = '';
			foreach ($data as $k => $v) {
				if ($v === null) unset($data[$k]);
				$set .= empty($set) ? ("`{$k}` = '{$v}'") : (", `{$k}` = '{$v}'");
			}

			if (empty($set)) 
			throw new Exception('更新数据格式化失败', 444);

			$this->sql = "UPDATE `#PRE#{$table}` SET {$set} WHERE {$condition}";
			$result = $this->query($this->sql);
			
			// 返回影响行数
			return $this->affected_rows();
		}
		catch (Exception $e)
		{
			$this->halt($e, $this->sql);
			return false;
		}
	}


	/**
	 * 插入数据
	 *
	 * @param string $table
	 * @param array $fields
	 * @param array $data
	 * @return boolean
	 */
	public function insert($table, $data, $isreplace = false)
	{
		try
		{
			if (empty($table) || empty($data)) {
				throw new Exception('插入数据的表名，字段、数据不能为空', 444);
			}

			if (!is_array($data))
			{
				throw new Exception('插入数据的数据必须是数组', 444);
			}
			
			/*//过滤字段
			if ($columns = $this->get_column($table))
			{
				foreach ($fields as $k=>$v)
				{
					if (!in_array($v, $columns))
					{
						unset($fields[$k]);
						unset($data[$k]);
					}
				}
			}*/
			$fields = array_keys($data);
			$datas = array_values($data);

			// 格式化字段
			$_fields = '`' . implode('`, `', $fields) . '`';

			// 格式化需要插入的数据
			$_data = $this->format_insert_data($datas);

			if (empty($_fields) || empty($_data))
			{
				throw new Exception('插入数据的字段和数据必须是数组', 444);
			}

			if ($isreplace) 
			{
				$this->sql = "REPLACE INTO `#PRE#{$table}` ({$_fields}) VALUES {$_data}";
			}
			else
			{
				$this->sql = "INSERT INTO `#PRE#{$table}` ({$_fields}) VALUES {$_data}";
			}
			$result = $this->query($this->sql);

			return $this->affected_rows();
		}
		catch (Exception $e)
		{
			$this->halt($e, $this->sql);
			return false;
		}
	}

	/**
	 * 格式化 insert 数据，将数组（二维数组）转换成向数据库插入记录时接受的字符串
	 *
	 * @param array $data
	 * @return string
	 */
	protected function format_insert_data($data)
	{
		if (!is_array($data) || empty($data))
		{
			throw new Exception('数据的类型不是数组', 445);
		}

		$output = '';
		foreach ($data as $value)
		{
			// 如果是二维数组
			if (is_array($value))
			{
				$tmp = '(\'' . implode("', '", $value) . '\')';
				$output .= !empty($output) ? ", {$tmp}" : $tmp;
				unset($tmp);
			}
			else
			{
				$output = '(\'' . implode("', '", $data) . '\')';
			}
		} //foreach

		return $output;
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
		try
		{
			if (empty($table) || empty($condition))
			{
				throw new Exception('表名和条件不能为空', 444);
			}

			$this->sql = "DELETE FROM `#PRE#{$table}` WHERE {$condition}";
			$result = $this->query($this->sql);

			return $this->affected_rows();
		}
		catch (Exception $e)
		{
			$this->halt($e, $this->sql);
			return false;
		}
	}


	/**
	 * 查询记录数
	 *
	 * @param string $table
	 * @param string $condition
	 * @return int
	 */
	public function get_num_rows($table, $condition)
	{
		try
		{
			if (empty($table) || empty($condition))
			throw new Exception('查询记录数的表名，字段，条件不能为空', 444);

			$this->sql = "SELECT count(*) AS total FROM `#PRE#$table` WHERE {$condition}";
			$result = $this->query($this->sql);

			$tmp = $this->fetch_row();
			return (empty($tmp)) ? false : $tmp['total'];
		}
		catch (Exception $e)
		{
			$this->halt($e, $this->sql);
			return false;
		}
	}
	
	/********** 方式三 **********/
	
	public function getone($sql)
	{
		$this->sql = $sql;
		$result = $this->query($this->sql);
		$row = mysql_fetch_array($this->query, MYSQL_NUM);
		return (empty($row[0])) ? false : $row[0];
	}
	public function getrow($sql)
	{
		$this->sql = $sql;
		$result = $this->query($this->sql);
		$row = mysql_fetch_array($this->query, MYSQL_ASSOC);
		return (empty($row)) ? false : $row;
	}
	//$column_num 获取第几列
	public function getcol($sql, $column_num = 0)
	{
		$this->sql = $sql;
		$result = $this->query($this->sql);
		while ($row = mysql_fetch_array($this->query, MYSQL_NUM))
		{
			$cols[] = $row[$column_num];
		}
		return (empty($cols)) ? false : $cols;
	}
	public function getall($sql)
	{
		$this->sql = $sql;
		$result = $this->query($this->sql);
		while ($row = mysql_fetch_array($this->query, MYSQL_ASSOC))
		{
			$rows[] = $row;
		}
		return (empty($rows)) ? false : $rows;
	}

	/**
	 * 返回版本信息
	 * @return <type>
	 */
	public function server_info()
	{
		return mysql_get_server_info();
	}

	/**
	 * 选择数据库
	 * @return <type>
	 */
	public function select_db($dbname)
	{
		return mysql_select_db($dbname);
	}

	/**
	 * 获取当前执行的 SQL
	 *
	 * @return string
	 */
	public function get_sql()
	{
		return $this->sql;
	}
	
	/**
	 * 获取表的字段
	 *
	 * @return array
	 */
	public function get_column($tablename)
	{
		$data = $this->getall("show columns from `#PRE#$tablename`");
		if ($data)
		{
			foreach ($data as $k=>$onecolumn)
			{
				$newarr[] = $onecolumn['Field'];
			}
		}
		return $newarr ? $newarr : false;
	}
	
	/**
	 * 添加表字段
	 *
	 * @return array
	 */
	public function add_column($tablename, $columnname, $columntype='int')
	{
		if ($columns = $this->get_column($table))
		{			
			if (!in_array($columnname, $columns))
			{
				if ($columntype == 'int')
				{
					$sql = "alter table `$tablename` add column `$columnname` int(10) default NULL";
				}
				else if ($columntype == 'varchar')
				{
					$sql = "alter table `$tablename` add column `$columnname` varchar(255) default NULL";
				}
				else
				{
					throw new Exception('不合法的参数$columntype', 444);
				}
				if ($sql)
				$this->query($sql);
			}
		}
	}

	/**
	 * 异常处理
	 * @param Exception $e
	 * @param string $sqlstr
	 * @param bool $conn
	 */
	private function halt($e, $sqlstr, $conn = false)
	{
		$sqlstr = empty($sqlstr) ? $this->sql : $sqlstr;
		if (!defined('DEBUG_LEVEL') || !DEBUG_LEVEL)
		{
			if ($e->getCode() == 10)
			{
				echo '数据库连接失败，可能是数据库服务器地址、账号或密码错误.请联系管理员';
			}
			else if ($e->getCode() == 11)
			{
				echo '数据库' . $this->config['database'] . '不存在.请联系管理员';
			}
			else if ($e->getCode() == 443)
			{
				echo 'SQL查询异常.请联系管理员';
			}
			else if ($e->getCode() == 444 || $e->getCode() == 445)
			{
				echo 'SQL查询参数异常.请联系管理员';
			}
			else
			{
				echo '未捕获的异常.请联系管理员';
			}
		}
		else
		{
			echo '<pre>', $e->getMessage(), '<br/>' , $e->getTraceAsString(), '<br/>';
			echo '<strong>Query: </strong> ' . $sqlstr;
			echo '</pre>';
		}
		$this->log_err($e->getMessage());
		exit;
	}

	/**
	 * 记录错误日志
	 *
	 * @return void
	 */
	private function log_err($message, $sqlstr='')
	{
		$sqlstr = empty($sqlstr) ? $this->sql : $sqlstr;
		clog::mysql_log($message, $sqlstr, mysql_errno());
	}
}
?>
