-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 04:12 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs460 project 1 movie database`
--

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `mpid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `award_name` varchar(50) DEFAULT NULL,
  `award_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `mpid` int(11) DEFAULT NULL,
  `genre_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`mpid`, `genre_name`) VALUES
(1, 'Epic romance'),
(2, 'Science Fiction'),
(3, 'Action Superhero');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `uemail` varchar(255) DEFAULT NULL,
  `mpid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`uemail`, `mpid`) VALUES
('btom123@gmail.com', 3),
('btom123@gmail.com', 2),
('willwei@bu.edu', 1),
('willwei@bu.edu', 2),
('johnappleseed@yahoo.com\r\n', 3),
('johnappleseed@yahoo.com\r\n', 2),
('johnappleseed@yahoo.com\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `mpid` int(11) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`mpid`, `zip`, `city`, `country`) VALUES
(1, '22710', 'Rosarito', 'Mexico'),
(3, 'EH1 1PB', 'Edinburgh', 'Scotland'),
(7, '', 'Wexford', 'Ireland');

-- --------------------------------------------------------

--
-- Table structure for table `motionpicture`
--

CREATE TABLE `motionpicture` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `rating` float DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 10),
  `production` varchar(50) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motionpicture`
--

INSERT INTO `motionpicture` (`id`, `name`, `rating`, `production`, `budget`) VALUES
(1, 'Titanic', 7.8, 'Paramount Pictures', 200000000),
(2, 'Star Wars: Episode IV - A New Hope', 9, 'Lucasfilm', 11000000),
(3, 'Avengers: Infinity War', 8.5, 'Marvel Studios', 325000000),
(4, 'Teen Titans ', 10, 'Warner Bros.', NULL),
(5, 'The Suite Life of Zack & Cody', 6.6, 'It\'s a Laugh Productions', NULL),
(6, 'Avatar: The Last Airbender', 10, 'Nickelodeon ', NULL),
(7, 'Saving Private Ryan', 9, 'DreamWorks Pictures', 70000000),
(8, 'Avatar', 8, '20th Century Fox', 237000000);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mpid` int(11) NOT NULL,
  `boxoffice_collection` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mpid`, `boxoffice_collection`) VALUES
(1, '$2,400,000,000'),
(2, '$775,000,000'),
(3, '$2,048,000,000'),
(7, '$2,202,000,000'),
(8, '$482,300,000');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL CHECK (`gender` in ('M','F','N','O'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `nationality`, `dob`, `gender`) VALUES
(1, 'Chris Evans', 'American', '1981-06-13', 'M'),
(2, 'Jennifer Lawrence', 'American', '1990-08-15', 'F'),
(3, 'Gal Gadot', 'Israeli', '1985-04-05', 'F'),
(4, 'Leonardo DiCaprio', 'American', '1974-11-11', 'M'),
(5, 'Mark Hamill', 'American', '1951-09-25', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `mpid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`mpid`, `pid`, `role_name`) VALUES
(3, 1, 'Actor'),
(1, 4, 'Actor'),
(2, 5, 'Actor');

-- --------------------------------------------------------

--
-- Table structure for table `ruser`
--

CREATE TABLE `ruser` (
  `email` varchar(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruser`
--

INSERT INTO `ruser` (`email`, `name`, `age`) VALUES
('AlbertE@gmail.com', 'Albert Enstoin', 50),
('btom123@gmail.com', 'Thomas Brady', 44),
('JLuc1999@gmail.com', 'Jean Luc', 25),
('johnappleseed@yahoo.com\r\n', 'John Appleseed', 25),
('njimmy@nasa.gov', 'Jimmy Neutron', 14),
('realUser22@gmail.com', 'Real User', 21),
('willwei@bu.edu', 'William Wei', 20);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `mpid` int(11) NOT NULL,
  `season_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`mpid`, `season_count`) VALUES
(4, 5),
(5, 3),
(6, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD KEY `mpid` (`mpid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD KEY `mpid` (`mpid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `uemail` (`uemail`),
  ADD KEY `mpid` (`mpid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`mpid`,`zip`);

--
-- Indexes for table `motionpicture`
--
ALTER TABLE `motionpicture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mpid`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD KEY `mpid` (`mpid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `ruser`
--
ALTER TABLE `ruser`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`mpid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `award`
--
ALTER TABLE `award`
  ADD CONSTRAINT `award_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`),
  ADD CONSTRAINT `award_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `people` (`id`);

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`uemail`) REFERENCES `ruser` (`email`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `motionpicture` (`id`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `people` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
