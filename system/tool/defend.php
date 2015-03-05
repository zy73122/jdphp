<?php
/**
 * 安全防护
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class defend
{
	public static function start()
	{
		// 是否允许代理访问
		if ($GLOBALS['dbconfig']['cf_proxy'] == 0)
		{
			if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']) || !empty($_SERVER['HTTP_VIA']) ||
				   !empty($_SERVER['HTTP_PROXY_CONNECTION']) || !empty($_SERVER['HTTP_USER_AGENT_VIA']) ||
				   !empty($_SERVER['HTTP_CACHE_INFO']) )
			{
				exit('Proxy Connection Denied');
			}
		}

		//CC防护设置
		$cf_cc = $GLOBALS['dbconfig']['cf_cc'];
		if(substr(PHP_OS, 0, 3) != 'WIN')
		{
			if($fp = @fopen('/proc/loadavg', 'rb')) {
				list($loadavg) = explode(' ', fread($fp, 6));
				fclose($fp);
				$GLOBALS['dbconfig']['cf_loadavg'] && $loadavg > $GLOBALS['dbconfig']['cf_loadavg'] && $cf_cc = 2;
			}
		}
		if(!empty($cf_cc))
		{
			self::fence($cf_cc);
		}

		self::ip_verify();
	}


	public static function fence($cf_cc)
	{
		$c_agentip = 0;
		(!empty($_SERVER['HTTP_X_FORWARDED_FOR']) || !empty($_SERVER['HTTP_CLIENT_IP'])) && $c_agentip = 1;

		$timestamp = time();
		$onlineip = defend::get_ip();

		$c_banedip = cfile::read(PATH_DATA . 'logs/banip.txt');//被banip文件
		
		if ($c_ipoffset = strpos($c_banedip . "\n", "\t" . $onlineip . "\n"))
		{
			$c_ltt = (int)substr($c_banedip, $c_ipoffset - 10, 10);// 获取屏蔽的时间
			if($timestamp - $c_ltt < 20)
			{
				if($timestamp - $c_ltt > 5)
				{
					cfile::write(PATH_DATA . 'logs/banip.txt',
									str_replace($c_ltt . "\t" . $onlineip, $timestamp . "\t" . $onlineip, $c_banedip));
				}
				exit("Turn off CC, Please refresh after 20 secs");
			}
			else
			{
				cfile::write(PATH_DATA . 'logs/banip.txt', str_replace("\n" . $c_ltt . "\t" . $onlineip, '', $c_banedip));
			}
		}		

		$c_banip_a = explode("\n", $c_banedip);
		if($c_agentip == 1 || $cf_cc == 2)
		{
			$c_time = 0;
			if($c_fp = @fopen(PATH_DATA . 'logs/ccip.txt', 'rb'))
			{
				flock($c_fp, LOCK_SH);
				$c_size = 27 * 500;
				fseek($c_fp, -$c_size, SEEK_END);
				while (!feof($c_fp))
				{
					$c_value = explode("\t", fgets($c_fp, 29));
					if($timestamp - $c_value[0] < 10 && trim($c_value[1]) == $onlineip)
					{
						$c_time++;
						if($c_time > 15)
						{
							break;
						}
					}
				}
				fclose($c_fp);
			}
			if($c_time > 15)
			{
				array_push($c_banip_a, $timestamp . "\t" . $onlineip);
				$c_banip_a = array_slice($c_banip_a, -150);
				cfile::write(PATH_DATA . 'logs/banip.txt', implode("\n", $c_banip_a));
				exit('Turn off CC');
			}
			if(@filesize(PATH_DATA . 'logs/ccip.txt') > 27 * 1000)
			{
				cfile::rm(PATH_DATA . 'logs/ccip.txt');
			}
			cfile::write(PATH_DATA . 'logs/ccip.txt', $timestamp . "\t" . $onlineip . "\n", 'ab');
		}

		if (false == self::post_verify())
		{
			exit('undefined_action');
		}
	}


	/**
	 * 获取 IP
	 *
	 * @return string
	 */
	public static function get_ip()
	{
		// 访问者ip
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$onlineip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$c_agentip = 1;
		}
		elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$onlineip = $_SERVER['HTTP_CLIENT_IP'];
			$c_agentip=1;
		}
		else
		{
			$onlineip = $_SERVER['REMOTE_ADDR'];
			$c_agentip=0;
		}

		$onlineip = str_replace(' ', '', $onlineip);
		if ($er = strpos($onlineip, ','))
		{
			$onlineip = substr($onlineip, 0, $er);
		}
		return preg_match("/^[\d]([\d\.]){5,13}[\d]$/", $onlineip) ? $onlineip : 'unknown';
	}


	/**
	 * POST 来源验证
	 *
	 * @return boolean
	 */
	public static function post_verify()
	{
		// 数据安全验证
		if (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$referer_a = parse_url($_SERVER['HTTP_REFERER']);
			$s_host = $_SERVER['HTTP_HOST'];
			strpos($s_host,':') && $s_host = substr($s_host,0,strpos($s_host,':'));

			if(!empty($referer_a['host']) && $referer_a['host'] != $s_host)
			{
				return false;
			}
		}
		return true;
	}


	/**
	 * IP 验证
	 */
	public static function ip_verify()
	{
		$ipban = $GLOBALS['dbconfig']['cf_ipban'];
		if (empty($ipban))
		{
			return true;
		}

		$ip = explode(',', $ipban);
		if (empty($ip))
		{
			return true;
		}

		$current_ip = self::get_ip();
		foreach ($ip as $row)
		{
			$row = trim($row);
			if (count(explode('.', $row)) == 3 && $current_ip == $row)
			{
				exit('<h1>Forbidden</h1>');
			}
			elseif (implode('.', array_slice(explode('.', $current_ip), 0, 3)) == implode('.', array_slice(explode('.', $row), 0, 3)))
			{
				exit('<h1>Forbidden</h1>');
			}
		}

		return true;
	}

}
?>