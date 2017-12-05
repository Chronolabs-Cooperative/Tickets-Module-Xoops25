<?php
/**
 * Please Email Ticketer of Batch Group & User Emails
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @subpackage  	please
 * @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/please
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/please
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/please
 * @link			http://internetfounder.wordpress.com
 */

if (!function_exists('xoops_sef'))
{

	/**
	 * Xoops safe encoded url elements
	 *
	 * @param unknown $datab
	 * @param string $char
	 * @return string
	 */
	function xoops_sef($datab, $char ='-')
	{
		$replacement_chars = array();
		$accepted = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","m","o","p","q",
				"r","s","t","u","v","w","x","y","z","0","9","8","7","6","5","4","3","2","1");
		for($i=0;$i<256;$i++){
			if (!in_array(strtolower(chr($i)),$accepted))
				$replacement_chars[] = chr($i);
		}
		$return_data = (str_replace($replacement_chars,$char,($datab)));
		while(substr($return_data, 0, 1) == $char)
			$return_data = substr($return_data, 1, strlen($return_data)-1);
		while(substr($return_data, strlen($return_data)-1, 1) == $char)
			$return_data = substr($return_data, 0, strlen($return_data)-1);
		while(strpos($return_data, $char . $char))
			$return_data = str_replace($char . $char, $char, $return_data);
		return(strtolower($return_data));
	}
}

/**
 * Class XForumSefPreload
 */
class PleaseSefPreload extends XoopsPreloadItem
{

	/**
	 * 
	 * @param array $arg
	 */
	static function eventCoreHeaderAddmeta($arg)
	{
		
		$parts = explode(DIRECTORY_SEPARATOR, $_SERVER['PHP_SELF']);
		$moddir = basename(dirname(dirname(__FILE__)));
		if (in_array($moddir, $parts))
			$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/' . $moddir . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . $moddir . '.css', array(), '' );
	}
}

