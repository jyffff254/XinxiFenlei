=======================================================
   php基础示例-- PHP中的无线分类
=======================================================
实现目标： 实现无线分类的处理：分类信息的添加，查看

一、表结构的设计：
	
		mysql> create table type(
			-> id int unsigned not null auto_increment primary key,
			-> name varchar(64) not null,
			-> pid int unsigned not null,
			-> path varchar(128) not null);
		Query OK, 0 rows affected (0.08 sec)

		mysql> desc type;
		+-------+------------------+------+-----+---------+----------------+
		| Field | Type             | Null | Key | Default | Extra          |
		+-------+------------------+------+-----+---------+----------------+
		| id    | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
		| name  | varchar(64)      | NO   |     | NULL    |                |
		| pid   | int(10) unsigned | NO   |     | NULL    |                |
		| path  | varchar(128)     | NO   |     | NULL    |                |
		+-------+------------------+------+-----+---------+----------------+
		4 rows in set (0.00 sec)

		mysql> show create table type \G;
		*************************** 1. row ***************************
			   Table: type
		Create Table: CREATE TABLE `type` (
		  `id` int(10) unsigned NOT NULL auto_increment,
		  `name` varchar(64) NOT NULL,
		  `pid` int(10) unsigned NOT NULL,
		  `path` varchar(128) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8
		1 row in set (0.00 sec)

二、搭建项目结构
-----------------
	|--menu.php 	//导航栏界面
	|
	|--dbconfig.php //配置信息
	|
	|--add.php 		//添加分类信息
	|
	|--index.php 	//浏览分类信息
	| 	|--index2.php 	//分层浏览分类信息
	| 
	|--action.php	//执行添加和删除的操作
	|
	|--select.php 	//下拉列表方式浏览类别信息
	



















讲师：		张 涛
Email/QQ：	zhangtao@lampbrother.net

