-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-05-23 12:51:58
-- 服务器版本： 5.7.26
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `gzh`
--

-- --------------------------------------------------------

--
-- 表的结构 `booklist`
--

CREATE TABLE `booklist` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `des` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` decimal(10,0) NOT NULL,
  `cid` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `booklist`
--

INSERT INTO `booklist` (`id`, `name`, `des`, `price`, `stock`, `cid`, `filename`) VALUES
(1, '细说php', 'glf', '150.00', '100', 2, '18d7bf12c8fcc3cef2aadbb39c45d688d53f200a.jpg'),
(2, '1', '1', '1.00', '1', 1, '24330cd162d9f2d31b7d4e85beec8a136227ccb7.jpg'),
(3, '1', '1', '1.00', '1', 1, '6b5c053b5bb5c9eac7262546db39b60038f3b381.jpg'),
(4, '1', '1', '1.00', '1', 1, 'pre_ecdcb651f81986180614bbee5ded2e738ad4e654.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `catelist`
--

CREATE TABLE `catelist` (
  `id` int(11) NOT NULL,
  `catename` varchar(30) NOT NULL,
  `pid` decimal(10,0) NOT NULL,
  `oid` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `catelist`
--

INSERT INTO `catelist` (`id`, `catename`, `pid`, `oid`) VALUES
(1, 'java', '0', '0'),
(2, 'php', '0', '0');

--
-- 转储表的索引
--

--
-- 表的索引 `booklist`
--
ALTER TABLE `booklist`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `catelist`
--
ALTER TABLE `catelist`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `booklist`
--
ALTER TABLE `booklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `catelist`
--
ALTER TABLE `catelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
