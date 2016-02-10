-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2014 at 03:51 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sserp_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_logins`
--

CREATE TABLE IF NOT EXISTS `account_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_login_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account_logins`
--

INSERT INTO `account_logins` (`id`, `account_login_id`, `user_name`, `password`, `created_date`, `last_login`) VALUES
(1, 1, 'super_admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2014-02-24', '2014-02-24 10:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `admin_departments`
--

CREATE TABLE IF NOT EXISTS `admin_departments` (
  `admin_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `campus_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `admin_departments`
--


-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `admin_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`admin_login_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_login_id`, `username`, `password`) VALUES
(1, 'Superior', 'f865b53623b121fd34ee5426c792e5c33af8c227');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `bank_phone` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `bank_address`, `bank_phone`, `city_id`) VALUES
(1, 'Habib Bank Limited', 'Barket market Lahore', 2147483647, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `bank_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_no` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `bank_id` int(11) NOT NULL,
  PRIMARY KEY (`bank_account_id`)
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaign_id`, `campaign_name`, `campaign_code`, `campaign_type`, `status`, `remarks`) VALUES
(1, 'Spring 2014', 'S 2014', 'Spring', 'open', 'This is test campaign'),
(2, 'Fall 2014', 'F14', 'Fall', 'open', 'This is Fall 2014 '),
(3, 'tesxt', 'tsetq', 'spring', 'closed', '555'),
(4, 'kk', 'kk', 'kk', 'open', 'kkk');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

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
-- Table structure for table `employers`
--

CREATE TABLE IF NOT EXISTS `employers` (
  `employer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `dob` varchar(70) NOT NULL,
  `place_of_birth` varchar(200) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `blood_group` varchar(20) DEFAULT NULL,
  `maritial_status` varchar(50) DEFAULT NULL,
  `religion` varchar(150) DEFAULT NULL,
  `highest_qualification` varchar(200) NOT NULL,
  `cnic` varchar(150) NOT NULL,
  `employee_pic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`employer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employers`
--


-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(18) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forms`
--


-- --------------------------------------------------------

--
-- Table structure for table `gen_account_logins`
--

CREATE TABLE IF NOT EXISTS `gen_account_logins` (
  `acc_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_login` varchar(100) NOT NULL,
  `acc_password` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `account_role_id` int(11) NOT NULL,
  `acc_status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`acc_login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gen_account_logins`
--

INSERT INTO `gen_account_logins` (`acc_login_id`, `acc_login`, `acc_password`, `created_date`, `last_login`, `account_role_id`, `acc_status`) VALUES
(1, 'admin@scms.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2014-02-27', NULL, 1, 1),
(2, 'hris@scms.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2014-02-27', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gen_account_roles`
--

CREATE TABLE IF NOT EXISTS `gen_account_roles` (
  `account_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(100) NOT NULL,
  PRIMARY KEY (`account_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `gen_account_roles`
--

INSERT INTO `gen_account_roles` (`account_role_id`, `role_title`) VALUES
(1, 'Administrator'),
(2, 'HRIS'),
(3, 'Admissions'),
(4, 'Accounts'),
(5, 'Audit');

-- --------------------------------------------------------

--
-- Table structure for table `gen_sub_roles`
--

CREATE TABLE IF NOT EXISTS `gen_sub_roles` (
  `sub_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_role_title` varchar(150) NOT NULL,
  `account_role_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gen_sub_roles`
--

INSERT INTO `gen_sub_roles` (`sub_role_id`, `sub_role_title`, `account_role_id`) VALUES
(1, 'Data Entry Operator', 3),
(2, 'HRIS Administrator', 2),
(3, 'HRIS Line Adminsitrator', 2),
(4, 'Data Entry Operator', 2),
(5, 'Inquiry Officer', 3),
(6, 'Admission Officer', 3),
(7, 'Admission Incharge', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hr_departments`
--

CREATE TABLE IF NOT EXISTS `hr_departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `account_role_id` int(11) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `hr_departments`
--

INSERT INTO `hr_departments` (`department_id`, `department_name`, `account_role_id`) VALUES
(1, 'Operations', 2),
(2, 'Data Control', 2),
(3, 'Inquiry', 3),
(4, 'HR', 2),
(5, 'Prospectus Sales', 3),
(6, 'Form Submission', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hr_department_roles`
--

CREATE TABLE IF NOT EXISTS `hr_department_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `hr_department_roles`
--

INSERT INTO `hr_department_roles` (`role_id`, `department_id`, `sub_role_id`) VALUES
(1, 1, 6),
(2, 1, 7),
(3, 1, 4),
(4, 4, 2),
(5, 4, 3),
(6, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `initial_form`
--

CREATE TABLE IF NOT EXISTS `initial_form` (
  `initial_form_id` int(16) NOT NULL AUTO_INCREMENT,
  `form_no` varchar(200) NOT NULL,
  `inquiry_id` int(16) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `initial_campus_id` int(11) NOT NULL,
  `submit_date` date NOT NULL,
  PRIMARY KEY (`initial_form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `initial_form`
--


-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE IF NOT EXISTS `inquiry` (
  `inquiry_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`inquiry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inquiry`
--


-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE IF NOT EXISTS `installments` (
  `installment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`installment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `installments`
--


-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE IF NOT EXISTS `institutes` (
  `institute_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(255) NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`institute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `institutes`
--


-- --------------------------------------------------------

--
-- Table structure for table `member_logins`
--

CREATE TABLE IF NOT EXISTS `member_logins` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_login` varchar(100) NOT NULL,
  `member_password` varchar(100) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  `created_date` date DEFAULT NULL,
  `member_status` tinyint(2) DEFAULT NULL,
  `flag_check` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `member_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `obtained_marks`
--

CREATE TABLE IF NOT EXISTS `obtained_marks` (
  `obtained_marks_id` int(11) unsigned NOT NULL,
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
  PRIMARY KEY (`obtained_marks_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obtained_marks`
--


-- --------------------------------------------------------

--
-- Table structure for table `operator_logins`
--

CREATE TABLE IF NOT EXISTS `operator_logins` (
  `operator_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin_department_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `operator_type_id` int(11) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`operator_login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `operator_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `operator_types`
--

CREATE TABLE IF NOT EXISTS `operator_types` (
  `operator_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`operator_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `operator_types`
--


-- --------------------------------------------------------

--
-- Table structure for table `paid_payments`
--

CREATE TABLE IF NOT EXISTS `paid_payments` (
  `paid_payment_id` int(11) unsigned NOT NULL,
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
  PRIMARY KEY (`paid_payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paid_payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `prices_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`prices_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prices`
--


-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(200) NOT NULL,
  `program_code` varchar(150) NOT NULL,
  `program_semesters` int(11) NOT NULL,
  `program_department_id` int(11) NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `programs`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_departments`
--

CREATE TABLE IF NOT EXISTS `program_departments` (
  `program_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`program_department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `program_departments`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_roadmap`
--

CREATE TABLE IF NOT EXISTS `program_roadmap` (
  `program_roadmap_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `session_id` int(11) unsigned NOT NULL,
  `semester_id` int(11) unsigned NOT NULL,
  `shift` varchar(255) NOT NULL,
  `subject_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`program_roadmap_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `program_roadmap`
--


-- --------------------------------------------------------

--
-- Table structure for table `prospectus`
--

CREATE TABLE IF NOT EXISTS `prospectus` (
  `prospectus_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `inquiry_id` int(16) unsigned NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` int(11) unsigned NOT NULL,
  `quantity` int(11) unsigned NOT NULL,
  `total_price` int(11) unsigned NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `campus_id` int(11) unsigned NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`prospectus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prospectus`
--


-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE IF NOT EXISTS `references` (
  `reference_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reference_source` varchar(255) NOT NULL,
  PRIMARY KEY (`reference_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `references`
--

INSERT INTO `references` (`reference_id`, `reference_source`) VALUES
(2, 'Jang'),
(3, 'Cable Tv'),
(4, 'Steamers'),
(5, 'Banners'),
(6, 'Faculty / Staff'),
(7, 'Old Student'),
(8, 'Friends / Relatives'),
(9, 'Nawa-i-waqt'),
(10, 'Khabrein'),
(11, 'Express'),
(12, 'Pakistan'),
(13, 'Others'),
(14, 'Internet'),
(15, 'Goodwill'),
(16, 'The News'),
(17, 'The Nation'),
(18, 'Dawn Newspaper'),
(19, 'Principal'),
(20, 'Mobile Admission Bus'),
(21, 'e-mail'),
(22, 'live chat'),
(23, 'Education Expo'),
(24, 'SMS'),
(25, 'Old Student Self'),
(26, 'Leaflet'),
(27, 'CPS'),
(28, 'Hoarding');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(150) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section`) VALUES
(1, 'Morning'),
(2, 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE IF NOT EXISTS `semesters` (
  `semester_id` int(11) NOT NULL AUTO_INCREMENT,
  `semesters` varchar(150) NOT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semesters`) VALUES
(1, 'Semester 01'),
(2, 'Semester 02'),
(3, 'Semester 03'),
(4, 'Semester 04'),
(5, 'Semester 05'),
(6, 'Semester 06'),
(7, 'Semester 07'),
(8, 'Semester 08'),
(9, 'Semester 09'),
(10, 'Semester 10');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(120) NOT NULL,
  `session_type` varchar(80) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `session`
--


-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE IF NOT EXISTS `sheets` (
  `sheet_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sheet_no` varchar(255) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
  `vdate` date NOT NULL,
  PRIMARY KEY (`sheet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sheets`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `student_fee_package`
--

CREATE TABLE IF NOT EXISTS `student_fee_package` (
  `student_fee_pakage_id` int(11) unsigned NOT NULL,
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
  PRIMARY KEY (`student_fee_pakage_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_package`
--


-- --------------------------------------------------------

--
-- Table structure for table `temporary_accounts`
--

CREATE TABLE IF NOT EXISTS `temporary_accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `temporary_accounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `total_marks`
--

CREATE TABLE IF NOT EXISTS `total_marks` (
  `total_marks_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`total_marks_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `total_marks`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
