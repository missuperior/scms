-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2014 at 03:14 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sserp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_departments`
--

CREATE TABLE IF NOT EXISTS `admin_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `campus_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin_departments`
--


-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'Superior', 'f865b53623b121fd34ee5426c792e5c33af8c227');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `bank_phone` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `banks`
--


-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_no` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `bank_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bank_accounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(160) NOT NULL,
  `campaign_code` varchar(100) NOT NULL,
  `campaign_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `campaign`
--


-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `campus_id` int(11) NOT NULL AUTO_INCREMENT,
  `campus_name` varchar(255) NOT NULL,
  `campus_code` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`campus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campus_id`, `campus_name`, `campus_code`, `city_id`) VALUES
(1, 'Main Campus', 'LHR', 1),
(2, 'Sargodha Campus', 'SGD', 2),
(3, 'University Campus', 'UNI', 1),
(4, 'Law Campus', 'Law', 1),
(5, 'Faisalabad Campus', 'FSD', 4),
(6, 'Gujranwala Campus', 'GUJ', 5),
(7, 'Multan Campus', 'MTN', 7),
(8, 'Okara Campus', 'OKA', 6),
(9, 'RYK Campus', 'RYK', 8),
(10, 'Sialkot Campus', 'SKT', 3),
(11, 'Girls Campus', 'GCL', 1),
(12, 'Accountancy Campus', 'SCA', 1),
(13, 'Burewala Campus', 'BRW', 20),
(14, 'Daska Campus', 'DSK', 12),
(15, 'Depalpur Campus', 'DPR', 18),
(16, 'Gujrat Campus', 'GJT', 14),
(17, 'Hafizabad Campus', 'HFD', 11),
(18, 'Jehlum Campus', 'JLM', 15),
(19, 'Khanpur Campus', 'KPR', 21),
(20, 'Pasrur Campus', 'PSR', 13),
(21, 'Pattoki', 'PTK', 17),
(22, 'Rawalpindi Campus', 'RWP', 16),
(23, 'Sahiwal Campus', 'SWL', 19),
(24, 'Sheikhupura Campus', 'SKP', 10),
(25, 'Jhang Campus', 'JNG', 22);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(150) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(1, 'Lahore'),
(2, 'Sargodha'),
(3, 'Sialkot'),
(4, 'Faisalabad'),
(5, 'Gujranwala'),
(6, 'Okara'),
(7, 'Multan'),
(8, 'Rahim Yar Khan'),
(9, 'Other'),
(10, 'Sheikhupura'),
(11, 'Hafizabad'),
(12, 'Daska'),
(13, 'Pasrur'),
(14, 'Gujrat'),
(15, 'Jehlum'),
(16, 'Rawalpindi'),
(17, 'Pattoki'),
(18, 'Depalpur'),
(19, 'Sahiwal'),
(20, 'Burewala'),
(21, 'Khanpur'),
(22, 'Jhang'),
(30, 'Bahawalpur'),
(29, 'IslamabaD'),
(28, 'Karachi');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `compaign_id` int(11) unsigned NOT NULL,
  `form_no` varchar(255) NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `nic_no` int(11) unsigned NOT NULL,
  `mobile` int(11) unsigned NOT NULL,
  `email` varchar(200) NOT NULL,
  `present_address` varchar(255) NOT NULL,
  `present_city` varchar(120) NOT NULL,
  `present_town` varchar(180) NOT NULL,
  `present_phone` int(11) unsigned NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `permanent_city` varchar(120) NOT NULL,
  `permanent_town` varchar(180) NOT NULL,
  `permanent_phone` int(11) unsigned NOT NULL,
  `guardian_name` varchar(160) NOT NULL,
  `guardian_relation` varchar(120) NOT NULL,
  `guardian_occupation` varchar(180) NOT NULL,
  `guardian_designation` varchar(150) NOT NULL,
  `guardian_address` varchar(255) NOT NULL,
  `guardian_office` varchar(255) NOT NULL,
  `guardian_mobile` int(11) unsigned NOT NULL,
  `guardian_income` int(11) unsigned NOT NULL,
  `emergency_contact_name` varchar(180) NOT NULL,
  `emergency_contact_relation` varchar(180) NOT NULL,
  `emergency_contact_address` varchar(255) NOT NULL,
  `emergency_contact_phone` int(11) unsigned NOT NULL,
  `emergency_contact_mobile` int(11) unsigned NOT NULL,
  `kinship_name` varchar(200) NOT NULL,
  `kinship_relation` varchar(180) NOT NULL,
  `kinship_program` varchar(180) NOT NULL,
  `kinship_rollno` int(11) unsigned NOT NULL,
  `kinship_session` int(11) unsigned NOT NULL,
  `previous_qualification` varchar(255) NOT NULL,
  `previous_institute` varchar(255) NOT NULL,
  `previous_rollno` int(11) unsigned NOT NULL,
  `previous_subjects` varchar(255) NOT NULL,
  `previous_total_marks` int(11) unsigned NOT NULL,
  `previous_obtained_marks` int(11) unsigned NOT NULL,
  `previous_grade` varchar(50) NOT NULL,
  `previous_degree_year` int(11) unsigned NOT NULL,
  `operator_id` int(11) NOT NULL,
  `eusr` int(11) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  `form_submit_date` date NOT NULL,
  `inquiry_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forms`
--


-- --------------------------------------------------------

--
-- Table structure for table `initial_form`
--

CREATE TABLE IF NOT EXISTS `initial_form` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `form_no` varchar(200) NOT NULL,
  `inquiry_id` int(16) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `initial_campus_id` int(11) NOT NULL,
  `submit_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `initial_form`
