<?php
use WideImage\Exception\Exception;

/**
 * Please Mailboxs Ticketer of Batch Group & User Mailboxss
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
 * @description 	Mailboxs Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
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
require_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'functions.php');
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'mailboxs' . DIRECTORY_SEPARATOR . 'api.php');
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'mailboxs' . DIRECTORY_SEPARATOR . 'imap.php');

/**
 * Class for Mailboxs in Please email ticketer
 *
 * For Table:-
 * <code>
 * CREATE TABLE `tickets_mailboxs` (
 *   `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
 *   `host` varchar(300) DEFAULT '',
 *   `username` varchar(198) DEFAULT '',
 *   `password` varchar(198) DEFAULT '',
 *   `reply` varchar(300) DEFAULT '',
 *   `method` enum('IMAP','API') DEFAULT 'POP',
 *   `attachments` enum('Yes','No') DEFAULT 'Yes',
 *   `signature` enum('Both','Staff','Manager','Department','None') DEFAULT 'Both',
 *   `ticket` enum('Yes','No') DEFAULT 'Yes',
 *   `reply` enum('Yes','No') DEFAULT 'Yes',
 *   `collect` enum('Yes','No') DEFAULT 'Yes',
 *   `images` enum('Yes','No') DEFAULT 'Yes',
 *   `wammy` enum('Yes','No') DEFAULT 'Yes',
 *   `wammy-uri` varchar(300) DEFAULT 'http://wammy.labs.coop',
 *   `wammy-auto-high` int(12) DEFAULT '0',
 *   `wammy-auto-low` int(12) DEFAULT '0',
 *   `wammy-auto-spams` int(12) DEFAULT '0',
 *   `wammy-auto-hams` int(12) DEFAULT '0',
 *   `wammy-moderated-high` int(12) DEFAULT '0',
 *   `wammy-moderated-low` int(12) DEFAULT '0',
 *   `wammy-moderated-spams` int(12) DEFAULT '0',
 *   `wammy-moderated-hams` int(12) DEFAULT '0',
 *   `uids` TINYTEXT,
 *   `department-ids` TINYTEXT,
 *   `messages` int(12) DEFAULT '0',
 *   `tickets` int(12) DEFAULT '0',
 *   `errors` int(12) DEFAULT '0',
 *   `keywords` int(12) DEFAULT '0',
 *   `last-ticket-id` mediumint(30) DEFAULT '0',
 *   `waiting` int(12) DEFAULT '540',
 *   `created` int(12) DEFAULT '0',
 *   `errored` int(12) DEFAULT '0',
 *   `action` int(12) DEFAULT '0',
 *   PRIMARY KEY (`id`),
 *   KEY `SEARCH` (`errored`,`action`,`waiting`,`uids`(18),`department-ids`(18))
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsMailboxs extends ticketsXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('host', XOBJ_DTYPE_TXTBOX, null, false, 300);
        self::initVar('username', XOBJ_DTYPE_TXTBOX, null, false, 198);
        self::initVar('password', XOBJ_DTYPE_TXTBOX, null, false, 198);
        self::initVar('port', XOBJ_DTYPE_INT, 993, false);
        self::initVar('reply', XOBJ_DTYPE_TXTBOX, $ticketsConfigsList['default-reply'], false, 300);
        self::initVar('folders', XOBJ_DTYPE_ARRAY, array('INBOX'=>0), false);
        self::initVar('ssl', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'ssl'));
        self::initVar('method', XOBJ_DTYPE_ENUM, 'IMAP', false, false, false, getEnumeratorValues(basename(__FILE__), 'method'));
        self::initVar('attachments', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'attachments'));
        self::initVar('signature', XOBJ_DTYPE_ENUM, 'Both', false, false, false, getEnumeratorValues(basename(__FILE__), 'signature'));
        self::initVar('ticket', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'collect'));
        self::initVar('reply', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'collect'));
        self::initVar('collect', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'collect'));
        self::initVar('images', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'images'));
        self::initVar('wammy', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, getEnumeratorValues(basename(__FILE__), 'wammy'));
        self::initVar('wammy-uri', XOBJ_DTYPE_TXTBOX, $ticketsConfigsList['default-wammy'], false, 300);
        self::initVar('wammy-auto-high', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-auto-low', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-auto-spams', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-auto-hams', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-moderated-high', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-moderated-low', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-moderated-spams', XOBJ_DTYPE_INT, null, false);
        self::initVar('wammy-moderated-hams', XOBJ_DTYPE_INT, null, false);
        self::initVar('uids', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('departments-ids', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('messages', XOBJ_DTYPE_INT, null, false);
        self::initVar('tickets', XOBJ_DTYPE_INT, null, false);
        self::initVar('errors', XOBJ_DTYPE_INT, null, false);
        self::initVar('keywords', XOBJ_DTYPE_INT, null, false);
        self::initVar('last-ticket-id', XOBJ_DTYPE_INT, null, false);
        self::initVar('waiting', XOBJ_DTYPE_INT, $ticketsConfigsList['default-waiting'], false);
        self::initVar('created', XOBJ_DTYPE_INT, time(), false);
        self::initVar('errored', XOBJ_DTYPE_INT, null, false);
        self::initVar('action', XOBJ_DTYPE_INT, time(), false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

}


/**
 * Handler Class for Mailboxs in Please email ticketer
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class ticketsMailboxsHandler extends ticketsXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'tickets_mailboxs';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'ticketsMailboxs';
	
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
	var $envalued = 'last-ticket-id';
	
    function __construct(&$db) 
    {
    	if (!object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, self::$tbl, self::$child, self::$identity, self::$envalued);
    }
    
    /**
     * Checks Mailboxes for new Tickets or attach or reply further data
     * 
     * @return boolean
     */
    function getEmailTickets()
    {
    	$addressesHandler = xoops_getModuleHandler('addresses', _MI_TICKETS_MODULE_DIRNAME);
    	$bccHandler = xoops_getModuleHandler('bcc', _MI_TICKETS_MODULE_DIRNAME);
    	$ccHandler = xoops_getModuleHandler('cc', _MI_TICKETS_MODULE_DIRNAME);
    	$contentHandler = xoops_getModuleHandler('content', _MI_TICKETS_MODULE_DIRNAME);
    	$departmentsEscalationHandler = xoops_getModuleHandler('departments_escalations', _MI_TICKETS_MODULE_DIRNAME);
    	$departmentsStaffKeywordsHandler = xoops_getModuleHandler('departments_staff_keywords', _MI_TICKETS_MODULE_DIRNAME);
    	$departmentsStaffHandler = xoops_getModuleHandler('departments_staff', _MI_TICKETS_MODULE_DIRNAME);
    	$departmentsHandler = xoops_getModuleHandler('departments', _MI_TICKETS_MODULE_DIRNAME);
    	$emailsFilesHandler = xoops_getModuleHandler('emails_files', _MI_TICKETS_MODULE_DIRNAME);
    	$emailsHandler = xoops_getModuleHandler('emails', _MI_TICKETS_MODULE_DIRNAME);
    	$filesHandler = xoops_getModuleHandler('files', _MI_TICKETS_MODULE_DIRNAME);
    	$imagesHandler = xoops_getModuleHandler('images', _MI_TICKETS_MODULE_DIRNAME);
    	$keywordsHandler = xoops_getModuleHandler('keywords', _MI_TICKETS_MODULE_DIRNAME);
    	$messagesCCHandler = xoops_getModuleHandler('messages_cc', _MI_TICKETS_MODULE_DIRNAME);
    	$messagesFilesHandler = xoops_getModuleHandler('messages_files', _MI_TICKETS_MODULE_DIRNAME);
    	$messagesToHandler = xoops_getModuleHandler('messages_to', _MI_TICKETS_MODULE_DIRNAME);
    	$messagesHandler = xoops_getModuleHandler('messages', _MI_TICKETS_MODULE_DIRNAME);
    	$mimetypesHandler = xoops_getModuleHandler('mimetypes', _MI_TICKETS_MODULE_DIRNAME);
    	$namesHandler = xoops_getModuleHandler('names', _MI_TICKETS_MODULE_DIRNAME);
    	$spamKeywordsHandler = xoops_getModuleHandler('spam_keywords', _MI_TICKETS_MODULE_DIRNAME);
    	$spamAddressesHandler = xoops_getModuleHandler('spam_addresses', _MI_TICKETS_MODULE_DIRNAME);
    	$subjectsHandler = xoops_getModuleHandler('subjects', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsAttachmentsHandler = xoops_getModuleHandler('tickets_attachments', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsContentHandler = xoops_getModuleHandler('tickets_content', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsDepartmentsHandler = xoops_getModuleHandler('tickets_departments', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsFilesHandler = xoops_getModuleHandler('tickets_files', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsKeywordsHandler = xoops_getModuleHandler('tickets_keywords', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsRefereeHandler = xoops_getModuleHandler('tickets_referees', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketsHandler = xoops_getModuleHandler('tickets', _MI_TICKETS_MODULE_DIRNAME);
    	$toHandler = xoops_getModuleHandler('to', _MI_TICKETS_MODULE_DIRNAME);
    	$ticketkeys = $ticketsHandler->getActiveKeysArray(true);
    	
    	$sql = "SELECT `id` FROM `" . $this->db->prefix($this->tbl) . "` WHERE `action` + `waiting` < ".time()." OR  `errored` + (`waiting`*5) < " . time();
    	$mailboxes=array();
    	$result = $this->db->queryF($sql);
    	while($row = $this->db->fetchArray($result))
    	{
    		$mailboxes[$row['id']] = $this->get($row['id']);
    	}
    	if (count($mailboxes)>0)
    	{
    		foreach($mailboxes as $mid => $mailbox)
    		{
    			try {
    				switch ($mailbox->getVar('method'))
    				{
    					case "IMAP":
    						$mapi = "PleaseMailImap";
    						break;
    					case "API":
    						$mapi = "PleaseMailApi";
    						break;
    				}
    				$folders = $mailbox->getVar('folders');
    				foreach($mailbox->getVar('folders') as $folder => $lastmessageid)
    				{
    					$mail = new $mapi($mailbox->getVar('host'), $mailbox->getVar('username'), $mailbox->getVar('password'), $mailbox->getVar('port'), ($mailbox->getVar('ssl')=='Yes'?true:false), $folder);
    					if (is_a($mail, $mapi) && is_object($mail))
    					{
    						foreach($mail->getMessageIds() as $msgid => $subject)
    						{
    							if ($lastmessageid<$msgid)
    							{
    								$folders[$folder] = $msgid;
    								$email = $mail->getMessage($msgid);
    								if (is_array($email) && !empty($email))
    								{
    									if ($mailbox->getVar('wammy')=='Yes')
    									{
    										$wammy = 	json_decode(	getURIData($mailbox->getVar('wammy-uri').'/v3/'.$mailbox->getVar('id').$msgid.'/test.api', 
    																	array(	'usernames' => array('sender'=>md5($email['from']), 'recipient' => md5($email['to'])),
    																			'emails' => array('sender'=>$email['from'], 'recipient' => $email['to']),
    																			'sender-ip' => gethostbyname($mailbox->getVar('host')), 'subject' => $subject,
    																			'message' => $email['body'], 'mimetype' => 'text/html', 'mode' => 'json'   																		
    													)));
    									} else 
    										$wammy = array('result'=>'unknown');
    									$newticket = true;
    									$ticketid = 0;
    									$subjectid = 0;
    									foreach(array_keys($ticketkeys) as $key => $ticket)
    									{
    										if ($ticketid == 0 && (strpos(strtolower($subject), strtolower($key))>0 || strpos(strtolower($email['body']), strtolower($key))>0))
    										{
    											$ticketid = $ticket->getVar('id');
    											$subjectid = $ticket->getVar('subject-id');
    											$newticket = false;
    											continue;
    										}
    									}
    									if ($subjectid==0)
    									{
    										$subject = $subjectsHandler->create();
    										$subject->setVar('subject', $subject);
    										$subjectid=$subjectsHandler->insert($subject);
    									}
    									$subject = $subjectsHandler->get($subjectid);
    									
    									switch($wammy['result'])
    									{
    										case "spam":
    											
    											if ($ticketid==0)
    											{
    												$newticket = true;
    												$ticket = $ticketsHandler->create();
    												$ticket->setVar('state', 'spam');
    												$ticket->setVar('created', time());
    												$ticket->setVar('subject-id', $subject->getVar('id'));
    												$ticketid = $ticketsHandler->insert($ticket, true);
    											}
    											break;
    									
    										default:
    											
    											
    											if ($ticketid==0)
    											{
    												$newticket = true;
    												$ticket = $ticketsHandler->create();
    												$ticket->setVar('state', 'new');
    												$ticket->setVar('created', time());
    												$ticket->setVar('subject-id', $subject->getVar('id'));
    												$ticketid = $ticketsHandler->insert($ticket, true);
    											}
    											$ticket = $ticketsHandler->get($ticketid);
    											break;
    											
    									}
    									if (count($email['attachments']))
    									{
    										foreach($email['attachments'] as $key => $attachment)
    										{
    											if (isset($attachment['mimetype']) && (strpos(' '.strtolower($attachment['mimetype']), 'image') || strpos(' '.strtolower($attachment['mimetype']), 'img')))
    											{
    												if ($imagesHandler->imageExists($attachment['md5'], false)==false)
    												{
    													$img = $imagesHandler->create();
    														
    												} else
    													$email['attachments'][$key]['object'] = $imagesHandler->imageExists($attachment['md5'], true);
    											}
    										}
    									}
    								}
    							}
    						}
    					} else {
    						if (count($folders)>0)
    							$mailbox->setVar('folders', $folders);
    						$mailbox->setVar('errors', $mailbox->getVar('errors')+1);
    						$mailbox->setVar('errored', time());
    						$this->insert($mailbox, true);
    					}
    				}
    				if (count($folders)>0)
    				{
	    				$mailbox->setVar('folders', $folders);
	    				$this->insert($mailbox, true);
    				}
    				
    			}
    			catch(Exception $e)
    			{
    				$mailbox->setVar('errors', $mailbox->getVar('errors')+1);
    				$mailbox->setVar('errored', time());
    				$this->insert($mailbox, true);
    			}
    		}
    	}
    	return false;
    }
}
?>