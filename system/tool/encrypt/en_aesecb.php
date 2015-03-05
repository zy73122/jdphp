<?php  
/*
$aes = new en_aesecb("123asd456sdf123asd456sdf123asd45");  
$enc = $aes->encrypt("hello");  
echo $enc."<br>";  
echo $aes->decrypt("+R8QhuZpY+ruXIsUGpum2g==");  
*/
class en_aesecb  
{  
	private $td;//加密模块  
	private $key;//密钥  
	private $blocksize;  
	  
	public function __construct($base64key = 'a2f3b1e3a5d094aa3de8f02c3df6a01b')  
	{
		//密钥  
		$this->key = base64_decode($base64key);  
		  
		//打开模块  
		$this->td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', "ecb", '');  
		  
		$this->blocksize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'ecb');  
		  
		$this->iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->td), MCRYPT_RAND);  
	}  
	  
	public function __destruct()  
	{  
		mcrypt_module_close($this->td);  
	}  
	  
	/** 
	 * 将明文加密为密文base64编码字符串 
	 * @param   plainSrc		 明文 
	 * @return  密文base64编码 
	 */  
	public function encrypt($plainSrc)  
	{  
		$td = $this->td;  
		//初始化加密  
		mcrypt_generic_init($td, $this->key, $this->iv);  
		//加密  
		$encrypted = mcrypt_generic($td,$this->PaddingPKCS7($plainSrc));  
		//终止加密，主要是一些内存清理  
		mcrypt_generic_deinit($td);  
		//返回  
		return base64_encode($encrypted);  
		  
	}  
	  
	/** 
	 * 将base64编码字符串（密文）解密成 明文 
	 * @param   base64Src  密文base64编码字符串 
	 * @return  明文 
	 */  
	public function decrypt($base64Src)  
	{  
		$src = base64_decode($base64Src);  
		  
		$td = $this->td;  
		//初始化解密  
		mcrypt_generic_init($td, $this->key, $this->iv);  
		//解密  
		$decrypted = mdecrypt_generic($td,$src);  
		//终止解密，主要是一些内存清理  
		mcrypt_generic_deinit($td);  
		//返回  
		return $this->UnPaddingPKCS7($decrypted);  
	}  
	  
	//填充  
	private function PaddingPKCS7($data)  
	{  
		$block_size =  $this->blocksize;  
		$padding_char = $block_size - (strlen($data) % $block_size);  
		$data .= str_repeat(chr($padding_char), $padding_char);  
		return $data;  
	}  
  
	private function UnPaddingPKCS7($text)  
	{  
		$pad = ord($text{strlen($text) - 1});  
		if ($pad > strlen($text)) {  
			return false;  
		}  
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {  
			return false;  
		}  
		return substr($text, 0, - 1 * $pad);  
	}  
}  

?>