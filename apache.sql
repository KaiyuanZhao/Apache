-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-07-14 04:49:04
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apache`
--

-- --------------------------------------------------------

--
-- 表的结构 `meal`
--

CREATE TABLE IF NOT EXISTS `meal` (
  `mealId` int(11) NOT NULL AUTO_INCREMENT,
  `mealName` varchar(40) NOT NULL,
  PRIMARY KEY (`mealId`),
  UNIQUE KEY `mealName` (`mealName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mealfavor`
--

CREATE TABLE IF NOT EXISTS `mealfavor` (
  `orderId` int(11) NOT NULL,
  `mealId` int(11) NOT NULL,
  PRIMARY KEY (`orderId`,`mealId`),
  KEY `foreign_favor_mealid` (`mealId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mealrecord`
--

CREATE TABLE IF NOT EXISTS `mealrecord` (
  `date` date NOT NULL,
  `mealId` int(11) NOT NULL,
  PRIMARY KEY (`date`,`mealId`),
  KEY `foreignMealRecord` (`mealId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `date` date NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderId`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `location` varchar(10) NOT NULL,
  `description` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 限制导出的表
--

--
-- 限制表 `mealfavor`
--
ALTER TABLE `mealfavor`
  ADD CONSTRAINT `foreign_favor_mealid` FOREIGN KEY (`mealId`) REFERENCES `meal` (`mealId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_favor_orderid` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `mealrecord`
--
ALTER TABLE `mealrecord`
  ADD CONSTRAINT `foreignMealRecord` FOREIGN KEY (`mealId`) REFERENCES `meal` (`mealId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `orderUser` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
