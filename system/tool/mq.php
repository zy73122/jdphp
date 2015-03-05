<?php
/*
error_reporting(E_ALL ^ E_NOTICE);

//消息队列地址
$CONFIG['rabbitmq'] = array(
		'host' => 'localhost',
		'port' => 5672,
		'login' => 'guest',
		'password' => 'guest',
		'vhost' => '/'
);
*/

#====================================================
# test direct exchange
#====================================================
/*
###################生产者###################
#建立连接
$mq = new mq($CONFIG['rabbitmq']);

#发送消息
if (!$ret = $mq->send('test string!', 'amq.redirect')) {
	exit('发送失败');
}
###################消费者###################
#建立连接
$mq = new mq($CONFIG['rabbitmq']);

#消费一条
$data = $mq->receive('queename5', 'amq.redirect');

#消费5条，不移除
$data = $mq->receive('queename5', 'amq.redirect', 5, false);
var_dump($data);exit;

*/

#====================================================
# test direct exchange - Multiple bindings
#====================================================
/*
$mq = new mq($CONFIG['rabbitmq']);

# 绑定路由键：routkey
$ret = $mq->send('test message!', 'routkey');

# 下面两个队列都可以收到消息
$data1 = $mq->receive('queue_name_1', 'routkey');
$data2 = $mq->receive('queue_name_2', 'routkey');

var_dump($data1, $data2);exit;
*/


#====================================================
# test topic exchange
#====================================================
/*
$mq = new mq($CONFIG['rabbitmq'], AMQP_EX_TYPE_TOPIC);

$ret = $mq->send('test message!', 'kern.xxx');

#  * 匹配一个单词
#  # 匹配空或者多个单词
$data1 = $mq->receive('queue_name_all', '#', 10);
$data2 = $mq->receive('queue_name_kern', 'kern.*', 10);
$data3 = $mq->receive('queue_name_crit', '*.critical', 10);
$data4 = $mq->receive('queue_name_info', 'kern.*', 10);
$data5 = $mq->receive('queue_name_info', '*.critical', 10);
var_dump($data1, $data2, $data3, $data4, $data5);exit;

# queue_name_all收到一条
# queue_name_kern收到一条
# queue_name_crit未收到
# queue_name_info收到一条
*/


#====================================================
# test create/delete/bind queue
#====================================================
/*
#建立连接
$mq = new mq($CONFIG['rabbitmq']);

#创建队列
$ret1 = $mq->createqueue($queue_name = '0001', $routing_key = '0001'); //
$ret2 = $mq->createqueue($queue_name = '0002', $routing_key = '0001', $flags = AMQP_AUTODELETE, $expire = 60000); //过期自动删除
var_dump($ret1, $ret2);exit;

#删除队列
$ret1 = $mq->deletequeue($queue_name = '0001');
$ret2 = $mq->deletequeue($queue_name = '0002');
var_dump($ret1, $ret2);exit;
*/

#====================================================
# test block receive 
#====================================================
/*
$mq = new mq($CONFIG['rabbitmq']);
$ret = $mq->send('test message!', 'routkey');

$i = 0;
function processMessage($envelope, $queue) {
	global $i;
		
	# do something here 
	# 这里写消费的逻辑 ...
	echo $envelope->getBody();
	$i++;
	if ($i > 12) {
		return false;
	}
}

$ret = $mq->receive_block('queue_name_1', 'routkey', 'processMessage');
var_dump($ret);exit;
*/


#====================================================
# test fanout exchange 广播
#====================================================
/*
#建立连接
$mq = new mq($CONFIG['rabbitmq'], AMQP_EX_TYPE_FANOUT);

#发送消息
$ret = $mq->send('test string!', 'roukey_fanoutx');

#消费5条，不移除
# queename_t1、queename_t2都会收到上面那条消息
$data = $mq->receive('queename_t1', 'roukey_fanoutx', 5, false);
$data2 = $mq->receive('queename_t2', 'roukey_fanoutx', 5, false);
var_dump($data, $data2);exit;
*/

/*
#只是绑定队列 不接收消息
$mq = new mq($CONFIG['rabbitmq'], AMQP_EX_TYPE_FANOUT);
# queename_t1、queename_t2都会收到上面那条消息
$ret1 = $mq->createqueue('queename_t1', 'roukey_fanoutx');
$ret2 = $mq->createqueue('queename_t2', 'roukey_fanoutx');
var_dump($ret1, $ret2);exit;
*/



