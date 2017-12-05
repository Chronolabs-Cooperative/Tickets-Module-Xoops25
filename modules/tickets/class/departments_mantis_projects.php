<?php
/**
 * Please Departments_mantis_projects Ticketer of Batch Group & User Departments_mantis_projectss
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
 * @description 	Departments_mantis_projects Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Departments_mantis_projects in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_departments_mantis_projects` (
 *   `id` int(26) UNSIGNED NOT NULL AUTO_INCREMENT,
 *   `department-id` int(6)  UNSIGNED NOT NULL DEFAULT '0',
 *   `project-id` int(12) DEFAULT '0',
 *   `project-name` varchar(128) DEFAULT '',
 *   `project-description` tinytext,
 *   `tickets` int(12) DEFAULT '0',
 *   `clients` int(12) DEFAULT '0',
 *   `raised` int(12) DEFAULT '0',
 *   `latest-mantis-id` mediumint(30) DEFAULT '0',
 *   `closed-mantis-id` mediumint(30) DEFAULT '0',
 *   `created` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`department-id`,`project-id`,`project-name`(17),`latest-mantis-id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsDepartments_mantis_projects extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('department-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('project-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('project-name', XOBJ_DTYPE_TXTBOX, null, false, 128);
        self::initVar('project-description', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('tickets', XOBJ_DTYPE_INT, null, false);
        self::initVar('clients', XOBJ_DTYPE_INT, null, false);
        self::initVar('raised', XOBJ_DTYPE_INT, null, false);
        self::initVar('latest-mantis-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('closed-mantis-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, null, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Departments_mantis_projects in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsDepartments_mantis_projectsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_departments_mantis_projects';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsDepartments_mantis_projects';
	
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
	var $envalued = 'address';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
}
?>