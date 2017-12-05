<?php
/**
 * Please Versions Ticketer of Batch Group & User Versionss
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://sourceforge.net/versions/xoops/
 * @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @subpackage  	tickets
 * @description 	Versions Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/versions/chronolabs/files/XOOPS%202.5/Modules/tickets
 * @link        	https://sourceforge.net/versions/chronolabs/files/XOOPS%202.6/Modules/tickets
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http://internetfounder.wordpress.com
 */

if (!defined('_MI_TICKETS_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');

/**
 * Class for Versions in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_versions` (
 *   `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
 *   `project-id` int(14) unsigned NOT NULL DEFAULT '0', 
 *   `major` int(4) unsigned NOT NULL DEFAULT '1',
 *   `minor` int(4) unsigned NOT NULL DEFAULT '1',
 *   `revision` int(4) unsigned NOT NULL DEFAULT '1',
 *   `subrevision` int(4) unsigned NOT NULL DEFAULT '1',
 *   `description` tinytext,
 *   `download-url` varchar(255) NOT NULL DEFAULT '',
 *   `svn-url` varchar(255) NOT NULL DEFAULT '',
 *   `git-url` varchar(255) NOT NULL DEFAULT '',
 *   `news-url` varchar(255) NOT NULL DEFAULT '',
 *   `uid` int(11) unsigned NOT NULL DEFAULT '0',
 *   `department-ids` mediumtext,
 *   `tester-ids` mediumtext,
 *   `staff-ids` mediumtext,
 *   `created` int(12) DEFAULT '0',
 *   `accessed` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`major`,`minor`,`revision`,`subrevision`,`descirption`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */

class ticketsVersions extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('mode', XOBJ_DTYPE_ENUM, 'Open', false, false, false, getEnumeratorValues(basename(__FILE__), 'mode'));
        self::initVar('major', XOBJ_DTYPE_INT, null, false);
        self::initVar('minor', XOBJ_DTYPE_INT, null, false);
        self::initVar('revision', XOBJ_DTYPE_INT, null, false);
        self::initVar('subrevision', XOBJ_DTYPE_INT, null, false);
        self::initVar('description', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('download-url', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('svn-url', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('git-url', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('news-url', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('uid', XOBJ_DTYPE_INT, null, false);
        self::initVar('department-ids', XOBJ_DTYPE_ARRAY, null, false);
        self::initVar('tester-ids', XOBJ_DTYPE_ARRAY, null, false);
        self::initVar('staff-ids', XOBJ_DTYPE_ARRAY, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        self::initVar('accessed', XOBJ_DTYPE_INT, time(), false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Versions in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsVersionsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_versions';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsVersions';
	
	/**
	 * Child Object Identity Key
	 *
	 * @var string
	 */
	var $identity = 'id';
	
	/**
	 * Child Object Default Envaluing Costs
	 *
	 * @var string
	 */
	var $envalued = 'created';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
}
?>