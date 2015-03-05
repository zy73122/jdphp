<?php
/**
 * 这里可以放一些卸载模块时需要执行的代码，比如卸载表，删除目录、文件之类的
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */


/* 删除表 */
db::instance()->query("drop table if exists `#PRE#samplemodule` ");

/* 删除文件 */
if (file_exists(ROOT_PATH . '/data/test.arrayfile.php'))
{
	@unlink(ROOT_PATH . '/data/test.arrayfile.php');
}
	
?>