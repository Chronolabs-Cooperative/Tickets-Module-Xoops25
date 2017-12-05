<?php
/**
 * Please Tickets Ticketer of Batch Group & User Ticketss
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
 * @description 	Tickets Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Tickets in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_tickets` (
 *   `id` mediumint(30) UNSIGNED NOT NULL AUTO_INCREMENT,
 *   `state` enum('new','waiting','resonded','closed','ignored','spam','allocated','claimed') DEFAULT 'new',
 *   `ticket-key` varchar(20) DEFAULT 'XXX-0000000XAA',
 *   `subject-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `from-id` int(14) UNSIGNED DEFAULT '0',
 *   `from-uid` int(11) UNSIGNED DEFAULT '0',
 *   `belong-uid` int(11) DEFAULT '0',
 *   `belong-gid` int(11) DEFAULT '0',
 *   `created` int(12) DEFAULT '0',
 *   `responded` int(12) DEFAULT '0',
 *   `sent` int(12) DEFAULT '0',
 *   `closed` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`ticket-key`(15),`state`,`subject-id`,`belong-uid`,`belong-gid`,`from-id`,`from-uid`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsTickets extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('project-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('version-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('state', XOBJ_DTYPE_ENUM, 'new', false, false, false, getEnumeratorValues(basename(__FILE__), 'state'));
        self::initVar('mode', XOBJ_DTYPE_ENUM, 'Open', false, false, false, getEnumeratorValues(basename(__FILE__), 'mode'));
        self::initVar('ticket-key', XOBJ_DTYPE_TXTBOX, 'XXX-0000000XAA', false, 20);
        self::initVar('subject-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('from-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('from-uid', XOBJ_DTYPE_INT, null, false);
        self::initVar('belong-uid', XOBJ_DTYPE_INT, null, false);
        self::initVar('belong-gid', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        self::initVar('responded', XOBJ_DTYPE_INT, null, false);
        self::initVar('sent', XOBJ_DTYPE_INT, null, false);
        self::initVar('closed', XOBJ_DTYPE_INT, null, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

    function getAdminLink()
    {
    	$dirname = basename(dirname(__DIR__));
    	return XOOPS_URL . '/modules/'.$dirname."/admin/view-ticket.php?id=" . $this->getMD5('id');
    }
}


/**
 * Handler Class for Tickets in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsTicketsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_tickets';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsTickets';
	
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
    
    /**
     * Returns all active Ticket Keys
     * 
     * @param string $asobjects
     * @return array
     */
    function getActiveKeysArray($asobjects = true)
    {
    	$criteria = new Criteria('closed', 0, '=');
    	$result = array();
    	foreach($this->getObjects($criteria) as $ticket)
    	{
    		if ($asobjects==true)
    		{
    			$result[$ticket->getVar('ticket-key')] = $ticket;
    		} else {
    			$result[$ticket->getVar('ticket-key')] = $ticket->getVar('id');
    		}
    	}
    	return $result;
    }
}
?>