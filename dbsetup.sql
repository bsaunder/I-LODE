# phpMyAdmin MySQL-Dump
# version 2.5.1
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Jan 30, 2005 at 02:41 PM
# Server version: 3.23.58
# PHP Version: 4.3.6
# Database : `ilo2ga`
# --------------------------------------------------------

#
# Table structure for table `admins`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 24, 2005 at 06:05 PM
#

CREATE TABLE `admins` (
  `id` int(11) NOT NULL auto_increment,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL default '0',
  `lastlogin` timestamp(14) NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM COMMENT='Student User Information' AUTO_INCREMENT=1 ;

INSERT INTO `admins` (`id` ,`fname`,`lname`,`email`,`password`,`level`,`lastlogin`) VALUES ('','Bryan','Saunders','btsaunde','merlin18','1',NOW( ));
# --------------------------------------------------------

#
# Table structure for table `alt_answerChoices`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Dec 15, 2004 at 02:41 PM
#

CREATE TABLE `alt_answerChoices` (
  `id` int(11) NOT NULL auto_increment,
  `questionid` int(11) NOT NULL default '0',
  `value` text NOT NULL,
  `text` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Possible Choices for Slide Questions' AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table `alt_questions`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Dec 15, 2004 at 02:41 PM
#

CREATE TABLE `alt_questions` (
  `id` int(11) NOT NULL auto_increment,
  `objectid` int(11) NOT NULL default '0',
  `slideid` int(11) NOT NULL default '0',
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `type` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Question Information For the Indiviual Slides' AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table `alt_text`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 24, 2005 at 06:05 PM
#

CREATE TABLE `alt_text` (
  `id` int(11) NOT NULL auto_increment,
  `objectid` int(11) NOT NULL default '0',
  `slide` int(11) NOT NULL default '0',
  `text` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Text Information For Indiviual Object Slides' AUTO_INCREMENT=3 ;
# --------------------------------------------------------

#
# Table structure for table `announcments`
#
# Creation: Jan 24, 2005 at 06:06 PM
# Last update: Jan 24, 2005 at 06:06 PM
#

CREATE TABLE `announcments` (
  `id` int(11) NOT NULL auto_increment,
  `date` text NOT NULL,
  `text` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table `answerChoices`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 24, 2005 at 06:31 PM
#

CREATE TABLE `answerChoices` (
  `id` int(11) NOT NULL auto_increment,
  `questionid` int(11) NOT NULL default '0',
  `value` text NOT NULL,
  `text` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Possible Choices for Slide Questions' AUTO_INCREMENT=41 ;
# --------------------------------------------------------

#
# Table structure for table `extraAttempts`
#
# Creation: Jan 27, 2005 at 02:54 PM
# Last update: Jan 27, 2005 at 02:54 PM
#

CREATE TABLE `extraAttempts` (
  `id` int(11) NOT NULL auto_increment,
  `user` text NOT NULL,
  `objectid` int(11) NOT NULL default '0',
  `time` timestamp(14) NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM COMMENT='Holds Start Times for Extra Attempts at Objects' AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table `images`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Dec 15, 2004 at 03:22 PM
#

CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `filename` text NOT NULL,
  `description` text NOT NULL,
  `class` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
# --------------------------------------------------------

#
# Table structure for table `objects`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 27, 2005 at 02:28 PM
#

CREATE TABLE `objects` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `info` text NOT NULL,
  `author` text NOT NULL,
  `metadata` text NOT NULL,
  `slides` int(11) NOT NULL default '0',
  `logging` int(11) NOT NULL default '0',
  `enabled` int(11) NOT NULL default '0',
  `comments` text NOT NULL,
  `assignments` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Object Information' AUTO_INCREMENT=6 ;
# --------------------------------------------------------

#
# Table structure for table `questions`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 24, 2005 at 06:34 PM
#

CREATE TABLE `questions` (
  `id` int(11) NOT NULL auto_increment,
  `objectid` int(11) NOT NULL default '0',
  `slideid` int(11) NOT NULL default '0',
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `type` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Question Information For the Indiviual Slides' AUTO_INCREMENT=17 ;
# --------------------------------------------------------

#
# Table structure for table `scores`
#
# Creation: Jan 27, 2005 at 02:54 PM
# Last update: Jan 27, 2005 at 02:54 PM
#

CREATE TABLE `scores` (
  `id` int(11) NOT NULL auto_increment,
  `user` text NOT NULL,
  `objectid` int(11) NOT NULL default '0',
  `correct` int(11) NOT NULL default '0',
  `incorrect` int(11) NOT NULL default '0',
  `questions` int(11) NOT NULL default '0',
  `score` double NOT NULL default '0',
  `s2` timestamp(14) NOT NULL,
  `s1` timestamp(14) NOT NULL,
  `attempts` int(11) NOT NULL default '0',
  KEY `id` (`id`)
) TYPE=MyISAM COMMENT='Student Score Information For Each Quiz, Including Latest St' AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table `settings`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 24, 2005 at 06:06 PM
#

CREATE TABLE `settings` (
  `id` int(11) NOT NULL auto_increment,
  `class` text NOT NULL,
  `ticker` int(11) NOT NULL default '0',
  KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
# --------------------------------------------------------

#
# Table structure for table `students`
#
# Creation: Jan 26, 2005 at 04:55 PM
# Last update: Jan 28, 2005 at 07:06 PM
#

CREATE TABLE `students` (
  `id` int(11) NOT NULL auto_increment,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `lastlogin` timestamp(14) NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM COMMENT='Student User Information' AUTO_INCREMENT=24 ;
# --------------------------------------------------------

#
# Table structure for table `text`
#
# Creation: Dec 15, 2004 at 02:41 PM
# Last update: Jan 24, 2005 at 06:31 PM
#

CREATE TABLE `text` (
  `id` int(11) NOT NULL auto_increment,
  `objectid` int(11) NOT NULL default '0',
  `slide` int(11) NOT NULL default '0',
  `text` text NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Text Information For Indiviual Object Slides' AUTO_INCREMENT=21 ;
# --------------------------------------------------------

#
# Table structure for table `userAnswers`
#
# Creation: Jan 27, 2005 at 02:54 PM
# Last update: Jan 27, 2005 at 02:54 PM
#

CREATE TABLE `userAnswers` (
  `id` int(11) NOT NULL auto_increment,
  `user` text NOT NULL,
  `objectid` int(11) NOT NULL default '0',
  `questionnum` int(11) NOT NULL default '0',
  `alt` int(11) NOT NULL default '0',
  `answer` text NOT NULL,
  `correct` int(11) NOT NULL default '0',
  `time` timestamp(14) NOT NULL,
  KEY `id` (`id`)
) TYPE=MyISAM COMMENT='Stores Student Answers & Time Stamps' AUTO_INCREMENT=1 ;

