-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 07:01 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drcdbase`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(100) NOT NULL,
  `subsector_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activity`, `subsector_id`, `sector_id`) VALUES
(1, 'Cash for Work', 1, 1),
(2, 'Cash Relief distribution', 1, 1),
(3, 'Cash Grant', 1, 1),
(4, 'Training', 2, 1),
(5, 'Seed support', 2, 1),
(6, 'Agriculture tools support', 2, 1),
(7, 'Vocational Skills Training', 3, 1),
(8, 'Food voucher provision', 4, 1),
(9, 'Business Support', 5, 1),
(10, 'Cooperatives', 5, 1),
(11, 'Business Training', 5, 1),
(12, 'Berked Rehabilitation', 6, 2),
(13, 'Borehole Rehabilitation', 6, 2),
(14, 'Shallow Well Rehabilitation', 6, 2),
(15, 'Water Tank Distribution', 6, 2),
(16, 'Water Trucking', 6, 2),
(17, 'Water Kiosks Construction', 6, 2),
(18, 'Pipeline Laid', 6, 2),
(19, 'Elevated Tank Construction', 6, 2),
(20, 'Latrine construction', 7, 2),
(21, 'Training (Hygiene)', 8, 2),
(22, 'Sanitation tools distribution', 7, 2),
(23, 'Hygiene Promotion activities', 8, 2),
(24, 'Hygiene Kits distribution', 8, 2),
(25, 'NFI Distribution', 9, 3),
(26, 'Shelter support', 10, 3),
(27, 'Training (Protection)', 11, 4),
(28, 'GBV Support', 11, 4),
(29, 'Infrastructure Support', 11, 4),
(30, 'Returns', 11, 4),
(31, 'Community Entry', 12, 4),
(32, 'Advocacy Workshop', 12, 4),
(33, 'CSP Workshop', 12, 4),
(34, 'CSP REVIEW AND ENDORSEMENT', 12, 4),
(35, 'CSP ON SENTIZATION', 12, 4),
(36, 'CSP DEVELOPMENT', 12, 4),
(37, 'VALIDATION OF CSP', 12, 4),
(38, 'COMMUNITY POLICE DIALOGUE', 12, 4),
(39, 'CAPACITY BUILDING (CSC)', 12, 4),
(40, 'CAPACITY BUILDING (GAR-GAY)', 12, 4),
(41, 'XEER/CONFLICT MANAGEMENT', 12, 4),
(42, 'MEETING (CSC)', 12, 4),
(43, 'MEETING (EXTERNAL)', 12, 4),
(44, 'IMPLEMENTATION OF COMMUNITY SAFETY SUB-PROJECTS', 12, 4),
(45, 'GRANTS FINANCED', 12, 4),
(46, 'GRANTS COMPLETED', 12, 4),
(47, 'POLICE TRAINING NEEDS ASSESSMENT', 12, 4),
(48, 'POLICE TRAININGS', 12, 4),
(49, 'FOLLOW UP', 12, 4),
(50, 'CUSTOMARY LAW ADVOCACY', 12, 4),
(51, 'CONFLICT DRIVERS & RESPONSE', 12, 4),
(52, 'XEER DRAFTING', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `activitycategories`
--

CREATE TABLE IF NOT EXISTS `activitycategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_category` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `activitycategories`
--

INSERT INTO `activitycategories` (`id`, `activity_category`, `icon`, `organization_id`) VALUES
(1, 'Training/Capacity Building', 'trainingcapacitybuilding.png', 1),
(2, 'Events, which can be sub-grouped into Awareness Creation, Mobilization', 'mobililzation.png', 1),
(3, 'Construction/Rehabilitation', 'constructionrehabilitation.png', 1),
(4, 'Food Distribution', 'fooddistricbution.png', 1),
(5, 'NFI Distribution', 'nfidistribution.png', 1),
(6, 'Cash Distribution', 'cash_distribution.png', 1),
(7, 'Supplies', 'supplies.png', 1),
(8, 'Technical Support', 'technicalsupport.png', 1),
(9, 'Monitoring and Evaluation', 'monitoringandevaluation.png', 1),
(10, 'Assessments', 'assessments.png', 1),
(11, 'Trainings and Ceremonies/Meetings', 'trainingcapacitybuilding.png', 2),
(12, 'Construction/Rehabilitation/Installations', 'constructionrehabilitation.png', 2),
(13, 'Outdoor Events(Tournaments, debates and awareness campaigns)', 'mobililzation.png', 2),
(14, 'Distributions/Disbursement', 'nfidistribution.png', 2),
(15, 'M&E QA ', 'assessments.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `activityphotos`
--

CREATE TABLE IF NOT EXISTS `activityphotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `activityphotos`
--

