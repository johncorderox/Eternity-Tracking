-- Create MySQL Database --

CREATE DATABASE tracking;

-- Create MySQL Table

CREATE TABLE IF NOT EXISTS `bugs` (

`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`message` varchar(255) NOT NULL,
`priority` varchar(255) NOT NULL default 'None',
`category` varchar(255) NOT NULL default 'Admin',
`reported_by` varchar(255) NOT NULL,
`date` datetime NOT NULL,
PRIMARY KEY (`id`)

);

CREATE TABLE IF NOT EXISTS `deleted_bugs` (

  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `delete_date` datetime NOT NULL,
  `deleted_by` varchar(23) NOT NULL,
  PRIMARY KEY (`id`)

);

CREATE TABLE IF NOT EXISTS `deleted_users` (

  `account_id` int(11) unsigned NOT NULL,
  `username` varchar(23) NOT NULL,
  `deleted_reason` varchar(50) NOT NULL,
  `deleted_by` varchar(23) NOT NULL,
  PRIMARY KEY (`account_id`)

);


CREATE TABLE IF NOT EXISTS `users` (

`account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(23) NOT NULL,
`password` varchar(32) NOT NULL,
`email` varchar(50) NOT NULL,
`account_count` int(11) unsigned NOT NULL default '0',
`last_ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`account_id`)

);

CREATE TABLE IF NOT EXISTS `login_log` (

`account_id` int(11) unsigned,
`username` varchar(23) NOT NULL,
`error_message` varchar(100) NOT NULL default 'UNKNOWN',
`date` datetime NOT NULL,
`ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`account_id`)
);

CREATE TABLE IF NOT EXISTS `logs` (

`action_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(23) NOT NULL,
`action` ENUM('A','D','AU','RU','CP','CE','RC','DA'),
`date` datetime NOT NULL,
`ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`action_id`)

);

-- CREATES DEFAULT ACCOUNT SO NEW USERS CAN LOG IN

-- ADMIN / GUEST
-- password is password for both accounts
INSERT INTO `users` (`account_id`, `username`, `password`, `email`, `account_count`, `last_ip`) VALUES (NULL, 'admin', md5('password'), 'admin@eternitytracking.com', '0', '0');
