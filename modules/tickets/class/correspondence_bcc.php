<?php
/**
 * Please Correspondences_bcc Ticketer of Batch Group & User Correspondences_bccs
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
 * @description 	Correspondences_bcc Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Correspondences_bcc in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_correspondences_bcc` (
 *   `id` mediumint(38) UNSIGNED NOT NULL AUTO_INCREMENT,
 *   `bcc-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `department-id` mediumint(6) UNSIGNED DEFAULT '0',
 *   `ticket-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `staff-id` mediumint(18) UNSIGNED DEFAULT '0',
 *   `sent` int(12) DEFAULT '0',
 *   `viewed` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsCorrespondences_bcc extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('bcc-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('department-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('ticket-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('staff-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('sent', XOBJ_DTYPE_INT, null, false);
        self::initVar('viewed', XOBJ_DTYPE_INT, null, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Correspondences_bcc in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsCorrespondences_bccHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_correspondences_bcc';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsCorrespondences_bcc';
	
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
	var $envalued = 'viewed';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
}
?>