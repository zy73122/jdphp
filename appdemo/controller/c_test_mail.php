<?php
/**
 * 测试页首页
 *
 * @copyright JDphp框架
 * @version 1.0.5
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
		
class c_test_mail
{

	function index()
	{
	}
	

	function ajax_send_test_email()
	{
		if($_GET)
		{
			$email_from = $GLOBALS['dbconfig']['cf_sysname'];
					
			$email_type = $_GET['email_type'];
			$email_ssl = $_GET['email_ssl'];
			$email_host = $_GET['email_host'];
			$email_port = $_GET['email_port'];
			$email_addr = $_GET['email_addr'];
			$email_id   = $_GET['email_id'];
			$email_pass = $_GET['email_pass'];
			$email_test = $_GET['email_test'];
			$email_subject = '测试邮件';
			$email_content = '这是一封测试邮件，证明您所邮件设置正常';

			/* 使用mailer类 */
			require_once(PATH_TOOL . 'mail.php');
			$mailer = new Mailer($email_from, $email_addr, $email_type, $email_host, $email_port, $email_id, $email_pass, $email_ssl);
			//发出第一封邮件
			$mail_result = $mailer->send($email_test, $email_subject, $email_content, CHARSET, 1);	
			//添加附件	
			$mailer->AddAttachment(PATH_DATA."mail/images/phpmailer.gif"); 
			$mailer->AddAttachment(PATH_DATA."mail/images/phpmailer_mini.gif");
			//发出第二封邮件
			$mailer->send($email_test, '第2封测试邮件', file_get_contents(PATH_DATA."mail/mail_test_contents.html"), CHARSET, 1);
			if ($mail_result)
			{
				echo json_encode(array('done'=>true, 'msg'=>language::get('mail_send_succeed')));
			}
			else
			{
				echo json_encode(array('done'=>false, 'msg'=>language::get('mail_send_failure')));
				cfile::write(PATH_DATA . 'log/mail_error.log', '发送测试邮件失败：' . implode("\n", $mailer->errors) . "\n", "ab");
				cfile::write(PATH_DATA . 'log/mail_error.log', "$email_from, $email_addr, $email_type, $email_host, $email_port, $email_id, $email_pass", "ab");
			}			
			exit;
		}
	}

	function ajax_send_email_test()
	{
		if($_GET)
		{
			if (!m_ex_email::$is_inited)
			{
				m_ex_email::init_email();
			}
			if (!m_ex_email::$cf_sendemail)
			{
				echo json_encode(array('done'=>false, 'msg'=>'请到后台开启"电子邮件发送"'));
				exit;
			}
				
			$email_to = 'zy73122@163.com';
			$email_subject = '这是一封测试邮件！';
			$email_content = "邮件内容..";
				
			/* 使用mailer类 */
			require_once(PATH_TOOL . 'mail.php');
			$mailer = new Mailer(m_ex_email::$email_from, m_ex_email::$email_addr, m_ex_email::$email_type, m_ex_email::$email_host, m_ex_email::$email_port, m_ex_email::$email_id, m_ex_email::$email_pass, m_ex_email::$email_ssl);
			//发出邮件
			$mail_result = $mailer->send($email_to, $email_subject, $email_content, CHARSET, 1);
			if ($mail_result)
			{
				echo json_encode(array('done'=>true, 'msg'=>language::get('mail_send_succeed')));
			}
			else
			{
				echo json_encode(array('done'=>false, 'msg'=>language::get('mail_send_failure')));
				cfile::write(PATH_DATA . 'log/mail_error.log', '发送邮件失败：' . implode("\n", $mailer->errors) . "\n", "ab");
				//cfile::write(PATH_DATA . 'log/mail_error.log', "m_ex_email::$email_from, m_ex_email::$email_addr, m_ex_email::$email_type, m_ex_email::$email_host, m_ex_email::$email_port, m_ex_email::$email_id, m_ex_email::$email_pass", "ab");
			}
			exit;
		}
	}
	
	
	function ajax_send_email_forgetpass()
	{
		if($_GET)
		{
			if (!m_ex_email::$is_inited)
			{
				m_ex_email::init_email();
			}
			if (!m_ex_email::$cf_sendemail)
			{
				echo json_encode(array('done'=>false, 'msg'=>'请到后台开启“电子邮件发送”'));
				exit;
			}
				
			$email_to = $_GET['email_to'];
			$username = $_GET['username'];
			if (!$email_to || !$username)
			{
				echo json_encode(array('done'=>false, 'msg'=>'请输入正确用户名和邮箱'));
				exit;
			}
			//从数据库重新修改密码。。
			//.....
			//$newpass =
				
			$email_subject = '这是一封关于忘记密码的邮件！';
			$email_content = file_get_contents(PATH_DATA."mail/mail_forget.html");
			$email_content = str_replace("#password#", $newpass, $email_content);
			$email_content = str_replace("#subject#", $email_subject, $email_content);
				
			/* 使用mailer类 */
			require_once(PATH_TOOL . 'mail.php');
			$mailer = new Mailer(m_ex_email::$email_from, m_ex_email::$email_addr, m_ex_email::$email_type, m_ex_email::$email_host, m_ex_email::$email_port, m_ex_email::$email_id, m_ex_email::$email_pass, m_ex_email::$email_ssl);
			//发出邮件
			$mail_result = $mailer->send($email_to, $email_subject, $email_content, CHARSET, 1);
			if ($mail_result)
			{
				echo json_encode(array('done'=>true, 'msg'=>language::get('mail_send_succeed')));
			}
			else
			{
				echo json_encode(array('done'=>false, 'msg'=>language::get('mail_send_failure')));
				cfile::write(PATH_DATA . 'log/mail_error.log', '发送邮件失败：' . implode("\n", $mailer->errors) . "\n", "ab");
				//cfile::write(PATH_DATA . 'log/mail_error.log', "m_ex_email::$email_from, m_ex_email::$email_addr, m_ex_email::$email_type, m_ex_email::$email_host, m_ex_email::$email_port, m_ex_email::$email_id, m_ex_email::$email_pass", "ab");
			}
			exit;
		}
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