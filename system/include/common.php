<?php
/**
 * 全局函数
 *
 */

//DEBUG
function d()
{
	$args = func_get_args();
	if (isset($_GET['ajax'])) {
		rest::sendResponse(200, $args);
	} else {
		echo '<pre>';
		var_dump($args);
		echo '</pre>';
		exit;
	}
}

//DEBUG
function d2()
{
	$args = func_get_args();
	print_r($args);
}

function url($url)
{
	return tool::url($url);
	//return url::get($url);
}


//单例
function s()
{
 	$argc = func_num_args();
	$argv = func_get_args();
	return call_user_func_array('core::getSingleton', $argv);
// 	$numargs = func_num_args();
// 	if ($numargs == 0 || $numargs > 5)
// 	{
// 		return false;
// 	}
// 	$classname = func_get_arg(0);
// 	if ($numargs == 1)
// 	{
// 		return core::getSingleton($classname);
// 	}
// 	elseif ($numargs == 2)
// 	{
// 		return core::getSingleton($classname, func_get_arg(1));
// 	}
// 	elseif ($numargs == 3)
// 	{
// 		return core::getSingleton($classname, func_get_arg(1), func_get_arg(2));
// 	}
// 	elseif ($numargs == 4)
// 	{
// 		return core::getSingleton($classname, func_get_arg(1), func_get_arg(2), func_get_arg(3));
// 	}
// 	elseif ($numargs == 5)
// 	{
// 		return core::getSingleton($classname, func_get_arg(1), func_get_arg(2), func_get_arg(3), func_get_arg(4));
// 	}
// 	return false;
}
?>