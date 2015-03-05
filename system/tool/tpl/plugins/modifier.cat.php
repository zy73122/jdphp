<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:	 modifier<br>
 * Name:	 cat<br>
 * Date:2010-08-05
 * Purpose:  catenate a value to a variable
 * Input:	string to catenate
 * Example:  {$var|cat:"foo"}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *		  (Smarty online manual)
 * @author yy
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_cat($string, $cat)
{
	return $string . $cat;
}

/* vim: set expandtab: */

?>
