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
include_once dirname(__DIR__) . '/header.php';
include_once $path . '/include/cp_functions.php';
require_once $path . '/include/cp_header.php';

global $xoopsModule, $xoopsTpl, $thisModuleDir;

$thisModuleDir = $GLOBALS['xoopsModule']->getVar('dirname');

//if functions.php file exist
//require_once dirname(__DIR__) . '/include/functions.php';

// Load language files
xoops_loadLanguage('errors', $thisModuleDir);
xoops_loadLanguage('admin', $thisModuleDir);
xoops_loadLanguage('modinfo', $thisModuleDir);
xoops_loadLanguage('main', $thisModuleDir);
xoops_load('pagenav');

$pathIcon16      = '../' . $xoopsModule->getInfo('icons16');
$pathIcon32      = '../' . $xoopsModule->getInfo('icons32');
$pathModuleAdmin = $xoopsModule->getInfo('dirmoduleadmin');

$myts = MyTextSanitizer::getInstance();

if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    include_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new XoopsTpl();
}

include_once $GLOBALS['xoops']->path($pathModuleAdmin . '/moduleadmin.php');

xoops_loadLanguage('user');
if (!isset($GLOBALS['xoopsTpl']) || !is_object($GLOBALS['xoopsTpl'])) {
    include_once $GLOBALS['xoops']->path('/class/template.php');
    $GLOBALS['xoopsTpl'] = new XoopsTpl();
}

if (isset($GLOBALS['xoopsTpl']))
{
	$GLOBALS['xoopsTpl']->assign('dirname', $thisModuleDir);
}
if (isset($_REQUEST['start'])&&!empty($_REQUEST['start']))
	$GLOBALS['start'] = $_REQUEST['start'];
else
	$GLOBALS['start'] = 0;

if (isset($_REQUEST['limit'])&&!empty($_REQUEST['limit']))
	$GLOBALS['limit'] = $_REQUEST['limit'];
else
	$GLOBALS['limit'] = _AM_TICKETS_ADMIN_LIMIT_ITEMS;

if (isset($_REQUEST['sort'])&&!empty($_REQUEST['sort']))
	$GLOBALS['sort'] = $_REQUEST['sort'];
else 
	$GLOBALS['sort'] = '';

if (isset($_REQUEST['order'])&&!empty($_REQUEST['order']))
	$GLOBALS['order'] = $_REQUEST['order'];
else
	$GLOBALS['order'] = 'ASC';

if (isset($_REQUEST['op'])&&!empty($_REQUEST['op']))
	$GLOBALS['op'] = $_REQUEST['op'];
else
	$GLOBALS['op'] = '';

if (isset($_REQUEST['id'])&&!empty($_REQUEST['id']))
	$GLOBALS['id'] = $_REQUEST['id'];
else
	$GLOBALS['id'] = '';
