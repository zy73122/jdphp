<?php
/**
 * http请求
 *
 */
class req 
{
		
	/**
	 * post
	 */
	public static function fspost($url, $postdata='', $timeout = 3, $block = TRUE, $limit = 0, & $errmsg='') 
	{
		//$postdata = http_build_query( $postdata);
		$contlen = strlen($postdata);
	
		$url = parse_url($url);
		$querystring = !empty($url['query']) ? $url['query'] : '';
		$path = empty($url['path']) ? '/' : $url['path'];
		$path .= empty($querystring) ? '' : '?' . $querystring;
	
		if (!$fp = @fsockopen($url['host'], empty($url['port']) ? 80 : $url['port'], $errno , $errstr))
		{
			$errmsg = "errno:{$errno} errstr:{$errstr}<br />\n";
			return false;
		}	
		
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
			
		$hd = '';
		$return = '';
		$params = "POST ". $path ." HTTP/1.1\r\n";
		$params .= "Host: ".$url['host']."\r\n";
		$params .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$params .= "Content-Length: ". $contlen . "\r\n";
		$params .= "Connection: Close\r\n\r\n";
		$params .= $postdata;
	
		fwrite($fp, $params);
		$status = stream_get_meta_data($fp);
		if ($status['timed_out']) {
			$errmsg = "Connection timed out!<br />\n";
		}
		while (!feof($fp)) {
			if(($header = fgets($fp)) && ($header == "\r\n" || $header == "\n")) {
				break;
			}
			$hd .= $header;
		}
		while (!feof($fp))
		{
			$return .= fgets($fp, 128);
		}
		fclose($fp);
		
		preg_match('|HTTP/1\.1\s+(\d+)|', $hd, $m);
		$code = $m[1];
		
		return array('code'=>$code, 'data'=>$return); //'header'=>$hd, 
	}
	
	public static function fsget($url, $timeout = 3, $block = TRUE, $limit = 0, & $errmsg='') 
	{
		$contlen = 0;
	
		$url = parse_url($url);
		$querystring = $url['query'];
		$path = empty($url['path']) ? '/' : $url['path'];
		$path .= empty($querystring) ? '' : '?' . $querystring;
	
		if (!$fp = fsockopen($url['host'], empty($url['port']) ? 80 : $url['port'], $error))
		{
			$errmsg = "$errstr ($errno)<br />\n";
			return false;
		}
		
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
			
		$hd = '';
		$return = '';
		$params = "POST ". $path ." HTTP/1.1\r\n";
		$params .= "Host: ".$url['host']."\r\n";
		$params .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$params .= "Content-Length: ". $contlen . "\r\n";
		$params .= "Connection: Close\r\n\r\n";
	
		fwrite($fp, $params);
		$status = stream_get_meta_data($fp);
		if ($status['timed_out']) {
			$errmsg = "Connection timed out!<br />\n";
		}
		while (!feof($fp)) {
			if(($header = fgets($fp)) && ($header == "\r\n" || $header == "\n")) {
				break;
			}
			$hd .= $header;
		}
		while (!feof($fp))
		{
			$return .= fgets($fp, 128);
		}
		fclose($fp);
		
		preg_match('|HTTP/1\.1\s+(\d+)|', $hd, $m);
		$code = $m[1];
		
		return array('code'=>$code, 'data'=>$return); //'header'=>$hd, 
	}
}