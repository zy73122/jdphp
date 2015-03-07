# jdphp��� v1.0.9 core

## ��� 
����MVC�ܹ���������ںˣ�������ģ�黯�Ĺ������������Ŀ������򵥡���

## ���ٰ�װ  
* ������Ŀ�ļ�������web��������Ŀ¼����  
```shell
git clone https://github.com/zy73122/jdphp.git  
mv jdphp /data/wwwroot/jdphp  
```

* �������Ҫ�ֹ��������������ļ���  
```shell
mkdir 700 app/data/logs  
mkdir 700 app/data/template_compiled  
```

* ����MySQL���ݿ�  
 * �������ݿ�  
```shell
> create database jdphp109 charset=utf8  
mysql -uxx -pxx jdphp109 < jdphp108.sql  
```

* ʹ�������������� http://localhost/appdemo/ �鿴Ч��   

## ���ٴ���һ�����Լ���Ӧ��
* �½��������ļ�c_hello.php��·��Ϊappdemo\controller\c_hello.php
```php
<?php
/**
 * ���Կ�����
 *
 * @copyright JDphp���
 * @version 1.0.7
 * @author yy
 */
class c_hello
{
	/**
	 * Ĭ�϶���
	 */
	public function index()
	{
		echo "<h1>hello world.</h1>";
		echo "<ul>";
		echo "<li>��ҳ����c_hello::index()������.</li>";
		echo "<li>��������c_index���ļ�λ�ã�appdemo\controller\c_hello.php</li>";
		echo "</ul>";
	}
?>
```

* �鿴Ч�� http://localhost/appdemo/?c=hello&a=index
* �������ӣ���鿴appdemo

# Ŀ¼�ṹ    
    ����appdemo              Ӧ�����ƣ�ʾ����  
    ��  ����config            Ӧ�õ�����Ŀ¼  
    ��  ����controller        ������  
    ��  ����model             ģ��  
    ��  ����data  
    ��  ��  ����arrayfile      �ļ�����  
    ��  ��  ����cache          �ļ�����  
    ��  ��  ����logs           ��־
    ��  ��  ����session        �Ự  
    ��  ��  ����template_compiled    ������ģ���ļ�  
    ��  ����language          ����  
    ��  ��  ����enUS  
    ��  ��  ����zhCN  
    ��  ��  ����zhTW  
    ��  ����template          ģ��  
    ����config               ����Ŀ¼  
    ����static               ��̬�ļ�  
    ��  ����css  
    ��  ����images  
    ��  ����js  
    ����system               ��ܺ���Ŀ¼  
        ����external         ��չ���  
        ��  ����model         ��չ���ģ��  
        ��  ����module        ģ��  
        ��  ����plugin        ���  
        ��  ����widget        �Ҽ�  
        ����include          ϵͳ�����ļ�  
        ����model            ģ��  
        ����tool             ����Ŀ¼  

        
# ��ϵ��ʽ  
Author��zhangyu  
E-mail��396772873@qq.com  
