-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2014 at 12:33 PM
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
  `bank_phone` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `bank_address`, `bank_phone`, `city_id`) VALUES
(1, 'HBL', 'Barket Market', '03349688514', 1),
(2, 'Alfalah', 'Main Market', '03336969693', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`bank_account_id`, `account_no`, `account_type`, `bank_id`) VALUES
(1, '5423423542345', 'Saving', 2),
(2, '5000987654', 'Current', 1),
(3, '112233445566', 'Saving', 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaign_id`, `campaign_name`, `campaign_code`, `campaign_type`, `status`, `remarks`) VALUES
(1, 'Spring 2014', 'S 2014', 'Spring', 'open', 'This is test campaign'),
(2, 'Fall 2014', 'F14', 'Fall', 'open', 'This is Fall 2014 '),
(3, 'tesxt', 'tsetq', 'spring', 'closed', '555'),
(4, 'JJ', 'JJ', 'JJ', 'closed', 'JJ'),
(5, 'Auntum 2014', 'Aunt-14', 'Auntum', 'open', 'This is new campaign');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

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
(25, 'Jhang Campus', 'JNG', 22),
(29, 'Bagdad-ul-Jadeed', 'BGD', 20);

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
(28, 'Karachi'),
(31, 'Lodhran');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(18) unsigned NOT NULL AUTO_INCREMENT,
  `compaign_id` int(11) unsigned NOT NULL,
  `form_no` varchar(255) NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
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
  `present_city_id` int(11) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `permanent_city_id` int(11) NOT NULL,
  `guardian_name` varchar(160) NOT NULL,
  `guardian_relation` varchar(120) NOT NULL,
  `guardian_occupation` varchar(180) NOT NULL,
  `guardian_designation` varchar(150) NOT NULL,
  `guardian_address` varchar(255) NOT NULL,
  `guardian_city_id` int(11) DEFAULT NULL,
  `guardian_phone` int(11) NOT NULL,
  `guardian_mobile` int(11) unsigned NOT NULL,
  `guardian_income` int(11) unsigned NOT NULL,
  `emergency_contact_name` varchar(180) NOT NULL,
  `emergency_contact_relation` varchar(180) NOT NULL,
  `emergency_contact_address` varchar(255) NOT NULL,
  `emergencay_city_id` int(11) DEFAULT NULL,
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
  `campus_id` int(11) unsigned NOT NULL,
  `form_submit_date` date NOT NULL,
  `inquiry_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `compaign_id`, `form_no`, `program_id`, `student_name`, `father_name`, `gender`, `marital_status`, `dob`, `shift`, `nationality`, `religion`, `nic_no`, `mobile`, `email`, `present_address`, `present_city_id`, `permanent_address`, `permanent_city_id`, `guardian_name`, `guardian_relation`, `guardian_occupation`, `guardian_designation`, `guardian_address`, `guardian_city_id`, `guardian_phone`, `guardian_mobile`, `guardian_income`, `emergency_contact_name`, `emergency_contact_relation`, `emergency_contact_address`, `emergencay_city_id`, `emergency_contact_phone`, `emergency_contact_mobile`, `kinship_name`, `kinship_relation`, `kinship_program`, `kinship_rollno`, `kinship_session`, `previous_qualification`, `previous_institute`, `previous_rollno`, `previous_subjects`, `previous_total_marks`, `previous_obtained_marks`, `previous_grade`, `previous_degree_year`, `operator_id`, `campus_id`, `form_submit_date`, `inquiry_id`) VALUES
