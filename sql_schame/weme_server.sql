-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 09 月 08 日 19:46
-- 服务器版本: 5.5.9
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `weme_server`
--

-- --------------------------------------------------------

--
-- 表的结构 `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ci_sessions`
--

INSERT INTO `ci_sessions` VALUES('c74bdc4f0387fc9f675ea3944922804f', '192.168.11.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.220 Safari/535.1', 1315480847, '');

-- --------------------------------------------------------

--
-- 表的结构 `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `login_attempts`
--


-- --------------------------------------------------------

--
-- 表的结构 `ordertest`
--

CREATE TABLE `ordertest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `cname` varchar(200) NOT NULL,
  `clevel` int(11) NOT NULL,
  `corder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `ordertest`
--


-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` VALUES(1, 4, 0x613a333a7b733a333a22757269223b613a343a7b693a303b733a32353a222f636f6e74726f6c6c65722f6261636b656e642f7573657273223b693a313b733a32323a222f636f6e74726f6c6c65722f617574682f6c6f67696e223b693a323b733a32333a222f636f6e74726f6c6c65722f617574682f6c6f676f7574223b693a333b733a32353a222f636f6e74726f6c6c65722f617574682f7265676973746572223b7d733a343a2265646974223b733a313a2231223b733a363a2264656c657465223b733a303a22223b7d);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` VALUES(1, 0, 'Admin');
INSERT INTO `roles` VALUES(4, 0, 'User');
INSERT INTO `roles` VALUES(5, 4, 'writer');

-- --------------------------------------------------------

--
-- 表的结构 `sources`
--

CREATE TABLE `sources` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cat_id` mediumint(8) unsigned NOT NULL,
  `brief` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `short_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源列表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sources`
--


-- --------------------------------------------------------

--
-- 表的结构 `source_category`
--

CREATE TABLE `source_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `sort_order` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='源分类' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `source_category`
--

INSERT INTO `source_category` VALUES(1, 0, '推荐阅读', '', 1, 0);
INSERT INTO `source_category` VALUES(2, 0, '杂志', '', 1, 0);
INSERT INTO `source_category` VALUES(3, 0, '资讯', '', 1, 0);
INSERT INTO `source_category` VALUES(4, 5, '腾讯微博', '腾讯微博', 2, 0);
INSERT INTO `source_category` VALUES(5, 0, '微博客', '', 1, 0);
INSERT INTO `source_category` VALUES(6, 4, '腾讯薇薇', '官方客服', 3, 0);
INSERT INTO `source_category` VALUES(7, 2, '译本杂志', 'dddddd', 2, 0);
INSERT INTO `source_category` VALUES(8, 2, 'zaker杂志', '', 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` VALUES(5, 1, 'weme', '$P$BGxMtl5AiBJRC02xwgFpW0jU.ojVA10', 'thinktube@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.11.10', '2011-09-08 10:49:17', '2011-09-05 17:45:39', '2011-09-08 10:49:17');
INSERT INTO `users` VALUES(6, 4, 'mactive', '$P$BdFimGYuaV7J174rvzy5JuD7m55Vvz0', 'mactive@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.11.10', '2011-09-08 09:33:52', '2011-09-06 11:54:29', '2011-09-08 09:33:52');
INSERT INTO `users` VALUES(7, NULL, 'sure', '$P$BNU/sy/C5FsSglGqPE4gWnL7Ud/rup1', 'bidangran@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '192.168.11.6', '2011-09-07 18:14:52', '2011-09-07 18:14:36', '2011-09-07 18:14:52');

-- --------------------------------------------------------

--
-- 表的结构 `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user_autologin`
--

INSERT INTO `user_autologin` VALUES('22ea2630af5b94d0affb19e132dcce32', 7, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.220 Safari/535.1', '192.168.11.6', '2011-09-07 18:14:52');

-- --------------------------------------------------------

--
-- 表的结构 `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `user_profiles`
--

INSERT INTO `user_profiles` VALUES(1, 2, NULL, NULL);
INSERT INTO `user_profiles` VALUES(2, 3, NULL, NULL);
INSERT INTO `user_profiles` VALUES(3, 4, NULL, NULL);
INSERT INTO `user_profiles` VALUES(4, 5, NULL, NULL);
INSERT INTO `user_profiles` VALUES(5, 6, NULL, NULL);
INSERT INTO `user_profiles` VALUES(6, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_temp`
--

CREATE TABLE `user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(34) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activation_key` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_temp`
--

