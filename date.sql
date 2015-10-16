drop database if exists `info`;

create database `info`;

use `info`;

drop table if exists `article`;

create table `article`(
	`id` int(11) not null auto_increment,
	`title` char(100) not null,
	`author` char(50) not null,
	`description` varchar(300) not null,
	`content` text not null,
	`dateline` int(11) not null default 0,
	primary key(`id`)
)engine=InnoDB default charset=utf8;