--


-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE IF NOT EXISTS `inquiry` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `inquiry_no` varchar(255) NOT NULL,
  `compaign_id` int(16) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` int(11) unsigned NOT NULL,
  `phone` int(11) unsigned NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `shift` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `obtained_marks` int(11) unsigned NOT NULL,
  `reference_id` int(11) unsigned NOT NULL,
  `inquiry_type` varchar(255) NOT NULL,
  `previous_institute` int(11) unsigned NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  `inquiry_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inquiry`
--


-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE IF NOT EXISTS `installments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `semester_id` int(11) unsigned NOT NULL,
  `fee` int(11) unsigned NOT NULL,
  `fine` int(11) unsigned NOT NULL,
  `additional_discount` int(11) unsigned NOT NULL,
  `payable` int(11) unsigned NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `installments`
--


-- --------------------------------------------------------

--
-- Table structure for table `obtained_marks`
--

CREATE TABLE IF NOT EXISTS `obtained_marks` (
  `id` int(11) unsigned NOT NULL,
  `sheet_id` varchar(255) NOT NULL,
  `student_id` int(11) unsigned NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `session_id` int(11) unsigned NOT NULL,
  `section_id` int(11) unsigned NOT NULL,
  `semester_id` int(11) unsigned NOT NULL,
  `subject_id` int(11) unsigned NOT NULL,
  `shift` varchar(255) NOT NULL,
  `assignment` int(11) unsigned NOT NULL,
  `presentation` int(11) unsigned NOT NULL,
  `quiz` int(11) unsigned NOT NULL,
  `project` int(11) unsigned NOT NULL,
  `paper` int(11) unsigned NOT NULL,
  `total` int(11) unsigned NOT NULL,
  `attendance` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obtained_marks`
--


-- --------------------------------------------------------

--
-- Table structure for table `operator_logins`
--

CREATE TABLE IF NOT EXISTS `operator_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin_department_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `operator_type_id` int(11) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `operator_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `operator_types`
--

CREATE TABLE IF NOT EXISTS `operator_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `operator_types`
--


-- --------------------------------------------------------

--
-- Table structure for table `paid_payments`
--

CREATE TABLE IF NOT EXISTS `paid_payments` (
  `id` int(11) unsigned NOT NULL,
  `student_id` int(11) unsigned NOT NULL,
  `installment_id` int(11) unsigned NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `semester_id` int(11) unsigned NOT NULL,
  `paid_date` date NOT NULL,
  `challan_no` int(11) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `bank_fine` int(11) unsigned NOT NULL,
  `bank_id` int(11) unsigned NOT NULL,
  `account_id` int(11) unsigned NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paid_payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prices`
--


-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(200) NOT NULL,
  `program_code` varchar(150) NOT NULL,
  `program_semesters` int(11) NOT NULL,
  `program_department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `programs`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_departments`
--

CREATE TABLE IF NOT EXISTS `program_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `program_departments`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_roadmap`
--

CREATE TABLE IF NOT EXISTS `program_roadmap` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `session_id` int(11) unsigned NOT NULL,
  `semester_id` int(11) unsigned NOT NULL,
  `shift` varchar(255) NOT NULL,
  `subject_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `program_roadmap`
--


-- --------------------------------------------------------

--
-- Table structure for table `prospectus`
--

CREATE TABLE IF NOT EXISTS `prospectus` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `inquiry_id` int(16) unsigned NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` int(11) unsigned NOT NULL,
  `quantity` int(11) unsigned NOT NULL,
  `total_price` int(11) unsigned NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prospectus`
--


-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sections`
--


-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE IF NOT EXISTS `semesters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semesters` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `semesters`
--


-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(120) NOT NULL,
  `session_type` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `session`
--


-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE IF NOT EXISTS `sheets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sheet_no` varchar(255) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `vdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sheets`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(16) unsigned NOT NULL,
  `roll_no` varchar(200) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `shift` varchar(120) NOT NULL,
  `gender` varchar(110) NOT NULL,
  `status` varchar(200) NOT NULL,
  `city_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `student_fee_package`
--

CREATE TABLE IF NOT EXISTS `student_fee_package` (
  `id` int(11) unsigned NOT NULL,
  `student_id` int(11) unsigned NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `total_semesters` int(11) unsigned NOT NULL,
  `admission` int(11) unsigned NOT NULL,
  `misc` int(11) unsigned NOT NULL,
  `semester_fee` int(11) unsigned NOT NULL,
  `discount` int(11) unsigned NOT NULL,
  `additional_discount` int(11) unsigned NOT NULL,
  `fine` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `operator_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_package`
--


-- --------------------------------------------------------

--
-- Table structure for table `total_marks`
--

CREATE TABLE IF NOT EXISTS `total_marks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sheet_id` varchar(255) NOT NULL,
  `subject_id` int(11) unsigned NOT NULL,
  `assignment` int(11) unsigned NOT NULL,
  `presentation` int(11) unsigned NOT NULL,
  `quiz` int(11) unsigned NOT NULL,
  `project` int(11) unsigned NOT NULL,
  `paper` int(11) unsigned NOT NULL,
  `total` int(11) unsigned NOT NULL,
  `term` varchar(255) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `total_marks`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
