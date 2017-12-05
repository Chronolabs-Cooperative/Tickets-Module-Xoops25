<?php
/**
 * tickets Email Ticketer of Batch Group & User Emails
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
	
	include_once (dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'mainfile.php');

	ini_set('display_errors', true);
	ini_set('log_errors', true);
	error_reporting(E_ERROR);
	
	if (!defined('_MI_TICKETS_MODULE_DIRNAME'))
		define('_MI_TICKETS_MODULE_DIRNAME', basename(__DIR__));
	if (!defined('TICKETS_UPLOAD_PATH'))
		define('TICKETS_UPLOAD_PATH', XOOPS_ROOT_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . basename(__DIR__));
	if (!defined('TICKETS_DATA_PATH'))
		define('TICKETS_DATA_PATH', XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__));
	if (!defined('TICKETS_UPLOAD_URL'))
		define('TICKETS_UPLOAD_URL', XOOPS_URL . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . basename(__DIR__));
	if (!defined('TICKETS_DATA_URL'))
		define('TICKETS_DATA_URL', XOOPS_URL . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . basename(__DIR__) . DIRECTORY_SEPARATOR . 'data' );
	if (!is_dir(TICKETS_UPLOAD_PATH))
		mkdir(TICKETS_UPLOAD_PATH, 0777, true);
	if (!is_dir(TICKETS_DATA_PATH))
		mkdirSecure(TICKETS_DATA_PATH, 0777, true);
	
	xoops_loadLanguage('modinfo', _MI_TICKETS_MODULE_DIRNAME);
	xoops_loadLanguage('errors', _MI_TICKETS_MODULE_DIRNAME);
	global $ticketsModule, $ticketsConfigsList, $ticketsConfigs, $ticketsConfigsOptions;
	
	if (empty($ticketsModule))
	{
	    if (is_a($ticketsModule = xoops_gethandler('module')->getByDirname(_MI_TICKETS_MODULE_DIRNAME), "XoopsModule"))
	    {
	        if (empty($ticketsConfigsList))
	        {
	            $ticketsConfigsList = xoops_gethandler('config')->getConfigList($ticketsModule->getVar('mid'));
	        }
	        if (empty($ticketsConfigs))
	        {
	            $ticketsConfigs = xoops_gethandler('config')->getConfigs(new Criteria('conf_modid', $ticketsModule->getVar('mid')));
	        }
	        if (empty($ticketsConfigsOptions) && !empty($ticketsConfigs))
	        {
	            foreach($ticketsConfigs as $key => $config)
	                $ticketsConfigsOptions[$config->getVar('conf_name')] = xoops_gethandler('config')->getConfigOptions(new Criteria('conf_id', $config->getVar('conf_id')));
	        }
	    }
	}

	include_once (__DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'functions.php');

?>