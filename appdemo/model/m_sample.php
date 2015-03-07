<?php
/**
 * 示例模型
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class m_sample extends base_model
{
	public function __construct()
	{
		parent::__construct();
		//{#dbconn}
		$this->table_name = 'sample';
		$this->table_prid = 'primary_id';
	}

}
?>