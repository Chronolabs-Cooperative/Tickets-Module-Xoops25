
CREATE TABLE `tickets_addresses` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(198) DEFAULT '',
  `uid` int(11) DEFAULT '0',
  `recieved` int(12) DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `tickets` int(12) DEFAULT '0',
  `ticket-id` mediumint(30) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `action` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`address`(18),`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_bcc` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `address-id` int(14) unsigned DEFAULT '0',
  `name-id` int(14) unsigned DEFAULT '0',
  `email-id` mediumint(30) unsigned DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`address-id`,`name-id`,`email-id`,`ticket-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_cc` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `address-id` int(14) unsigned DEFAULT '0',
  `name-id` int(14) unsigned DEFAULT '0',
  `email-id` mediumint(30) unsigned DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`address-id`,`name-id`,`email-id`,`ticket-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_contents` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(44) DEFAULT '',
  `text` longtext,
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`key`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_correspondences` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `method` enum('email','pm','staff','mantis','unknown') DEFAULT 'unknown',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(6) unsigned DEFAULT '0',
  `staff-id` mediumint(18) unsigned DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_correspondences_bcc` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `bcc-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(6) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` mediumint(18) unsigned DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `viewed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_correspondences_cc` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `cc-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(6) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` mediumint(18) unsigned DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `viewed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_correspondences_contents` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `correspondence-id` mediumint(38) unsigned DEFAULT '0',
  `ticket-contents-id` mediumint(30) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` mediumint(18) unsigned DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_correspondences_relayed` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `relayed-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(6) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` mediumint(18) unsigned DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `viewed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_correspondences_to` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `to-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(6) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` mediumint(18) unsigned DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `viewed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_departments` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(4) unsigned NOT NULL DEFAULT '1',
  `code` varchar(3) NOT NULL DEFAULT 'ABC',
  `name` varchar(128) NOT NULL DEFAULT '',
  `description` tinytext,
  `mantis-uri` varchar(350) DEFAULT '',
  `mantis-username` varchar(45) DEFAULT '',
  `mantis-password` varchar(198) DEFAULT '',
  `mantis-project-id` int(11) unsigned DEFAULT '0',
  `manager-uid` int(11) DEFAULT '0',
  `manager-bcc` enum('all-email','closed-email','all-pm','closed-pm','none') DEFAULT 'none',
  `manager-mantis-username` varchar(45) DEFAULT '',
  `manager-mantis-password` varchar(198) DEFAULT '',
  `mantis` enum('yes','no') DEFAULT 'no',
  `gid` int(8) DEFAULT '0',
  `tickets` int(12) DEFAULT '0',
  `staff` int(12) DEFAULT '0',
  `clients` int(12) DEFAULT '0',
  `raised` int(12) DEFAULT '0',
  `latest-id` mediumint(30) unsigned DEFAULT '0',
  `closed-id` mediumint(30) unsigned DEFAULT '0',
  `signature` tinytext,
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_departments_escalations` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `mode` enum('direct','skipping','mantis','default') DEFAULT 'default',
  `department-id` int(6) unsigned NOT NULL DEFAULT '0',
  `escalation-id` int(6) unsigned NOT NULL DEFAULT '0',
  `weight` int(8) unsigned NOT NULL DEFAULT '1',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`mode`,`escalation-id`,`department-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_departments_keywords` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `department-id` int(6) unsigned DEFAULT '0',
  `keyword-id` int(20) unsigned NOT NULL DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`keyword-id`,`department-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_departments_staff` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `department-id` int(6) DEFAULT '0',
  `state` enum('active','inactive','holidays') DEFAULT 'active',
  `messaging` enum('email','pm','none') DEFAULT 'email',
  `uid` int(12) DEFAULT '0',
  `open` int(12) DEFAULT '0',
  `tickets` int(12) DEFAULT '0',
  `closed` int(12) DEFAULT '0',
  `clients` int(12) DEFAULT '0',
  `raised` int(12) DEFAULT '0',
  `votes` int(12) DEFAULT '0',
  `rating` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `mantis-username` varchar(45) DEFAULT '',
  `mantis-password` varchar(198) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`department-id`,`state`,`uid`,`open`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_departments_staff_keywords` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `department-id` int(6) unsigned DEFAULT '0',
  `staff-id` int(18) unsigned NOT NULL,
  `keyword-id` int(20) unsigned NOT NULL,
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`keyword-id`,`staff-id`,`department-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_departments_staff_mantis_tickets` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` int(12) unsigned DEFAULT '0',
  `ticket-subject-id` mediumint(30) unsigned DEFAULT '0',
  `follow-up` int(12) DEFAULT '0',
  `closed` int(12) DEFAULT '0',
  `raised` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_emails` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `from-id` int(14) unsigned DEFAULT '0',
  `recieved` enum('html','text') DEFAULT 'html',
  `sending` enum('html','text') DEFAULT 'html',
  `subject-id` mediumint(30) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `content-key` varchar(44) DEFAULT '',
  `attachments` int(6) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`content-key`(20),`from-id`,`subject-id`,`ticket-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_emails_files` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `email-id` mediumint(30) unsigned DEFAULT '0',
  `file-id` mediumint(30) unsigned DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_files` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `storage` enum('PLEASE_DATA_PATH','PLEASE_UPLOAD_PATH') DEFAULT 'PLEASE_DATA_PATH',
  `mimetype-id` mediumint(30) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(30) DEFAULT '',
  `filename` varchar(255) DEFAULT '',
  `path` varchar(255) DEFAULT '',
  `md5` varchar(32) DEFAULT '',
  `bytes` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `deleted` int(12) DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`md5`(13),`filename`,`extension`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_images` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `storage` enum('PLEASE_DATA_PATH','PLEASE_UPLOAD_PATH') DEFAULT 'PLEASE_UPLOAD_PATH',
  `mimetype-id` mediumint(30) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(30) DEFAULT '',
  `filename` varchar(255) DEFAULT '',
  `path` varchar(255) DEFAULT '',
  `md5` varchar(32) DEFAULT '',
  `bytes` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `deleted` int(12) DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`md5`(13),`filename`,`extension`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_keywords` (
  `id` mediumint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state` enum('actionable','historical') DEFAULT 'actionable',
  `keyword` varchar(64) DEFAULT '',
  `occurences` mediumint(30) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`keyword`(43),`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_mailboxs` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `host` varchar(300) DEFAULT '',
  `username` varchar(198) DEFAULT '',
  `password` varchar(198) DEFAULT '',
  `port` int(8) DEFAULT '993',
  `reply-email` varchar(300) DEFAULT '',
  `folders` MEDIUMTEXT,
  `ssl` enum('Yes','No') DEFAULT 'Yes',
  `method` enum('IMAP','API') DEFAULT 'IMAP',
  `attachments` enum('Yes','No') DEFAULT 'Yes',
  `signature` enum('Both','Staff','Manager','Department','None') DEFAULT 'Both',
  `ticket` enum('Yes','No') DEFAULT 'Yes',
  `reply` enum('Yes','No') DEFAULT 'Yes',
  `collect` enum('Yes','No') DEFAULT 'Yes',
  `images` enum('Yes','No') DEFAULT 'Yes',
  `wammy` enum('Yes','No') DEFAULT 'Yes',
  `wammy-uri` varchar(300) DEFAULT 'http://wammy.labs.coop',
  `wammy-auto-high` int(12) DEFAULT '0',
  `wammy-auto-low` int(12) DEFAULT '0',
  `wammy-auto-spams` int(12) DEFAULT '0',
  `wammy-auto-hams` int(12) DEFAULT '0',
  `wammy-moderated-high` int(12) DEFAULT '0',
  `wammy-moderated-low` int(12) DEFAULT '0',
  `wammy-moderated-spams` int(12) DEFAULT '0',
  `wammy-moderated-hams` int(12) DEFAULT '0',
  `uids` TINYTEXT,
  `department-ids` TINYTEXT,
  `messages` int(12) DEFAULT '0',
  `tickets` int(12) DEFAULT '0',
  `errors` int(12) DEFAULT '0',
  `keywords` int(12) DEFAULT '0',
  `last-ticket-id` mediumint(30) DEFAULT '0',
  `waiting` int(12) DEFAULT '540',
  `created` int(12) DEFAULT '0',
  `errored` int(12) DEFAULT '0',
  `action` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`errored`,`action`,`waiting`,`uids`(18),`department-ids`(18))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_messages` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `typal` enum('ndn','inbound','outbound','spam','unknown') DEFAULT 'unknown',
  `email-id` mediumint(30) unsigned DEFAULT '0',
  `subject-id` mediumint(30) unsigned DEFAULT '0',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `mailbox-id` mediumint(30) unsigned DEFAULT '0',
  `message-id` varchar(64) DEFAULT '',
  `from-id` mediumint(30) unsigned DEFAULT '0',
  `spam-email` enum('Yes','No') DEFAULT 'No',
  `spam-checking` enum('enabled','disabled') DEFAULT 'disabled',
  `spam-training` enum('used','ignored') DEFAULT 'ignored',
  `wammy-typal` enum('ham','spam','unknown') DEFAULT 'unknown',
  `wammy-high` int(10) unsigned DEFAULT '0',
  `wammy-low` int(10) unsigned DEFAULT '0',
  `words` int(10) unsigned DEFAULT '0',
  `files` int(10) unsigned DEFAULT '0',
  `when` int(12) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`email-id`,`subject-id`,`ticket-id`,`mailbox-id`,`message-id`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_messages_cc` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `message-id` mediumint(30) unsigned DEFAULT '0',
  `cc-id` mediumint(30) unsigned DEFAULT '0',
  `name-id` mediumint(30) unsigned DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `viewed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`message-id`,`cc-id`,`name-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_messages_files` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `message-id` mediumint(30) unsigned DEFAULT '0',
  `file-id` mediumint(30) unsigned DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_messages_to` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `message-id` mediumint(30) unsigned DEFAULT '0',
  `to-id` mediumint(30) unsigned DEFAULT '0',
  `name-id` mediumint(30) unsigned DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `viewed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`to-id`,`message-id`,`name-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_mimetypes` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `mimetype` varchar(255) DEFAULT '.',
  `mode` varchar(26) DEFAULT 'unknown',
  `extensions` tinytext,
  `files-embedded` int(12) unsigned DEFAULT '0',
  `files-attachment` int(12) unsigned DEFAULT '0',
  `files-sent` int(12) unsigned DEFAULT '0',
  `bytes-embedded` mediumint(32) unsigned DEFAULT '0',
  `bytes-attachment` mediumint(32) unsigned DEFAULT '0',
  `bytes-sent` mediumint(32) unsigned DEFAULT '0',
  `created` int(12) unsigned DEFAULT '0',
  `deleted` int(12) DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`mimetype`,`accessed`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_names` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(198) DEFAULT '',
  `uid` int(11) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`name`(18),`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_phones` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `mode` enum('personal','business','client','departmental','unknown') DEFAULT 'unknown',
  `typal` enum('mobile','landline','switch','call-center','unknown') DEFAULT 'unknown',
  `country` int(8) unsigned NOT NULL DEFAULT '0',
  `area` int(8) unsigned NOT NULL DEFAULT '0',
  `local` int(22) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `department-id` mediumint(30) unsigned NOT NULL DEFAULT '0',
  `staff-id` mediumint(30) DEFAULT '0',
  `name-id` mediumint(30) DEFAULT '0',
  `address-id` mediumint(30) DEFAULT '0',
  `ticket-id` mediumint(30) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`staff-id`,`department-id`,`created`,`local`,`area`,`country`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_projects` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `mode` enum('core','module','theme','plugin','unknown') DEFAULT 'unknown',
  `name` varchar(128) NOT NULL DEFAULT '',
  `description` tinytext,
  `logo` varchar(255) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `version-ids` mediumtext,
  `department-ids` mediumtext,
  `tester-ids` mediumtext,
  `staff-ids` mediumtext,
  `created` int(12) DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`mode`,`name`,`created`,`desciption`,`logo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_relayed` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` int(18) unsigned DEFAULT '0',
  `department-id` int(6) unsigned DEFAULT '0',
  `mantis-node-key` varchar(44) DEFAULT '',
  `mantis-ticket-id` int(14) DEFAULT '0',
  `mantis-project-id` int(14) DEFAULT '0',
  `mantis-assigned-to` varchar(64) DEFAULT '',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`ticket-id`,`staff-id`,`department-id`,`mantis-node-key`(16),`mantis-ticket-id`,`mantis-project-id`,`mantis-assigned-to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_spam_addresses` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `address-id` mediumint(30) unsigned DEFAULT '0',
  `recieved` int(12) DEFAULT '0',
  `last` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_spam_keywords` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `keyword-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(30) unsigned DEFAULT '0',
  `recieved` int(12) DEFAULT '0',
  `last` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_subjects` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(300) DEFAULT '',
  `email-id` int(30) unsigned DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`subject`(30),`email-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `project-id` int(14) unsigned NOT NULL DEFAULT '0',
  `version-id` int(14) unsigned NOT NULL DEFAULT '0',
  `state` enum('new','waiting','resonded','mantis','ignored','spam','allocated','claimed') NOT NULL DEFAULT 'new',
  `mode` enum('Open','Closed','Cancelled') NOT NULL DEFAULT 'Open',
  `ticket-key` varchar(20) DEFAULT 'XXX-0000000XAA',
  `subject-id` mediumint(30) unsigned DEFAULT '0',
  `from-id` int(14) unsigned DEFAULT '0',
  `from-uid` int(11) unsigned DEFAULT '0',
  `belong-uid` int(11) DEFAULT '0',
  `belong-gid` int(11) DEFAULT '0',
  `tags` varchar(255) DEFAULT NULL,
  `created` int(12) DEFAULT '0',
  `responded` int(12) DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `closed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`ticket-key`(15),`state`,`subject-id`,`belong-uid`,`belong-gid`,`from-id`,`from-uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_attachments` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `typal` enum('from','sent','mantis') DEFAULT 'from',
  `state` enum('available','offline-copied','offline-ftp','offline-deleted') DEFAULT 'available',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `ticket-contents-id` mediumint(30) unsigned DEFAULT '0',
  `file-id` mediumint(30) unsigned DEFAULT '0',
  `when` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`ticket-id`,`ticket-contents-id`,`state`,`typal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_contents` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `state` enum('from','sent','mantis') DEFAULT 'from',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `content-key` varchar(44) DEFAULT '',
  `by-id` int(11) DEFAULT '0',
  `by-uid` int(11) DEFAULT '0',
  `when` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`ticket-id`,`content-key`(24),`state`,`by-id`,`by-uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_departments` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(30) unsigned DEFAULT '0',
  `weight` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`department-id`,`ticket-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_files` (
  `id` mediumint(38) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `file-id` mediumint(30) unsigned DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_keywords` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `keyword-id` int(20) unsigned NOT NULL,
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`keyword-id`,`ticket-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_ownership` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `state` enum('new','waiting','resonded','mantis','ignored','spam','allocated','claimed') DEFAULT 'new',
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` int(18) unsigned DEFAULT '0',
  `department-id` int(6) unsigned DEFAULT '0',
  `when` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`ticket-id`,`state`,`staff-id`,`department-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_tickets_referees` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `mode` enum('Open','Closed','Cancelled') NOT NULL DEFAULT 'Open',
  `ticket-id` mediumint(30) unsigned NOT NULL DEFAULT '0',
  `department-id` mediumint(30) unsigned NOT NULL DEFAULT '0',
  `referee` varchar(30) NOT NULL DEFAULT '',
  `relayed` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`department-id`,`ticket-id`,`referee`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_to` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticket-id` mediumint(30) unsigned DEFAULT '0',
  `address-id` int(14) unsigned DEFAULT '0',
  `name-id` int(14) unsigned DEFAULT '0',
  `email-id` mediumint(30) unsigned DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`address-id`,`name-id`,`email-id`,`ticket-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tickets_versions` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `project-id` int(14) unsigned NOT NULL DEFAULT '0', 
  `major` int(4) unsigned NOT NULL DEFAULT '1',
  `minor` int(4) unsigned NOT NULL DEFAULT '1',
  `revision` int(4) unsigned NOT NULL DEFAULT '1',
  `subrevision` int(4) unsigned NOT NULL DEFAULT '1',
  `description` tinytext,
  `download-url` varchar(255) NOT NULL DEFAULT '',
  `svn-url` varchar(255) NOT NULL DEFAULT '',
  `git-url` varchar(255) NOT NULL DEFAULT '',
  `news-url` varchar(255) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `department-ids` mediumtext,
  `tester-ids` mediumtext,
  `staff-ids` mediumtext,
  `created` int(12) DEFAULT '0',
  `accessed` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`major`,`minor`,`revision`,`subrevision`,`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tickets_wiki` (
  `id` mediumint(30) unsigned NOT NULL AUTO_INCREMENT,
  `state` enum('public','staff','historical') DEFAULT 'public',
  `department-id` int(6) unsigned DEFAULT '0',
  `key` varchar(44) DEFAULT '',
  `subject` varchar(190) DEFAULT NULL,
  `description` varchar(350) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `problems` longtext,
  `solution` longtext,
  `created` int(12) DEFAULT '0',
  `approved` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`key`(20),`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_wiki_keywords` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `wiki-id` mediumint(30) unsigned DEFAULT '0',
  `keyword-id` int(20) unsigned NOT NULL,
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`keyword-id`,`wiki-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tickets_wiki_staff` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `wiki-id` mediumint(30) unsigned DEFAULT '0',
  `department-id` mediumint(30) unsigned DEFAULT '0',
  `staff-id` mediumint(30) unsigned DEFAULT '0',
  `weight` int(12) DEFAULT '0',
  `created` int(12) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`department-id`,`staff-id`,`wiki-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;