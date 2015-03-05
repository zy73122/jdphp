<?php
/**
 * 计划任务类 客户端触发式
 *
 * @copyright JDphp框架
 * @version 1.0.8
 * @author yy
 */
defined('JDPHP_MAKER') || exit('Forbidden');
class m_plan extends db_gate
{
	//指定数据表名
	protected $tableName = "plan"; 
	
	//指定主键名，默认值为'id'
	protected $primaryKey = 'id';
	
	
	/**
	 * 添加计划任务
	 *
	 * @param  array $data
	 * @return none
	 * @throws none
	 */
	public function add_plan( $data = array() )
	{
		if( empty( $data ) )
		{
			return false;
		}
		extract( $data, EXTR_SKIP );
		!$title && exit('标题不能为空');
		$title = htmlspecialchars( $title );
		$filename = htmlspecialchars( $filename );

		if( is_numeric( $month ) )
		{
			$month = $month < 1 ? 1 : ( $month > 31 ? 31 : $month);
			$week = '*';
		}
		elseif( is_numeric($week) )
		{
			$week = $week < 1 ? 1 : ( $week > 7 ? 7 : $week );
			$month = '*';
		}
		else
		{
			$month = $week = '*';
		}//end if( is_numeric( $month ) )

		if( is_numeric($day) )
		{
			$day = $day<0 ? 0 : ($day>23 ? 23 : $day);
		}
		else
		{
			$day='*';
		}//end if( is_numeric($day) )

		if( is_array($hours) )
		{
			$hours = array_unique($hours);
			$hour_w = '';
			$hour_t = '';
			foreach( $hours as $key => $hour )
			{
				is_numeric( $hour ) && $hour_t = $hour < 0 ? 0 : ( $hour > 59 ? 59 : $hour );
				$hour_w .= $hour_w ? ',' . $hour_t : $hour_t;
			}
			!$hour_w && $hour_w='*';
		}
		else
		{
			$hour_w='*';
		}
		if( $month == '*' && $week == '*' && $day == '*' && $hour_w == '*' && $ifopen == 1 )
		{
			exit('time_error');
		} //if( is_array($hours) )

		$plan = array(
			'month' => $month,
			'week' => $week,
			'day' => $day,
			'hour' => $hour_w,
			'usetime' => '0',
			'ifopen' => $ifopen
			);
		$nexttime = $this->nexttime($plan);
		if( strpos($filename, '..') !== false )
		{
			exit("undefined_action");
		}
		$adddata[] = array(
		'subject'	=> $title,
		'month'		=> $month,
		'week'		=> $week,
		'day'		=> $day,
		'hour'		=> $hour_w,
		'nexttime'	=> $nexttime,
		'ifsave'	=> 0,
		'ifopen'	=> $ifopen,
		'filename'	=> $filename,
		);
		$this->add($adddata);
		tool::message("添加成功!",'?c=plan&a=index');
	}

	/**
	 * 编辑计划任务
	 *
	 * @param  int $id
	 * @param  array $data
	 * @return none
	 * @throws none
	 */
	public function edit_plan( $id, $data = array() )
	{
		if( empty( $data ) )
		{
			return false;
		}
		extract( $data, EXTR_SKIP );
		!$title && exit('标题不能为空');
		$title = htmlspecialchars( $title );
		$filename = htmlspecialchars( $filename );

		if( is_numeric( $month ) )
		{
			$month = $month < 1 ? 1 : ( $month > 31 ? 31 : $month);
			$week = '*';
		}
		elseif( is_numeric($week) )
		{
			$week = $week < 1 ? 1 : ( $week > 7 ? 7 : $week );
			$month = '*';
		}
		else
		{
			$month = $week = '*';
		}//end if( is_numeric( $month ) )

		if( is_numeric($day) )
		{
			$day = $day<0 ? 0 : ($day>23 ? 23 : $day);
		}
		else
		{
			$day='*';
		}//end if( is_numeric($day) )

		if( is_array($hours) )
		{
			$hours = array_unique($hours);
			$hour_w = '';
			$hour_t = '';
			foreach( $hours as $key => $hour )
			{
				if( is_numeric( $hour ) )
				{
					$hour_t = $hour < 0 ? 0 : ( $hour > 59 ? 59 : $hour );
					$hour_w .= $hour_w ? ',' . $hour_t : $hour_t;
				}
			}
			$hour_w === '' && $hour_w='*';
		}
		else
		{
			$hour_w='*';
		}
		if( $month == '*' && $week == '*' && $day == '*' && $hour_w == '*' && $ifopen == 1 )
		{
			exit('time_error');
		} //if( is_array($hours) )

		$plan = array(
			'month' => $month,
			'week' => $week,
			'day' => $day,
			'hour' => $hour_w,
			'usetime' => '0',
			'ifopen' => $ifopen
			);
		$nexttime = $this->nexttime($plan);
		if( strpos($filename, '..') !== false )
		{
			exit("undefined_action");
		}
		$editdata[] = array(
		'id'		=> $id,
		'subject'	=> $title,
		'month'		=> $month,
		'week'		=> $week,
		'day'		=> $day,
		'hour'		=> $hour_w,
		'nexttime'	=> $nexttime,
		'ifsave'	=> 0,
		'ifopen'	=> $ifopen,
		'filename'	=> $filename,
		);
		$this->edit($editdata);
		tool::message("修改成功!",'?c=plan&a=index');
	}

