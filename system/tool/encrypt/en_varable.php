<?php
/**
 * 加密解密 可逆 加密后的串可变
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class en_varable
{
	public static $key2 = 'ss3o2a'; //算法2key
	/**
	 * Passport 加密函数
	 *
	 * @param string 等待加密的原字串
	 * @param string 私有密匙(用于解密和加密)
	 *
	 * @return string 原字串经过私有密匙加密后的结果
	 */
	public static function encode($txt)
	{
		$key = self::$key2;
		//R 使用随机数加密,密钥放在字符前面
		// 使用随机数发生器产生 0~32000 的值并 MD5()
		srand((double)microtime() * 1000000);
		$encrypt_key = md5(rand(0, 32000));
	
		// 变量初始化
		$ctr = 0;
		$tmp = '';
	
		// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
		for($i = 0; $i < strlen($txt); $i++) {
			// 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			// $tmp 字串在末尾增加两位，其第一位内容为 $encrypt_key 的第 $ctr 位，
			// 第二位内容为 $txt 的第 $i 位与 $encrypt_key 的 $ctr 位取异或。然后 $ctr = $ctr + 1
			$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
		}
	
		// 返回结果，结果为 passport_key() 函数返回值的 base65 编码结果
		return base64_encode(self::passport_key($tmp, $key)); //R 真正使用密码加密
	}
	
	/**
	 * Passport 解密函数
	 *
	 * @param string 加密后的字串
	 * @param string 私有密匙(用于解密和加密)
	 *
	 * @return string 字串经过私有密匙解密后的结果
	 */
	public static function decode($txt)
	{
		$key = self::$key2;
		// $txt 的结果为加密后的字串经过 base64 解码，然后与私有密匙一起，
		// 经过 passport_key() 函数处理后的返回值
		$txt = self::passport_key(base64_decode($txt), $key); //R 二次加密就是解密
	
		// 变量初始化
		$tmp = '';
	
		// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
		for ($i = 0; $i < strlen($txt); $i++) {
			// $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
			// 与 $txt 的第 $i + 1 位取异或。然后 $i = $i + 1
			$tmp .= $txt[$i] ^ $txt[++$i]; //R 解密随机加密;
		}
	
		// 返回 $tmp 的值作为结果
		return $tmp;
	}
	
	/**
	 * Passport 密匙处理函数
	 *
	 * @param string 待加密或待解密的字串
	 * @param string 私有密匙(用于解密和加密)
	 *
	 * @return string 处理后的密匙
	 */
	public static function passport_key($txt, $encrypt_key)
	{
		// 将 $encrypt_key 赋为 $encrypt_key 经 md5() 后的值
		$encrypt_key = md5($encrypt_key);
	
		// 变量初始化
		$ctr = 0;
		$tmp = '';
	
		// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
		for($i = 0; $i < strlen($txt); $i++) {
			// 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr; //R   轮
			// $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
			// 与 $encrypt_key 的第 $ctr + 1 位取异或。然后 $ctr = $ctr + 1
			$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];   //R 轮翻异或加密;
		}
	
		// 返回 $tmp 的值作为结果
		return $tmp;
	}	
}
?>