<?php
/**
 * Please Addresses Ticketer of Batch Group & User Addressess
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
 * @description 	Addresses Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
 * Class for Addresses in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsXoopsObject extends XoopsObject
{
	/**
	 * (non-PHPdoc)
	 * @see XoopsObject::assignVar()
	 */
	function assignVar($key, $value)
	{
		if ($this->vars[$key]['data_type'] == XOBJ_DTYPE_OTHER) {
			parent::assignVar($key, ticketsDecompressData($value));
		} elseif (strpos($key, 'pass')||strpos($key, 'password')) {
			parent::assignVar($key, ticketsDecryptPassword($value, PLEASE_SALT . PLEASE_SALT_WHENSET));
		} else
			parent::assignVar($key, $value);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see XoopsObject::cleanVars()
	 */
	function cleanVars($object = null)
	{
		$ret = false;
		if (empty($object)||is_null($object))
			$object = self;
		if (is_a($object, "XoopsObject"))
			if ($ret = parent::cleanVars($object))
			{
				foreach(array_keys($object->vars) as $field)
				{
					if ($object->vars[$field]['data_type'] == XOBJ_DTYPE_OTHER) {
						$object->vars[$field]['value'] = ticketsCompressData($object->vars[$field]['value']);
					} elseif (strpos($field, 'pass')||strpos($field, 'password')) {
						$object->vars[$field]['value'] = ticketsEncryptPassword($object->vars[$field]['value'], PLEASE_SALT . PLEASE_SALT_WHENSET);
					}
				}
			}
		return $ret;
	}
	
	/**
	 * Returns MD5 Identify hash for handler getMD5()'
	 * 
	 * @param string $field
	 * @return string
	 */
	function getMD5($field = 'id')
	{
		return md5(PLEASE_SALT . $this->getVar($field) . PLEASE_SALT);
	}
}

/**
 * Handler Modelling Class for Addresses in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsXoopsObjectHandler extends XoopsPersistableObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 *
	 * @var string
	 */
	var $tbl = '';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = '';
	
	/**
	 * Child Object Identity Key
	 *
	 * @var string
	 */
	var $identity = '';
	
	/**
	 * Child Object Default Envaluing Costs
	 *
	 * @var string
	 */
	var $envalued = '';
	
	/**
	 * Class Constructor
	 * @param XoopsDB $db
	 * @param string $tbl
	 * @param string $child
	 * @param string $identity
	 * @param string $envalued
	 */
	function __construct($db, $tbl = '', $child = '', $identity = '', $envalued = '')
	{
		if (!object($db))
			$db = $GLOBAL["xoopsDB"];
		$this->tbl = $tbl;
		$this->child = $child;
		$this->identity = $identity;
		$this->envalued = $envalued;
		return parent::__construct($db, $this->tbl, $this->child, $this->identity, $this->envalued);
	}
	
	/**
	 * Returns either object or identity key based on md5 passed to function
	 * 
	 * @param string $md5
	 * @param string $asObject
	 * @return XoopsObject|unknown|boolean
	 */
	function getMD5($md5 = '', $asObject = true)
	{
		$key = NULL;
		$sql = "SELECT `" . $this->identity . "` FROM `" . $this->db->prefix($this->tbl) . "` WHERE MD5(CONCAT(" . $this->db->quote(PLEASE_SALT) . ", `" . $this->identity . "`, " . $this->db->quote(PLEASE_SALT) . ")) LIKE '" . $md5 . "'";
		if ($result = $this->db->queryF($sql))
		{
			list($key) = $this->db->fetchRow($result);
		}
		if (!empty($key) && !is_null($key) && $asObject == true)
			return $this->get($key);
		if (!empty($key) && !is_null($key) && $asObject == false)
			return $key;
		return false;
	}
	
}