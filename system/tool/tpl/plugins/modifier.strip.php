<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strip modifier plugin
 *
 * Type:	 modifier<br>
 * Name:	 strip<br>
 * Purpose:  Replace all repeated spaces, newlines, tabs
 *		   with a single space or supplied replacement string.<br>
 * Example:  {$var|strip} {$var|strip:"&nbsp;"}
 * Date:2010-08-05
 * @link http://smarty.php.net/manual/en/language.modifier.strip.php
 *		  strip (Smarty online manual)
 * @author yy
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_strip($text, $replace = ' ')
{
	return preg_replace('!\s+!', $replace, $text);
}

/* vim: set expandtab: */

?>