-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 08:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v_opd`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliation`
--

CREATE TABLE `affiliation` (
  `affiliation_id` int(11) NOT NULL COMMENT 'รหัสสังกัดโรงบาล',
  `affiliation_name` text NOT NULL COMMENT 'ชื่อสังกัดโรงบาล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='สังกัดโรงบาล';

--
-- Dumping data for table `affiliation`
--

INSERT INTO `affiliation` (`affiliation_id`, `affiliation_name`) VALUES
(1, 'โรงพยาบาลเจ้าพระยาอภัยภูเบศร จังหวัดปราจีนบุรี'),
(2, 'โรงพยาบาลค่ายจักรพงษ์'),
(3, 'โรงพยาบาลระยอง จังหวัดระยอง'),
(4, 'โรงพยาบาลพุทธโสธร จังหวัดฉะเชิงเทรา'),
(5, 'โรงพยาบาลชลบุรี จังหวัดชลบุรี'),
(6, 'โรงพยาบาลพระปกเกล้า จังหวัดจันทบุรี'),
(7, 'โรงพยาบาลศิริราช'),
(8, 'โรงพยาบาลจุฬาลงกรณ์'),
(9, 'โรงพยาบาลพระมงกุฎเกล้า');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL COMMENT 'รหัสการจอง',
  `op_id` int(11) NOT NULL COMMENT 'รหัสซักประวัติ',
  `doctor_id` int(11) DEFAULT NULL COMMENT 'รหัสหมอ',
  `booking_status` int(11) NOT NULL COMMENT 'สถานะการจอง',
  `booking_rating` int(11) DEFAULT NULL COMMENT 'ระดับความพึงพอใจ',
  `booking_comment` text DEFAULT NULL COMMENT 'แสดงความคิดเห็นหลังจากการตรวจ',
  `room_id` varchar(20) DEFAULT NULL COMMENT 'รหัสห้องแชท',
  `booking_create_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สร้างจอง',
  `booking_update_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่อัพเดทการจอง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางการจองเพื่อนัดพบหมอ';

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `op_id`, `doctor_id`, `booking_status`, `booking_rating`, `booking_comment`, `room_id`, `booking_create_date`, `booking_update_date`) VALUES
(11, 11, 1, 0, NULL, NULL, 'ngsu0mv2xi', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(12, 12, 1, 2, 4, NULL, 'htgztzmaj3', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(13, 13, 2, 0, NULL, NULL, 'gf11wlgjpqm', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(14, 14, NULL, 0, NULL, NULL, 'xmbh9xlc2x', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(15, 15, 1, 2, 4, 'ttetet', 'nlbqpo3ff9j', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(16, 16, 1, 2, 4, '', '75apk24e128', '2019-11-06 06:55:19', '2019-11-06 06:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL COMMENT 'รหัสแผนก',
  `dep_name` text NOT NULL COMMENT 'ชื่อแผนก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='แผนกในโรงงาน';

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'แผนกจัดซื้อ'),
(2, 'แผนกจัดส่ง'),
(3, 'แผนกลายผลิต'),
(4, 'แผนก IT ');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL COMMENT 'รหัสหมอ',
  `doctor_idcard` varchar(13) DEFAULT NULL COMMENT 'รหัสบัตรประชาชน',
  `prefix_id` int(11) NOT NULL COMMENT 'รหัสคำนำหน้า',
  `doctor_fname` text NOT NULL COMMENT 'ชื่อ',
  `doctor_lname` text NOT NULL COMMENT 'สกุล',
  `doctor_birthday` date NOT NULL COMMENT 'วัน/เดือน/ปีเกิด',
  `doctor_old_address` text NOT NULL COMMENT 'ที่อยู่ตามทะเบียนบ้าน',
  `doctor_address` text NOT NULL COMMENT 'ที่อยู่ปัจจุบัน',
  `professions_id` int(11) NOT NULL COMMENT 'รหัสประเภทวิชาชีพ',
  `doctor_file_profess` varchar(50) DEFAULT NULL COMMENT 'ไฟล์ข้อมูลวิชาชีพ',
  `doctor_img` varchar(50) DEFAULT NULL COMMENT 'รูปหมอ',
  `affiliation_id` int(11) NOT NULL COMMENT 'สังกัดโรงบาล',
  `doctor_username` text NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `doctor_password` text NOT NULL COMMENT 'รหัสผ่าน',
  `doctor_tel` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `doctor_signature` varchar(50) DEFAULT NULL COMMENT 'ลายเซ็นอิเล็กทรอนิกส์',
  `doctor_status` varchar(5) NOT NULL COMMENT 'สถานะการใช้งาน',
  `doctor_activate` int(11) DEFAULT 0 COMMENT 'ยืนยันการใช้งานแพทย์',
  `doctor_create_date` datetime NOT NULL COMMENT 'วันที่สร้างข้อมูล',
  `doctor_update_date` datetime NOT NULL COMMENT 'วันที่อัพเดทข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูลหมอ';

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_idcard`, `prefix_id`, `doctor_fname`, `doctor_lname`, `doctor_birthday`, `doctor_old_address`, `doctor_address`, `professions_id`, `doctor_file_profess`, `doctor_img`, `affiliation_id`, `doctor_username`, `doctor_password`, `doctor_tel`, `doctor_signature`, `doctor_status`, `doctor_activate`, `doctor_create_date`, `doctor_update_date`) VALUES
(1, '1349900844772', 1, 'สุรเกียรติ', 'แสงกล้า', '1996-03-17', 'Ubon Ratchathani', 'Prachinburi', 1, '1349900844772.jpg', '1349900844772.jpg', 1, 'doctor1', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', '1349900844772.jpg', '0', 2, '2019-07-18 00:00:00', '2019-10-30 22:36:14'),
(2, '1349900844721', 1, 'ธนศักดิ์', 'พุทธรักษา', '1996-03-17', 'Ubon Ratchathani', 'Prachinburi', 3, '1349900844721.png', NULL, 1, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, '1349900844721.png', '0', 1, '2019-07-18 00:00:00', '2019-10-25 19:04:24'),
(3, '1349900844777', 1, 'ธวัชชัย', 'ฐานดี', '1998-04-18', 'Chiangrai', 'Prachinburi', 1, '', NULL, 1, 'tax', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, '0', 1, '2019-07-25 00:00:00', '2019-09-26 17:36:43'),
(4, '1349900844720', 1, 'สุเทพ', 'ยังอยู่', '1996-03-17', 'Ubon Ratchatani', 'Prachinburi', 5, '', '', 1, 'sulnw', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397718', '', '0', 1, '2019-09-21 00:00:00', '2019-10-22 03:13:39'),
(23, '1349900844773', 1, 'ทดสอบระบบ', 'นามสกุล', '1995-10-14', 'ที่อยู่เดิม', 'ที่อยู่ใหม่', 4, '1349900844773.jpg', '1349900844773.jpg', 1, 'testsystem', '5f4dcc3b5aa765d61d8327deb882cf99', '1234567890', '1349900844773.jpg', '0', 0, '2019-10-14 09:33:41', '2019-10-28 01:48:12'),
(24, '1349900844775', 1, 'ธนชัย', 'ตันตระกูล', '1997-03-17', 'ที่อยู่เดิม', 'ที่อยู่ใหม่', 1, NULL, '1349900844775.jpeg', 1, 'yod', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', NULL, '0', 0, '2019-10-22 02:44:57', '2019-10-22 02:44:57'),
(26, '1349900844771', 1, 'ทดสอบระบบ', 'นามสกุลระบบ', '2019-10-22', 'ที่อยู่เดิม', 'ที่อยู่ใหม่', 3, '1349900844771.jpg', '1349900844771.jpg', 1, 'testsystem1', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', '1349900844771.jpg', '0', 1, '2019-10-22 03:04:22', '2019-10-25 20:01:40'),
(27, '2133313213213', 1, 'ลูฟี่', 'หมวกฟาง', '1998-06-09', 'ปราจีนบุรี', 'ปราจีนบุรี', 1, NULL, '2133313213213.png', 2, 'test1', '5f4dcc3b5aa765d61d8327deb882cf99', '0932500929', NULL, '0', 0, '2019-10-25 19:35:32', '2019-10-29 06:59:50'),
(28, '1349900548464', 1, 'สุรเกียรติ', 'แสงกล้า', '1997-03-17', 'ff', 'ff', 1, NULL, '1349900548464.jpg', 1, 'test12', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', NULL, '0', 0, '2019-10-30 20:00:01', '2019-10-30 20:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `ds_id` int(11) NOT NULL COMMENT 'รหัสช่วงเวลา',
  `doctor_id` int(11) NOT NULL COMMENT 'รหัสหมอ',
  `ds_duration` int(11) NOT NULL COMMENT 'ช่วงเวลา',
  `ds_day` int(11) NOT NULL COMMENT 'วันที่ทำการ',
  `ds_status` int(11) DEFAULT 0 COMMENT 'สถานะการใช้งาน',
  `ds_create_date` datetime NOT NULL COMMENT 'วันที่เพิ่มข้อมูล',
  `ds_update_date` datetime NOT NULL COMMENT 'วันที่อัพเดทข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเวลาการทำงานของแพทย์';

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`ds_id`, `doctor_id`, `ds_duration`, `ds_day`, `ds_status`, `ds_create_date`, `ds_update_date`) VALUES
(1, 1, 1, 2, 1, '2019-09-27 00:00:00', '2019-09-28 00:00:00'),
(2, 1, 1, 3, 0, '2019-09-27 00:00:00', '2019-09-28 00:00:00'),
(3, 1, 1, 1, 0, '2019-09-27 00:00:00', '2019-09-28 00:00:00'),
(4, 1, 2, 3, 0, '2019-09-27 00:00:00', '2019-09-28 00:00:00'),
(10, 1, 2, 4, 0, '2019-09-27 00:00:00', '2019-09-27 00:00:00'),
(11, 2, 1, 2, 0, '2019-09-27 00:00:00', '2019-09-27 00:00:00'),
(12, 2, 2, 5, 0, '2019-09-27 00:00:00', '2019-09-27 00:00:00'),
(14, 1, 1, 6, 0, '2019-09-28 01:32:55', '2019-09-28 01:32:55'),
(15, 1, 2, 5, 0, '2019-09-28 01:33:17', '2019-09-28 01:33:17'),
(16, 1, 1, 4, 0, '2019-09-28 01:35:02', '2019-09-28 01:35:02'),
(17, 1, 2, 7, 1, '2019-09-28 13:20:02', '2019-09-28 13:20:02'),
(22, 1, 1, 3, 1, '2019-09-28 13:47:09', '2019-09-28 13:47:09'),
(23, 1, 2, 5, 1, '2019-10-23 02:58:49', '2019-10-23 02:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `out_patient`
--

CREATE TABLE `out_patient` (
  `op_id` int(11) NOT NULL COMMENT 'รหัสซักประวัติ',
  `p_id` int(11) NOT NULL COMMENT 'รหัสคนไข้',
  `per_id` int(11) NOT NULL COMMENT 'รหัสพยาบาล',
  `doctor_id` int(11) DEFAULT NULL COMMENT 'รหัสหมอ',
  `professions_id` int(11) NOT NULL COMMENT 'รหัสประเภทวิชาชีพ(ตรวจในแผนกอะไร)',
  `op_detail_sick` text NOT NULL COMMENT 'อาการป่วย',
  `op_body_temp` int(11) NOT NULL COMMENT 'อุณหภูมิร่างกาย',
  `op_height` int(11) NOT NULL COMMENT 'ส่วนสูง',
  `op_weight` int(11) NOT NULL COMMENT 'น้ำหนัก',
  `op_food_allergy` text NOT NULL COMMENT 'อาหารที่แพ้',
  `op_drugs_allergy` text NOT NULL COMMENT 'ยาที่แพ้',
  `op_cd` text NOT NULL COMMENT 'โรคประจำตัว',
  `op_bp` int(11) NOT NULL COMMENT 'ความดันโลหิต',
  `op_suggestion` text DEFAULT NULL COMMENT 'ข้อเสนอแนะ',
  `op_dispense` text DEFAULT NULL COMMENT 'ยาที่จ่ายในการตรวจ',
  `op_mark_date` date DEFAULT NULL COMMENT 'นัดหมายคิว',
  `op_status` int(11) DEFAULT 0 COMMENT 'แบปกติหรือนัดหมายคิว',
  `op_create_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สร้างข้อมูล',
  `op_update_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่อัพเดทข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `out_patient`
--

INSERT INTO `out_patient` (`op_id`, `p_id`, `per_id`, `doctor_id`, `professions_id`, `op_detail_sick`, `op_body_temp`, `op_height`, `op_weight`, `op_food_allergy`, `op_drugs_allergy`, `op_cd`, `op_bp`, `op_suggestion`, `op_dispense`, `op_mark_date`, `op_status`, `op_create_date`, `op_update_date`) VALUES
(11, 2, 1, 1, 1, 'ป่วย ฮ้อดๆ แอ็ดๆ', 28, 165, 85, 'ไม่มี', 'ไม่มี', 'ไม่มี', 125, NULL, NULL, NULL, 0, '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(12, 1, 1, 1, 1, 'รายละเอียด', 28, 175, 79, 'ไม่มี', 'ไม่มี', 'หอบหืด', 125, 'คำแนะนำ', 'ยาที่จ่าย', '2019-10-25', 0, '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(13, 1, 1, 2, 3, 'รายละเอียด ทดสอบ', 30, 175, 79, 'ไม่มี', 'ไม่มี', 'หอบหืด', 125, NULL, NULL, NULL, 0, '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(14, 20, 1, 1, 1, 'ทดสอบ', 33, 171, 72, 'ไม่มี', 'ไม่มี', 'ไม่มี', 72, NULL, NULL, NULL, 0, '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(15, 1, 1, 1, 1, 'รายละเอียด', 28, 128, 79, 'ไม่มี', 'ไม่มี', 'หอบหืด', 80, 'คำแนะนำ', 'ยาที่จ่าย', NULL, 0, '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(16, 1, 1, 1, 1, 'รายละเอียด', 28, 176, 79, 'ไม่มี', 'ไม่มี', 'หอบหืด', 80, 'คำแนะนำ', '', NULL, 0, '2019-11-06 06:55:19', '2019-11-06 06:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `p_id` int(11) NOT NULL COMMENT 'รหัสคนไข้',
  `p_idcard` varchar(13) NOT NULL COMMENT 'เลขประจำตัวประชาชน/หนังสือเดินทาง',
  `vopd_id` text DEFAULT NULL COMMENT 'รหัสบัตร OPD ',
  `prefix_id` int(11) NOT NULL COMMENT 'คำนำหน้า',
  `p_name` text NOT NULL COMMENT 'ชื่อ-สกุล',
  `p_lname` text NOT NULL COMMENT 'นามสกุล',
  `p_birthday` date NOT NULL COMMENT 'วัน/เดือน/ปีเกิด',
  `p_old_address` text NOT NULL COMMENT 'ที่อยู่ตามทะเบียนบ้าน',
  `p_address` text NOT NULL COMMENT 'ที่อยู่ตามทะเบียนบ้าน',
  `dep_id` int(11) DEFAULT NULL COMMENT 'รหัสแผนก/ตำแหน่ง',
  `p_blood` varchar(5) NOT NULL COMMENT 'กรุ๊ปเลือด',
  `p_tel` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `p_password` varchar(50) NOT NULL COMMENT 'รหัสผ่าน',
  `p_create_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สร้างข้อมูล',
  `p_update_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่อัพเดทข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางคนไข้';

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`p_id`, `p_idcard`, `vopd_id`, `prefix_id`, `p_name`, `p_lname`, `p_birthday`, `p_old_address`, `p_address`, `dep_id`, `p_blood`, `p_tel`, `p_password`, `p_create_date`, `p_update_date`) VALUES
(1, '1349900844772', 'VO0819865283', 1, 'สุรเกียรติ', 'แสงกล้า', '1997-03-18', 'Ubon Ratchathani', 'Prachin', 1, 'O', '0958397716', '5f4dcc3b5aa765d61d8327deb882cf99', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(2, '1580600064541', 'VO0819423651', 1, 'ธนศักดิ์', 'พุทธรักษา', '1998-06-09', '25/1458 ลาดพร้าว101 แขวงคลองจั่น เขตบางกะปิ กทม. 10240', '25/1458 ลาดพร้าว101 แขวงคลองจั่น เขตบางกะปิ กทม. 10240', 1, 'O', '0958397716', '0', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(15, '1515154545155', 'VO0819835251', 1, 'สกร', 'สะอาด', '1999-06-18', 'มพจ', 'มพจ', 4, 'AB', NULL, '0', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(16, '5645644564546', 'VO0819835354', 1, 'หูดำ', 'หม้ออะดิ', '1998-02-04', 'มจพ', 'มจพ', 3, 'A', NULL, '0', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(17, '1236498749464', 'VO0819627904', 3, 'TEST A', 'TEST A', '1997-03-17', 'Ubon Ratchathani', 'Prachinburi', 1, 'O', '1234567890', '3b5c5b4e0f57c930befba91125c00bf8', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(18, '1349900849546', 'VO0919299642', 1, 'สุรเกียรติ', 'แสงกล้าอีกที', '1997-03-17', 'test', 'test', 3, 'O', NULL, '3b5c5b4e0f57c930befba91125c00bf8', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(19, '1234545454545', 'VO1219586367', 1, 'สมศักดิ์', 'ศรีสุรุ', '1992-12-06', '77 มีสุข ', '77 มีสุข ', 4, 'B', NULL, '9beead6cbcd5bf52bfa03126ebe2e7b2', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(20, '2312121512121', 'VO2719418923', 1, 'สมคิส', 'สมคิส', '1999-06-18', 'ปราจีรบุรี', 'ปราจีรบุรี', 3, 'O', NULL, '8820aaae59092422af5968d4bd84635b', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(21, '1349900844775', 'VO2819359376', 1, 'ธนชัย', 'แสงกล้า', '1996-03-17', 'Ubon Ratchathani', 'Prachinburi', 1, 'A', '0958397716', 'c6ed40fbe284b5a6e7a0ce9edc794d8b', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(23, '1349900844336', 'VO2519415624', 5, 'ทดสอบระบบ', 'ทดสอบระบบ', '1998-03-17', 'Ubon', 'prachin', 1, 'O', '0958397716', 'aca825344b168e22d4f76d742a99db00', '2019-11-06 06:55:19', '2019-11-06 06:55:19'),
(24, '1212122121211', 'VO2519368088', 1, 'สมศักดิ์', 'นำมล', '1994-02-16', 'ปราจีนบุรี', 'ปราจีนบุรี', 1, 'O', '0951213213', '0b17c70ccd3f9fa46508d3c82115950f', '2019-11-06 06:55:19', '2019-11-06 06:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_central`
--

CREATE TABLE `personal_central` (
  `per_id` int(11) NOT NULL COMMENT 'รหัสพนักงานส่วนกลาง',
  `per_idcard` varchar(13) DEFAULT NULL COMMENT 'รหัสบัตรประชาชน',
  `prefix_id` int(11) NOT NULL COMMENT 'รหัสคำนำหน้า',
  `per_fname` text NOT NULL COMMENT 'ชื่อ',
  `per_lname` text NOT NULL COMMENT 'นามสกุล',
  `per_birthday` date NOT NULL COMMENT 'วัน/เดือน/ปีเกิด',
  `per_old_address` text NOT NULL COMMENT 'ที่อยู่ตามทะเบียนบ้าน',
  `per_address` text NOT NULL COMMENT 'ที่อยู่ปัจจุบัน',
  `professions_id` int(11) NOT NULL COMMENT 'รหัสประเภทวิชาชีพ',
  `per_file_profess` varchar(50) DEFAULT NULL COMMENT 'ไฟล์ข้อมูลวิชาชีพ',
  `per_img` varchar(50) DEFAULT NULL COMMENT 'รูปพยาบาล',
  `per_username` text NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `per_password` text NOT NULL COMMENT 'รหัสผ่าน',
  `per_tel` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `per_status` varchar(5) NOT NULL DEFAULT '0' COMMENT 'สถานะการใช้งาน',
  `per_activate` int(11) DEFAULT 0 COMMENT 'ยืนยันการใช้งานพยาบาล',
  `per_create_date` datetime NOT NULL COMMENT 'วันที่สร้างข้อมูล',
  `per_update_date` datetime NOT NULL COMMENT 'สันที่อัพเดทข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางพนักงานส่วนกลาง';

--
-- Dumping data for table `personal_central`
--

INSERT INTO `personal_central` (`per_id`, `per_idcard`, `prefix_id`, `per_fname`, `per_lname`, `per_birthday`, `per_old_address`, `per_address`, `professions_id`, `per_file_profess`, `per_img`, `per_username`, `per_password`, `per_tel`, `per_status`, `per_activate`, `per_create_date`, `per_update_date`) VALUES
(1, '1234567890', 2, 'นามสมมุติ', 'สมมุติด้วย', '1996-08-20', 'Ubon Ratchathani', 'Prachin', 2, '1234567890.jpg', '1234567890.jpg', 'pc1', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', '0', 2, '2019-08-29 00:00:00', '2019-10-30 15:26:28'),
(2, '0987654321', 3, 'หญิงหญิง', 'จ้าาาาาา', '1995-08-20', 'Ubon Ratchathani', 'Prachin', 2, '', NULL, 'pc2', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, '0', 1, '2019-08-29 00:00:00', '2019-08-29 00:00:00'),
(3, '1349900844772', 1, 'สุรเกียรติ', 'แสงกล้า', '1996-10-27', 'Ubon', 'Prachin', 4, '1349900844772.jpg', '1349900844772.jpg', 'testsystem', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', '0', 1, '2019-10-27 00:03:59', '2019-10-27 18:50:55'),
(4, '0987654321555', 1, 'ทดสอบระบบ', 'ครั้งสุดท้าย', '1996-03-17', 'Ubon', 'Prachin', 1, '0987654321555.jpg', '0987654321555.jpg', 'test', '5f4dcc3b5aa765d61d8327deb882cf99', '0958397716', '1', 2, '2019-10-27 21:29:29', '2019-10-28 01:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE `prefix` (
  `prefix_id` int(11) NOT NULL COMMENT 'คำนำหน้า',
  `prefix_name` varchar(10) NOT NULL COMMENT 'ชื่อคำนำหน้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='คำนำหน้า';

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`prefix_id`, `prefix_name`) VALUES
(1, 'นาย'),
(2, 'นางสาว'),
(3, 'นาง'),
(4, 'ด.ช.'),
(5, 'ด.ญ.'),
(6, 'ทพ.'),
(7, 'ทพญ.'),
(8, 'นพ'),
(9, 'พญ.'),
(10, 'ดร.'),
(11, 'ผศ.'),
(12, 'รศ.'),
(13, 'ศ.'),
(14, '	สวญ.');

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `professions_id` int(11) NOT NULL COMMENT 'รหัสประเภทวิชาชีพ',
  `professions_name` text NOT NULL COMMENT 'ชื่อประเภทวิชาชีพ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ประเภทวิชาชีพ';

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`professions_id`, `professions_name`) VALUES
(1, 'เวชกรรมฟื้นฟู'),
(2, 'ศัลยกรรม กระดูก'),
(3, 'หู คอ จมูก'),
(4, 'อายุรกรรม'),
(5, 'ศัลยกรรม'),
(6, 'กุมารเวชกรรม'),
(7, 'โรคมะเร็ง'),
(8, 'โรคหืด'),
(9, 'โรคเบาหวาน'),
(10, 'วัณโรค'),
(11, 'โรคผิวหนัง/โรคเรื้อน'),
(12, 'โรคไต');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliation`
--
ALTER TABLE `affiliation`
  ADD PRIMARY KEY (`affiliation_id`),
  ADD KEY `affiliation_id` (`affiliation_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_id` (`booking_id`,`op_id`,`doctor_id`),
  ADD KEY `op_id` (`op_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`),
  ADD KEY `dep_id` (`dep_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `prefix_id` (`prefix_id`),
  ADD KEY `professions_id` (`professions_id`,`affiliation_id`),
  ADD KEY `affiliation_id` (`affiliation_id`),
  ADD KEY `doctor_idcard` (`doctor_idcard`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`ds_id`),
  ADD KEY `ds_id` (`ds_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `out_patient`
--
ALTER TABLE `out_patient`
  ADD PRIMARY KEY (`op_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `professions_id` (`professions_id`),
  ADD KEY `per_id` (`per_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_idcard` (`p_idcard`),
  ADD KEY `prefix_id` (`prefix_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `dep_id` (`dep_id`) USING BTREE;

--
-- Indexes for table `personal_central`
--
ALTER TABLE `personal_central`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `professions_id` (`professions_id`),
  ADD KEY `prefix_id` (`prefix_id`),
  ADD KEY `per_id` (`per_id`,`prefix_id`) USING BTREE,
  ADD KEY `per_idcard` (`per_idcard`);

--
-- Indexes for table `prefix`
--
ALTER TABLE `prefix`
  ADD PRIMARY KEY (`prefix_id`),
  ADD KEY `prefix_id` (`prefix_id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`professions_id`),
  ADD KEY `professions_id` (`professions_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliation`
--
ALTER TABLE `affiliation`
  MODIFY `affiliation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสังกัดโรงบาล', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการจอง', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสแผนก', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหมอ', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `ds_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสช่วงเวลา', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `out_patient`
--
ALTER TABLE `out_patient`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสซักประวัติ', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคนไข้', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_central`
--
ALTER TABLE `personal_central`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงานส่วนกลาง', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prefix`
--
ALTER TABLE `prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'คำนำหน้า', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `professions_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทวิชาชีพ', AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `out_patient` (`op_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_3` FOREIGN KEY (`professions_id`) REFERENCES `professions` (`professions_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_ibfk_4` FOREIGN KEY (`affiliation_id`) REFERENCES `affiliation` (`affiliation_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_ibfk_5` FOREIGN KEY (`prefix_id`) REFERENCES `prefix` (`prefix_id`) ON UPDATE CASCADE;

--
-- Constraints for table `out_patient`
--
ALTER TABLE `out_patient`
  ADD CONSTRAINT `out_patient_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `patient` (`p_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `out_patient_ibfk_2` FOREIGN KEY (`professions_id`) REFERENCES `professions` (`professions_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `out_patient_ibfk_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`prefix_id`) REFERENCES `prefix` (`prefix_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON UPDATE CASCADE;

--
-- Constraints for table `personal_central`
--
ALTER TABLE `personal_central`
  ADD CONSTRAINT `personal_central_ibfk_1` FOREIGN KEY (`professions_id`) REFERENCES `professions` (`professions_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_central_ibfk_2` FOREIGN KEY (`prefix_id`) REFERENCES `prefix` (`prefix_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
