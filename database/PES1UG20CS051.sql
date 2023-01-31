-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 06:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `normalizeregion` ()   begin
 DECLARE finished int default 0;
 declare city1 varchar(50) default "";
 DECLARE city_list varchar(200) default ""; 
 DECLARE regcursor CURSOR FOR SELECT city from branch; 
 DECLARE CONTINUE HANDLER For NOT FOUND SET finished = 1; 
 open regcursor; 
 start_loop:LOOP 
 FETCH regcursor into city1; 
 if finished = 1 THEN 
 LEAVE start_loop; 
 END IF;
 SET city_list = CONCAT(city_list,", ",UPPER(city1)); 
 END LOOP start_loop; 
 CLOSE regcursor; 
 SELECT city_list;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Src` ()  NO SQL SELECT *FROM patient$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valid_experience` (IN `DOB` DATE, IN `exp` INT, OUT `msg` VARCHAR(30))  DETERMINISTIC BEGIN
DECLARE age int;
declare startage int;
set age= age_doctor(DOB);
set startage=age-exp;
IF startage<20 THEN
set msg= 'Invalid exp entered';
ELSE
if exp>5 THEN
set msg='The doctor is experienced';
ELSE
set msg='the doctor is inexperienced';
end if;

END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `age_doctor` (`DOB` DATE) RETURNS INT(11)  BEGIN 
DECLARE age int; 
set age=datediff(CURRENT_DATE,DOB);
set age=floor(age/365);

RETURN age; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admintable`
--

CREATE TABLE `admintable` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `username` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `CID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `DOV` date NOT NULL,
  `Timestamp` datetime NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`username`, `Fname`, `gender`, `CID`, `DID`, `DOV`, `Timestamp`, `Status`) VALUES
('PES1UG20CS051', 'Aneesh ', 'male', 10, 102, '2022-11-30', '2022-11-27 07:28:01', 'Cancelled by Patient'),
('PES1UG20CS051', 'Aneesh ', 'male', 10, 102, '2022-11-30', '2022-11-27 12:41:23', 'Booking Registered.Wait for the update'),
('PES1UG20ME004', 'Aneesh123 ', 'male', 106, 156, '2022-11-29', '2022-11-27 17:17:15', 'Booking Registered.Wait for the update'),
('PES1UG20ME004', 'Aneesh ', 'male', 5, 158, '2022-11-30', '2022-11-27 17:18:42', 'Booking Registered.Wait for the update');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `cancel_book` AFTER UPDATE ON `booking` FOR EACH ROW if (new.status like 'Cancelled by Patient') 
then 
INSERT into cancelled_by_patient(username,Fname,gender,CenterID,DID,DOV,DateOfBooking) VALUES (old.username,old.Fname,old.gender,old.cid,old.did,old.dov,old.timestamp);
ELSE
INSERT into cancelled_by_admin(username,Fname,gender,CenterID,DID,DOV,DateOfBooking) VALUES (old.username,old.Fname,old.gender,old.cid,old.did,old.dov,old.timestamp);
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `CID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`CID`, `name`, `address`, `city`, `contact`) VALUES
(1, 'Appolo Main', 'blah1', 'Bangalore', '8971754321'),
(5, 'Appolo mlm branch', 'blah2', 'Mysore', '1234567890'),
(10, 'apollo sesh branch', 'blah3', 'Bangalore', '8899776655'),
(103, 'Appolo Main', 'blah1', 'bangalore', '8971754354'),
(104, 'Appolo Main1', 'blah21', 'mumbai', '8971754326'),
(105, 'Appolo Main2', 'blah31', 'mumbai', '8971754327'),
(106, 'Appolo Main3', 'blah41', 'delhi', '8971754328'),
(107, 'Appolo Main4', 'bla5h1', 'delhi', '8971754329'),
(109, 'Apollo Kammanhalli', 'Kammanhalli', 'bangalore', '9663170500');

--
-- Triggers `branch`
--
DELIMITER $$
CREATE TRIGGER `deletedbranch` AFTER DELETE ON `branch` FOR EACH ROW delete from doctor_available where doctor_available.CID=old.cid
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_by_admin`
--

