<?php
/**
 * ORM基类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class db_gate2
{
	public $tablename;
	public function __construct()
	{
		//$this->db = s('dbmysqli', glb::$config['database']['default']);
		$this->db = dbmysqli::instance();
	}
	
	public function get_list($condition = '', $start = 0, $pos = 20, & $total = 0)
	{
		$data = $this->db->select($this->tablename, 'SQL_CALC_FOUND_ROWS *', "$condition LIMIT $start,$pos");
		$totald = $this->db->query('SELECT FOUND_ROWS()', 'SELECT');
		$total = $totald[0]['FOUND_ROWS()'];
		return $data;
	}
	
	public function get_one($condition = '')
	{
		$data = $this->db->select($this->tablename, '*', "$condition");
		return ($data) ? $data[0] : array();
	}
	
	public function set($id, $data)
	{
		$data['updated'] = time();
		return $this->db->update($this->tablename, $data, "id=$id");
	}
	
	public function add($data)
	{
		$data['created'] = time();
		return $this->db->insert($this->tablename, $data);
	}
	
	public function del($id)
	{
		return $this->db->delete($this->tablename, "id=$id");
	}
	
}

?>