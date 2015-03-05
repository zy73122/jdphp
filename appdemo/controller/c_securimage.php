<?php
/**
 * 调用缩略图
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class c_securimage
{
	public function index()
	{
		$this->show();
	}
	public function show()
	{
		$img = new securimage();
		$img->image_width = $_GET['width'] ? (int)$_GET['width'] : "80"; //80x26
		$img->image_height = $_GET['height'] ? (int)$_GET['height'] : "26";
		$img->text_x_start = $_GET['x_start'] ? (int)$_GET['x_start'] : 0;
		$img->text_minimum_distance = $_GET['min'] ? (int)$_GET['min'] : 1;
		$img->text_maximum_distance = $_GET['max'] ? (int)$_GET['max'] : 1;
		$img->perturbation = 0.0; #扰动
		$img->font_size = $_GET['size'] ? (int)$_GET['size'] : 17;
		$img->line_distance = 4;
		$img->arc_linethrough = false;
		$img->draw_lines = false;
		$img->code_length = 4;
		//$img->wordlist_file = PATH_ROOT . 'static/authcode/words/words.txt';
		//$img->audio_path = PATH_ROOT . 'static/authcode/audio/';
		//$img->use_multi_text = true;
		$img->use_transparent_text = true;
		$img->text_transparency_percentage = 30; // 100 = completely transparent
		$img->num_lines = 2; #干扰线
		$img->text_color	   = new Securimage_Color("#004542");
		$img->multi_text_color = array(new Securimage_Color("#004542"),
									   new Securimage_Color("#211B9F"),
									   new Securimage_Color("#C91A11"),
									   new Securimage_Color("#509F1B"),
									   new Securimage_Color("#202200")
									   );
		$img->line_color = new Securimage_Color("#eaeaea");
		$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));		
		$img->iscale = 1;
		$img->show(PATH_TOOL . 'securimage/backgrounds/bg3.jpg'); 
	}
	
	public function show2()
	{
		$img = s('securimage');
		
		//Change some settings
		$img->image_width = 250;
		$img->image_height = 80;
		$img->perturbation = 0.3;
		$img->image_bg_color = new Securimage_Color("#f6f6f6");
		$img->multi_text_color = array(new Securimage_Color("#356596"),
		new Securimage_Color("#58AE01"),
		new Securimage_Color("#AE1501"),
		new Securimage_Color("#AE6B01"),
		new Securimage_Color("#9CAE01")
		);
		$img->use_multi_text = true;
		$img->text_angle_minimum = 1;
		$img->text_angle_maximum = 1;
		$img->use_transparent_text = true;
		$img->text_transparency_percentage = 0; // 100 = completely transparent
		$img->num_lines = 0;
		$img->line_distance = 1;
		$img->line_color = new Securimage_Color("#eaeaea");
		$img->signature_color = new Securimage_Color(rand(0, 64), rand(0, 64),rand(0, 64));
		//$img->use_wordlist = true;
		$img->code_length = 4;
		$img->iscale = 1;

		$img->show(PATH_TOOL . 'securimage/backgrounds/bg3.jpg'); 

	}
	
}
?>