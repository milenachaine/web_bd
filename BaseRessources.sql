-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 14, 2018 at 01:14 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BaseRessources`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `ID` int(11) NOT NULL,
  `CAT` varchar(250) NOT NULL,
  `EXPL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`ID`, `CAT`, `EXPL`) VALUES
(3, 'questions/réponses', 'ex. forums ou FAQs'),
(4, 'IDE', 'environnement de développemment intégré');

-- --------------------------------------------------------

--
-- Table structure for table `Langages`
--

CREATE TABLE `Langages` (
  `ID` int(11) NOT NULL,
  `NOM` varchar(250) NOT NULL,
  `URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Langages`
--

INSERT INTO `Langages` (`ID`, `NOM`, `URL`) VALUES
(1, 'Python', 'www.python.org'),
(2, 'Perl', 'www.perl.org'),
(3, 'CSS', 'www.w3.org/Style/CSS/Overview.en.html'),
(4, 'HTML', 'validator.w3.org');

-- --------------------------------------------------------

--
-- Table structure for table `Plateformes`
--

CREATE TABLE `Plateformes` (
  `ID` int(11) NOT NULL,
  `TYPE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Plateformes`
--

INSERT INTO `Plateformes` (`ID`, `TYPE`) VALUES
(1, 'en ligne'),
(2, 'Windows'),
(3, 'MacOS'),
(4, 'Linux');

-- --------------------------------------------------------

--
-- Table structure for table `ResJoinCat`
--

CREATE TABLE `ResJoinCat` (
  `RES` int(11) NOT NULL,
  `CAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ResJoinCat`
--

INSERT INTO `ResJoinCat` (`RES`, `CAT`) VALUES
(3, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ResJoinLg`
--

CREATE TABLE `ResJoinLg` (
  `RES` int(11) NOT NULL,
  `LG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ResJoinLg`
--

INSERT INTO `ResJoinLg` (`RES`, `LG`) VALUES
(2, 1),
(1, 3),
(4, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ResJoinPltfrm`
--

CREATE TABLE `ResJoinPltfrm` (
  `RES` int(11) NOT NULL,
  `PLTFRM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ResJoinPltfrm`
--

INSERT INTO `ResJoinPltfrm` (`RES`, `PLTFRM`) VALUES
(1, 1),
(2, 3),
(2, 2),
(2, 4),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Ressources`
--

CREATE TABLE `Ressources` (
  `ID` int(11) NOT NULL,
  `NOM` varchar(250) NOT NULL,
  `URL` text NOT NULL,
  `EXPL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Ressources`
--

INSERT INTO `Ressources` (`ID`, `NOM`, `URL`, `EXPL`) VALUES
(1, 'CSS Zen Garden', 'csszengarden.com/', 'A demonstration of what can be accomplished through CSS-based design.'),
(2, 'PyCharm', 'www.jetbrains.com/pycharm/', 'IDE spécialisée pour Python'),
(3, 'StackOverflow', 'stackoverflow.com', 'Forum de questions/réponses'),
(4, 'HTML Color Picker', 'htmlcolorcodes.com/color-picker/', 'Permet de générer des codes couleur au format hexadécimal, RGB ou HSL.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Langages`
--
ALTER TABLE `Langages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Plateformes`
--
ALTER TABLE `Plateformes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ResJoinCat`
--
ALTER TABLE `ResJoinCat`
  ADD KEY `CAT` (`CAT`),
  ADD KEY `RES` (`RES`);

--
-- Indexes for table `ResJoinLg`
--
ALTER TABLE `ResJoinLg`
  ADD KEY `LG` (`LG`),
  ADD KEY `RES` (`RES`);

--
-- Indexes for table `ResJoinPltfrm`
--
ALTER TABLE `ResJoinPltfrm`
  ADD KEY `PLTFRM` (`PLTFRM`),
  ADD KEY `RES` (`RES`);

--
-- Indexes for table `Ressources`
--
ALTER TABLE `Ressources`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Langages`
--
ALTER TABLE `Langages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Plateformes`
--
ALTER TABLE `Plateformes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Ressources`
--
ALTER TABLE `Ressources`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ResJoinCat`
--
ALTER TABLE `ResJoinCat`
  ADD CONSTRAINT `resjoincat_ibfk_1` FOREIGN KEY (`CAT`) REFERENCES `Categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resjoincat_ibfk_2` FOREIGN KEY (`RES`) REFERENCES `Ressources` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ResJoinLg`
--
ALTER TABLE `ResJoinLg`
  ADD CONSTRAINT `resjoinlg_ibfk_1` FOREIGN KEY (`LG`) REFERENCES `Langages` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resjoinlg_ibfk_2` FOREIGN KEY (`RES`) REFERENCES `Ressources` (`ID`);

--
-- Constraints for table `ResJoinPltfrm`
--
ALTER TABLE `ResJoinPltfrm`
  ADD CONSTRAINT `resjoinpltfrm_ibfk_1` FOREIGN KEY (`PLTFRM`) REFERENCES `Plateformes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resjoinpltfrm_ibfk_2` FOREIGN KEY (`RES`) REFERENCES `Ressources` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
