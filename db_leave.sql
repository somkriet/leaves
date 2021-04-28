-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2013 at 06:19 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_leave`
--
CREATE DATABASE IF NOT EXISTS `db_leave` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_leave`;

-- --------------------------------------------------------

--
-- Table structure for table `acceptation`
--

CREATE TABLE IF NOT EXISTS `acceptation` (
  `acceptation_ID` int(1) NOT NULL AUTO_INCREMENT,
  `acceptation_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`acceptation_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `acceptation`
--

INSERT INTO `acceptation` (`acceptation_ID`, `acceptation_Name`) VALUES
(0, 'รอการพิจารณา'),
(1, 'อนุมัติ (จ่าย)'),
(2, 'อนุมัติ (ไม่จ่าย)'),
(3, 'ไม่อนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `annual`
--

CREATE TABLE IF NOT EXISTS `annual` (
  `annual_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(7) NOT NULL,
  `annual_date` datetime NOT NULL,
  `annual_old` int(2) NOT NULL,
  `annual_old_use` int(2) NOT NULL,
  `annual_new` int(2) NOT NULL,
  `annual_new_use` int(2) NOT NULL,
  PRIMARY KEY (`annual_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_ID` int(2) NOT NULL AUTO_INCREMENT,
  `department_Name` varchar(150) NOT NULL,
  `office_ID` int(2) NOT NULL,
  `delete_flag` int(1) NOT NULL,
  PRIMARY KEY (`department_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_ID`, `department_Name`, `office_ID`, `delete_flag`) VALUES
(1, 'IT', 1, 0),
(2, 'MKT', 1, 0),
(3, 'ACC', 1, 0),
(4, 'Air', 4, 0),
(5, 'EXP', 1, 0),
(6, 'IMP', 1, 0),
(7, 'HR', 1, 0),
(8, 'WH', 5, 0),
(9, 'DC', 5, 0),
(10, 'LCB', 2, 0),
(11, 'EXP Doc', 1, 0),
(12, 'Management', 1, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_daysofanualleave`
--
CREATE TABLE IF NOT EXISTS `get_daysofanualleave` (
`user_id` int(7)
,`name_en` varchar(150)
,`star1` date
,`anualleave` int(2)
);
-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `leave_ID` varchar(13) NOT NULL,
  `active_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active_by` int(7) NOT NULL COMMENT 'ผู้ที่บันทึกการลา',
  `user_leave` int(7) NOT NULL COMMENT 'ผู้ที่จะลา',
  `subject` varchar(150) NOT NULL,
  `detail` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `total_date` varchar(1) NOT NULL,
  `leave_type_ID` int(2) NOT NULL,
  `progression_ID` int(1) NOT NULL,
  `payment` int(1) NOT NULL COMMENT '0=ไม่มีค่าใช้จ่าย 1=มีค่าใช้จ่าย',
  `costs` varchar(7) NOT NULL,
  `manager_approv` int(7) NOT NULL,
  `manager_approv_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `acceptation_ID` int(1) NOT NULL,
  `hr_approv` int(7) NOT NULL,
  `hr_approv_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `leave_attached` varchar(150) NOT NULL COMMENT 'ใบรับรองแพทย์',
  `delete_flag` int(1) NOT NULL,
  PRIMARY KEY (`leave_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `leave_annual`
--

CREATE TABLE IF NOT EXISTS `leave_annual` (
  `annual_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto running number',
  `year_ID` varchar(4) NOT NULL COMMENT 'current year',
  `user_ID` int(7) NOT NULL COMMENT 'user id',
  `annual_have` int(2) NOT NULL COMMENT 'get days for anual leave',
  `annual_old` int(2) NOT NULL COMMENT 'boh from last year',
  `annual_old_use` int(2) NOT NULL COMMENT 'expire 31/03 current year',
  `annual_new_use` int(2) NOT NULL COMMENT 'used days for leave current year',
  PRIMARY KEY (`annual_ID`),
  UNIQUE KEY `annual_leave_IDX` (`user_ID`,`year_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `leave_annual`
--

INSERT INTO `leave_annual` (`annual_ID`, `year_ID`, `user_ID`, `annual_have`, `annual_old`, `annual_old_use`, `annual_new_use`) VALUES
(1, '2013', 1009, 10, 0, 0, 0),
(2, '2013', 1013, 10, 0, 0, 0),
(3, '2013', 1015, 10, 0, 0, 0),
(4, '2013', 1017, 10, 0, 0, 0),
(5, '2013', 1020, 10, 0, 0, 0),
(6, '2013', 1022, 10, 0, 0, 0),
(7, '2013', 1047, 10, 0, 0, 0),
(8, '2013', 1056, 10, 0, 0, 0),
(9, '2013', 1057, 6, 0, 0, 0),
(10, '2013', 1068, 10, 0, 0, 0),
(11, '2013', 1070, 10, 0, 0, 0),
(12, '2013', 1081, 10, 0, 0, 0),
(13, '2013', 1094, 10, 0, 0, 0),
(14, '2013', 1102, 10, 0, 0, 0),
(15, '2013', 1113, 10, 0, 0, 0),
(16, '2013', 1119, 10, 0, 0, 0),
(17, '2013', 1127, 10, 0, 0, 0),
(18, '2013', 1133, 10, 0, 0, 0),
(19, '2013', 1140, 10, 0, 0, 0),
(20, '2013', 1147, 10, 0, 0, 0),
(21, '2013', 1152, 10, 0, 0, 0),
(22, '2013', 1155, 10, 0, 0, 0),
(23, '2013', 1199, 10, 0, 0, 0),
(24, '2013', 1224, 10, 0, 0, 0),
(25, '2013', 1230, 10, 0, 0, 0),
(26, '2013', 1241, 10, 0, 0, 0),
(27, '2013', 1250, 10, 0, 0, 0),
(28, '2013', 1261, 10, 0, 0, 0),
(29, '2013', 1273, 10, 0, 0, 0),
(30, '2013', 1288, 10, 0, 0, 0),
(31, '2013', 1290, 10, 0, 0, 0),
(32, '2013', 1306, 10, 0, 0, 0),
(33, '2013', 1312, 10, 0, 0, 0),
(34, '2013', 1316, 10, 0, 0, 0),
(35, '2013', 1321, 10, 0, 0, 0),
(36, '2013', 1346, 10, 0, 0, 0),
(37, '2013', 1349, 10, 0, 0, 0),
(38, '2013', 1354, 10, 0, 0, 0),
(39, '2013', 1372, 10, 0, 0, 0),
(40, '2013', 1381, 10, 0, 0, 0),
(41, '2013', 1387, 10, 0, 0, 0),
(42, '2013', 1388, 10, 0, 0, 0),
(43, '2013', 1391, 10, 0, 0, 0),
(44, '2013', 1392, 10, 0, 0, 0),
(45, '2013', 1393, 10, 0, 0, 0),
(46, '2013', 1394, 10, 0, 0, 0),
(47, '2013', 1397, 10, 0, 0, 0),
(48, '2013', 1400, 10, 0, 0, 0),
(49, '2013', 1425, 10, 0, 0, 0),
(50, '2013', 1438, 8, 0, 0, 0),
(51, '2013', 1448, 8, 0, 0, 0),
(52, '2013', 1449, 8, 0, 0, 0),
(53, '2013', 1454, 8, 0, 0, 0),
(54, '2013', 1455, 8, 0, 0, 0),
(55, '2013', 1457, 8, 0, 0, 0),
(56, '2013', 1463, 8, 0, 0, 0),
(57, '2013', 1475, 8, 0, 0, 0),
(58, '2013', 1476, 8, 0, 0, 0),
(59, '2013', 1492, 8, 0, 0, 0),
(60, '2013', 1495, 8, 0, 0, 0),
(61, '2013', 1522, 8, 0, 0, 0),
(62, '2013', 1529, 8, 0, 0, 0),
(63, '2013', 1541, 6, 0, 0, 0),
(64, '2013', 1557, 6, 0, 0, 0),
(65, '2013', 1566, 6, 0, 0, 0),
(66, '2013', 1578, 6, 0, 0, 0),
(67, '2013', 1580, 6, 0, 0, 0),
(68, '2013', 1585, 6, 0, 0, 0),
(69, '2013', 1591, 6, 0, 0, 0),
(70, '2013', 1616, 6, 0, 0, 0),
(71, '2013', 1617, 6, 0, 0, 0),
(72, '2013', 1621, 6, 0, 0, 0),
(73, '2013', 1623, 6, 0, 0, 0),
(74, '2013', 1628, 6, 0, 0, 0),
(75, '2013', 1637, 6, 0, 0, 0),
(76, '2013', 1677, 6, 0, 0, 0),
(77, '2013', 1684, 6, 0, 0, 0),
(78, '2013', 1687, 6, 0, 0, 0),
(79, '2013', 1697, 6, 0, 0, 0),
(80, '2013', 1698, 6, 0, 0, 0),
(81, '2013', 1700, 6, 0, 0, 0),
(82, '2013', 1716, 6, 0, 0, 0),
(83, '2013', 1719, 6, 0, 0, 0),
(84, '2013', 1723, 6, 0, 0, 0),
(85, '2013', 1732, 6, 0, 0, 0),
(86, '2013', 1752, 6, 0, 0, 0),
(87, '2013', 1754, 6, 0, 0, 0),
(88, '2013', 1755, 6, 0, 0, 0),
(89, '2013', 1762, 6, 0, 0, 0),
(90, '2013', 1765, 6, 0, 0, 0),
(91, '2013', 1766, 6, 0, 0, 0),
(92, '2013', 1768, 6, 0, 0, 0),
(93, '2013', 1769, 6, 0, 0, 0),
(94, '2013', 1774, 6, 0, 0, 0),
(95, '2013', 1775, 6, 0, 0, 0),
(96, '2013', 1784, 6, 0, 0, 0),
(97, '2013', 1790, 6, 0, 0, 0),
(98, '2013', 1814, 6, 0, 0, 0),
(99, '2013', 1815, 6, 0, 0, 0),
(100, '2013', 1830, 6, 0, 0, 0),
(101, '2013', 1833, 6, 0, 0, 0),
(102, '2013', 1843, 6, 0, 0, 0),
(103, '2013', 1849, 6, 0, 0, 0),
(104, '2013', 1851, 6, 0, 0, 0),
(105, '2013', 1852, 6, 0, 0, 0),
(106, '2013', 1854, 6, 0, 0, 0),
(107, '2013', 1856, 6, 0, 0, 0),
(108, '2013', 1857, 6, 0, 0, 0),
(109, '2013', 1865, 0, 0, 0, 0),
(110, '2013', 1869, 0, 0, 0, 0),
(111, '2013', 1870, 0, 0, 0, 0),
(112, '2013', 1875, 0, 0, 0, 0),
(113, '2013', 1886, 0, 0, 0, 0),
(114, '2013', 1891, 0, 0, 0, 0),
(115, '2013', 1896, 0, 0, 0, 0),
(116, '2013', 1897, 0, 0, 0, 0),
(117, '2013', 1907, 0, 0, 0, 0),
(118, '2013', 1918, 0, 0, 0, 0),
(120, '2013', 1921, 0, 0, 0, 0),
(121, '2013', 1927, 0, 0, 0, 0),
(122, '2013', 1930, 0, 0, 0, 0),
(123, '2013', 1932, 0, 0, 0, 0),
(124, '2013', 1934, 0, 0, 0, 0),
(125, '2013', 1935, 0, 0, 0, 0),
(126, '2013', 1937, 0, 0, 0, 0),
(127, '2013', 1939, 0, 0, 0, 0),
(128, '2013', 1940, 0, 0, 0, 0),
(129, '2013', 1941, 0, 0, 0, 0),
(130, '2013', 1942, 0, 0, 0, 0),
(131, '2013', 1945, 0, 0, 0, 0),
(132, '2013', 1946, 0, 0, 0, 0),
(133, '2013', 1955, 0, 0, 0, 0),
(134, '2013', 1958, 0, 0, 0, 0),
(135, '2013', 1959, 0, 0, 0, 0),
(136, '2013', 1965, 0, 0, 0, 0),
(137, '2013', 1966, 0, 0, 0, 0),
(138, '2013', 1968, 0, 0, 0, 0),
(139, '2013', 1969, 0, 0, 0, 0),
(140, '2013', 1970, 0, 0, 0, 0),
(141, '2013', 1971, 0, 0, 0, 0),
(142, '2013', 1973, 0, 0, 0, 0),
(143, '2013', 1975, 0, 0, 0, 0),
(144, '2013', 1978, 0, 0, 0, 0),
(145, '2013', 1979, 0, 0, 0, 0),
(146, '2013', 1981, 0, 0, 0, 0),
(147, '2013', 1984, 0, 0, 0, 0),
(148, '2013', 1992, 0, 0, 0, 0),
(149, '2013', 1994, 0, 0, 0, 0),
(150, '2013', 1995, 0, 0, 0, 0),
(151, '2013', 1996, 0, 0, 0, 0),
(152, '2013', 1997, 0, 0, 0, 0),
(153, '2013', 1998, 0, 0, 0, 0),
(154, '2013', 2001, 6, 0, 0, 6),
(156, '2012', 1920, 6, 0, 4, 6),
(158, '2013', 1920, 6, 4, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `leave_detail`
--

CREATE TABLE IF NOT EXISTS `leave_detail` (
  `leave_detail_ID` int(11) NOT NULL AUTO_INCREMENT,
  `leave_ID` varchar(13) NOT NULL,
  `leave_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_time` varchar(5) NOT NULL,
  `end_time` varchar(5) NOT NULL,
  `delete_flag` int(1) NOT NULL,
  PRIMARY KEY (`leave_detail_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_group`
--

CREATE TABLE IF NOT EXISTS `leave_group` (
  `leave_group_ID` int(2) NOT NULL AUTO_INCREMENT,
  `leave_group_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`leave_group_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `leave_group`
--

INSERT INTO `leave_group` (`leave_group_ID`, `leave_group_Name`) VALUES
(3, 'ลา'),
(4, 'เดินทางตามคำสั่ง');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE IF NOT EXISTS `leave_type` (
  `leave_type_ID` int(2) NOT NULL AUTO_INCREMENT,
  `leave_type_Name` varchar(150) NOT NULL,
  `title_name` varchar(1) NOT NULL,
  `name_en` varchar(25) NOT NULL,
  `leave_group_ID` int(2) NOT NULL,
  PRIMARY KEY (`leave_type_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`leave_type_ID`, `leave_type_Name`, `title_name`, `name_en`, `leave_group_ID`) VALUES
(3, 'ลากิจ (ล่วงหน้า)', 'C', 'casual leave', 3),
(4, 'ลากิจ (ย้อนหลัง)', 'C', 'casual leave', 3),
(5, 'ลาป่วย', 'S', 'sick leave', 3),
(6, 'ลาพักร้อน', 'A', 'annual', 3),
(7, 'ลาคลอด', 'M', 'maternity leave', 3),
(8, 'ลาบวช', 'O', 'Ordination Leave', 3),
(9, 'Head Office', 'T', 'Traveling on orders', 4),
(10, 'Airport', 'T', 'Traveling on orders', 4),
(11, 'SBLC', 'T', 'Traveling on orders', 4),
(12, 'LCB', 'T', 'Traveling on orders', 4),
(13, 'other', 'T', 'Traveling on orders', 4);

-- --------------------------------------------------------

--
-- Table structure for table `non_working_time`
--

CREATE TABLE IF NOT EXISTS `non_working_time` (
  `calendar_ID` int(11) NOT NULL AUTO_INCREMENT,
  `non_working_time` date NOT NULL,
  `detail` text NOT NULL,
  `add_by` int(7) NOT NULL,
  `add_date` datetime NOT NULL,
  PRIMARY KEY (`calendar_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `non_working_time`
--

INSERT INTO `non_working_time` (`calendar_ID`, `non_working_time`, `detail`, `add_by`, `add_date`) VALUES
(2, '2013-05-24', 'วันวิสาขบูชา', 1920, '2013-09-23 10:01:00'),
(4, '2013-07-22', 'วันอาสาฬหบูชา', 1920, '2013-09-23 10:01:00'),
(5, '2013-08-12', 'วันแม่แห่งชาติ', 1920, '2013-09-23 10:01:00'),
(6, '2013-10-23', 'วันปิยมหาราช', 1920, '2013-09-23 10:01:00'),
(7, '2013-12-05', 'วันพ่อแห่งชาติ', 1920, '2013-09-23 10:01:00'),
(8, '2013-12-10', 'วันรัฐธรรมนูญ', 1920, '2013-09-23 10:01:00'),
(9, '2013-12-30', 'วันหยุดพิเศษสิ้นปี', 1920, '2013-09-23 10:01:00'),
(10, '2013-12-31', 'วันสิ้นปี', 1920, '2013-09-23 10:01:00'),
(13, '2014-01-01', 'วันขึ้นปีใหม่', 1920, '2013-09-23 09:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE IF NOT EXISTS `office` (
  `office_ID` int(2) NOT NULL AUTO_INCREMENT,
  `office_Name` varchar(150) NOT NULL,
  `delete_flag` int(1) NOT NULL,
  PRIMARY KEY (`office_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_ID`, `office_Name`, `delete_flag`) VALUES
(1, 'LPN', 0),
(2, 'LCB', 0),
(4, 'Airport', 0),
(5, 'SBLC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `position_ID` int(2) NOT NULL,
  `position_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`position_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_ID`, `position_Name`) VALUES
(0, '-'),
(1, 'ADMIN'),
(2, 'AP ACCOUNT STAFF'),
(3, 'AR ACCOUNT STAFF'),
(4, 'ASSISTANT ACCOUNT MANAGER'),
(5, 'ASSISTANT DC MANAGER'),
(6, 'ASSISTANT EXPORT MANAGER'),
(7, 'ASSISTANT IMPORT MANAGER'),
(8, 'ASSISTANT IT MANAGER'),
(9, 'ASSISTANT MANAGER'),
(10, 'ASSISTANT MARKETING MANAGER'),
(11, 'ASSISTANT WAREHOUSE MANAGER'),
(12, 'BILLING/COSTING STAFF'),
(13, 'CHECKER'),
(14, 'CLERK'),
(15, 'COPY & SCAN'),
(16, 'CS EXPORT'),
(17, 'CS IMPORT'),
(18, 'CUSTOMS MANAGER'),
(19, 'D/O STAFF'),
(20, 'DEPUTY MANAGER'),
(21, 'DOCUMENT MANAGER'),
(22, 'DRIVER'),
(23, 'DUTY REFUND STAFF'),
(24, 'EXPORT MANAGER'),
(25, 'EXPORT PAPERLESS'),
(26, 'F/L DRIVER'),
(27, 'F/L WORKER'),
(28, 'HR MANAGER'),
(29, 'HR OFFICER'),
(30, 'IMPORT CS & PAPERLESS'),
(31, 'IMPORT MANAGER'),
(32, 'IT MANAGER'),
(33, 'IT SUPPORT'),
(34, 'LCB MANAGER'),
(35, 'LEADER'),
(36, 'LEADER F/L '),
(37, 'MAID'),
(38, 'MARKETING CO-ORDINATOR'),
(39, 'MARKETING EXECUTIVE'),
(40, 'MARKETING OFFICER'),
(41, 'MD'),
(42, 'MESSENGER'),
(43, 'PA'),
(44, 'PAPERLESS'),
(45, 'PAYABLE ACCOUNT STAFF'),
(46, 'PDRIVER'),
(47, 'PROGRAMMER'),
(48, 'PURCHASE OFFICER'),
(49, 'RECEIVE ACCOUNT STAFF'),
(50, 'SAFETY OFFICER'),
(51, 'SECRETARY'),
(52, 'SENIOR ACCOUNT MANAGER'),
(53, 'SENIOR ACCOUNT STAFF'),
(54, 'SENIOR CLERK'),
(55, 'SENIOR CS EXPORT'),
(56, 'SENIOR CS IMPORT'),
(57, 'SENIOR FREIGHT & MARKETING MANAGER'),
(58, 'SENIOR LOGISTICS MANAGER'),
(59, 'SENIOR MARKETING CO-ORDINATOR'),
(60, 'SENIOR MARKETING EXECUTIVE'),
(61, 'SENIOR MARKETING OFFICER'),
(62, 'SENIOR PAPERLESS'),
(63, 'SENIOR PROJECT MANAGER'),
(64, 'SENIOR SHIPPING STAFF'),
(65, 'SENIOR SYSTEM ADMINISTRATOR'),
(66, 'SHIPPING STAFF'),
(67, 'SUPERVISOR'),
(68, 'SYSTEM ADMINISTRATOR'),
(69, 'SYSTEM ANALYST'),
(70, 'TDRIVER'),
(71, 'WAREHOUSE MANAGER'),
(72, 'WORKER');

-- --------------------------------------------------------

--
-- Table structure for table `progression`
--

CREATE TABLE IF NOT EXISTS `progression` (
  `progression_ID` int(2) NOT NULL AUTO_INCREMENT,
  `progression_Name` varchar(150) NOT NULL,
  PRIMARY KEY (`progression_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `progression`
--

INSERT INTO `progression` (`progression_ID`, `progression_Name`) VALUES
(3, 'รถยนต์ส่วนตัว'),
(4, 'รถจักรยานยนต์ส่วนตัว'),
(5, 'รถทัวร์'),
(6, 'รถเมล์'),
(7, 'รถแท็กซี่'),
(8, 'รถไฟ'),
(9, 'เรือ'),
(10, 'เครื่องบิน'),
(11, 'รถจักรยานยนต์รับจ้าง'),
(12, 'BRT'),
(13, 'BTS'),
(14, 'MRT'),
(15, 'สามล้อ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int(7) NOT NULL,
  `department_ID` int(2) DEFAULT NULL,
  `name_en` varchar(150) DEFAULT NULL,
  `surname_en` varchar(150) DEFAULT NULL,
  `birth_date` varchar(12) DEFAULT NULL,
  `start_date_work` varchar(12) DEFAULT NULL,
  `name_th` varchar(150) DEFAULT NULL,
  `surname_th` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `cellphone` varchar(11) DEFAULT NULL,
  `user_type_ID` int(2) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `position_ID` int(2) DEFAULT NULL,
  `user_status` int(1) DEFAULT NULL COMMENT 'delete_flag => 0 = ไม่ลบ, 1 = ลบ',
  `img` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`user_ID`),
  UNIQUE KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `department_ID`, `name_en`, `surname_en`, `birth_date`, `start_date_work`, `name_th`, `surname_th`, `email`, `phone`, `cellphone`, `user_type_ID`, `username`, `password`, `position_ID`, `user_status`, `img`) VALUES
(0, 0, 'name_en', 'surname_en', 'birth_date', 'start_date_w', 'name_th', 'surname_th', 'email', 'phone', 'cellphone', 0, 'username', 'password', 0, 0, 'img'),
(1001, 12, 'OSAMU', 'KIMIZUKA', '22/1/1965', '7/10/1996', 'นายโอซามุ', 'คิมิซึกะ', '', '', '', 6, '', '', 41, 0, ''),
(1002, 8, 'NAOMITSU', 'TAKAMURA', '14/1/1968', '4/11/2011', 'นายนาโอมิซุ', 'ทาคามูระ', '', '', '', 3, '', '', 0, 0, ''),
(1009, 3, 'DUANGPORN', 'ATHIWORRAMAN', '5/8/1958', '3/8/1998', 'นส.ดวงพร', 'อติวรมันต์', 'duangporn@meikoasia.com', '', '', 1, '', '', 52, 0, ''),
(1013, 3, 'KRETSANAPON', 'THANOPAJAI', '17/8/1977', '9/4/1999', 'นายกฤษณะพล', 'ธโนปจัย', 'kretsanapol@meikoasia.com', '', '', 7, '', '', 4, 0, ''),
(1015, 1, 'SARACHAI', 'TAECHOTHANON', '6/10/1975', '4/11/2002', 'นายสารชัย ', 'เตโชตานนท์', 'sarachai@meiko.co.th', '', '', 1, '', '', 63, 0, ''),
(1017, 4, 'SOMKUAN', 'POO-KONGCHANA', '6/11/1964', '28/10/1999', 'นายสมควร', 'ภุกองชนะ', '', '', '', 3, '', '', 0, 0, ''),
(1020, 10, 'CHAICHANA', 'KASEMSUWAN', '9/2/1974', '1/7/2000', 'นายชัยชนะ ', 'เกษมสุวรรณ', '', '', '', 3, '', '', 0, 0, ''),
(1022, 4, 'CHALERMKIET', 'SORPRASART', '12/6/1959', '19/9/2000', 'นายเฉลิมเกียรติ', 'สอนประสาร', '', '', '', 3, '', '', 0, 0, ''),
(1047, 7, 'SOMCHART', 'TOKEARTTICHAI', '2/6/1965', '4/12/2002', 'นายสมชาติ  ', 'โตเกียรติชัย', '', '', '', 3, '', '', 0, 0, ''),
(1056, 1, 'KWANTA', 'RIMSUWAN', '23/12/1974', '1/2/2003', 'นส.ขวัญตา', 'ริมสุวรรณ์', 'kwanta@meiko.co.th', '', '', 2, '', '4ca82782c5372a547c104929f03fe7a9', 32, 0, ''),
(1057, 4, 'MANON', 'JITKORNBURI', '25/8/1981', '16/7/2012', 'นายมานนท์', 'จิตรครบุรี', 'manon@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1068, 6, 'BOONCHAI', 'CHANTRAWUTTIKORN', '3/4/1960', '2/5/2006', 'นายบุญชัย  ', 'จันทราวุฒิกร', 'boonchai@meikoasia.com', '', '', 2, '', '', 31, 0, ''),
(1070, 7, 'WATANA', 'MONOI', '9/4/1968', '12/5/2003', 'นายวัฒนะ', 'โม้น้อย', '', '', '', 3, '', '', 0, 0, ''),
(1081, 4, 'SANYA', 'PUONGTHAISONG', '9/7/1979', '2/6/2003', 'นายสัญญา', 'พวงไธสง', '', '', '', 3, '', '', 0, 0, ''),
(1094, 8, 'VORADECH', 'NAMUANGRAK', '1/7/1972', '1/7/2003', 'นายวรเดช', 'นาเมืองรักษ์', '', '', '', 3, '', '', 0, 0, ''),
(1102, 3, 'WIMONPAN', 'SUWANARSA', '6/11/1980', '1/9/2003', 'นส.วิมลพรรณ', 'สุวรรณอาสา', 'wimonpan@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1113, 4, 'PORNPHAN', 'WONGSUESAT', '27/10/1975', '16/2/2004', 'นส.พรพรรณ', 'วงศ์ซื่อสัตย์', 'pornphan@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1119, 8, 'SUCHART', 'KUMLOAYUNG', '10/4/1982', '6/6/2004', 'นายสุชาติ', 'คุ้มเลายุง', '', '', '', 3, '', '', 0, 0, ''),
(1127, 8, 'PATTHARAPORN', 'TECHADUANGCHAREON', '21/11/1966', '15/3/2004', 'นส.ภัทรภร   ', 'เตชะดวงเจริญ', '', '', '', 2, '', '', 71, 0, ''),
(1133, 1, 'NARED', 'SAITHICHAI', '15/3/1976', '6/5/2004', 'นายนเรศ   ', 'สายธิไชย', 'nared@meiko.co.th', '', '', 7, '', '', 8, 0, ''),
(1140, 10, 'PAWARISA', 'PRAMOLWONG', '2/9/1976', '1/6/2004', 'นส.ปวริศา  ', 'ประมวลวงศ์', '', '', '', 3, '', '', 0, 0, ''),
(1147, 2, 'SIRIPORN', 'SAKULSUKSIRI', '20/5/1972', '3/8/2004', 'นส.สิริพร  ', 'สกุลสุขศิริ', 'siriporn@meikoasia.com', '', '', 1, '', '', 57, 0, ''),
(1152, 9, 'TANAWAT', 'PUNTHONG', '1/1/1971', '12/10/2004', 'นายธนวัฒน์', 'พันธ์ทอง', '', '', '', 3, '', '', 0, 0, ''),
(1155, 5, 'SUCHON', 'THIPKRAISORN', '30/7/1980', '1/11/2004', 'นายสุชน', 'ทิพยไกรศร', 'suchon@meiko.co.th', '', '', 7, '', '', 6, 0, ''),
(1199, 5, 'VORAVAT', 'CHONGPHIPATMONGKOL', '9/10/1963', '5/10/2005', 'นายวรวรรธน์  ', 'จงพิพัฒน์มงคล', 'voravat@meikoasia.com', '', '', 2, '', '', 24, 0, ''),
(1230, 11, 'NUTTEE', 'RUJIROJOLARN', '20/8/1974', '15/3/2006', 'นายณัฐธีร์  ', 'รุจิโรจน์โอฬาร', '', '', '', 3, '', '', 0, 0, ''),
(1241, 3, 'NAPAPORN', 'LAKNGAM', '27/12/1983', '24/4/2006', 'นส.นภาพร ', 'หลักงาม', 'napaporn@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1250, 9, 'APAPUN', 'THANAM', '24/5/1977', '5/6/2006', 'นส.อาภาพรรณ', 'ทานาม', '', '', '', 7, '', '', 0, 0, ''),
(1261, 8, 'THANANCHAI', 'CHERDKLIN', '4/7/1966', '16/3/2004', 'นายธนัญชัย', 'เชิดกลิ่น', '', '', '', 3, '', '', 0, 0, ''),
(1273, 1, 'CHAIYAKIT', 'JIRACHOTIKOSOL', '4/5/1981', '17/4/2007', 'นายชัยยะกิตติ์  ', 'จิรโชติโกศล', 'chaiyakit@meiko.co.th ', '', '', 3, '', '', 68, 0, ''),
(1288, 10, 'VEERAPONG', 'PRUETTIPIBOONTHAM', '2/9/1972', '3/12/2007', 'นายวีระพงษ์  ', 'พฤฒิพิบูลธรรม', '', '', '', 3, '', '', 0, 0, ''),
(1290, 5, 'PALIDA', 'PATTAMAPINAN', '14/9/1975', '24/12/2007', 'นส.ปลิดา  ', 'ปัทมาภินันท์', 'palida@meikoasia.com', '', '', 7, '', '', 6, 0, ''),
(1306, 8, 'AMORNRAT', 'KAEWSAI', '20/1/1984', '30/8/2006', 'นส.อมรรัตน์', 'แก้วใส', '', '', '', 3, '', '', 0, 0, ''),
(1312, 2, 'YUPAPRON', 'PIYAJUNYARAK', '24/4/1982', '11/2/2008', 'น.ส.ยุพาภรณ์  ', 'ปิยะจรรยารักษ์', 'yupaporn@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1316, 10, 'BUDSAKORN', 'PUMMA', '1/5/1974', '4/3/2008', 'นส.บุษกร   ', 'พุมมา', 'budsakorn@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1321, 11, 'NITTIYA', 'PIMMEELAI', '30/10/1986', '3/4/2008', 'นส.นิตติญา  ', 'พิมพ์มีลาย', 'nittiya@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1346, 5, 'SUCHEERA', 'SRITHONGMA', '14/3/1970', '6/5/2008', 'นางสุชีรา ', 'ศรีทองมา', 'sucheera@meikoasia.com', '', '', 7, '', '', 6, 0, ''),
(1349, 6, 'CHOMPHUNUT', 'PIYACHAIYOTHIN', '16/7/1982', '6/5/2008', 'น.ส.ชมพูนุท   ', 'ปิยชัยโยธิน', 'chomphunut@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1354, 9, 'SURASAK', 'TONGSUT', '20/7/1981', '8/5/2008', 'นายสุรศักดิ์  ', 'ทองสุทธิ', '', '', '', 3, '', '', 0, 0, ''),
(1372, 11, 'SUPIN', 'THUDBUPHA', '21/8/1973', '1/9/2008', 'นส.สุพิน  ', 'ทัดบุบผา', 'supin@meikoasia.com ', '', '', 2, '', '', 21, 0, ''),
(1381, 9, 'WIRAPONG', 'TONPRASERT', '16/5/1974', '2/10/2008', 'นายวิระพงศ์   ', 'ต้นประเสริฐ', '', '', '', 3, '', '', 0, 0, ''),
(1387, 9, 'MONTREE', 'WANCHAI', '1/11/1978', '13/8/2008', 'นายมนตรี  ', 'วรรณไชย', '', '', '', 3, '', '', 0, 0, ''),
(1388, 6, 'TITITA', 'MUSTOOFADEE', '11/5/1980', '6/5/2009', 'นส.ฐิติตา', 'มุสตอฟาดี', 'titita@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1391, 11, 'ITTIPOL', 'PRALYGAM', '17/3/1975', '21/5/2009', 'นายอิทธิพล', 'พรายงาม', 'kamonwit@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1392, 11, 'PRAPATSORN', 'PILERT', '8/7/1986', '21/5/2009', 'นส.ประภัสสร', 'พิเลิศ', 'prapatsorn@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1393, 4, 'RUNGPHET', 'PLAHARN', '17/12/1975', '16/6/2009', 'นายรุ่งเพชร  ', 'พลาหาญ', '', '', '', 3, '', '', 0, 0, ''),
(1394, 9, 'PRAMUAN', 'SOMNAM', '4/12/1971', '13/7/2009', 'นายประมวล', 'สมนาม', '', '', '', 3, '', '', 0, 0, ''),
(1397, 5, 'SIRIMONGKOL', 'PHERMPOL', '10/5/1984', '16/9/2009', 'นส.ศิริมงคล ', ' เพิ่มผล', 'sirimongkol@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1400, 10, 'CHITTANAN', 'PLABPLALEK', '14/3/1975', '1/10/2009', 'นส.จิตตานันทิ์ ', 'พลับพลาเล็ก', 'chittanan@meiko.co.th', '', '', 2, '', '', 34, 0, ''),
(1425, 9, 'NARONG', 'SRISAWAT', '19/9/1958', '1/6/2006', 'นายณรงค์', 'ศรีสวัสดิ์', '', '', '', 3, '', '', 0, 0, ''),
(1438, 10, 'ATCHARAPAN', 'ONSOPAPORN', '19/6/1986', '1/4/2010', 'น.ส.อัจฉราพรรณ', 'อ่อนโสภา', 'atcharapan@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1448, 4, 'THIIDAPORN', 'PUENGSALA', '15/2/1981', '10/5/2010', 'น.ส.ธิดาพร', 'พึงสาระ', 'thidaporn@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1449, 7, 'PICHET', 'LOKVIRUN', '5/3/1991', '10/5/2010', 'นายพิเชษ', 'โลกวิรุฬห์', '', '', '', 3, '', '', 0, 0, ''),
(1454, 11, 'MANOP', 'KONGFUENG', '7/7/1974', '1/6/2010', 'นายมานพ', 'คงเฟื่อง', '', '', '', 3, '', '', 0, 0, ''),
(1455, 4, 'PHAIRAT', 'SIRIPROM', '28/2/1974', '1/6/2010', 'นายไพรัตน์', 'ศิริพรม', '', '', '', 3, '', '', 0, 0, ''),
(1457, 2, 'TOMOYUKI', 'HIRATE', '29/12/1974', '1/6/2010', 'นายโทโมยูกิ', 'ฮิราเตะ', 'hirate@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1463, 2, 'VICHIT', 'TANGPANYAPINIT', '2/3/1975', '23/6/2010', 'นายวิชิต', 'ตั้งปัญญาพินิต', 'vichit@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1475, 3, 'SULEEPORN', 'NIAMPHUEK', '19/9/1982', '20/7/2010', 'น.ส.ศุลีพร', 'เนียมเผือก', 'suleeporn@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1476, 5, 'CHAYANIS', 'PIEWBANG', '25/6/1981', '19/7/2010', 'นส.ชยานิฐศ ', 'ผิวบาง', 'chayanis@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1492, 7, 'ISARAPONG', 'CHAIPUTHON', '20/7/1985', '30/8/2010', 'นายอิศราพงษ์', 'ชัยภูธร', '', '', '', 3, '', '', 0, 0, ''),
(1495, 9, 'SUTHANEE', 'MONTHATHIP', '28/4/1961', '7/9/2010', 'นางสุธนี', 'มณฑาทิพย์', '', '', '', 3, '', '', 0, 0, ''),
(1522, 2, 'PORNPEN', 'PALAMIT', '1/5/1974', '1/11/2010', 'น.ส.พรเพ็ญ', 'พลามิตร', 'pornpen@meikoasia.com', '', '', 7, '', '', 10, 0, ''),
(1529, 9, 'CHEN', 'SINGTHONG', '30/7/1976', '16/11/2010', 'นายเจญ', 'สิงห์ทอง', '', '', '', 3, '', '', 0, 0, ''),
(1541, 8, 'ANON', 'PAORIBUTH', '14/6/1983', '10/1/2011', 'นายอานันท์', 'เปาริบุตร', '', '', '', 3, '', '', 0, 0, ''),
(1557, 5, 'NARUMOL', 'KRUERIYA', '28/6/1981', '1/3/2011', 'น.ส.นฤมล', 'เครือริยะ', 'narumol@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1566, 3, 'WALAIRAT', 'RODYOI', '25/3/1986', '28/3/2011', 'น.ส.วลัยรัตน์', 'รอดย้อย', 'walairat@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1578, 9, 'RUNGNAPA', 'DUANGJAI', '18/3/1988', '9/5/2011', 'น.ส.รุ่งนภา', 'ดวงใจ', '', '', '', 3, '', '', 0, 0, ''),
(1580, 9, 'UDORN', 'CHAIWONG', '4/4/1976', '9/5/2011', 'นายอุดร', 'ไชยวงศ์', '', '', '', 3, '', '', 0, 0, ''),
(1585, 6, 'DARARAI', 'KRUTKAMROP', '2/10/1967', '23/5/2011', 'นางดาราราย', 'ครุธคำรพ', 'dararai@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1591, 9, 'MANAD', 'MUAENPAE', '25/10/1979', '26/5/2011', 'นายมนัส', 'เหมือนแพ', '', '', '', 3, '', '', 0, 0, ''),
(1616, 1, 'KRITSADA', 'WUTTANUSORN', '19/9/1984', '25/7/2011', 'นายกฤษฎา', 'วุฒานุสรณ์', 'kritsada@meiko.co.th', '', '', 0, '', '962e56a8a0b0420d87272a682bfd1e53', 69, 0, ''),
(1617, 4, 'NIPHON', 'SUWANJAI', '12/7/1977', '27/7/2011', 'นายนิพนธ์', 'สุวรรณใจ', '', '', '', 3, '', '', 0, 0, ''),
(1621, 2, 'TANATCHA', 'YOYTISONG', '27/2/1982', '8/8/2011', 'น.ส.ธนัชชา', 'ย้อยไธสง', 'tanatcha@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1623, 9, 'WANCHAI', 'PAORIBUT', '12/9/1979', '23/9/2011', 'นายวันชัย', 'ปาริบุตร', '', '', '', 3, '', '', 0, 0, ''),
(1628, 9, 'CHITIPAT', 'AIEMMIAN', '15/8/1977', '21/9/2011', 'นายซิติพันธิ์', 'เอี่ยมเมี้ยน', '', '', '', 3, '', '', 0, 0, ''),
(1637, 9, 'BANCHA', 'SUDKRACHANG', '3/2/1973', '6/10/2011', 'นายบัญชา', 'สุดกระจ่าง', '', '', '', 3, '', '', 0, 0, ''),
(1677, 2, 'NATEE', 'SOMKANE', '9/5/1988', '7/2/2012', 'นายนที', 'สมคะเน', 'natee@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1684, 5, 'THANYA', 'INWICHIAN', '10/11/1989', '17/2/2012', 'น.ส.ธันยา', 'อินทร์วิเชียร', 'thanya@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1687, 11, 'AMPORN', 'CHANPINIJPOJ', '9/6/1965', '7/2/2012', 'น.ส.อัมพร', 'ชาญพินิจ', 'manop@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1697, 5, 'SUPALERK', 'PATCHALASUPAKIT', '25/6/1988', '27/2/2012', 'นายศุภฤกษ์', 'พัชรศุภกิจ', 'supalerk@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1698, 5, 'RERNGSAK', 'NAKNGAM', '15/9/1986', '27/2/2012', 'นายเริงศักดิ์', 'นาคงาม', 'rerngsak@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1700, 10, 'HATAIRAT', 'DUJJANUTAT', '2/12/1987', '2/3/2012', 'น.ส.หทัยรัตน์', 'ดุจจานุทัศน์', 'hatairat@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1716, 5, 'TAWEECHAI', 'CHALONGSIRIKUL', '1/8/1972', '26/3/2012', 'นาย ทวีชัย', 'ฉลองสิริกุล', 'taweechai@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1719, 11, 'JUTAMAT', 'MAKCHAI', '23/8/1984', '5/4/2012', 'น.ส. จุฑามาส', 'เมฆฉาย', '', '', '', 3, '', '', 0, 0, ''),
(1723, 5, 'PILAILUK', 'KHUNJUN', '14/9/1989', '21/5/2012', 'น.ส.พิไลลักษณ์', 'ขุนจันทร์', 'nicha@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1732, 8, 'PAKORN', 'SITTHICHAI', '3/8/1978', '2/4/2012', 'นายปกรณ์', 'สิทธิชัย', '', '', '', 3, '', '', 0, 0, ''),
(1752, 7, 'JUNLASAK', 'JANSAKDA', '15/8/1978', '14/5/2012', 'นายจุลศักดิ์', 'จันศักดา', '', '', '', 3, '', '', 0, 0, ''),
(1754, 10, 'KANLAYA', 'METEESAKULRIT', '24/8/1982', '16/5/2012', 'นางกัลยา', 'เมธีสกุลฤทธิ์', '', '', '', 3, '', '', 0, 0, ''),
(1755, 10, 'NITTIYA', 'PANTHALA', '21/3/1984', '15/5/2012', 'น.ส.นิดติยา', 'ปานทะเล', '', '', '', 3, '', '', 0, 0, ''),
(1762, 5, 'NICHA', 'THENGSIRISUP', '30/8/1989', '9/4/2012', 'น.ส. นิชา', 'ตั้งศิริทรัพยื', 'pilailuk@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1765, 9, 'NAREERAT', 'KAEWSANEHA', '28/10/1977', '3/5/2012', 'น.ส.นารีรัตน์', 'แก้วเส่หา', '', '', '', 3, '', '', 0, 0, ''),
(1766, 4, 'SUWANNEE', 'SANGBUNG', '26/9/1989', '28/5/2012', 'น.ส.สุวรรณี', 'แสงบึง', '', '', '', 3, '', '', 0, 0, ''),
(1768, 7, 'AKEANAN', 'DANGARJ', '17/7/1975', '1/6/2012', 'นายเอกอนันต์', 'แดงอาจ', '', '', '', 3, '', '', 0, 0, ''),
(1769, 7, 'PATCHAREE', 'JARUKAN', '18/3/1972', '5/6/2012', 'นางพัชรี', 'จารุการ', '', '', '', 3, '', '', 0, 0, ''),
(1774, 9, 'KIATTISAK', 'PROMKHOT', '4/9/1970', '28/5/2012', 'นายเกียรศักดิ์', 'พรมโครต', '', '', '', 3, '', '', 0, 0, ''),
(1775, 9, 'RUNGSIT', 'KONGHAN', '7/10/1989', '21/5/2012', 'นายรุ่งสิทธิ์', 'คงหาญ', '', '', '', 3, '', '', 0, 0, ''),
(1784, 11, 'KAMONWIT', 'KLACHTCHAI', '3/4/1986', '12/6/2012', 'นายกมลวิทย์', 'แกล้วโชติชัย', 'jutamat@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1790, 9, 'CHATWILAI', 'WIMUKTAYON', '28/3/1979', '18/6/2012', 'น.ส.ฉัตรวิไล', 'วิมุกตายน', '', '', '', 3, '', '', 0, 0, ''),
(1814, 9, 'WASAN', 'BANLUESUN', '13/6/1988', '4/7/2012', 'นายวสันต์', 'บรรลือทรัพย์', '', '', '', 3, '', '', 0, 0, ''),
(1815, 9, 'DOKAOR', 'THINNARK', '29/11/1980', '4/7/2012', 'น.ส.ดอกอ้อ', 'เทียนนาค', '', '', '', 3, '', '', 0, 0, ''),
(1830, 3, 'PUTCHARIN', 'SIBSOKKROUD', '15/12/1985', '30/7/2012', 'น.ส.พัชรินทร์', 'สิบโคกกรวด', 'putcharin@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1833, 9, 'RUNG-A-RUNG', 'HORMKLINTIEW', '2/9/1985', '1/8/2012', 'น.ส.รุ่งอรุณ', 'หอมกลิ่นเทียน', '', '', '', 3, '', '', 0, 0, ''),
(1843, 10, 'BANGON', 'PUNGKUN', '25/3/1976', '6/9/2012', 'น.ส.บังอร', 'พงษ์คุณ', 'bangon@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1849, 9, 'YUPASINEE', 'SORNAROON', '5/10/1983', '10/10/2012', 'น.ส.ยุพาสินี', 'สอนนอรุณ', '', '', '', 3, '', '', 68, 0, ''),
(1851, 7, 'LUCKSITA', 'LEESUWAN', '2/8/1967', '16/10/2012', 'นางลักษิตา', 'ลีสุวรรณ', 'lucksita@meikoasia.com', '', '', 5, '', 'ff1418e8cc993fe8abcfe3ce2003e5c5', 29, 0, ''),
(1852, 3, 'THANIYA', 'PONSORN', '7/4/1989', '24/10/2012', 'น.ส. ฐาณิญา', 'พลสอน', 'thaniya@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1854, 3, 'WALAILAK', 'SUPAP', '20/9/1989', '1/11/2012', 'น.ส. วลัยลักษณ์', 'สุภาพ', 'walailak@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1856, 3, 'WARUNYU', 'KHUNAPHOME', '16/5/1989', '19/11/2012', 'น.ส. วรัญญู', 'ชนาพรม', 'warunyu@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1857, 2, 'WATARU', 'HIJIMOTO', '3/4/1986', '19/11/2012', 'นายวาทารุ', 'ฮิจิโมโต', 'hijimoto@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1865, 8, 'SURAPRAPA', 'INTAMAI', '9/2/1987', '5/1/2013', 'น.ส. สุรประภา', 'อินต๊ะใหม่', '', '', '', 3, '', '', 0, 0, ''),
(1869, 2, 'YUKAKO', 'YOKOYAMA', '28/7/1972', '1/2/2013', 'น.ส.ยูกาโกะ', 'โยโกยามา', 'yokoyama@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1870, 8, 'APIRAK', 'THIWONGSA', '2/10/1972', '4/2/2013', 'นายอภิรักษ์', 'ธิวงษา', '', '', '', 3, '', '', 0, 0, ''),
(1875, 3, 'PRATHUMWADEE', 'HONGSRAKRU', '29/4/1986', '19/2/2013', 'น.ส.ประทุมวดี', 'หงษ์สระคู', 'prathumwadee@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1886, 7, 'PIYAPORN', 'NORMAI', '7/7/1988', '5/3/2013', 'น.ส.ปิยาภรณ์', 'หน่อใหม่', 'piyaporn@meiko.co.th', '', '', 5, '', 'c366c2c97d47b02b24c3ecade4c40a01', 29, 0, ''),
(1891, 5, 'ARISSARA', 'RUEDARA', '15/9/1986', '21/3/2013', 'น.ส.อริศรา', 'ฤาดารา', 'arissara@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1896, 6, 'THIPPHARAT', 'RUENGKANAB', '2/7/1990', '1/4/2013', 'น.ส.ทิพรัตน์', 'เรืองขนาบ', 'thippharat@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1897, 4, 'NUTHAPONK', 'TANASAITKOSON', '6/7/1970', '1/4/2013', 'นายณัฐพงษ์', 'ธนเสฎฐ์โกศล', '', '', '', 3, '', '', 0, 0, ''),
(1907, 9, 'NATTIKA', 'SURUTWARAKUN', '16/5/1991', '24/4/2013', 'น.ส.ณัฐิกา', 'ศรุตวราคุณ', '', '', '', 3, '', '', 0, 0, ''),
(1918, 5, 'SUPACHAI', 'KUMKWA', '27/8/1984', '3/5/2013', 'นายศุภชัย', 'คำขวา', 'supachai@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1921, 7, 'PORNWINEE', 'PHATTHANAWAT', '7/6/1991', '7/5/2013', 'น.ส.พรวินีย์', 'พัฒนเวช', 'pornwinee@meiko.co.th', '', '', 5, '', '', 29, 0, ''),
(1927, 10, 'THANWALAI', 'KUSOL', '14/6/1982', '9/5/2013', 'น.ส. ธัญวลัย', 'กุศล', 'thanwalai@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1930, 9, 'SAN', 'MUENCHAI', '30/12/1983', '8/5/2013', 'นายสัณห์', 'หมื่นชัย', '', '', '', 3, '', '', 0, 0, ''),
(1932, 9, 'JARUWIT', 'MOOLBUT', '2/7/1993', '9/5/2013', 'นายจารุวิทย์', 'มูลบุตร', '', '', '', 3, '', '', 0, 0, ''),
(1934, 9, 'NANTHIKARN', 'KIDCHAPOR', '28/12/1992', '14/5/2013', 'น.ส. นันทิกานต์', 'คิดเฉพาะ', '', '', '', 3, '', '', 0, 0, ''),
(1935, 6, 'WICHAYUT', 'BAINGERN', '28/2/1991', '13/5/2013', 'นายวิชยุตม์', 'ใบเงิน', 'wichayut@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1937, 9, 'PANJAPON ', ' THAIJAROEN', '5/12/1988', '13/5/2013', 'นายปัจพล', 'ไทยเจริญ', '', '', '', 3, '', '', 0, 0, ''),
(1939, 8, 'DENNAPA', 'MARTRAKCHART', '1/7/1994', '11/5/2013', 'น.ส.เด่นนภา', 'มาตรักชาติ', '', '', '', 3, '', '', 0, 0, ''),
(1940, 8, 'ROSSARIN', 'UNGOAD', '3/9/1994', '11/5/2013', 'น.ส.รสริน', 'อึ่งโอด', '', '', '', 3, '', '', 0, 0, ''),
(1941, 6, 'NATTHAYA', 'PHONGPATCHARASAKUL', '20/1/1982', '15/5/2013', 'น.ส. ณัฐยาน์', 'พงศ์พัชรสกุล', 'natthaya@meikoasia.com', '', '', 7, '', '', 8, 0, ''),
(1942, 9, 'JAMROON', 'SAENGPHUWONG', '19/7/1983', '20/5/2013', 'นายจำรูญ', 'แสงพูวงศ์', '', '', '', 3, '', '', 0, 0, ''),
(1945, 10, 'SUKANYA', 'NUENGSIN', '17/10/1989', '28/5/2013', 'น.ส.สุกัญญา', 'เนืองศิลป', '', '', '', 3, '', '', 0, 0, ''),
(1946, 8, 'SEUBSAKUN', 'U-KATE', '18/9/1971', '3/6/2013', 'นายสืบกุล', 'อยู่เกษ', '', '', '', 1, '', '', 58, 0, ''),
(1955, 9, 'RATTHAWAN', 'TATIYARUANGKIT', '7/4/1971', '6/6/2013', 'นางรัฐวรรณ', 'ตติยะเรืองกิจ  ', '', '', '', 7, '', '', 0, 0, ''),
(1958, 9, 'PORNPIPAT', 'PERNKANJANA', '26/9/1969', '6/6/2013', 'นายพรพิพัฒน์', 'เพิ่มกาญจนา', '', '', '', 3, '', '', 0, 0, ''),
(1959, 9, 'PRADERM', 'PHINTA', '18/3/1977', '10/6/2013', 'นายประเดิม', 'พินธะ', '', '', '', 3, '', '', 0, 0, ''),
(1965, 3, 'PANNIPA', 'SOMTONDEE', '18/6/1981', '1/7/2013', 'น.ส. พรรนิภา', 'สมตนดี', 'pannipa@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1966, 3, 'KANNAWAT', 'ANURAKCHEEWIN', '29/7/1981', '1/7/2013', 'น.ส.กัญณวัธน์', 'อนุรักษ์ชีวิน', 'kannawat@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1968, 9, 'SUTHIDA', 'SAYSIN', '2/4/1993', '1/7/2013', 'น.ส.สุทธิดา ', 'สายสิน', '', '', '', 3, '', '', 0, 0, ''),
(1969, 9, 'KOMSANTI', 'NAMO', '24/12/1982', '1/7/2013', 'นายคมสันติ ', 'นาโม', '', '', '', 3, '', '', 0, 0, ''),
(1970, 2, 'MASARU', 'GOTO', '23/12/1974', '1/7/2013', 'นายมาซารุ', 'โกโต', 'goto@meikoasia.com', '', '', 3, '', '', 0, 0, ''),
(1971, 9, 'PATCHAREE', 'DANGDEE', '12/9/1990', '1/7/2013', 'น.ส.พัชรี', 'แดงดี', '', '', '', 3, '', '', 0, 0, ''),
(1973, 9, 'JANTIMA', 'HAI-NGAM', '17/11/1980', '3/7/2013', 'น.ส.จันทร์ทิมา', 'ใฮงาม', '', '', '', 3, '', '', 0, 0, ''),
(1975, 9, 'TEERASAK', 'SOYLIT', '26/1/1980', '24/7/2013', 'นายธีรศักดิ์', 'สร้อยจิตร', '', '', '', 3, '', '', 0, 0, ''),
(1978, 6, 'SUKANYA', 'PONGVISUTIRACH', '18/4/1980', '5/8/2013', 'น.ส.สุกัญญา', 'พงศ์วิสุทธิรัชต์', 'sukanya_p@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1979, 8, 'TEERAPOL', 'PHUNGOEN', '18/4/1980', '5/8/2013', 'นายธีรพล', 'ภูเงิน', '', '', '', 3, '', '', 0, 0, ''),
(1981, 9, 'CHAIYA', 'TRILAO', '1/9/1992', '8/8/2013', 'นายไชยา', 'ตรีเหลา', '', '', '', 3, '', '', 0, 0, ''),
(1984, 9, 'CHARONG', 'TANODNOK', '3/11/1975', '9/8/2013', 'นายฉลอง', 'โตนดนอก', '', '', '', 3, '', '', 0, 0, ''),
(1992, 9, 'WUTTHICHAI', 'LALIT', '6/6/1993', '5/9/2013', 'นายวุฒิชัย', 'ลาฤทธิ์', '', '', '', 3, '', '', 0, 0, ''),
(1994, 9, 'NAKORN', 'PHANAPONG', '26/12/1988', '5/9/2013', 'นายนคร', 'ปานะพงษ์', '', '', '', 3, '', '', 0, 0, ''),
(1995, 7, 'SAKUNA', 'MEKLIN', '7/10/1994', '11/9/2013', 'น.ส.สกุณา', 'มีกลิ่น', 'sakuna_m@meiko.co.th', '', '', 3, '', '', 0, 0, ''),
(1996, 9, 'CHARINTHON', 'CHUNCHATCHAN', '16/3/1992', '16/9/2013', 'นายชรินทร', 'จุนจัดจันทร์', '', '', '', 3, '', '', 0, 0, ''),
(1997, 9, 'GAMEBON', 'MOGAN', '24/5/1977', '16/9/2013', 'นายเกมบอล', 'โมกัณฑ์', '', '', '', 3, '', '', 0, 0, ''),
(1998, 8, 'WITTHAYA', 'CHAARBAN', '2/10/1990', '16/9/2013', 'นายวิทยา', 'จาอาบาล', '', '', '', 3, '', '', 0, 0, ''),
(2001, 1, 'PUREEPON', 'SAIJAROUN', '24/11/1990', '26/9/2013', 'นายปุรีพล', 'สายเจริญ', 'pureepon@meiko.co.th', '', '', 3, '', 'd0fb963ff976f9c37fc81fe03c21ea7b', 47, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_ID` int(2) NOT NULL AUTO_INCREMENT,
  `user_type_Name` varchar(150) NOT NULL,
  PRIMARY KEY (`user_type_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_ID`, `user_type_Name`) VALUES
(0, 'Administrator'),
(1, 'Senior Manager'),
(2, 'Manager'),
(3, 'Employee'),
(4, 'Casual Worker'),
(5, 'HR'),
(6, 'MD'),
(7, 'Asst Mananger');

-- --------------------------------------------------------

--
-- Structure for view `get_daysofanualleave`
--
DROP TABLE IF EXISTS `get_daysofanualleave`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_daysofanualleave` AS select `u`.`user_ID` AS `user_id`,`u`.`name_en` AS `name_en`,str_to_date(`u`.`start_date_work`,'%m/%d/%Y') AS `star1`,(case when ((year(now()) - year(str_to_date(`u`.`start_date_work`,'%m/%d/%Y'))) < 1) then 0 when ((year(now()) - year(str_to_date(`u`.`start_date_work`,'%m/%d/%Y'))) < 3) then 6 when ((year(now()) - year(str_to_date(`u`.`start_date_work`,'%m/%d/%Y'))) < 4) then 8 else 10 end) AS `anualleave` from `user` `u`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
