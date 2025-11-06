-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 06:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `alt_phone` varchar(15) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `university` varchar(150) DEFAULT NULL,
  `passing_year` int(11) DEFAULT NULL,
  `percentage` varchar(20) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `timing` varchar(50) DEFAULT NULL,
  `skills` varchar(200) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `hobbies` varchar(200) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `first_name`, `last_name`, `dob`, `gender`, `email`, `phone`, `alt_phone`, `nationality`, `address1`, `address2`, `city`, `state`, `country`, `pincode`, `qualification`, `university`, `passing_year`, `percentage`, `course`, `mode`, `timing`, `skills`, `experience`, `hobbies`, `comments`, `resume`) VALUES
(1, 'pp', 'kk', '2025-11-05', 'Female', 'poorvic948@gmail.com', '0000000000', '8888', 'Indian', 'mm', 'hh', 'jj', 'Karnataka', 'India', '989899', '2nd PUC', 'Junior PU College , Sagar', 2022, '94.5', 'Web Development', 'Online', 'Morning', 'HTML, CSS', 0, 'Drawing, Painting', 'hiii', '_Resume.pdf'),
(2, 'Preethi', 'Chekki', '2005-04-29', 'Female', 'preethichekki@gmail.com', '7975832431', '9999999999', 'Indian', 'Matru Krupa, Ishwar nagar ', 'Muktimandir road, Kempigeri', 'Laxmeshwar', 'Karnataka', 'India', '582116', '2nd PUC', 'Junior PU College , Sagar', 2022, '94.5', 'AI & ML', 'Online', 'Morning', 'HTML, CSS', 0, 'Drawing, Painting', 'hii', 'RESUME.pdf'),
(6, 'dfdfdf', 'dfdfd', '2333-03-31', 'Female', 'shweta@gmail.com', '7676876867', '5446565768', 'Indian', 'ssdfsfd', 'ssdfdf', 'dfdf', 'Karnataka', 'India', '343435', 'fgfgfdg', 'dfdgdg', 2024, '45', 'Web Development', 'Online', 'rwerer', 'retr', 0, 'gbgfdg', 'dffdr', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
