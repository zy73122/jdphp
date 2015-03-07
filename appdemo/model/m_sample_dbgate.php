<?php
/**
 * 模型测试
 *
 * 这里您也可以不从db_gate派生这个模型，而使用db::instance()->query等方法来操作数据库的数据
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class m_sample_dbgate extends db_gate 
{
	//指定数据表名
	public $tableName = "testdbgate_product"; 
	
	//指定主键名，默认值为'id'
	public $primaryKey = 'id';  

	//关联表信息
	public $hasMany = array(
		array(
		'primaryKey' 		=> 'id', //关联表的主键
		'table'		 		=> 'testdbgate_product_img', // 关联到哪一个表		
		'foreignKey' 		=> 'product_id', // 关联表中与主表主键对应的字段
		'mapping' 			=> 'hasImages', //返回结果的数组中，用这个名字来保存关联表数据
		'counter' 			=> 'count_img', //从表的数据行数
		),
		array(
		'centerTable'		=> 'testdbgate_product_to_tag',
		'foreignKey1' 		=> 'product_id',
		'table2'		 	=> 'testdbgate_tag',
		'primaryKey2' 		=> 'id',
		'foreignKey2' 		=> 'tag_id',
		'mapping' 			=> 'hasTags',
		'counter' 			=> 'count_tag',
		),
	);
	public $hasOne = array(
		'primaryKey' 		=> 'id',
		'table'		 		=> 'testdbgate_category',
		'foreignKey' 		=> 'category_id',
		'mapping' 			=> 'hasCategory',
	);
	public $belongTo = array(
		'primaryKey' 		=> 'id',
		'table'		 		=> 'testdbgate_category',
		'foreignKey' 		=> 'category_id',
		'counter' 			=> 'count_product',	
	);
	
	public function __construct()
	{
		parent::__construct();
		//{#dbconn}
	}
	
	function echoMax()
	{
		echo "最大主键值为：<br>". $this->get_max_id() . "</br>";
	}
	
	function echoData()
	{
		//读取所有数据为
		$data1 = $this->get_all();
		
		//读取一条数据为
		$data2 = $this->get_row("*", "id='2'");
		
		//读取单元格数据为
		$data3 = $this->get_one("id", "id='2'");
		
		d($data1) ;
		
		//$this->delete("id='2'");
		//echo "测试删除";
	}
	
	
	function testSave()
	{
		$data[] = array(
		'id'			=> '2',		//主键。值为null时添加，否则为编辑
		'product_name'	=> '产品aa',
		'product_price'	=> '99.8',
		'category_id'	=> '100',
		//'created'		=> time(),	//这里不需要设置该项，会自动完
		//'updated'		=> time(),	//这里不需要设置该项，会自动完
		'hasImages'		=> array(
				array(		
				'id'				=> null,			//主键。值为null时添加，否则为编辑
				//'product_id'		=> '2',				//这里不需要设置该项，会自动完成
				'img_title'			=> 'aaa2',
				'img_src'			=> '图片描述a',
				),
				array(		
				'id'				=> null,
				'img_title'			=> 'bbb2',
				'img_src'			=> '图片描述b',
				),
			),
		'hasTags'		=> array(
				array(		
				'id'				=> '1',
				'tag_title'			=> '标签a',
				),
				array(		
				'id'				=> null,
				'tag_title'			=> '标签ab',
				),
			),
		'hasCategory'		=> array(
				'id'				=> 100,
				'category_title'	=> '分类aab',
			),
		);		
		$this->save($data);
	}
}

?>