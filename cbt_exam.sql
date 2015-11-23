-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2014 at 09:40 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cbt_exam`
--
CREATE DATABASE IF NOT EXISTS `cbt_exam` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cbt_exam`;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE IF NOT EXISTS `adminlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `createexams`
--

CREATE TABLE IF NOT EXISTS `createexams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `examId` int(11) NOT NULL,
  `examName` text NOT NULL,
  `exam_year` text NOT NULL,
  `subject` text NOT NULL,
  `duration` int(11) NOT NULL,
  `instructions` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `examId` (`examId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `createexams`
--

INSERT INTO `createexams` (`id`, `examId`, `examName`, `exam_year`, `subject`, `duration`, `instructions`) VALUES
(25, 765155968, 'Jamb', '1999', 'Use of English', 2, 'please do answer the right question and provide the appropriate answer to the question given you '),
(26, 67225173, 'Jamb', '1999', 'Economics', 1, 'please do answer the right question and provide the appropriate answer to the question given you '),
(27, 111436163, 'Jamb', '1999', 'Chemistry', 6, 'Answer all questions Answer all question COMPREHENSION Read passages, I, II & III carefully and answer the questions that follow. Each question carries 3 marks.'),
(29, 107566197, 'Jamb', '1999', 'CRS', 10, 'answer all question Answer all question COMPREHENSION Read passages, I, II & III carefully and answer the questions that follow. Each question carries 3 marks.'),
(30, 1209456342, 'Jamb', '1999', 'Biology', 5, 'answer all questions Answer all question COMPREHENSION Read passages, I, II & III carefully and answer the questions that follow. Each question carries 3 marks.'),
(31, 1987704829, 'Jamb', '1999', 'Government', 4, 'answer all questions Answer all question COMPREHENSION Read passages, I, II & III carefully and answer the questions that follow. Each question carries 3 marks.'),
(32, 432001491, 'Interview', '2014', 'Morals', 3, 'please do answer the right question and provide the appropriate answer to the question given you ');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL,
  `exam_name` text NOT NULL,
  `instruction` date NOT NULL,
  `duration` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `subject` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_A` text NOT NULL,
  `option_B` text NOT NULL,
  `option_C` text NOT NULL,
  `option_D` text NOT NULL,
  `answer` text NOT NULL,
  `exam_id` text NOT NULL,
  `images` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `Qid`, `question`, `option_A`, `option_B`, `option_C`, `option_D`, `answer`, `exam_id`, `images`) VALUES
