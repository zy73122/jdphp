<?php
/**
 * 图像操作测试
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
require_once(PATH_TOOL . 'image.php');
class c_test_image
{
	function index()
	{	
		
		$is_create_thumb = true; //是否生成缩略图
		$thumb_width = '100'; //缩略图宽度
		$thumb_height= '80'; //缩略图高度
		$is_add_watermark = true; //是否添加水印
		$watermark_url = 'static/images/watermark.png'; //水印文件位置


		if (!empty($_FILES['upimage']['name']))
		{
			try
			{
				$postfile = $_FILES['upimage'];
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
						/* 上传图片 */
						$old_name = $oneimg['name'][$i];
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
							$img_thumb = $image->make_thumb(PATH_ROOT.$upload_img, $thumb_width, $thumb_height);
							if ($img_thumb === false)
							{
								throw new Exception($image->error_msg());
							}
							$info .= "生成缩略图. 图像名：$img_thumb <br>";
						}
	
						// 添加水印
						if ($is_add_watermark)
						{
							$imgurl = $image->add_watermark(PATH_ROOT.$upload_img, '', $watermark_url, 3);
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
			catch (Exception $e)
			{
				tpl::assign('error', $e->getMessage());
			}

		}
		return empty($arr) ? array() : $arr;
	}

	/**
	 * pre钩子方法
	 */
	public function pre()
	{
	}

	/**
	 * post钩子方法
	 */
	public function post()
	{
		try
		{
			tpl::display(substr(__CLASS__, 2).'.tpl');
		}
		catch( Exception $e )
		{
			tpl::assign('error', $e->getMessage());
		}
	}


}
?>