INSERT INTO `activityphotos` (`id`, `caption`, `tags`, `file_name`, `file_type`, `file_size`, `projectactivity_id`, `date_added`) VALUES
(1, 'Participants in a training session', 'training,seminar,education', 'news-2storey.jpg', 'image/jpeg', '31.76', 1, '2015-04-17'),
(2, 'test', 'test', 'WhatsApp_Image_2017-08-22_at_11.45_.43_.jpeg', 'image/jpeg', '47.8', 5, '2017-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `aggregationtypes`
--

CREATE TABLE IF NOT EXISTS `aggregationtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `aggregationtypes`
--

INSERT INTO `aggregationtypes` (`id`, `type`) VALUES
(1, 'Gender'),
(2, 'Age & Gender'),
(3, 'Age');

-- --------------------------------------------------------

--
-- Table structure for table `attendancelist`
--

CREATE TABLE IF NOT EXISTS `attendancelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `project_no` varchar(100) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `training_date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `area_of_settlement` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attendancelist`
--

INSERT INTO `attendancelist` (`id`, `project_id`, `project_no`, `projectactivity_id`, `activity`, `training_date`, `name`, `sex`, `age`, `contact`, `district`, `area_of_settlement`, `organization`, `occupation`, `comments`) VALUES
(1, 1, '515-708', 3, 'Community Entry Activity in Nugaal region, Godob-Jiran district', '09/14/2016', 'Joash Gomba', 'Male', '27', '42565', 'Baki', 'Nairobi', 'DRC', 'Writer', 'None'),
(2, 1, '515-708', 3, 'Community Entry Activity in Nugaal region, Godob-Jiran district', 'xx', 'xx', 'xx', '', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx');

-- --------------------------------------------------------

--
-- Table structure for table `audittrail`
--

CREATE TABLE IF NOT EXISTS `audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `content` text NOT NULL,
  `visited_page` varchar(255) NOT NULL,
  `user_db_id` int(11) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `item_db_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `audittrail`
--

INSERT INTO `audittrail` (`id`, `username`, `ip_address`, `date_time`, `content`, `visited_page`, `user_db_id`, `controller`, `item_db_id`) VALUES
(1, 'joashgomba@gmail.com', '::1', '2017-04-24 17:17:57', 'Edited and updated the task  for the planned activity Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa under the project Police-Community Dialogue and Community Safety in Puntland.', 'rollingactionplans/edit_validate', 1, 'rollingactionplans', 1),
(2, 'joashgomba@gmail.com', '::1', '2017-04-24 17:20:28', 'Edited the activity Community Entry Activity by CS 1 Harfo Team under the project , and all its beneficiaries.', 'projectactivities/edit_validate', 1, 'projectactivities', 1),
(3, 'joashgomba@gmail.com', '::1', '2017-04-24 17:22:25', 'Edited the activity Community Entry Activity by CS 1 Harfo Team under the project Police-Community Dialogue and Community Safety in Puntland, and all its beneficiaries.', 'projectactivities/edit_validate', 1, 'projectactivities', 1),
(4, 'joashgomba@gmail.com', '::1', '2017-05-02 12:47:29', 'Added the objective JJJJJJ and its indicators for the project Providing Access to Education for Vulnerable Communities.', 'projects/objectivelogframe', 1, 'projectobjectives', 12),
(5, 'joashgomba@gmail.com', '::1', '2017-05-04 14:00:50', 'Added the objective This is a test objective and its indicators for the project Providing Access to Education for Vulnerable Communities.', 'projects/objectivelogframe', 1, 'projectobjectives', 13),
(6, 'joashgomba@gmail.com', '::1', '2017-05-04 14:03:49', 'Added the objective another objective and its indicators for the project Providing Access to Education for Vulnerable Communities.', 'projects/objectivelogframe', 1, 'projectobjectives', 14),
(7, 'joashgomba@gmail.com', '::1', '2017-05-04 14:08:42', 'Deleted the indicator some indicator for objective  under the project Providing Access to Education for Vulnerable Communities.', 'projectobjectiveindicators/deleteindicator', 1, 'projectobjectiveindicators', 30),
(8, 'joashgomba@gmail.com', '::1', '2017-05-04 14:54:59', 'Added the beneficiaryIDPs under the project Providing Access to Education for Vulnerable Communities.', 'projects/addbeneficiary', 1, 'projectbeneficiaries', 3),
(9, 'joashgomba@gmail.com', '::1', '2017-05-04 15:05:09', 'Added the following indicator(s) kk for the objective another objective under the project Providing Access to Education for Vulnerable Communities.', 'projects/addobjectiveindicators', 1, 'projectobjectives', 14),
(10, 'joashgomba@gmail.com', '::1', '2017-05-04 15:27:53', 'Added the output  and its indicator(s) Test 123, under the outcome YY of the project Providing Access to Education for Vulnerable Communities.', 'projects/outputlogframe', 1, 'projectoutputs', 6),
(11, 'joashgomba@gmail.com', '::1', '2017-05-04 15:31:46', 'Added the output  and its indicator(s) jkljkl, under the outcome YY of the project Providing Access to Education for Vulnerable Communities.', 'projects/outputlogframe', 1, 'projectoutputs', 7),
(12, 'joashgomba@gmail.com', '::1', '2017-05-04 15:35:29', 'Added the output output test and its indicator(s) indicator test, under the outcome my outcome of the project Providing Access to Education for Vulnerable Communities.', 'projects/outputlogframe', 1, 'projectoutputs', 8),
(13, 'joashgomba@gmail.com', '::1', '2017-06-27 16:39:28', 'Edited and updated the task  for the planned activity Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa under the project Police-Community Dialogue and Community Safety in Puntland.', 'rollingactionplans/edit_validate', 1, 'rollingactionplans', 2),
(14, 'joashgomba@gmail.com', '::1', '2017-06-27 16:41:24', 'Edited and updated the task  for the planned activity Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa under the project Police-Community Dialogue and Community Safety in Puntland.', 'rollingactionplans/edit_validate', 1, 'rollingactionplans', 2),
(15, 'joashgomba@gmail.com', '::1', '2017-06-27 16:42:53', 'Edited and updated the task Prepare the community safety plans for the planned activity Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa under the project Police-Community Dialogue and Community Safety in Puntland.', 'rollingactionplans/edit_validate', 1, 'rollingactionplans', 2),
(16, 'joashgomba@gmail.com', '::1', '2017-06-27 16:43:08', 'Edited and updated the task Prepare the community safety plans for the planned activity Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa under the project Police-Community Dialogue and Community Safety in Puntland.', 'rollingactionplans/edit_validate', 1, 'rollingactionplans', 2);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaryregistration`
--

CREATE TABLE IF NOT EXISTS `beneficiaryregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_no` varchar(100) NOT NULL,
  `name_of_beneficiary` varchar(255) NOT NULL,
  `mothers_name` varchar(255) NOT NULL,
  `next_of_kin` text NOT NULL,
  `sex` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `settlement` varchar(100) NOT NULL,
  `telephone_number` varchar(100) NOT NULL,
  `zero_to_four_female` varchar(100) NOT NULL,
  `zero_to_four_male` varchar(100) NOT NULL,
  `five_to_seventeen_female` varchar(100) NOT NULL,
  `five_to_seventeen_male` varchar(100) NOT NULL,
  `eighteen_to_fifty_nine_female` varchar(100) NOT NULL,
  `eighteen_to_fifty_nine_male` varchar(100) NOT NULL,
  `sixty_above_female` varchar(100) NOT NULL,
  `sixty_above_male` varchar(100) NOT NULL,
  `total_family_size` varchar(100) NOT NULL,
  `programme_area` varchar(100) NOT NULL,
  `donor` varchar(100) NOT NULL,
  `registration_month` varchar(100) NOT NULL,
  `registration_date` varchar(100) NOT NULL,
  `project_number` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `beneficiaryregistration`
--

INSERT INTO `beneficiaryregistration` (`id`, `id_no`, `name_of_beneficiary`, `mothers_name`, `next_of_kin`, `sex`, `district`, `settlement`, `telephone_number`, `zero_to_four_female`, `zero_to_four_male`, `five_to_seventeen_female`, `five_to_seventeen_male`, `eighteen_to_fifty_nine_female`, `eighteen_to_fifty_nine_male`, `sixty_above_female`, `sixty_above_male`, `total_family_size`, `programme_area`, `donor`, `registration_month`, `registration_date`, `project_number`) VALUES
(1, '5526282', 'Joash Gomba', 'AN Gomba', 'AN Gomba', 'Male', 'Hargeisa', 'Hargeisa', '123455', '2', '0', '0', '1', '1', '0', '0', '0', '5', '', 'Somalia Stability Fund', 'August', '08/10/2016', '515-708'),
(18, '231542', 'Amina Ahmed Salim', 'Fatiah Salim Bughari', 'Mohamend Ahmed', 'Female', 'Sanaag', 'Hargeisa', '123256', '2', '1', '1', '1', '1', '1', '1', '1', '6', 'xx', 'xx', 'Jul', '08/10/2016', '515-708'),
(25, '5678910', 'John Doe Mike', 'Ann Doe', 'Mary Doe', 'Male', 'Bari', 'Bari village', '2359785', '2', '0', '0', '1', '2', '0', '0', '0', '5', '0', '0', 'Aug', '08/11/2016', '515-708'),
(26, '557975', 'Halima Maalim', 'Iman Maalim', 'Abdikadir Maalim', 'Female', 'Galgaduud', 'Galgaduud village', '52155796', '1', '0', '1', '1', '1', '0', '0', '0', '4', '0', '0', 'Aug', '08/11/2016', '515-708'),
(27, '121225262', 'Mkubwa Mdogo', 'Mama Mkubwa', 'Yule Mdogo', 'Male', 'Togdheer', 'Hargeisa', '2123', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', 'Sep', '09/19/2016', '515-708'),
(29, '78965', 'Ahmed Ahmed', 'Maria Khalid', 'Basaafar Ahmed', 'Male', 'Togdheer', 'Hargeisa', '5263', '1', '0', '1', '1', '1', '1', '0', '0', '5', 'Somaliland', 'EC', 'Apr', '05/04/2017', '515-708'),
(36, '123465', 'Baba Yao', 'Mama Yao', 'Mtoto Wao', 'Male', 'Togdher', 'Hargeisa', '0123456', '1', '0', '1', '1', '1', '1', '0', '0', '5', 'Somaliland', 'ECHO', 'Feb', '09/03/2017', '515-708'),
(37, '326589', 'Sonko Mbigi', 'Mama Sonko', 'Toto Sonko', 'Male', 'xx', 'xx', '0231562', '0', '0', '0', '0', '1', '1', '0', '0', '2', 'xx', 'EC', 'Jan', '01/01/2016', '515-708'),
(38, 'kk', 'kk', 'kk', 'kk', 'kk', 'kk', 'k', 'kk', 'kk', 'kk', 'k', 'kk', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', '', 'k');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiarysubcategories`
--

CREATE TABLE IF NOT EXISTS `beneficiarysubcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beneficiarytype_id` int(11) NOT NULL,
  `beneficiary_category` varchar(100) NOT NULL,
  `aggregationtype_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `beneficiarysubcategories`
--

INSERT INTO `beneficiarysubcategories` (`id`, `beneficiarytype_id`, `beneficiary_category`, `aggregationtype_id`, `gender`) VALUES
(1, 0, '0-4 M', 2, 1),
(2, 0, '0-4 F', 2, 2),
(4, 0, '5-17 M', 2, 1),
(5, 0, '5-17 F', 2, 2),
(6, 0, '18-59 M', 2, 1),
(7, 0, '18-59 F', 2, 2),
(8, 0, '60 &> M', 2, 1),
(9, 0, '60 &> F', 2, 2),
(10, 0, 'Male', 1, 1),
(11, 0, 'Female', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiarytypes`
--

CREATE TABLE IF NOT EXISTS `beneficiarytypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beneficiary_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `beneficiarytypes`
--

INSERT INTO `beneficiarytypes` (`id`, `beneficiary_type`) VALUES
(1, 'IDPs'),
(2, 'Female-headed Household (FoH)'),
(3, 'Child-headed Household (CoH)'),
(4, 'Expectant /breastfeeding mother'),
(5, 'Elderly'),
(6, 'People living with disabilities'),
(7, 'Host Community'),
(8, 'Returnees'),
(9, 'Migrants'),
(10, 'GBV Survivors'),
(11, 'Male'),
(12, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(26, 1439389815, '127.0.0.1', '7jfAXJ2U'),
(27, 1439390101, '127.0.0.1', 'tRcOmEdY'),
(28, 1439390110, '127.0.0.1', 'sT3H5Dnn');

-- --------------------------------------------------------

--
-- Table structure for table `cashforwork`
--

CREATE TABLE IF NOT EXISTS `cashforwork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` varchar(100) NOT NULL,
  `funded_by` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `beneficiaryregistration_id` int(11) NOT NULL,
  `beneficiary_name` varchar(255) NOT NULL,
  `mothers_name` varchar(255) NOT NULL,
  `next_of_keen` text NOT NULL,
  `mobile_cash_transfer` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_no` varchar(100) NOT NULL,
  `projectaactivity_id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cashforwork`
--

INSERT INTO `cashforwork` (`id`, `payment_date`, `funded_by`, `district`, `sn`, `location`, `beneficiaryregistration_id`, `beneficiary_name`, `mothers_name`, `next_of_keen`, `mobile_cash_transfer`, `amount`, `project_id`, `project_no`, `projectaactivity_id`, `activity`) VALUES
(1, '09/06/2016', 'Somalia Stability Fund', 'Borama', '002', 'Hargeisa', 20, 'AN Another', 'Amina Ahmed', 'Farouk Ahmed', 'Zaad', '200', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(2, '09/06/2016', 'Somalia Stability Fund', 'Baki', '001', 'test', 0, 'ccc', 'test', 'test', 'Zaad', '100', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(3, '09/26/2016', 'ECHO', 'Lughaye', '003', 'lorem', 1, 'Joash Gomba', 'ipsum', 'ipsum', 'zaad', '300', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(4, '09/12/2016', 'Somalia Stability Fund', 'Lughaye', '212', 'test', 18, 'Amina Ahmed Salim', 'test', 'test', 'test', '500', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(5, '09/19/2016', 'MFA – Netherlands', 'Baki', '123', 'test', 27, 'Mkubwa Mdogo', 'test', 'test', 'test', '300', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(6, '06/04/2017', 'ECHO', 'Borama', '016', 'Hargeisa', 37, 'Sonko Mbigi', 'Sonko Mbigi', 'Toto Sonko', 'Zaad', '150', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(7, 'xx', 'xx', 'xx', 'xx', 'xx', 25, 'John Doe Mike', 'John Doe Mike', 'Mary Doe', 'xx', '150', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(9, 'f', 'f', 'f', 'f', 'f', 1, 'Joash Gomba', 'Joash Gomba', 'AN Gomba', 'f', '600', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro'),
(10, 'jj', 'jj', 'jj', 'jj', 'jj', 36, 'Baba Yao', 'Baba Yao', 'Mtoto Wao', 'jj', 'jj', 1, '515-708', 2, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro');

-- --------------------------------------------------------

--
-- Table structure for table `constituencies`
--

CREATE TABLE IF NOT EXISTS `constituencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `constituency` varchar(100) NOT NULL,
  `county_id` varchar(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `constituencies`
--

INSERT INTO `constituencies` (`id`, `constituency`, `county_id`, `lat`, `long`) VALUES
(1, 'Turkana North', '43', '23.104336', '87.273024'),
(2, 'Turkana West', '43', '3.716667', '34.866667'),
(3, 'Turkana Central', '43', '3.532303', '35.853897'),
(4, 'Loima', '43', '2.918250', '35.404212'),
(5, 'Turkana South', '43', '2.380000', '35.650000'),
(6, 'Turkana East.', '43', '1.183930', '36.102928'),
(7, 'Moyale', '25', '3.539985', '39.052841'),
(8, 'North Horr', '25', '3.320000', '37.070000'),
(9, 'Saku', '25', '4.099444', '37.241389'),
(10, 'Laisamis', '25', '1.600000', '37.800000'),
(11, 'Mandera West', '24', '3.331987', '39.489289'),
(12, 'Banissa', '24', '3.950000', '40.350000'),
(13, 'Mandera North', '24', '4.020525', '41.065521'),
(14, 'Mandera East', '24', '3.756163', '41.667913'),
(15, 'Lafey', '24', '3.153661', '41.185406'),
(16, 'Mandera South', '24', '3.025859', '40.509506');

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE IF NOT EXISTS `counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county` varchar(100) NOT NULL,
  `population` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`id`, `county`, `population`, `lat`, `long`, `active`, `country_id`) VALUES
(1, 'Bari', '222,000', '10.120385', '49.691137', 1, 2),
(2, 'Sanaag', '270,367', '10.393822', '47.763756', 1, 2),
(3, 'Nugal', '145,341', '8.183177', '49.305911', 1, 2),
(4, 'Sool', '75,436', '8.722156', '47.763756', 1, 2),
(5, 'Benadir', '1,650,227', '2.118737', '45.336946', 1, 2),
(6, 'Mudug', '350,099', '6.565673', '47.763756', 1, 2),
(7, 'Galgaduud', '569,434', '5.185013', '46.825284', 1, 2),
(8, 'Hiraan', '520,685', '4.321015', '45.299386', 1, 2),
(9, 'Gedo', '508,405', '3.503923', '42.236244', 1, 2),
(10, 'Lower Shabelle', '1,202,219', '1.876646', '44.247902', 1, 2),
(11, 'Middle Shabelle', '516,036', '2.925025', '45.903969', 1, 2),
(12, 'Bay', '792,182', '2.482519', '43.483738', 1, 2),
(13, 'Middle Juba', '362,921', '2.078049', '41.601181', 1, 2),
(14, 'Lower Juba', '489,307', '0.224021', '41.601181', 1, 2),
(15, 'Bakool', '367,226', '4.365722', '44.096031', 1, 2),
(16, 'Togdheer', '721,363', '9.446059', '45.299386', 1, 2),
(17, 'Awdal', '673,263', '10.633429', '43.329466', 1, 2),
(18, 'Woqooyi Galbeed', '1,242,003', '9.542374', '44.096031', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Kenya'),
(2, 'Somalia'),
(3, 'Yemen');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso_code` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `iso_code`, `currency`) VALUES
(1, 'USD', 'US Dollars'),
(2, 'GBP', 'British Pound'),
(3, 'EUR', 'Euros'),
(4, 'KSHS', 'Kenya Shillings');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`) VALUES
(1, 'Monitoring & Evaluation'),
(2, 'Scrap Yard');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_id` int(11) NOT NULL,
  `district` varchar(100) NOT NULL,
  `population` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `county_id`, `district`, `population`, `lat`, `long`) VALUES
(1, 17, 'Borama', '215,616', '9.936009', '43.184402'),
(2, 17, 'Baki', '25,500', '10.006753', '43.363254'),
(3, 17, 'Lughaye', '36,104', '10.685262', '43.946063'),
(4, 17, 'Zeylac', '28,235', '11.353687', '43.475314');

-- --------------------------------------------------------

--
-- Table structure for table `documentcategories`
--

CREATE TABLE IF NOT EXISTS `documentcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `documentcategories`
--

INSERT INTO `documentcategories` (`id`, `category`) VALUES
(1, '(M & E Documentation) M & E Plans'),
(2, '(M & E Documentation) Data Collection Plans and Schedules.'),
(3, '(M & E Documentation) Data Collection Tools.'),
(4, '(M & E Documentation) Data Quality Assessment Plans and Tools'),
(5, '(M & E Documentation) Routine Field Monitoring Data and Reports'),
(6, '(M & E Documentation) Monitoring and Verification.'),
(7, '(M & E Documentation) Indicator tracking Document'),
(8, '(Surveys and Evaluations) TOR'),
(9, '(Surveys and Evaluations) Survey Data Collection Tools'),
(10, '(Surveys and Evaluations) Survey and Evaluation Planner.'),
(11, '(Surveys and Evaluations) Survey and Evaluation Budget.'),
(12, '(Surveys and Evaluations) Survey and Evaluation Report.'),
(13, '(Surveys and Evaluations) Survey and Evaluation Data.'),
(14, '(Operations Research) TOR'),
(15, '(Operations Research) Protocols and Tools'),
(16, '(Operations Research) Reports'),
(17, '( Learning and Reflections) Lesson Learnt Report'),
(18, '( Learning and Reflections) Success Stories'),
(19, '( Learning and Reflections) Case Studies'),
(20, '( Learning and Reflections) Monthly Reviews'),
(21, '( Learning and Reflections) Quarterly Reviews'),
(22, '( Learning and Reflections) Semi- annual Reviews'),
(23, '( Learning and Reflections) Lessons Learnt from Evaluations'),
(24, '(Other Documents) Legislations'),
(25, '(Other Documents) Policy Docs'),
(26, '(Other Documents) Project Report Speeches');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `documentcategory_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `year_published` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `tags` text NOT NULL,
  `public` int(11) NOT NULL DEFAULT '0',
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `tags` (`tags`),
  FULLTEXT KEY `tags_2` (`tags`),
  FULLTEXT KEY `document_title` (`document_title`,`description`,`tags`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_title`, `description`, `file_name`, `file_type`, `file_size`, `documentcategory_id`, `date_added`, `author`, `year_published`, `user_id`, `project_id`, `published`, `tags`, `public`, `organization_id`) VALUES
(1, 'LOGFRAME, POLICE-COMMUNITY DIALOGUE AND COMMUNITY SAFETY IN PUNTLAND, 515-708', 'This is the project logframe', 'Logical_Framework_515-708.pdf', 'application/pdf', '120.47', 7, '2016-05-10', '', '2016', 1, 1, 1, 'Police,Community,Dialogue', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE IF NOT EXISTS `donors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone_number` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `donor_name`, `email`, `telephone_number`, `contact_person`, `contact_email`, `contact_number`) VALUES
(1, 'European Union (EU)', '', '', '', '', ''),
(2, 'Somalia Stability Fund', '', '', '', '', ''),
(3, 'ECHO', '', '', '', '', ''),
(4, 'CHF', '', '', '', '', ''),
(5, 'Danida', '', '', '', '', ''),
(6, 'Sida', '', '', '', '', ''),
(7, 'UNHCR', '', '', '', '', ''),
(8, 'WFP', '', '', '', '', ''),
(9, 'FFP', '', '', '', '', ''),
(10, 'IOM', '', '', '', '', ''),
(11, 'UNICEF', '', '', '', '', ''),
(12, 'OFDA', '', '', '', '', ''),
(13, 'MFA – Netherlands', '', '', '', '', ''),
(14, 'SDC – Swiss Agency', '', '', '', '', ''),
(15, 'World Vision International', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `formcategories`
--

CREATE TABLE IF NOT EXISTS `formcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `formcategories`
--

INSERT INTO `formcategories` (`id`, `form_category`) VALUES
(1, 'Survey Forms'),
(2, 'Project Forms');

-- --------------------------------------------------------

--
-- Table structure for table `formelements`
--

CREATE TABLE IF NOT EXISTS `formelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `label` varchar(255) NOT NULL,
  `default_value` varchar(100) DEFAULT NULL,
  `tool_tip` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `max_length` varchar(100) DEFAULT NULL,
  `rows` varchar(100) DEFAULT NULL,
  `cols` varchar(100) DEFAULT NULL,
  `custom_display_format` varchar(100) DEFAULT NULL,
  `folder_path` varchar(100) DEFAULT NULL,
  `folder_url` varchar(100) DEFAULT NULL,
  `permitted_file_types` varchar(100) DEFAULT NULL,
  `max_file_size` varchar(100) DEFAULT NULL,
  `options` text,
  `input_type` varchar(100) NOT NULL,
  `required` int(11) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_modified` datetime NOT NULL,
  `listorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `formelements`
--

INSERT INTO `formelements` (`id`, `form_id`, `type`, `label`, `default_value`, `tool_tip`, `size`, `max_length`, `rows`, `cols`, `custom_display_format`, `folder_path`, `folder_url`, `permitted_file_types`, `max_file_size`, `options`, `input_type`, `required`, `date_time_created`, `date_time_modified`, `listorder`) VALUES
(1, 1, 'Input Text', 'Untitled Input Text', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-07-03 16:49:01', '2016-07-03 16:49:01', 4),
(2, 1, 'Radio Button', 'Untitled Radio Button', '', '', '', '', '', '', '', '', '', '', '', '[{"option one":1,"option two":2}]', 'alphanumeric', 0, '2016-07-03 16:49:05', '2016-07-03 16:49:05', 2),
(3, 1, 'Selectable List', 'Untitled Selectable List', '', '', '', '', '', '', '', '', '', '', '', '[{"option one":1,"option two":2}]', 'alphanumeric', 0, '2016-07-03 16:49:36', '2016-07-03 16:49:36', 3),
(4, 1, 'Section Break', 'Untitled Section Break', '', '', '', '', '', '', '', '', '', '', '', '', 'alphanumeric', 0, '2016-07-03 16:50:59', '2016-07-03 16:50:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) NOT NULL,
  `form_type` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `project_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `form_elements` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form_name`, `form_type`, `status`, `project_id`, `activity_id`, `form_elements`) VALUES
(1, 'Providing Access to Education Survey Form', 1, 'Unpublished', 1, 1, '{"fields":[{"label":"Personal Information","field_type":"section_break","required":true,"field_options":{},"cid":"c2"},{"label":"ID Number","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c6"},{"label":"District","field_type":"dropdown","required":true,"field_options":{"options":[{"label":"Bari","checked":true},{"label":"Sanaag","checked":false},{"label":"Nugal","checked":false},{"label":"Sool","checked":false},{"label":"Benadir","checked":false},{"label":"Mudug","checked":false},{"label":"Galgaduud","checked":false},{"label":"Hiraan","checked":false}],"include_blank_option":false},"cid":"c10"},{"label":"Village/Settlement","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c14"},{"label":"Date of interview","field_type":"date","required":true,"field_options":{},"cid":"c18"},{"label":"Gender","field_type":"radio","required":true,"field_options":{"options":[{"label":"Male","checked":false},{"label":"Female","checked":false}]},"cid":"c22"},{"label":"Gender of the head of HH  ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Male","checked":false},{"label":"Female","checked":false}]},"cid":"c26"},{"label":"Size of HH","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c30"},{"label":"Number of children in HH <5 years ","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c34"},{"label":"Target criteria of the beneficiaries","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2  ","checked":false},{"label":"3","checked":false},{"label":"4","checked":false},{"label":"5","checked":false},{"label":"6","checked":false}],"include_other_option":false,"description":"1 = Nutrition center   2 =Pregnant mother  / lactating mother  ,      3 = woman headed house hold   4 = IDP , 5 = Community based targeting , 6 = other "},"cid":"c42"},{"label":"Name of the enumerator","field_type":"text","required":true,"field_options":{"size":"medium"},"cid":"c38"},{"label":"Which best describe your house hold status?  ","field_type":"dropdown","required":true,"field_options":{"options":[{"label":"normal resident in this area ","checked":false},{"label":"moved hear due to the drought","checked":false},{"label":"moved here due to conflict  ","checked":false},{"label":"moved here for other reasons ","checked":false}],"include_blank_option":false},"cid":"c47"},{"label":"What is your house holds normal livelihood?","field_type":"radio","required":true,"field_options":{"options":[{"label":"pastoralist ","checked":false},{"label":"agro pastoralist ","checked":false},{"label":"agriculture ","checked":false},{"label":"urban  ","checked":false},{"label":"other ","checked":false}]},"cid":"c51"},{"label":"What was your regular income before this project (Sh. So.)","field_type":"number","required":true,"field_options":{},"cid":"c56"},{"label":"What is your current income   (Sh. So.)","field_type":"number","required":true,"field_options":{},"cid":"c60"},{"label":"How much debt does your family have currently = (Sh. So )","field_type":"number","required":true,"field_options":{},"cid":"c64"},{"label":"Which of the following have you or members of your household received from NGOs or projects in the past month","field_type":"checkboxes","required":true,"field_options":{"options":[{"label":"Plumpy Nut","checked":false},{"label":"CSB oil beans","checked":false},{"label":"Rice oil beans","checked":false},{"label":"Food voucher","checked":false},{"label":"Cash or CFW","checked":false},{"label":"Medicine","checked":false},{"label":"Water or water voucher","checked":false},{"label":"NFI / other","checked":false}]},"cid":"c68"},{"label":"Collection of cash","field_type":"section_break","required":true,"field_options":{},"cid":"c73"},{"label":"How many hours  did you take to travel to the cash distribution point ","field_type":"radio","required":true,"field_options":{"options":[{"label":"<0.5 hours","checked":false},{"label":"0.5 – 1 hour","checked":false},{"label":"1-1.5 ","checked":false},{"label":"1.5- 2 hours","checked":false},{"label":"2-2.5 hours","checked":false},{"label":">2.5 hours","checked":false}]},"cid":"c77"},{"label":"How much cash did you receive?","field_type":"number","required":true,"field_options":{"description":"US"},"cid":"c81"},{"label":"Was this the amount you Expected?","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c85"},{"label":"How long ago did you receive your last cash transfer? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2","checked":false},{"label":"3","checked":false},{"label":"4","checked":false},{"label":"5","checked":false}],"description":"Codes: 1 = <1 week, 2 = 1 – 2 weeks, 3 = 2 – 3 weeks, 4 = 3 – 4 weeks 5 = > 4 weeks"},"cid":"c89"},{"label":"How much did you spend on transport to and from the distribution site","field_type":"number","required":true,"field_options":{"description":"SoSh"},"cid":"c93"},{"label":"Did you have to pay anyone in order to receive your cash? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c71"},{"label":"Rank the ease with which you collected your cash (code)","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2","checked":false},{"label":"3","checked":false}],"description":"1 = fiican, 2 = iska fiican, 3 =i liidato\\n"},"cid":"c75"},{"label":"Rank the level of security at the cash distribution site (code)","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2","checked":false},{"label":"3","checked":false}],"description":"1 = fiican, 2 = iska fiican, 3 =i liidato\\n"},"cid":"c79"},{"label":"Did you experience any problems with identification by Hawala staff? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c85"},{"label":"Did you experience any problems with getting the correct bank notes? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c89"},{"label":"Did you experience any problems with sending another family member to collect the money","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c93"},{"label":"Did you experience any other problems with collecting the cash? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c97"},{"label":"If yes, explain ","field_type":"text","required":false,"field_options":{"size":"medium"},"cid":"c101"},{"label":"Did you feel safe transporting your cash from the site? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c105"},{"label":"USE OF CASH AND MARKET BEHAVIOUR","field_type":"section_break","required":true,"field_options":{},"cid":"c106"},{"label":"How much do you spend on Food","field_type":"number","required":true,"field_options":{},"cid":"c111"},{"label":"How much do you spend on gift/share","field_type":"number","required":true,"field_options":{},"cid":"c115"},{"label":"How much do you spend on livestock","field_type":"number","required":true,"field_options":{},"cid":"c119"},{"label":"How much do you spend on business/investment","field_type":"number","required":true,"field_options":{},"cid":"c123"},{"label":"How much do you spend on water","field_type":"number","required":true,"field_options":{},"cid":"c127"},{"label":"How much do you spend on medicine","field_type":"number","required":true,"field_options":{},"cid":"c131"},{"label":"How much do you spend on education","field_type":"number","required":true,"field_options":{},"cid":"c135"},{"label":"Dept payment","field_type":"number","required":true,"field_options":{},"cid":"c139"},{"label":"How much do you spend on transportation","field_type":"number","required":true,"field_options":{},"cid":"c143"},{"label":"How much do you spend on rent","field_type":"number","required":true,"field_options":{},"cid":"c147"},{"label":"How much do you spend on agriculture","field_type":"number","required":true,"field_options":{},"cid":"c151"},{"label":"How much do you spend on house hold items","field_type":"number","required":true,"field_options":{},"cid":"c155"},{"label":"How much do you spend on firewood","field_type":"number","required":true,"field_options":{},"cid":"c159"},{"label":"How much do you spend on shoes","field_type":"number","required":true,"field_options":{},"cid":"c163"},{"label":"How much do you spend on savings","field_type":"number","required":true,"field_options":{},"cid":"c167"},{"label":"How much do you spend on wax kale","field_type":"number","required":true,"field_options":{},"cid":"c171"},{"label":"Where did you exchange your cash? (code)","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2","checked":false},{"label":"3","checked":false},{"label":"4","checked":false},{"label":"5","checked":false}],"description":"Codes: 1 = Local hawala, 2 = Local trader to whom you have a debt, 3 = Other trader, 4 = Exchange agent,\\n5 = Bank, 6 = Other \\n"},"cid":"c149"},{"label":"What exchange rate did you get for the cash you received?","field_type":"text","required":true,"field_options":{"size":"small","description":"1 Doolar = Sh. So              "},"cid":"c153"},{"label":"Were you able to find food to buy easily ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c157"},{"label":"Were you satisfied with the quality of food available in the market ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c161"},{"label":"Do you think traders increased the price of food after the cash distribution","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c165"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `indicatorstracking`
--

CREATE TABLE IF NOT EXISTS `indicatorstracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `projectoutputindicator_id` int(11) NOT NULL,
  `report_month` varchar(100) NOT NULL,
  `report_year` varchar(100) NOT NULL,
  `reached` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `indicatorstracking`
--

INSERT INTO `indicatorstracking` (`id`, `project_id`, `projectoutputindicator_id`, `report_month`, `report_year`, `reached`, `comments`) VALUES
(1, 1, 1, '01', '2016', '3', '3 Meetings'),
(2, 1, 1, '09', '2016', '1', 'agreements reached');

-- --------------------------------------------------------

--
-- Table structure for table `levelsofoperation`
--

CREATE TABLE IF NOT EXISTS `levelsofoperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_of_operation` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `levelsofoperation`
--

INSERT INTO `levelsofoperation` (`id`, `level_of_operation`) VALUES
(1, 'County/Community'),
(2, 'National'),
(3, 'International');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(100) NOT NULL,
  `subcounty_id` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lockedips`
--

CREATE TABLE IF NOT EXISTS `lockedips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lockedips`
--

INSERT INTO `lockedips` (`id`, `ip_address`, `reason`) VALUES
(2, '162.192.1.255', 'Brute force attempt');

-- --------------------------------------------------------

--
-- Table structure for table `loginattempts`
--

CREATE TABLE IF NOT EXISTS `loginattempts` (
  `id` int(44) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `success` varchar(100) NOT NULL,
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;

--
-- Dumping data for table `loginattempts`
--

INSERT INTO `loginattempts` (`id`, `username`, `ip_address`, `date_time`, `success`, `time`) VALUES
(1, 'joashgomba@gmail.com', '::1', '2015-04-08 20:04:51', 'Y', '1428516291'),
(2, 'joashgomba@gmail.com', '::1', '2015-04-09 08:13:39', 'Y', '1428560019'),
(3, 'joashgomba@gmail.com', '::1', '2015-04-09 12:50:45', 'Y', '1428576645'),
(4, 'joashgomba@gmail.com', '::1', '2015-04-10 08:55:24', 'Y', '1428648924'),
(5, 'joashgomba@gmail.com', '::1', '2015-04-10 13:00:48', 'N', '1428663648'),
(6, 'joashgomba@gmail.com', '::1', '2015-04-10 13:00:56', 'Y', '1428663656'),
(7, 'joashgomba@gmail.com', '::1', '2015-04-11 08:08:02', 'Y', '1428732482'),
(8, 'joashgomba@gmail.com', '::1', '2015-04-12 09:33:09', 'Y', '1428823989'),
(9, 'joashgomba@gmail.com', '::1', '2015-04-12 18:38:42', 'Y', '1428856722'),
(10, 'joashgomba@gmail.com', '::1', '2015-04-12 21:35:39', 'Y', '1428867339'),
(11, 'joashgomba@gmail.com', '::1', '2015-04-13 07:31:46', 'Y', '1428903106'),
(12, 'joashgomba@gmail.com', '::1', '2015-04-13 17:07:17', 'Y', '1428937637'),
(13, 'joashgomba@gmail.com', '::1', '2015-04-13 17:29:01', 'Y', '1428938941'),
(14, 'joashgomba@gmail.com', '::1', '2015-04-14 07:18:59', 'Y', '1428988739'),
(15, 'joashgomba@gmail.com', '::1', '2015-04-14 13:50:08', 'Y', '1429012208'),
(16, 'joashgomba@gmail.com', '::1', '2015-04-14 20:22:12', 'Y', '1429035732'),
(17, 'joashgomba@gmail.com', '::1', '2015-04-15 07:38:06', 'Y', '1429076286'),
(18, 'joashgomba@gmail.com', '::1', '2015-04-15 13:08:31', 'Y', '1429096111'),
(19, 'joashgomba@gmail.com', '::1', '2015-04-15 15:30:49', 'Y', '1429104649'),
(20, 'joashgomba@gmail.com', '::1', '2015-04-16 14:47:49', 'Y', '1429188469'),
(21, 'joashgomba@gmail.com', '::1', '2015-04-16 21:06:13', 'Y', '1429211173'),
(22, 'joashgomba@gmail.com', '::1', '2015-04-17 08:03:37', 'Y', '1429250617'),
(23, 'joashgomba@gmail.com', '::1', '2015-04-17 19:46:31', 'Y', '1429292791'),
(24, 'joashgomba@gmail.com', '::1', '2015-04-18 09:03:48', 'Y', '1429340628'),
(25, 'joashgomba@gmail.com', '::1', '2015-04-18 21:08:35', 'Y', '1429384115'),
(26, 'joashgomba@gmail.com', '::1', '2015-04-19 09:29:15', 'Y', '1429428555'),
(27, 'joashgomba@gmail.com', '::1', '2015-04-19 09:54:33', 'Y', '1429430073'),
(28, 'joashgomba@gmail.com', '::1', '2015-04-20 10:09:35', 'Y', '1429517375'),
(29, 'joashgomba@gmail.com', '::1', '2015-04-20 10:52:27', 'Y', '1429519947'),
(30, 'joashgomba@gmail.com', '::1', '2015-04-20 20:17:01', 'Y', '1429553821'),
(31, 'joashgomba@gmail.com', '::1', '2015-04-20 21:47:49', 'Y', '1429559269'),
(32, 'joashgomba@gmail.com', '::1', '2015-04-21 08:06:41', 'Y', '1429596401'),
(33, 'joashgomba@gmail.com', '::1', '2015-04-21 10:06:55', 'Y', '1429603615'),
(34, 'joashgomba@gmail.com', '::1', '2015-04-21 10:08:26', 'Y', '1429603706'),
(35, 'joashgomba@gmail.com', '::1', '2015-04-21 13:57:37', 'Y', '1429617457'),
(36, 'joashgomba@gmail.com', '::1', '2015-04-23 13:47:20', 'Y', '1429789640'),
(37, 'joashgomba@gmail.com', '::1', '2015-04-24 17:00:11', 'Y', '1429887611'),
(38, 'joashgomba@gmail.com', '::1', '2015-04-25 10:43:57', 'Y', '1429951437'),
(39, 'joashgomba@gmail.com', '::1', '2015-04-26 10:37:04', 'Y', '1430037424'),
(40, 'joashgomba@gmail.com', '::1', '2015-05-05 08:39:53', 'Y', '1430807993'),
(41, 'joashgomba@gmail.com', '::1', '2015-05-05 08:42:13', 'Y', '1430808133'),
(42, 'joashgomba@gmail.com', '::1', '2015-05-11 15:55:42', 'Y', '1431352542'),
(43, 'joashgomba@gmail.com', '::1', '2015-05-30 10:35:44', 'Y', '1432974944'),
(44, 'joashgomba@gmail.com', '::1', '2015-05-31 10:53:39', 'Y', '1433062419'),
(45, 'joashgomba@gmail.coom', '::1', '2015-06-01 11:03:42', 'N', '1433149422'),
(46, 'joashgomba@gmail.coom', '::1', '2015-06-01 11:03:55', 'N', '1433149435'),
(47, 'joashgomba@gmail.com', '::1', '2015-06-01 11:04:09', 'Y', '1433149449'),
(48, 'joashgomba@gmail.com', '::1', '2015-06-17 16:17:47', 'Y', '1434550667'),
(49, 'joashgomba@gmail.com', '::1', '2015-06-19 12:32:30', 'Y', '1434709950'),
(50, 'joashgomba@gmail.com', '::1', '2015-07-30 15:19:57', 'Y', '1438262397'),
(51, 'joashgomba@gmail.com', '::1', '2015-07-31 10:01:42', 'Y', '1438329702'),
(52, 'joashgomba@gmail.com', '::1', '2015-08-03 13:23:47', 'Y', '1438601027'),
(53, 'joashgomba@gmail.com', '::1', '2015-08-05 19:06:59', 'Y', '1438794419'),
(54, 'joashgomba@gmail.com', '::1', '2015-08-05 19:09:21', 'Y', '1438794561'),
(55, 'joashgomba@gmail.com', '127.0.0.1', '2015-08-12 16:08:19', 'Y', '1439388499'),
(56, 'joashgomba@gmail.coom', '127.0.0.1', '2015-08-12 16:29:48', 'N', '1439389788'),
(57, 'joashgomba@gmail.coom', '127.0.0.1', '2015-08-12 16:29:57', 'N', '1439389797'),
(58, 'joashgomba@gmail.coom', '127.0.0.1', '2015-08-12 16:30:14', 'N', '1439389814'),
(59, 'joashgomba@gmail.com', '127.0.0.1', '2015-08-12 16:31:00', 'Y', '1439389860'),
(60, 'joashgomba@gmail.com', '127.0.0.1', '2015-08-15 17:41:47', 'Y', '1439653307'),
(61, 'joashgomba@gmail.com', '127.0.0.1', '2015-08-23 09:27:48', 'Y', '1440314868'),
(62, 'joashgomba@gmail.com', '127.0.0.1', '2015-10-06 08:25:02', 'Y', '1444112702'),
(63, 'joashgomba@gmail.com', '::1', '2015-12-13 09:31:30', 'Y', '1449995490'),
(64, 'joashgomba@gmail.com', '::1', '2016-01-20 10:44:36', 'Y', '1453283076'),
(65, 'joashgomba@gmail.com', '::1', '2016-01-22 09:54:47', 'Y', '1453452887'),
(66, 'joashgomba@gmail.com', '::1', '2016-02-02 08:08:30', 'Y', '1454396910'),
(67, 'joashgomba@gmail.com', '127.0.0.1', '2016-02-21 11:41:29', 'Y', '1456051289'),
(68, 'joashgomba@gmail.com', '127.0.0.1', '2016-02-21 16:51:06', 'Y', '1456069866'),
(69, 'joashgomba@gmail.com', '127.0.0.1', '2016-02-28 09:35:44', 'Y', '1456648544'),
(70, 'joashgomba@gmail.com', '::1', '2016-03-02 12:39:14', 'Y', '1456918754'),
(71, 'joashgomba@gmail.com', '::1', '2016-04-08 08:27:16', 'Y', '1460096836'),
(72, 'joashgomba@gmail.com', '::1', '2016-04-08 08:44:59', 'Y', '1460097899'),
(73, 'joashgomba@gmail.com', '::1', '2016-04-08 09:03:32', 'Y', '1460099012'),
(74, 'joashgomba@gmail.com', '::1', '2016-05-02 21:17:14', 'Y', '1462216634'),
(75, 'joashgomba@gmail.com', '::1', '2016-05-09 10:32:37', 'Y', '1462782757'),
(76, 'joashgomba@gmail.com', '::1', '2016-05-10 08:19:38', 'Y', '1462861178'),
(77, 'joashgomba@gmail.com', '::1', '2016-05-10 17:00:52', 'Y', '1462892452'),
(78, 'joashgomba@gmail.com', '::1', '2016-05-11 05:47:52', 'Y', '1462938472'),
(79, 'J.Fromholt@ddghoa.org', '::1', '2016-05-11 10:43:42', 'Y', '1462956222'),
(80, 'joashgomba@gmail.com', '::1', '2016-05-11 10:44:03', 'Y', '1462956243'),
(81, 'joashgomba@gmail.com', '::1', '2016-05-11 10:50:55', 'Y', '1462956655'),
(82, 'joashgomba@gmail.com', '::1', '2016-05-11 21:11:15', 'Y', '1462993875'),
(83, 'joashgomba@gmail.com', '127.0.0.1', '2016-05-12 08:35:52', 'Y', '1463034952'),
(84, 'joashgomba@gmail.com', '::1', '2016-05-14 10:54:33', 'Y', '1463216073'),
(85, 'joashgomba@gmail.com', '::1', '2016-05-18 19:39:22', 'Y', '1463593162'),
(86, 'joashgomba@gmail.com', '::1', '2016-05-31 19:27:23', 'Y', '1464715643'),
(87, 'joashgomba@gmail.com', '127.0.0.1', '2016-06-02 09:15:51', 'Y', '1464851751'),
(88, 'joashgomba@gmail.com', '::1', '2016-06-15 12:28:45', 'Y', '1465986525'),
(89, 'joashgomba@gmail.com', '::1', '2016-06-17 19:19:45', 'Y', '1466183985'),
(90, 'joashgomba@gmail.com', '::1', '2016-07-03 12:57:34', 'Y', '1467543454'),
(91, 'joashgomba@gmail.com', '::1', '2016-07-10 19:08:54', 'Y', '1468170534'),
(92, 'joashgomba@gmail.com', '::1', '2016-07-11 06:55:10', 'Y', '1468212910'),
(93, 'joashgomba@gmail.com', '::1', '2016-07-11 20:33:36', 'Y', '1468262016'),
(94, 'joashgomba@gmail.com', '::1', '2016-07-11 20:33:36', 'Y', '1468262016'),
(95, 'joashgomba@gmail.com', '::1', '2016-07-12 07:04:07', 'Y', '1468299847'),
(96, 'joashgomba@gmail.com', '::1', '2016-07-19 13:47:33', 'Y', '1468928853'),
(97, 'joashgomba@gmail.com', '::1', '2016-07-22 16:34:37', 'Y', '1469198077'),
(98, 'joashgomba@gmail.com', '::1', '2016-07-26 17:28:52', 'Y', '1469546932'),
(99, 'joashgomba@gmail.com', '127.0.0.1', '2016-07-31 15:19:08', 'Y', '1469971148'),
(100, 'joashgomba@gmail.com', '127.0.0.1', '2016-07-31 19:00:52', 'Y', '1469984452'),
(101, 'joashgomba@gmail.com', '::1', '2016-08-06 09:31:22', 'Y', '1470468682'),
(102, 'joashgomba@gmail.com', '127.0.0.1', '2016-08-06 09:33:44', 'Y', '1470468824'),
(103, 'joashgomba@gmail.com', '::1', '2016-08-06 09:57:19', 'Y', '1470470239'),
(104, 'joashgomba@gmail.com', '127.0.0.1', '2016-08-06 09:57:47', 'Y', '1470470267'),
(105, 'joashgomba@gmail.com', '127.0.0.1', '2016-08-06 10:01:49', 'Y', '1470470509'),
(106, 'joashgomba@gmail.com', '::1', '2016-08-06 10:13:35', 'Y', '1470471215'),
(107, 'joash', '::1', '2016-08-07 09:53:39', 'N', '1470556419'),
(108, 'joashgomba@gmail.com', '::1', '2016-08-07 09:53:49', 'Y', '1470556429'),
(109, 'joashgomba@gmail.com', '::1', '2016-08-07 10:54:36', 'Y', '1470560076'),
(110, 'joashgomba@gmail.com', '::1', '2016-08-07 14:28:56', 'Y', '1470572936'),
(111, 'joashgomba@gmail.com', '::1', '2016-08-07 14:44:57', 'Y', '1470573897'),
(112, 'joashgomba@gmail.com', '::1', '2016-08-07 14:51:38', 'Y', '1470574298'),
(113, 'joashgomba@gmail.com', '127.0.0.1', '2016-08-07 15:20:44', 'Y', '1470576044'),
(114, 'joashgomba@gmail.com', '::1', '2016-08-07 15:28:38', 'Y', '1470576518'),
(115, 'joashgomba@gmail.com', '::1', '2016-08-08 11:19:21', 'Y', '1470647961'),
(116, 'joashgomba@gmail.com', '::1', '2016-08-09 11:55:00', 'Y', '1470736500'),
(117, 'joashgomba@gmail.com', '::1', '2016-08-10 11:44:02', 'Y', '1470822242'),
(118, 'joashgomba@gmail.com', '::1', '2016-08-11 10:09:50', 'Y', '1470902990'),
(119, 'joashgomba@gmail.com', '::1', '2016-08-11 18:25:19', 'Y', '1470932719'),
(120, 'joashgomba@gmail.com', '::1', '2016-08-16 06:34:41', 'Y', '1471322081'),
(121, 'joashgomba@gmail.com', '::1', '2016-08-16 17:48:37', 'Y', '1471362517'),
(122, 'joashgomba@gmail.com', '::1', '2016-08-17 16:44:04', 'Y', '1471445044'),
(123, 'joashgomba@gmail.com', '::1', '2016-08-20 10:29:48', 'Y', '1471681788'),
(124, 'joashgomba@gmail.com', '::1', '2016-08-26 08:49:58', 'N', '1472194198'),
(125, 'joashgomba@gmail.com', '::1', '2016-08-26 08:50:06', 'Y', '1472194206'),
(126, 'joashgomba@gmail.com', '127.0.0.1', '2016-08-28 09:54:15', 'Y', '1472370855'),
(127, 'joashgomba@gmail.com', '::1', '2016-09-01 06:37:53', 'N', '1472704673'),
(128, 'joashgomba@gmail.com', '::1', '2016-09-01 06:38:12', 'Y', '1472704692'),
(129, 'joashgomba@gmail.com', '::1', '2016-09-01 11:41:00', 'Y', '1472722860'),
(130, 'joashgomba@gmail.com', '::1', '2016-09-01 13:22:38', 'Y', '1472728958'),
(131, 'joashgomba@gmail.com', '::1', '2016-09-01 14:28:23', 'Y', '1472732903'),
(132, 'joashgomba@gmail.com', '::1', '2016-09-05 05:44:53', 'Y', '1473047093'),
(133, 'joashgomba@gmail.com', '::1', '2016-09-06 05:15:49', 'Y', '1473131749'),
(134, 'joashgomba@gmail.com', '::1', '2016-09-08 15:48:21', 'Y', '1473342501'),
(135, 'joashgomba@gmail.com', '::1', '2016-09-09 06:30:03', 'Y', '1473395403'),
(136, 'joashgomba@gmail.com', '::1', '2016-09-09 12:40:29', 'Y', '1473417629'),
(137, 'joashgomba@gmail.com', '::1', '2016-09-10 16:11:55', 'Y', '1473516715'),
(138, 'joashgomba@gmail.com', '::1', '2016-09-12 17:40:40', 'Y', '1473694840'),
(139, 'joashgomba@gmail.com', '::1', '2016-09-15 05:21:05', 'Y', '1473909665'),
(140, 'joashgomba@gmail.com', '::1', '2016-09-16 06:01:06', 'Y', '1473998466'),
(141, 'joashgomba@gmail.com', '::1', '2016-09-17 13:23:14', 'Y', '1474111394'),
(142, 'joashgomba@gmail.com', '::1', '2016-09-18 09:59:57', 'Y', '1474185597'),
(143, 'joashgomba@gmail.com', '::1', '2016-09-18 21:27:32', 'Y', '1474226852'),
(144, 'joashgomba@gmail.com', '::1', '2016-09-19 04:51:30', 'Y', '1474253490'),
(145, 'joashgomba@gmail.com', '::1', '2016-09-19 09:45:02', 'Y', '1474271102'),
(146, 'joashgomba@gmail.com', '::1', '2016-09-19 16:13:40', 'Y', '1474294420'),
(147, 'joashgomba@gmail.com', '::1', '2016-09-21 10:38:23', 'Y', '1474447103'),
(148, 'joashgomba@gmail.com', '::1', '2016-09-25 15:11:56', 'Y', '1474809116'),
(149, 'joashgomba@gmail.com', '::1', '2016-09-28 10:37:11', 'Y', '1475051831'),
(150, 'joashgomba@gmail.com', '::1', '2016-10-01 12:51:10', 'Y', '1475319070'),
(151, 'joashgomba@gmail.com', '::1', '2016-10-02 09:09:30', 'Y', '1475392170'),
(152, 'joashgomba@gmail.com', '::1', '2016-10-02 09:09:31', 'Y', '1475392171'),
(153, 'joashgomba@gmail.com', '::1', '2016-10-03 06:50:46', 'Y', '1475470246'),
(154, 'joashgomba@gmail.com', '::1', '2016-10-09 11:45:29', 'Y', '1476006329'),
(155, 'joashgomba@gmail.com', '::1', '2016-10-11 17:11:03', 'Y', '1476198663'),
(156, 'joashgomba@gmail.com', '::1', '2016-10-12 11:27:09', 'Y', '1476264429'),
(157, 'joashgomba@gmail.com', '::1', '2016-10-13 05:49:37', 'Y', '1476330577'),
(158, 'joashgomba@gmail.com', '::1', '2016-10-23 14:55:35', 'Y', '1477227335'),
(159, 'joashgomba@gmail.com', '::1', '2016-11-01 04:23:49', 'Y', '1477970629'),
(160, 'joashgomba@gmail.com', '127.0.0.1', '2016-11-01 04:38:10', 'Y', '1477971490'),
(161, 'joashgomba@gmail.com', '::1', '2016-11-01 07:28:33', 'Y', '1477981713'),
(162, 'joashgomba@gmail.com', '::1', '2016-11-02 04:30:05', 'Y', '1478057405'),
(163, 'joashgomba@gmail.com', '::1', '2016-11-06 13:08:40', 'Y', '1478434120'),
(164, 'joashgomba@gmail.com', '::1', '2016-11-07 05:44:41', 'Y', '1478493881'),
(165, 'joashgomba@gmail.com', '::1', '2016-11-09 08:56:53', 'Y', '1478678213'),
(166, 'joashgomba@gmail.com', '::1', '2016-11-09 18:25:20', 'Y', '1478712320'),
(167, 'joashgomba@gmail.com', '::1', '2016-11-10 14:34:35', 'Y', '1478784875'),
(168, 'joashgomba@gmail.com', '::1', '2016-11-11 04:43:01', 'Y', '1478835781'),
(169, 'joashgomba@gmail.com', '::1', '2016-11-13 08:54:03', 'Y', '1479023643'),
(170, 'joashgomba@gmail.com', '::1', '2016-11-14 05:42:28', 'N', '1479098548'),
(171, 'joashgomba@gmail.com', '::1', '2016-11-14 05:54:51', 'N', '1479099291'),
(172, 'joashgomba@gmail.com', '::1', '2016-11-14 05:57:34', 'Y', '1479099454'),
(173, 'joashgomba@gmail.com', '::1', '2016-11-14 16:01:14', 'Y', '1479135674'),
(174, 'joashgomba@gmail.com', '127.0.0.1', '2016-12-01 04:37:03', 'Y', '1480563423'),
(175, 'joashgomba@gmail.com', '::1', '2016-12-05 07:45:58', 'Y', '1480920358'),
(176, 'joashgomba@gmail.com', '::1', '2016-12-05 10:45:20', 'Y', '1480931120'),
(177, 'joashgomba@gmail.com', '::1', '2016-12-08 09:19:00', 'Y', '1481185140'),
(178, 'joashgomba@gmail.com', '::1', '2016-12-11 07:27:47', 'Y', '1481437667'),
(179, 'joashgomba@gmail.com', '::1', '2016-12-12 11:18:49', 'Y', '1481537929'),
(180, 'joashgomba@gmail.com', '::1', '2016-12-13 06:54:44', 'Y', '1481608484'),
(181, 'joashgomba@gmail.com', '::1', '2017-01-18 07:31:21', 'Y', '1484721081'),
(182, 'joashgomba@gmail.com', '::1', '2017-01-22 17:18:04', 'Y', '1485101884'),
(183, 'joashgomba@gmail.com', '::1', '2017-02-21 09:13:56', 'Y', '1487664836'),
(184, 'joashgomba@gmail.com', '127.0.0.1', '2017-02-24 06:56:44', 'Y', '1487915804'),
(185, 'joashgomba@gmail.com', '::1', '2017-03-12 18:53:38', 'Y', '1489341218'),
(186, 'joashgomba@gmail.com', '127.0.0.1', '2017-03-13 13:19:52', 'Y', '1489407592'),
(187, 'joashgomba@gmail.com', '::1', '2017-03-14 13:25:24', 'Y', '1489494324'),
(188, 'joashgomba@gmail.com', '::1', '2017-03-15 05:05:35', 'Y', '1489550735'),
(189, 'joashgomba@gmail.com', '::1', '2017-03-15 08:24:15', 'Y', '1489562655'),
(190, 'joashgomba@gmail.com', '::1', '2017-03-15 13:40:32', 'Y', '1489581632'),
(191, 'joashgomba@gmail.com', '::1', '2017-03-15 15:25:50', 'Y', '1489587950'),
(192, 'joashgomba@gmail.com', '::1', '2017-03-15 17:04:37', 'Y', '1489593877'),
(193, 'joashgomba@gmail.com', '::1', '2017-03-16 06:38:27', 'Y', '1489642707'),
(194, 'joashgomba@gmail.com', '::1', '2017-03-16 18:05:32', 'Y', '1489683932'),
(195, 'joashgomba@gmail.com', '::1', '2017-03-17 05:08:05', 'Y', '1489723685'),
(196, 'joashgomba@gmail.com', '::1', '2017-03-22 09:15:40', 'Y', '1490170540'),
(197, 'joashgomba@gmail.com', '::1', '2017-03-22 16:18:15', 'Y', '1490195895'),
(198, 'joashgomba@gmail.com', '::1', '2017-04-03 09:03:13', 'Y', '1491202993'),
(199, 'joashgomba@gmail.com', '127.0.0.1', '2017-04-03 11:22:44', 'Y', '1491211364'),
(200, 'joashgomba@gmail.com', '::1', '2017-04-03 16:52:21', 'Y', '1491231141'),
(201, 'joashgomba@gmail.com', '::1', '2017-04-03 19:36:00', 'Y', '1491240960'),
(202, 'joashgomba@gmail.com', '::1', '2017-04-04 09:22:43', 'Y', '1491290563'),
(203, 'joashgomba@gmail.com', '::1', '2017-04-04 15:08:33', 'Y', '1491311313'),
(204, 'joashgomba@gmail.com', '::1', '2017-04-05 09:10:22', 'Y', '1491376222'),
(205, 'joashgomba@gmail.com', '::1', '2017-04-06 07:20:36', 'Y', '1491456036'),
(206, 'joashgomba@gmail.com', '::1', '2017-04-06 14:31:49', 'Y', '1491481909'),
(207, 'joashgomba@gmail.com', '::1', '2017-04-07 16:41:44', 'Y', '1491576104'),
(208, 'joashgomba@gmail.com', '::1', '2017-04-08 12:49:01', 'Y', '1491648541'),
(209, 'joashgomba@gmail.com', '::1', '2017-04-09 10:25:06', 'Y', '1491726306'),
(210, 'joashgomba@gmail.com', '::1', '2017-04-09 20:47:59', 'Y', '1491763679'),
(211, 'joashgomba@gmail.com', '::1', '2017-04-10 09:22:11', 'Y', '1491808931'),
(212, 'joashgomba@gmail.com', '::1', '2017-04-10 09:35:09', 'Y', '1491809709'),
(213, 'joashgomba@gmail.com', '::1', '2017-04-10 10:04:57', 'Y', '1491811497'),
(214, 'joashgomba@gmail.com', '::1', '2017-04-10 16:47:06', 'Y', '1491835626'),
(215, 'joashgomba@gmail.com', '::1', '2017-04-11 06:30:59', 'Y', '1491885059'),
(216, 'joashgomba@gmail.com', '::1', '2017-04-11 08:00:38', 'Y', '1491890438'),
(217, 'joashgomba@gmail.com', '::1', '2017-04-11 09:15:25', 'Y', '1491894925'),
(218, 'joashgomba@gmail.com', '::1', '2017-04-11 20:28:12', 'Y', '1491935292'),
(219, 'joashgomba@gmail.com', '::1', '2017-04-13 14:34:44', 'Y', '1492086884'),
(220, 'joashgomba@gmail.com', '::1', '2017-04-13 15:53:57', 'Y', '1492091637'),
(221, 'joashgomba@gmail.com', '::1', '2017-04-15 10:48:04', 'Y', '1492246084'),
(222, 'joashgomba@gmail.com', '::1', '2017-04-15 13:37:37', 'Y', '1492256257'),
(223, 'joashgomba@gmail.com', '::1', '2017-04-15 22:49:22', 'Y', '1492289362'),
(224, 'joashgomba@gmail.com', '::1', '2017-04-18 07:44:51', 'Y', '1492494291'),
(225, 'joashgomba@gmail.com', '::1', '2017-04-18 10:47:33', 'N', '1492505253'),
(226, 'joashgomba@gmail.com', '::1', '2017-04-18 10:47:42', 'Y', '1492505262'),
(227, 'joashgomba@gmail.com', '::1', '2017-04-18 19:09:31', 'Y', '1492535371'),
(228, 'joashgomba@gmail.com', '::1', '2017-04-19 06:43:20', 'Y', '1492577000'),
(229, 'joashgomba@gmail.com', '::1', '2017-04-19 16:31:43', 'Y', '1492612303'),
(230, 'joashgomba@gmail.com', '::1', '2017-04-20 08:53:06', 'Y', '1492671186'),
(231, 'joashgomba@gmail.com', '::1', '2017-04-20 13:00:01', 'Y', '1492686001'),
(232, 'joashgomba@gmail.com', '::1', '2017-04-24 09:21:47', 'Y', '1493018507'),
(233, 'joashgomba@gmail.com', '::1', '2017-04-24 11:45:53', 'Y', '1493027153'),
(234, 'joashgomba@gmail.com', '::1', '2017-04-24 17:04:21', 'Y', '1493046261'),
(235, 'joashgomba@gmail.com', '::1', '2017-05-02 12:01:32', 'Y', '1493719292'),
(236, 'joashgomba@gmail.com', '::1', '2017-05-04 12:18:16', 'Y', '1493893096'),
(237, 'joashgomba@gmail.com', '127.0.0.1', '2017-05-04 12:24:58', 'Y', '1493893498'),
(238, 'joashgomba@gmail.com', '::1', '2017-05-30 18:38:15', 'Y', '1496162295'),
(239, 'joashgomba@gmail.com', '127.0.0.1', '2017-05-30 19:25:37', 'Y', '1496165137'),
(240, 'joashgomba@gmail.com', '::1', '2017-06-08 12:04:30', 'Y', '1496916270'),
(241, 'joashgomba@gmail.com', '::1', '2017-06-19 10:29:30', 'Y', '1497860970'),
(242, 'joashgomba@gmail.com', '::1', '2017-06-27 11:20:40', 'Y', '1498555240'),
(243, 'joashgomba@gmail.com', '::1', '2017-06-27 16:17:27', 'Y', '1498573047'),
(244, 'joashgomba@gmail.com', '127.0.0.1', '2017-06-27 16:59:09', 'Y', '1498575549'),
(245, 'joashgomba@gmail.com', '::1', '2017-07-01 16:34:23', 'Y', '1498919663'),
(246, 'joashgomba@gmail.com', '::1', '2017-07-02 11:06:34', 'Y', '1498986394'),
(247, 'joashgomba@gmail.com', '::1', '2017-07-03 09:47:28', 'Y', '1499068048'),
(248, 'joashgomba@gmail.com', '::1', '2017-07-03 16:40:19', 'Y', '1499092819'),
(249, 'joashgomba@gmail.com', '::1', '2017-07-06 13:57:10', 'Y', '1499342230'),
(250, 'joashgomba@gmail.com', '::1', '2017-07-12 13:24:46', 'Y', '1499858686'),
(251, 'joashgomba@gmail.com', '127.0.0.1', '2017-07-28 15:40:55', 'Y', '1501249255'),
(252, 'joashgomba@gmail.com', '::1', '2017-08-22 14:09:03', 'Y', '1503403743'),
(253, 'joashgomba@gmail.com', '::1', '2017-08-23 10:49:55', 'Y', '1503478195'),
(254, 'joashgomba@gmail.com', '::1', '2017-08-30 10:12:44', 'Y', '1504080764'),
(255, 'joashgomba@gmail.com', '::1', '2017-09-07 10:25:15', 'Y', '1504772715'),
(256, 'joashgomba@gmail.com', '::1', '2017-09-12 05:59:37', 'Y', '1505188777'),
(257, 'joashgomba@gmail.com', '127.0.0.1', '2017-10-16 12:44:20', 'Y', '1508150660'),
(258, 'joashgomba@gmail.com', '::1', '2017-10-26 16:29:41', 'Y', '1509028181'),
(259, 'joashgomba@gmail.com', '127.0.0.1', '2017-11-03 16:59:33', 'Y', '1509724773'),
(260, 'joashgomba@gmail.com', '127.0.0.1', '2017-11-06 13:51:59', 'Y', '1509972719');

-- --------------------------------------------------------

--
-- Table structure for table `managementreports`
--

CREATE TABLE IF NOT EXISTS `managementreports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programarea_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `describe_security_issues` text NOT NULL,
  `describe_other_developments` text NOT NULL,
  `three_main_issues` text NOT NULL,
  `findings_through_tc` text NOT NULL,
  `which_projects_where_closed` text NOT NULL,
  `proposals` text NOT NULL,
  `issues_related_to_hr` text NOT NULL,
  `issues_to_be_addressed_by_smt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `managementreports`
--

INSERT INTO `managementreports` (`id`, `programarea_id`, `start_date`, `end_date`, `describe_security_issues`, `describe_other_developments`, `three_main_issues`, `findings_through_tc`, `which_projects_where_closed`, `proposals`, `issues_related_to_hr`, `issues_to_be_addressed_by_smt`) VALUES
(1, 1, '2016-09-01', '2016-09-28', '<p>\r\n <span>This is test data</span></p>', '<p>\r\n <span>yet another test data</span></p>', '<p>\r\n <span>these are the issues that were identified</span></p>', '<p>\r\n <span>Issues with TC visits come here&nbsp;</span></p>', '<table width="100%">\r\n <tbody>\r\n  <tr>\r\n   <td>\r\n    <strong>Closed projects (please include project code)</strong></td>\r\n   <td>\r\n    <strong>New projects (please include project code)</strong></td>\r\n  </tr>\r\n  <tr>\r\n  </tr>\r\n  <tr>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    515-708 - Police-Community Dialogue and Community Safety in Puntland</td>\r\n  </tr>\r\n </tbody>\r\n</table>', '<p>\r\n <span>The proposals produced</span></p>', '<p>\r\n <span>Issues with HR come here</span></p>', '<p>\r\n <span>SMT/RO issues come here</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `monthlyreports`
--

CREATE TABLE IF NOT EXISTS `monthlyreports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programarea_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `projects_and_beneficiaries` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `monthlyreports`
--

INSERT INTO `monthlyreports` (`id`, `programarea_id`, `start_date`, `end_date`, `projects_and_beneficiaries`) VALUES
(1, 6, '2015-09-01', '2015-09-30', '<table border="1" width="100%">\r\n <tbody>\r\n  <tr>\r\n   <td>\r\n    <strong>Project Code</strong></td>\r\n   <td>\r\n    <strong>Sector</strong></td>\r\n   <td>\r\n    <strong>Activity</strong></td>\r\n   <td>\r\n    <strong>Describe what was done</strong></td>\r\n   <td>\r\n    <strong>status</strong></td>\r\n   <td>\r\n    <strong>Challenges</strong></td>\r\n   <td colspan="3">\r\n    <strong>Beneficiaries</strong></td>\r\n  </tr>\r\n  <tr>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    <strong>Male</strong></td>\r\n   <td>\r\n    <strong>Female</strong></td>\r\n   <td>\r\n    <strong>Total</strong></td>\r\n  </tr>\r\n  <tr>\r\n   <td>\r\n    515-708</td>\r\n   <td>\r\n    Advocacy and Protection</td>\r\n   <td>\r\n    Community Entry Activity by CS 1 Harfo Team</td>\r\n   <td>\r\n    This was a community entry activity done by the CS 1 Harfo team in Mudug region, Harfo District and Harfo Community</td>\r\n   <td>\r\n    Completed</td>\r\n   <td>\r\n    &nbsp;</td>\r\n   <td>\r\n    23</td>\r\n   <td>\r\n    7</td>\r\n   <td>\r\n    30</td>\r\n  </tr>\r\n  <tr>\r\n   <td colspan="6">\r\n    TOTAL BENEFICIARIES TARGETED DURING THE MONTH</td>\r\n   <td>\r\n    <strong>23</strong></td>\r\n   <td>\r\n    <strong>7</strong></td>\r\n   <td>\r\n    <strong>30</strong></td>\r\n  </tr>\r\n </tbody>\r\n</table>');

-- --------------------------------------------------------

--
-- Table structure for table `myusers`
--

CREATE TABLE IF NOT EXISTS `myusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `myusers`
--

INSERT INTO `myusers` (`id`, `first_name`, `last_name`, `image`) VALUES
(1, 'Joash', 'Gomba', '1.jpg'),
(2, 'AN ', 'Another', '');

-- --------------------------------------------------------

--
-- Table structure for table `noncashdistribution`
--

CREATE TABLE IF NOT EXISTS `noncashdistribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_area` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `settlement` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `name_of_beneficiary` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `telephone_number` varchar(100) NOT NULL,
  `under_five_female` varchar(100) NOT NULL,
  `under_five_male` varchar(100) NOT NULL,
  `five_to_seventeen_female` varchar(100) NOT NULL,
  `five_to_seventeen_male` varchar(100) NOT NULL,
  `eighteen_to_fifty_nine_female` varchar(100) NOT NULL,
  `eighteen_to_fifty_nine_male` varchar(100) NOT NULL,
  `sixty_above_female` varchar(100) NOT NULL,
  `sixty_above_male` varchar(100) NOT NULL,
  `total_family_size` varchar(100) NOT NULL,
  `familly_head` varchar(100) NOT NULL,
  `diversity` varchar(100) NOT NULL,
  `selection_criteria` varchar(100) NOT NULL,
  `id_no` varchar(100) NOT NULL,
  `support_given` varchar(100) NOT NULL,
  `project_id` int(11) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  `project_no` varchar(100) NOT NULL,
  `activity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `noncashdistribution`
--

INSERT INTO `noncashdistribution` (`id`, `program_area`, `district`, `settlement`, `date_added`, `sn`, `name_of_beneficiary`, `sex`, `telephone_number`, `under_five_female`, `under_five_male`, `five_to_seventeen_female`, `five_to_seventeen_male`, `eighteen_to_fifty_nine_female`, `eighteen_to_fifty_nine_male`, `sixty_above_female`, `sixty_above_male`, `total_family_size`, `familly_head`, `diversity`, `selection_criteria`, `id_no`, `support_given`, `project_id`, `projectactivity_id`, `project_no`, `activity`) VALUES
(1, 'Somaliland', 'Borama', 'Hargeisa', '08/11/2016', '001', 'BN Another', 'Male', '120125', '2', '0', '0', '0', '2', '0', '0', '0', '4', 'Father', 'Female-headed Household (FoH)', 'FOH', '123456', 'NFI distribution', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(2, 'Somaliland', 'Baki', 'test', '09/12/2016', '002', 'test', 'Male', '1210', '1', '0', '0', '0', '0', '0', '0', '0', '0', 'Mother', 'Child-headed Household (CoH)', 'IDP', '1223', 'GBV kits', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(3, 'Mogadishu', 'Lughaye', 'Borama', '09/19/2016', '002', 'TEST', 'Female', '123456789', '1', '1', '1', '1', '2', '0', '0', '0', '4', 'Father', 'GBV Survivors', 'FOH', '12458955', 'Hygiene kits', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(4, 'Somaliland', 'Lughaye', 'xx', '09/12/2016', '002', 'XX', 'Male', '1210', '1', '0', '0', '0', '0', '0', '0', '0', '0', 'Child', 'Child-headed Household (CoH)', 'IDP', '1223', 'GBV kits', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(5, 'Bossaso', 'Zeylac', 'Lorem ipsum', '09/12/2016', '004', 'Lorem Ipsum', 'Male', '23356', '0', '0', '0', '0', '2', '0', '0', '0', '0', 'Mother', 'Returnees', 'Returnees', '2332', 'NFI distribution', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(6, 'k', 'k', 'village', '02/02/2016', 'k', 'k', 'k', 'k', '', '', '1', '1', '1', '1', '1', '1', '1', '1', 'k', 'k', '', 'k', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(7, 'Baki', 'Baki', 'Baki Vilage', '08/06/2017', '017', 'MM Msoto', 'Female', '123456789', '0', '0', '2', '0', '2', '0', '0', '0', '4', 'Father', 'GBV', 'GBV', '', 'GBV Kits', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(8, 'testing', 'testing', 'testing', '09/12/2016', '020', 'TESTING', 'Male', '235892', '0', '0', '0', '3', '2', '0', '0', '0', '5', 'Mother', 'IDP', 'IDP', '', 'Hygiene Kits', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(9, 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', '0', '0', '0', '0', '2', '0', '0', '0', '2', 'xx', 'xx', 'xx', 'xx', 'xx', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(10, 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 'uu', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team'),
(11, 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 'zz', 1, 1, '515-708', 'Community Entry Activity by CS 1 Harfo Team');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web_address` varchar(100) NOT NULL,
  `organizationtype_id` int(11) NOT NULL,
  `levelofoperation_id` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `organization_name`, `address`, `postal_address`, `postal_code`, `city`, `country`, `telephone`, `email`, `web_address`, `organizationtype_id`, `levelofoperation_id`, `logo`) VALUES
(1, 'Danish Refugee Council', 'Kabete Road', '12345', '00200', 'Nairobi', 'Kenya', '123456', 'info@drcsomaliadbase.org', 'http://www.drcsomaliadbase.org', 1, 3, ''),
(2, 'Danish Demining Group', 'NA', 'NA', 'NA', 'NA', 'Kenya', 'NA', 'ddg@drc.dk', 'http://danishdemininggroup.dk/danish-demining-group/where-we-work/kenya', 1, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `organizationtypes`
--

CREATE TABLE IF NOT EXISTS `organizationtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `organizationtypes`
--

INSERT INTO `organizationtypes` (`id`, `organization_type`) VALUES
(1, 'Non-governmental organisation'),
(2, 'Community-based organisation'),
(3, 'Producer group'),
(4, 'Faith-based organisation'),
(5, 'Conservation organisation'),
(6, 'Company'),
(7, 'Consultancy firm'),
(8, 'Research institute / Academia'),
(9, 'Government'),
(10, 'Donor'),
(11, 'UN agency'),
(12, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `outcomeindicatortracking`
--

CREATE TABLE IF NOT EXISTS `outcomeindicatortracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `projectoutcomeindicator_id` int(11) NOT NULL,
  `report_month` varchar(100) NOT NULL,
  `report_year` varchar(100) NOT NULL,
  `reached` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `outcomeindicatortracking`
--

INSERT INTO `outcomeindicatortracking` (`id`, `project_id`, `projectoutcomeindicator_id`, `report_month`, `report_year`, `reached`, `comments`) VALUES
(1, 1, 3, '09', '2016', '3', '3 Meetings');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner` varchar(255) NOT NULL,
  `physical_address` varchar(255) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `organization_email` varchar(255) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `levelofoperation_id` int(11) NOT NULL,
  `organizationtype_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `partner`, `physical_address`, `postal_address`, `postal_code`, `city`, `organization_email`, `telephone`, `contact_person`, `contact_email`, `levelofoperation_id`, `organizationtype_id`) VALUES
(1, 'Somalia NGO Consortium', NULL, NULL, NULL, NULL, '', '', '', '', 1, 1),
(2, 'Puntland Ministry of Security', 'NA', 'NA', 'NA', 'NA', 'noemail@email.com', 'NA', 'NA', 'noemail@email.com', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `passwordpolicies`
--

CREATE TABLE IF NOT EXISTS `passwordpolicies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `max_login_attempts` varchar(30) NOT NULL,
  `login_attempts_counted_within` varchar(30) NOT NULL,
  `lock_account_after_attempts` varchar(30) NOT NULL,
  `blacklist_ip_after_attempts` varchar(30) NOT NULL,
  `notify_admin_after_attempts` varchar(30) NOT NULL,
  `password_life` varchar(30) NOT NULL,
  `notification_period` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `passwordpolicies`
--

INSERT INTO `passwordpolicies` (`id`, `max_login_attempts`, `login_attempts_counted_within`, `lock_account_after_attempts`, `blacklist_ip_after_attempts`, `notify_admin_after_attempts`, `password_life`, `notification_period`) VALUES
(1, '3', '2', '10', '15', '5', '60', '15');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `permission` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=421 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `table_name`, `permission`) VALUES
(1, 'All', 'Add'),
(2, 'All', 'Edit'),
(3, 'All', 'Delete'),
(4, 'All', 'View'),
(5, 'All', 'Reports'),
(6, 'activities', 'Add'),
(7, 'activities', 'Edit'),
(8, 'activities', 'Delete'),
(9, 'activities', 'View'),
(10, 'activities', 'Reports'),
(11, 'activitycategories', 'Add'),
(12, 'activitycategories', 'Edit'),
(13, 'activitycategories', 'Delete'),
(14, 'activitycategories', 'View'),
(15, 'activitycategories', 'Reports'),
(16, 'activityphotos', 'Add'),
(17, 'activityphotos', 'Edit'),
(18, 'activityphotos', 'Delete'),
(19, 'activityphotos', 'View'),
(20, 'activityphotos', 'Reports'),
(21, 'aggregationtypes', 'Add'),
(22, 'aggregationtypes', 'Edit'),
(23, 'aggregationtypes', 'Delete'),
(24, 'aggregationtypes', 'View'),
(25, 'aggregationtypes', 'Reports'),
(26, 'attendancelist', 'Add'),
(27, 'attendancelist', 'Edit'),
(28, 'attendancelist', 'Delete'),
(29, 'attendancelist', 'View'),
(30, 'attendancelist', 'Reports'),
(31, 'audittrail', 'Add'),
(32, 'audittrail', 'Edit'),
(33, 'audittrail', 'Delete'),
(34, 'audittrail', 'View'),
(35, 'audittrail', 'Reports'),
(36, 'beneficiaryregistration', 'Add'),
(37, 'beneficiaryregistration', 'Edit'),
(38, 'beneficiaryregistration', 'Delete'),
(39, 'beneficiaryregistration', 'View'),
(40, 'beneficiaryregistration', 'Reports'),
(41, 'beneficiarysubcategories', 'Add'),
(42, 'beneficiarysubcategories', 'Edit'),
(43, 'beneficiarysubcategories', 'Delete'),
(44, 'beneficiarysubcategories', 'View'),
(45, 'beneficiarysubcategories', 'Reports'),
(46, 'beneficiarytypes', 'Add'),
(47, 'beneficiarytypes', 'Edit'),
(48, 'beneficiarytypes', 'Delete'),
(49, 'beneficiarytypes', 'View'),
(50, 'beneficiarytypes', 'Reports'),
(51, 'calendar', 'Add'),
(52, 'calendar', 'Edit'),
(53, 'calendar', 'Delete'),
(54, 'calendar', 'View'),
(55, 'calendar', 'Reports'),
(56, 'captcha', 'Add'),
(57, 'captcha', 'Edit'),
(58, 'captcha', 'Delete'),
(59, 'captcha', 'View'),
(60, 'captcha', 'Reports'),
(61, 'cashforwork', 'Add'),
(62, 'cashforwork', 'Edit'),
(63, 'cashforwork', 'Delete'),
(64, 'cashforwork', 'View'),
(65, 'cashforwork', 'Reports'),
(66, 'constituencies', 'Add'),
(67, 'constituencies', 'Edit'),
(68, 'constituencies', 'Delete'),
(69, 'constituencies', 'View'),
(70, 'constituencies', 'Reports'),
(71, 'counties', 'Add'),
(72, 'counties', 'Edit'),
(73, 'counties', 'Delete'),
(74, 'counties', 'View'),
(75, 'counties', 'Reports'),
(76, 'countries', 'Add'),
(77, 'countries', 'Edit'),
(78, 'countries', 'Delete'),
(79, 'countries', 'View'),
(80, 'countries', 'Reports'),
(81, 'currencies', 'Add'),
(82, 'currencies', 'Edit'),
(83, 'currencies', 'Delete'),
(84, 'currencies', 'View'),
(85, 'currencies', 'Reports'),
(86, 'departments', 'Add'),
(87, 'departments', 'Edit'),
(88, 'departments', 'Delete'),
(89, 'departments', 'View'),
(90, 'departments', 'Reports'),
(91, 'districts', 'Add'),
(92, 'districts', 'Edit'),
(93, 'districts', 'Delete'),
(94, 'districts', 'View'),
(95, 'districts', 'Reports'),
(96, 'documentcategories', 'Add'),
(97, 'documentcategories', 'Edit'),
(98, 'documentcategories', 'Delete'),
(99, 'documentcategories', 'View'),
(100, 'documentcategories', 'Reports'),
(101, 'documents', 'Add'),
(102, 'documents', 'Edit'),
(103, 'documents', 'Delete'),
(104, 'documents', 'View'),
(105, 'documents', 'Reports'),
(106, 'donors', 'Add'),
(107, 'donors', 'Edit'),
(108, 'donors', 'Delete'),
(109, 'donors', 'View'),
(110, 'donors', 'Reports'),
(111, 'formcategories', 'Add'),
(112, 'formcategories', 'Edit'),
(113, 'formcategories', 'Delete'),
(114, 'formcategories', 'View'),
(115, 'formcategories', 'Reports'),
(116, 'formelements', 'Add'),
(117, 'formelements', 'Edit'),
(118, 'formelements', 'Delete'),
(119, 'formelements', 'View'),
(120, 'formelements', 'Reports'),
(121, 'forms', 'Add'),
(122, 'forms', 'Edit'),
(123, 'forms', 'Delete'),
(124, 'forms', 'View'),
(125, 'forms', 'Reports'),
(126, 'indicatorstracking', 'Add'),
(127, 'indicatorstracking', 'Edit'),
(128, 'indicatorstracking', 'Delete'),
(129, 'indicatorstracking', 'View'),
(130, 'indicatorstracking', 'Reports'),
(131, 'levelsofoperation', 'Add'),
(132, 'levelsofoperation', 'Edit'),
(133, 'levelsofoperation', 'Delete'),
(134, 'levelsofoperation', 'View'),
(135, 'levelsofoperation', 'Reports'),
(136, 'locations', 'Add'),
(137, 'locations', 'Edit'),
(138, 'locations', 'Delete'),
(139, 'locations', 'View'),
(140, 'locations', 'Reports'),
(141, 'lockedips', 'Add'),
(142, 'lockedips', 'Edit'),
(143, 'lockedips', 'Delete'),
(144, 'lockedips', 'View'),
(145, 'lockedips', 'Reports'),
(146, 'loginattempts', 'Add'),
(147, 'loginattempts', 'Edit'),
(148, 'loginattempts', 'Delete'),
(149, 'loginattempts', 'View'),
(150, 'loginattempts', 'Reports'),
(151, 'managementreports', 'Add'),
(152, 'managementreports', 'Edit'),
(153, 'managementreports', 'Delete'),
(154, 'managementreports', 'View'),
(155, 'managementreports', 'Reports'),
(156, 'monthlyreports', 'Add'),
(157, 'monthlyreports', 'Edit'),
(158, 'monthlyreports', 'Delete'),
(159, 'monthlyreports', 'View'),
(160, 'monthlyreports', 'Reports'),
(161, 'myusers', 'Add'),
(162, 'myusers', 'Edit'),
(163, 'myusers', 'Delete'),
(164, 'myusers', 'View'),
(165, 'myusers', 'Reports'),
(166, 'noncashdistribution', 'Add'),
(167, 'noncashdistribution', 'Edit'),
(168, 'noncashdistribution', 'Delete'),
(169, 'noncashdistribution', 'View'),
(170, 'noncashdistribution', 'Reports'),
(171, 'organizations', 'Add'),
(172, 'organizations', 'Edit'),
(173, 'organizations', 'Delete'),
(174, 'organizations', 'View'),
(175, 'organizations', 'Reports'),
(176, 'organizationtypes', 'Add'),
(177, 'organizationtypes', 'Edit'),
(178, 'organizationtypes', 'Delete'),
(179, 'organizationtypes', 'View'),
(180, 'organizationtypes', 'Reports'),
(181, 'outcomeindicatortracking', 'Add'),
(182, 'outcomeindicatortracking', 'Edit'),
(183, 'outcomeindicatortracking', 'Delete'),
(184, 'outcomeindicatortracking', 'View'),
(185, 'outcomeindicatortracking', 'Reports'),
(186, 'partners', 'Add'),
(187, 'partners', 'Edit'),
(188, 'partners', 'Delete'),
(189, 'partners', 'View'),
(190, 'partners', 'Reports'),
(191, 'passwordpolicies', 'Add'),
(192, 'passwordpolicies', 'Edit'),
(193, 'passwordpolicies', 'Delete'),
(194, 'passwordpolicies', 'View'),
(195, 'passwordpolicies', 'Reports'),
(196, 'permissions', 'Add'),
(197, 'permissions', 'Edit'),
(198, 'permissions', 'Delete'),
(199, 'permissions', 'View'),
(200, 'permissions', 'Reports'),
(201, 'profiles', 'Add'),
(202, 'profiles', 'Edit'),
(203, 'profiles', 'Delete'),
(204, 'profiles', 'View'),
(205, 'profiles', 'Reports'),
(206, 'programmeareas', 'Add'),
(207, 'programmeareas', 'Edit'),
(208, 'programmeareas', 'Delete'),
(209, 'programmeareas', 'View'),
(210, 'programmeareas', 'Reports'),
(211, 'projectactivities', 'Add'),
(212, 'projectactivities', 'Edit'),
(213, 'projectactivities', 'Delete'),
(214, 'projectactivities', 'View'),
(215, 'projectactivities', 'Reports'),
(216, 'projectactivitiesbeneficiaries', 'Add'),
(217, 'projectactivitiesbeneficiaries', 'Edit'),
(218, 'projectactivitiesbeneficiaries', 'Delete'),
(219, 'projectactivitiesbeneficiaries', 'View'),
(220, 'projectactivitiesbeneficiaries', 'Reports'),
(221, 'projectactivitiesbeneficiarycategories', 'Add'),
(222, 'projectactivitiesbeneficiarycategories', 'Edit'),
(223, 'projectactivitiesbeneficiarycategories', 'Delete'),
(224, 'projectactivitiesbeneficiarycategories', 'View'),
(225, 'projectactivitiesbeneficiarycategories', 'Reports'),
(226, 'projectactivitystatus', 'Add'),
(227, 'projectactivitystatus', 'Edit'),
(228, 'projectactivitystatus', 'Delete'),
(229, 'projectactivitystatus', 'View'),
(230, 'projectactivitystatus', 'Reports'),
(231, 'projectbeneficiaries', 'Add'),
(232, 'projectbeneficiaries', 'Edit'),
(233, 'projectbeneficiaries', 'Delete'),
(234, 'projectbeneficiaries', 'View'),
(235, 'projectbeneficiaries', 'Reports'),
(236, 'projectdiversities', 'Add'),
(237, 'projectdiversities', 'Edit'),
(238, 'projectdiversities', 'Delete'),
(239, 'projectdiversities', 'View'),
(240, 'projectdiversities', 'Reports'),
(241, 'projectdonors', 'Add'),
(242, 'projectdonors', 'Edit'),
(243, 'projectdonors', 'Delete'),
(244, 'projectdonors', 'View'),
(245, 'projectdonors', 'Reports'),
(246, 'projectobjectiveindicators', 'Add'),
(247, 'projectobjectiveindicators', 'Edit'),
(248, 'projectobjectiveindicators', 'Delete'),
(249, 'projectobjectiveindicators', 'View'),
(250, 'projectobjectiveindicators', 'Reports'),
(251, 'projectobjectives', 'Add'),
(252, 'projectobjectives', 'Edit'),
(253, 'projectobjectives', 'Delete'),
(254, 'projectobjectives', 'View'),
(255, 'projectobjectives', 'Reports'),
(256, 'projectoutcomeindicators', 'Add'),
(257, 'projectoutcomeindicators', 'Edit'),
(258, 'projectoutcomeindicators', 'Delete'),
(259, 'projectoutcomeindicators', 'View'),
(260, 'projectoutcomeindicators', 'Reports'),
(261, 'projectoutcomes', 'Add'),
(262, 'projectoutcomes', 'Edit'),
(263, 'projectoutcomes', 'Delete'),
(264, 'projectoutcomes', 'View'),
(265, 'projectoutcomes', 'Reports'),
(266, 'projectoutputindicators', 'Add'),
(267, 'projectoutputindicators', 'Edit'),
(268, 'projectoutputindicators', 'Delete'),
(269, 'projectoutputindicators', 'View'),
(270, 'projectoutputindicators', 'Reports'),
(271, 'projectoutputs', 'Add'),
(272, 'projectoutputs', 'Edit'),
(273, 'projectoutputs', 'Delete'),
(274, 'projectoutputs', 'View'),
(275, 'projectoutputs', 'Reports'),
(276, 'projectpartners', 'Add'),
(277, 'projectpartners', 'Edit'),
(278, 'projectpartners', 'Delete'),
(279, 'projectpartners', 'View'),
(280, 'projectpartners', 'Reports'),
(281, 'projectplannedactivities', 'Add'),
(282, 'projectplannedactivities', 'Edit'),
(283, 'projectplannedactivities', 'Delete'),
(284, 'projectplannedactivities', 'View'),
(285, 'projectplannedactivities', 'Reports'),
(286, 'projects', 'Add'),
(287, 'projects', 'Edit'),
(288, 'projects', 'Delete'),
(289, 'projects', 'View'),
(290, 'projects', 'Reports'),
(291, 'projectscounties', 'Add'),
(292, 'projectscounties', 'Edit'),
(293, 'projectscounties', 'Delete'),
(294, 'projectscounties', 'View'),
(295, 'projectscounties', 'Reports'),
(296, 'projectsdistricts', 'Add'),
(297, 'projectsdistricts', 'Edit'),
(298, 'projectsdistricts', 'Delete'),
(299, 'projectsdistricts', 'View'),
(300, 'projectsdistricts', 'Reports'),
(301, 'projectsectors', 'Add'),
(302, 'projectsectors', 'Edit'),
(303, 'projectsectors', 'Delete'),
(304, 'projectsectors', 'View'),
(305, 'projectsectors', 'Reports'),
(306, 'projectsmandeplans', 'Add'),
(307, 'projectsmandeplans', 'Edit'),
(308, 'projectsmandeplans', 'Delete'),
(309, 'projectsmandeplans', 'View'),
(310, 'projectsmandeplans', 'Reports'),
(311, 'reportinglines', 'Add'),
(312, 'reportinglines', 'Edit'),
(313, 'reportinglines', 'Delete'),
(314, 'reportinglines', 'View'),
(315, 'reportinglines', 'Reports'),
(316, 'responses', 'Add'),
(317, 'responses', 'Edit'),
(318, 'responses', 'Delete'),
(319, 'responses', 'View'),
(320, 'responses', 'Reports'),
(321, 'rolefunctionpermission', 'Add'),
(322, 'rolefunctionpermission', 'Edit'),
(323, 'rolefunctionpermission', 'Delete'),
(324, 'rolefunctionpermission', 'View'),
(325, 'rolefunctionpermission', 'Reports'),
(326, 'rolepermission', 'Add'),
(327, 'rolepermission', 'Edit'),
(328, 'rolepermission', 'Delete'),
(329, 'rolepermission', 'View'),
(330, 'rolepermission', 'Reports'),
(331, 'roles', 'Add'),
(332, 'roles', 'Edit'),
(333, 'roles', 'Delete'),
(334, 'roles', 'View'),
(335, 'roles', 'Reports'),
(336, 'rollingactionplanassignees', 'Add'),
(337, 'rollingactionplanassignees', 'Edit'),
(338, 'rollingactionplanassignees', 'Delete'),
(339, 'rollingactionplanassignees', 'View'),
(340, 'rollingactionplanassignees', 'Reports'),
(341, 'rollingactionplandependancies', 'Add'),
(342, 'rollingactionplandependancies', 'Edit'),
(343, 'rollingactionplandependancies', 'Delete'),
(344, 'rollingactionplandependancies', 'View'),
(345, 'rollingactionplandependancies', 'Reports'),
(346, 'rollingactionplanlogs', 'Add'),
(347, 'rollingactionplanlogs', 'Edit'),
(348, 'rollingactionplanlogs', 'Delete'),
(349, 'rollingactionplanlogs', 'View'),
(350, 'rollingactionplanlogs', 'Reports'),
(351, 'rollingactionplanmilestones', 'Add'),
(352, 'rollingactionplanmilestones', 'Edit'),
(353, 'rollingactionplanmilestones', 'Delete'),
(354, 'rollingactionplanmilestones', 'View'),
(355, 'rollingactionplanmilestones', 'Reports'),
(356, 'rollingactionplans', 'Add'),
(357, 'rollingactionplans', 'Edit'),
(358, 'rollingactionplans', 'Delete'),
(359, 'rollingactionplans', 'View'),
(360, 'rollingactionplans', 'Reports'),
(361, 'savedreports', 'Add'),
(362, 'savedreports', 'Edit'),
(363, 'savedreports', 'Delete'),
(364, 'savedreports', 'View'),
(365, 'savedreports', 'Reports'),
(366, 'sectors', 'Add'),
(367, 'sectors', 'Edit'),
(368, 'sectors', 'Delete'),
(369, 'sectors', 'View'),
(370, 'sectors', 'Reports'),
(371, 'staff', 'Add'),
(372, 'staff', 'Edit'),
(373, 'staff', 'Delete'),
(374, 'staff', 'View'),
(375, 'staff', 'Reports'),
(376, 'statisticalreports', 'Add'),
(377, 'statisticalreports', 'Edit'),
(378, 'statisticalreports', 'Delete'),
(379, 'statisticalreports', 'View'),
(380, 'statisticalreports', 'Reports'),
(381, 'subcounties', 'Add'),
(382, 'subcounties', 'Edit'),
(383, 'subcounties', 'Delete'),
(384, 'subcounties', 'View'),
(385, 'subcounties', 'Reports'),
(386, 'sublocations', 'Add'),
(387, 'sublocations', 'Edit'),
(388, 'sublocations', 'Delete'),
(389, 'sublocations', 'View'),
(390, 'sublocations', 'Reports'),
(391, 'subsectors', 'Add'),
(392, 'subsectors', 'Edit'),
(393, 'subsectors', 'Delete'),
(394, 'subsectors', 'View'),
(395, 'subsectors', 'Reports'),
(396, 'taskcategories', 'Add'),
(397, 'taskcategories', 'Edit'),
(398, 'taskcategories', 'Delete'),
(399, 'taskcategories', 'View'),
(400, 'taskcategories', 'Reports'),
(401, 'tasks', 'Add'),
(402, 'tasks', 'Edit'),
(403, 'tasks', 'Delete'),
(404, 'tasks', 'View'),
(405, 'tasks', 'Reports'),
(406, 'trainingreports', 'Add'),
(407, 'trainingreports', 'Edit'),
(408, 'trainingreports', 'Delete'),
(409, 'trainingreports', 'View'),
(410, 'trainingreports', 'Reports'),
(411, 'typesofsupport', 'Add'),
(412, 'typesofsupport', 'Edit'),
(413, 'typesofsupport', 'Delete'),
(414, 'typesofsupport', 'View'),
(415, 'typesofsupport', 'Reports'),
(416, 'users', 'Add'),
(417, 'users', 'Edit'),
(418, 'users', 'Delete'),
(419, 'users', 'View'),
(420, 'users', 'Reports');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `gender` varchar(100) NOT NULL,
  `about_me` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `photo`, `gender`, `about_me`) VALUES
(1, 1, 'profile-pic.jpg', 'M', '<p>\r\n eLogFrame Development Consultant</p>'),
(2, 2, '', '', 'My name is Johannes Fromholt. I am a M&E Advisor at Danish Demining Group'),
(3, 3, '', '', 'My name is John Udalang''. I am a Regional M&E Head at Danish Refugee Council'),
(4, 4, '', '', 'My name is Ann Maina-Kimotho. I am a Regional IT Manager at Danish Refugee Council');

-- --------------------------------------------------------

--
-- Table structure for table `programmeareas`
--

CREATE TABLE IF NOT EXISTS `programmeareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programmearea` varchar(255) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `programmeareas`
--

INSERT INTO `programmeareas` (`id`, `programmearea`, `longitude`, `latitude`) VALUES
(1, 'Bossaso', '49.1833333', '11.2833333'),
(2, 'Somaliland', '45.2993862', '9.9869867'),
(3, 'Mogadishu', '45.35', '2.0333333'),
(4, 'Galkayo', '47.4308333', '6.7697222'),
(5, 'Hiraan', '45.2993862', '4.321015'),
(6, 'Dollow', '42.0794163', '4.1641748');

-- --------------------------------------------------------

--
-- Table structure for table `projectactivities`
--

CREATE TABLE IF NOT EXISTS `projectactivities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `subsector_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `plannedactivity_id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `activity_description` text NOT NULL,
  `county_id` int(11) NOT NULL,
  `constituency_id` int(11) NOT NULL,
  `subcounty_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `sublocation_id` int(11) NOT NULL,
  `activity_cost` varchar(100) NOT NULL,
  `total_beneficiaries` varchar(100) NOT NULL,
  `projectactivitystatus_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `project_month` varchar(100) NOT NULL,
  `project_year` varchar(100) NOT NULL,
  `activity_reach` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  `activitycategory_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `rollingactionplan_id` int(11) NOT NULL,
  `settlement` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `projectactivities`
--

INSERT INTO `projectactivities` (`id`, `project_id`, `sector_id`, `subsector_id`, `activity_id`, `plannedactivity_id`, `activity`, `activity_description`, `county_id`, `constituency_id`, `subcounty_id`, `location_id`, `sublocation_id`, `activity_cost`, `total_beneficiaries`, `projectactivitystatus_id`, `date_added`, `project_month`, `project_year`, `activity_reach`, `lat`, `long`, `activitycategory_id`, `organization_id`, `rollingactionplan_id`, `settlement`, `user_id`) VALUES
(1, 1, 4, 11, 0, 1, 'Community Entry Activity by CS 1 Harfo Team', 'This was a community entry activity done by the CS 1 Harfo team in Mudug region, Harfo District and Harfo Community', 17, 0, 1, 0, 0, '0', '30', 1, '2015-09-30', '9', '2015', 0, '8.313508407548614', '49.291428421875025', 1, 1, 1, '2', 0),
(2, 1, 4, 11, 0, 1, 'Community Entry activity in Nugaal  region, Dangoroyo district in Dangoroyo community by CS 2 Dangro', 'This was a community entry activity conducted by CS 2 Dangroyo Team in Dangoroyo District of Nugaal Region', 17, 0, 1, 0, 0, '0', '30', 1, '2015-09-30', '9', '2015', 0, '7.530188640144638', '48.91040318750004', 1, 1, 2, '', 0),
(3, 1, 4, 12, 31, 1, 'Community Entry Activity in Nugaal region, Godob-Jiran district', 'This is a Community Entry Activity in Nugaal, Godob-Jiran district done by CS 3 Godobjiran team', 3, 0, 0, 0, 0, '0', '30', 1, '2015-09-30', '9', '2015', 0, '8.183177', '49.305911', 1, 1, 0, '', 0),
(4, 1, 2, 6, 0, 1, 'Test activity', 'This is an activity', 17, 0, 2, 0, 0, '0', '100', 1, '2016-04-01', '04', '2016', 0, '5.636576828429107', '47.352341507812525', 1, 1, 1, 'TEsting', 0),
(5, 1, 2, 6, 0, 1, 'Test activity', 'This is an activity', 17, 0, 2, 0, 0, '0', '100', 1, '2016-04-01', '04', '2016', 0, '5.636576828429107', '47.352341507812525', 2, 1, 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projectactivitiesbeneficiaries`
--

CREATE TABLE IF NOT EXISTS `projectactivitiesbeneficiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  `beneficiary_id` int(11) NOT NULL,
  `number_reached` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `projectactivitiesbeneficiaries`
--

INSERT INTO `projectactivitiesbeneficiaries` (`id`, `project_id`, `projectactivity_id`, `beneficiary_id`, `number_reached`) VALUES
(21, 1, 3, 11, '22'),
(22, 1, 3, 12, '8'),
(53, 1, 2, 11, '21'),
(54, 1, 2, 12, '9'),
(56, 1, 5, 1, '100'),
(57, 1, 4, 1, '100'),
(61, 1, 1, 12, '7');

-- --------------------------------------------------------

--
-- Table structure for table `projectactivitiesbeneficiarycategories`
--

CREATE TABLE IF NOT EXISTS `projectactivitiesbeneficiarycategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  `beneficiarycategory_id` int(11) NOT NULL,
  `number_reached` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `projectactivitiesbeneficiarycategories`
--

INSERT INTO `projectactivitiesbeneficiarycategories` (`id`, `project_id`, `projectactivity_id`, `beneficiarycategory_id`, `number_reached`) VALUES
(14, 1, 5, 2, '30'),
(17, 1, 4, 1, '6');

-- --------------------------------------------------------

--
-- Table structure for table `projectactivitiesphotos`
--

CREATE TABLE IF NOT EXISTS `projectactivitiesphotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` text NOT NULL,
  `tags` text NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projectactivitystatus`
--

CREATE TABLE IF NOT EXISTS `projectactivitystatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `projectactivitystatus`
--

INSERT INTO `projectactivitystatus` (`id`, `status`) VALUES
(1, 'Completed'),
(2, 'On going'),
(3, 'Proposed'),
(4, 'Scheduled'),
(5, 'Suspended');

-- --------------------------------------------------------

--
-- Table structure for table `projectbeneficiaries`
--

CREATE TABLE IF NOT EXISTS `projectbeneficiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `beneficiary_id` int(11) NOT NULL,
  `target` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `projectbeneficiaries`
--

INSERT INTO `projectbeneficiaries` (`id`, `project_id`, `beneficiary_id`, `target`) VALUES
(1, 1, 1, '100'),
(2, 1, 9, '200'),
(3, 3, 1, '100');

-- --------------------------------------------------------

--
-- Table structure for table `projectdiversities`
--

CREATE TABLE IF NOT EXISTS `projectdiversities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `projectactivity_id` int(11) NOT NULL,
  `beneficiary` varchar(100) NOT NULL,
  `unit_of_measure` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `projectdiversities`
--

INSERT INTO `projectdiversities` (`id`, `project_id`, `projectactivity_id`, `beneficiary`, `unit_of_measure`, `number`) VALUES
(54, 1, 3, 'MALE 0-14', 'age', '0'),
(55, 1, 3, 'MALE 15-24', 'Age', '1'),
(56, 1, 3, 'MALE 25 - 49', 'Age', '12'),
(57, 1, 3, 'MALE 50+', 'Age', '9'),
(58, 1, 3, 'FEMALE0-14', 'Age', '0'),
(59, 1, 3, 'FEMALE 15-24', 'Age', '0'),
(60, 1, 3, 'FEMALE 25-49', 'Age', '5'),
(61, 1, 3, 'FEMALE 50+', 'Age', '3'),
(140, 1, 2, 'MALE 0-14', 'age', '0'),
(141, 1, 2, 'MALE15-24', 'age', '5'),
(142, 1, 2, 'MALE 25 - 49', 'age', '14'),
(143, 1, 2, 'MALE 50+', 'age', '2'),
(144, 1, 2, 'FEMALE 0-14', 'Age', '0'),
(145, 1, 2, 'FEMALE 15-24', 'Age', '1'),
(146, 1, 2, 'FEMALE 25-49', 'age', '7'),
(147, 1, 2, 'FEMALE 50+', 'age', '1'),
(149, 1, 5, '', '', ''),
(150, 1, 4, '', '', ''),
(157, 1, 1, 'MALE15-24', 'Age', '1'),
(158, 1, 1, 'MALE 25 - 49', 'Age', '16'),
(159, 1, 1, 'MALE 50 +', 'Age', '6'),
(160, 1, 1, 'FEMALE 15 - 24', 'Age', '0'),
(161, 1, 1, 'FEMALE 25 - 49', 'Age', '6'),
(162, 1, 1, 'FEMALE 50+', 'Age', '1');

-- --------------------------------------------------------

--
-- Table structure for table `projectdonors`
--

CREATE TABLE IF NOT EXISTS `projectdonors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `projectdonors`
--

INSERT INTO `projectdonors` (`id`, `project_id`, `donor_id`) VALUES
(11, 1, 2),
(15, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projectobjectiveindicators`
--

CREATE TABLE IF NOT EXISTS `projectobjectiveindicators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicator` text NOT NULL,
  `target` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `implementation_time` varchar(100) NOT NULL,
  `means` text NOT NULL,
  `assumptions` text NOT NULL,
  `objective_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `projectobjectiveindicators`
--

INSERT INTO `projectobjectiveindicators` (`id`, `indicator`, `target`, `type`, `implementation_time`, `means`, `assumptions`, `objective_id`, `project_id`) VALUES
(1, '25% increase in the number of men and women in target communities and districts who consider security to have improved in their community', '25%', 'Quantitative', '3', 'NA', 'N/A', 1, 1),
(2, '25% increase in the number of men and women in target communities and districts who declare higher levels of trust in security providers', '25%', 'Quantitative', '2', 'N/A', 'N/A', 1, 1),
(3, '25% increase in the number of conflicts reported by to have been peacefully managed in target communities and districts by the newly established Guurti', '25%', 'Quantitative', '3', 'N/A', 'N/A', 1, 1),
(4, '50 % target communities implement at least 1 of the activities in their Community Safety Plan', '50%', 'Quantitative', '', 'DDG CSP activity tracking tool', 'The security situation remains stable and allows free access to beneficiaries and implementation of activities', 2, 1),
(5, 'Safety projects implemented by communities can be demonstrated through qualitative methods to have improved local safety and security', 'NA', 'Qualitative', '', 'Activity evaluations by DDG M', 'DDG are still able to recruit, train and retain skilled staff', 2, 1),
(6, 'Increase of 50% survey participants who express familiarity with their security providers (Defined e.g. as meeting the security providers (e.g. police)', '50%', 'Quantitative', '', 'Baseline / Endline Survey', 'There is no negative interference or actions from government or external actors', 3, 1),
(7, 'Improved responsiveness of security providers to complaints as perceived by community members in 50% of the target communities', '50%', 'Quantitative', '', 'Focus Group Discussions, Interviews, Observation and case examples of security providers responding to complaints', 'Communities continue to actively welcome the programme and remain fully engaged in the activities', 3, 1),
(8, 'At least 1 case in each community where security providers and community members cooperate to achieve a common goal', '1 Case', 'Quantitative', '', 'Outcome tracking', 'N/A', 3, 1),
(9, '3.1. The Gurtiis identify local drivers of conflict and ways to respond to them', 'NA', 'Qualitative', '', 'Conflict analysis and outcome tracking', 'Communities are accepting of the Gurtii and willing to cooperate', 4, 1),
(10, '3.2. 50% increase in people that are aware of the new established Xeer for target locations', '50%', 'Quantitative', '', 'Perception assessments', 'N/A', 4, 1),
(11, 'NA', 'NA', 'Quantitative', '0', 'NA', 'NA', 6, 3),
(15, 'xx', 'xx', 'xx', '3', 'na', 'na', 7, 1),
(23, 'ZZ', '9', 'Quantitative', '9', 'N/A', 'N/A', 8, 1),
(24, '1. XX', '6', 'Quantitative', '6', 'bbx', 'bb', 5, 3),
(25, '2. XX Indicator', '6', 'Quantitative', '6', 'Some means', 'Some assumptions', 5, 3),
(26, 'HHHH', '7', 'Quantitative', '7', 'HHHHHH', 'HHHHHH', 10, 3),
(27, 'PPPP', '8', 'Quantitative', '8', 'PPPPP', 'PPPPP', 11, 3),
(28, 'JJJJJ', '8', 'Quantitative', '8', 'JJJJJJJ', 'JJJJJJ', 12, 3),
(29, 'tester', '8', 'Quantitative', '8', 'tester', 'tester', 13, 3),
(31, 'kk', 'kk', 'Quantitative', '9', 'kk', 'kk', 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `projectobjectives`
--

CREATE TABLE IF NOT EXISTS `projectobjectives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `objective` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `projectobjectives`
--

INSERT INTO `projectobjectives` (`id`, `project_id`, `objective`, `type`) VALUES
(1, 1, 'To contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.', 1),
(2, 1, '1. Communities implement their own safety projects (specific projects to be determined by the communities subject to their local priorities and capacity)', 0),
(3, 1, '2.  Improved access to accountable and responsive security provision for community members in target locations', 0),
(4, 1, '3. Gurtiis identify and responds to conflicts and newly developed xeer is adopted by community members', 0),
(5, 3, 'Tester', 0),
(6, 3, 'My Objectives', 0),
(7, 1, 'xxx', 0),
(8, 1, 'ZZ', 0),
(10, 3, 'KKKK', 0),
(11, 3, 'PPPPPP', 0),
(12, 3, 'JJJJJJ', 0),
(13, 3, 'This is a test objective', 0),
(14, 3, 'another objective', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projectoutcomeindicators`
--

CREATE TABLE IF NOT EXISTS `projectoutcomeindicators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outcomeindicator` varchar(255) NOT NULL,
  `outcometarget` text NOT NULL,
  `outcometype` text NOT NULL,
  `outcomeimplementation_time` varchar(100) NOT NULL,
  `outcomemeans` text NOT NULL,
  `outcomeassumptions` text NOT NULL,
  `outcome_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `projectoutcomeindicators`
--

INSERT INTO `projectoutcomeindicators` (`id`, `outcomeindicator`, `outcometarget`, `outcometype`, `outcomeimplementation_time`, `outcomemeans`, `outcomeassumptions`, `outcome_id`, `project_id`) VALUES
(1, 'Community Safety Plans are developed in each target community through an inclusive process with reference to conflict analysis', '1', 'Qualitative', '4', 'Plans/documents are written and printed in both Somali and English', 'Communities are willing and able to engage in developing their own safety plan', 1, 1),
(3, '2.1.1 At least 4 dialogue meetings between the community and security providers are facilitated in each of the target communities over the course of the project', '4 Dialogue meetings', 'Quantitative', '', 'Participant lists ', 'Communities perceive the need for this activity and are willing to include it in their Community Safety Plans', 2, 1),
(4, '2.1.2 At least 2 agreements between security providers and communities on how to cooperate and achieve a common goal', '2 agreements', 'Quantitative', '', 'Action point tracking', 'N/A', 2, 1),
(5, '3.1.1 Establishments of one Gurtii which are representative of various social groups in target locations.', '1 Gurtii', 'Quantitative', '', 'Participant lists', 'Communities perceive the need for this training and are willing to include it in their Community Safety Plans', 3, 1),
(6, '3.1.2 Creation of one Xeer for each district centre', '1 Xeer', 'Quantitative', '', 'Xeer', 'N/A', 3, 1),
(7, '3.1.3 Provision of one training package covering aspects of conflict resolution and related themes', '1 Training package', 'Quantitative', '', 'Participant lists', 'N/A', 3, 1),
(8, 'NA', 'NA', 'Quantitative', '0', 'NA', 'NA', 16, 3),
(9, 'Increased reach', '20', 'Quantitative', '5', 'Surveys', 'All factors remain constant', 17, 3),
(10, '1.YY', '6', 'Quantitative', '6', 'means', 'assumptions', 14, 3),
(11, 'cc', 'cc', 'Quantitative', '5', 'ghg', 'hgvhg', 18, 3),
(12, 'XXCCCC', '5', 'Quantitative', '7', 'FFFF', 'KKK', 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `projectoutcomes`
--

CREATE TABLE IF NOT EXISTS `projectoutcomes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `objective_id` int(11) NOT NULL,
  `outcome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `projectoutcomes`
--

INSERT INTO `projectoutcomes` (`id`, `project_id`, `objective_id`, `outcome`) VALUES
(1, 1, 2, '1.1 Conflict sensitive and inclusive Community Safety Plans prepared in target communities and endorsed by local authorities'),
(2, 1, 3, '2.1 Target communities have a functioning mechanism for dialogue with the security providers in place.'),
(3, 1, 4, '3.1Establishing representative Gurtii composed of elders, women, youth etc., endorsed by the local community and district and government'),
(14, 3, 5, 'YY'),
(15, 3, 5, 'Test'),
(16, 3, 5, 'my outcome'),
(17, 3, 5, 'Test outcome'),
(18, 3, 5, 'outcome'),
(19, 3, 5, 'VVXXXXX');

-- --------------------------------------------------------

--
-- Table structure for table `projectoutputindicators`
--

CREATE TABLE IF NOT EXISTS `projectoutputindicators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outputindicator` varchar(255) NOT NULL,
  `outputtarget` varchar(255) NOT NULL,
  `outputtype` varchar(255) NOT NULL,
  `outputimplementation_time` varchar(100) NOT NULL,
  `outputmeans` varchar(255) NOT NULL,
  `outputassumptions` varchar(255) NOT NULL,
  `output_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `projectoutputindicators`
--

INSERT INTO `projectoutputindicators` (`id`, `outputindicator`, `outputtarget`, `outputtype`, `outputimplementation_time`, `outputmeans`, `outputassumptions`, `output_id`, `project_id`) VALUES
(1, 'Two Agreements reached', '2 agreements', 'Quantitative', '12', 'N/A', 'N/A', 1, 1),
(2, 'NA', 'NA', 'Quantitative', '0', 'NA', 'NA', 2, 3),
(3, '2. Another output', '6', 'Quantitative', '6', 'Means', 'Assumptions', 2, 3),
(4, 'YY In', '2', 'Quantitative', '5', 'yy m', 'yy a', 3, 3),
(5, 'YY i', '7', 'Quantitative', '7', 'YY M', 'YY A', 4, 3),
(6, 'YY I ', '7', 'Quantitative', '7', 'YY M', 'YY A', 5, 3),
(7, 'Test 123', '5', 'Quantitative', '5', 'test', 'test', 6, 3),
(8, 'jkljkl', '8', 'Quantitative', '9', 'kljklj', 'lkljklj', 7, 3),
(9, 'indicator test', '10', 'Quantitative', '10', 'test means', 'test assumption', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `projectoutputs`
--

CREATE TABLE IF NOT EXISTS `projectoutputs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `outcome_id` int(11) NOT NULL,
  `output` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `projectoutputs`
--

INSERT INTO `projectoutputs` (`id`, `project_id`, `outcome_id`, `output`) VALUES
(1, 1, 1, 'Develop Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa'),
(2, 3, 14, 'An output'),
(3, 3, 14, 'YY out'),
(4, 3, 14, 'YY Out'),
(5, 3, 18, 'YY Out'),
(6, 3, 14, 'Test'),
(7, 3, 14, 'kjkljklj'),
(8, 3, 16, 'output test');

-- --------------------------------------------------------

--
-- Table structure for table `projectpartners`
--

CREATE TABLE IF NOT EXISTS `projectpartners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `projectpartners`
--

INSERT INTO `projectpartners` (`id`, `project_id`, `partner_id`) VALUES
(6, 1, 2),
(10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projectplannedactivities`
--

CREATE TABLE IF NOT EXISTS `projectplannedactivities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `projectoutput_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `resources` text NOT NULL,
  `cost` text NOT NULL,
  `activityassumptions` text NOT NULL,
  `total_beneficiary_target` varchar(100) NOT NULL,
  `activity_start_date` date NOT NULL,
  `activity_end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `projectplannedactivities`
--

INSERT INTO `projectplannedactivities` (`id`, `project_id`, `projectoutput_id`, `activity`, `resources`, `cost`, `activityassumptions`, `total_beneficiary_target`, `activity_start_date`, `activity_end_date`) VALUES
(1, 1, 1, 'Two conflict sensitive and inclusive community safety plans prepared and endorsed by at least two local authorities in Hargeisa', 'N/A', 'N/A', 'N/A', '1000', '2016-11-01', '2016-12-31'),
(2, 1, 1, 'Community mobilization and introduction to the local authority/village chiefs.', 'N/A', 'N/A', 'N/A', '1000', '2016-09-01', '2016-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_no` varchar(100) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `project_agreement_number` varchar(100) NOT NULL,
  `date_of_fund_eligibility` date NOT NULL,
  `date_of_agreement` date NOT NULL,
  `project_objective` text NOT NULL,
  `description` text NOT NULL,
  `project_start_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `currency` varchar(100) NOT NULL,
  `project_budget` varchar(100) NOT NULL,
  `projectactivitystatus_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_no`, `project_title`, `project_agreement_number`, `date_of_fund_eligibility`, `date_of_agreement`, `project_objective`, `description`, `project_start_date`, `project_end_date`, `currency`, `project_budget`, `projectactivitystatus_id`, `organization_id`, `country_id`) VALUES
(1, '515-708', 'Police-Community Dialogue and Community Safety in Puntland', 'GD-PL 04', '0000-00-00', '0000-00-00', 'The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.', 'The project involves police infrastructure construction works alongside dialogue with communities, police, district authorities and any other part of the justice system that was available in the target areas. This will deliver the infrastructure upgrades which are being sought by the Ministry of Security. It will also contribute to: sustainable improved policing outcomes, enhanced community safety, minimize risks of damaging police conduct through improved local oversight.\r\n\r\nThe project mobilises community members to participate in and support new policing initiatives and ultimately hold ‘their’ police to account. Lastly, we propose an element of conflict management work that will not only assist DDG in understanding and working in some of Puntland’s most remote and difficult districts, but will also establish agreed legal norms and referral mechanisms between customary, religious and state justice actors.', '2015-06-16', '2016-06-15', '0', '0', 2, 1, 2),
(3, 'PRJ-0001', 'Providing Access to Education for Vulnerable Communities', 'AGR/001', '0000-00-00', '0000-00-00', 'Test', 'test', '2016-10-01', '2017-10-02', '0', '0', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `projectscounties`
--

CREATE TABLE IF NOT EXISTS `projectscounties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `projectscounties`
--

INSERT INTO `projectscounties` (`id`, `project_id`, `county_id`) VALUES
(19, 1, 1),
(20, 1, 3),
(21, 1, 6),
(22, 2, 1),
(26, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projectsdistricts`
--

CREATE TABLE IF NOT EXISTS `projectsdistricts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `projectsdistricts`
--

INSERT INTO `projectsdistricts` (`id`, `project_id`, `district_id`) VALUES
(4, 3, 1),
(5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `projectsectors`
--

CREATE TABLE IF NOT EXISTS `projectsectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `projectsectors`
--

INSERT INTO `projectsectors` (`id`, `project_id`, `sector_id`) VALUES
(11, 1, 4),
(15, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projectsmandeplans`
--

CREATE TABLE IF NOT EXISTS `projectsmandeplans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `background` text NOT NULL,
  `purpose_of_plan` text NOT NULL,
  `project_summary` text,
  `logical_framework` text,
  `indicators` longtext,
  `roles_and_responsibilities` text,
  `data_flow` text,
  `storage` text,
  `analysis` text,
  `privacy` text,
  `appendices` text,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reportinglines`
--

CREATE TABLE IF NOT EXISTS `reportinglines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `reportinglines`
--

INSERT INTO `reportinglines` (`id`, `organization_id`, `title`, `parent_id`) VALUES
(1, 1, 'M&E Manager', 0),
(2, 1, 'M&E Coordinator PL', 1),
(3, 1, 'M&E Coordinator SL', 1),
(4, 1, 'M&E Coordinator SC', 1),
(5, 1, 'M&E Coordinator Dollow', 1),
(6, 1, 'M&E Assistant PL', 2),
(7, 1, 'M&E Assistant SL', 3),
(8, 1, 'M&E Assistant SC', 4),
(9, 1, 'M&E Assistant Dollow', 5);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `element_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `form_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_submitted` date NOT NULL,
  `last_modified` date NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rolefunctionpermission`
--

CREATE TABLE IF NOT EXISTS `rolefunctionpermission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `rolefunction` text NOT NULL,
  `rolepermission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rolefunctionpermission`
--

INSERT INTO `rolefunctionpermission` (`id`, `role_id`, `role`, `rolefunction`, `rolepermission`) VALUES
(1, 1, 'SuperAdmin', '[{"Function_1":"activities","Function_2":"activitycategories","Function_3":"activityphotos","Function_4":"aggregationtypes","Function_5":"attendancelist","Function_6":"audittrail","Function_7":"beneficiaryregistration","Function_8":"beneficiarysubcategories","Function_9":"beneficiarytypes","Function_10":"calendar","Function_11":"captcha","Function_12":"cashforwork","Function_13":"constituencies","Function_14":"counties","Function_15":"countries","Function_16":"currencies","Function_17":"departments","Function_18":"districts","Function_19":"documentcategories","Function_20":"documents","Function_21":"donors","Function_22":"formcategories","Function_23":"formelements","Function_24":"forms","Function_25":"indicatorstracking","Function_26":"levelsofoperation","Function_27":"locations","Function_28":"lockedips","Function_29":"loginattempts","Function_30":"managementreports","Function_31":"monthlyreports","Function_32":"myusers","Function_33":"noncashdistribution","Function_34":"organizations","Function_35":"organizationtypes","Function_36":"outcomeindicatortracking","Function_37":"partners","Function_38":"passwordpolicies","Function_39":"permissions","Function_40":"profiles","Function_41":"programmeareas","Function_42":"projectactivities","Function_43":"projectactivitiesbeneficiaries","Function_44":"projectactivitiesbeneficiarycategories","Function_45":"projectactivitystatus","Function_46":"projectbeneficiaries","Function_47":"projectdiversities","Function_48":"projectdonors","Function_49":"projectobjectiveindicators","Function_50":"projectobjectives","Function_51":"projectoutcomeindicators","Function_52":"projectoutcomes","Function_53":"projectoutputindicators","Function_54":"projectoutputs","Function_55":"projectpartners","Function_56":"projectplannedactivities","Function_57":"projects","Function_58":"projectscounties","Function_59":"projectsdistricts","Function_60":"projectsectors","Function_61":"projectsmandeplans","Function_62":"reportinglines","Function_63":"responses","Function_64":"rolefunctionpermission","Function_65":"rolepermission","Function_66":"roles","Function_67":"rollingactionplanassignees","Function_68":"rollingactionplandependancies","Function_69":"rollingactionplanlogs","Function_70":"rollingactionplanmilestones","Function_71":"rollingactionplans","Function_72":"savedreports","Function_73":"sectors","Function_74":"staff","Function_75":"statisticalreports","Function_76":"subcounties","Function_77":"sublocations","Function_78":"subsectors","Function_79":"taskcategories","Function_80":"tasks","Function_81":"trainingreports","Function_82":"typesofsupport","Function_83":"users"}]', '[{"Permission_1":"All_Add","Permission_2":"All_Edit","Permission_3":"All_Delete","Permission_4":"All_View","Permission_5":"All_Reports","Permission_6":"activities_Add","Permission_7":"activities_Edit","Permission_8":"activities_Delete","Permission_9":"activities_View","Permission_10":"activities_Reports","Permission_11":"activitycategories_Add","Permission_12":"activitycategories_Edit","Permission_13":"activitycategories_Delete","Permission_14":"activitycategories_View","Permission_15":"activitycategories_Reports","Permission_16":"activityphotos_Add","Permission_17":"activityphotos_Edit","Permission_18":"activityphotos_Delete","Permission_19":"activityphotos_View","Permission_20":"activityphotos_Reports","Permission_21":"aggregationtypes_Add","Permission_22":"aggregationtypes_Edit","Permission_23":"aggregationtypes_Delete","Permission_24":"aggregationtypes_View","Permission_25":"aggregationtypes_Reports","Permission_26":"attendancelist_Add","Permission_27":"attendancelist_Edit","Permission_28":"attendancelist_Delete","Permission_29":"attendancelist_View","Permission_30":"attendancelist_Reports","Permission_31":"audittrail_Add","Permission_32":"audittrail_Edit","Permission_33":"audittrail_Delete","Permission_34":"audittrail_View","Permission_35":"audittrail_Reports","Permission_36":"beneficiaryregistration_Add","Permission_37":"beneficiaryregistration_Edit","Permission_38":"beneficiaryregistration_Delete","Permission_39":"beneficiaryregistration_View","Permission_40":"beneficiaryregistration_Reports","Permission_41":"beneficiarysubcategories_Add","Permission_42":"beneficiarysubcategories_Edit","Permission_43":"beneficiarysubcategories_Delete","Permission_44":"beneficiarysubcategories_View","Permission_45":"beneficiarysubcategories_Reports","Permission_46":"beneficiarytypes_Add","Permission_47":"beneficiarytypes_Edit","Permission_48":"beneficiarytypes_Delete","Permission_49":"beneficiarytypes_View","Permission_50":"beneficiarytypes_Reports","Permission_51":"calendar_Add","Permission_52":"calendar_Edit","Permission_53":"calendar_Delete","Permission_54":"calendar_View","Permission_55":"calendar_Reports","Permission_56":"captcha_Add","Permission_57":"captcha_Edit","Permission_58":"captcha_Delete","Permission_59":"captcha_View","Permission_60":"captcha_Reports","Permission_61":"cashforwork_Add","Permission_62":"cashforwork_Edit","Permission_63":"cashforwork_Delete","Permission_64":"cashforwork_View","Permission_65":"cashforwork_Reports","Permission_66":"constituencies_Add","Permission_67":"constituencies_Edit","Permission_68":"constituencies_Delete","Permission_69":"constituencies_View","Permission_70":"constituencies_Reports","Permission_71":"counties_Add","Permission_72":"counties_Edit","Permission_73":"counties_Delete","Permission_74":"counties_View","Permission_75":"counties_Reports","Permission_76":"countries_Add","Permission_77":"countries_Edit","Permission_78":"countries_Delete","Permission_79":"countries_View","Permission_80":"countries_Reports","Permission_81":"currencies_Add","Permission_82":"currencies_Edit","Permission_83":"currencies_Delete","Permission_84":"currencies_View","Permission_85":"currencies_Reports","Permission_86":"departments_Add","Permission_87":"departments_Edit","Permission_88":"departments_Delete","Permission_89":"departments_View","Permission_90":"departments_Reports","Permission_91":"districts_Add","Permission_92":"districts_Edit","Permission_93":"districts_Delete","Permission_94":"districts_View","Permission_95":"districts_Reports","Permission_96":"documentcategories_Add","Permission_97":"documentcategories_Edit","Permission_98":"documentcategories_Delete","Permission_99":"documentcategories_View","Permission_100":"documentcategories_Reports","Permission_101":"documents_Add","Permission_102":"documents_Edit","Permission_103":"documents_Delete","Permission_104":"documents_View","Permission_105":"documents_Reports","Permission_106":"donors_Add","Permission_107":"donors_Edit","Permission_108":"donors_Delete","Permission_109":"donors_View","Permission_110":"donors_Reports","Permission_111":"formcategories_Add","Permission_112":"formcategories_Edit","Permission_113":"formcategories_Delete","Permission_114":"formcategories_View","Permission_115":"formcategories_Reports","Permission_116":"formelements_Add","Permission_117":"formelements_Edit","Permission_118":"formelements_Delete","Permission_119":"formelements_View","Permission_120":"formelements_Reports","Permission_121":"forms_Add","Permission_122":"forms_Edit","Permission_123":"forms_Delete","Permission_124":"forms_View","Permission_125":"forms_Reports","Permission_126":"indicatorstracking_Add","Permission_127":"indicatorstracking_Edit","Permission_128":"indicatorstracking_Delete","Permission_129":"indicatorstracking_View","Permission_130":"indicatorstracking_Reports","Permission_131":"levelsofoperation_Add","Permission_132":"levelsofoperation_Edit","Permission_133":"levelsofoperation_Delete","Permission_134":"levelsofoperation_View","Permission_135":"levelsofoperation_Reports","Permission_136":"locations_Add","Permission_137":"locations_Edit","Permission_138":"locations_Delete","Permission_139":"locations_View","Permission_140":"locations_Reports","Permission_141":"lockedips_Add","Permission_142":"lockedips_Edit","Permission_143":"lockedips_Delete","Permission_144":"lockedips_View","Permission_145":"lockedips_Reports","Permission_146":"loginattempts_Add","Permission_147":"loginattempts_Edit","Permission_148":"loginattempts_Delete","Permission_149":"loginattempts_View","Permission_150":"loginattempts_Reports","Permission_151":"managementreports_Add","Permission_152":"managementreports_Edit","Permission_153":"managementreports_Delete","Permission_154":"managementreports_View","Permission_155":"managementreports_Reports","Permission_156":"monthlyreports_Add","Permission_157":"monthlyreports_Edit","Permission_158":"monthlyreports_Delete","Permission_159":"monthlyreports_View","Permission_160":"monthlyreports_Reports","Permission_161":"myusers_Add","Permission_162":"myusers_Edit","Permission_163":"myusers_Delete","Permission_164":"myusers_View","Permission_165":"myusers_Reports","Permission_166":"noncashdistribution_Add","Permission_167":"noncashdistribution_Edit","Permission_168":"noncashdistribution_Delete","Permission_169":"noncashdistribution_View","Permission_170":"noncashdistribution_Reports","Permission_171":"organizations_Add","Permission_172":"organizations_Edit","Permission_173":"organizations_Delete","Permission_174":"organizations_View","Permission_175":"organizations_Reports","Permission_176":"organizationtypes_Add","Permission_177":"organizationtypes_Edit","Permission_178":"organizationtypes_Delete","Permission_179":"organizationtypes_View","Permission_180":"organizationtypes_Reports","Permission_181":"outcomeindicatortracking_Add","Permission_182":"outcomeindicatortracking_Edit","Permission_183":"outcomeindicatortracking_Delete","Permission_184":"outcomeindicatortracking_View","Permission_185":"outcomeindicatortracking_Reports","Permission_186":"partners_Add","Permission_187":"partners_Edit","Permission_188":"partners_Delete","Permission_189":"partners_View","Permission_190":"partners_Reports","Permission_191":"passwordpolicies_Add","Permission_192":"passwordpolicies_Edit","Permission_193":"passwordpolicies_Delete","Permission_194":"passwordpolicies_View","Permission_195":"passwordpolicies_Reports","Permission_196":"permissions_Add","Permission_197":"permissions_Edit","Permission_198":"permissions_Delete","Permission_199":"permissions_View","Permission_200":"permissions_Reports","Permission_201":"profiles_Add","Permission_202":"profiles_Edit","Permission_203":"profiles_Delete","Permission_204":"profiles_View","Permission_205":"profiles_Reports","Permission_206":"programmeareas_Add","Permission_207":"programmeareas_Edit","Permission_208":"programmeareas_Delete","Permission_209":"programmeareas_View","Permission_210":"programmeareas_Reports","Permission_211":"projectactivities_Add","Permission_212":"projectactivities_Edit","Permission_213":"projectactivities_Delete","Permission_214":"projectactivities_View","Permission_215":"projectactivities_Reports","Permission_216":"projectactivitiesbeneficiaries_Add","Permission_217":"projectactivitiesbeneficiaries_Edit","Permission_218":"projectactivitiesbeneficiaries_Delete","Permission_219":"projectactivitiesbeneficiaries_View","Permission_220":"projectactivitiesbeneficiaries_Reports","Permission_221":"projectactivitiesbeneficiarycategories_Add","Permission_222":"projectactivitiesbeneficiarycategories_Edit","Permission_223":"projectactivitiesbeneficiarycategories_Delete","Permission_224":"projectactivitiesbeneficiarycategories_View","Permission_225":"projectactivitiesbeneficiarycategories_Reports","Permission_226":"projectactivitystatus_Add","Permission_227":"projectactivitystatus_Edit","Permission_228":"projectactivitystatus_Delete","Permission_229":"projectactivitystatus_View","Permission_230":"projectactivitystatus_Reports","Permission_231":"projectbeneficiaries_Add","Permission_232":"projectbeneficiaries_Edit","Permission_233":"projectbeneficiaries_Delete","Permission_234":"projectbeneficiaries_View","Permission_235":"projectbeneficiaries_Reports","Permission_236":"projectdiversities_Add","Permission_237":"projectdiversities_Edit","Permission_238":"projectdiversities_Delete","Permission_239":"projectdiversities_View","Permission_240":"projectdiversities_Reports","Permission_241":"projectdonors_Add","Permission_242":"projectdonors_Edit","Permission_243":"projectdonors_Delete","Permission_244":"projectdonors_View","Permission_245":"projectdonors_Reports","Permission_246":"projectobjectiveindicators_Add","Permission_247":"projectobjectiveindicators_Edit","Permission_248":"projectobjectiveindicators_Delete","Permission_249":"projectobjectiveindicators_View","Permission_250":"projectobjectiveindicators_Reports","Permission_251":"projectobjectives_Add","Permission_252":"projectobjectives_Edit","Permission_253":"projectobjectives_Delete","Permission_254":"projectobjectives_View","Permission_255":"projectobjectives_Reports","Permission_256":"projectoutcomeindicators_Add","Permission_257":"projectoutcomeindicators_Edit","Permission_258":"projectoutcomeindicators_Delete","Permission_259":"projectoutcomeindicators_View","Permission_260":"projectoutcomeindicators_Reports","Permission_261":"projectoutcomes_Add","Permission_262":"projectoutcomes_Edit","Permission_263":"projectoutcomes_Delete","Permission_264":"projectoutcomes_View","Permission_265":"projectoutcomes_Reports","Permission_266":"projectoutputindicators_Add","Permission_267":"projectoutputindicators_Edit","Permission_268":"projectoutputindicators_Delete","Permission_269":"projectoutputindicators_View","Permission_270":"projectoutputindicators_Reports","Permission_271":"projectoutputs_Add","Permission_272":"projectoutputs_Edit","Permission_273":"projectoutputs_Delete","Permission_274":"projectoutputs_View","Permission_275":"projectoutputs_Reports","Permission_276":"projectpartners_Add","Permission_277":"projectpartners_Edit","Permission_278":"projectpartners_Delete","Permission_279":"projectpartners_View","Permission_280":"projectpartners_Reports","Permission_281":"projectplannedactivities_Add","Permission_282":"projectplannedactivities_Edit","Permission_283":"projectplannedactivities_Delete","Permission_284":"projectplannedactivities_View","Permission_285":"projectplannedactivities_Reports","Permission_286":"projects_Add","Permission_287":"projects_Edit","Permission_288":"projects_Delete","Permission_289":"projects_View","Permission_290":"projects_Reports","Permission_291":"projectscounties_Add","Permission_292":"projectscounties_Edit","Permission_293":"projectscounties_Delete","Permission_294":"projectscounties_View","Permission_295":"projectscounties_Reports","Permission_296":"projectsdistricts_Add","Permission_297":"projectsdistricts_Edit","Permission_298":"projectsdistricts_Delete","Permission_299":"projectsdistricts_View","Permission_300":"projectsdistricts_Reports","Permission_301":"projectsectors_Add","Permission_302":"projectsectors_Edit","Permission_303":"projectsectors_Delete","Permission_304":"projectsectors_View","Permission_305":"projectsectors_Reports","Permission_306":"projectsmandeplans_Add","Permission_307":"projectsmandeplans_Edit","Permission_308":"projectsmandeplans_Delete","Permission_309":"projectsmandeplans_View","Permission_310":"projectsmandeplans_Reports","Permission_311":"reportinglines_Add","Permission_312":"reportinglines_Edit","Permission_313":"reportinglines_Delete","Permission_314":"reportinglines_View","Permission_315":"reportinglines_Reports","Permission_316":"responses_Add","Permission_317":"responses_Edit","Permission_318":"responses_Delete","Permission_319":"responses_View","Permission_320":"responses_Reports","Permission_321":"rolefunctionpermission_Add","Permission_322":"rolefunctionpermission_Edit","Permission_323":"rolefunctionpermission_Delete","Permission_324":"rolefunctionpermission_View","Permission_325":"rolefunctionpermission_Reports","Permission_326":"rolepermission_Add","Permission_327":"rolepermission_Edit","Permission_328":"rolepermission_Delete","Permission_329":"rolepermission_View","Permission_330":"rolepermission_Reports","Permission_331":"roles_Add","Permission_332":"roles_Edit","Permission_333":"roles_Delete","Permission_334":"roles_View","Permission_335":"roles_Reports","Permission_336":"rollingactionplanassignees_Add","Permission_337":"rollingactionplanassignees_Edit","Permission_338":"rollingactionplanassignees_Delete","Permission_339":"rollingactionplanassignees_View","Permission_340":"rollingactionplanassignees_Reports","Permission_341":"rollingactionplandependancies_Add","Permission_342":"rollingactionplandependancies_Edit","Permission_343":"rollingactionplandependancies_Delete","Permission_344":"rollingactionplandependancies_View","Permission_345":"rollingactionplandependancies_Reports","Permission_346":"rollingactionplanlogs_Add","Permission_347":"rollingactionplanlogs_Edit","Permission_348":"rollingactionplanlogs_Delete","Permission_349":"rollingactionplanlogs_View","Permission_350":"rollingactionplanlogs_Reports","Permission_351":"rollingactionplanmilestones_Add","Permission_352":"rollingactionplanmilestones_Edit","Permission_353":"rollingactionplanmilestones_Delete","Permission_354":"rollingactionplanmilestones_View","Permission_355":"rollingactionplanmilestones_Reports","Permission_356":"rollingactionplans_Add","Permission_357":"rollingactionplans_Edit","Permission_358":"rollingactionplans_Delete","Permission_359":"rollingactionplans_View","Permission_360":"rollingactionplans_Reports","Permission_361":"savedreports_Add","Permission_362":"savedreports_Edit","Permission_363":"savedreports_Delete","Permission_364":"savedreports_View","Permission_365":"savedreports_Reports","Permission_366":"sectors_Add","Permission_367":"sectors_Edit","Permission_368":"sectors_Delete","Permission_369":"sectors_View","Permission_370":"sectors_Reports","Permission_371":"staff_Add","Permission_372":"staff_Edit","Permission_373":"staff_Delete","Permission_374":"staff_View","Permission_375":"staff_Reports","Permission_376":"statisticalreports_Add","Permission_377":"statisticalreports_Edit","Permission_378":"statisticalreports_Delete","Permission_379":"statisticalreports_View","Permission_380":"statisticalreports_Reports","Permission_381":"subcounties_Add","Permission_382":"subcounties_Edit","Permission_383":"subcounties_Delete","Permission_384":"subcounties_View","Permission_385":"subcounties_Reports","Permission_386":"sublocations_Add","Permission_387":"sublocations_Edit","Permission_388":"sublocations_Delete","Permission_389":"sublocations_View","Permission_390":"sublocations_Reports","Permission_391":"subsectors_Add","Permission_392":"subsectors_Edit","Permission_393":"subsectors_Delete","Permission_394":"subsectors_View","Permission_395":"subsectors_Reports","Permission_396":"taskcategories_Add","Permission_397":"taskcategories_Edit","Permission_398":"taskcategories_Delete","Permission_399":"taskcategories_View","Permission_400":"taskcategories_Reports","Permission_401":"tasks_Add","Permission_402":"tasks_Edit","Permission_403":"tasks_Delete","Permission_404":"tasks_View","Permission_405":"tasks_Reports","Permission_406":"trainingreports_Add","Permission_407":"trainingreports_Edit","Permission_408":"trainingreports_Delete","Permission_409":"trainingreports_View","Permission_410":"trainingreports_Reports","Permission_411":"typesofsupport_Add","Permission_412":"typesofsupport_Edit","Permission_413":"typesofsupport_Delete","Permission_414":"typesofsupport_View","Permission_415":"typesofsupport_Reports","Permission_416":"users_Add","Permission_417":"users_Edit","Permission_418":"users_Delete","Permission_419":"users_View","Permission_420":"users_Reports"}]'),
(2, 2, 'User', '[{"Function_1":"activities","Function_2":"documents","Function_3":"profiles","Function_4":"projects"}]', '[{"Permission_1":"Add","Permission_2":"Edit","Permission_3":"Delete","Permission_4":"View"}]');

-- --------------------------------------------------------

--
-- Table structure for table `rolepermission`
--

CREATE TABLE IF NOT EXISTS `rolepermission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `permission` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'SuperAdmin', 'Super Administrator'),
(2, 'User', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `rollingactionplanassignees`
--

CREATE TABLE IF NOT EXISTS `rollingactionplanassignees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rollingactionplan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `rollingactionplanassignees`
--

INSERT INTO `rollingactionplanassignees` (`id`, `user_id`, `rollingactionplan_id`) VALUES
(14, 1, 1),
(15, 2, 1),
(19, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rollingactionplandependancies`
--

CREATE TABLE IF NOT EXISTS `rollingactionplandependancies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollingactionplan_id` int(11) NOT NULL,
  `dependancy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rollingactionplandependancies`
--

INSERT INTO `rollingactionplandependancies` (`id`, `rollingactionplan_id`, `dependancy_id`) VALUES
(2, 2, 0),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rollingactionplanlogs`
--

CREATE TABLE IF NOT EXISTS `rollingactionplanlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollingactionplan_id` int(11) NOT NULL,
  `tasklog_date` date NOT NULL,
  `progress` varchar(30) NOT NULL,
  `hours_worked` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rollingactionplanlogs`
--

INSERT INTO `rollingactionplanlogs` (`id`, `rollingactionplan_id`, `tasklog_date`, `progress`, `hours_worked`, `description`, `user_id`) VALUES
(1, 1, '2016-11-10', '40', '10', 'Some work done', 1),
(2, 2, '2016-12-01', '100', '-', 'This was a community entry activity conducted by CS 2 Dangroyo Team in Dangoroyo District of Nugaal Region', 1),
(3, 1, '2016-12-01', '100', '-', 'This is an activity', 1),
(4, 1, '2017-04-18', '100', '-', 'This is an activity', 1),
(5, 1, '2017-04-24', '100', '-', 'This was a community entry activity done by the CS 1 Harfo team in Mudug region, Harfo District and Harfo Community', 1),
(6, 1, '2017-04-24', '100', '-', 'This was a community entry activity done by the CS 1 Harfo team in Mudug region, Harfo District and Harfo Community', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rollingactionplanmilestones`
--

CREATE TABLE IF NOT EXISTS `rollingactionplanmilestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `milestone` varchar(255) NOT NULL,
  `milestone_date` date NOT NULL,
  `rollingactionplan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `rollingactionplanmilestones`
--

INSERT INTO `rollingactionplanmilestones` (`id`, `milestone`, `milestone_date`, `rollingactionplan_id`) VALUES
(10, 'Milestone two', '2016-11-14', 1),
(14, 'Draft Plan', '2016-12-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rollingactionplans`
--

CREATE TABLE IF NOT EXISTS `rollingactionplans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `plannedactivity_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `progress` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `task_owner_id` int(11) NOT NULL,
  `task_type` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `target_budget` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_date` date NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `organization_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `primary_activity` int(11) NOT NULL,
  `taskcategory_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rollingactionplans`
--

INSERT INTO `rollingactionplans` (`id`, `project_id`, `plannedactivity_id`, `task_name`, `status`, `progress`, `priority`, `task_owner_id`, `task_type`, `parent_id`, `target_budget`, `description`, `start_date`, `start_time`, `end_date`, `end_time`, `date_created`, `organization_id`, `county_id`, `primary_activity`, `taskcategory_id`, `task_id`) VALUES
(1, 1, 1, 'Organize plan', 'Active', '100', 'Low', 1, 'Administrative', 0, '1000', 'Test', '2016-11-12', '08:30', '2016-11-23', '16:00', '2016-09-09', 1, 1, 1, 1, 0),
(2, 1, 1, 'Prepare Plan', 'Active', '20', 'Medium', 1, 'Unknown', 0, '0', 'Prepare the community safety plans', '2016-11-25', '08:00', '2016-03-15', '17:00', '2016-03-31', 1, 2, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savedreports`
--

CREATE TABLE IF NOT EXISTS `savedreports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reporttitle` varchar(255) NOT NULL,
  `searchparameter` varchar(100) NOT NULL,
  `searchvalue` varchar(30) NOT NULL,
  `from_year` varchar(100) NOT NULL,
  `from_month` varchar(100) NOT NULL,
  `to_year` varchar(100) NOT NULL,
  `to_month` varchar(100) NOT NULL,
  `reportmethod` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_saved` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `savedreports`
--

INSERT INTO `savedreports` (`id`, `reporttitle`, `searchparameter`, `searchvalue`, `from_year`, `from_month`, `to_year`, `to_month`, `reportmethod`, `user_id`, `date_saved`) VALUES
(1, 'BENEFICIARIES REACHED IN Awdal FROM 01 January 2015 TO 31 December 2015', 'county_id', '17', '2015', '01', '2015', '12', 'benficiariesregionreport', 1, '2016-10-02'),
(2, 'BENEFICIARIES REACHED IN Awdal FROM 01 January 2015 TO 30 December 2015', 'county_id', '17', '2015', '01', '2015', '12', 'benficiariesregionreport', 1, '2016-10-02'),
(4, 'BENEFICIARIES REACHED BY Police-Community Dialogue and Community Safety in Puntland FROM 01 January 2015 TO 31 December 2015', 'project_id', '1', '2015', '01', '2015', '12', 'benficiariesprojectreport', 1, '2016-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector` varchar(100) NOT NULL,
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `sector`, `organization_id`) VALUES
(1, 'Food Security and Livelihood', 1),
(2, 'WASH', 1),
(3, 'NFI/Shelter', 1),
(4, 'Advocacy and Protection', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `reportingline_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `email`, `telephone`, `department_id`, `reportingline_id`) VALUES
(1, 'Johannes Fromholt', 'J.Fromholt@ddghoa.org', '+254 (0) 727 583 132', 1, 0),
(2, 'John Udalang''', 'j.udalang@drchoa.org', '254722780026', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `statisticalreports`
--

CREATE TABLE IF NOT EXISTS `statisticalreports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `statistic_month` varchar(100) NOT NULL,
  `statistic_year` varchar(100) NOT NULL,
  `overal_status` text NOT NULL,
  `map_json` text NOT NULL,
  `status_of_activity` text NOT NULL,
  `series_category` text NOT NULL,
  `series` text NOT NULL,
  `pie_data` text NOT NULL,
  `activity_table` text NOT NULL,
  `beneficiaries_reached` text NOT NULL,
  `beneficiaries_by_sector` text NOT NULL,
  `target_vs_reached` text NOT NULL,
  `beneficiaries_by_district` text NOT NULL,
  `activities_beneficiaries` text NOT NULL,
  `projects_beneficiaries` text NOT NULL,
  `graphcategories` text NOT NULL,
  `graphseries` text NOT NULL,
  `map_name` varchar(100) NOT NULL,
  `task_pie` varchar(100) NOT NULL,
  `distribution_graph` varchar(100) NOT NULL,
  `sector_graph` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `statisticalreports`
--

INSERT INTO `statisticalreports` (`id`, `country_id`, `statistic_month`, `statistic_year`, `overal_status`, `map_json`, `status_of_activity`, `series_category`, `series`, `pie_data`, `activity_table`, `beneficiaries_reached`, `beneficiaries_by_sector`, `target_vs_reached`, `beneficiaries_by_district`, `activities_beneficiaries`, `projects_beneficiaries`, `graphcategories`, `graphseries`, `map_name`, `task_pie`, `distribution_graph`, `sector_graph`) VALUES
(1, 2, '04', '2016', '<ul>\r\n				<li>In the month of April 2016, (1/1) 100.0% of projects were ongoing in 18 regions in Somalia, covering 4 sectors.</li>\r\n				<li>Advocacy and Protection covered most of the projects with a total of 1 projects implemented by the sector</li>\r\n				<li>Somalia Stability Fund remains the leading donor with 1 projects funded accounting for 100.0% of all the projects supported by donors.</li>\r\n				</ul><p>The table below gives a summary of the status of projects per sector in Somalia as of end of April 2016.</p><table id="disttable"  border="1" cellspacing="0" cellpadding="1" bordercolor="#892a24" width="75%">\r\n	<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Sector</strong></font></th><th><font color="#FFFFFF"><strong>Closed</strong></font></th><th><font color="#FFFFFF"><strong>New</strong></font></th><th><font color="#FFFFFF"><strong>Ongoing</strong></font></th></tr><tr  bgcolor=""><td>Food Security and Livelihood</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>WASH</td><td>0</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td>NFI/Shelter</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Advocacy and Protection</td><td>0</td><td>0</td><td>1</td></tr></table><p><font color="#FF0000"><sup>*</sup></font> Please note. A sector may be covered in more than one project.</p>', '[{"position":{"lat":"10.120385","lng":"49.691137"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Bari\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Police-Community Dialogue and Community Safety in Puntland\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: 515-708\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 16 June 2015\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 15 June 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: Somalia Stability Fund,\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Advocacy and Protection,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "},{"position":{"lat":"8.183177","lng":"49.305911"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Nugal\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Police-Community Dialogue and Community Safety in Puntland\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: 515-708\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 16 June 2015\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 15 June 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: Somalia Stability Fund,\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Advocacy and Protection,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "},{"position":{"lat":"6.565673","lng":"47.763756"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Mudug\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Police-Community Dialogue and Community Safety in Puntland\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: 515-708\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 16 June 2015\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 15 June 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: Somalia Stability Fund,\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Advocacy and Protection,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "},{"position":{"lat":"10.120385","lng":"49.691137"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Bari\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Providing Access to Education for Vulnerable Communities\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: PRJ-0001\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: Test\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 01 October 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 02 October 2017\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: European Union (EU),\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Food Security and Livelihood,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "}]', '<ul>\r\n	<li>A total of 2 activity milestones were implemented in the month of April 2016</li>\r\n	<li>Awdal region accounted for the highest number of sub activities reported, with a total of 2 out of the 2 sub activities implemented.</li>\r\n	<li>Training/Capacity Building accounted for majority of the sub activities implemented at (50.0%) with Events, which can be sub-grouped into Awareness Creation, Mobilization being second at (50.0%) and Trainings and Ceremonies/Meetings the third most implemented sub activity respectively.</li>\r\n	</ul><table id="disttable" width="75%" border="1" cellspacing="0" cellpadding="2" bordercolor="#892a24">\r\n	<tr bgcolor="#892a24">\r\n	  <th width="50%"><font color="#FFFFFF"><strong>Region</strong></font></th><th><font color="#FFFFFF"><strong># of Sub activities</strong></font></th><th><font color="#FFFFFF"><strong>Completed</strong></font></th><th><font color="#FFFFFF"><strong>On time</strong></font></th><th><font color="#FFFFFF"><strong>Warning</strong></font></th><th><font color="#FFFFFF"><strong>Overdue</strong></font></th></tr>\r\n	<tr  bgcolor=""><td width="50%">Bari</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sanaag</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Nugal</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sool</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Benadir</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Mudug</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Galgaduud</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Hiraan</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Gedo</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Shabelle</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Middle Shabelle</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Bay</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Middle Juba</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Juba</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Bakool</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Togdheer</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Awdal</td><td>2</td><td>1</td><td>1</td><td>0</td><td>1</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Woqooyi Galbeed</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Total</strong></font></th><th><font color="#FFFFFF"><strong>2</strong></font></th><th><font color="#FFFFFF"><strong>1</strong></font></th><th><font color="#FFFFFF"><strong>1</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th><th><font color="#FFFFFF"><strong>1</strong></font></th></tr>\r\n	</table>', '''Bari'',''Sanaag'',''Nugal'',''Sool'',''Benadir'',''Mudug'',''Galgaduud'',''Hiraan'',''Gedo'',''Lower Shabelle'',''Middle Shabelle'',''Bay'',''Middle Juba'',''Lower Juba'',''Bakool'',''Togdheer'',''Awdal'',''Woqooyi Galbeed'',', '{\r\n							name: ''Training/Capacity Building'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,] },{\r\n							name: ''Events, which can be sub-grouped into Awareness Creation, Mobilization'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,] },{\r\n							name: ''Trainings and Ceremonies/Meetings'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Construction/Rehabilitation/Installations'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Distributions/Disbursement'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''M&E QA '',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Assessments'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Outdoor Events(Tournaments, debates and awareness campaigns)'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Technical Support'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Food Distribution'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Construction/Rehabilitation'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''NFI Distribution'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Cash Distribution'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Supplies'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Monitoring and Evaluation'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },', '[''Completed'',     1],\r\n					  [''On Time'',   1],\r\n					  [''Warning'',   0],\r\n					  [''Overdue'',   1]', '<table id="disttable" width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n			<thead>\r\n			<tr bgcolor="#892a24"><th><font color="#FFFFFF"><strong>Activity type</strong></font></th><th><font color="#FFFFFF"><strong>Number Implemented</strong></font></th></tr>\r\n			</thead>\r\n			<tbody>\r\n			<tr  bgcolor=""><td>Training/Capacity Building</td><td>1</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Events, which can be sub-grouped into Awareness Creation, Mobilization</td><td>1</td></tr><tr  bgcolor=""><td>Trainings and Ceremonies/Meetings</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Construction/Rehabilitation/Installations</td><td>0</td></tr><tr  bgcolor=""><td>Distributions/Disbursement</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>M&E QA </td><td>0</td></tr><tr  bgcolor=""><td>Assessments</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Outdoor Events(Tournaments, debates and awareness campaigns)</td><td>0</td></tr><tr  bgcolor=""><td>Technical Support</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Food Distribution</td><td>0</td></tr><tr  bgcolor=""><td>Construction/Rehabilitation</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>NFI Distribution</td><td>0</td></tr><tr  bgcolor=""><td>Cash Distribution</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Supplies</td><td>0</td></tr><tr  bgcolor=""><td>Monitoring and Evaluation</td><td>0</td></tr></tbody></table>', '\r\n			<ul>\r\n	<li>During the month of April 2016, a total of 200 beneficiaries were reached in 18 regions of Somalia.</li>\r\n	<li>The highest number of beneficiaries reached were IDPs at 200 reached, accounting for (100.0%) of the total,followed by Migrants (0.0%) and GBV Survivors (0.0%)</li>\r\n	\r\n	</ul><p>The table below provides a list detailing in numbers and percentages, diferent categories of beneficiaries that were reported as reached during the reporting month of April 2016.</p><table id="disttable" width="85%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n		<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Beneficiary Type</strong></font></th><th><font color="#FFFFFF"><strong># Reached</strong></font></th><th><font color="#FFFFFF"><strong>%</strong></font></th></tr>\r\n		<tr  bgcolor=""><td width="50%">IDPs</td><td>200</td><td>100.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Migrants</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">GBV Survivors</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Male</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">Female</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Returnees</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">People living with disabilities</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Female-headed Household (FoH)</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">Child-headed Household (CoH)</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Expectant /breastfeeding mother</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">Elderly</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Host Community</td><td>0</td><td>0.0%</td></tr></table>', '<table width="72%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24" id="datatable">\r\n		<thead>\r\n			<tr bgcolor="#892a24"><th width="50%">&nbsp;</th>\r\n				  <th><font color="#FFFFFF"><strong>0-4 M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>0-4 F</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>5-17 M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>5-17 F</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>18-59 M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>18-59 F</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>60 &> M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>60 &> F</strong></font></th></tr></thead><tbody><tr  bgcolor=""><th width="50%">Food Security and Livelihood</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><th width="50%">WASH</th><td>6</td><td>30</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr  bgcolor=""><th width="50%">NFI/Shelter</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><th width="50%">Advocacy and Protection</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody></table>', '<table id="disttable" width="85%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n		<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Beneficiary Type</strong></font></th><th><font color="#FFFFFF"><strong>Target</strong></font></th><th><font color="#FFFFFF"><strong>Reached</strong></font></th></tr><tr  bgcolor=""><td width="50%">IDPs</td><td>100</td><td>200</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Female-headed Household (FoH)</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Child-headed Household (CoH)</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Expectant /breastfeeding mother</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Elderly</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">People living with disabilities</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Host Community</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Returnees</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Migrants</td><td>200</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">GBV Survivors</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Male</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Female</td><td>0</td><td>0</td></tr><tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Total</strong></font></th><th><font color="#FFFFFF"><strong>300</strong></font></th><th><font color="#FFFFFF"><strong>200</strong></font></th></tr></table>', '<table id="disttable" width="72%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n		<thead>\r\n			<tr>\r\n			  <th bgcolor="#892a24" width="50%"><font color="#FFFFFF"><strong>Region</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>0-4 M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>0-4 F</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>5-17 M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>5-17 F</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>18-59 M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>18-59 F</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>60 &> M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>60 &> F</strong></font></th></tr>\r\n		</thead>\r\n		<tbody><tr  bgcolor=""><td width="50%">Bari</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sanaag</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Nugal</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sool</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Benadir</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Mudug</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Galgaduud</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Hiraan</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Gedo</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Shabelle</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Middle Shabelle</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Bay</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Middle Juba</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Juba</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Bakool</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Togdheer</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Awdal</td>\r\n				  <td>6</td>\r\n				  <td>30</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Woqooyi Galbeed</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr></tbody></table>', '<table id="disttable" width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#892a24">\r\n		<thead>\r\n			<tr bgcolor="#892a24">\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Project Code</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Sector</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Sub Activity</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Sub activity description</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>status</strong></font></th>\r\n				\r\n				<th colspan="3">\r\n					<font color="#FFFFFF"><strong>Beneficiaries (by gender)</strong></font></th>\r\n				\r\n				<th colspan="2"><font color="#FFFFFF"><strong>Beneficiaries (uncategorised)</strong></font></th>\r\n			</tr>\r\n			</thead>\r\n			<tbody>\r\n			<tr>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				\r\n				<td><strong>Male</strong></td>\r\n				<td><strong>Female</strong></td>\r\n				<td><strong>Total</strong></td>\r\n				<td><strong>Target</strong></td>\r\n				<td><strong>Numbers Reached</strong></td>\r\n			</tr><tr  bgcolor="">\r\n				<td>\r\n					515-708</td>			\r\n					<td>\r\n					WASH</td>\r\n				<td>\r\n					Test activity</td>\r\n				<td>\r\n					This is an activity</td>\r\n				<td>\r\n					Completed</td>\r\n				\r\n				<td>6</td>\r\n				<td>0</td>\r\n				<td>6</td>\r\n				<td>1,000</td>\r\n				<td>100</td>\r\n			</tr><tr class="alt" bgcolor="#eaf2d3">\r\n				<td>\r\n					515-708</td>			\r\n					<td>\r\n					WASH</td>\r\n				<td>\r\n					Test activity</td>\r\n				<td>\r\n					This is an activity</td>\r\n				<td>\r\n					Completed</td>\r\n				\r\n				<td>0</td>\r\n				<td>30</td>\r\n				<td>30</td>\r\n				<td>1,000</td>\r\n				<td>100</td>\r\n			</tr><tr>\r\n				<td colspan="5">TOTAL BENEFICIARIES REPORTED REACHED DURING THE MONTH</td>\r\n				<td><strong>6</strong></td>\r\n				<td><strong>30</strong></td>\r\n				<td><strong>36</strong></td>\r\n				<td><strong>2,000</strong></td>\r\n				<td><strong>200</strong></td>\r\n			</tr></tbody>\r\n	</table>', '<table id="disttable" width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#892a24">\r\n		<thead>\r\n			<tr  bgcolor="#892a24">\r\n				<th><font color="#FFFFFF"><strong>Project Code</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>Project</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>Start Date</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>End Date</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>status</strong></font></th>\r\n				<th colspan="3"><font color="#FFFFFF"><strong>Beneficiaries (by gender)</strong></font></th>\r\n				<th colspan="2"><font color="#FFFFFF"><strong>Beneficiaries (uncategorised)</strong></font></th>\r\n			</tr>\r\n			\r\n			</thead><tbody>\r\n			<tr>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				\r\n				<td><strong>Male</strong></td>\r\n				<td><strong>Female</strong></td>\r\n				<td><strong>Total</strong></td>\r\n				<td><strong>Target</strong></td>\r\n				<td><strong>Numbers Reached</strong></td>\r\n			</tr><tr  bgcolor="">\r\n					<td>\r\n						515-708</td>\r\n					<td>\r\n						Police-Community Dialogue and Community Safety in Puntland</td>\r\n					<td>\r\n						2015-06-16</td>\r\n					<td>\r\n						2016-06-15</td>\r\n					<td>\r\n						On going</td>\r\n					\r\n					<td>6</td>\r\n					<td>30</td>\r\n					<td>36</td>\r\n					<td>300</td>\r\n					<td>200</td>\r\n				</tr><tr>\r\n				<td colspan="5">TOTAL BENEFICIARIES REPORTED REACHED DURING THE MONTH</td>\r\n				<td><strong>6</strong></td>\r\n				<td><strong>30</strong></td>\r\n				<td><strong>36</strong></td>\r\n				<td><strong>300</strong></td>\r\n				<td><strong>200</strong></td>\r\n			</tr></tbody>\r\n	</table>', '''Food Security and Livelihood'',''WASH'',''NFI/Shelter'',''Advocacy and Protection'',', '{\r\n                name: ''0-4 M'',\r\n				data: [0,6,0,0,]\r\n					},{\r\n                name: ''0-4 F'',\r\n				data: [0,30,0,0,]\r\n					},{\r\n                name: ''5-17 M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''5-17 F'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''18-59 M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''18-59 F'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''60 &> M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''60 &> F'',\r\n				data: [0,0,0,0,]\r\n					},', 'Somalia_April_2016.jpg', 'pie_Somalia_April_2016.jpg', 'graph_Somalia_April_2016.jpg', 'sectorgraph_Somalia_April_2016.jpg');
INSERT INTO `statisticalreports` (`id`, `country_id`, `statistic_month`, `statistic_year`, `overal_status`, `map_json`, `status_of_activity`, `series_category`, `series`, `pie_data`, `activity_table`, `beneficiaries_reached`, `beneficiaries_by_sector`, `target_vs_reached`, `beneficiaries_by_district`, `activities_beneficiaries`, `projects_beneficiaries`, `graphcategories`, `graphseries`, `map_name`, `task_pie`, `distribution_graph`, `sector_graph`) VALUES
(2, 2, '05', '2016', '<ul>\r\n				<li>In the month of May 2016, (1/1) 100.0% of projects were ongoing in 18 regions in Somalia, covering 4 sectors.</li>\r\n				<li>Advocacy and Protection covered most of the projects with a total of 1 projects implemented by the sector</li>\r\n				<li>Somalia Stability Fund remains the leading donor with 1 projects funded accounting for 100.0% of all the projects supported by donors.</li>\r\n				</ul><p>The table below gives a summary of the status of projects per sector in Somalia as of end of May 2016.</p><p>Danish Refugee Council</p><table id="disttable"  border="1" cellspacing="0" cellpadding="1" bordercolor="#892a24" width="75%">\r\n	<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Sector</strong></font></th><th><font color="#FFFFFF"><strong>Closed</strong></font></th><th><font color="#FFFFFF"><strong>New</strong></font></th><th><font color="#FFFFFF"><strong>Ongoing</strong></font></th></tr><tr  bgcolor=""><td>Advocacy and Protection</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Advocacy and Protection</td><td>0</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td>Advocacy and Protection</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Advocacy and Protection</td><td>0</td><td>0</td><td>1</td></tr><tr bgcolor="#892a24"><td>&nbsp;</td><td><font color="#FFFFFF"><strong>0</strong></font></td><td><font color="#FFFFFF"><strong>0</strong></font></td><td><font color="#FFFFFF"><strong>1</strong></font></td></tr></table><p>Danish Demining Group</p><table id="disttable"  border="1" cellspacing="0" cellpadding="1" bordercolor="#892a24" width="75%">\r\n	<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Sector</strong></font></th><th><font color="#FFFFFF"><strong>Closed</strong></font></th><th><font color="#FFFFFF"><strong>New</strong></font></th><th><font color="#FFFFFF"><strong>Ongoing</strong></font></th></tr><tr bgcolor="#892a24"><td>&nbsp;</td><td><font color="#FFFFFF"><strong>0</strong></font></td><td><font color="#FFFFFF"><strong>0</strong></font></td><td><font color="#FFFFFF"><strong>0</strong></font></td></tr></table><p><font color="#FF0000"><sup>*</sup></font> Please note. A sector may be covered in more than one project.</p>', '[{"position":{"lat":"10.120385","lng":"49.691137"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Bari\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Police-Community Dialogue and Community Safety in Puntland\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: 515-708\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 16 June 2015\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 15 June 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: Somalia Stability Fund,\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Advocacy and Protection,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "},{"position":{"lat":"8.183177","lng":"49.305911"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Nugal\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Police-Community Dialogue and Community Safety in Puntland\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: 515-708\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 16 June 2015\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 15 June 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: Somalia Stability Fund,\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Advocacy and Protection,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "},{"position":{"lat":"6.565673","lng":"47.763756"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Mudug\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Police-Community Dialogue and Community Safety in Puntland\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: 515-708\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: The strategic objective of the project is to contribute to the security and stabilization of fragile parts of Puntland by improving community safety and security provision for the beneficiaries in target locations.\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 16 June 2015\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 15 June 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: Somalia Stability Fund,\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Advocacy and Protection,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "},{"position":{"lat":"10.120385","lng":"49.691137"},"icon":"http:\\/\\/localhost:81\\/drcdbase\\/img\\/other.png","info":"\\r\\n\\t\\t\\t\\t\\t\\t   District: Bari\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project: Providing Access to Education for Vulnerable Communities\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project No.: PRJ-0001\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Objective: Test\\u003Cbr\\u003E\\t\\t\\t\\t\\t  \\r\\n\\t\\t\\t\\t\\t\\t   Project Start: 01 October 2016\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Project End: 02 October 2017\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Donor: European Union (EU),\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Budget: 0 0\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   Sector(s): Food Security and Livelihood,\\u003Cbr\\u003E \\r\\n\\t\\t\\t\\t\\t\\t   Status: On going\\u003Cbr\\u003E\\r\\n\\t\\t\\t\\t\\t\\t   "}]', '<ul>\r\n	<li>A total of 0 sub activities were implemented in the month of May 2016</li>\r\n	<li>Bari region accounted for the highest number of sub activities reported, with a total of 0 out of the 0 sub activities implemented.</li>\r\n	<li>Trainings and Ceremonies/Meetings accounted for majority of the sub activities implemented at (0.0%) with Assessments being second and Construction/Rehabilitation/Installations the third most implemented sub activity respectively.</li>\r\n	</ul><table id="disttable" width="75%" border="1" cellspacing="0" cellpadding="2" bordercolor="#892a24">\r\n	<tr bgcolor="#892a24">\r\n	  <th width="50%"><font color="#FFFFFF"><strong>Region</strong></font></th><th><font color="#FFFFFF"><strong># of Sub activities</strong></font></th><th><font color="#FFFFFF"><strong>Completed</strong></font></th><th><font color="#FFFFFF"><strong>On time</strong></font></th><th><font color="#FFFFFF"><strong>Warning</strong></font></th><th><font color="#FFFFFF"><strong>Overdue</strong></font></th></tr>\r\n	<tr  bgcolor=""><td width="50%">Bari</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sanaag</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Nugal</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sool</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Benadir</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Mudug</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Galgaduud</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Hiraan</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Gedo</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Shabelle</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Middle Shabelle</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Bay</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Middle Juba</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Juba</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Bakool</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Togdheer</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr  bgcolor=""><td width="50%">Awdal</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>\r\n	<tr class="alt" bgcolor="#eaf2d3"><td width="50%">Woqooyi Galbeed</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Total</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th></tr>\r\n	</table>', '''Bari'',''Sanaag'',''Nugal'',''Sool'',''Benadir'',''Mudug'',''Galgaduud'',''Hiraan'',''Gedo'',''Lower Shabelle'',''Middle Shabelle'',''Bay'',''Middle Juba'',''Lower Juba'',''Bakool'',''Togdheer'',''Awdal'',''Woqooyi Galbeed'',', '{\r\n							name: ''Trainings and Ceremonies/Meetings'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Assessments'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Construction/Rehabilitation/Installations'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Outdoor Events(Tournaments, debates and awareness campaigns)'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''M&E QA '',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Distributions/Disbursement'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Monitoring and Evaluation'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Technical Support'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Construction/Rehabilitation'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Events, which can be sub-grouped into Awareness Creation, Mobilization'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Food Distribution'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''NFI Distribution'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Supplies'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Cash Distribution'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },{\r\n							name: ''Training/Capacity Building'',data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,] },', '[''Completed'',     0],\r\n					  [''On Time'',   0],\r\n					  [''Warning'',   0],\r\n					  [''Overdue'',   0]', '<table id="disttable" width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n			<thead>\r\n			<tr bgcolor="#892a24"><th><font color="#FFFFFF"><strong>Activity type</strong></font></th><th><font color="#FFFFFF"><strong>Number Implemented</strong></font></th></tr>\r\n			</thead>\r\n			<tbody>\r\n			<tr  bgcolor=""><td>Trainings and Ceremonies/Meetings</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Assessments</td><td>0</td></tr><tr  bgcolor=""><td>Construction/Rehabilitation/Installations</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Outdoor Events(Tournaments, debates and awareness campaigns)</td><td>0</td></tr><tr  bgcolor=""><td>M&E QA </td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Distributions/Disbursement</td><td>0</td></tr><tr  bgcolor=""><td>Monitoring and Evaluation</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Technical Support</td><td>0</td></tr><tr  bgcolor=""><td>Construction/Rehabilitation</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Events, which can be sub-grouped into Awareness Creation, Mobilization</td><td>0</td></tr><tr  bgcolor=""><td>Food Distribution</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>NFI Distribution</td><td>0</td></tr><tr  bgcolor=""><td>Supplies</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td>Cash Distribution</td><td>0</td></tr><tr  bgcolor=""><td>Training/Capacity Building</td><td>0</td></tr></tbody></table>', '\r\n			<ul>\r\n	<li>During the month of May 2016, a total of 0 beneficiaries were reached in 18 regions of Somalia.</li>\r\n	<li>The highest number of beneficiaries reached were Migrants at 0 reached, accounting for (0.0%) of the total,followed by Returnees (0.0%) and GBV Survivors (0.0%)</li>\r\n	\r\n	</ul><p>The table below provides a list detailing in numbers and percentages, diferent categories of beneficiaries that were reported as reached during the reporting month of May 2016.</p><table id="disttable" width="85%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n		<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Beneficiary Type</strong></font></th><th><font color="#FFFFFF"><strong># Reached</strong></font></th><th><font color="#FFFFFF"><strong>%</strong></font></th></tr>\r\n		<tr  bgcolor=""><td width="50%">Migrants</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Returnees</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">GBV Survivors</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Male</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">Female</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Host Community</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">People living with disabilities</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Female-headed Household (FoH)</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">Child-headed Household (CoH)</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Expectant /breastfeeding mother</td><td>0</td><td>0.0%</td></tr><tr  bgcolor=""><td width="50%">Elderly</td><td>0</td><td>0.0%</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">IDPs</td><td>0</td><td>0.0%</td></tr></table>', '<table width="72%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24" id="datatable">\r\n		<thead>\r\n			<tr bgcolor="#892a24"><th width="50%">&nbsp;</th>\r\n				  <th><font color="#FFFFFF"><strong>0-4 M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>0-4 F</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>5-17 M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>5-17 F</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>18-59 M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>18-59 F</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>60 &> M</strong></font></th>\r\n				  <th><font color="#FFFFFF"><strong>60 &> F</strong></font></th></tr></thead><tbody><tr  bgcolor=""><th width="50%">Food Security and Livelihood</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><th width="50%">WASH</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr  bgcolor=""><th width="50%">NFI/Shelter</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><th width="50%">Advocacy and Protection</th><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody></table>', '<table id="disttable" width="85%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n		<tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Beneficiary Type</strong></font></th><th><font color="#FFFFFF"><strong>Target</strong></font></th><th><font color="#FFFFFF"><strong>Reached</strong></font></th></tr><tr  bgcolor=""><td width="50%">IDPs</td><td>100</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Female-headed Household (FoH)</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Child-headed Household (CoH)</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Expectant /breastfeeding mother</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Elderly</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">People living with disabilities</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Host Community</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Returnees</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Migrants</td><td>200</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">GBV Survivors</td><td>0</td><td>0</td></tr><tr  bgcolor=""><td width="50%">Male</td><td>0</td><td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Female</td><td>0</td><td>0</td></tr><tr bgcolor="#892a24"><th width="50%"><font color="#FFFFFF"><strong>Total</strong></font></th><th><font color="#FFFFFF"><strong>300</strong></font></th><th><font color="#FFFFFF"><strong>0</strong></font></th></tr></table>', '<table id="disttable" width="72%" border="1" cellspacing="0" cellpadding="3" bordercolor="#892a24">\r\n		<thead>\r\n			<tr>\r\n			  <th bgcolor="#892a24" width="50%"><font color="#FFFFFF"><strong>Region</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>0-4 M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>0-4 F</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>5-17 M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>5-17 F</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>18-59 M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>18-59 F</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>60 &> M</strong></font></th>\r\n				  <th bgcolor="#892a24"><font color="#FFFFFF"><strong>60 &> F</strong></font></th></tr>\r\n		</thead>\r\n		<tbody><tr  bgcolor=""><td width="50%">Bari</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sanaag</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Nugal</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Sool</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Benadir</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Mudug</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Galgaduud</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Hiraan</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Gedo</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Shabelle</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Middle Shabelle</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Bay</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Middle Juba</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Lower Juba</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Bakool</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Togdheer</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr  bgcolor=""><td width="50%">Awdal</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr><tr class="alt" bgcolor="#eaf2d3"><td width="50%">Woqooyi Galbeed</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td>\r\n				  <td>0</td></tr></tbody></table>', '<table id="disttable" width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#892a24">\r\n		<thead>\r\n			<tr bgcolor="#892a24">\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Project Code</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Sector</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Sub Activity</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>Sub activity description</strong></font></th>\r\n				<th>\r\n					<font color="#FFFFFF"><strong>status</strong></font></th>\r\n				\r\n				<th colspan="3">\r\n					<font color="#FFFFFF"><strong>Beneficiaries (by gender)</strong></font></th>\r\n				\r\n				<th colspan="2"><font color="#FFFFFF"><strong>Beneficiaries (uncategorised)</strong></font></th>\r\n			</tr>\r\n			</thead>\r\n			<tbody>\r\n			<tr>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				\r\n				<td><strong>Male</strong></td>\r\n				<td><strong>Female</strong></td>\r\n				<td><strong>Total</strong></td>\r\n				<td><strong>Target</strong></td>\r\n				<td><strong>Numbers Reached</strong></td>\r\n			</tr><tr>\r\n				<td colspan="5">TOTAL BENEFICIARIES REPORTED REACHED DURING THE MONTH</td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>0</strong></td>\r\n			</tr></tbody>\r\n	</table>', '<table id="disttable" width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#892a24">\r\n		<thead>\r\n			<tr  bgcolor="#892a24">\r\n				<th><font color="#FFFFFF"><strong>Project Code</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>Project</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>Start Date</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>End Date</strong></font></th>\r\n				<th ><font color="#FFFFFF"><strong>status</strong></font></th>\r\n				<th colspan="3"><font color="#FFFFFF"><strong>Beneficiaries (by gender)</strong></font></th>\r\n				<th colspan="2"><font color="#FFFFFF"><strong>Beneficiaries (uncategorised)</strong></font></th>\r\n			</tr>\r\n			\r\n			</thead><tbody>\r\n			<tr>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				<td>&nbsp;\r\n					</td>\r\n				\r\n				<td><strong>Male</strong></td>\r\n				<td><strong>Female</strong></td>\r\n				<td><strong>Total</strong></td>\r\n				<td><strong>Target</strong></td>\r\n				<td><strong>Numbers Reached</strong></td>\r\n			</tr><tr  bgcolor="">\r\n					<td>\r\n						515-708</td>\r\n					<td>\r\n						Police-Community Dialogue and Community Safety in Puntland</td>\r\n					<td>\r\n						2015-06-16</td>\r\n					<td>\r\n						2016-06-15</td>\r\n					<td>\r\n						On going</td>\r\n					\r\n					<td>0</td>\r\n					<td>0</td>\r\n					<td>0</td>\r\n					<td>300</td>\r\n					<td>0</td>\r\n				</tr><tr>\r\n				<td colspan="5">TOTAL BENEFICIARIES REPORTED REACHED DURING THE MONTH</td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>0</strong></td>\r\n				<td><strong>300</strong></td>\r\n				<td><strong>0</strong></td>\r\n			</tr></tbody>\r\n	</table>', '''Food Security and Livelihood'',''WASH'',''NFI/Shelter'',''Advocacy and Protection'',', '{\r\n                name: ''0-4 M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''0-4 F'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''5-17 M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''5-17 F'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''18-59 M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''18-59 F'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''60 &> M'',\r\n				data: [0,0,0,0,]\r\n					},{\r\n                name: ''60 &> F'',\r\n				data: [0,0,0,0,]\r\n					},', 'Somalia_May_2016.jpg', 'pie_Somalia_May_2016.jpg', 'graph_Somalia_May_2016.jpg', 'sectorgraph_Somalia_May_2016.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcounties`
--

CREATE TABLE IF NOT EXISTS `subcounties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_county` varchar(100) NOT NULL,
  `county_id` int(11) NOT NULL,
  `constituency_id` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `subcounties`
--

INSERT INTO `subcounties` (`id`, `sub_county`, `county_id`, `constituency_id`, `lat`, `long`) VALUES
(1, 'Kaeris', 43, 1, '3.982908', '35.479562'),
(2, 'Lapur', 43, 1, '23.104336', '87.273024'),
(3, 'Kaaleng/Kaikor', 43, 1, '4.533056', '35.409444'),
(4, 'Kibish', 43, 1, '4.818100', '35.599476'),
(5, 'Nakalale', 43, 1, '3.680236', '34.994911'),
(6, 'Lakezone', 43, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sublocations`
--

CREATE TABLE IF NOT EXISTS `sublocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_loaction` varchar(100) NOT NULL,
  `subcounty_id` int(11) NOT NULL,
  `constituency_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `long` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sublocations`
--

INSERT INTO `sublocations` (`id`, `sub_loaction`, `subcounty_id`, `constituency_id`, `county_id`, `lat`, `long`) VALUES
(1, 'Kanakurudio', 1, 1, 43, '', ''),
(2, 'Kaeris', 1, 1, 43, '3.982908', '35.479562'),
(3, 'Nadunga', 1, 1, 43, '', ''),
(4, 'Kangakipur and Milimatatu', 1, 1, 43, '', ''),
(5, 'Natoo', 2, 1, 43, '2.560020', '34.526945'),
(6, 'Lokitaung', 2, 1, 43, '4.270000', '35.750000'),
(7, 'Kachoda', 2, 1, 43, '4.320926', '35.677741'),
(8, 'Karebur', 2, 1, 43, '', ''),
(9, 'Nabulukok', 2, 1, 43, '', ''),
(10, 'Kokuro', 2, 1, 43, '4.672904', '35.710654'),
(11, 'Sasame', 2, 1, 43, '4.581111', '35.754722'),
(12, 'Napeikar', 2, 1, 43, '', ''),
(13, 'Liwan', 2, 1, 43, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subsectors`
--

CREATE TABLE IF NOT EXISTS `subsectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_sector` varchar(100) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subsectors`
--

INSERT INTO `subsectors` (`id`, `sub_sector`, `sector_id`) VALUES
(1, 'Cash Programming', 1),
(2, 'Agriculture', 1),
(3, 'Vocational Skills Training', 1),
(4, 'Food Voucher', 1),
(5, 'Small-Micro-Enterprises', 1),
(6, 'Access to Water', 2),
(7, 'Sanitation', 2),
(8, 'Hygiene Promotion', 2),
(9, 'NFI', 3),
(10, 'Shelter', 3),
(11, 'Protection', 4),
(12, 'Advocacy', 4);

-- --------------------------------------------------------

--
-- Table structure for table `taskcategories`
--

CREATE TABLE IF NOT EXISTS `taskcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `taskcategories`
--

INSERT INTO `taskcategories` (`id`, `category`) VALUES
(1, 'CONSTRUCTION ACTIVITY'),
(2, 'TRAINING ACTIVITIES'),
(3, 'EVENTS ACTIVITIES'),
(4, 'DISTRIBUTIONS (NFI/FOODS)'),
(5, 'CASH DISTRIBUTIONS'),
(6, 'GROUP FORMATION');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskcategory_id` int(11) NOT NULL,
  `task` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `taskcategory_id`, `task`) VALUES
(1, 1, 'Preparatory Activity'),
(2, 1, 'Environment impact assessment'),
(3, 1, 'Obtaining relevant approvals'),
(4, 1, 'Mobilize local community contributions'),
(5, 1, 'Purchase of materials'),
(6, 1, 'Actual construction'),
(7, 1, 'Interim completion certificate/Defect liability'),
(8, 1, 'Issuance of final completion certificate'),
(9, 1, 'Handover to the community/Beneficiary'),
(10, 2, 'Preparatory Activities'),
(11, 2, 'Development/Adaptation of training materials'),
(12, 2, 'Identification of beneficiaries.'),
(13, 2, 'Pre-Training Assessment'),
(14, 2, 'Conduct Actual Training'),
(15, 2, 'Post training assessment'),
(16, 3, 'Preparatory Activities'),
(17, 3, 'Identification of Participants'),
(18, 3, 'Development/Adaptation of materials'),
(19, 3, 'Advertisement/Publicity activity'),
(20, 3, 'Conducting the event'),
(21, 3, 'Post event Assessment'),
(22, 3, 'Event Reporting'),
(23, 4, 'Preparatory Activities'),
(24, 4, 'Identification of beneficiaries'),
(25, 4, 'Purchase/Transportation of materials to the end delivery points'),
(26, 4, 'Pr-distribution sensitization'),
(27, 4, 'Conduct distributions'),
(28, 4, 'Post-distribution monitoring'),
(29, 5, 'Preparatory Activities'),
(30, 5, 'Bio-metric registrations'),
(31, 5, 'Identification of vendors'),
(32, 5, 'Cash distributions'),
(33, 5, 'Post distribution monitoring'),
(34, 6, 'Preparatory Activities'),
(35, 6, 'Mobilization of Groups'),
(36, 6, 'Group Registration'),
(37, 6, 'Group Registration');

-- --------------------------------------------------------

--
-- Table structure for table `trainingreports`
--

CREATE TABLE IF NOT EXISTS `trainingreports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectactivity_id` int(11) NOT NULL,
  `introduction` text NOT NULL,
  `training_induction` text NOT NULL,
  `overal_objective_of_training` text NOT NULL,
  `specific_objectives` text NOT NULL,
  `methodology` text NOT NULL,
  `expectations` text NOT NULL,
  `work_shop_norms` text NOT NULL,
  `pre_assessment_results` text NOT NULL,
  `all_topics_covered` text NOT NULL,
  `key_challenges` text NOT NULL,
  `recommendations_from_participants` text NOT NULL,
  `post_assessment_results` text NOT NULL,
  `training_appendix` text NOT NULL,
  `participant_list` varchar(100) DEFAULT NULL,
  `pre_post_assessment_questionnaire` varchar(100) DEFAULT NULL,
  `training_itinerary` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `typesofsupport`
--

CREATE TABLE IF NOT EXISTS `typesofsupport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `support` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `typesofsupport`
--

INSERT INTO `typesofsupport` (`id`, `support`) VALUES
(1, 'NFI distribution'),
(2, 'Hygiene kits'),
(3, 'Hygiene Promotion'),
(4, 'GBV kits'),
(5, 'trainings'),
(6, 'seeds'),
(7, 'farmers tools'),
(8, 'sanitation kits'),
(9, 'start up kits'),
(10, 'solar torches'),
(11, 'SME start up kits'),
(12, 'VST start up kits'),
(13, 'Aqua tabs'),
(14, 'Jericans'),
(15, 'Food items'),
(16, 'schools supplies'),
(17, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `expiry_date` date NOT NULL,
  `country_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_role` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `designation`, `organization_id`, `email`, `contact_number`, `username`, `salt`, `password`, `role_id`, `active`, `date_created`, `expiry_date`, `country_id`, `county_id`, `district_id`) VALUES
(1, 'Joash', 'Gomba', 'eLogframe Consultant', 1, 'joashgomba@gmail.com', '+354721937404', 'joashgomba@gmail.com', 'qoV4eykGIEjwUSnZH79nm', '$2a$05$qoV4eykGIEjwUSnZH79nm.5wi.3LgpdQYth11U6fBpX1s3DbkYtie', 1, 1, '2016-01-01', '2022-01-01', 2, 1, 1),
(2, 'Johannes', 'Fromholt', 'M&E Advisor', 2, 'J.Fromholt@ddghoa.org', '+254 (0) 727 583 132', 'J.Fromholt@ddghoa.org', 'q2QATmaB3h2D0M4octWNu', '$2a$05$q2QATmaB3h2D0M4octWNu.WOFH/7JXg7Ldkdi1JuxSd4.NcdpaCl6', 1, 1, '2016-01-01', '2022-01-01', 2, 1, 1),
(3, 'John', 'Udalang''', 'Regional M&E Head', 1, 'j.udalang@drchoa.org', '254722780026', 'j.udalang@drchoa.org', 'Yg3TskdqoKmdpxp3Kgx9e', '$2a$05$Yg3TskdqoKmdpxp3Kgx9e.PFhJJjP9sBDSDt.MyP.ItNwobuYhN6i', 1, 1, '2016-01-01', '2022-01-01', 2, 1, 1),
(4, 'Ann', 'Maina-Kimotho', 'Regional IT Manager', 1, 'a.kimotho@drchoa.org', '+254 (0) 716 777 562', 'a.kimotho@drchoa.org', 'zr6VQA6fdI77k302Re2nq', '$2a$05$zr6VQA6fdI77k302Re2nq.zcoPf4oIcpopyo5ipw89W.zIk87BLa6', 1, 1, '0000-00-00', '0000-00-00', 2, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
