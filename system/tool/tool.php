<?php
/**
 * 常用函数库
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class tool
{

	/**
	 * url重写
	 * 例子：tool::url("index.php?c=index&a=cate&cid=11");
	 * 例子：tool::url("?c=index&a=cate&cid=11");
	 * 例子：tool::url(array('c'=>'index','a'=>'cate','cid'=>'11'));
	 */
	public static function url($avg)
	{
		//$url = "index.php?";
		if (is_array($avg))
		{
			foreach($avg as $k=>$v)
			{
				$url .= "&" . $k . "=" . $v;
			}
		}
		else
		{
			$url = $avg;
		}
		$url = str_replace("&&", "&", $url);
		$url = str_replace("?&", "?", $url);

		if (ENABLE_REWRITE || ENABLE_HTML)
		{
			//$url = "index.php?c=index&a=acc&action=edit";
			if(strpos($url , ".php") === false)
			{
				$url = "index.php" . $url;
			}
			$pos = strpos($url , ".php");
			//$newurl = substr($url, 0, $pos);
			$newurl = '';
			$lf = substr($url, $pos+4);
			$lf = str_replace("?", "&", $lf);
			if(strpos($lf , "&") !== false)
			{
				$avgs = split("\&", $lf);
				foreach ($avgs as $avg)
				{
					if($avg)
					{
						$av = split("=", $avg);
						if($av)
						{
							$newurl .= "-".	$av[0] . "_" . $av[1];
						}
					}
				}
			}
			//$newurl .= ".html";
			$newurl = substr($newurl, 1);
			//echo $newurl;
			$url = $newurl;
		}

		//tool::var_dump($url);
		return $url;
	}	
	
	/**
	 * 批量生产图片
	 * 需要手工清除data/tmp下面的缩略图片
	 */	
	public static function createWatermaskBatch()
	{
		set_time_limit(3600);
		require_once(PATH_TOOL . 'image.php');
		$recreate_watermask = 1; //是否重新生成水印
		
		$imgdir = "../data/upload/images/";
		$dirs = cfile::ls($imgdir, 'dir');
			
		//获取友情链接、导航图片
		$friendlinks = m_ex_friendlink::get_friendlink_list();
		foreach($friendlinks['data'] as $one)
		{
			$friendlink_imgs[] = "../".$one['img_url'];
		}
		$cycleimage = m_ex_cycleimage::getcycleimageList();
		foreach($cycleimage['data'] as $one)
		{
			$cycleimage_imgs[] = "../".$one['img_url'];
		}
		
		echo "正在生成图片水印...<br>";
		ob_flush();flush();sleep(0.2); 
		if ($dirs)
		{
			foreach ($dirs as $onedir)
			{
				$files = cfile::ls($imgdir.$onedir, 'file');
				echo $onedir."<br>";
				ob_flush();flush();sleep(0.2); 
				if ($files)
				{
					foreach ($files as $onefile)
					{
						$imgurl = $imgdir.$onedir."/".$onefile;
						$imgurl_bak = $imgurl . ".bak";
						
						//跳过友情链接图片、导航图片
						if (in_array($imgurl, $friendlink_imgs) || in_array($imgurl, $cycleimage_imgs))
						{
//							if (file_exists($imgurl_bak))
//							{
//								//unlink($imgurl);
//								copy($imgurl_bak, $imgurl);
//							}
							continue;
						}
						//continue;
						
						//跳过备份图片
						if (substr($onefile, -4, 4)==".bak")
						continue;
						
						//重新生成水印。
						if ($recreate_watermask)
						{
							if (file_exists($imgurl_bak))
							{
								//unlink($imgurl);
								copy($imgurl_bak, $imgurl);
							}
							else
							{
								//备份图片
								copy($imgurl, $imgurl_bak);
							}
						}
						else
						{
							//如果备份文件存在，就是已经添加过水印的了，不需要再添加
							if (file_exists($imgurl_bak))
							continue;
							
							//备份图片
							copy($imgurl, $imgurl_bak);
						}
						
						//创建水印
						$image = new image();
						//$image->current_filename = $imgurl; //thumb_name
						
						$watermark_url = '../static/images/watermark.png'; //水印文件位置
						$watermark_place = WATERMARK_POS; //水印位置1,2,3,4,5; 3显示在中间
						$imgurl = $image->add_watermark($imgurl, '', $watermark_url, $watermark_place);
						//if ($imgurl === false)
						//exit("创建水印失败");
					}
				}
				
			}
		}
		
		//fckeditor部分
		$imgdir = "data/upload/fckeditor/";
		$files = cfile::ls($imgdir, 'file');
		if ($files)
		{
			echo "fckeditor<br>";
			ob_flush();flush();sleep(0.2); 
			foreach ($files as $onefile)
			{
				if (substr($onefile, -4, 4)=='.jpg' || substr($onefile, -4, 4)=='.gif' || substr($onefile, -4, 4)=='.png')
				{
					$imgurl = $imgdir.$onefile;
					$imgurl_bak = $imgurl . ".bak";
				
					//跳过备份图片
					if (substr($onefile, -4, 4)==".bak")
					continue;
					
					//重新生成水印。
					if ($recreate_watermask)
					{
						if (file_exists($imgurl_bak))
						{
							unlink($imgurl);
							copy($imgurl_bak, $imgurl);
						}
						else
						{
							//备份图片
							copy($imgurl, $imgurl_bak);
						}
					}
					else
					{
						//如果备份文件存在，就是已经添加过水印的了，不需要再添加
						if (file_exists($imgurl_bak))
						continue;
						
						//备份图片
						copy($imgurl, $imgurl_bak);
					}
					
					
					//创建水印
					$image = new image();
					//$image->current_filename = $imgurl; //thumb_name
					
					$watermark_url = 'static/images/watermark.png'; //水印文件位置
					$watermark_place = WATERMARK_POS; //水印位置1,2,3,4,5; 3显示在中间
					$imgurl = $image->add_watermark($imgurl, '', $watermark_url, $watermark_place);
					//if ($imgurl === false)
					//exit("创建水印失败");
				}
			}
		}
		
		//d($files);
		echo "生成完毕！";
	}
	
	/**
	 * 处理上传文件 多文件上传
	 * 
	 * @return string  imgageUrl
	 */	
	public static function doUploadFileObj($postfile, $is_add_watermark=false)
	{
		require_once(PATH_TOOL . 'image.php');
		$is_create_thumb = false; //是否生成缩略图
		$thumb_width = '100'; //缩略图宽度
		$thumb_height= '100'; //缩略图高度
		$is_add_watermark = $is_add_watermark && WATERMARK_SWITCH; //是否添加水印
		$watermark_url = PATH_ROOT.'static/images/watermark.png'; //水印文件位置
		$watermark_place = WATERMARK_POS; //水印位置1,2,3,4,5; 3显示在中间

		if (!empty($postfile['name']))
		{
				$count = count($postfile['name']);
				for ($i=0; $i<$count; $i++)
				{
					if ($postfile['name'][$i])
					{
						$imgarr[$i]['name'] = $postfile['name'][$i];
						$imgarr[$i]['type'] = $postfile['type'][$i];
						$imgarr[$i]['tmp_name'] = $postfile['tmp_name'][$i];
						$imgarr[$i]['error'] = $postfile['error'][$i];
						$imgarr[$i]['size'] = $postfile['size'][$i];
					}
				}
				$k = 0;
				if(!empty($imgarr))
				{
					$info  = "";
					foreach ($imgarr as $oneimg)
					{
						//后台设置的允许上传格式·
						if (!UPLOAD_SWITCH)
							throw new Exception("请在后台开启上传。");
				
						if (UPLOAD_ALLOW_TYPE)
						{
							preg_match("/\.([a-zA-Z0-9]{2,4})$/", $oneimg['name'], $ext);
							$allow_types = explode(",", UPLOAD_ALLOW_TYPE);
							if (!in_array($ext[1], $allow_types))
								throw new Exception("文件格式不被允许。");
								//continue;
						}
						
						/* 上传图片 */
						$old_name = $oneimg['name'];
						// 实例化对象
						$image = new image();
						// 设置图像上传目录
						$image->images_dir = 'data/upload/images';
						// 设置缩略图目录
						$image->thumb_dir = 'data/upload/thumb';

						// 开始上传
						//$upload_img = $image->upload_image($oneimg, 'dirname', $old_name);
						$upload_img = $image->upload_image($oneimg);
						// 上传失败的话
						if ($upload_img == false)
						{
							throw new Exception($image->error_msg());
						}
						$info .= "上传成功. 图像名：$upload_img <br>";

						/* 生成缩略图 */
						// 如果设置缩略图大小不为0，生成缩略图
						if ($is_create_thumb)
						{
							// 开始生成缩略图
							$img_thumb = $image->make_thumb(PATH_ROOT . $upload_img, $thumb_width, $thumb_height);
							if ($img_thumb === false)
							{
								throw new Exception($image->error_msg());
							}
							$info .= "生成缩略图. 图像名：$img_thumb <br>";
						}

						// 添加水印
						if ($is_add_watermark)
						{
							//备份图片
							copy(PATH_ROOT . $upload_img, PATH_ROOT . $upload_img . ".bak");
							
							$imgurl = $image->add_watermark(PATH_ROOT . $upload_img, '', $watermark_url, $watermark_place);
							if ($imgurl === false)
							{
								throw new Exception($image->error_msg());
							}
							$info .= "添加水印. 图像名：$imgurl <br>";
							$upload_img = $imgurl;							
						}

						tpl::assign('sysinfo', $info);

						$arr[$k]['img_url'] = $upload_img;
						$arr[$k++]['img_thumb'] = $img_thumb;
					}
				}

		}
		return $arr;
	}
			
	/**
	 * 解压缩一个文件到一个文件夹下
	 *
	 * @param string $todir	 目标释放目录
	 * @param string $tmp_name  临时文件名
	 * @param string $new_name  目标文件名
	 * @return string  有三种情况 1 表示成功 0 表示失败 -1 表示此文件不是zip文件
	 * @example  unzip('abc/','abc.zip','abc.zip'); 
	 * 			 使用完毕要使用 clearstatcache(); 来清空cache
	 * 			 使用之前请先使用 set_time_limit(0); 来延长超时时间
	 */
	public static function unzip($todir,$tmp_name,$new_name)
	{
		//global $z,$have_zip_file;
		$z = new zip;
		$upfile = array("tmp_name"=>$tmp_name,"name"=>$new_name);
		if(is_file($upfile["tmp_name"])){
			if(preg_match('/\.zip$/i',$upfile[name])){
				$result=$z->Extract($upfile[tmp_name],$todir);
				if($result==-1){
					return 0;
				}
				return 1;
			}else{
				return -1;
			}
			if(realpath($upfile[name])!=realpath($upfile[tmp_name])){
				@unlink($upfile[name]);
				rename($upfile[tmp_name],$upfile[name]);
			}
		}
		else
		{
			echo '<script language="javascript">alert("文件不存在!");history.back(1);</script>';
		}
	}
			
	/**
	 * 获取当前页面地址
	 */
	public static function getCurrentUrl()
	{
		if (defined('IN_BACKGROUND'))
		{
			$rooturl = URL_ADMIN;
		}
		else
		{
			$rooturl = URL;
		}
		//过滤掉get变量里的page变量
		foreach ($_GET as $k=>$one)
		{
			if ($k!='page')
			$querystr .= "&$k=$one";
		}
		if (ENABLE_HTML)
		{
			$querystr = $querystr ? $rooturl.'html/'.'index.php?'.$querystr : URL.'html/';
		}
		else
		{
			$querystr = $querystr ? $rooturl.'index.php?'.$querystr : URL;
		}
		return $querystr;
	}			
			
	/**
	 * 计算页面的php解析时间 - 记录开始时间
	 * 
	 * 示例：
		 tool::evaltime_start();
		 echo "<br>该模块解析时间：" . tool::evaltime_end().'ms';
	 */
	public static function evaltime_start()
	{
		$_SESSION['time_start'] = tool::microtime_float();
	}	
	/**
	 * 计算页面的php解析时间 ms
	 */
	public static function evaltime_end()
	{
		$_SESSION['time_end'] = tool::microtime_float();
		$timediff = number_format(($_SESSION['time_end'] - $_SESSION['time_start']) * 1000, 2, '.', '') ;
		self::evaltime_start();
		//unset($_SESSION['time_end']);
		return $timediff;
	}	
	
	/**
	 * 获取系统时间-微秒
	 *
	 * @return float  
	 */
	public static function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
	/**
	 * 获取系统时间-微秒 
	 *
	 * @return string  
	 */
	public static function microtime_string()
	{
		list($usec, $sec) = explode(" ", microtime());
		return (self::get_date($sec, "Y-m-d H:i:s") . " " . round($usec * 1000) . "ms");
	}

	/**
	 * 获取当前页面地址
	 *
	 * @return string  
	 */
	public static function current_url()
	{
		if ($_SERVER["SERVER_PORT"]=='80')
		return 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		else
		return 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}

	/**
	 * 生成静态页面
	 *
	 * @param string $url  类似："?c=index"
	 * @param bool $overwrite 是否覆盖已经生成的页面
	 * @return string  
	 */
	public static function create_html($url, $overwrite=false)
	{
		if (!$url)
		{
			$msg = '参数$url不能为空';
		}
		else if (!ENABLE_HTML)
		{
			$msg = '你还未设置config来启用静态页面';
		}
		else
		{
			$htmlfile = 'html/' . tool::url($url);
			$contents = file_get_contents(URL.$url);
			if (strlen($contents)==0 || preg_match('/(模块|控制器|挂件).*不存在/isU', $contents)>0)
			{
				$msg = "生成失败 " . $htmlfile;
			}
			else
			{
				if ($overwrite || !file_exists(PATH_ROOT.$htmlfile))
				{
					cfile::write(PATH_ROOT . $htmlfile, $contents, 'wb');
					$msg = "生成成功 $htmlfile <a href='".URL."$htmlfile' target='_blank'>查看</a><br>";
				}
				else
				{
					$msg = "已经存在 $htmlfile <a href='".URL."$htmlfile' target='_blank'>查看</a><br>";
				}
			}
		}
		return $msg;
	}

	/**
	 * 生成缩略图
	 *
	 * @param string $imgurl
	 * @param string $thumb_width
	 * @param string or null $thumb_height
	 */
	public static function create_thumb($imgurl, $thumb_name, $thumb_width, $thumb_height)
	{
		if (file_exists($imgurl))
		{
			require_once(PATH_TOOL . 'image.php');
			$image = new image();
			$image->current_filename = $thumb_name;
			$img_thumb = $image->make_thumb( $imgurl, $thumb_width, $thumb_height, PATH_ROOT.'data/tmp/');
			if ($img_thumb === false)
			{
				throw new Exception($image->error_msg());
			}
		}
		return $img_thumb ? $img_thumb : null;
	}

	public static function print_r($content)
	{
		echo "<pre>";
		print_r($content);
		echo "</pre>";
	}

	public static function var_dump($content)
	{
		@header("Content-Type:text/html;charset=".CHARSET);
		echo "<pre>";
		var_dump($content);
		echo "</pre>";
		exit;
	}

	/**
	 * GZIP压缩输出
	 * $content 就是要压缩的页面内容，或者说饼干原料
	 */
	public static function ob_gzip($content)
	{
		if(!headers_sent() && // 如果页面头部信息还没有输出
		extension_loaded("zlib") && // 而且zlib扩展已经加载到PHP中
		strstr($_SERVER["HTTP_ACCEPT_ENCODING"],"gzip")) //而且浏览器说它可以接受GZIP的页面
		{
			$content = gzencode($content/*." \n//该页已压缩"*/,9); //为准备压缩的内容贴上"//此页已压缩"的注释标签，然后用zlib提供的gzencode()函数执行级别为9的压缩，这个参数值范围是0-9，0表示无压缩，9表示最大压缩，当然压缩程度越高越费CPU。

			//然后用header()函数给浏览器发送一些头部信息，告诉浏览器这个页面已经用GZIP压缩过了！
			header("Content-Encoding: gzip");
			header("Vary: Accept-Encoding");
			header("Content-Length: ".strlen($content));
			header('Content-Type:text/html;charset='.CHARSET);

		}
		return $content; //返回压缩的内容，或者说把压缩好的饼干送回工作台。
	}

	/**
	 * 页面跳转
	 * @param string $message
	 * @param string Or array $url
	 * @param int $timeout	 默认:2秒跳转
	 * @param int $stop_loop   1:停止跳走,   默认0:自动跳转
	 */
	public static function message($message, $urlData = null, $timeout = 2, $stop_loop=0)
	{
		$prefer = $_SERVER['HTTP_REFERER'];
		if ($timeout === 0)
		{
			header("Location:".tool::url($urlData?$urlData:$prefer));
			exit;
		}
		if (($pos = strpos($prefer, "?")) !== false)
		{
			$url_default = substr($prefer, $pos);
		}
		else
		{
			$url_default = $prefer;
		}

		if (is_array($urlData))
		{
			$urls = $urlData;
			$url_default = $urlData[0]['url'];
		}
		else
		{
			if ($urlData)
			{
				$urls[] = array(
				'txt' => $urlData,
				'url' => $urlData,
				);
				$url_default = $urlData;
			}
			else
			{
				$url_default = $_SERVER['HTTP_REFERER'];

			}
		}

		tpl::assign('url_page', $url_default); //默认装向页面
		tpl::assign('urlData', $urls);
		tpl::assign('stop_loop', $stop_loop);
		tpl::assign('message', $message);
		tpl::assign('timeout', $timeout);
		//tpl::display(PATH_ROOT . ADMIN . '/template/default/message.tpl');
		tpl::display( 'message.tpl');
		exit();
	}


	/**
	 * 数组转换为文本形式
	 *
	 * @param array $data
	 * @return unknown
	 */
	public static function arrayToFile($data)
	{
		if (is_array($data))
		{
			if (!empty($data))
			{
				$tmp = "<?php

return array(
";		
				foreach ($data as $k=>$v)
				{
					$tmp .= "	'$k' => '$v',
";
				}
				$tmp .= "
);

?>";				
			}
		}
		return $tmp;
	}

	/**
	 * 文件下载方式输出内容
	 *
	 * @param string $filename 不含后缀名
	 * @param long string $dump_buffer 
	 * @param string $type 包含：sql,xls
	 * @param string $compression 包含：zip,gzip...
	 */
	public static function download($filename, $dump_buffer, $type='sql', $compression=null)
	{
		if ($type == 'csv') {
			$filename  .= '.csv';
			$mime_type = 'text/comma-separated-values';
		} elseif ($type == 'htmlexcel') {
			$filename  .= '.xls';
			$mime_type = 'application/vnd.ms-excel';
		} elseif ($type == 'htmlword') {
			$filename  .= '.doc';
			$mime_type = 'application/vnd.ms-word';
		} elseif ($type == 'xls') {
			$filename  .= '.xls';
			$mime_type = 'application/vnd.ms-excel';
		} elseif ($type == 'xml') {
			$filename  .= '.xml';
			$mime_type = 'text/xml';
		} elseif ($type == 'latex') {
			$filename  .= '.tex';
			$mime_type = 'application/x-tex';
		} elseif ($type == 'pdf') {
			$filename  .= '.pdf';
			$mime_type = 'application/pdf';
		} elseif ($type == 'sql') {
			$filename  .= '.sql';
			// text/x-sql is correct MIME type, however safari ignores further
			// Content-Disposition header, so we must force it to download it this
			// way...
			$mime_type = PMA_USR_BROWSER_AGENT == 'SAFARI'
			? 'application/octet-stream'
			: 'text/x-sql';
		}
		else if ($type == 'jpg') {
			$filename  .= '.jpg';
			$mime_type = 'image/jpeg';
		}
		else if ($type == 'gif') {
			$filename  .= '.gif';
			$mime_type = 'image/gif';
		}
		else if ($type == 'png') {
			$filename  .= '.png';
			$mime_type = 'image/png';
		}


		// If dump is going to be compressed, set correct encoding or mime_type and add
		// compression to extension
		$content_encoding = '';
		if (isset($compression) && $compression == 'bzip') {
			$filename  .= '.bz2';
			// browsers don't like this:
			//$content_encoding = 'x-bzip2';
			$mime_type = 'application/x-bzip2';
		} elseif (isset($compression) && $compression == 'gzip') {
			$filename  .= '.gz';
			// Needed to avoid recompression by server modules like mod_gzip.
			// It seems necessary to check about zlib.output_compression
			// to avoid compressing twice
			if (!@ini_get('zlib.output_compression')) {
				//$content_encoding = 'x-gzip'; //bug ?火狐下导致压缩包错误 /byy
				$content_encoding = 'gzip';
				$mime_type = 'application/x-gzip';
			}
		} elseif (isset($compression) && $compression == 'zip') {
			$filename  .= '.zip';
			$mime_type = 'application/zip';
		}

		if (!empty($content_encoding)) {
			header('Content-Encoding: ' . $content_encoding);
		}
		header('Content-Type: ' . $mime_type);
		header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		if (PMA_USR_BROWSER_AGENT == 'IE') {
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
		} else {
			header('Pragma: no-cache');
		}

		// Do the compression
		// 1. as a gzipped file
		if (isset($compression) && $compression == 'zip') {
			if (@function_exists('gzcompress')) {
				$zipfile = new zipfile();
				$zipfile -> addFile($dump_buffer, substr($filename, 0, -4));
				$dump_buffer = $zipfile -> file();
			}
		}
		// 2. as a bzipped file
		elseif (isset($compression) && $compression == 'bzip') {
			if (@function_exists('bzcompress')) {
				$dump_buffer = bzcompress($dump_buffer);
				if ($dump_buffer === -8) {
					//.. ???
				}
			}
		}
		// 3. as a gzipped file
		elseif (isset($compression) && $compression == 'gzip') {
			if (@function_exists('gzencode')) {
				// without the optional parameter level because it bug
				$dump_buffer = gzencode($dump_buffer);
			}
		}

		echo $dump_buffer;
		exit;
	}


	/******************************************************************
	* PHP截取UTF-8字符串，解决半字符问题。
	* 英文、数字（半角）为1字节（8位），中文（全角）为3字节
	* @param $str 源字符串
	* @param $len 左边的子串的长度
	* @param $append 长度超过$len时，是否显示...
	* @return 取出的字符串, 当$len小于等于0时, 会返回整个字符串
	*/
	/*例子一：
	$str = utf_substr('你好',4);
	echo $str;*/
	public static function utf_substr($str,$len,$append=true)
	{
		for($i=0;$i<=$len;$i++)
		{
			$temp_str=substr($str,0,1);
			if(ord($temp_str) > 127)
			{
				$new_str[]=substr($str,0,3);
				$str=substr($str,3);
			}
			else
			{
				$new_str[]=substr($str,0,1);
				$str=substr($str,1);
			}
			if ($temp_str && $i == $len)
			{
				$new_str[]='...';
			}
		}
		return join($new_str);
	}

	public static function js_alert($msg)
	{
		echo "<script>alert('$msg');</script>";
	}
	public static function js_alert_back($msg)
	{
		echo "<script>alert('$msg');history.go(-1);</script>";
	}
	public static function js_alert_go($msg, $url)
	{
		echo "<script>alert('$msg');self.location.href='$url';</script>";
	}


	/**
	 * 显示浮动层
	 */
	public static function showFloatwDiv($img_name)
	{
		return "
<script type='text/javascript' >
function showPositionPreview()
{
	if(document.getElementById('positionPreview').style.display == 'none')
		document.getElementById('positionPreview').style.display='block';
	else
		document.getElementById('positionPreview').style.display='none';	
}
</script>
<div id='Layer505' style='right:100px;top:45px;z-index:49;no-repeat;position:absolute;cursor:move;width:200px;height:200px;text-align:left;padding:10px; background:#FFFFFF'>
	<p class='Detail' style='width:100%; text-align:center; margin-top:-20px'><img src='$img_name' /></p>
</div>";
	}

	/**
	 * 对用户传入的变量进行转义操作。
	 */
	public static function chkRequestAndPost()
	{
		if (!empty($_GET))
		{
			$_GET  = self::addslashes_deep($_GET);
		}
		if (!empty($_POST))
		{
			$_POST = self::addslashes_deep($_POST);
		}
		$_COOKIE   = self::addslashes_deep($_COOKIE);
		$_REQUEST  = self::addslashes_deep($_REQUEST);
	}

	public static function addslashes_deep($value)
	{
		if (empty($value))
		{
			return $value;
		}
		else
		{
			if(is_array($value))
			{
				return array_map(array(__CLASS__, 'addslashes_deep'), $value);
			}
			else
			{
				if (!get_magic_quotes_gpc())
				$value_tmp = addslashes($value);
				else
				$value_tmp = $value;
				return self::clrvar($value_tmp);
			}
		}
	}

	/**
	 * 过滤字符串
	 */
	public static function clrvar($str)
	{
		$strstr = trim($str);
		$strstr = preg_replace('/(insert.*into)|(select.*from)|(update.*set)/isU', '', $strstr);
		//$strstr = str_replace('insert ','',$strstr);
		//$strstr = str_replace('update ','',$strstr);
		//$strstr = str_replace('select ','',$strstr);
		return $strstr;
	}
	
	/**
	 * 由于该框架默认情况下POST、GET数据会进行addslashes处理，该函数用在某些不要addslashes的情况。
	 */
	public static function unaddslashes($value)
	{
		if (empty($value))
		{
			return $value;
		}
		else
		{
			return stripslashes($value);
		}
	}
	public static function unaddslashes_deep($value)
	{
		if (empty($value))
		{
			return $value;
		}
		else
		{
			if(is_array($value))
			{
				return array_map(array(__CLASS__, 'unaddslashes_deep'), $value);
			}
			else
			{
				return stripslashes($value);
			}
		}
	}

	/**
	 * 路径是否存在
	 */
	public static function path_exists($path)
	{
		$pathinfo = pathinfo ( $path . '/tmp.txt' );
		if (!empty($pathinfo ['dirname']))
		{
			if (file_exists( $pathinfo['dirname']) === false)
			{
				if (mkdir($pathinfo['dirname'], 0777, true) === false)
				{
					return false;
				}
			}
		}
		return $path;
	}

	public static function F_L_count($filename,$offset)
	{
		$count_F = '';
		$onlineip = self::get_client_ip();
		$count = 0;
		if ($fp = @fopen($filename, "rb")) {
			flock($fp, LOCK_SH);
			fseek($fp, - $offset, SEEK_END);
			$readb = fread($fp, $offset);
			fclose($fp);
			$readb = trim($readb);
			$readb = explode("\n", $readb);
			$count = count($readb);
			$count_F = 0;
			for ($i = $count - 1; $i > 0; $i --) {
				if (strpos($readb[$i], "|Logging Failed|$onlineip|") === false) {
					break;
				}
				$count_F ++;
			}
		}
		return $count_F;
	}

	/**
	 * 获得用户的真实 IP 地址 
	 */
	public static function get_client_ip ()
	{
		static $realip = NULL;
		if ($realip !== NULL)
		{
			return $realip;
		}
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				/* 取X-Forwarded-For中第?个非unknown的有效IP字符? */
				foreach ($arr as $ip)
				{
					$ip = trim($ip);
					if ($ip != 'unknown')
					{
						$realip = $ip;
						break;
					}
				}
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			}
			else
			{
				if (isset($_SERVER['REMOTE_ADDR']))
				{
					$realip = $_SERVER['REMOTE_ADDR'];
				}
				else
				{
					$realip = '0.0.0.0';
				}
			}
		}
		else
		{
			if (getenv('HTTP_X_FORWARDED_FOR'))
			{
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_CLIENT_IP'))
			{
				$realip = getenv('HTTP_CLIENT_IP');
			}
			else
			{
				$realip = getenv('REMOTE_ADDR');
			}
		}
		preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
		$realip = ! empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
		return $realip;
	}


	/* 转义 */
	public static function auto_addslashes(&$array)
	{
		if ($array)
		{
			foreach ($array as $key => $value)
			{
				if (! is_array ( $value ))
				{
					$array [$key] = addslashes($value);
				}
				else
				{
					auto_addslashes($array [$key]);
				}
			}
		}
	}

	/* 反转义 */
	public static function auto_stripslashes(&$array)
	{
		if ($array)
		{
			foreach ($array as $key => $value)
			{
				if (!is_array($value))
				{
					$array[$key] = stripslashes($value);
				}
				else
				{
					auto_stripslashes($array[$key]);
				}
			}
		}
	}

	/**
	 * 过滤字符串
	 * 当 $editor 为 true 时，则不会转换 '<' 和 '>'
	 *
	 * @param $data data
	 * @param $editor 是否使用了编辑器
	 *
	 */
	public static function strip($data, $editor = false)
	{
		$data = strtr($data, '`', '');

		if ($editor == true)
		{
			// 过滤 JavaScript
			$search = array ('#<script[^>]*?>.*?[</script>]*#si', '#<iframe[^>]*?>.*?[</iframe>]*#si', '#<input[^>]*?>#si', '#<button[^>]*?>.*?</button>#si', '#<form[^>]*?>#si', '#</form>#si',
			'#(<[\/\!]*?)?(\ class\=[\'|"].*?[\'|"])|(\ id\=[\'|"].*?[\'|"])([^<>]*?>)?#si');
			$replace = array('', '', '', '', '', '');
			$data = preg_replace($search, $replace, $data);
			if (get_magic_quotes_gpc())
			{
				$data = trim($data);
			}
			else
			{
				$data = addslashes(trim($data));
			}

		}
		else
		{
			if (get_magic_quotes_gpc())
			{
				$data = htmlspecialchars(trim(stripslashes($data)), ENT_QUOTES);
			}
			else
			{
				$data = htmlspecialchars(trim($data), ENT_QUOTES);
			}
		}
		return $data;
	}


	/**
	 * linux 系统信息
	 * @return <type>
	 */
	public static function sys_linux()
	{
		// CPU
		if (false === ($str = @file("/proc/cpuinfo"))) return false;
		$str = implode("", $str);
		@preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(.@\.]+)[\r\n]+/", $str, $model);
		//@preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
		@preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
		if (false !== is_array($model[1]))
		{
			$res['cpu']['num'] = sizeof($model[1]);
			for($i = 0; $i < $res['cpu']['num']; $i++)
			{
				$res['cpu']['detail'][] = "类型：".$model[1][$i]." 缓存：".$cache[1][$i];
			}
			if (false !== is_array($res['cpu']['detail'])) $res['cpu']['detail'] = implode("<br />", $res['cpu']['detail']);
		}
		
		// UPTIME
		if (false === ($str = @file("/proc/uptime"))) return false;
		$str = explode(" ", implode("", $str));
		$str = trim($str[0]);
		$min = $str / 60;
		$hours = $min / 60;
		$days = floor($hours / 24);
		$hours = floor($hours - ($days * 24));
		$min = floor($min - ($days * 60 * 24) - ($hours * 60));
		if ($days !== 0) $res['uptime'] = $days."天";
		if ($hours !== 0) $res['uptime'] .= $hours."小时";
		$res['uptime'] .= $min."分钟";

		// MEMORY
		if (false === ($str = @file("/proc/meminfo"))) return false;
		$str = implode("", $str);
		preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);

		$res['memTotal'] = round($buf[1][0]/1024, 2);
		$res['memFree'] = round($buf[2][0]/1024, 2);
		$res['memUsed'] = ($res['memTotal']-$res['memFree']);
		$res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;

		$res['swapTotal'] = round($buf[3][0]/1024, 2);
		$res['swapFree'] = round($buf[4][0]/1024, 2);
		$res['swapUsed'] = ($res['swapTotal']-$res['swapFree']);
		$res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round($res['swapUsed']/$res['swapTotal']*100,2):0;

		// LOAD AVG
		if (false === ($str = @file("/proc/loadavg"))) return false;
		$str = explode(" ", implode("", $str));
		$str = array_chunk($str, 3);
		$res['loadAvg'] = implode(" ", $str[0]);

		return $res;
	}
	
	// freebsd 系统信息
	public static function sys_freebsd()
	{
		//CPU
		if (false === ($res['cpu']['num'] = tool::get_key("hw.ncpu"))) return false;
		$res['cpu']['detail'] = tool::get_key("hw.model");

		//LOAD AVG
		if (false === ($res['loadAvg'] = tool::get_key("vm.loadavg"))) return false;
		$res['loadAvg'] = str_replace("{", "", $res['loadAvg']);
		$res['loadAvg'] = str_replace("}", "", $res['loadAvg']);

		//UPTIME
		if (false === ($buf = tool::get_key("kern.boottime"))) return false;
		$buf = explode(' ', $buf);
		$sys_ticks = time() - intval($buf[3]);
		$min = $sys_ticks / 60;
		$hours = $min / 60;
		$days = floor($hours / 24);
		$hours = floor($hours - ($days * 24));
		$min = floor($min - ($days * 60 * 24) - ($hours * 60));
		if ($days !== 0) $res['uptime'] = $days."天";
		if ($hours !== 0) $res['uptime'] .= $hours."小时";
		$res['uptime'] .= $min."分钟";

		//MEMORY
		if (false === ($buf = tool::get_key("hw.physmem"))) return false;
		$res['memTotal'] = round($buf/1024/1024, 2);
		$buf = explode("\n", do_command("vmstat", ""));
		$buf = explode(" ", trim($buf[2]));

		$res['memFree'] = round($buf[5]/1024, 2);
		$res['memUsed'] = ($res['memTotal']-$res['memFree']);
		$res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;

		$buf = explode("\n", do_command("swapinfo", "-k"));
		$buf = $buf[1];
		preg_match_all("/([0-9]+)\s+([0-9]+)\s+([0-9]+)/", $buf, $bufArr);
		$res['swapTotal'] = round($bufArr[1][0]/1024, 2);
		$res['swapUsed'] = round($bufArr[2][0]/1024, 2);
		$res['swapFree'] = round($bufArr[3][0]/1024, 2);
		$res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round($res['swapUsed']/$res['swapTotal']*100,2):0;
		return $res;
	}

	public static function get_date($timestamp=0,$timeformat='')
	{
		$dbconfig = $GLOBALS['dbconfig'];
		$cf_timedf = $dbconfig['cf_timedf'];
		$cf_datefm = $dbconfig['cf_datefm'];
		$date_show = $timeformat ? $timeformat : $cf_datefm;
		$offset = $cf_timedf ? $cf_timedf : 0;
		$timestamp = $timestamp ? $timestamp : time();
		return gmdate($date_show, $timestamp+$offset*3600);
	}


	//===================================
	//待议函数
	public static function PostLog($log)
	{
		$data='';
		foreach($log as $key=>$val)
		{
			if(is_array($val))
			{
				$data .= "$key=array(".tool::PostLog($val).")";
			}
			else
			{
				$val = str_replace(array("\n","\r","|"),array('','','&#124;'),$val);
				if($key=='password' || $key=='check_pwd'){
					$data .= "$key=***, ";
				}else{
					$data .= "$key=$val, ";
				}
			}
		}
		return $data;
	}
	
	//随机数组
	public static function randomArr($arrInput, $num)
	{
		shuffle($arrInput);
		return array_slice($arrInput, 0, $num);
	}
	
	//随机变量
	public static function randstr($lenth)
	{
		mt_srand((double)microtime() * 1000000);
		$randval = '';
		for($i = 0; $i < $lenth; $i++)
		{
			$randval .= mt_rand(0, 9);
		}
		$randval = substr(md5($randval), mt_rand(0, 32 - $lenth), $lenth);
		return $randval;
	}
	
	// 计算文件大小
	public static function bytes_to_string($bytes)
	{
		if (!preg_match("/^[0-9]+$/", $bytes)) return 0;
		$sizes = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
		$extension = $sizes[0];
		for( $i = 1; ( ( $i < count( $sizes ) ) && ( $bytes >= 1024 ) ); $i++ )
		{
			$bytes /= 1024;
			$extension = $sizes[$i];
		}

		return round( $bytes, 2 ) . ' ' . $extension;
	}

	/**
	 * 取得参数值
	 * @param string $keyName 参数名
	 * @return bool
	 */
	public static function get_key($keyName)
	{
		return do_command('sysctl', "-n $keyName");
	}

	/**
	 * 查找执行文件位置
	 * @param string $commandName 命令名
	 * @return bool
	 */
	public static function find_command($commandName)
	{
		$path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
		foreach($path as $p)
		{
			if (@is_executable("$p/$commandName")) return "$p/$commandName";
		}
		return false;
	}

	/*
	* 执行系统命令
	* @param string $commandName 命令名
	* @param string $args 参数
	* @return bool
	*/
	public static function do_command($commandName, $args)
	{
		$buffer = "";
		if (false === ($command = find_command($commandName))) return false;
		if ($fp = @popen("$command $args", 'r'))
		{
			while (!@feof($fp))
			{
				$buffer .= @fgets($fp, 4096);
			}
			return trim($buffer);
		}
		return false;
	}
}
?>