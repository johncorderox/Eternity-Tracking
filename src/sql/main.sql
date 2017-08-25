--
-- Main.sql


CREATE TABLE IF NOT EXISTS `bugs` (

`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`message` varchar(255) NOT NULL,
`priority` varchar(255) NOT NULL default 'None',
`category` varchar(255) NOT NULL default 'Admin',
`status` varchar(20) NOT NULL default 'open',
`reported_by` varchar(255) NOT NULL,
`date` datetime NOT NULL,
PRIMARY KEY (`id`)

);

CREATE TABLE IF NOT EXISTS `deleted_bugs` (

  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
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

-- CREATES DEFAULT ACCOUNTS SO NEW USERS CAN LOG IN

-- ADMIN / GUEST
-- password is password for both accounts
INSERT INTO `users` (`account_id`, `username`, `password`, `email`, `account_count`, `last_ip`) VALUES
(NULL, 'admin', md5('password'), 'a@email.com', '0', '0');

INSERT INTO `users` (`account_id`, `username`, `password`, `email`, `account_count`, `last_ip`) VALUES
(NULL, 'guest', md5('password'), 'guest@email.com', '0', '0');


CREATE TABLE IF NOT EXISTS `users` (

`account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(23) NOT NULL,
`password` varchar(32) NOT NULL,
`email` varchar(50) NOT NULL,
`account_count` int(11) unsigned NOT NULL default '0',
`last_ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`account_id`)

);

CREATE TABLE IF NOT EXISTS `comments` (

`comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`bug_id`  int(11) unsigned NOT NULL,
`comment` varchar(255) NOT NULL,
`comment_by` varchar(23) NOT NULL,
`date` datetime NOT NULL,
`ip` varchar(100) NOT NULL default '0',
PRIMARY KEY (`comment_id`)

);
