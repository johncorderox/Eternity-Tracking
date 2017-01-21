-- Create MySQL Database --

CREATE DATABASE tracking;

-- Create MySQL Table

CREATE TABLE IF NOT EXISTS `bugs` (

`id` int(11) NOT NULL AUTO_INCREMENT,
`time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`title` varchar(255) NOT NULL,
`message` varchar(255) NOT NULL,
`priority` int(11) NOT NULL,
PRIMARY KEY (`id`)

) ENGINE=MyISAM;
