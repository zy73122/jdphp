<?php
/**
 * 队列
 */
class rabbitmq
{
	/**
	 * 通过队列发手机验证码
	 */
	public static function sendsms($phone, $vercode, & $errmsg = '')
	{
		//发送mq队列
		try {
			$config = glb::$config;
			$cnn = new AMQPConnect($config['rabbitmq']);
			$exchange = new AMQPExchange($cnn);
			$exchange->declare('amq.direct', 'direct', AMQP_DURABLE); 
			
			$message = array(
				'kind' => 'smssaas',
				'data' => array(
					"smsid" => 0,
					"receiver" => array($phone),
					"msg" => "您的验证码为：".$vercode,
				)
			);

			$exchange->bind('queue_sms_send_saas', 'queue_sms_send_saas');
			$ret = $exchange->publish(json_encode($message), 'queue_sms_send_saas');
			if (!$ret) { 
				$errmsg = 'MQ队列发送失败';
				return false;
			}
		} 
		catch(Exception $e) 
		{ 
			$errmsg = "MQ队列异常(".$e->getMessage().")";
			return false;
		}

		return true;
	}

}
?>