<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:	 modifier<br>
 * Name:	 nl2br<br>
 * Date:2010-08-05
 * Purpose:  convert \r\n, \r or \n to <<br>>
 * Input:<br>
 *		 - contents = contents to replace
 *		 - preceed_test = if true, includes preceeding break tags
 *		   in replacement
 * Example:  {$text|nl2br}
 * @link http://smarty.php.net/manual/en/language.modifier.nl2br.php
 *		  nl2br (Smarty online manual)
 * @version 1.0
 * @author yy
 * @param string
 * @return string
 */
function smarty_modifier_nl2br($string)
{
	return nl2br($string);
}

/* vim: set expandtab: */

?>
