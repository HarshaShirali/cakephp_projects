-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2013 at 08:16 AM
-- Server version: 5.0.27
-- PHP Version: 5.1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `2013_01_lasllaves`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(8) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `idstate` int(8) NOT NULL default '0',
  `ord` int(8) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='2012/06/20 JPG' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `mobile` varchar(15) NOT NULL,
  `message` varchar(150) NOT NULL,
  `answer` varchar(150) NOT NULL,
  `posteddate` datetime NOT NULL,
  `valid` enum('Y','N') NOT NULL default 'N',
  `idnumber` int(11) NOT NULL default '0',
  `mobile2` varchar(15) default NULL,
  `name` varchar(150) default NULL,
  `last` varchar(150) default NULL,
  `receipt` varchar(150) default '0',
  `city` varchar(30) default NULL,
  `operator` varchar(15) NOT NULL default 'SMS',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='2013/01/07 JPG' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prizes`
--

CREATE TABLE IF NOT EXISTS `prizes` (
  `id` int(11) NOT NULL auto_increment,
  `idraffle` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='2012/09/25 JPG' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raffles`
--

CREATE TABLE IF NOT EXISTS `raffles` (
  `id` int(11) NOT NULL auto_increment,
  `raffledate` datetime NOT NULL,
  `locked` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='2012/09/25 JPG' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL auto_increment,
  `idmessage` int(11) NOT NULL,
  `idraffle` int(11) NOT NULL,
  `messageposteddate` datetime NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `idcard` int(11) default '0',
  `name` varchar(150) default NULL,
  `last` varchar(150) default NULL,
  `receipt` varchar(150) default '0',
  `prize` text NOT NULL,
  `mobile2` varchar(15) default NULL,
  `city` varchar(30) default NULL,
  `posteddate` datetime default NULL,
  `status` enum('pending','contacted','scheduled','rejected','backup') default 'pending',
  PRIMARY KEY  (`id`),
  KEY `idmessage` (`idmessage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='2012/09/28 JPG' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(8) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `ord` int(8) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='2012/06/20 JPG';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `role` enum('admin','stats','raffle','operator','contact') NOT NULL,
  `datecreated` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='2012/09/24 JPG' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE IF NOT EXISTS `winners` (
  `id` int(11) NOT NULL auto_increment,
  `idmessage` int(11) NOT NULL,
  `idraffle` int(11) NOT NULL,
  `messageposteddate` datetime NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `idcard` int(11) default '0',
  `name` varchar(150) default NULL,
  `last` varchar(150) default NULL,
  `receipt` varchar(150) default '0',
  `prize` text NOT NULL,
  `mobile2` varchar(15) default NULL,
  `city` varchar(30) default NULL,
  `posteddate` datetime default NULL,
  `status` enum('pending','contacted','scheduled','rejected','backup') default 'pending',
  `notes` varchar(250) default NULL,
  PRIMARY KEY  (`id`),
  KEY `idmessage` (`idmessage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='2012/09/28 JPG' AUTO_INCREMENT=1 ;