(1, 0, 'Form-123', 1, 'Tariq Mayo', 'Muhammad Yaqoob', 'male', 'Single', '1985-01-21', 'Morning', 'Pakistani', 'Islam', 4294967295, 3349688514, 'tariq_mayo12@yahoo.com', 'Johar Town', 1, 'Shahdra', 30, 'Muhammad Yaqoob', 'Father', 'Teaching', 'PST', 'Shahdra', 21, 987654321, 4294967295, 35000, 'Muhammad Tahir', 'Brother', 'shahdra', 30, 2342423, 4294967295, '', '', '', 0, 0, 'Mcs', '2', 4, '1', 850, 703, '1', 1, 0, 0, '2014-03-10', 0),
(2, 0, 'Form-1234', 4, 'zohaib yunis', 'Muhammad ', 'male', 'Single', '2020-11-10', 'Morning', 'Pakistani', 'Islam', 4294967295, 3349688514, 'tariq_mayo12@yahoo.com', 'Johar Town', 18, 'Shahdra', 12, 'Muhammad Yaqoob', 'Father', 'Teaching', '', 'Shahdra', 1, 987654321, 4294967295, 35000, 'Muhammad Tahir', 'Brother', 'shahdra', 12, 0, 4294967295, '', '', '', 0, 0, 'Mcs', '3', 4, '1', 850, 703, '2', 1, 0, 0, '2014-03-11', 0);

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
  `campaign_id` int(16) unsigned NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`inquiry_id`, `inquiry_no`, `campaign_id`, `name`, `contact`, `phone`, `program_id`, `shift`, `gender`, `qualification`, `obtained_marks`, `reference_id`, `inquiry_type`, `previous_institute`, `remarks`, `operator_id`, `campus_id`, `inquiry_date`) VALUES
