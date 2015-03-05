<?php
/**
 * 发送邮件
 * 依赖文件: mail.phpmailer.php and mail.smtp.php
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
define('MAIL_PROTOCOL_LOCAL', 0); //采用服务器内置的Mail服务
define('MAIL_PROTOCOL_SMTP', 1); //采用其他的SMTP服务

/**
 * 
 * 使用示例:
 $mailer = new Mailer('Bill', 'name@domain.com', MAIL_PROTOCOL_SMTP, 'smtp.domain.com', '25', 'username', 'password', 'ssl');
 $mailer->debug = true|false;
 $res = $mailer->send('who@domain.com,you@domain.com', 'Email Subject', 'Message Body', 'CHARSET', 1);
 *
 */
class Mailer
{
	var $timeout	= 30;
	var $errors	 = array();
	var $priority   = 3; // 1 = High, 3 = Normal, 5 = low
	var $debug	  = false;

	var $PluginDir  = "";
	var $mailer;

	function __construct($from, $email, $protocol, $host = '', $port = '', $user = '', $pass = '', $ssl = '')
	{
		$this->Mailer($from, $email, $protocol, $host, $port, $user, $pass, $ssl);
	}

	function Mailer($from, $email, $protocol, $host = '', $port = '', $user = '', $pass = '', $ssl = '')
	{
		include_once("mail.phpmailer.php");
		$this->mailer = new phpmailer();
		
		$this->mailer->From	 = $email;
		$this->mailer->FromName = $this->_base64_encode($from);

		if ($protocol == MAIL_PROTOCOL_LOCAL)
		{
			/* mail */
			$this->mailer->IsMail();
		}
		else
		{
			/* smtp */
			$this->mailer->IsSMTP();
			$this->mailer->Host	 = $host;
			$this->mailer->Port	 = $port;
			$this->mailer->SMTPAuth = !empty($pass);
			$this->mailer->Username = $user;
			$this->mailer->Password = $pass;
			if ($ssl)
			{		
				$this->mailer->SMTPDebug  = 2;  // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only		
				$this->mailer->SMTPSecure = "ssl";
			}
		}
	}
	
	function AddAttachment($attachmentfile)
	{
		$this->mailer->AddAttachment($attachmentfile);// "images/phpmailer.gif"
	}

	function send($mailto, $subject, $content, $charset, $is_html, $receipt = false)
	{
		$this->mailer->Priority	 = $this->priority;
		$this->mailer->CharSet	  = $charset;
		$this->mailer->IsHTML($is_html);
		$this->mailer->Subject	  = $this->_base64_encode($subject);
		$this->mailer->Body		 = $content;
		$this->mailer->Timeout	  = $this->timeout;
		$this->mailer->SMTPDebug	= $this->debug;
		$this->mailer->ClearAddresses();
		$this->mailer->AddAddress($mailto);

		$res = $this->mailer->Send();
		if (!$res)
		{
			$this->errors[] = $this->mailer->ErrorInfo;
		}
		return $res;
	}

	function _base64_encode($str = '')
	{
		return '=?' . CHARSET . '?B?' . base64_encode($str) . '?=';
	}
};

?>