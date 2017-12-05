<?php
/**
 * Tickets Email Ticketer of Batch Group & User Emails
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
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets
* @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/tickets
* @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
* @link			http://internetfounder.wordpress.com
*/

// Module Group Definitions
define('_MI_TICKETS_GROUP_TYPE_CLIENT','tickets-client');
define('_MI_TICKETS_GROUP_NAME_CLIENT','Tickets Ticket Client');
define('_MI_TICKETS_GROUP_DESC_CLIENT','This group is for anyone generating a ticket in tickets that needs a username!');
define('_MI_TICKETS_GROUP_TYPE_STAFF','tickets-staff');
define('_MI_TICKETS_GROUP_NAME_STAFF','Tickets Ticketer Staff');
define('_MI_TICKETS_GROUP_DESC_STAFF','This group is for anyone responding to email tickets in tickets that needs a username!');
define('_MI_TICKETS_GROUP_TYPE_MANAGER','tickets-manage');
define('_MI_TICKETS_GROUP_NAME_MANAGER','Tickets Staff Manager');
define('_MI_TICKETS_GROUP_DESC_MANAGER','This group is for anyone managing staff responding to a ticket in tickets that needs a username!');
define('_MI_TICKETS_GROUP_TYPE_DEPARTMENT','tickets-depart');
define('_MI_TICKETS_GROUP_NAME_DEPARTMENT','%s');
define('_MI_TICKETS_GROUP_DESC_DEPARTMENT','%s');


// Module Admin Menu
define('_MI_TICKETS_ADMINMENU_HOME','Tickets Home');
define('_MI_TICKETS_ADMINMENU_DEPARTMENTS','Ticketing Departments');
define('_MI_TICKETS_ADMINMENU_MAILBOXES', 'Source Inboxes');
define('_MI_TICKETS_ADMINMENU_ESCALATION','Ticketing Escalation');
define('_MI_TICKETS_ADMINMENU_USERS','Department Users');
define('_MI_TICKETS_ADMINMENU_FILES','Files');
define('_MI_TICKETS_ADMINMENU_MIMETYPES','Mimetypes');
define('_MI_TICKETS_ADMINMENU_TICKETS','Tickets');
define('_MI_TICKETS_ADMINMENU_KEYWQRDS','Keywords');
define('_MI_TICKETS_ADMINMENU_REPORTS','Reports');
define('_MI_TICKETS_ADMINMENU_PERMISSIONS','Permissions');
define('_MI_TICKETS_ADMINMENU_ABOUT','Email Ticketer About');

// Module definition headers for xoops_version.php
define('_MI_TICKETS_MODULE_NAME','Bug Tickets!');
define('_MI_TICKETS_MODULE_VERSION','1.05');
define('_MI_TICKETS_MODULE_RELEASEDATE','');
define('_MI_TICKETS_MODULE_STATUS','beta');
define('_MI_TICKETS_MODULE_DESCRIPTION','Is for email ticketing and harvesting for departmental escalation and sorting based in keywords, include spam detection!');
define('_MI_TICKETS_MODULE_CREDITS','Mynamesnot, Wishcraft');
define('_MI_TICKETS_MODULE_AUTHORALIAS','wishcraft');
define('_MI_TICKETS_MODULE_HELP','page=help');
define('_MI_TICKETS_MODULE_LICENCE','gpl3+academic');
define('_MI_TICKETS_MODULE_OFFICAL','0');
define('_MI_TICKETS_MODULE_ICON','images/modicon.png');
define('_MI_TICKETS_MODULE_WEBSITE','http://au.syd.labs.coop');
define('_MI_TICKETS_MODULE_ADMINMODDIR','/Frameworks/moduleclasses/moduleadmin');
define('_MI_TICKETS_MODULE_ADMINICON16','../../Frameworks/moduleclasses/icons/16');
define('_MI_TICKETS_MODULE_ADMINICON32','./../Frameworks/moduleclasses/icons/32');
define('_MI_TICKETS_MODULE_RELEASEINFO',__DIR__ . DIRECTORY_SEPARATOR . 'release.nfo');
define('_MI_TICKETS_MODULE_RELEASEXCODE',__DIR__ . DIRECTORY_SEPARATOR . 'release.xcode');
define('_MI_TICKETS_MODULE_RELEASEFILE','https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets/xoops2.5_TICKETS_1.05.7z');
define('_MI_TICKETS_MODULE_AUTHORREALNAME','Simon Antony Roberts');
define('_MI_TICKETS_MODULE_AUTHORWEBSITE','http://internetfounder.wordpress.com');
define('_MI_TICKETS_MODULE_AUTHORSITENAME','Exhumations from the desks of Chronographics');
define('_MI_TICKETS_MODULE_AUTHOREMAIL','simon@staff.labs.coop');
define('_MI_TICKETS_MODULE_AUTHORWORD','');
define('_MI_TICKETS_MODULE_WARNINGS','');
define('_MI_TICKETS_MODULE_DEMO_SITEURL','');
define('_MI_TICKETS_MODULE_DEMO_SITENAME','');
define('_MI_TICKETS_MODULE_SUPPORT_SITEURL','');
define('_MI_TICKETS_MODULE_SUPPORT_SITENAME','');
define('_MI_TICKETS_MODULE_SUPPORT_FEATUREREQUEST','');
define('_MI_TICKETS_MODULE_SUPPORT_BUGREPORTING','');
define('_MI_TICKETS_MODULE_DEVELOPERS','Simon Roberts (Wishcraft)'); // Sperated by a Pipe (|)
define('_MI_TICKETS_MODULE_TESTERS',''); // Sperated by a Pipe (|)
define('_MI_TICKETS_MODULE_TRANSLATERS',''); // Sperated by a Pipe (|)
define('_MI_TICKETS_MODULE_DOCUMENTERS',''); // Sperated by a Pipe (|)
define('_MI_TICKETS_MODULE_HASSEARCH',true);
define('_MI_TICKETS_MODULE_HASMAIN',true);
define('_MI_TICKETS_MODULE_HASADMIN',true);
define('_MI_TICKETS_MODULE_HASCOMMENTS',true);