(21, 1, '\n1. From the writer''s description of the world energy situation,\nwe may conclude that', 'developing nations will soon experience poverty', 'demand for recoverable fuel will plummet', 'consumption has not affected production', 'decline has not affected demand.', 'decline has not affected demand.', '25', ''),
(22, 2, 'Thewriter seems to suggest that developed nations should', 'always calculate a fossil fuelâ€™s remaining life', 'reduce industrial and agricultural production', 'reduce dependence on fossil fuels', 'review industrial dependence on energy.', 'review industrial dependence on energy.', '25', ''),
(23, 3, 'Thewriter warns that the world could', 'lose all its oil reserves in a mater of years', 'face energy crisis soon if production is not stepped up', 'experience scarcity and low energy price soon', 'face low energy supply and poor agricultural output.', 'experience scarcity and low energy price soon', '25', ''),
(24, 4, 'The expression, standard of living in developed\r\ncountries will plummet, means\r\n', 'the economy of rich nations will stagnate', 'economic life will improve in rich nations', 'purchasing power will decline sharply in rich nations', 'people in developed nations will experience boom.', 'people in developed nations will experience boom.', '25', ''),
(25, 5, 'Fossil fuels are used in the passage include\r\n', 'wood, kerosene and natural gas', 'oil, coal and natural gas', 'lignite, butane and charcoal', 'wood, coal and oil.', 'oil, coal and natural gas', '25', ''),
(26, 6, 'Amina said she married a doting husband.\r\n', 'a loving  ', 'a fun-loving', 'an uncaring', 'a nagging', 'a loving  ', '25', ''),
(27, 7, 'Adamuwoke upwith a start and took to his heels, claiming\r\nthat something was on his trail.', 'in his food', 'giving him the chase', 'hiding near the bed', 'staring at him', 'in his food', '25', ''),
(28, 8, 'The man preaches egalitarianism without matching it\r\nup with action.', 'salvation  ', 'dedication', 'kindness', 'equality', 'equality', '25', ''),
(29, 9, 'The prosecutor was accused of obstructing justice.', 'hindering', 'retarding ', 'impending', 'interrupting', 'retarding ', '25', ''),
(30, 10, 'Abdul is fond of his teacher though he sometimes\r\nmakes\r\nderogatory remarks about him.', 'unpleasant ', 'complimentary', 'expressive', 'inconsiderate', 'expressive', '25', ''),
(31, 1, 'In a firm three employees earn N5,500 each, four earn\r\nN3,300 each, two earn N5,000 each and one earns\r\nN7,000. The mean income of the employees is', 'N5,200 ', 'N4,760', 'N4,670 ', 'N2,080', 'N4,760', '26', ''),
(32, 2, 'Abubakar has the choice of buying either a house or\r\na Mercedes Benz car for N1.5m plus NO.5mrunning\r\ncost. If he decides to buy theMercedes Benz car, his\r\nopportunitycost is', 'N1.5m ', 'N2.0m ', 'the house ', 'the car', 'N1.5m ', '26', ''),
(33, 3, 'The shape of a production possibility frontier is\r\ndetermined by the', ' increasing relative costs', 'returns to scale', 'diminishing returns to a fixed factor', 'increasing returns to a variable factor.', 'increasing returns to a variable factor.', '26', ''),
(34, 4, 'Normative economics deals with\r\n\r\n', 'what is and not what should be', 'facts and not figures', 'facts and figures', 'value judgements', 'facts and figures', '26', ''),
(35, 5, 'The dependency ratio between 1960 and 1990 is', 'Increased by 5%', 'Increased by 2%', 'Decreased by 2% ', 'Decreased by 5%', 'Decreased by 5%', '26', ''),
(36, 6, 'In 1990, the difference between the dependent\r\npopulation and the active population ration is', '22%', '20% ', '16%', '4%', '22%', '26', ''),
(37, 7, 'The short-run period in produce is defined as a period when\r\n', 'there is at least one fixed factor', 'all costs of production must be covered', 'the output cannot be varied', 'current output is not profitable', 'there is at least one fixed factor', '26', ''),
(38, 8, 'Specialization often improves economic performance\r\nbecause it', 'Permits exploitation of economies of scale', 'Incorporates external economies', 'Is based on the law of variable proportions', 'Allocate resources according to absolute advantage', 'Is based on the law of variable proportions', '26', ''),
(39, 9, 'One of economic problems of Nigeria today arises from', 'The overutilization of human an natural resources', 'Inavailabilityof mineral resources', 'Inadequate manpower resources', 'The underutilization of human and natural resources', 'The overutilization of human an natural resources', '26', ''),
(40, 10, 'Which of the following can have their shares quoted\r\non the stock exchange?', 'Public corporations', 'A partnership', 'A consumer co-operative', 'Apublic limited liability company', 'Apublic limited liability company', '26', ''),
(41, 1, '200 cm3 each of 0.1Msolution of lead (11) trioxonirate\r\n(V) and hydro chlorioc acidwere mixed. Assuming that\r\nlead (11) chloride is completely insoluble, calculate the\r\nmass of lead (11) chloride that will be precipate.\r\n\r\n\r\n[Pb = 207, CI = 35.5, N= 14,O= 16]', '2.78 g ', '5.56 g', '8.34 g ', '11.12 g', '2.78 g ', '27', ''),
(42, 2, '56.00cm3 of a gas at s.t.p weighed 0.11 g,What is the\r\nvapour density of the gas?\r\n\r\n\r\n[Molar volume of a gas at s.t.p = 22.4 dm3]', '11.00 ', '22.00', '33.00', ' 44.00', '22.00', '27', ''),
(43, 3, 'Which of the following gases will diffuse fastest\r\nwhen passed through a porous plug?\r\n\r\n\r\n[H= 1, C= 12, N= 14, O= 16]', 'Propane ', 'Oxygen', ' Methane ', 'Ammonia', ' Methane ', '27', ''),
(44, 4, 'Which of the following will have its mass increased\r\nwhen heated in air?', 'Helium ', 'Magnesium', 'Copper pyrites', 'Glass', 'Magnesium', '27', ''),
(45, 5, 'What is the temperature of a given mass of a gas\r\ninitially OoC and 9 atm, if the pressure is reduced to 3\r\natmosphere at constant volume?\r\n\r\n', '91 K ', '182 K', '273 K ', '819 K', '91 K ', '27', ''),
(46, 1, 'what is the name of the president of nigeria', 'Nigeria', 'edo', 'benin', 'lagos', 'lagos', '32', ''),
(47, 1, 'how old am i', '2', '4', '3', '5', '3', '32', '');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) NOT NULL,
  `student_id` text NOT NULL,
  `exam_id` text NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentreg`
--

CREATE TABLE IF NOT EXISTS `studentreg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `institution` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `studentId` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phonecol` (`phone`(15))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `studentreg`
--

INSERT INTO `studentreg` (`id`, `name`, `institution`, `email`, `phone`, `address`, `studentId`) VALUES
(3, 'Ewere', 'Uniben', 'Diagboya', '08066194746', 'Ogiso', 'E6B6FD'),
(4, 'Tolu Awojana', 'Uniben', 'tolu.awojana.gco.com.ng', '08099294372', 'Ugbowo, Benin', 'EE9CF4'),
(5, 'shola aliu', 'uniben', 'victorious919@gmail.com', '09022338892', 'blocks of flats uniben', '9C542E'),
(6, 'peter olushola', 'uniben', 'shola23@gmail.com', '08022334423', 'blocks of flats uniben', '29EB7D');

-- --------------------------------------------------------

--
-- Table structure for table `temp_exam`
--

CREATE TABLE IF NOT EXISTS `temp_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` text NOT NULL,
  `Qid` text NOT NULL,
  `Aid` text NOT NULL,
  `exam_id` text NOT NULL,
  `examTracker` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `temp_exam`
--

INSERT INTO `temp_exam` (`id`, `student_id`, `Qid`, `Aid`, `exam_id`, `examTracker`) VALUES
(1, '', '1', 'demand for recoverable fuel will plummet', '25', '438A42B33C015ECCA3DF143784B18143'),
(2, '', '2', 'reduce industrial and agricultural production', '25', '438A42B33C015ECCA3DF143784B18143'),
(3, '', '3', 'face energy crisis soon if production is not stepped up', '25', '438A42B33C015ECCA3DF143784B18143'),
(4, '', '4', 'economic life will improve in rich nations', '25', '438A42B33C015ECCA3DF143784B18143'),
(5, '', '5', 'oil, coal and natural gas', '25', '438A42B33C015ECCA3DF143784B18143'),
(6, '', '6', 'an uncaring', '25', '438A42B33C015ECCA3DF143784B18143'),
(7, '', '7', 'in his food', '25', '438A42B33C015ECCA3DF143784B18143'),
(8, '', '8', 'kindness', '25', '438A42B33C015ECCA3DF143784B18143'),
(9, '', '9', 'retarding ', '25', '438A42B33C015ECCA3DF143784B18143'),
(10, '', '10', 'unpleasant ', '25', '438A42B33C015ECCA3DF143784B18143'),
(11, '', '1', 'demand for recoverable fuel will plummet', '25', 'AA607D492D357B510A302D57827B9D8A'),
(12, '', '2', 'reduce industrial and agricultural production', '25', 'AA607D492D357B510A302D57827B9D8A'),
(13, '', '2', 'reduce industrial and agricultural production', '25', 'AA607D492D357B510A302D57827B9D8A'),
(14, '', '2', 'reduce industrial and agricultural production', '25', 'AA607D492D357B510A302D57827B9D8A'),
(15, '', '2', 'reduce industrial and agricultural production', '25', 'AA607D492D357B510A302D57827B9D8A'),
(16, '', '2', 'reduce industrial and agricultural production', '25', 'AA607D492D357B510A302D57827B9D8A'),
(17, '', '2', 'reduce industrial and agricultural production', '25', 'AA607D492D357B510A302D57827B9D8A'),
(18, '', '1', 'N5,200 ', '26', '5D5522DC20F72395D92269847B44FE74'),
(19, '', '1', 'N5,200 ', '26', '5D5522DC20F72395D92269847B44FE74'),
(20, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>191</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(21, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>191</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(22, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>170</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(23, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>170</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(24, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>170</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(25, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>170</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(26, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>170</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(27, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(28, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(29, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(30, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(31, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(32, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(33, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(34, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(35, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(36, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(37, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(38, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '5D5522DC20F72395D92269847B44FE74'),
(39, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamiframeQuestion.php</b> on line <b>148</b><br />\r\n', '85C033E219CC09A02429F6368ABF3236'),
(40, '', '1', '', '27', '506F4B333B16200AA2D865A0C6FD8870'),
(41, '', '1', '5.56 g', '27', '506F4B333B16200AA2D865A0C6FD8870'),
(42, '', '2', '22.00', '27', '506F4B333B16200AA2D865A0C6FD8870'),
(43, '', '3', '', '27', '506F4B333B16200AA2D865A0C6FD8870'),
(44, '', '4', 'Magnesium', '27', '506F4B333B16200AA2D865A0C6FD8870'),
(45, '', '5', '182 K', '27', '506F4B333B16200AA2D865A0C6FD8870'),
(46, '', '', '', '29', '0DC634D08EFC1BCBF509ECE676D1E2D6'),
(47, '', '', '', '29', '0DC634D08EFC1BCBF509ECE676D1E2D6'),
(48, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamExam.php</b> on line <b>164</b><br />\r\n', '1D382BC4E9C9BEB8CB9927D5A98C4A8D'),
(49, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamExam.php</b> on line <b>164</b><br />\r\n', '1D382BC4E9C9BEB8CB9927D5A98C4A8D'),
(50, '', '1', '', '26', 'B372445120D84C071AC7DE391F07C3F3'),
(51, '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: exam in <b>C:xampphtdocsCBT_ExamExam.php</b> on line <b>164</b><br />\r\n', 'BDE2FBC3C7F9743DBDFE7678648472B4'),
(52, '', '1', 'N4,670 ', '26', '5F071220A18A72FB320D844C578EABE2'),
(53, '', '1', '', '26', '5F071220A18A72FB320D844C578EABE2'),
(54, '', '2', 'N2.0m ', '26', '5F071220A18A72FB320D844C578EABE2'),
(55, '', '3', 'increasing returns to a variable factor.', '26', '5F071220A18A72FB320D844C578EABE2'),
(56, '', '4', 'facts and figures', '26', '5F071220A18A72FB320D844C578EABE2'),
(57, '', '5', 'Decreased by 2% ', '26', '5F071220A18A72FB320D844C578EABE2'),
(58, '', '6', '16%', '26', '5F071220A18A72FB320D844C578EABE2'),
(59, '', '7', 'the output cannot be varied', '26', '5F071220A18A72FB320D844C578EABE2'),
(60, '', '8', 'Is based on the law of variable proportions', '26', '5F071220A18A72FB320D844C578EABE2'),
(61, '', '9', 'The underutilization of human and natural resources', '26', '5F071220A18A72FB320D844C578EABE2'),
(62, '', '10', 'Apublic limited liability company', '26', '5F071220A18A72FB320D844C578EABE2'),
(63, '', '1', 'demand for recoverable fuel will plummet', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(64, '', '2', 'reduce industrial and agricultural production', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(65, '', '3', 'face low energy supply and poor agricultural output.', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(66, '', '4', 'economic life will improve in rich nations', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(67, '', '5', 'wood, kerosene and natural gas', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(68, '', '6', 'a fun-loving', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(69, '', '7', 'hiding near the bed', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(70, '', '8', 'kindness', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(71, '', '9', 'impending', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(72, '', '10', 'unpleasant ', '25', 'E551CE415F74BAFAB00F6B98C4B63BE7'),
(73, 'shola23@gmail.com', '1', 'demand for recoverable fuel will plummet', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(74, 'shola23@gmail.com', '2', 'reduce dependence on fossil fuels', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(75, 'shola23@gmail.com', '3', 'lose all its oil reserves in a mater of years', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(76, 'shola23@gmail.com', '4', 'purchasing power will decline sharply in rich nations', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(77, 'shola23@gmail.com', '5', 'oil, coal and natural gas', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(78, 'shola23@gmail.com', '6', 'an uncaring', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(79, 'shola23@gmail.com', '7', 'hiding near the bed', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(80, 'shola23@gmail.com', '8', 'dedication', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(81, 'shola23@gmail.com', '9', 'impending', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(82, 'shola23@gmail.com', '10', 'complimentary', '25', '3D9200630CCDA38BACDECAE07BFF137C'),
(83, 'shola23@gmail.com', '1', 'demand for recoverable fuel will plummet', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(84, 'shola23@gmail.com', '2', 'reduce dependence on fossil fuels', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(85, 'shola23@gmail.com', '3', 'experience scarcity and low energy price soon', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(86, 'shola23@gmail.com', '4', 'purchasing power will decline sharply in rich nations', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(87, 'shola23@gmail.com', '5', 'lignite, butane and charcoal', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(88, 'shola23@gmail.com', '6', 'a fun-loving', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(89, 'shola23@gmail.com', '7', 'giving him the chase', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(90, 'shola23@gmail.com', '8', 'dedication', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(91, 'shola23@gmail.com', '9', 'retarding ', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(92, 'shola23@gmail.com', '10', 'inconsiderate', '25', 'DB1EDB5A6C71B9FC63F67A66C9EB8A75'),
(93, 'shola23@gmail.com', '10', 'inconsiderate', '25', '63D69555F837C73321E0BF69243D6948'),
(94, 'shola23@gmail.com', '1', 'N4,670 ', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(95, 'shola23@gmail.com', '2', 'the car', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(96, 'shola23@gmail.com', '3', 'increasing returns to a variable factor.', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(97, 'shola23@gmail.com', '4', 'value judgements', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(98, 'shola23@gmail.com', '5', 'Decreased by 2% ', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(99, 'shola23@gmail.com', '6', '20% ', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(100, 'shola23@gmail.com', '7', 'the output cannot be varied', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(101, 'shola23@gmail.com', '8', 'Incorporates external economies', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(102, 'shola23@gmail.com', '9', 'The underutilization of human and natural resources', '26', '77654CA1357A5BC89620C66308D3E6EC'),
(103, 'shola23@gmail.com', '10', 'A partnership', '26', '77654CA1357A5BC89620C66308D3E6EC');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
