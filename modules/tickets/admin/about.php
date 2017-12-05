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
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/please
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/please
* @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/please
* @link			http://internetfounder.wordpress.com
*/

$GLOBALS['template'] = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . str_replace('.php', '.html', basename(__FILE__));
include_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
include_once __DIR__ . '/header.php';
xoops_cp_header();
$module_info = $module_handler->get($xoopsModule->getVar('mid'));
$aboutAdmin = new ModuleAdmin();
$GLOBALS['xoopsTpl']->assign('nav', $aboutAdmin->addNavigation(basename(__FILE__)));
$about = $aboutAdmin->renderAbout('ZZZXXX7777888', false);
$replace = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                     <input type="hidden" name="cmd" value="_s-xclick">
                     <input type="hidden" name="hosted_button_id" value="ZZZXXX7777888">
                     <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="background-color:transparent;">
                     <img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
                     </form>';
$GLOBALS['xoopsTpl']->assign('about', str_replace($replace, _AM_PLEASE_ADMIN_DONATE, $about));
include_once __DIR__ . '/footer.php';
