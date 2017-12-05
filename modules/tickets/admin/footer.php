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
* @subpackage  	language
* @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
* @version		1.0.5
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/tickets
* @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
* @link			http://internetfounder.wordpress.com
*/
if (!empty($GLOBALS['template']))
	$GLOBALS['xoopsTpl']->assign('footer',$footer="<div class='adminfooter'>\n" . "  <div style='text-align: center;'>\n" . "    <a href='http://www.xoops.org' rel='external'><img src='{$pathIcon32}/xoopsmicrobutton.gif' alt='XOOPS' title='XOOPS'></a>\n" . "  </div>\n" . '  ' . _AM_PLEASE_ADMIN_FOOTER . "\n" . '</div>');
if (!empty($GLOBALS['template']))
	$GLOBALS['xoopsTpl']->display($GLOBALS['template']);
if (empty($GLOBALS['template']))
	echo $footer;
xoops_cp_footer();
