module.info.php�ļ�˵����

<?php 
return array (
  'id' => 'samplemodule',		//ģ����
  'name' => language::get('samplemodule_name', PATH_MODULE . 'samplemodule/language/'),
  'desc' => language::get('samplemodule_desc'),
  'version' => '1.0',
  'author' => 'yy',
  'website' => 'http://locahlhost',
  'menu' => 				//��̨�˵�
  array (
    0 => 
    array (
      'text' => '�˵�һ',
      'url' => '?m=samplemodule&a=index',
    ),
    1 => 
    array (
      'text' => '�˵���',
      'url' => '?m=samplemodule&a=index',
	  'target' => '_blank',
    ),
  ),
  'install' => 'on',			//�Ƿ��Ѱ�װ������ֵ��on,off
);
?>