/*
#建立连接
try {
	$conn = new AMQPConnection($CONFIG['rabbitmq']);
	$ret = $conn->connect();
	if(!$conn->isConnected()) {
	   exit ("Cannot connect to the broker, exiting !\n");
	}
	$conn->setTimeout(10);
		
	#建立通道
	$channel = new AMQPChannel($conn);

	#建立交换机
	$exchange_type = AMQP_EX_TYPE_FANOUT;
	$exchangename = 'amq.'.$exchange_type;
	$exc = new AMQPExchange($channel);
	$exc->setName($exchangename);
	$exc->setType($exchange_type); //AMQP_EX_TYPE_DIRECT, AMQP_EX_TYPE_FANOUT, AMQP_EX_TYPE_TOPIC
	$exc->setFlags(AMQP_DURABLE); //AMQP_DURABLE, AMQP_PASSIVE.
	$exc->declare();

	#配置
	$queue_name = 'queename_fanout1';
	$queue_name2 = 'queename_fanout2';
	$routing_key = 'routkey_fanout';

	#发送消息
	$ret = $exc->publish('test string!', $routing_key);

	//建立队列/绑定队列
	$queue = new AMQPQueue($channel);
	$queue->setName($queue_name);
	$queue->setFlags(AMQP_DURABLE);//AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
	$msgcount = $queue->declare();
	$ret = $queue->bind($exchangename, $routing_key);
	
	$queue2 = new AMQPQueue($channel);
	$queue2->setName($queue_name2);
	$queue2->setFlags(AMQP_DURABLE);//AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
	$msgcount2 = $queue2->declare();
	$ret = $queue2->bind($exchangename, $routing_key);
	

	#消费一条
	$data = $queue->get(); 
	var_dump($msgcount);exit;
} catch (Exception $exc) {
	echo ('消息队列失败('.$exc->getMessage().')');
	exit;
}
*/


class mq
{
	public $conn;
	public $channel;
	public $exchange;
	public $exchange_name;
	
	#如果传入exchange_type，就自动创建交换机
	#$exchange_type : AMQP_EX_TYPE_DIRECT="direct", AMQP_EX_TYPE_FANOUT="fanout", AMQP_EX_TYPE_TOPIC="topic"
	#$exchange_type = false 时，不自动创建交换机
	public function __construct($config, $exchange_type = AMQP_EX_TYPE_DIRECT)
	{
		try {
			#建立连接
			$conn = new AMQPConnection($config);
			$ret = $conn->connect();
			if(!$conn->isConnected()) {
			   exit ("Cannot connect to the broker, exiting !\n");
			}
			$conn->setTimeout(5);
			$this->conn = $conn;
				
			#建立通道
			$channel = new AMQPChannel($conn);
			$this->channel = $channel;
			
			#建立交换机
			if ($exchange_type) {
				$ret = $this->create_exchange($exchange_type);
			}
			
			return true;
			
		} catch (Exception $exc) {
			echo ('消息队列失败('.$exc->getMessage().')');
			return false;
		}
	}
	
	#建立交换机
	#$exchange_type : AMQP_EX_TYPE_DIRECT="direct", AMQP_EX_TYPE_FANOUT="fanout", AMQP_EX_TYPE_TOPIC="topic"
	public function create_exchange($exchange_type = AMQP_EX_TYPE_DIRECT)
	{
		try {		
			#交换机名
			$exchangename = 'amq.'.$exchange_type;
			$this->exchange_name = $exchangename;			
			$exc = new AMQPExchange($this->channel);
			$exc->setName($this->exchange_name);
			$exc->setType($exchange_type); //AMQP_EX_TYPE_DIRECT, AMQP_EX_TYPE_FANOUT, AMQP_EX_TYPE_TOPIC
			$exc->setFlags(AMQP_DURABLE); //AMQP_DURABLE, AMQP_PASSIVE.
			$exc->declare();
			$this->exchange = $exc;
			return true;
		} catch (Exception $exc) {
			echo ('消息队列失败('.$exc->getMessage().')');
			return false;
		}
	}	
	
