<?php
/**
 * 测试页首页
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
		
class c_test_xml
{

	function index()
	{
		//参考：http://php.net/manual/en/book.simplexml.php
		$xmlfile = PATH_DATA_CORE . 'rss/test_rss.xml';
		
		//simplexml_load_file：读取一个xml文档作为操作对象，可以读取本地或者远程xml文档；simplexml_load_string：读取一个xml字符串作为操作的对象
		$info = simplexml_load_file($xmlfile);
		
		//如果不清楚如何获取某个节点的信息，可用print_r函数打印输出查看具体的结构，simplexml解析返回的对象具有数组结构。
		print_r($info);
		   
		//以对象方式读取某个XML文档节点信息，读取方式：句柄->节点元素名->子节点，如果相同的节点元素有多个，则以数组（array）方式读取
		//注：由于simplexml解析返回的信息是UTF8格式的，如果网站使用的是GBK的，则需要转码，你可以使用iconv函数或者其他的utf8与gbk转换函数进行操作，如：$name = iconv('utf-8′,'gbk',$name);
		$name = $info->LeapsoulInfo[0]->name;		   
		echo $name;
		
		//以遍历的形式，读取所有元素下的子节点信息
		foreach ($info->LeapsoulInfo as $LeapsoulInfo)
		{
			echo $LeapsoulInfo->name."<br />";
			echo $LeapsoulInfo->website."<br />";
			echo $LeapsoulInfo->description."<br />";
			echo $LeapsoulInfo->bloger."<br />";
			echo $LeapsoulInfo->date."<br />";
			echo $LeapsoulInfo->qq."<br />";
		}
		
		//simplexml的xpath函数是用来查询XML数据的，比如这里查询的是所有name节点的值
		foreach($info->xpath('//name') as $value) {  
			echo $value.'<br />';
		}
		
		//children函数是用来找寻某个特定节点下所有子节点的值。getName函数用来获得每个子节点的元素名称
		foreach($info->LeapsoulInfo[0]->children() as $value) {  
			echo $value->getName();
			echo $value.'<br />';  
		}
		
		//addChild函数用来在某个特定节点下增加一个子节点;asXML函数对已做过改动的XML文档进行保存
		$info->LeapsoulInfo[0]->addChild('msn', 'MSN:davidfaithman@hotmail.com');
		$info->asXML($xmlfile);
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
	}


}
?>