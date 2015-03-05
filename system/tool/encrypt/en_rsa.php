<?php
/**
 * 加密解密 可逆 
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class en_rsa
{
	public static $private_key = "-----BEGIN RSA PRIVATE KEY-----
MIIBOQIBAAJBAOy8ZE9ZgxjkLKftkkl7+4AZ1MFmtipg0Og+czIfxs6FlkIfmBVF
yvk+6CMcpNVEvr8Kauo/kwWm7WdclqTKh6kCAwEAAQJAHNjwGEM+GGBlmKj4dH/p
K7j6Ff8gH5XgnwxNGUSKA0xD+kajduzv0sHzJJNT9zTkHxCeOZF/N9AxdDYw+M7J
oQIhAPuAo1O5QIhSksa/XesJlIraUOKBWu8Y5mFdwzPx7nQVAiEA8PgnQzgrQUAZ
oyLIxib0428eiEaJtDs+jQzhWHkJxkUCIFT6ojUn4yYswGtnPdSs6AQCwFHIY3Fm
eHFtvQdQN8IBAiBd3byloaav10FlW/JrxdcVFT8GhLu1enKGTWMmrJeTJQIgROEF
1ZDElSY0CL4MNtYyO29DOwJiblLILlKARcjHvDY=
-----END RSA PRIVATE KEY-----";

	public static $public_key = "-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAOy8ZE9ZgxjkLKftkkl7+4AZ1MFmtipg
0Og+czIfxs6FlkIfmBVFyvk+6CMcpNVEvr8Kauo/kwWm7WdclqTKh6kCAwEAAQ==
-----END PUBLIC KEY-----";

	public static function encode($txt)
	{
		$txt = openssl_public_encrypt($txt, $encodetxt, self::$public_key);
		$encodetxt = base64_encode($encodetxt);
		return $encodetxt;
	}

	public static function decode($txt)
	{
		$crypttext = base64_decode($txt);
		openssl_private_decrypt($crypttext, $detxt, self::$private_key);
		echo $detxt;
		return $detxt;
	}
}

?>