// Configguration Categories
define('_MI_TICKETS_CONFCAT_SEO','Search Engine Optimization');
define('_MI_TICKETS_CONFCAT_SEO_DESC','');
define('_MI_TICKETS_CONFCAT_EMAIL','Email Settings for Ticketing');
define('_MI_TICKETS_CONFCAT_EMAIL_DESC','');
define('_MI_TICKETS_CONFCAT_SYSTEMS','Tickets Email Ticketer System Settings');
define('_MI_TICKETS_CONFCAT_SYSTEMS_DESC','');
define('_MI_TICKETS_CONFCAT_REPORTS','Tickets System Reports Settings');
define('_MI_TICKETS_CONFCAT_REPORTS_DESC','');
define('_MI_TICKETS_CONFCAT_SPAM','Spam Checking Settings');
define('_MI_TICKETS_CONFCAT_SPAM_DESC','');

// Configurations for Spam Checking
define('_MI_TICKETS_SPAM','Enable Spam Checking');
define('_MI_TICKETS_SPAM_DESC','This enables spam checking for the module in handling emails');
define('_MI_TICKETS_SPAM_KEYWORDS','Check Spam Keywords');
define('_MI_TICKETS_SPAM_KEYWORDS_DESC','This enables basic keyword matching to flag spam!');
define('_MI_TICKETS_SPAM_ADDRESSES','Check Spam Email Addresses');
define('_MI_TICKETS_SPAM_ADDRESSES_DESC','This flags any spam on a high lighted email address that is a spam source!');
define('_MI_TICKETS_WAMMY','Enable Wammy Spam Checking');
define('_MI_TICKETS_WAMMY_DESC','This turns on the use of wammy api (Download from: <a target="_blank" href="https://sourceforge.net/projects/chronolabsapis/files/wammy.labs.coop/">sourceforge.net</a>) for the spam checking api source-code!');
define('_MI_TICKETS_WAMMY_URI','Wammy API URL/URI');
define('_MI_TICKETS_WAMMY_URI_DESC','This is the public access or intranet access wammy api url for spam checking you have established!');
define('_MI_TICKETS_WAMMY_TRAIN','Enable Training for Wammy!');
define('_MI_TICKETS_WAMMY_TRAIN_DESC','Enable all training options for staff and department to flag and train entry items as spam!');
define('_MI_TICKETS_SPAM_PASSWAY','Enable Passway for Spam');
define('_MI_TICKETS_SPAM_PASSWAY_DESC','This will send a notice that contains a code to enter for the message to be unflaged as spam');
define('_MI_TICKETS_SPAM_NOTIFY','Enable Spam Notices');
define('_MI_TICKETS_SPAM_NOTIFY_DESC','This will enable notices to people that messages/emails get flagged as spam!');

// Search Engine Optimisation (SEO)
define('_MI_TICKETS_HTACCESS','Enable .htaccess SEO');
define('_MI_TICKETS_HTACCESS_DESC','This enables SEO access');
define('_MI_TICKETS_BASE','SEO Base Path');
define('_MI_TICKETS_BASE_DESC','This is the base path used in SEO');
define('_MI_TICKETS_HTML','HTML Output extension');
define('_MI_TICKETS_HTML_DESC','This is the extension given to HTML output');
define('_MI_TICKETS_RSS','RSS Output extension');
define('_MI_TICKETS_RSS_DESC','This is the extension given to RSS (xml) output');

