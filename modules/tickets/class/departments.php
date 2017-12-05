<?php
/**
 * Please Departments Ticketer of Batch Group & User Departmentss
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors . 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE . 
 *
 * @copyright   	The XOOPS Project http : //sourceforge . net/projects/xoops/
 * @license     	General Public License version 3 (http : //labs . coop/briefs/legal/general-public-licence/13,3 . html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users . sourceforge . net>
 * @subpackage  	tickets
 * @description 	Departments Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https : //sourceforge.net/projects/chronolabs/files/XOOPS%202 . 5/Modules/tickets
 * @link        	https : //sourceforge.net/projects/chronolabs/files/XOOPS%202 . 6/Modules/tickets
 * @link			https : //sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http : //internetfounder.wordpress.com
 */

if (!defined('_MI_TICKETS_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects . php');

/**
 * Class for Departments in Please email ticketer
 *
 * For Table : -
 * <code>
 * CREATE TABLE `tickets_departments` (
 *   `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
 *   `code` varchar(3) DEFAULT 'ABC',
 *   `name` varchar(128) DEFAULT '',
 *   `description` tinytext,
 *   `mantis-uri` varchar(350) DEFAULT '',
 *   `mantis-username` varchar(45) DEFAULT '',
 *   `mantis-password` varchar(198) DEFAULT '',
 *   `mantis-project-id` int(11) UNSIGNED DEFAULT '0',
 *   `manager-uid` int(11) DEFAULT '0',
 *   `manager-bcc` enum('all-email','closed-email','all-pm','closed-pm','none') DEFAULT 'none',
 *   `manager-mantis-username` varchar(45) DEFAULT '',
 *   `manager-mantis-password` varchar(198) DEFAULT '',
 *   `mantis` enum('yes','no') DEFAULT 'no',
 *   `gid` int(8) DEFAULT '0',
 *   `tickets` int(12) DEFAULT '0',
 *   `staff` int(12) DEFAULT '0',
 *   `clients` int(12) DEFAULT '0',
 *   `raised` int(12) DEFAULT '0',
 *   `latest-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `closed-id` mediumint(30) UNSIGNED DEFAULT '0',
 *   `signature` varchar(300) DEFAULT '',
 *   `created` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsDepartments extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('code', XOBJ_DTYPE_TXTBOX, chr(mt_rand(ord("A"), ord("Z"))) . chr(mt_rand(ord("A"), ord("Z"))) . chr(mt_rand(ord("A"), ord("Z"))), false, 3);
        self::initVar('name', XOBJ_DTYPE_TXTBOX, null, false, 128);
        self::initVar('description', XOBJ_DTYPE_OTHER, null, false);
        self::initVar('mantis-uri', XOBJ_DTYPE_TXTBOX, null, false, 350);
        self::initVar('mantis-username', XOBJ_DTYPE_TXTBOX, null, false, 45);
        self::initVar('mantis-password', XOBJ_DTYPE_TXTBOX, null, false, 198);
        self::initVar('mantis-project-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('manager-uid', XOBJ_DTYPE_INT, null, false);
        self::initVar('manager-bcc', XOBJ_DTYPE_ENUM, 'no', false, false, false, getEnumeratorValues(basename(__FILE__), 'manager-bcc'));
        self::initVar('manager-mantis-username', XOBJ_DTYPE_TXTBOX, null, false, 45);
        self::initVar('manager-mantis-password', XOBJ_DTYPE_TXTBOX, null, false, 198);
        self::initVar('mantis', XOBJ_DTYPE_ENUM, 'no', false, false, false, getEnumeratorValues(basename(__FILE__), 'mantis'));
        self::initVar('gid', XOBJ_DTYPE_INT, null, false);
        self::initVar('tickets', XOBJ_DTYPE_INT, null, false);
        self::initVar('staff', XOBJ_DTYPE_INT, null, false);
        self::initVar('clients', XOBJ_DTYPE_INT, null, false);
        self::initVar('raised', XOBJ_DTYPE_INT, null, false);
        self::initVar('latest-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('closed-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('signature', XOBJ_DTYPE_TXTBOX, null, false, 300);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id)  &&  !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
        /**
         * Gets the drill down items for the form being submitted on the admin
         * control panel..
         * 
         * @return string
         */
        function getAdminListFormItems()
        {
        	require_once dirname(__DIR__) . DIRECTORY_SEPERATOR . 'include' . DIRECTORY_SEPERATOR . 'formloader.php';
        	
        	$ret = array();
        	$idhide = new XoopsFormHidden('id[' . $this->getMD5('id') . ']', (string)$this->getMD5('id'));
        	$ret['id'] = (string)$this->getVar('id') . $idhide->render();
        	$codetxt = new XoopsFormText('', 'code[' . $this->getMD5('id') . ']', 4, 3, (string)$this->getVar('code'));
        	$codehide = new XoopsFormHidden('old[code][' . $this->getMD5('id') . ']', (string)$this->getVar('code'));
        	$ret['code'] = $codetxt->render() . $codehide->render();
        	$nametxt = new XoopsFormText('', 'name[' . $this->getMD5('id') . ']', 26, 128, (string)$this->getVar('name'));
        	$namehide = new XoopsFormHidden('old[name][' . $this->getMD5('id') . ']', (string)$this->getVar('name'));
        	$ret['name'] = $nametxt->render().$namehide->render();
        	$mantisenum = new PleaseFormSelectEnumerator('', 'mantis[' . $this->getMD5('id') . ']', basename(__FILE__), 'mantis', (string)$this->getVar('name'));
        	$mantishide = new XoopsFormHidden('old[mantis][' . $this->getMD5('id') . ']', (string)$this->getVar('mantis'));
        	$ret['mantis'] = $nametxt->render().$mantishide->render();
        	$ret['tickets'] = (string)$this->getVar('tickets');
        	$ret['staff'] = (string)$this->getVar('staff');
        	$ret['clients'] = (string)$this->getVar('clients');
        	$ret['raised'] = (string)$this->getVar('raised');
        	$dirname         = basename(dirname(__DIR__));
        	$ticket_handler = xoops_getModuleHandler('tickets', $dirname);
        	if ($this->getVar('latest-id')>0)
        	{
        		$ticket = $ticket_handler->get($this->getVar('latest-id'));
        		$ret['latest'] = "<a href='" . $ticket->getAdminLink() . "' target='_blank'>" . $ticket->getVar('ticket-key') . "</a>";
        	} else {
        		$ret['latest'] = "&nbsp;";
        	}
        	if ($this->getVar('closed-id')>0)
        	{
        		$ticket = $ticket_handler->get($this->getVar('closed-id'));
        		$ret['closed'] = "<a href='" . $ticket->getAdminLink() . "' target='_blank'>" . $ticket->getVar('ticket-key') . "</a>";
        	} else {
        		$ret['closed'] = "&nbsp;";
        	}
        	
        	$module_handler  = xoops_getHandler('module');
        	$module          = $module_handler->getByDirname($dirname);
        	$pathIcon16      = $module->getInfo('icons16');
        	$ret['actions'] = "<a href='" . XOOPS_URL . "/modules/$dirname/admin/edit-departments.php?id=" . $this->getMD5('id') . "' target='_blank'><img src='" . $pathIcon16 . "/edit.png' alt='" . sprintf(_AM_TICKETS_ADMIN_DEPARTMENTS_EDIT, $this->getVar('name')) . "' title='" . sprintf(_AM_TICKETS_ADMIN_DEPARTMENTS_EDIT, $this->getVar('name')) . "'/></a>&nbsp;";
        	return $ret;
        }
        

        /**
         * Created the Add new Department form for the Admin Control Panel
         *
         * @return string
         */
        function getEditFormAdmin()
        {
        	$elements = array();
        	$dirname = basename(dirname(__DIR__));
        	require_once dirname(__DIR__) . DIRECTORY_SEPERATOR . 'include' . DIRECTORY_SEPERATOR . 'formloader.php';
        	 
        	$elements['code'] = new XoopsFormText(_AM_TICKETS_EDITFORM_DEPARTMENT_CODE_TITLE, 'code', 4, 3, $this->getVar('code'));
        	$elements['code']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_CODE_DESC);
        	$elements['name'] = new XoopsFormText(_AM_TICKETS_EDITFORM_DEPARTMENT_NAME_TITLE, 'name', 28, 128, $this->getVar('name'));
        	$elements['name']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_NAME_DESC);
        	$elements['description'] = new XoopsFormTextArea(_AM_TICKETS_EDITFORM_DEPARTMENT_DESCRIPTION_TITLE, 'description', $this->getVar('description'), 28, 8);
        	$elements['description']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_DESCRIPTION_DESC);
        	$elements['mantis'] = new PleaseFormSelectEnumerator(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTIS_TITLE, 'mantis', basename(__FILE__), 'mantis', (string)$this->getVar('mantis'));
        	$elements['mantis']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTIS_DESC);
        	$elements['mantis-uri'] = new XoopsFormText(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTISURI_TITLE, 'mantis-uri', 28, 350, $this->getVar('mantis-uri'));
        	$elements['mantis-uri']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTISURI_DESC);
        	$elements['mantis-username'] = new XoopsFormText(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTISUSERNAME_TITLE, 'mantis-username', 28, 45, $this->getVar('mantis-username'));
        	$elements['mantis-username']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTISUSERNAME_DESC);
        	$elements['mantis-password'] = new XoopsFormPassword(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTISPASSWORD_TITLE, 'mantis-password', 28, 198, $this->getVar('mantis-password'));
        	$elements['mantis-password']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANTISPASSWORD_DESC);
        	$elements['signature'] = new XoopsFormDhtmlTextArea(_AM_TICKETS_EDITFORM_DEPARTMENT_SIGNATURE_TITLE, 'signature', $this->getVar('signature'), 28, 8);
        	$elements['signature']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_SIGNATURE_DESC);
        	$elements['manager-uid'] = new XoopsFormSelectUser(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERUID_TITLE, 'manager-uid', true, $this->getVar('manager-uid'));
        	$elements['manager-uid']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERUID_DESC);
        	$elements['manager-bcc'] = new PleaseFormSelectEnumerator(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERBCC_TITLE, 'mantis', basename(__FILE__), 'manager-bcc', (string)$this->getVar('manager-bcc'));
        	$elements['manager-bcc']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERBCC_DESC);
        	$elements['manager-mantis-username'] = new XoopsFormText(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERMANTISUSERNAME_TITLE, 'mantis-username', 28, 45, $this->getVar('manager-mantis-username'));
        	$elements['manager-mantis-username']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERMANTISUSERNAME_DESC);
        	$elements['manager-mantis-password'] = new XoopsFormPassword(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERMANTISPASSWORD_TITLE, 'mantis-password', 28, 198, $this->getVar('manager-mantis-password'));
        	$elements['manager-mantis-password']->setDescription(_AM_TICKETS_EDITFORM_DEPARTMENT_MANAGERMANTISPASSWORD_DESC);
        	$elements['id'] = new XoopsFormHidden('id', $this->getMD5('id'));
        	$elements['submit'] = new XoopsFormButton('', 'submit', _SUBMIT);
        
        	 
        	$form = new XoopsThemeForm(_AM_TICKETS_ADMIN_DEPARTMENTS_EDITFORM_TITLE, 'edit-department', XOOPS_URL . '/modules/' . $dirname . '/admin/post.php?op=edit-department', 'post', true);
        	foreach($elements as $key => $obj)
        	{
        		if (in_array($key, array('code', 'name', 'description')))
        			$form->addElement($elements[$key], true);
        		else
        			$form->addElement($elements[$key], false);
        	}
        	 
        	return $form->render();
        }
        
    }

}


