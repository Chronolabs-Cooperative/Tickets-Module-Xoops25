<?php
/**
 * Please Projects Ticketer of Batch Group & User Projectss
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
 * @description 	Projects Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/tickets
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http://internetfounder.wordpress.com
 */

if (!defined('_MI_TICKETS_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');

/**
 * Class for Projects in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_projects` (
 *   `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
 *   `mode` enum('core','module','theme','plugin','unknown') DEFAULT 'unknown',
 *   `name` varchar(128) NOT NULL DEFAULT '',
 *   `description` tinytext,
 *   `logo` varchar(255) NOT NULL DEFAULT '',
 *   `uid` int(11) unsigned NOT NULL DEFAULT '0',
 *   `version-ids` mediumtext,
 *   `department-ids` mediumtext,
 *   `tester-ids` mediumtext,
 *   `staff-ids` mediumtext,
 *   `created` int(12) DEFAULT '0',
 *   `accessed` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`mode`,`name`,`created`,`desciption`,`logo`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */

class ticketsProjects extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('mode', XOBJ_DTYPE_ENUM, 'Open', false, false, false, getEnumeratorValues(basename(__FILE__), 'mode'));
        self::initVar('name', XOBJ_DTYPE_TXTBOX, null, false. 128);
        self::initVar('description', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('logo', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('uid', XOBJ_DTYPE_INT, null, false);
        self::initVar('version-ids', XOBJ_DTYPE_ARRAY, null, false);
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
 * Handler Class for Projects in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsProjectsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_projects';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsProjects';
	
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