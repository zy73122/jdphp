<?php
/**
 * 文件上传
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

/**
 * 
 * 		使用示例：
 */

class upload
{
	public static $allow_ext;
	public static $allow_size = 512000; //字节  500K

	/**
	 * 上传
	 *
	 * @param FILE $files $_FILES["upfile"]
	 * @param string $new_name
	 */
	public static function start($files, $new_name='', $group='')
	{
		try
		{
			if (!$files['name'])
			throw new Exception("请选择要上传的文件。");
/*			
			if (is_array($files['name']))
			{
				$count = count($files['name']);
				for ($i=0; $i<$count; $i++)
				{
					$onefile['name'] = $files['name'][$i];
					$onefile['type'] = $files['type'][$i];
					$onefile['tmp_name'] = $files['tmp_name'][$i];
					$onefile['error'] = $files['error'][$i];
					$onefile['size'] = $files['size'][$i];
					self::upload($onefile);
				}
			}*/
			
			self::checkType($files, $group);
			self::checkSize($files);
			self::checkError($files);
			
			
			//
			if (($pos=strrpos($new_name, "/"))===false)
			$pos = strlen($new_name);
			
			$todir = substr($new_name, 0, $pos);
			if (!is_dir($todir))
			{
				//创建文件夹
				cfile::mkdir_recursive($todir, 0700);
			}
			
			//转码
			$new_name = iconv("utf-8", "GBK", $new_name);
			
			//
			if (!move_uploaded_file($files['tmp_name'], $new_name))
			throw new Exception("移动文件失败。");
			
		}
		catch (Exception $e)
		{
			exit ($e->getMessage());
		}
	}

	/**
	 * 检测文件类型
	 *
	 * @param string $group
	 */
	public static function checkType($files, $group='')
	{
		switch (strtoupper($group))
		{
			case "FILE":
				self::$allow_ext = 'rar|zip|doc|xls|chm|txt';
				break;
			case "MEDIA":
				self::$allow_ext = 'rm|mp3|wav|mid|midi|ra|avi|mpg|mpeg|asf|asx|wma|mov';
				break;
			case "FLASH":
				self::$allow_ext = 'swf|flv|fla';
				break;
			case "PIC":
				self::$allow_ext = 'gif|jpg|jpeg|bmp|png';
				break;
			default:
				self::$allow_ext = 'gif|jpg|jpeg|bmp|png|rar|zip|swf|wma|rm|mp3';
				break;
		}

		preg_match("/\.([a-zA-Z0-9]{2,4})$/",$files['name'], $ext);

		$arr_ext = explode("|", self::$allow_ext);
		if (!in_array($ext[1], $arr_ext))
		{
			throw new Exception("文件格式不被允许。");
		}
/*		后台设置的允许上传格式 暂时没用·
		if (!UPLOAD_SWITCH)
			throw new Exception("请在后台开启上传。");

		if (UPLOAD_ALLOW_TYPE)
		{
			$allow_types = explode(",", UPLOAD_ALLOW_TYPE);
			if (!in_array($ext[1], $allow_types))
				throw new Exception("文件格式不被允许。");
		}
		*/
	}

	/**
	 * 检测上传时出现的错误
	 *
	 * @param FILE $files $_FILES["upfile"]
	 * @param string $group
	 */
	public static function checkError($files)
	{
		switch ($files['error'])
		{
			case 0:
			case UPLOAD_ERR_OK:
				//throw new Exception("没有错误发生，文件上传成功。");
				break;
			case 1:
			case UPLOAD_ERR_INI_SIZE:
				throw new Exception("上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 ");
				break;
			case 2:
			case UPLOAD_ERR_FORM_SIZE:
				throw new Exception("上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ");
				break;
			case 3:
			case UPLOAD_ERR_PARTIAL:
				throw new Exception("文件只有部分被上传。");
				break;
			case 4:
			case UPLOAD_ERR_NO_FILE:
				throw new Exception("没有文件被上传。");
				break;
			case 6:
			case UPLOAD_ERR_NO_TMP_DIR:
				throw new Exception("找不到临时文件夹。PHP 4.3.10 和 PHP 5.0.3 引进。");
				break;
			case 7:
			case UPLOAD_ERR_CANT_WRITE:
				throw new Exception("文件写入失败。");
				break;
		}
	}
	
	public static function checkSize($files)
	{
		if ($files['size'] > self::$allow_size)
		throw new Exception("文件大小超过限制。");
	}
}
?>