/**
 * Handler Class for Departments in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsDepartmentsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_departments';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsDepartments';
	
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
     * Created the Add new Department form for the Admin Control Panel
     * 
     * @return string
     */
    function getAddFormAdmin()
    {
    	$elements = array();
    	$dirname = basename(dirname(__DIR__));
    	require_once dirname(__DIR__) . DIRECTORY_SEPERATOR . 'include' . DIRECTORY_SEPERATOR . 'formloader.php';
    	
    	$elements['code'] = new XoopsFormText(_AM_TICKETS_ADDFORM_DEPARTMENT_CODE_TITLE, 'code', 4, 3, chr(mt_rand(ord("A"), ord("Z"))) . chr(mt_rand(ord("A"), ord("Z"))) . chr(mt_rand(ord("A"), ord("Z"))));
    	$elements['code']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_CODE_DESC);
    	$elements['name'] = new XoopsFormText(_AM_TICKETS_ADDFORM_DEPARTMENT_NAME_TITLE, 'name', 28, 128, '');
    	$elements['name']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_NAME_DESC);
    	$elements['description'] = new XoopsFormTextArea(_AM_TICKETS_ADDFORM_DEPARTMENT_DESCRIPTION_TITLE, 'description', '', 28, 8);
    	$elements['description']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_DESCRIPTION_DESC);
    	$elements['mantis'] = new PleaseFormSelectEnumerator(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTIS_TITLE, 'mantis', basename(__FILE__), 'mantis', 'no');
    	$elements['mantis']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTIS_DESC);
    	$elements['mantis-uri'] = new XoopsFormText(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTISURI_TITLE, 'mantis-uri', 28, 350, 'http://');
    	$elements['mantis-uri']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTISURI_DESC);
    	$elements['mantis-username'] = new XoopsFormText(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTISUSERNAME_TITLE, 'mantis-username', 28, 45, '');
    	$elements['mantis-username']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTISUSERNAME_DESC);
    	$elements['mantis-password'] = new XoopsFormPassword(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTISPASSWORD_TITLE, 'mantis-password', 28, 198, '');
    	$elements['mantis-password']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_MANTISPASSWORD_DESC);
    	$elements['signature'] = new XoopsFormDhtmlTextArea(_AM_TICKETS_ADDFORM_DEPARTMENT_SIGNATURE_TITLE, 'signature', '', 28, 8);
    	$elements['signature']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_SIGNATURE_DESC);
    	$elements['manager-name'] = new XoopsFormText(_AM_TICKETS_ADDFORM_DEPARTMENT_MANAGERNAME_TITLE, 'manager-name', 28, 128, '');
    	$elements['manager-name']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_MANAGERNAME_DESC);
    	$elements['manager-email'] = new XoopsFormText(_AM_TICKETS_ADDFORM_DEPARTMENT_MANAGEREMAIL_TITLE, 'manager-email', 28, 128, '');
    	$elements['manager-email']->setDescription(_AM_TICKETS_ADDFORM_DEPARTMENT_MANAGEREMAIL_DESC);
    	$elements['submit'] = new XoopsFormButton('', 'submit', _SUBMIT);
    	
    	$form = new XoopsThemeForm(_AM_TICKETS_ADMIN_DEPARTMENTS_ADDFORM_TITLE, 'add-department', XOOPS_URL . '/modules/' . $dirname . '/admin/post.php?op=add-department', 'post', true);
    	foreach($elements as $key => $obj)
    	{
    		if (in_array($key, array('code', 'name', 'description', 'manager-name', 'manager-email')))
    			$form->addElement($elements[$key], true);
    		else 
    			$form->addElement($elements[$key], false);
    	}
    	
    	return $form->render();
    }
    
    /**
     * Gets the admin header table constants for the admin drilldown items
     * 
     * @return string
     */
    function getAdminListFormHeader()
    {
    	$dirname         = basename(dirname(__DIR__));
    	$ret = array();
    	$ret['id']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_ID;
    	$ret['id']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=id' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'id' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['code']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_CODE;
    	$ret['code']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=code' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'code' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['name']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_NAME;
    	$ret['name']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=name' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'name' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['mantis']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_MANTIS;
    	$ret['mantis']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=mantis' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'mantis' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['tickets']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_TICKETS;
    	$ret['tickets']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=tickets' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'tickets' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['staff']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_STAFF;
    	$ret['staff']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=staff' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'staff' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['clients']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_CLIENTS;
    	$ret['clients']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=clients' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'clients' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['raised']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_RAISED;
    	$ret['raised']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=raised' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'raised' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['latest']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_LATEST;
    	$ret['latest']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=latest-id' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'latest-id' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['closed']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_CLOSED;
    	$ret['closed']['url'] = XOOPS_URL . '/modules/' . $dirname . '/admin/departments.php?start=' . $GLOBALS['start'] . '&limit=' . $GLOBALS['limit'] . (isset($GLOBALS['op']) && !empty($GLOBALS['op']) ? '&op=' . $GLOBALS['op'] : "") . '&sort=closed-id' . (isset($GLOBALS['order']) && !empty($GLOBALS['order'] && $GLOBALS['sort'] == 'closed-id' && $GLOBALS['order'] == 'ASC') ? '&order=DESC' : '&order=ASC');
    	$ret['actions']['name'] = _AM_TICKETS_ADMIN_DEPARTMENTS_ACTIONS;
    	$ret['actions']['url'] = '';
    	 
    	return $ret;
    }
    
    
    /**
     * Get the default sort basis for criteria's
     * 
     * @param string $location
     * @return string
     */
    function getDefaultSort($location = 'admin')
    {
    	switch($location)
    	{
    		default: 
    		case "admin": 
    			return 'name';
    			break;
    		case "tickets": 
    			return 'code';
    			break;
    	}
    }
    
    /**
     * Inserts Objects in the database
     * 
     * {@inheritDoc}
     * @see XoopsPersistableObjectHandler::insert()
     */
    function insert($object = null, $force = true)
    {
    	if (is_a($object, "ticketsDepartments"))
    	{
    		if ($object->isNew())
    		{
    			$groups_handler =& xoops_gethandler('group');
    			$group = $groups_handler->create();
    			$group->setVar('name', substr(sprintf(_MI_TICKETS_GROUP_NAME_DEPARTMENT, $object->getVar('name')), 0, 99));
    			$group->setVar('description', sprintf(_MI_TICKETS_GROUP_DESC_DEPARTMENT, $object->getVar('description')));
    			$group->setVar('group_type', _MI_TICKETS_GROUP_TYPE_DEPARTMENT);
    			$object->setVar('gid', $groups_handler->insert($group, true));
    			$object->setVar('created', time());
    		}
    		return parent::insert($object, $force);
    	}
    	return false;
    }
}
?>