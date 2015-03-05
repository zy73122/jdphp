<?php
/**
 * 请求数据验证
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
/*
c验证规则配置：
ruleconf/example.php					//control name
return array(
	'eaction' => array(					//action name
		'get' => array(					//method
			'id' => array(				//var
				'not_empty' => null,	//validmethod => onerule
				'min_length' => 2,
				'digit' => null,
			),
		),
	),
);

//example:
$getdata = array('id'=> '121'); //要验证的变量
$errmsg = validation::instance('example', 'eaction', $_SERVER['REQUEST_METHOD'], $getdata)->validate();

*/

class validation
{
	public $rule;
	public $message;
	public $data;
	public $reqmethod;
	public $controller;
	public $action;
	public static $inst = array();
	
	public static function instance($controller, $action, $reqmethod, $data=null)
	{
		$flag = $controller.'_'.$action;
		if (!isset(self::$inst[$flag]) || empty(self::$inst[$flag]))
		{
			self::$inst[$flag] = new validation($controller, $action, $reqmethod, $data);
		}
		return self::$inst[$flag];
	}
	
	public function __construct($controller, $action, $reqmethod, $data=null)
	{
		$rulefile = PATH_APP . 'ruleconf/' . $controller . '.php';
		$messagefile = PATH_APP . 'ruleconf/message/' . $controller . '.php';
		if (file_exists($rulefile) && file_exists($messagefile))
		{
			$rule = require_once($rulefile);
			$message = require_once($messagefile);
			$this->controller = $controller;
			$this->action = $action;
		}
		else
		{
			$rule = null;
			$message = null;
			exit('请先配置ruleconf');
		}
		$this->set_rule($rule, $message, $reqmethod, $data);
		
	}
	
	public function set_rule($rule, $message, $reqmethod, $data=null)
	{
		$this->rule = $rule;
		$this->message = $message;
		$this->data = $data;
		$this->method = strtolower($reqmethod);
	}
	
	public function validate($data=null)
	{
		if (empty($this->data) && !empty($data)) {
			$this->data = $data;
		}
		$result = array();
		if (!empty($this->rule))
		//foreach ($this->rule as $k=>$onecate) //$one:action1,action2,..
		//{
			if (!empty($this->rule[$this->action][$this->method]))
			foreach ($this->rule[$this->action][$this->method] as $k2=>$onefield) //$one:get,post,..
			{
				$var = $k2;
				foreach ($onefield as $k3=>$onerule) //$one:not_empty, min_length, ...
				{
					if ($k3 == 'regvalid')
					{
						if (!preg_match('#'.$onerule.'#', $var))
						{
							$result[$var] = $this->message[$this->action][$k2][$k3];
						}
					}
					else if (method_exists(__CLASS__, $k3)) //$k3:not_empty, min_length, ...
					{
						if (!is_array($onerule))
						{
							$onerule = array($onerule);
						}
						$count = count($onerule);
						//ex: 'id' => array('min_length' => null,)
						if ($count == 0)
						{
							if (!$this->$k3($this->data[$var], $onerule))
							{
								$result[$var][] = sprintf($this->message[$this->action][$this->method][$k2][$k3], $onerule);
							}
						}
						else if ($count == 1)
						{
							//$this->not_empty(121, null);
							if (!$this->$k3($this->data[$var], $onerule[0]))
							{
								$result[$var][] = sprintf($this->message[$this->action][$this->method][$k2][$k3], $onerule[0]);
							}
						}
						else if ($count == 2)
						{
							if (!$this->$k3($this->data[$var], $onerule[0], $onerule[1]))
							{
								$result[$var][] = sprintf($this->message[$this->action][$this->method][$k2][$k3], $onerule[0], $onerule[1]);
							}
						}
						if (!isset($this->message[$this->action][$this->method][$k2][$k3])) //message未定义
						{
							exit('message未定义:array'."['{$this->action}']['{$this->method}']['{$k2}']['{$k3}']");
						}
					}
					else
					{
						exit('not exists validmethod:'.$k3);
					}
				}
			}
		//}
		$result_onlymsg = array();
		if (!empty($result)) {
			foreach ($result as $k=>$one) {
				$result_onlymsg[$k] = $one[0]; //每个HTML标签只得到第一个错误提示
			}
		}
		//return $result;
		return $result_onlymsg;
	}
	
	public static function not_empty($value)
	{
		return !empty($value);
	}
	
	public static function regex($value, $expression)
	{
		return (bool) preg_match($expression, (string) $value);
	}

	public static function min_length($value, $length)
	{
		return mb_strlen($value) >= $length;
	}

	public static function max_length($value, $length)
	{
		return mb_strlen($value) <= $length;
	}
	
	public static function email($email)
	{
		$expression = '/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD';

		return (bool) preg_match($expression, (string) $email);
	}

	public static function url($url)
	{
		return (bool) filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
	}

	public static function ip($ip, $allow_private = TRUE)
	{
		$flags = FILTER_FLAG_NO_RES_RANGE;

		if ($allow_private === FALSE)
		{
			$flags = $flags | FILTER_FLAG_NO_PRIV_RANGE;
		}

		return (bool) filter_var($ip, FILTER_VALIDATE_IP, $flags);
	}

	public static function date($str)
	{
		return (strtotime($str) !== FALSE);
	}

	public static function alpha($str)
	{
		$str = (string) $str;
		return ctype_alpha($str);
	}

	public static function alpha_numeric($str)
	{
		return ctype_alnum($str);
	}

	public static function digit($str)
	{
		return is_int($str) || ctype_digit($str);
	}

	public static function range($number, $min, $max)
	{
		return ($number >= $min && $number <= $max);
	}
	
	public static function mobile($email)
	{
		$expression = '/^1[3458][0-9]\d{8}$/i';
		return (bool) preg_match($expression, (string) $email);
	}


}
?>