CREATE TABLE `cancelled_by_admin` (
  `username` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `CenterID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `DOV` date NOT NULL,
  `DateOfBooking` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_by_patient`
--

CREATE TABLE `cancelled_by_patient` (
  `username` varchar(30) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `CenterID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `DOV` date NOT NULL,
  `DateOfBooking` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancelled_by_patient`
--

INSERT INTO `cancelled_by_patient` (`username`, `Fname`, `gender`, `CenterID`, `DID`, `DOV`, `DateOfBooking`) VALUES
('PES1UG20CS051', 'Aneesh ', 'male', 10, 102, '2022-11-30', '2022-11-27 07:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_doctors`
--

CREATE TABLE `deleted_doctors` (
  `DID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `specialisation` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `specialisation` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(40) NOT NULL,
  `region` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DID`, `name`, `gender`, `dob`, `experience`, `specialisation`, `contact`, `address`, `region`, `username`, `password`) VALUES
(102, 'Aneesh Ravishankar', 'male', '2002-04-12', 10, 'NeuroSurgeon', '9663170599', 'blah blah', 'bangalore', 'PES1UG20CS051', 'hi123'),
(103, 'Aneesh R', 'male', '2002-04-12', 10, 'NeuroSurgeon', '9663170598', 'seshadripuram', 'bangalore', 'PES1UG20CS050', 'hi123'),
(104, 'PES', 'male', '2002-04-12', 8, 'Nutritionist', '9663170597', 'jayanagar', 'mysore', 'PES1UG20CS049', 'hi123'),
(105, 'SRN055', 'male', '2002-04-12', 10, 'Heart Specialist', '9663170598', 'NLO', 'mysore', 'PES1UG20CS048', 'hi123'),
(106, 'randomval', 'male', '2002-04-12', 10, 'Dentist', '9663170598', 'malleshwaram', 'bangalore', 'PES1UG20CS058', 'hi123'),
(108, 'SRN051', 'male', '2008-04-12', 8, 'General', '9663170523', 'malleshwaram', 'bangalore', 'PES1UG20ME044', 'hi123'),
(152, 'Aneesh1 Ravishankar', 'male', '1990-04-12', 10, 'NeuroSurgeon', '9663110599', 'blah blah', 'bangalore', 'PES1UG20CS151', 'hi123'),
(153, 'Aneesh2 Ravishankar', 'male', '1990-04-12', 11, 'NeuroSurgeon', '9663120599', 'blah blah', 'mumbai', 'PES1UG20CS251', 'hi123'),
(154, 'Aneesh3 Ravishankar', 'male', '1990-04-12', 12, 'NeuroSurgeon', '9663130599', 'blah blah', 'mumbai', 'PES1UG20CS351', 'hi123'),
(155, 'Aneesh4 Ravishankar', 'male', '1990-04-12', 13, 'NeuroSurgeon', '9663140599', 'blah blah', 'mumbai', 'PES1UG20CS451', 'hi123'),
(156, 'Aneesh5 Ravishankar', 'male', '1990-04-12', 14, 'NeuroSurgeon', '9663150599', 'blah blah', 'delhi', 'PES1UG20CS551', 'hi123'),
(157, 'Aneesh6 Ravishankar', 'male', '1990-04-12', 15, 'NeuroSurgeon', '9663160599', 'blah blah', 'delhi', 'PES1UG20CS651', 'hi123'),
(158, 'Aneesh7 Ravishankar', 'male', '1990-04-12', 16, 'NeuroSurgeon', '9663180599', 'blah blah', 'mysore', 'PES1UG20CS751', 'hi123'),
(159, 'Aneesh8 Ravishankar', 'male', '1990-04-12', 10, 'NeuroSurgeon', '9663190599', 'blah blah', 'mysore', 'PES1UG20CS851', 'hi123');

--
-- Triggers `doctor`
--
DELIMITER $$
CREATE TRIGGER `admin_cancel` AFTER DELETE ON `doctor` FOR EACH ROW UPDATE booking set `Status`="Cancelled by admin" where booking.DID=old.DID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteavail` AFTER DELETE ON `doctor` FOR EACH ROW delete from doctor_available where doctor_available.DID=old.did
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deletedDoc` AFTER DELETE ON `doctor` FOR EACH ROW INSERT INTO deleted_doctors(DID,name,gender,dob,experience,specialisation,contact	,address,username,password,region) VALUES (old.DID,old.name,old.gender,old.dob,old.experience,old.specialisation,	old.contact,old.address,old.username,old.password,old.region)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_available`
--

CREATE TABLE `doctor_available` (
  `CID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_available`
--

INSERT INTO `doctor_available` (`CID`, `DID`, `day`, `starttime`, `endtime`) VALUES
(10, 102, 'Monday', '06:08:00', '07:09:00'),
(10, 102, 'Tuesday', '06:08:00', '07:09:00'),
(10, 102, 'Wednesday', '06:08:00', '07:09:00'),
(10, 102, 'Thursday', '06:08:00', '07:09:00'),
(10, 102, 'Friday', '06:08:00', '07:09:00'),
(10, 102, 'Saturday', '06:08:00', '07:09:00'),
(109, 108, 'Monday', '06:06:00', '17:30:00'),
(109, 108, 'Tuesday', '06:06:00', '17:30:00'),
(109, 108, 'Wednesday', '06:06:00', '17:30:00'),
(109, 108, 'Tuesday', '02:10:00', '20:48:00'),
(109, 108, 'Wednesday', '02:10:00', '20:48:00'),
(5, 158, 'Monday', '23:29:00', '23:29:00'),
(5, 158, 'Tuesday', '23:29:00', '23:29:00'),
(5, 158, 'Wednesday', '23:29:00', '23:29:00'),
(104, 154, 'Monday', '22:30:00', '23:30:00'),
(104, 154, 'Tuesday', '22:30:00', '23:30:00'),
(104, 154, 'Wednesday', '22:30:00', '23:30:00'),
(106, 156, 'Monday', '23:30:00', '23:54:00'),
(106, 156, 'Tuesday', '23:30:00', '23:54:00'),
(106, 156, 'Wednesday', '23:30:00', '23:54:00'),
(106, 156, 'Thursday', '23:30:00', '23:54:00'),
(106, 156, 'Friday', '23:30:00', '23:54:00'),
(106, 156, 'Saturday', '23:30:00', '23:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `gender`, `dob`, `phone`, `username`, `password`, `email`) VALUES
(9, 'Aneesh ', 'male', '2022-02-12', '9663170599', 'PES1UG20CS051', 'hi123', 'blah2@gmail.com'),
(10, 'lo', 'male', '2022-11-05', '9663170590', 'PES1UG20ME004', 'hi123', 'blah3@gmail.com'),
(13, 'Aneesh Ravishankar', 'male', '2022-10-14', '9663170597', 'PES1UG20CS052', 'hi123', 'blah6@gmail.com'),
(14, 'Aneesh Ravishankar', 'male', '2022-11-06', '9663170543', 'PES1UG20EE071', 'hi123', 'blah10@gmail.com'),
(15, 'Aneesh Ravishankar', 'male', '2018-02-08', '9663170524', 'PES1UG20ME044', 'hi123', 'blah43@gmail.com'),
(16, 'Aneesh ', 'male', '2022-02-12', '9663170539', 'PES1UG20CC051', 'hi123', 'blah26@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintable`
--
ALTER TABLE `admintable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`CID`,`contact`);

--
-- Indexes for table `deleted_doctors`
--
ALTER TABLE `deleted_doctors`
  ADD PRIMARY KEY (`DID`,`username`,`contact`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DID`,`username`,`contact`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`,`username`,`email`,`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintable`
--
ALTER TABLE `admintable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
