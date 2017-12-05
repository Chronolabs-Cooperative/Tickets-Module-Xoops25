<?php
/**
 * Please Emails Ticketer of Batch Group & User Emailss
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
 * @description 	Emails Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Emails in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_emails` (
 *   `id` mediumint(30) UNSIGNED NOT NULL AUTO_INCREMENT,
 *   `from-id` int(14) UNSIGNED DEFAULT '0',
 *   `recieved` enum('html','text') DEFAULT 'html',
 *   `sending` enum('html','text') DEFAULT 'html',
 *   `subject-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `ticket-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `content-key` varchar(44) DEFAULT '',
 *   `attachments` int(6) DEFAULT '0',
 *   `created` int(12) DEFAULT '0',
 *   `sent` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`content-key`(20),`from-id`,`subject-id`,`ticket-id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsEmails extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('from-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('recieved', XOBJ_DTYPE_ENUM, 'html', false, false, false, getEnumeratorValues(basename(__FILE__), 'recieved'));
        self::initVar('sending', XOBJ_DTYPE_ENUM, 'html', false, false, false, getEnumeratorValues(basename(__FILE__), 'sending'));
        self::initVar('subject-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('ticket-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('content-key', XOBJ_DTYPE_TXTBOX, sha1(null), false, 44);
        self::initVar('attachments', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        self::initVar('sent', XOBJ_DTYPE_INT, null, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Emails in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsEmailsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_emails';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsEmails';
	
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