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
 * @subpackage  	tickets
 * @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/tickets
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http://internetfounder.wordpress.com
 */

function xoops_module_uninstall_tickets(&$module) {

	require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'groups.php';
	$groups_handler = xoops_getHandler('groups');
	$users_handler = xoops_getHandler('users');
	$uids = array();
	$sql = array();
	$criteria = new Criteria('group_type', 'tickets%', 'LIKE');
	if ($results = $groups_handler->getObjects($criteria)) {
		foreach($results as $group)
		{
			$sql[] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('groups'). " WHERE `groupid` = ". $group->getVar('groupid');
			$sql[] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('group_permission'). " WHERE `gperm_groupid` = ". $group->getVar('groupid');
			$ucriteria = new Criteria('gperm_groupid', $group->getVar('groupid'), '=');
			if ($gresults = $groups_handler->getObjects($ucriteria)) {
				foreach($gresults as $groupperm)
				{
					$user = $users_handler->get($groupperm->getVar('uid'));
					if (!in_array(XOOPS_GROUP_ADMIN, $user->getGroups()))
						$uids[$groupperm->getVar('uid')] = $groupperm->getVar('uid');
				}
			}
		}
	}
	if (count($uids))
		$sql[] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('users'). " WHERE `uid` IN (". implode(", ", $uids) . ")";
	
	foreach($sql as $question)
		$GLOBALS['xoopsDB']->queryF($question);
	
	unlink (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'groups.php');
	
	return true;
	
}
	
?>