-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2015 at 08:29 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uturn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_setting` int(11) NOT NULL,
  `picture` text COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_title`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `page_setting`, `picture`, `role`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Admin', 'sathish', 'UucVJFmw8uvw0iXPGFxqBU2eGvHkl1kv', '$2y$13$TBOPEO.q11sJdy3HfMtp/uuWNEt2E0jg7lYiybj/KlUt5pc8LRyUy', 'f4HuLXU4s4xGoP5qVNN4gbrAJ-JtdHAt_1429272879', 'sathish.kumar1@mail.vinove.com', 10, '1430313159_1713347.1430313159_.png', 10, 10, 1415339487, 1430313159),
(6, 'Super Admin', 'uturn', 'UucVJFmw8uvw0iXPGFxqBU2eGvHkl1kv', '$2y$13$qOuWIf8n0YMw3uu3LqEOtOOUfIAF2MdBRWhqeDzPR8n7pre1ZZc22', NULL, 'deepak.kumar2@mail.vinove.com', 10, '1425946382_Chrysanthemum.1425946382_.jpg', 10, 10, 0, 1425946382),
(7, 'admin', 'subadminji', 'wiaAY_Q0L3kQYHfUbdSVcX1fLTncclE4', '$2y$13$UyCVnvU/hn6JEZk8EEc8OeYHfeCbNoa6zMqdAVzPh3mRPpFPHkGMW', NULL, 'subadmin@mail.vinove.com', 0, '', 10, 1, 1425038482, 1425038758),
(9, 'CSC - Inquiry Rep', 'CSC1', 'CqrWy3XttedFMmjFOtRdWL9Ca7y4susF', '$2y$13$HhczaQVAvQHn5JOMqorTKuI48ATDQi5W/FdhNXdjqwas9Gyw5mDSG', NULL, 'frose@bluesky.as', 0, '', 10, 1, 1428358638, 1428460863),
(10, 'CSC - Call Center', 'CSC2', 'rV8LLDNfjIRKvd2Vzxc2DMcNZEwKcN9n', '$2y$13$hFO3k6CMOOeZCmUBii93vON7f2nBtQJFNxJ//Nj/ky5jxh7.YjXh.', NULL, 'fay.office@gmail.com', 0, '', 0, 1, 1428461275, 1428546067);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `pkBankID` int(3) NOT NULL AUTO_INCREMENT,
  `bankName` varchar(250) NOT NULL,
  `bankAdded` datetime NOT NULL,
  `bankUpdate` datetime NOT NULL,
  PRIMARY KEY (`pkBankID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `pkChannelID` int(7) NOT NULL AUTO_INCREMENT,
  `fkPartnerID` int(7) NOT NULL,
  `youtubeChannelID` varchar(250) NOT NULL,
  `channelName` varchar(250) NOT NULL,
  `fkChannelCategoryID` int(3) NOT NULL,
  `channelStatus` enum('0','1') NOT NULL COMMENT '0 => "Inactive" 1 => "Active"',
  `channelAddDate` datetime NOT NULL,
  `channelUpdateDate` datetime NOT NULL,
  PRIMARY KEY (`pkChannelID`),
  KEY `fkPartnerID` (`fkPartnerID`),
  KEY `channelCategory` (`fkChannelCategoryID`),
  KEY `fkCategoryID` (`fkChannelCategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `channel_category`
--

CREATE TABLE IF NOT EXISTS `channel_category` (
  `pkChannelCategoryID` int(3) NOT NULL AUTO_INCREMENT,
  `channelCategoryName` varchar(250) NOT NULL,
  `channelUsed` enum('0','1') NOT NULL COMMENT '0 => "Not Used" 1 => "Used"',
  `channelAddedDate` datetime NOT NULL,
  `channelUpdateDate` datetime NOT NULL,
  PRIMARY KEY (`pkChannelCategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `pkCityID` int(11) NOT NULL AUTO_INCREMENT,
  `cityName` varchar(255) NOT NULL,
  `fkStateID` int(11) NOT NULL,
  `cityStatus` enum('0','1') NOT NULL,
  `cityDateAdded` datetime NOT NULL,
  `cityDateModified` datetime NOT NULL,
  PRIMARY KEY (`pkCityID`),
  KEY `fkStateID` (`fkStateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`pkCityID`, `cityName`, `fkStateID`, `cityStatus`, `cityDateAdded`, `cityDateModified`) VALUES
(1, 'Dehradun', 2, '1', '0000-00-00 00:00:00', '2014-10-08 18:37:16'),
(2, 'Kotdwara', 2, '1', '0000-00-00 00:00:00', '2014-10-08 17:47:39'),
(3, 'Meerut', 3, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Saharanpur', 3, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Chapra', 4, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Texta', 5, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Teadh', 5, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `pkContactID` int(11) NOT NULL AUTO_INCREMENT,
  `fkPartnerID` int(11) NOT NULL,
  `contactSubject` varchar(250) NOT NULL,
  `contactMessage` longtext NOT NULL,
  `contactMessageTo` enum('A','P') NOT NULL COMMENT 'A => "Admin" P => "Partner"',
  `contactMessageIsNew` enum('0','1') NOT NULL COMMENT '0 => "Old" 1 => "New"',
  `contactDate` datetime NOT NULL,
  PRIMARY KEY (`pkContactID`),
  KEY `fkPartnerID` (`fkPartnerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `pkCountryID` int(11) NOT NULL AUTO_INCREMENT,
  `countryName` varchar(255) NOT NULL,
  `countryStatus` enum('0','1','2') NOT NULL COMMENT '0=>Inactive,1=>active,2=>deleted',
  `countryDateAdded` datetime NOT NULL,
  `countryDateModified` datetime NOT NULL,
  PRIMARY KEY (`pkCountryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`pkCountryID`, `countryName`, `countryStatus`, `countryDateAdded`, `countryDateModified`) VALUES
(1, 'India', '1', '0000-00-00 00:00:00', '2014-10-08 14:53:05'),
(2, 'America', '1', '0000-00-00 00:00:00', '2014-10-08 14:53:05'),
(3, 'Nepal', '1', '0000-00-00 00:00:00', '2014-10-08 14:53:05'),
(4, 'Japan', '1', '0000-00-00 00:00:00', '2014-10-08 14:53:05'),
(5, 'trrwere', '1', '0000-00-00 00:00:00', '2014-10-08 15:04:14'),
(6, 'ggggg', '1', '0000-00-00 00:00:00', '2014-10-08 15:06:29'),
(7, 'India2', '1', '0000-00-00 00:00:00', '2014-10-08 16:17:02'),
(8, 'India1', '1', '0000-00-00 00:00:00', '2014-10-08 16:18:43'),
(9, 'America1', '1', '0000-00-00 00:00:00', '2014-10-08 16:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `pkEmailID` int(11) NOT NULL AUTO_INCREMENT,
  `emailTitle` varchar(55) NOT NULL,
  `emailFromName` varchar(25) NOT NULL,
  `emailFromEmail` varchar(55) NOT NULL,
  `emailSubject` varchar(55) NOT NULL,
  `emailContent` longtext NOT NULL,
  `emailTemplateType` enum('G','C') NOT NULL COMMENT 'G => General C => Contract',
  `emailTemplateIsUsed` enum('0','1') NOT NULL COMMENT '0 => Not in Use 1 => In Use',
  `emailDateAdded` datetime NOT NULL,
  `emailDateUpdated` datetime NOT NULL,
  PRIMARY KEY (`pkEmailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`pkEmailID`, `emailTitle`, `emailFromName`, `emailFromEmail`, `emailSubject`, `emailContent`, `emailTemplateType`, `emailTemplateIsUsed`, `emailDateAdded`, `emailDateUpdated`) VALUES
(1, 'Account Activation sathish', 'Admin', 'admin@uturn.com', 'Account Activation from Uturn', '<p>Dear {to_name},<br /> To activating your account please click on the below link.<br /> <a href="{account_activation_link}" target="_blank">{account_activation_link}</a><br /> <br /> Regards</p>\r\n<p>Uturn</p>', 'C', '1', '2015-01-22 15:16:48', '2015-04-23 13:34:49'),
(2, 'Welcome to Uturn', 'Uturn', 'admin@uturn.com', 'Welcome to Uturn', '<p>\n	Dear {to_name},<br />\n	Your account has been activated successfully.<br />\n	Website Link: <a href="{site_url}">{site_url}</a><br />\n	<br />\n	Regards<br />\n	Uturn</p>\n', 'C', '1', '2015-01-22 15:16:06', '2015-04-23 15:21:35'),
(3, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:06'),
(4, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:20'),
(5, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:27'),
(6, 'test-sathish', 'testasfafa', 'test@mail.com', 'test', '<p>Dear {to_name},<br /> Your account has been activated successfully.<br /> Website Link: <a href="{site_url}">{site_url}</a><br /> <br /> Regards<br /> Uturn</p>', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 16:55:29'),
(7, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:38'),
(8, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:42'),
(9, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:47'),
(10, 'test', 'test', 'test@mail.com', 'test', '<p>\r\n	Dear {to_name},<br />\r\n	Your account has been activated successfully.<br />\r\n	Website Link: <a href="{site_url}">{site_url}</a><br />\r\n	<br />\r\n	Regards<br />\r\n	Uturn</p>\r\n', 'G', '0', '2015-04-23 00:00:00', '2015-04-23 15:22:52'),
(12, 'test templateadf', 'adsfkjadfj', 'adsjadfanf@gmicla.com', 'afkasfjkadfi', '<p>afkafaadfsaf</p>', 'G', '0', '2015-04-23 18:14:06', '2015-04-23 18:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `pkForumID` int(10) NOT NULL AUTO_INCREMENT,
  `forumTitle` varchar(55) NOT NULL,
  `fkForumCategoryID` int(3) NOT NULL,
  `forumDescription` longtext NOT NULL,
  `forumYoutubeLink` varchar(70) NOT NULL,
  `forumStatus` enum('0','1') NOT NULL COMMENT '0 => "Inactive" 1 => "Active"',
  `forumHasComment` enum('0','1') NOT NULL COMMENT '0 => "False" 1 => "True"',
  `forumAddedDate` datetime NOT NULL,
  `forumUpdateDate` datetime NOT NULL,
  PRIMARY KEY (`pkForumID`),
  KEY `fkForumCategoryID` (`fkForumCategoryID`),
  KEY `fkForumCategoryID_2` (`fkForumCategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `pkForumCategoryID` int(3) NOT NULL AUTO_INCREMENT,
  `forumCategoryName` varchar(20) NOT NULL,
  `forumCategoryIsUsed` enum('0','1') NOT NULL COMMENT '0 => "Not Used" 1 => "Used"',
  `forumCategoryAdded` datetime NOT NULL,
  `forumCategoryUpdate` datetime NOT NULL,
  PRIMARY KEY (`pkForumCategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
  `pkForumCommentID` int(10) NOT NULL AUTO_INCREMENT,
  `fkForumID` int(10) NOT NULL,
  `forumComment` longtext NOT NULL,
  `forumCommentAdded` datetime NOT NULL,
  PRIMARY KEY (`pkForumCommentID`),
  KEY `fkForumID` (`fkForumID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `pkNewsletterID` int(7) NOT NULL AUTO_INCREMENT,
  `newsletterTitle` varchar(55) NOT NULL,
  `newsletterContent` longtext NOT NULL,
  `newsletterToAll` enum('0','1') NOT NULL COMMENT '0 => "False" 1 => "True"',
  `newsletterStatus` enum('0','1','2') NOT NULL COMMENT '0 => "Inactive" 1 => "Active" 3 => "Delivered"',
  `newsletterScheduleDelivery` datetime NOT NULL,
  `newsletterAdded` datetime NOT NULL,
  PRIMARY KEY (`pkNewsletterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_schedule_partners`
--

CREATE TABLE IF NOT EXISTS `newsletter_schedule_partners` (
  `newsletterScheduleID` int(10) NOT NULL AUTO_INCREMENT,
  `fkNewsletterID` int(10) NOT NULL,
  `fkPartnerID` int(10) NOT NULL,
  PRIMARY KEY (`newsletterScheduleID`),
  KEY `fkNewsletterID` (`fkNewsletterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `pkPartnerID` int(7) NOT NULL AUTO_INCREMENT,
  `partnerEmail` varchar(50) NOT NULL,
  `auth_key` varchar(250) NOT NULL,
  `password_hash` varchar(250) NOT NULL,
  `password_reset_token` varchar(250) NOT NULL,
  `partnerFirstName` varchar(30) NOT NULL,
  `partnerLastName` varchar(30) NOT NULL,
  `fkChannelID` int(10) NOT NULL,
  `partnershipLevel` enum('0','1','2') NOT NULL COMMENT '0 => "Affiliation" 1=> "Premium"  2 => "Premium + "',
  `partnerMobile` int(15) NOT NULL,
  `partnerDateOfBirth` datetime NOT NULL,
  `fkCityID` int(7) NOT NULL,
  `fkCountryID` int(3) NOT NULL,
  `partnerFirstLogin` enum('0','1') NOT NULL COMMENT '0 => "False" 1 => "True"',
  `partnerProfilePicture` varchar(150) NOT NULL,
  `partnerKnowHow` enum('0','1') NOT NULL COMMENT '0 => "Internet" 1=> "Peers"',
  `partnerStatus` enum('0','1') NOT NULL COMMENT '0 => "Inactive" 1 => "Active"',
  `partnerContractSigned` enum('0','1') NOT NULL COMMENT '0 => "False" 1 => "True"',
  `fkBankID` int(3) NOT NULL,
  `partnerNameInBank` varchar(55) NOT NULL,
  `partnerBankAccNo` int(18) NOT NULL,
  `partnerSubscribeNewsletter` enum('0','1') NOT NULL COMMENT '0 => "No" 1 => "Yes"',
  `partnerAddedDate` datetime NOT NULL,
  `partnerUpdateDate` datetime NOT NULL,
  PRIMARY KEY (`pkPartnerID`),
  UNIQUE KEY `fkChannelID` (`fkChannelID`),
  KEY `fkChannelID_2` (`fkChannelID`),
  KEY `fkBankID` (`fkBankID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `pkStateID` int(7) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(55) NOT NULL,
  `fkCountryID` int(3) NOT NULL,
  `stateStatus` enum('0','1','2') NOT NULL COMMENT '0=>Inactive, 1=>Active,2=>Deleted',
  `stateDateAdded` datetime NOT NULL,
  `stateDateModified` datetime NOT NULL,
  PRIMARY KEY (`pkStateID`),
  KEY `fkCountryID` (`fkCountryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`pkStateID`, `stateName`, `fkCountryID`, `stateStatus`, `stateDateAdded`, `stateDateModified`) VALUES
(2, 'Uttarakhand', 1, '1', '0000-00-00 00:00:00', '2014-10-08 17:16:02'),
(3, 'Uttar Pradesh', 1, '1', '0000-00-00 00:00:00', '2014-10-08 17:29:37'),
(4, 'Bihar', 1, '0', '0000-00-00 00:00:00', '2014-10-08 17:31:07'),
(5, 'Washington', 2, '1', '0000-00-00 00:00:00', '2014-10-08 18:14:28');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_2` FOREIGN KEY (`fkChannelCategoryID`) REFERENCES `channel_category` (`pkChannelCategoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`fkPartnerID`) REFERENCES `partners` (`pkPartnerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`fkStateID`) REFERENCES `state` (`pkStateID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`fkPartnerID`) REFERENCES `partners` (`pkPartnerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`fkForumCategoryID`) REFERENCES `forum_categories` (`pkForumCategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD CONSTRAINT `forum_comments_ibfk_1` FOREIGN KEY (`fkForumID`) REFERENCES `forum` (`pkForumID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `newsletter_schedule_partners`
--
ALTER TABLE `newsletter_schedule_partners`
  ADD CONSTRAINT `newsletter_schedule_partners_ibfk_1` FOREIGN KEY (`fkNewsletterID`) REFERENCES `newsletter` (`pkNewsletterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `partners_ibfk_2` FOREIGN KEY (`fkBankID`) REFERENCES `bank` (`pkBankID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partners_ibfk_3` FOREIGN KEY (`fkChannelID`) REFERENCES `channel` (`pkChannelID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`fkCountryID`) REFERENCES `country` (`pkCountryID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
