-- Create MySQL Database --

CREATE DATABASE tracking;

-- Create MySQL Table

CREATE TABLE IF NOT EXISTS `bugs` (

`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`message` varchar(255) NOT NULL,
`priority` varchar(255) NOT NULL,
`reported_by` varchar(3) NOT NULL,
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
