<?php
/**
 * Please Email Ticketer of Batch Group & User Emails
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
 * @subpackage  	please
 * @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/please
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/please
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/please
 * @link			http://internetfounder.wordpress.com
 */

	include ('../../mainfile.php');
	
	if ($GLOBALS['xoopsModuleConfig']['htaccess']==true) {
		$url = XOOPS_URL.'/noticer/'.basename($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING'];
		if ($_SERVER['REQUEST_URI'].'?'.$_SERVER['QUERY_STRING']!=$url && strpos($_SERVER['REQUEST_URI'], 'odules/')>0) {
			header( "HTTP/1.1 301 Moved Permanently" ); 
			header('Location: '.$url);
			exit(0);
		}
	}

	xoops_load('XoopsCache');
	
	include('include/functions.php');	
	include('include/forms.php');
		
	switch ((string)$_REQUEST['op']) {
	default:
		$elements = array('message', 'signature', 'name', 'template', 'uid', 'results', 'language');
		foreach($elements as $items) {
			unset($_SESSION[$item]);
		}
		
	case "stepa":
		if (!isset($_GET['extra']) && $_SERVER["REQUEST_METHOD"]!='POST') {
			if ($_SERVER['REQUEST_URI']!=XOOPS_URL . '/noticer/stepa.html'){
				header( "HTTP/1.1 301 Moved Permanently" );
				header('Location: '.XOOPS_URL . '/noticer/stepa.html');
				exit(0);
			}
		}
		$msg = array();
		$elements = array('message', 'signature', 'name', 'template', 'uid', 'language');
		$pass = true;
		foreach($elements as $items)
			if (strlen(trim($_REQUEST[$items]))==0 && empty($_REQUEST[$items])) {
				$pass = false;
			} else {
				$msg[$items] = $_REQUEST[$items];
			}
		if ($pass == true) {
			XoopsCache::write('mailer_'.sha1($_SERVER['REMOTE_ADDR']), $msg, 60*60*24*7*4*9.78);
			unset($_SESSION['results']);
			header( "HTTP/1.1 301 Moved Permanently" );
			header('Location: '.XOOPS_URL . '/noticer/stepb.html');
			exit(0);
		}
		
		$xoopsOption['template_main'] = 'noticer_index.html';
		include $GLOBALS['xoops']->path('/header.php');								
		$xoTheme->addStylesheet(XOOPS_URL."/modules/noticer/language/".$GLOBALS['xoopsConfig']['language']."/noticer_style.css");
		$GLOBALS['xoopsTpl']->assign('paragraph', _MN_NOTICER_PARAGRAPH_STEPA);
		$GLOBALS['xoopsTpl']->assign('title', _MN_NOTICER_TITLE_STEPA);
		$GLOBALS['xoopsTpl']->assign('form', noticer_form_stepa());
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', _MN_NOTICER_TITLE_STEPA);			
		include $GLOBALS['xoops']->path('/footer.php');		
		exit(0);
		break;
		
	case "stepb":
		$msg = XoopsCache::read('mailer_'.sha1($_SERVER['REMOTE_ADDR']));
		$elements = array('message', 'signature', 'name', 'template', 'uid', 'language');
		$pass = true;
		foreach($elements as $items)
			if (trim($msg[$items])=='' && empty($msg[$items])) {
				echo $items;
				exit(0);
				$pass = false;
			}
		if ($pass == false) {
			header( "HTTP/1.1 301 Moved Permanently" );
			header('Location: '.XOOPS_URL . '/noticer/stepa.html');
			exit(0);
		}
		
		if (!isset($_GET['extra']) && $_SERVER["REQUEST_METHOD"]!='POST') {
			if ($_SERVER['REQUEST_URI']!=XOOPS_URL . '/noticer/stepb.html'){
				header( "HTTP/1.1 301 Moved Permanently" );
				header('Location: '.XOOPS_URL . '/noticer/stepb.html');
				exit(0);
			}
		}
		
		$emails = noticer_importFormEmails();
		if (count($emails)==0) {
			$xoopsOption['template_main'] = 'noticer_index.html';
			include $GLOBALS['xoops']->path('/header.php');								
			$xoTheme->addStylesheet(XOOPS_URL."/modules/noticer/language/".$GLOBALS['xoopsConfig']['language']."/noticer_style.css");
			$GLOBALS['xoopsTpl']->assign('paragraph', _MN_NOTICER_PARAGRAPH_STEPA);
			$GLOBALS['xoopsTpl']->assign('title', _MN_NOTICER_TITLE_STEPA);
			$GLOBALS['xoopsTpl']->assign('form', noticer_form_stepb());
			$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', _MN_NOTICER_TITLE_STEPB);			
			include $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		} else {
			$santize = array('message', 'signature');
			$sender_handler = xoops_getmodulehandler('sender', 'noticer');
			$email_handler = xoops_getmodulehandler('email', 'noticer');
			$sender = $sender_handler->create();
			foreach($elements as $items) {
				if (in_array($items, $santize)) {
					$myts = new MyTextSanitizer();
					$sender->setVar($items, $myts->displayTarea($msg[$items], true, true, true, true, true, true));
				} else {
					$sender->setVar($items, $msg[$items]);
				}
			}
			$sender->setVar('language', $GLOBALS['xoopsConfig']['language']);
			$sender->setVar('created', time());
			$sender = $sender_handler->get($sender_handler->insert($sender, true));
			$_SESSION['results'] = $email_handler->importEmails($sender, $emails);
			header( "HTTP/1.1 301 Moved Permanently" );
			header('Location: '.XOOPS_URL . '/noticer/results.html');
			exit(0);
		}
		break;
		
	case "results":
		
		if (!isset($_SESSION['results'])) {
			header( "HTTP/1.1 301 Moved Permanently" );
			header('Location: '.XOOPS_URL . '/noticer/stepa.html');
			exit(0);
		}
		
		if (!isset($_GET['extra'])) {
			if ($_SERVER['REQUEST_URI']!=XOOPS_URL . '/noticer/results.html'){
				header( "HTTP/1.1 301 Moved Permanently" );
				header('Location: '.XOOPS_URL . '/noticer/results.html');
				exit(0);
			}
		} 
		$xoopsOption['template_main'] = 'noticer_results.html';
		include $GLOBALS['xoops']->path('/header.php');								
		$xoTheme->addStylesheet(XOOPS_URL."/modules/noticer/language/".$GLOBALS['xoopsConfig']['language']."/noticer_style.css");
		$GLOBALS['xoopsTpl']->assign('paragraph', _MN_NOTICER_PARAGRAPH_RESULTS);
		$GLOBALS['xoopsTpl']->assign('title', _MN_NOTICER_TITLE_RESULTS);
		$GLOBALS['xoopsTpl']->assign('results', $_SESSION['results']);
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', _MN_NOTICER_TITLE_RESULTS);			
		include $GLOBALS['xoops']->path('/footer.php');		
		exit(0);
		break;
	}

?>