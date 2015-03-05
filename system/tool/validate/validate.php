<?php
/**
 * 请求数据验证
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');

class validate
{
	static $conf = array(
		'check_email' => '%s不是合法的Email格式',
		'check_url' => '%s不是合法的Url格式',
		'check_ip' => '%s不是合法的IP格式',
		'check_mobile' => '%s不是合法的手机格式',
		'check_range' => '%s值不在合法范围%s,%s内',
		'check_enum' => '%s不在枚举范围%s内',
		'check_len' => '%s长度不在合法范围%s内',
		'check_lenutf8' => '%s长度不在合法范围%s内',
		'check_not_empty' => '%s不为空',
		'check_equal' => '%s不等于%s',
		'check_int' => '%s不是整数',
		'check_uint' => '%s不是正整数',
		'check_uintnz' => '%s不是非0正整数',
		'check_uint_64' => '%s不是64位整数',
		'check_array' => '%s不是数组',
		'check_count' => '%s数量不在合法范围或格式不合法',
		'check_string' => '%s不是字符串',
		'check_regex' => '%s不合法',
		'check_date' => '%s不少日期格式',
		'check_alpha' => '%s不是全字母',
		'check_alpha_numeric' => '不是全数字或全字母',
		'check_digit' => '不是数字',
	
	);
	public $rule;
	public $message;
	public $data;
	public $reqmethod;
	public $rulefilename;
	public $rulekey;
	public $result;
	public static $inst = array();
	
	public static function instance($rulefilename, $rulekey, & $data = array())
	{
		$flag = $rulefilename.'_'.$rulekey;
		if (!isset(self::$inst[$flag]) || empty(self::$inst[$flag]))
		{
			self::$inst[$flag] = new self($rulefilename, $rulekey, $data);
		}
		return self::$inst[$flag];
	}
	
	public function __construct($rulefilename, $rulekey, & $data = array())
	{
		$rulefile = $rulefilename . '.php';
		if (file_exists($rulefile))
		{
			//exit("请先配置ruleconf.{$rulefilename}");
			$rule = require_once($rulefile);
			$this->rulekey = $rulekey;
			$this->rulefilename = $rulefilename;
			$this->set_rule($rule, $data);
		}
	}
	
	public function set_rule($rule, & $data = array())
	{
		$this->rule = $rule;
		$this->message = self::$conf;
		$this->data = & $data;
	}
	
	public function validate(& $data = array())
	{
		if (!empty($data)) {
			$this->data = & $data;
		}
		$result = array();

		if (isset($this->rule[$this->rulekey]))
		{
			//exit("请配置ruleconf.{$this->rulefilename}.{$this->rulekey}");
			$fields = $this->rule[$this->rulekey];
			foreach ($fields as $fieldname => $fieldrules) //$fieldrules:'not_empty digit len:2, default:10'
			{
			$var = $fieldname; //id,phone,...
			$fieldrules = explode(' ', $fieldrules);
			//默认值设置
			foreach ($fieldrules as $k => $one)
			{
				if (empty($one))
				{
					unset($fieldrules[$k]);
					continue;
				}
				$fun_params = explode(':', $one);
				$funname = 'check_' . $fun_params[0]; //not_empty,digit,...
				//设置默认值
				if ($funname == 'check_default')
				{
					if (!isset($this->data[$var])) //没传的字段采用默认值
						$this->data[$var] = $fun_params[1]; //default:1
					unset($fieldrules[$k]);
					continue;
				}
			}
			//规则校验
			foreach ($fieldrules as $one)
			{
				$fun_params = explode(':', $one);
				$funname = 'check_' . $fun_params[0]; //not_empty,digit,...
				if (!isset($this->message[$funname]))
				{
					throw new Exception("message未定义:{$funname}");
				}
				//类型强制转换
				if (isset($this->data[$var]) && in_array($funname, array('check_int','check_uint','check_uintnz')))
				{
					$this->data[$var] = intval($this->data[$var]);
				}
				if (method_exists(__CLASS__, $funname))
				{
					//拼凑检测函数和参数
					$param_arr = isset($fun_params[1]) ? explode('-', $fun_params[1]) : array();
					$param_arr_cp = $param_arr;
					array_unshift($param_arr, isset($this->data[$var]) ? $this->data[$var] : null);
					//print_r($param_arr);exit;
					$ret = call_user_func_array(array(__CLASS__, $funname), $param_arr);
					if (!$ret)
					{
						$param_arr = $param_arr_cp;
						array_unshift($param_arr, $var);
						array_unshift($param_arr, $this->message[$funname]);
						$result[$var] = call_user_func_array('sprintf', $param_arr);
					}
				}
			}
			
			}
		}
		$this->result = $result;
		//return $this->get_valid_result();
		return $this->get_valid_firstmsg();
	}
	
	/**
	 * 获取检测的错误提示
	 * @return array
	 */
	public function get_valid_result()
	{
		return $this->result;
	}
	
	/**
	 * 获取检测的第一条错误提示
	 * @return multitype:mixed
	 */
	public function get_valid_firstmsg()
	{
		if (!empty($this->result))
		{
			foreach ($this->result as $one)
			{
				return $one;
			}
		}
		return '';
	}

	public static function check_email($email)
	{
		$expression = '/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD';
		return (bool) preg_match($expression, (string) $email);
	}
	
	public static function check_url($url)
	{
		return (bool) filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
	}
	
	public static function check_ip($ip, $allow_private = TRUE)
	{
		$flags = FILTER_FLAG_NO_RES_RANGE;
	
		if ($allow_private === FALSE)
		{
			$flags = $flags | FILTER_FLAG_NO_PRIV_RANGE;
		}
	
		return (bool) filter_var($ip, FILTER_VALIDATE_IP, $flags);
	}
	
	public static function check_mobile($mobile)
	{
		$expression = '/^1[3458][0-9]\d{8}$/i';
		return (bool) preg_match($expression, (string) $mobile);
	}
	
	public static function check_range($number, $min = '', $max = '')
	{
		$ret = true;
		if ($min && $number < $min)
		{
			$ret = false;
		}
		if ($max && $number > $max)
		{
			$ret = false;
		}
		return $ret;
	}
	
	public static function check_enum($val, $vals)
	{
		if (is_string($vals) && strpos($vals, ',') !== false) 
			$vals = explode(',', $vals);
		return is_array($vals) && in_array($val, $vals);
	}
	
	public static function check_len($val, $min, $max = '')
	{
		$len = strlen($val);
		$ret = true;
		if ($min && $len < $min)
		{
			$ret = false;
		}
		if ($max && $len > $max)
		{
			$ret = false;
		}
		return $ret;
	}
	
	public static function check_lenutf8($val, $min, $max = '')
	{
		$len = mb_strlen($val, 'UTF8');
		$ret = true;
		if ($min && $len < $min)
		{
			$ret = false;
		}
		if ($max && $len > $max)
		{
			$ret = false;
		}
		return $ret;
	}
	
	public static function check_not_empty($val)
	{
		return !empty($val);
	}
	
	public static function check_equal($val, $val2)
	{
		return $val == $val2;
	}
	
	public static function check_int($val)
	{
		return is_numeric($val) && preg_match('|^\d+$|i', $val) && $val > -2147483648 && $val <= 2147483647;
	}
	
	public static function check_uint($val)
	{
		return is_numeric($val) && preg_match('|^\d+$|i', $val) && $val >= 0 && $val <= 4294967295;
	}
	
	public static function check_uintnz($val)
	{
		return is_numeric($val) && preg_match('|^\d+$|i', $val) && $val > 0 && $val <= 4294967295;
	}
	
	public static function check_uint_64($val)
	{
		return is_numeric($val) && preg_match('|^\d+$|i', $val) && $val >= 0 && $val <= 18446744073709551615;
	}
	
	public static function check_array($val)
	{
		return is_array($val);
	}
	
	public static function check_count($val, $count_min, $count_max = NULL, $check_fun = NULL)
	{
		if (!is_array($val)) return false;
		$len = count($val);
		$ret = true;
		if ($count_min && $len < $count_min)
		{
			$ret = false;
		}
		if ($count_max && $len > $count_max)
		{
			$ret = false;
		}
		if ($check_fun)
		{
			$check_fun = 'check_' . $check_fun;
			foreach ($val as $one)
			{
				if (!self::$check_fun($one)) return false;
			}
		}
		return $ret;
	}

	public static function check_string($val)
	{
		return is_string($val);
	}
	
	public static function check_regex($value, $expression)
	{
		return (bool) preg_match($expression, (string) $value);
	}
	
	/**
	 * 是否日期格式
	 * 
	 * @param string $str
	 * @return boolean
	 */
	public static function check_date($str)
	{
		return (strtotime($str) !== FALSE);
	}
	
	/**
	 * str里面的所有字符是否只包含字符。 在标准的 C 语言环境下，字母仅仅是指 [A-Za-z] 
	 * 如果在当前语言环境中 str 里的每个字符都是一个字母，那么就返回TRUE，反之则返回FALSE
	 * 
	 * @param string $str
	 * @return boolean
	 */
	public static function check_alpha($str)
	{
		$str = (string) $str;
		return ctype_alpha($str);
	}
	
	/**
	 * str 是否全部为字母和(或)数字字符。
	 * 如果str中所有的字符全部是字母和(或者)数字，返回 TRUE 否则返回FALSE
	 * @param unknown $str
	 * @return boolean
	 */
	public static function check_alpha_numeric($str)
	{
		return ctype_alnum($str);
	}
	
	public static function check_digit($str)
	{
		return is_numeric($str) || ctype_digit($str);
	}
	


}
?>