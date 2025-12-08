-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 07:46 PM
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
-- Database: `afp_cahol`
--

-- --------------------------------------------------------

--
-- Table structure for table `autok`
--

CREATE TABLE `autok` (
  `rendszam` varchar(15) NOT NULL,
  `tip_id` varchar(10) NOT NULL,
  `uzemanyag` varchar(10) NOT NULL,
  `szin` varchar(20) NOT NULL,
  `beszerzes` date NOT NULL,
  `foto_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autok`
--

INSERT INTO `autok` (`rendszam`, `tip_id`, `uzemanyag`, `szin`, `beszerzes`, `foto_url`) VALUES
('NVS-540', '2', 'Benzin', 'Fehér', '2016-05-01', ''),
('PSP-820', '1', 'Benzin', 'Grafit', '2018-03-28', ''),
('TV 82-68', '8', 'Benzin', 'Fehér', '1988-06-01', 'kepek_db/6844e0566908c_250px-Trabant_601_Universal_1970.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `auto_tipus`
--

CREATE TABLE `auto_tipus` (
  `tip_id` int(10) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `felepitmeny` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auto_tipus`
--

INSERT INTO `auto_tipus` (`tip_id`, `marka`, `tipus`, `felepitmeny`) VALUES
(1, 'Opel', 'Corsa', '5 ajtós'),
(2, 'Skoda', 'Octavia', 'Sedan'),
(7, 'Ford', 'Mondeo', 'Sedan'),
(8, 'Trabant', '601', 'Kombi');

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `dolg_id` int(10) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `jelszo` varchar(32) NOT NULL,
  `jogosultsag` varchar(5) NOT NULL DEFAULT 'user',
  `osztaly_id` varchar(10) NOT NULL,
  `foto_d_url` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felhasznalok`
--

INSERT INTO `felhasznalok` (`dolg_id`, `nev`, `jelszo`, `jogosultsag`, `osztaly_id`, `foto_d_url`, `email`) VALUES
(1, 'Admin', '7fd4e0ed6c1c2bad7e4802576f2141e0', 'admin', 'gazd', '', ''),
(2, 'Tóth László', '7fd4e0ed6c1c2bad7e4802576f2141e0', 'user', 'gazd', '', 'latohu@hotmail.com'),
(3, 'Németh Attila', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'term', '', ''),
(4, 'Nagy Lajos', '7fd4e0ed6c1c2bad7e4802576f2141e0', 'user', 'term', '', 'naki@mollie.com'),
(5, 'Tóth Ádám', '7fd4e0ed6c1c2bad7e4802576f2141e0', 'user', 'term', '', ''),
(6, 'Nagy Gergő', '5ea01af357a91827b995e24ae7a8baa8', 'user', '', '', 'nagy.g3rg0@gmail.com'),
(7, 'Teszt Elek', 'd95151107f8886dcef1fe2f0963a681f', 'user', '', '', 'teszt@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kinel_van`
--

CREATE TABLE `kinel_van` (
  `id` int(10) NOT NULL,
  `dolg_id` int(10) NOT NULL,
  `rendszam` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kinel_van`
--

INSERT INTO `kinel_van` (`id`, `dolg_id`, `rendszam`) VALUES
(7, 2, 'NVS-540');

-- --------------------------------------------------------

--
-- Table structure for table `osztalyok`
--

CREATE TABLE `osztalyok` (
  `osztaly_id` varchar(10) NOT NULL,
  `osztaly_nev` varchar(50) NOT NULL,
  `leiras` varchar(200) DEFAULT NULL,
  `vezeto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `osztalyok`
--

INSERT INTO `osztalyok` (`osztaly_id`, `osztaly_nev`, `leiras`, `vezeto`) VALUES
('besz', 'Beszerzési osztály', NULL, NULL),
('gazd', 'Gazdasági osztály', NULL, NULL),
('term', 'Termelés', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `telephely`
--

CREATE TABLE `telephely` (
  `tlph_id` int(10) NOT NULL,
  `telephely_nev` varchar(50) NOT NULL,
  `cim` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `telephely`
--

INSERT INTO `telephely` (`tlph_id`, `telephely_nev`, `cim`) VALUES
(1, 'Huszti', '1032 Budapest\r\nHuszti út 60'),
(2, 'Szada', 'Szada\r\nIpari park 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autok`
--
ALTER TABLE `autok`
  ADD PRIMARY KEY (`rendszam`);

--
-- Indexes for table `auto_tipus`
--
ALTER TABLE `auto_tipus`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`dolg_id`);

--
-- Indexes for table `kinel_van`
--
ALTER TABLE `kinel_van`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `osztalyok`
--
ALTER TABLE `osztalyok`
  ADD PRIMARY KEY (`osztaly_id`);

--
-- Indexes for table `telephely`
--
ALTER TABLE `telephely`
  ADD PRIMARY KEY (`tlph_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_tipus`
--
ALTER TABLE `auto_tipus`
  MODIFY `tip_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `dolg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kinel_van`
--
ALTER TABLE `kinel_van`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `telephely`
--
ALTER TABLE `telephely`
  MODIFY `tlph_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