	#发送消息
	public function send($message, $routing_key, & $errmsg = null)
	{
		try {
			//发送消息				
			# public bool AMQPExchange::publish ( string $message , string $routing_key [, int $flags = AMQP_NOPARAM [, array $attributes = array() ]] )
			$ret = $this->exchange->publish($message, $routing_key);
			if (!$ret) {
				$errmsg = '发送消息失败';
				return false;
			}
			return $ret;	
			
		} catch (Exception $exc) {
			echo ('消息队列失败('.$exc->getMessage().')');
			return false;
		}
	}
	
	#接收消息（且绑定队列）
	#$getcount  获取消息数
	#$autodel 接收消息后，是否移除
	#返回新消息数总数
	public function receive($queue_name, $routing_key, $getcount = 1, $autodel = true)
	{
		try {			
			//建立队列
			$queue = new AMQPQueue($this->channel);
			$queue->setName($queue_name);
			$queue->setFlags(AMQP_DURABLE);//AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
			$msgcount = $queue->declare();
			$ret = $queue->bind($this->exchange_name, $routing_key);
				
			if ($getcount > $msgcount) {
				$getcount = $msgcount;
			}

			//消费消息 非阻塞方式
			$i = 0;
			$data = array();
			while ($i < $getcount) {
				$i++;
				if ($autodel) {
					$messages = $queue->get(AMQP_AUTOACK); #如果设置了AMQP_AUTOACK，新消息数-1 否则消息数不减
				} else {
					$messages = $queue->get(); 
				}
				if ($messages) {
					$data[] = $messages->getBody();
				}
			}
			
			return array(
				'newcount' => $msgcount,
				'data' => $data,
			);
			
		} catch (Exception $exc) {
			echo ('消息队列失败('.$exc->getMessage().')');
			return false;
		}
		
	}
	
	#接收消息 阻塞方式
	public function receive_block($queue_name, $routing_key, $callback = null)
	{
		try {
			//建立队列
			$queue = new AMQPQueue($this->channel);
			$queue->setName($queue_name);
			$queue->setFlags(AMQP_DURABLE);//AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
			$queue->declare();
			$ret = $queue->bind('amq.topic', $routing_key);
			

			//消费消息 阻塞方式			
			// Consume messages on queue
			$queue->consume($callback);
			return true;

		} catch (Exception $exc) {
			echo ('消息队列失败('.$exc->getMessage().')');
			return false;
		}
	
	}
	
	# 删除消息队列
	public function deletequeue($queue_name)
	{		
		try {
			//建立队列
			$queue = new AMQPQueue($this->channel);
			$queue->setName($queue_name);
			//$queue->setFlags(AMQP_DURABLE);//AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
			//$msgcount = $queue->declare();
			
			#删除队列
			$queue->delete();
			
		} catch (Exception $exc) {
			echo ('消息队列失败('.$exc->getMessage().')');
			return false;
		}
		
		return true;
	}
	
	# 创建队列
	# $flags:AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
	# 如果是AMQP_AUTODELETE类型，默认一星期过期
	# example:
	#$ret = $mq->createqueue('queuename_autodelet_001', 'rouckey1', AMQP_AUTODELETE);
	#$ret = $mq->createqueue('queuename_autodelet_002', 'rouckey1', AMQP_AUTODELETE);
	# 如果是AMQP_DURABLE类型，默认60秒过期
	public function createqueue($queue_name, $routing_key, $flags = AMQP_DURABLE, $expire = 604800000)
	{
		try {			
			//建立队列
			$queue = new AMQPQueue($this->channel);
			$queue->setName($queue_name);
			$queue->setFlags($flags);//AMQP_DURABLE, AMQP_PASSIVE, AMQP_EXCLUSIVE, AMQP_AUTODELETE
			if ($flags == AMQP_AUTODELETE) {
				$queue->setArgument('x-expires', $expire); 
			}
			$msgcount = $queue->declare();
			$ret = $queue->bind($this->exchange_name, $routing_key);
			
		} catch (Exception $exc) {
			echo ('创建队列失败('.$exc->getMessage().')');
			return false;
		}
		return true;
	}
	
	public function __destruct()
	{
		if ($this->conn) {
			$this->conn->disconnect();
		}
	}
	

}



?>