// Email Ticketer settings and configurations
define('_MI_TICKETS_DEFAULT_REPLYTO','Default Tickets Reply To');
define('_MI_TICKETS_DEFAULT_REPLYTO_DESC','This is the default email address replies are written from!');
define('_MI_TICKETS_DEFAULT_REPLYIMAP','Default Tickets Reply To IMAP Service');
define('_MI_TICKETS_DEFAULT_REPLYIAMP_DESC','This is the default imap service address replies are written from!');
define('_MI_TICKETS_DEFAULT_REPLYSMTP','Default Tickets Reply To SMTP Service');
define('_MI_TICKETS_DEFAULT_REPLYSMTP_DESC','This is the default smtp service address replies are written from!');
define('_MI_TICKETS_DEFAULT_REPLYUSERNAME','Default Tickets Reply To Username');
define('_MI_TICKETS_DEFAULT_REPLYUSERNAME_DESC','This is the default email username for IMAP/SMTP Services for the address replies are written from!');
define('_MI_TICKETS_DEFAULT_REPLYPASSWORD','Default Tickets Reply To Password');
define('_MI_TICKETS_DEFAULT_REPLYPASSWORD_DESC','This is the default password for IMAP/SMTP Services for the address replies are written from!');
define('_MI_TICKETS_ATTACHMENT_STORAGE','File attachments are stored where by default');
define('_MI_TICKETS_ATTACHMENT_STORAGE_DESC','This is the path the file attachments are stored on from emails');
define('_MI_TICKETS_IMAGE_STORAGE','Images in emails are stored when retreived by default');
define('_MI_TICKETS_IMAGE_STORAGE_DESC','This is the pathe mail images are stored!');

