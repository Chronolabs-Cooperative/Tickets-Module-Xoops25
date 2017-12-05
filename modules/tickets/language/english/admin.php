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
* @subpackage  	language
* @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
* @version		1.0.5
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/please
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/please
* @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/please
* @link			http://internetfounder.wordpress.com
*/


define('_AM_PLEASE_ADMIN_FOOTER','');
define('_AM_PLEASE_ADMIN_DONATE','');
define('_AM_PLEASE_ADMIN_LIMIT_ITEMS', 25);
define('_AM_PLEASE_ADMIN_PAGENAV_OFFSET', 5);

// Department Admin Add Form
define('_AM_PLEASE_ADDFORM_DEPARTMENT_CODE_TITLE','TLA Code');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_CODE_DESC','This is the code that prefixes tickets for this department.');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_NAME_TITLE','Department Name');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_NAME_DESC','This is the name of the department');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_DESCRIPTION_TITLE','Department Description');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_DESCRIPTION_DESC','This is the description of the department');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTIS_TITLE','Support MantisBT');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTIS_DESC','Allow for MantisBT Escalation');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTISURI_TITLE','URL for MantisBT');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTISURI_DESC','');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTISUSERNAME_TITLE','Username for MantisBT');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTISUSERNAME_DESC','Departmental Username for API on MantisBT');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTISPASSWORD_TITLE','Password for MantisBT');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANTISPASSWORD_DESC','Departmental Password for API on MantisBT');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_SIGNATURE_TITLE','Departmental Signature');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_SIGNATURE_DESC','Included in signature below staff signature for department (Max 300 chars)');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANAGERNAME_TITLE','Manager of Departments Name');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANAGERNAME_DESC','');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANAGEREMAIL_TITLE','Manager of Departments eMail');
define('_AM_PLEASE_ADDFORM_DEPARTMENT_MANAGEREMAIL_DESC','This process will get the manager to create a username and will be associated with the appropriate groups and allow them to add their ticketing staff!');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_ADDFORM_TITLE','Add & Create Department + Grouping');


// Department Admin Edit Form
define('_AM_PLEASE_EDITFORM_DEPARTMENT_CODE_TITLE','TLA Code');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_CODE_DESC','This is the code that prefixes tickets for this department.');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_NAME_TITLE','Department Name');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_NAME_DESC','This is the name of the department');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_DESCRIPTION_TITLE','Department Description');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_DESCRIPTION_DESC','This is the description of the department');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTIS_TITLE','Support MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTIS_DESC','Allow for MantisBT Escalation');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTISURI_TITLE','URL for MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTISURI_DESC','');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTISUSERNAME_TITLE','Username for MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTISUSERNAME_DESC','Departmental Username for API on MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTISPASSWORD_TITLE','Password for MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANTISPASSWORD_DESC','Departmental Password for API on MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_SIGNATURE_TITLE','Departmental Signature');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_SIGNATURE_DESC','Included in signature below staff signature for department (Max 300 chars)');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERUID_TITLE','Manager of Departments User');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERUID_DESC','');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERBCC_TITLE','Manager is BCC all staff correspondence');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERBCC_DESC','');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERMANTISUSERNAME_TITLE','Managers Username for MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERMANTISUSERNAME_DESC','Departmental Managers Username for API on MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERMANTISPASSWORD_TITLE','Managers Password for MantisBT');
define('_AM_PLEASE_EDITFORM_DEPARTMENT_MANAGERMANTISPASSWORD_DESC','Departmental Managers Password for API on MantisBT');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_EDITFORM_TITLE','Edit & Change a Department');


// Department Admin Drill Down List
define('_AM_PLEASE_ADMIN_DEPARTMENTS_ADDFORM_TITLE','Add & Create Department + Grouping!');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_ADD','Add Department');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_EDIT','Edit department "%s"!');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_ID','Identity');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_CODE','Code');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_NAME','Name');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_MANTIS','MantisBT');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_TICKETS','Total Tickets');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_STAFF','Active Staff');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_CLIENTS','Total Clients');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_RAISED','Escalations');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_LATEST','Latest Ticket');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_CLOSED','Closed Ticket');
define('_AM_PLEASE_ADMIN_DEPARTMENTS_ACTIONS','&nbsp;');