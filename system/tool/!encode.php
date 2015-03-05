<?php
/**
 * Cookie加密解密
 * 支持到二维数组
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

/**
 *
 * 		使用示例：
	
	$key = "aa";
	$txt = "abcd1234";
	$encode = passport_encrypt($txt, $key);
	echo passport_decrypt($encode, $key);
 */

?>