	/**
	 * 删除计划任务
	 *
	 * @param  mixed $plan_id
	 * @return none
	 * @throws none
	 */
	public function remove_plan( $plan_id )
	{
		if( is_array( $plan_id ) )
		{
			foreach( $plan_id as $current_id )
			{
				$this->remove_plan( $current_id );
			}
		}
		else
		{
			$plan_id = (int)$plan_id;
			$this->delete("id='$plan_id'");
		}
	}
	
	public function check_plan()
	{
		$plan_list = $this->get_plan_list("ifopen='1'");
		$timestamp = $_SERVER['REQUEST_TIME'];
		$plantime = $plan_list['plantime'];
		//unset( $plan_list['plantime'] );
		if ($plantime != '' && $timestamp > $plantime)
		{
			foreach($plan_list as $key => $plan)
			{
				if ($timestamp > $plan['nexttime'] && file_exists( PATH_DATA . 'plan/' . $plan['filename'] . '.php') )
				{
					$nexttime = $this->nexttime($plan);
					db::instance()->query("update #PRE#plan set usetime='$timestamp',nexttime='$nexttime' where id='" . $plan['id'] . "'");
					
					require PATH_DATA . 'plan/' . $plan['filename'] . '.php';
				}
			}
		}
	}

	public function execute_plan( $id )
	{
		if( $plan = $this->get_plan( $id ))
		{
			if( file_exists(PATH_DATA . 'plan/' . $plan['filename'] . '.php') )
			{
				 require PATH_DATA . 'plan/' . $plan['filename'] . '.php';
			}
		}

	}

	/**
	 * 读一条计划任务
	 *
	 * @param  mixed $plan_id
	 * @return none
	 * @throws none
	 */
	public function get_plan( $plan_id )
	{
		$plan_list = $this->get_plan_list();
		foreach( $plan_list as $current_plan)
		{
			if( $current_plan['id'] == $plan_id )
			{
				return $current_plan;
			}
		}
		return false;
	}

	/**
	 * 读计划任务列表
	 *
	 * @param  none
	 * @return array
	 * @throws none
	 */
	public function get_plan_list($condition='')
	{
		if (empty($condition)) 
			$condition = " 1 order by nexttime asc";
		else
			$condition .= " order by nexttime asc";
		$plan_list = $this->get_all("*", $condition);
		if ($plan_list)
		{
			foreach ($plan_list as $current_plan )
			{
				$plantime = $current_plan['nexttime'];
				break;
			}
			$plan_list['plantime'] = $plantime;
		}
		return $plan_list;
	}

	private function nexttime($plan)
	{
		if($plan['ifopen'] == 0) return 0;
		$timestamp = $_SERVER['REQUEST_TIME'];
		$t		= tool::get_date($timestamp,'G');		
		$timenow= (floor($timestamp / 3600) - $t)*3600;
		$minute = (int)tool::get_date($timestamp,'i');
		$hour   = tool::get_date($timestamp,'G');
		$day	= tool::get_date($timestamp,'j');
		$month  = tool::get_date($timestamp,'n');
		$year   = tool::get_date($timestamp,'Y');
		$week   = tool::get_date($timestamp,'w');
		$week==0 && $week=7;
		if(is_numeric($plan['month']))
		{
			$timenow += ($plan['month']-$day)*86400;
		}
		elseif(is_numeric($plan['week']))
		{
			$timenow += ($plan['week']-$week)*86400;
		}
		if(is_numeric($plan['day']))
		{
			$timenow += $plan['day']*3600;
		}
		if($plan['hour']!='*')
		{
			$hours=explode(',',$plan['hour']);
			asort($hours);
			if(is_numeric($plan['month']) || is_numeric($plan['week']) || is_numeric($plan['day']))
			{
				foreach($hours as $key=>$value)
				{
					if(($timenow+$value*60)>$plan['usetime'] && ($timenow+$value*60)>$timestamp)
					{
						$timenow +=$value*60;
						return $timenow;
					}
				}
			}
			else
			{
				$timenow += $hour*3600;
				for($i=0;$i<2;$i++)
				{
					foreach($hours as $key=>$value)
					{
						if(($timenow+$value*60)>$plan['usetime'] && ($timenow+$value*60)>$timestamp)
						{
							$timenow +=$value*60;
							return $timenow;
						}
					}
					$timenow +=3600;
				}
				return $timenow+$hours['0'];
			}
		}
		elseif($timenow>$plan['usetime'] && $timenow>$timestamp)
		{
			return $timenow;
		}
		if(is_numeric($plan['month']))
		{
			if(in_array($month,array('1','3','5','7','8','10','12')))
			{
				$days=31;
			}
			elseif($month!=2)
			{
				$days=30;
			}
			else
			{
				if(tool::get_date($timestamp,'L'))
				{
					$days=29;
				}
				else
				{
					$days=28;
				}
			}
			$timenow += $days*86400;
		}
		elseif(is_numeric($plan['week']))
		{
			$timenow += 604800;
		}
		elseif(is_numeric($plan['day']))
		{
			$timenow += 86400;
		}
		if($plan['hour']!='*')
		{
			$timenow += $hours[0]*60;
		}
		if($timenow>$timestamp)
		{
			return $timenow;
		}
		return $timestamp+86400;
	}
}
?>