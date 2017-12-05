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

$GLOBALS['template'] = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . str_replace('.php', '.html', basename(__FILE__));
global $xoopsModule, $xoopsTpl, $thisModuleDir;

include_once __DIR__ . '/header.php';
xoops_cp_header();

$indexAdmin = new ModuleAdmin();
$indexAdmin->addItemButton(_AM_TICKETS_ADMIN_DEPARTMENTS_ADD, 'add-departments.php', 'add', '');
$GLOBALS['xoopsTpl']->assign('nav',$indexAdmin->addNavigation(basename(__FILE__)));
$GLOBALS['xoopsTpl']->assign('buttons',$indexAdmin->renderButton('right', ''));
$departments_handler = xoops_getModuleHandler('departments', $thisModuleDir);
if (!isset($GLOBALS['sort'])||empty($GLOBALS['sort']))
	$GLOBALS['sort'] = $departments_handler->getDefaultSort('admin');
$criteria = new Criteria(1, 1);
if (isset($GLOBALS['sort']) && !empty($GLOBALS['sort']))
	$criteria->setSort($GLOBALS['sort']);
if (isset($GLOBALS['order']) && !empty($GLOBALS['order']))
	$criteria->setOrder($GLOBALS['order']);
$pagenav = new XoopsPageNav($ttlitems = $departments_handler->count($criteria), $GLOBALS['limit'], $GLOBALS['start'], 'start', 'limit='.$GLOBALS['limit'].(isset($GLOBALS['op'])&&!empty($GLOBALS['op'])?'&op='.$GLOBALS['op']:"").(isset($GLOBALS['sort'])&&!empty($GLOBALS['sort'])?'&sort='.$GLOBALS['sort']:"").(isset($GLOBALS['order'])&&!empty($GLOBALS['order'])?'&order='.$GLOBALS['order']:""));
$GLOBALS['xoopsTpl']->assign('pagenav',$pagenav->renderNav(_AM_TICKETS_ADMIN_PAGENAV_OFFSET));
$criteria->setStart($GLOBALS['start']);
$criteria->setLimit($GLOBALS['limit']);
if ($ttlitems==0)
{
	redirect_header(XOOPS_URL . '/modules/' . $thisModuleDir . '/admin/add-department.php', 4, _ERR_TICKETS_ADMIN_NODEPARTMENTS);
	exit(0);
}
if ($departments = $departments_handler->getObjects($criteria, true, false))
{
	$GLOBALS['xoopsTpl']->assign('tableheaders', $departments_handler->getAdminListFormHeader());
	foreach($departments as $id => $department)
	{
		$GLOBALS['xoopsTpl']->append('departments', $department->getAdminListFormItems());
	}
} else {
	if ($GLOBALS['start']>0 && $GLOBALS['start'] > $GLOBALS['limit'])
		$GLOBALS['start'] = $GLOBALS['start'] - $GLOBALS['limit'];
	else
		$GLOBALS['start'] = 0;
	redirect_header(XOOPS_URL . '/modules/' . $thisModuleDir . '/admin/'.basename(__FILE__).'?start='.$GLOBALS['start'].'&limit='.$GLOBALS['limit'].(isset($GLOBALS['op'])&&!empty($GLOBALS['op'])?'&op='.$GLOBALS['op']:"").(isset($GLOBALS['sort'])&&!empty($GLOBALS['sort'])?'&sort='.$GLOBALS['sort']:"").(isset($GLOBALS['order'])&&!empty($GLOBALS['order'])?'&order='.$GLOBALS['order']:""), 4, _ERR_TICKETS_ADMIN_LISTRANGEEXCEEDED);
	exit(0);
}
$GLOBALS['xoopsTpl']->assign('start', $GLOBALS['start']);
$GLOBALS['xoopsTpl']->assign('limit', $GLOBALS['limit']);
$GLOBALS['xoopsTpl']->assign('sort', $GLOBALS['sort']);
$GLOBALS['xoopsTpl']->assign('order', $GLOBALS['order']);
include_once __DIR__ . '/footer.php';
