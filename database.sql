-- Create MySQL Database --

CREATE DATABASE tracking;

-- Create MySQL Table

CREATE TABLE IF NOT EXISTS `bugs` (

`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`message` varchar(255) NOT NULL,
`priority` varchar(255) NOT NULL,
PRIMARY KEY (`id`)

);


CREATE TABLE IF NOT EXISTS `users` (

`account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(23) NOT NULL,
`password` varchar(32) NOT NULL,
`email` varchar(50) NOT NULL,
`account_count` int(11) unsigned NOT NULL AUTO_INCREMENT,
PRIMARY KEY (`account_id`)

);
