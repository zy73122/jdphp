<?php

/**
 * ����91�������
 */
function decode_91data($data) {
	$r = array();
	$resultArray = explode("]", $data);
	foreach($resultArray AS $k=>$v) {
		if(empty($v)) continue;
		$vv = explode("[", $v);
		$r[$vv[0]] = $vv[1];
	}	
	return $r;
}
?>