<?php
/**
 * Please Images Ticketer of Batch Group & User Imagess
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
 * @description 	Images Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/Images/XOOPS%202.5/Modules/tickets
 * @link        	https://sourceforge.net/projects/chronolabs/Images/XOOPS%202.6/Modules/tickets
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http://internetfounder.wordpress.com
 */

if (!defined('_MI_TICKETS_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');

/**
 * Class for Images in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_images` (
 *   `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
 *   `storage` enum('PLEASE_DATA_PATH','PLEASE_UPLOAD_PATH') DEFAULT 'PLEASE_UPLOAD_PATH',
 *   `mimetype-id` mediumint(30) unsigned NOT NULL DEFAULT '0',
 *   `extension` varchar(30) DEFAULT '.',
 *   `filename` varchar(255) DEFAULT '.',
 *   `md5` varchar(32) DEFAULT '.',
 *   `path` varchar(255) DEFAULT '.',
 *   `bytes` int(12) DEFAULT '0',
 *   `created` int(12) DEFAULT '0',
 *   `deleted` int(12) DEFAULT '0',
 *   `accessed` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsImages extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('storage', XOBJ_DTYPE_ENUM, 'PLEASE_UPLOAD_PATH', false, false, false, getEnumeratorValues(basename(__FILE__), 'storage'));
        self::initVar('mimetype-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('extension', XOBJ_DTYPE_TXTBOX, null, false, 30);
        self::initVar('filename', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('path', XOBJ_DTYPE_TXTBOX, null, false, 255);
        self::initVar('md5', XOBJ_DTYPE_TXTBOX, null, false, 32);
        self::initVar('bytes', XOBJ_DTYPE_INT, null, false);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        self::initVar('deleted', XOBJ_DTYPE_INT, 0, false);
        self::initVar('accessed', XOBJ_DTYPE_INT, 0, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Images in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsImagesHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_Images';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsImages';
	
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
	var $envalued = 'filename';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
    
    /**
     * Checks for existing image
     * 
     * @param string $md5
     * @param string $asobject
     * @return object|boolean
     */
    function imageExists($md5 = '', $asobject = false)
    {
    	$criteria = new Criteria('md5', $md5, "LIKE");
    	if ($this->getCount($criteria)>0)
    		if ($asobject==true)
    		{
 				foreach($this->getObjects($criteria) as $obj) 
 					return $obj;
    		} else
    			return true;
    	return false;
    }
}
?>