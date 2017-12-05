<?php
/**
 * Please Wiki Ticketer of Batch Group & User Wikis
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
 * @description 	Wiki Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Wiki in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_wiki` (
 *   `id` mediumint(30) UNSIGNED NOT NULL AUTO_INCREMENT,
 *   `state` enum('public','staff','historical') DEFAULT 'public',
 *   `department-id` int(6) UNSIGNED DEFAULT '0',
 *   `key` varchar(44) DEFAULT '',
 *   `subject` varchar(190),
 *   `description` varchar(350),
 *   `tags` varchar(255),
 *   `problems` longtext,
 *   `solution` longtext,
 *   `created` int(12) DEFAULT '0',
 *   `approved` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`key`(20),`state`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsWiki extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('state', XOBJ_DTYPE_ENUM, 'public', false, false, false, getEnumeratorValues(basename(__FILE__), 'state'));
        self::initVar('department-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('key', XOBJ_DTYPE_TXTBOX, sha1(null), false, 44);
        self::initVar('subject', XOBJ_DTYPE_TXTBOX, null, false, 190);
        self::initVar('description', XOBJ_DTYPE_TXTBOX, null, false, 350);
        self::initVar('tags', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('problems', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('solution', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        self::initVar('approved', XOBJ_DTYPE_INT, null, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Wiki in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsWikiHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_wiki';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsWiki';
	
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
	var $envalued = 'approved';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
}
?>