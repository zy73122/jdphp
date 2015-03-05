<?php
/**
 * 下载类
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class downloader
{
	private static $timeout = 3;

	/**
	 * 远程获取文件内容
	 */
	public static function get_data( $url = '' )
	{
		if( empty( $url ) )
		{
			return false;
		}

		$data = '';
		//for( $i = 0; $i < 5 && empty( $data ); $i++)
		{
			if( function_exists( 'curl_init' ) )
			{
				if( !isset($ch) )
				{
					$ch = curl_init ();
					curl_setopt ( $ch, CURLOPT_URL, $url );
					curl_setopt ( $ch, CURLOPT_TIMEOUT, self::$timeout );
					curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0' );
				}
				$data = curl_exec ( $ch );
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				if($http_code != '200')
				{
					return false;
				}
			}
			elseif( function_exists( 'fsockopen' ) )
			{
				$data = self::get_contents_by_socket( $url );
			}
			elseif( function_exists( 'file_get_contents' ) )
			{
				if( !get_cfg_var('allow_url_fopen') )
				{
					return false;
				}
				$context = stream_context_create(array(
					'http' => array(
					  'timeout' => self::$timeout,
					),
				)); 
				$data = @file_get_contents($url, false, $context );
			}
			else
			{
				return false; 
			}
		}

		if( ! $data )
		{
			return false;
		}
		else
		{
			return $data;
		}
	}

	/**
	 * 远程获取文件内容 通过Socket方式
	 */
	public static function get_contents_by_socket( $url )
	{
		$params = parse_url( $url );
		$host = $params['host'];
		$path = $params['path'];
		$query = $params['query'];
		$fp = @fsockopen($host, 80, $errno, $errstr, self::$timeout);
		if (!$fp) 
		{
			return false;
		}
		else 
		{

			$result = '';
			$out = "GET /" . $path . '?' . $query . " HTTP/1.0\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n\r\n";
			@fwrite($fp, $out);
			$http_200 = preg_match('/HTTP.*200/', @fgets($fp, 1024));
			if (!$http_200) 
			{
				return false;
			}
			while (!@feof($fp)) 
			{
				if ($get_info) 
				{
					$result .= @fread($fp, 1024);
				} 
				else 
				{
					if (@fgets($fp, 1024) == "\r\n") 
					{
						$get_info = true;
					}
				}

			}
			@fclose($fp);
			return $result;
		}
	}
}
?>
