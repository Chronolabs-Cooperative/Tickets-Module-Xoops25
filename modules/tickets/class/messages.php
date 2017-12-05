<?php
/**
 * Please Messages Ticketer of Batch Group & User Messagess
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
 * @description 	Messages Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Messages in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_messages` (
 *   `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
 *   `typal` enum('ndn','inbound','outbound','spam','unknown') DEFAULT 'unknown',
 *   `email-id` mediumint(30) unsigned DEFAULT '0',
 *   `subject-id` mediumint(30) unsigned DEFAULT '0',
 *   `ticket-id` mediumint(30) unsigned DEFAULT '0',
 *   `mailbox-id` mediumint(30) unsigned DEFAULT '0',
 *   `message-id` varchar(64) DEFAULT '',
 *   `from-id` mediumint(30) unsigned DEFAULT '0',
 *   `spam-email` enum('Yes','No') DEFAULT 'No',
 *   `spam-checking` enum('enabled','disabled') DEFAULT 'disabled',
 *   `spam-training` enum('used','ignored') DEFAULT 'ignored',
 *   `wammy-typal` enum('ham','spam','unknown') DEFAULT 'unknown',
 *   `wammy-high` int(10) unsigned DEFAULT '0',
 *   `wammy-low` int(10) unsigned DEFAULT '0',
 *   `words` int(10) unsigned DEFAULT '0',
 *   `files` int(10) unsigned DEFAULT '0',
 *   `when` int(12) unsigned DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`email-id`,`subject-id`,`ticket-id`,`mailbox-id`,`message-id`(32))
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsMessages extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('typal', XOBJ_DTYPE_ENUM, 'unknown', false, false, false, getEnumeratorValues(basename(__FILE__), 'typal'));
        self::initVar('email-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('subject-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('ticket-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('mailbox-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('message-id', XOBJ_DTYPE_TXTBOX, null, false, 64);
        self::initVar('from-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('spam-email', XOBJ_DTYPE_ENUM, 'No', false, false, false, getEnumeratorValues(basename(__FILE__), 'spam-email'));
        self::initVar('spam-checking', XOBJ_DTYPE_ENUM, 'disabled', false, false, false, getEnumeratorValues(basename(__FILE__), 'spam-checking'));
        self::initVar('spam-training', XOBJ_DTYPE_ENUM, 'ignored', false, false, false, getEnumeratorValues(basename(__FILE__), 'spam-training'));
        self::initVar('wammy-typal', XOBJ_DTYPE_ENUM, 'ham', false, false, false, getEnumeratorValues(basename(__FILE__), 'wammy-typal'));
        self::initVar('wammy-high', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-low', XOBJ_DTYPE_INT, null, false);
        self::initVar('words', XOBJ_DTYPE_INT, time(), false);
        self::initVar('files', XOBJ_DTYPE_INT, time(), false);
        self::initVar('when', XOBJ_DTYPE_INT, time(), false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Messages in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsMessagesHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_messages';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsMessages';
	
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
	var $envalued = 'message-id';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
}
?>