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
 * @subpackage  	tickets
 * @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/tickets
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http://internetfounder.wordpress.com
 */


if (!defined(_MI_TICKETS_MODULE_DIRNAME))
	define('_MI_TICKETS_MODULE_DIRNAME', basename(dirname(__DIR__)));

/**
 * Include Required Main XOOPS File
 */
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "mainfile.php";

/**
 * Include Required Control Files
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";


/**
 * Include Required Language Files
 */
xoops_loadLanguage('errors', _MI_TICKETS_MODULE_DIRNAME);

/**
 * Instantiate Blowfish Encryption Salts
 */
if (!ticketsInstantiateBlowfish())
	die("Restricted Access ~ Encryption Salts missing or not loaded!");

/**
 * Sets Global Variables for Please
 */
global $ticketsModule, $ticketsConfig;

/**
 * Get Config Values for Please
 */
$module_handler = xoops_gethandler("module");
$config_handler = xoops_gethandler("config");
$ticketsModule = $module_handler->getByDirname(_MI_TICKETS_MODULE_DIRNAME);
if (is_a($ticketsModule, "XoopsModule"))
	$ticketsConfig = $config_handler->getConfigByList($ticketsModule->getVar('mid'));
else
	die("Xoops Email Ticketing Module: tickets ~ not found!");