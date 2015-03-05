<?php

/*
//使用示例：
define('JDPHP_MAKER', 1);
$encode_type = 'rsa'; //easy,varable,aes,aesecb,rsa
$encrypt = new encrypt($encode_type);

//测试加密/解密
$data = 'easyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasyeasy222';
$data = $encrypt->encode($data);
var_dump($data);
$data = $encrypt->decode($data);
var_dump($data);
exit;


//数组加密/解密
$data = array(
	'name' => '捷克',
	'price' => 12.2
);
$data = serialize($data);
$data = $encrypt->encode($data);
$data = $encrypt->decode($data);
var_dump($data);

*/

/**
 * 加密解密 
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
//defined('JDPHP_MAKER') || exit('Forbidden');
class encrypt
{
	public static $encode_type;
	public $en_aesecb;
	public function __construct($encode_type = 'easy')
	{
		if (is_null($encode_type)) $encode_type = 'easy';
		self::$encode_type = $encode_type;
		require("encrypt/en_".$encode_type.".php");
	}
	
	public function encode($data)
	{
		if (self::$encode_type == 'easy') 
		{
			$data = en_easy::encode($data);
		}
		else if (self::$encode_type == 'varable') 
		{
			$data = en_varable::encode($data);
		}
		else if (self::$encode_type == 'aes') 
		{
			$data = en_aes::encode($data);
		}
		else if (self::$encode_type == 'aesecb') 
		{
			if (!$this->en_aesecb) 
			{
				require_once('encrypt/en_aesecb.php');
				$this->en_aesecb = new en_aesecb();
			}
			$data = $this->en_aesecb->encrypt($data);
		}
		else if (self::$encode_type == 'rsa') 
		{
			$data = en_rsa::encode($data);
		}
		return $data;
	}
	
	public function decode($data)
	{
		if (self::$encode_type == 'easy') 
		{
			$data = en_easy::decode($data);
		}
		else if (self::$encode_type == 'varable') 
		{
			$data = en_varable::decode($data);
		}
		else if (self::$encode_type == 'aes') 
		{
			$data = en_aes::decode($data);
		}
		else if (self::$encode_type == 'aesecb') 
		{
			if (!$this->en_aesecb) 
			{
				require_once('encrypt/en_aesecb.php');
				$this->en_aesecb = new en_aesecb();
			}
			$data = $this->en_aesecb->decrypt($data);
		}
		else if (self::$encode_type == 'rsa') 
		{
			$data = en_rsa::decode($data);
		}
		return $data;
	}

}
?>