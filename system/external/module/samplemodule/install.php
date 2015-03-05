<?php
/**
 * 这里可以放一些安装模块时需要执行的代码，比如新建表，新建目录、文件之类的
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
	
$sql = "show tables like '#PRE#samplemodule' ";
db::instance()->query($sql);
$num = db::instance()->num_rows();
if (!$num)
{
	db::instance()->query("CREATE TABLE `#PRE#samplemodule` (
		  `spec_id` int(10) unsigned NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL,
		  `description` varchar(255) NOT NULL,
		  `category` varchar(255) NOT NULL,
		  `starttime` int(10) NOT NULL,
		  `endtime` int(10) NOT NULL,
		  `sgrades` varchar(255) NOT NULL,
		  `posters` text NOT NULL,
		  PRIMARY KEY  (`spec_id`)
		) ENGINE=MyISAM");
}
	
cfile::write(PATH_APP . 'data/arrayfile/samplemodule.arrayfile.php', '<?php return array();?>', 'wb')
?>