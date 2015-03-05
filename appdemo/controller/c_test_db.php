<?php
/**
 * 测试数据库读取
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class c_test_db
{
	
	function index()
	{
		echo "数据库读取测试<br>";
		
		//method1
		$data = db::instance()->getall(" select * from #PRE#config where id>640 ");
		print_r(db::instance()->get_sql());
		if (!empty($data))
		{
			tpl::assign('data', $data);
		}
		
		//db::instance()->query(" update #PRE#config set id=1 where 0=1 ");

		/*		
		//method2
		$data = db::instance()->select("config", "cf_name,cf_value", "1 limit 0,50");
		print_r(db::instance()->get_sql());
		if (!empty($data))
		{
			//print_r($data);
			tpl::assign('data', $data);
		}*/
		
		/*
		//method3
		db::instance()->query("select cf_name,cf_value from #PRE#config limit 0,50");
		print_r(db::instance()->get_sql());
		$rs = db::instance()->fetch_all();
		if (!empty($rs))
		{
			foreach($rs as $row)
			{
				echo $row['cf_name'] . ":" . $row['cf_value']. "<br>";
			}
		}
		
		db::instance()->query("select cf_name,cf_value from #PRE#config where cf_value='asdaaxxsd' ");
		$r = db::instance()->fetch_all();
		if (!$r) {			
			echo '找不到该值';
		}
		*/

	}

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
		try
		{
			tpl::display(substr(__CLASS__, 2).'.tpl'); 
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}
}
?>