// System Settings and Cnfigurations 
define('_MI_TICKETS_SALT','Blowfish Salt');
define('_MI_TICKETS_SALT_DESC','This is the encryption blowfish salt, you will have to use the same salt with any restored backup!');
define('_MI_TICKETS_TICKETERS','Enable Ticketed Responses');
define('_MI_TICKETS_TICKETERS_DESC','This will notify the emailer of the ticket number assigned and acknowledge recieving the email!');
define('_MI_TICKETS_DEPARTMENT_GROUPS','Default all Department Groups');
define('_MI_TICKETS_DEPARTMENT_GROUPS_DESC','These are the default groups to use as a department when and if you are making new XOOPS Groups for each department!');
define('_MI_TICKETS_DEPARTMENT_NEWGROUP','New Group when Creating a Department');
define('_MI_TICKETS_DEPARTMENT_NEWGROUP_DESC','This will create a new group for each department in the ticketing system and use the one selected immediately above as default permissions!');
define('_MI_TICKETS_CLIENT_GROUP','Default Client Grouping');
define('_MI_TICKETS_CLIENT_GROUP_DESC','This group is the default group users are added to when they are signed up as staff');
define('_MI_TICKETS_TESTER_GROUP','Default Tester Grouping');
define('_MI_TICKETS_TESTER_GROUP_DESC','This group is the default group users are added to when they are signed up as staff');
define('_MI_TICKETS_STAFF_GROUP','Default Staff Grouping');
define('_MI_TICKETS_STAFF_GROUP_DESC','This group is the default group users are added to when they are signed up as staff');
define('_MI_TICKETS_MANAGER_GROUP','Default Staff Manager Grouping');
define('_MI_TICKETS_MANAGER_GROUP_DESC','This group is the default group users are added to when they are signed up as manager of staff and departments!');
define('_MI_TICKETS_ACCESS_GROUPS','These are the groups allow access to this module');
define('_MI_TICKETS_ACCESS_GROUPS_DESC','This is the general default setting to what has access in this module');
define('_MI_TICKETS_ACCESS_STAFF_GROUPS','Staff Access Group');
define('_MI_TICKETS_ACCESS_STAFF_GROUPS_DESC','This is the user group used for staff access!');
define('_MI_TICKETS_ACCESS_MANAGER_GROUP','Manager Access Group');
define('_MI_TICKETS_ACCESS_MANAGER_GROUP_DESC','This is the user group for the departmental manager for the group of staff!');
define('_MI_TICKETS_MANTIS','Support Software Bug Escalation to Mantis');
define('_MI_TICKETS_MANTIS_DESC','Support Escalation to developer in the mantisBT (Mantis Bug Tracking) API');
define('_MI_TICKETS_MANTIS_GROUPS','Groups allowed to escalate to mantis');
define('_MI_TICKETS_MANTIS_GROUPS_DESC','This is the groups that support escalation to software developers in mantis bug tracker!');
define('_MI_TICKETS_MANAGER','Allow escalation of tickets to a manager');
define('_MI_TICKETS_MANAGER_DESC','This allows for tickets to be escalated to a manager in the department before any other escalation');
define('_MI_TICKETS_MANAGER_GROUPS','XOOPS User Groups for Managers');
define('_MI_TICKETS_MANAGER_GROUPS_DESC','This is the groups for managers to belong in as a default for a template to add new managers to when creating them!');
define('_MI_TICKETS_REPORTEE','Do Reporting');
define('_MI_TICKETS_REPORTEE_DESC','Enabled the development of statistics and reports!');
define('_MI_TICKETS_REPORTINGONHOUR','When on the hour the report runs');
define('_MI_TICKETS_REPORTINGONHOUR_DESC','in 0 - 23 (24hr) specify the hour you want the reports to run and delivery of them done soon afterwards');
define('_MI_TICKETS_REPORTEE_GROUPS','Report Access Groups');
define('_MI_TICKETS_REPORTEE_GROUPS_DESC','This is the XOOPS User Access Group that can access extensive reports!');
define('_MI_TICKETS_REPORTEE_ONLY','Report on these user groups');
define('_MI_TICKETS_REPORTEE_ONLY_DESC','This is the XOOPS User Access Groups that are reported on in the reports!');
define('_MI_TICKETS_CRON_METHOD','Cron/Scheduled Task Method');
define('_MI_TICKETS_CRON_METHOD_DESC','This is the type of execution the cronjobs/scheduled tasks are using');
define('_MI_TICKETS_CRON_METHOD_PRELOADS_DESC','XOOPS Preloads');
define('_MI_TICKETS_CRON_METHOD_PRELOADS','preloads');
define('_MI_TICKETS_CRON_METHOD_CRONTAB_DESC','Linux Crontab');
define('_MI_TICKETS_CRON_METHOD_CRONTAB','crontab');
define('_MI_TICKETS_CRON_METHOD_SCHEDULETASK_DESC','Windows Schedule Tasks');
define('_MI_TICKETS_CRON_METHOD_SCHEDULETASK','schedtask');
define('_MI_TICKETS_REPORTS_SCHEDULING','Reporting Period Schedule');
define('_MI_TICKETS_REPORTS_SCHEDULING_DESC','This is the type or period the reports are prepared over for the general information report based in departmental swing!');
define('_MI_TICKETS_REPORTS_STAFF_SCHEDULING','Staff Reporting Period Schedule');
define('_MI_TICKETS_REPORTS_STAFF_SCHEDULING_DESC','This is the type or period of the staff reports that are prepared for the manager and staff members!');
define('_MI_TICKETS_REPORTS_DEPARTMENT_SCHEDULING','Department Reportinh Period Schedule');
define('_MI_TICKETS_REPORTS_DEPARTMENT_SCHEDULING_DESC','This is the type or period of the staff in a departments as well as all the managers on the system members!');
define('_MI_TICKETS_REPORT_SCHEDULE_TOP20_DESC','Top 20 Listings');
define('_MI_TICKETS_REPORT_TOP20_INSTANCE','top20');
define('_MI_TICKETS_REPORT_SCHEDULE_HIGHLIGHTS_DESC','Reported Highlights');
define('_MI_TICKETS_REPORT_HIGHLIGHTS_INSTANCE','highlights');
define('_MI_TICKETS_REPORT_SCHEDULE_INSTANCE_DESC','Open Instances Report');
define('_MI_TICKETS_REPORT_SCHEDULE_INSTANCE','instance');
define('_MI_TICKETS_REPORT_SCHEDULE_DAILY_DESC','Daily Statistics Report');
define('_MI_TICKETS_SCHEDULE_DAILY','daily');
define('_MI_TICKETS_REPORT_SCHEDULE_WEEKLY_DESC','Weekly Statistics Report');
define('_MI_TICKETS_SCHEDULE_WEEKLY','weekly');
define('_MI_TICKETS_REPORT_SCHEDULE_FORTNIGHTLY_DESC','Fortnightly Statistics Report');
define('_MI_TICKETS_SCHEDULE_FORTNIGHTLY','2weeks');
define('_MI_TICKETS_REPORT_SCHEDULE_MONTHLY_DESC','Monthly Statistics Report');
define('_MI_TICKETS_SCHEDULE_MONTHLY','monthly');
define('_MI_TICKETS_REPORT_SCHEDULE_QUARTERLY_DESC','Quarterly Statistics Report');
define('_MI_TICKETS_SCHEDULE_QUARTERLY','quarterly');
define('_MI_TICKETS_REPORT_SCHEDULE_ANNUALLY_DESC','Yearly Statistics Report');
define('_MI_TICKETS_SCHEDULE_ANNUALLY','yearly');
