-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 07:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`) VALUES
(1, 'admin', '7ba0fc801886e4dc26efe1b846a7c15f', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `year_released` year(4) NOT NULL,
  `borrowed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `barcode`, `title`, `author`, `publisher`, `genre`, `year_released`, `borrowed_by`) VALUES
(3, '1965463176', 'Habis Gelap Terbitlah Terang', 'R. A. Kartini', 'Indonesia Raya', 'Education', 1945, NULL),
(4, '6546543213', 'Habis Gelap Terbitlah Terang', 'R. A. Kartini', 'Indonesia Raya', 'Education', 1945, NULL),
(5, '123456', 'Bumi Datar', 'Rangga', 'PT Sunda Empire', 'Education', 2021, 1),
(6, '1654', 'Bumi Datar', 'Rangga', 'PT Sunda Empire', 'Education', 2021, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `college_student`
--

CREATE TABLE `college_student` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_student`
--

INSERT INTO `college_student` (`id`, `username`, `password`, `id_number`, `fullname`) VALUES
(1, 'mhs1', '0e2a11c20bb6a0e024e47fee75696f96', '18012345', 'Mahasiswa Satu'),
(3, 'Indra', '799da4a9eb99ba0a30bdb9bf7145aff7', '12345677777', 'Indra Yuhyen'),
(4, 'rizal', '393b02a32ebe3cf9138230af376d0bc8', '123457794', 'Rizal Maul'),
(6, 'mhs2', '9fa7cf3e7483617c8a06f5a6eba11578', '213123', 'Mahasiswa Dua');

-- --------------------------------------------------------

--
-- Table structure for table `library_officer`
--

CREATE TABLE `library_officer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library_officer`
--

INSERT INTO `library_officer` (`id`, `username`, `password`, `id_number`, `fullname`) VALUES
(1, 'petugas', '9a18e20557ec1a5eb0875c6ef2f35a8c', '19991346 201006 1 002', 'Indra Athalla Yuhen');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `reservation_code` varchar(100) NOT NULL,
  `check_in` date NOT NULL,
  `cs_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `reservation_code`, `check_in`, `cs_id`, `book_id`, `timestamp`, `status`) VALUES
(1, 'Fri210528172508', '2021-05-28', 1, 3, '2021-05-28', 'OUT'),
(2, 'Fri210528172508', '2021-05-28', 1, 4, '2021-05-28', 'OUT'),
(3, 'Fri210528172508', '2021-05-28', 1, 5, '2021-05-28', 'OUT'),
(7, 'Fri210528184308', '2021-05-28', 1, 3, '2021-05-28', 'OUT'),
(8, 'Fri210528184308', '2021-05-28', 1, 4, '2021-05-28', 'OUT'),
(9, 'Fri210528184308', '2021-05-28', 1, 5, '2021-05-28', 'OUT'),
(10, 'Fri210528190702', '2021-05-30', 1, 6, '2021-05-28', 'OUT'),
(11, 'Sat210529164222', '2021-05-30', 1, 3, '2021-05-29', 'OUT'),
(12, 'Sat210529164222', '2021-05-30', 1, 5, '2021-05-29', 'OUT'),
(13, 'Sat210529172446', '2021-05-31', 1, 4, '2021-05-29', 'OUT'),
(14, 'Sun210530101834', '2021-05-30', 1, 5, '2021-05-30', 'OUT'),
(15, 'Tue210601000511', '2021-06-01', 4, 3, '2021-06-01', 'OUT'),
(16, 'Wed210602230638', '2021-06-02', 1, 3, '2021-06-02', 'OUT'),
(17, 'Wed210602235444', '2021-06-03', 1, 5, '2021-06-02', 'PENDING');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cs_book` (`borrowed_by`);

--
-- Indexes for table `college_student`
--
ALTER TABLE `college_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_officer`
--
ALTER TABLE `library_officer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cs_reservation` (`cs_id`),
  ADD KEY `fk_book_reservation` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `college_student`
--
ALTER TABLE `college_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `library_officer`
--
ALTER TABLE `library_officer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_cs_book` FOREIGN KEY (`borrowed_by`) REFERENCES `college_student` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_book_reservation` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cs_reservation` FOREIGN KEY (`cs_id`) REFERENCES `college_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
