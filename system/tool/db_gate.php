<?php
/**
 * 数据库接口 DML  
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class db_gate
{
	protected $tableName;
	protected $tableNameFull;
	protected $primaryKey = 'id';
	protected $hasMany;
	protected $hasOne;
	protected $belongTo;
	protected $db; //数据库实例

	function __construct()
	{
		if (!$this->primaryKey)
		{
			throw new Exception("\$primaryKey未设置");
		}
		$this->tableNameFull = $this->tableName ? '#PRE#'.$this->tableName : null;

		//改为二维数组
		if ($this->hasMany && !is_array($this->hasMany[0]))
		{
			$tmp = $this->hasMany;
			unset($this->hasMany);
			$this->hasMany[0] = $tmp;
		}
		if ($this->hasOne && !is_array($this->hasOne[0]))
		{
			$tmp = $this->hasOne;
			unset($this->hasOne);
			$this->hasOne[0] = $tmp;
		}
		//定义检测
		if ($this->hasMany)
		{
			foreach ($this->hasMany as $one)
			{
				$this->_checkHas($one);
			}
		}
		if ($this->hasOne)
		{
			foreach ($this->hasOne as $one)
			{
				$this->_checkHas($one);
			}
		}
		$this->db = dbmysqli::instance();
	}

	/**
	 * 获取最大主键值
	 *
	 * @return int
	 */
	function get_max_id()
	{
		$num = $this->db->getone("select MAX(".$this->primaryKey.") from ".$this->tableNameFull." " );
		return $num;
	}

	/**
	 * 获取行数量
	 *
	 * @return int
	 */
	function get_count($condition='')
	{
		$sql = "select count(0) from ".$this->tableNameFull." ";
		if ($condition)
		{
			$sql .= " where " .$condition;
		}
		$num = $this->db->getone($sql);
		return $num;
	}

	/**
	 * 读取数据
	 *
	 * @param string $fieldNameList  eg.:'username,email,lastip'
	 * @param string $condition
	 * @param string $start
	 * @param string $num
	 * @param string & $total 记录数量
	 * @return array or bool
	 */
	function get_list($fieldNameList='*', $condition='', $start=0, $num=0, & $total = null)
	{
		$sql = "select SQL_CALC_FOUND_ROWS $fieldNameList from `$this->tableNameFull` ";
		if ($condition)
		{
			$sql .= " where " .$condition;
		}
		//获取行数量
		if (!$total = $this->db->getone('SELECT FOUND_ROWS();'))
			return false;
		//
		if ($start>=0 && $num>0)
		{
			$sql .= "limit $start,$num";
		}
		$result = $this->db->getall($sql);
		if (!$result)
			return false;
		
		if (!empty($this->hasMany) || !empty($this->hasOne))
		{
			$newarr = array();
			foreach ($result as $k=>$row)
			{
				$newarr = $row;
				if ($this->hasMany)
				{
					foreach ($this->hasMany as $one)
					{
						if ($one['centerTable'])
						{
							$sql = "select * from `#PRE#".$one['table2']."` where ".$one['primaryKey2']." in (select ".$one['foreignKey2']." from `#PRE#".$one['centerTable']."` where ".$one['foreignKey1']."='".$row[$this->primaryKey]."')";
							$newarr[$one['mapping']] = $this->db->getall($sql);
						}
						else
						{
							$foreignTableName = '#PRE#'.$one['table'];
							$sql = "select * from `".$foreignTableName."` where ".$one['foreignKey']."='".$row[$this->primaryKey]."'";
							$newarr[$one['mapping']] = $this->db->getall($sql);
						}
					}
				}
				if ($this->hasOne)
				{
					foreach ($this->hasOne as $one)
					{
						$foreignTableName = '#PRE#'.$one['table'];
						$sql = "select * from `".$foreignTableName."` where ".$one['primaryKey']."='".$row[$one['foreignKey']]."'";
						$newarr[$one['mapping']] = $this->db->getrow($sql);
					}
				}
				$result[$k] = $newarr;
			}
		}
		return $result;
	}
	
	/**
	 * 读取数据
	 *
	 * @param string $fieldNameList  eg.:'username,email,lastip'
	 * @param string $condition
	 * @return array or bool
	 */
	function get_all($fieldNameList='*', $condition='')
	{
		$d = $this->get_list($fieldNameList, $condition, null, null, $total);
		return $d;
	}

	/**
	 * 读取一条数据
	 *
	 * @param string $fieldNameList  eg.:'username,email,lastip'
	 * @param string $condition
	 * @return array or bool
	 */
	function get_row($fieldNameList='*', $condition='')
	{
		$data = $this->get_all($fieldNameList, $condition);
		return $data ? $data[0] : false;
	}

	/**
	 * 读取单个数据
	 *
	 * @param string $condition
	 * @return array or bool
	 */
	function get_one($fieldName, $condition)
	{
		$data = $this->get_all($fieldName, $condition);
		if (!$data)
		return false;
		if (!isset($data[0][$fieldName]))
		return false;
		return $data[0][$fieldName];
	}

	/**
	 * 添加数据，数据为数组形式。
	 *
	 * @param array $data
	 */
	function add($data)
	{
		self::save($data, 'add');
	}
	
	/**
	 * 编辑数据，数据为数组形式。
	 *
	 * @param array $data
	 */
	function edit($data)
	{
		self::save($data, 'edit');
	}

	/**
	 * 添加、编辑数据，数据为数组形式。
	 *
	 * @param array $data
	 * @param string $flag 可用值：add,edit
	 */
	function save($data, $flag=null)
	{
		if (!$data)
		throw new Exception("要添加或编辑的数据不能为空.");
		if (!is_array($data))
		throw new Exception("要添加或编辑的数据应该是数组.");
		if (!isset($data[0]))
		{
			$tmpd[] = $data;
			$data = $tmpd;
		}
		foreach ($data as $k=>$row)
		{
			$insert_id = null;
			$edit = ($flag == 'edit') ? true : false;
			$num = 0;
			$row_copy = $row;
			//判断是添加还是编辑
			if (!$flag && $row_copy[$this->primaryKey])
			{
				$num = $this->db->getone("select count(0) from ".$this->tableNameFull." where ".$this->primaryKey."='".$row_copy[$this->primaryKey]."'");
				$edit = $num ? true : false;
			}
			else
			{
				$edit = ($flag=='edit') ? true : false;
			}
			if (!empty($this->hasMany))
			{
				foreach ($this->hasMany as $one)
				{
					unset($row_copy[$one['mapping']]);
					unset($row_copy[$one['counter']]);
					//补充数据
					if ($edit)
					{
						$row_copy['updated'] = time();
					}
					else
					{
						$row_copy['created'] = time();
					}
				}
			}
			if (!empty($this->hasOne))
			{
				foreach ($this->hasOne as $one)
				{
					unset($row_copy[$one['mapping']]);
					unset($row_copy[$one['counter']]);
				}
			}
			//更新主表数据（除了mapping外的数据）
			if (!empty($row_copy))
			{				
				if ($edit) //edit
				{
					$primaryKeyValue = $row_copy[$this->primaryKey];
					unset($row_copy[$this->primaryKey]);
					$this->db->update($this->tableName, $row_copy, "$this->primaryKey='$primaryKeyValue'");
					$update_id = $primaryKeyValue;
				}
				else
				{
					$this->db->insert($this->tableName, $row_copy);
					$insert_id = $this->db->insert_id();
				}
			}
			//更新从表数据
			if (!empty($this->hasMany))
			{
				foreach ($this->hasMany as $one)
				{
					$this->_checkHas($one);
					if (isset($row[$one['mapping']]) && !empty($row[$one['mapping']]))
					{
						foreach ($row[$one['mapping']] as $key=>$line)
						{
							if ($one['centerTable'])
							{
								//自动设置从表的外键值
								if ($insert_id)
								{
									if ($row[$one['mapping']][$key][$one['foreignKey2']]==null)
									$row[$one['mapping']][$key][$one['foreignKey2']] = $insert_id;
								}
								else if ($update_id)
								{
									if ($row[$one['mapping']][$key][$one['foreignKey2']]==null)
									$row[$one['mapping']][$key][$one['foreignKey2']] = $update_id;
								}
								//判断从表的数据是否存在
								$edit = false;
								if ($one['primaryKey2'] && $row[$one['mapping']][$key][$one['primaryKey2']])
								{
									$num = $this->db->getone("select count(0) from #PRE#".$one['table2']." where ".$one['primaryKey2']."='".$row[$one['mapping']][$key][$one['primaryKey2']]."'");
									$edit = $num ? true : false;
								}
								//补充数据
								if ($edit)
								{
									$row[$one['mapping']][$key]['updated'] = time();
								}
								else
								{
									$row[$one['mapping']][$key]['created'] = time();
								}
								//更新从表数据
								if ($edit) //edit
								{
									$condition = $one['primaryKey2']."='".$row[$one['mapping']][$key][$one['primaryKey2']]."'";
									$this->db->update($one['table2'], $row[$one['mapping']][$key], $condition);
									$r_update_id = $row[$one['mapping']][$key][$one['primaryKey2']];
									unset($row[$one['mapping']][$key][$one['primaryKey2']]);
								}
								else
								{
									$this->db->insert($one['table2'], $row[$one['mapping']][$key]);
									$r_insert_id = $this->db->insert_id();
								}							
								//更新中间表
								/*$num = $this->db->getone("select count(0) from `#PRE#".$one['centerTable']."` where ".$one['foreignKey1']."='".$row[$this->primaryKey]."' and ".$one['foreignKey2']."='".$row[$one['mapping']][$key][$one['foreignKey2']]."' ");
								if (!$num)
								{
								}*/
								$foreignKeyValue = $r_insert_id ? $r_insert_id : $r_update_id;
								$this->db->query("replace into `#PRE#".$one['centerTable']."` set ".$one['foreignKey1']."='".$row[$this->primaryKey]."',".$one['foreignKey2']."='".$foreignKeyValue."' ");
								//从表的数据数量 更新到 主表
								if (isset($one['counter']) && $one['counter'])
								{
									$this->db->add_column($this->tableName, $one['counter']);
									$mappingCount = $this->db->getone("select count(0) from #PRE#".$one['centerTable']." where ".$one['foreignKey1']."='".$row[$this->primaryKey]."'");
									$this->db->update($this->tableName, array($one['counter']=>$mappingCount), $this->primaryKey."='".$row[$this->primaryKey]."'");
								}								
							}
							else
							{
								//自动设置从表的外键值
								if ($insert_id)
								{
									if ($row[$one['mapping']][$key][$one['foreignKey']]==null)
									$row[$one['mapping']][$key][$one['foreignKey']] = $insert_id;
								}
								else if ($update_id)
								{
									if ($row[$one['mapping']][$key][$one['foreignKey']]==null)
									$row[$one['mapping']][$key][$one['foreignKey']] = $update_id;
								}
								//判断从表的数据是否存在
								$edit = false;
								if ($one['primaryKey'] && $row[$one['mapping']][$key][$one['primaryKey']])
								{
									$num = $this->db->getone("select count(0) from #PRE#".$one['table']." where ".$one['primaryKey']."='".$row[$one['mapping']][$key][$one['primaryKey']]."'");
									$edit = $num ? true : false;
								}
								//补充数据
								if ($edit)
								{
									$row[$one['mapping']][$key]['updated'] = time();
								}
								else
								{
									$row[$one['mapping']][$key]['created'] = time();
								}
								//更新从表数据
								if ($edit) //edit
								{
									$condition = $one['primaryKey']."='".$row[$one['mapping']][$key][$one['primaryKey']]."'";
									unset($row[$one['mapping']][$key][$one['primaryKey']]);
									$this->db->update($one['table'], $row[$one['mapping']][$key], $condition);
								}
								else
								{
									$this->db->insert($one['table'], $row[$one['mapping']][$key]);
								}
								//从表的数据数量 更新到 主表
								if (isset($one['counter']) && $one['counter'])
								{
									$this->db->add_column($this->tableName, $one['counter']);
									$mappingCount = $this->db->getone("select count(0) from #PRE#".$one['table']." where ".$one['foreignKey']."='".$row[$one['mapping']][$key][$one['foreignKey']]."'");
									$this->db->update($this->tableName, array($one['counter']=>$mappingCount), "$this->primaryKey='".$row[$one['mapping']][$key][$one['foreignKey']]."'");
								}
							}
							
						}
						unset($row[$one['mapping']]);
					}
				}
			}
			if (!empty($this->hasOne))
			{
				foreach ($this->hasOne as $one)
				{	
					if (isset($row[$one['mapping']]) && !empty($row[$one['mapping']]))
					{		
						$edit = false;
						if ($one['primaryKey'] && $row[$one['mapping']][$one['primaryKey']])
						{
							$num = $this->db->getone("select count(0) from #PRE#".$one['table']." where ".$one['primaryKey']."='".$row[$one['mapping']][$one['primaryKey']]."'");
							$edit = $num ? true : false;
						}
						if ($edit) //edit
						{
							$condition = $one['primaryKey']."='".$row[$one['mapping']][$one['primaryKey']]."'";
							unset($row[$one['mapping']][$one['primaryKey']]);
							$this->db->update($one['table'], $row[$one['mapping']], $condition);
						}
						else
						{
							$this->db->insert($one['table'], $row[$one['mapping']]);
						}
						unset($row[$one['mapping']]);
					}
				}
			}
			//更新主表的上级表数量
			if (!empty($this->belongTo) && $this->belongTo['counter'])
			{
				$primaryTable = $this->belongTo['table'];
				$foreignKey = $this->belongTo['foreignKey'];
				$primaryKey = $this->belongTo['primaryKey'];
				
				$this->db->add_column('#PRE#'.$primaryTable, $this->belongTo['counter']);
				$this->db->query("update #PRE#".$primaryTable." A set ".$this->belongTo['counter']."=(select count(0) from ".$this->tableNameFull." where ".$foreignKey."=A.$primaryKey) ");
			}

		}
	}

	/**
	 * 删除数据，包括相关数据表(由$hasMany定义)
	 *
	 * @param unknown_type $condition
	 */
	function delete($condition)
	{
		if (!empty($this->hasMany))
		{
			$data = $this->db->select($this->tableName, "*", $condition);
			if ($data)
			{
				foreach ($data as $row)
				{
					foreach ($this->hasMany as $one)
					{
						$this->db->delete($one['table'], $one['foreignKey'] . " in(".$row[$this->primaryKey].")");
					}
				}
			}
		}
		$this->db->delete($this->tableName, $condition);
		//更新主表的上级表数量
		if (!empty($this->belongTo) && $this->belongTo['counter'])
		{
			$primaryTable = $this->belongTo['table'];
			$foreignKey = $this->belongTo['foreignKey'];
			$primaryKey = $this->belongTo['primaryKey'];
			
			$this->db->add_column('#PRE#'.$primaryTable, $this->belongTo['counter']);
			$this->db->query("update #PRE#".$primaryTable." A set ".$this->belongTo['counter']."=(select count(0) from ".$this->tableNameFull." where ".$foreignKey."=A.$primaryKey) ");
		}
	}

	/**
	 * 检测 hasMany、hasOne..格式是否正确
	 */
	function _checkHas($cf)
	{
		if ($cf['centerTable'])
		{
			if (!$cf['foreignKey1'])
			{
				throw new Exception("\$foreignKey1未设置");
			}
			else if (!$cf['table2'])
			{
				throw new Exception("\$table2未设置");
			}
			else if (!$cf['primaryKey2'])
			{
				throw new Exception("\$primaryKey2未设置");
			}
			else if (!$cf['foreignKey2'])
			{
				throw new Exception("\$foreignKey2未设置");
			}
			else if (!$cf['mapping'])
			{
				throw new Exception("\$mapping未设置");
			}
			
		}
		else
		{
			if (!$cf['table'])
			{
				throw new Exception("\$table未设置");
			}
			else if (!$cf['foreignKey'])
			{
				throw new Exception("\$foreignKey未设置");
			}
			else if (!$cf['mapping'])
			{
				throw new Exception("\$mapping未设置");
			}
		}
	}
}

?>