(1, 'LHR-14-2018', 2, 'Tariq Mayo', 3016506016, 3349688514, 3, 'Morning', 'male', 'MCS', 76, 2, 'Physical', 1, 'This is test campaign', '1', 1, '2014-03-10'),
(2, 'LHR-14-16', 1, 'Tariq Mayo', 3016506016, 3349688514, 1, 'Weekend', 'male', 'MCS', 76, 2, 'Physical', 1, 'This is test Inquiry', '1', 1, '2014-03-05'),
(3, 'LHR-14-150', 5, 'Tariq ', 3016506016, 3349688514, 3, 'Morning', 'male', 'MCS', 76, 2, 'Physical', 2, 'This is test campaign', '1', 1, '2014-03-01'),
(4, 'LHR-14-2018', 1, 'Tariq Mayo', 3016506016, 3349688514, 10, 'Morning', 'male', 'asdfasdfsaf', 111, 12, 'Telephonic', 2, '111', '1', 1, '2014-03-12');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=238 ;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`institute_id`, `institute_name`, `city_id`) VALUES
(2, 'FC College', 1),
(3, 'The  Superior College', 1),
(4, 'Govt High School Sargodha', 2),
(5, 'APWA College for Women', 1),
(6, 'City College Lahore', 1),
(7, 'Diyal Singh College', 1),
(8, 'Don Bosco College', 1),
(9, 'Gates College', 1),
(10, 'Government College Boys Gulberg Lahore', 1),
(11, 'Government College of Science, Wahdat Road, Lahore.', 1),
(12, 'Government Degree College Badamibagh', 1),
(13, 'Government Degree College Batapur', 1),
(14, 'Government Degree College Gulberg', 1),
(15, 'Government Degree College Harbanspura', 1),
(16, 'Government Degree College Iqbal Town', 1),
(17, 'Government Degree College Johar Town', 1),
(18, 'Government Degree College Mozang', 1),
(19, 'Government Degree College Mustafa Town', 1),
(20, 'Government Degree College of Raiwind for Boys', 1),
(21, 'Government Degree College of Raiwind for Girls', 1),
(22, 'Government Degree College Samanabad for Girls', 1),
(23, 'Government Degree College Samanabad for Boys', 1),
(24, 'Government Degree College Shadbagh', 1),
(25, 'Government Degree College Township', 1),
(26, 'Gulberg College for Women', 1),
(27, 'Divisional Public School & College, Lahore', 1),
(28, 'Divisional Public School & College, Faisalabad', 4),
(29, 'Kinnard College for Women', 1),
(30, 'Lahore College for Women', 1),
(31, 'MAO College', 1),
(32, 'Punjab Group of Colleges', 1),
(33, 'Quaid-e-Azam College', 1),
(34, 'Queen Mary College', 1),
(35, 'Others', 9),
(36, 'Others', 1),
(37, 'Others', 4),
(38, 'Others', 2),
(39, 'Others', 6),
(40, 'Others', 5),
(41, 'Others', 3),
(42, 'University of Sargodha', 2),
(43, 'Govt. Ambala Muslim College Sargodha', 2),
(44, 'Govt. Commerce College Sargodha', 2),
(45, 'Govt Poly Technical College Sargodha', 2),
(46, 'Army Public School Sargodha', 2),
(47, 'P.A.F Mushaf Fazaia Inter College Sargodha', 2),
(49, 'Punjab College Sargodha', 2),
(50, 'ILM College Sargodh', 2),
(51, 'Acme College Sargodha', 2),
(52, 'Progressive Public College Sargodha', 2),
(53, 'Suffah Girls College Sargodha', 2),
(54, 'The Superior College Sargodha', 2),
(55, 'Superior Science College Sargodha', 2),
(56, 'ITM College Sargodha', 2),
(57, 'Shiblee College of Commerce Sargodha', 2),
(58, 'Hi-Aims College of Commerce Sargodha', 2),
(59, 'Degree College Farooq Colony Sargodha', 2),
(60, 'Degree College Chandni Chowk Sargodha', 2),
(61, 'Iqra Girls College Sargodha', 2),
(62, 'IMATS Sargodha', 2),
(63, 'British Educational System Sargodha', 2),
(64, 'Sargodha Poly Technical College Sargodha', 2),
(65, 'Pakistan Poly Technical College Sargodha', 2),
(66, 'Hira Poly Technical College Sargodha', 2),
(68, 'Punjab College', 7),
(69, 'Central College Multan ', 7),
(70, 'Govt Emerson College', 7),
(71, 'The Superior College', 7),
(72, 'Leadwership College', 7),
(73, 'Others', 7),
(74, 'DPS Boys Okara', 6),
(75, 'Others', 8),
(76, 'Government Degree College for Girls', 8),
(78, 'Superior College', 8),
(79, 'Government Degree College for Boys', 8),
(80, 'Government Degree College for Boys', 5),
(82, 'Superior College', 4),
(83, 'Punjab College', 4),
(84, 'Government Degree College for Boys', 6),
(85, 'Government Degree College for Girls', 6),
(86, 'Superior College', 6),
(87, 'University of Education', 6),
(88, 'The Limit Group of Colleges', 6),
(89, 'ILM College', 6),
(90, 'Govt.Technical Training Institute', 6),
(91, 'Faisalabad college of Science', 4),
(92, 'Independent college,Jinnah colony', 4),
(93, 'Jaranwala College of commerce', 4),
(94, 'M.A.Jinnah college of commerce', 4),
(95, 'Pakisatan college of commerce', 4),
(96, 'Sandala College,Millat Road', 4),
(97, 'Shiblee college of commerce', 4),
(98, 'The Aims College Canal Road', 4),
(99, 'The City College of Commerce,Peoples Colony', 4),
(100, 'The Rehman College', 4),
(101, 'Compete College of Computer Science', 4),
(102, 'Divisional Model Boys College,Race Course Road', 4),
(103, 'Umair Public Boys inter college,Painsara', 4),
(104, 'Abdul Salam College For Boys', 4),
(105, 'Sir Syyed college,Jaranwala', 4),
(106, 'Saahil College Of Science & Technology', 4),
(107, 'Deans Shiblee College,Samundri', 4),
(108, 'Zia-ul-Quran Wal hadith inter College', 4),
(109, 'Quaid Colloege', 4),
(110, 'M.A.Jinnah college Sheikupura Road', 4),
(111, 'TIPS College of commerce', 4),
(112, 'Informatic computer institute ', 4),
(113, 'ITHM college', 4),
(114, 'Sammundre college of commerce', 4),
(115, 'City college of commerce', 4),
(116, 'Al-Falah Grammar Higher Secondary School', 4),
(117, 'Rachna Education System for boys Mureedwala', 4),
(118, 'Leeds college of commerce', 4),
(119, 'Axis College', 4),
(120, 'Shaheen Boys higher secondary school', 4),
(121, 'Icon College of commerce sadat park Jhumara road', 4),
(122, 'Angles higher secondary school,Canal road,Faisal town', 4),
(123, 'Globel higher secondary school chak jhumara', 4),
(124, 'Crescent Community higher secondary  school ', 4),
(125, 'Govt.College Jaranwala', 4),
(126, 'Govt.College Samundri', 4),
(127, 'Govt.College of Science', 4),
(128, 'Govt.College University', 4),
(129, 'Govt.College Samanabad', 4),
(130, 'Govt.College Satiana Road', 4),
(131, 'Govt. Islamia College', 4),
(132, 'Govt.Municipal Degree College', 4),
(133, 'Govt.Higher Secondary School, Chak Jhumara', 4),
(134, 'Govt Millat Degree College,Ghulam Muhammad Abad', 4),
(135, 'Govt.Muslim Inter College', 4),
(136, 'Govt.Sabria Sirajia Higher Secondary School', 4),
(137, 'Sacred Angles girls Higher Secondary school', 4),
(138, 'Community Girls Higher Secondary school', 4),
(139, 'Aziz Fatima College for Women', 4),
(140, 'Sheri college for women', 4),
(141, 'University college for women ', 4),
(142, 'Fatima Jinnah Degree college for women', 4),
(143, 'Independent college for women Jinnah colony', 4),
(144, 'Jaranwala college of commerce for women', 4),
(145, 'Mehran college for women Mureedwala', 4),
(146, 'Muhammad Ali Tariq girls college Jaranwala', 4),
(147, 'Rachna college for women Mureedwala', 4),
(148, 'The webster college for women Awagat', 4),
(149, 'Perfect college for women millat chowk ', 4),
(150, 'Govt. College Multan ', 7),
(151, 'Govt. College Civil Lines, ', 7),
(152, 'Govt. Willayat Hussain Islamai Degree College', 7),
(153, 'Govt. Millat College ', 7),
(154, 'Govt. College of Science ', 7),
(155, 'Govt. Alamdar Hussain Islamia Degree College ', 7),
(156, 'Govt. College for Women', 7),
(157, 'Govt. Degree College, Shujabad', 7),
(158, 'Govt. College of Education', 7),
(159, 'The National College ', 7),
(160, 'Central College for Girls Bosan Road', 7),
(161, 'Nishat College of Science ', 7),
(162, 'Aligarh College for Girls ', 7),
(163, 'Multan Public School & College', 7),
(164, 'La Salle Higher Secondary School', 7),
(165, 'Sir Syed College of Commerce ', 7),
(166, 'Global College of Computer Sciences', 7),
(167, 'Scholars College ', 7),
(168, 'Multan College of Commerce ', 7),
(169, 'Punjab College for Women', 7),
(170, 'Chenab College', 7),
(171, 'Zakariya College of Commerce', 7),
(172, 'Punjab College of Commerce', 7),
(173, 'Allama Iqbal College of Commerce & Management', 7),
(174, 'Punjab College of Information Technology', 7),
(175, 'Rise College ', 7),
(176, 'The Central Degree College (Regd) Bosan Road', 7),
(177, 'Girls Public College', 7),
(178, 'The Educators College Zaid campus', 7),
(179, 'Joint Forces Cadet H/S/S, Bosan Road', 7),
(180, 'Multan Institute of management Science', 7),
(181, 'Science Spectrum Girls Degree College', 7),
(182, 'Fort Public Girls Higher Secondary School', 7),
(183, 'International College of Commerce', 7),
(184, 'Becon College ', 8),
(185, 'Nicass College', 8),
(186, 'Nice College', 8),
(187, 'Ali Garh College', 8),
(188, 'Prime College', 8),
(189, 'MTB College', 8),
(190, 'Bismillah College', 8),
(191, 'Iqra College', 8),
(192, 'TT College', 8),
(193, 'Central College', 8),
(194, 'Higher Secondary School - Tranada Swayen Khan', 8),
(195, 'Higher Secondary School - Kot Samaba', 8),
(196, 'Higher Secondary School - Feroza', 8),
(197, 'Higher Secondary School - Zaher Peer', 8),
(198, 'Army Public School', 8),
(199, 'Sheikh Zayed School', 8),
(200, 'Behria Foundation', 8),
(201, 'Govt. College For Women South City', 6),
(202, 'Govt. M.C High School', 6),
(203, 'Govt. Sutlej Boys High School ', 6),
(204, 'Govt. Islamia High School ', 6),
(205, 'Govt Model Girls High School ', 6),
(206, 'F.G PublicHigh School', 6),
(207, 'F.G Girls High School', 6),
(208, 'Punjab Science High School ', 6),
(209, 'Suffa Education Complex ', 6),
(210, 'Falcon Public High School ', 6),
(211, 'Christ Church High School ', 6),
(212, 'Convent High School ', 6),
(213, 'School of Management & Technology ', 6),
(214, 'Govt. Boys. Degree College Depalpur', 6),
(215, 'Govt. College For Women Depalpur', 6),
(216, 'Govt High School Depalpur', 6),
(217, 'A.R Secondary School Of Science ', 6),
(218, 'Govt. High School Bhooman Shah', 6),
(219, 'Govt. High School No.1 Havaili Lakha', 6),
(220, 'Govt. Girls High School No.1 Havaili Lakha', 6),
(221, 'Al-Mansoor Public School Bhooman Shah', 6),
(222, 'Others', 20),
(223, 'Others', 14),
(224, 'Others', 12),
(225, 'Others', 18),
(226, 'Others', 15),
(227, 'Others', 11),
(229, 'Others', 13),
(230, 'Others', 16),
(231, 'Others', 10),
(232, 'Others', 19),
(233, 'Others', 21),
(234, 'Others', 17),
(235, 'Others', 22),
(236, 'GC university', 1),
(237, 'GC university', 1);

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
  `program_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_name` varchar(255) NOT NULL,
  `program_code` varchar(255) NOT NULL,
  `no_of_semesters` int(11) unsigned NOT NULL,
  `program_type` varchar(255) NOT NULL,
  `program_department_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `program_code`, `no_of_semesters`, `program_type`, `program_department_id`) VALUES
(1, 'MBA (Professional)', 'MBAP', 6, 'Morning', 6),
(2, 'BBA (Hons)', 'BBAH', 8, 'Morning', 6),
(3, 'MBA Executive', 'EMBA', 5, 'Evening', 6),
(4, 'Masters in HRM', 'MHRM', 7, 'Morning', 6),
(5, 'Masters in Mass Communication Management', 'MMCM', 4, 'Morning', 6),
(6, 'BS Mass Communication Management', 'BSMC', 8, 'Morning', 6),
(7, 'BS Aviation Management', 'BSAM', 8, 'Morning', 6),
(8, 'BS Industrial Management', 'BSIM', 8, 'Morning', 6),
(9, 'BS Electrical Engineering', 'BSEE', 8, 'Morning', 7),
(10, 'BS Computer Science', 'BSCS', 8, 'Morning', 2),
(11, 'MIT (Morning)', 'MITM', 4, 'Morning', 2);

-- --------------------------------------------------------

--
-- Table structure for table `program_departments`
--

CREATE TABLE IF NOT EXISTS `program_departments` (
  `program_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_department_name` varchar(200) NOT NULL,
  PRIMARY KEY (`program_department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `program_departments`
