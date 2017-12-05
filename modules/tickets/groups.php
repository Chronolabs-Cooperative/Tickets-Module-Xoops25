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

    global $ticketsModule, $ticketsConfigsList, $ticketsConfigs, $ticketsConfigsOptions;

 	if(!defined('TICKETS_GROUP_CLIENT'))
 	    define('TICKETS_GROUP_CLIENT', $ticketsConfigs['client_group']);
    
    if(!defined('TICKETS_GROUP_TESTER'))
        define('TICKETS_GROUP_TESTER', $ticketsConfigs['tester_group']);
        
 	if(!defined('TICKETS_GROUP_STAFF'))
 	    define('TICKETS_GROUP_STAFF', $ticketsConfigs['staff_group']);
 		
 	if(!defined('TICKETS_GROUP_MANAGER'))
 	    define('TICKETS_GROUP_MANAGER', $ticketsConfigs['manager_group']); 
 
  	if(!defined('TICKETS_SALT'))
  	    define('TICKETS_SALT', $ticketsConfigs['salt']); 
 		
 	if(!defined('TICKETS_SALT_WHENSET'))
 		define('TICKETS_SALT_WHENSET', time()); 	
 				
 ?>