--
-- logs.sql

CREATE TABLE IF NOT EXISTS `login_log` (

`log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`account_id` int(11) unsigned,
`username` varchar(23) NOT NULL,
`error_message` varchar(100) NOT NULL default 'UNKNOWN',
`date` datetime NOT NULL,
`ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`log_id`)
);

CREATE TABLE IF NOT EXISTS `logs` (

`action_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`action` ENUM('A','D','AU','RU','CP','CE','RC','DA'),
`log_user` varchar(255) NOT NULL,
`action_value` varchar(255) NOT NULL,
`date` datetime NOT NULL,
`ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`action_id`)

);
