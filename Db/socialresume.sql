-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2014 at 11:33 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialresume`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entry`
--

CREATE TABLE IF NOT EXISTS `tbl_entry` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `u_poster_id` int(11) NOT NULL,
  `u_message` blob NOT NULL,
  `u_postedon` datetime NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_entry`
--

INSERT INTO `tbl_entry` (`e_id`, `u_id`, `u_poster_id`, `u_message`, `u_postedon`) VALUES
(3, 1, 2, 0x746573747366, '2014-08-07 06:57:46'),
(4, 2, 1, 0x68656c6c6f2064656d6f2e2e20616d2074657374, '2014-08-07 09:05:29'),
(5, 2, 4, 0x68656c6c6f2064656d6f2e2e2e2e20616d2061646d696e2e2e2e, '2014-08-07 11:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_template`
--

CREATE TABLE IF NOT EXISTS `tbl_mail_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1-admin,2-user',
  `mail_template_name` varchar(255) NOT NULL,
  `mail_template_sub` varchar(255) NOT NULL,
  `mail_template_body` text NOT NULL,
  `mail_template_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0- in active,1 - active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `list_mode` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_mail_template`
--

INSERT INTO `tbl_mail_template` (`id`, `type`, `mail_template_name`, `mail_template_sub`, `mail_template_body`, `mail_template_status`, `created_at`, `updated_at`, `list_mode`) VALUES
(1, 2, 'mailcontainer', 'Mail Container', '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">\r\n    	  <tr> \r\n    	    <td bgcolor="#ffffff"><table width="100%" border="0" cellspacing="0" cellpadding="22">\r\n    	      <tr>\r\n    	        <td align="left" valign="top" style="font-size:15px; font-family:Georgia, ''Times New Roman'', Times, serif;  color:#545454; line-height:22px;" >\r\n                	 {MAIL_BODY}                </td>\r\n  	        </tr>\r\n  	      </table></td>\r\n  	    </tr> \r\n    </table>\r\n', 1, '2014-05-01 07:01:56', '2014-05-01 07:01:56', 0),
(2, 1, 'initiationmail', 'initiationmail', '<h1>Hello User</h1>\r\n\r\n<p>{MESSAGE}.</p>\r\n<p>{LINK}.</p>\r\n \r\n ', 1, '2014-06-02 20:46:30', '2014-06-02 20:46:30', 1),
(3, 1, 'entrymail', 'Entry email', '<h1>Hello User</h1>\r\n\r\n<p>{MESSAGE}.</p>\r\n<p>{LINK}.</p>\r\n \r\n ', 1, '2014-06-02 20:46:30', '2014-06-02 20:46:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sendlist`
--

CREATE TABLE IF NOT EXISTS `tbl_sendlist` (
  `ls_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `ls_msg` blob NOT NULL,
  `ls_msgtoemail` varchar(50) NOT NULL,
  `ls_date` datetime NOT NULL,
  PRIMARY KEY (`ls_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_sendlist`
--

INSERT INTO `tbl_sendlist` (`ls_id`, `u_id`, `ls_msg`, `ls_msgtoemail`, `ls_date`) VALUES
(1, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'test@test.com', '2014-08-05 09:10:49'),
(2, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'test@test.com', '2014-08-05 09:18:15'),
(3, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:35:28'),
(4, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:39:03'),
(5, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:40:13'),
(6, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:41:20'),
(7, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:43:22'),
(8, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:43:53'),
(9, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:44:17'),
(10, 1, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'jinson@innomindtech.com', '2014-08-07 06:45:01'),
(11, 1, 0x68656c6c6f20746573742c20796f752061726520676f6f64, 'demo@demo.com', '2014-08-07 09:02:36'),
(12, 2, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'test@test.com', '2014-08-07 09:02:58'),
(13, 2, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'test@test.com', '2014-08-07 09:04:55'),
(14, 1, 0x746573747366, 'test@test.com', '2014-08-07 09:48:40'),
(15, 1, 0x706c6573616520636865636b65206d7920726576696577, 'demo@demo.com', '2014-08-07 10:21:10'),
(16, 2, 0x506c6561736520777269746520736f6d65207468696e672061626f7574206d65, 'admin@tretre.com', '2014-08-07 11:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_email` varchar(50) NOT NULL,
  `u_pwd` varchar(255) NOT NULL,
  `u_status` tinyint(1) NOT NULL COMMENT '1-> active user ; 2-> inactive user',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_id`, `u_email`, `u_pwd`, `u_status`) VALUES
(1, 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'demo@demo.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'admin@tretre.com', 'e10adc3949ba59abbe56e057f20f883e', 1);
