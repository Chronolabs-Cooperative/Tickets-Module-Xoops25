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

$path = dirname(dirname(dirname(__DIR__)));
include_once $path . '/mainfile.php';

$dirname         = basename(dirname(__DIR__));
$module_handler  = xoops_getHandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;

if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}

include_once $fileinc;

$adminmenu = array();

$i                      = 1;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_DEPARTMENTS;
$adminmenu[$i]['link']  = 'admin/departments.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/users.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_MAILBOXES;
$adminmenu[$i]['link']  = 'admin/mailboxes.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/mail_forward.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_ESCALATION;
$adminmenu[$i]['link']  = 'admin/escalations.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/security.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_USERS;
$adminmenu[$i]['link']  = 'admin/users.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/users.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_FILES;
$adminmenu[$i]['link']  = 'admin/files.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/fileshare.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_MIMETYPES;
$adminmenu[$i]['link']  = 'admin/mimetypes.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/upload.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_TICKETS;
$adminmenu[$i]['link']  = 'admin/tickets.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/event.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_KEYWQRDS;
$adminmenu[$i]['link']  = 'admin/keywords.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/highlight.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_REPORTS;
$adminmenu[$i]['link']  = 'admin/reports.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/newsletter.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_PERMISSIONS;
$adminmenu[$i]['link']  = 'admin/permissions.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/permissions.png';
++$i;
$adminmenu[$i]['title'] = _MI_TICKETS_ADMINMENU_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';
