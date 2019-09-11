create database test;

use test;

CREATE TABLE `Product` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` int(15) NOT NULL,
  `quantity` int(4) NOT NULL,
  PRIMARY KEY  (`id`)
);