--

INSERT INTO `program_departments` (`program_department_id`, `program_department_name`) VALUES
(2, 'Department of CS and IT'),
(3, 'Department of Law'),
(6, 'Department of Business and Management Sciences'),
(7, 'Department of Engineering and Technology'),
(8, 'Department of Economics and Commerce'),
(9, 'Department of Medical and Health Sciences'),
(10, 'Department of Accountancy'),
(12, 'Department of Pharmacy');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section`) VALUES
(1, 'Morning'),
(2, 'EveninG'),
(3, 'Weekend');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session`, `session_type`) VALUES
(1, '2014-16', 'Fall'),
(2, '2014-2018', 'Auntum'),
(3, '2014-2019', 'Khazan'),
(4, '2010-2019', 'Fall'),
(5, '2010-2019', 'Fall');

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
  `form_no` varchar(200) NOT NULL,
  `roll_no` varchar(200) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `enrolled_semester_id` int(11) NOT NULL,
  `current_semester_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `form_id`, `form_no`, `roll_no`, `session_id`, `section_id`, `enrolled_semester_id`, `current_semester_id`) VALUES
(1, 1, 'Form-123', 'MCS04', 5, 2, 1, 4),
(2, 2, 'Form-1234', 'MCS04', 4, 2, 1, 1);

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
