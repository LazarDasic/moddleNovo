-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 06:58 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodle`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `idAdmina` int(11) NOT NULL,
  `emailAdmina` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sifraAdmina` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imeAdmina` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `prezimeAdmina` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`idAdmina`, `emailAdmina`, `sifraAdmina`, `imeAdmina`, `prezimeAdmina`) VALUES
(1, 'ldasis345@gmail.com', 'lazar5', 'Lazar', 'Dasic'),
(2, 'joxikg@gmail.com', 'jovana1', 'Jovana', 'Nikolic');

-- --------------------------------------------------------

--
-- Table structure for table `fajl`
--

CREATE TABLE `fajl` (
  `idFajla` int(11) NOT NULL,
  `nazivFajla` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `sifraKursa` char(50) NOT NULL,
  `idSekcije` int(11) NOT NULL,
  `tipFajla` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fajl`
--

INSERT INTO `fajl` (`idFajla`, `nazivFajla`, `size`, `sifraKursa`, `idSekcije`, `tipFajla`) VALUES
(8, 'wordfajl.doc', 88576, 'BRTSI5100', 5, 'doc'),
(9, 'lazar_dasic.pdf', 1548495, 'BRTSI8302', 1, 'pdf'),
(10, 'pocetak (1).docx', 460903, 'BRTSI8302', 1, 'docx'),
(11, 'Ð ÐµÐ·ÑƒÐ»Ñ‚Ð°Ñ‚Ð¸ - Ð£Ð¿Ñ€Ð°Ð²Ñ™Ð°ÑšÐµ ÑÐ¾Ñ„Ñ‚Ð²ÐµÑ€ÑÐºÐ¸Ð¼ Ð¿Ñ€Ð¾Ñ˜ÐµÐºÑ‚Ð¸Ð¼Ð°- Ñ˜ÑƒÐ»- 2021.pdf', 182400, 'BRTSI5100', 1, 'pdf'),
(12, 'slika.png', 380480, 'BRTSI5100', 1, 'png'),
(13, 'vezbe_7.zip', 9589, 'BRTSI5100', 7, 'zip'),
(14, 'vezbe_5.zip', 1221, 'BRTSI6300', 5, 'zip');

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

CREATE TABLE `kurs` (
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `smer` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `godinaSlusanja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`sifraKursa`, `naziv`, `smer`, `godinaSlusanja`) VALUES
('BRTSI5100', 'Mikroprocesorski sistemi', 'RTSI', 3),
('BRTSI6300', 'Baze Podataka', 'RTSI', 3),
('BRTSI8302', 'Racunarska Grafika', 'RTSI', 4);

-- --------------------------------------------------------

--
-- Table structure for table `objava`
--

CREATE TABLE `objava` (
  `ID` int(11) NOT NULL,
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL,
  `nedelja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pitanje`
--

CREATE TABLE `pitanje` (
  `idPitanja` int(11) NOT NULL,
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL,
  `idTesta` int(11) NOT NULL,
  `brojPitanja` int(11) NOT NULL,
  `tekstPitanja` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `poeni` double NOT NULL,
  `tekstOdgovora1` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `tekstOdgovora2` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `tekstOdgovora3` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `tekstOdgovora4` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `tacan` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pitanje`
--

INSERT INTO `pitanje` (`idPitanja`, `sifraKursa`, `idTesta`, `brojPitanja`, `tekstPitanja`, `poeni`, `tekstOdgovora1`, `tekstOdgovora2`, `tekstOdgovora3`, `tekstOdgovora4`, `tacan`) VALUES
(1, 'BRTSI6300', 1, 1, 'A', 5, 'A', 'A', 'A', 'A', '3'),
(2, 'BRTSI6300', 1, 2, 'B', 5, 'B', 'B', 'B', 'B', '2,4'),
(3, 'BRTSI6300', 1, 3, 'C', 5, 'C', 'C', 'C', 'C', '2'),
(4, 'BRTSI6300', 1, 4, 'D', 5, 'D', 'D', 'D', 'D', '1'),
(5, 'BRTSI6300', 1, 5, 'E', 5, 'E', 'E', 'E', 'E', '4'),
(6, 'BRTSI6300', 1, 6, 'F', 5, 'F', 'F', 'F', 'F', '1,4'),
(7, 'BRTSI6300', 1, 7, 'G', 5, 'G', 'G', 'G', 'G', '1,3'),
(8, 'BRTSI6300', 1, 8, 'H', 5, 'H', 'H', 'H', 'H', '2'),
(9, 'BRTSI6300', 1, 9, 'I', 5, 'I', 'I', 'I', 'I', '1,2'),
(10, 'BRTSI6300', 1, 10, 'J', 5, 'J', 'J', 'J', 'J', '3'),
(11, 'BRTSI6300', 1, 11, 'K', 5, 'K', 'K', 'K', 'K', '1'),
(12, 'BRTSI6300', 1, 12, 'L', 5, 'L', 'L', 'L', 'L', '4'),
(13, 'BRTSI6300', 1, 13, 'M', 5, 'M', 'M', 'M', 'M', '2'),
(14, 'BRTSI6300', 1, 14, 'N', 5, 'N', 'N', 'N', 'N', '1'),
(15, 'BRTSI6300', 1, 15, 'O', 5, 'O', 'O', 'O', 'O', '4'),
(16, 'BRTSI6300', 1, 16, 'P', 5, 'P', 'P', 'P', 'P', '3'),
(17, 'BRTSI6300', 1, 17, 'Q', 5, 'Q', 'Q', 'Q', 'Q', '3,4'),
(18, 'BRTSI6300', 1, 18, 'R', 5, 'R', 'R', 'R', 'R', '2'),
(19, 'BRTSI6300', 1, 19, 'S', 5, 'S', 'S', 'S', 'S', '3,4'),
(20, 'BRTSI6300', 1, 20, 'T', 5, 'T', 'T', 'T', 'T', '3'),
(21, 'BRTSI8302', 3, 21, 'Koliko ima osa u OpenGL?', 5, '3', '5', '2', '1', '1'),
(22, 'BRTSI8302', 3, 22, 'Koje od sledecih pokreta postoje u OpenGL?', 5, 'Translacija', 'Rotacija', 'Smanjivanje', 'Povecavanje', '1,2'),
(23, 'BRTSI8302', 3, 23, 'Rotacija predstavlja?', 5, 'Linearno kretanje', 'Okretanje oko ose', 'Sinusoidno kretanje', 'Tangentno kretanje', '2'),
(24, 'BRTSI8302', 3, 24, 'Koje OpenGL primitive postoje od navedenih:', 5, 'TRIANGLES', 'HEXAGON', 'QUADS', 'OCTAGON', '1,3'),
(25, 'BRTSI8302', 3, 25, 'Sta iscrtava primitiva gl.Fan()?', 5, 'Niz trouglova sa jednom zajednickom stranicom', 'Niz cetvorouglova sa jednom zajednickom tackom', 'Niz cetvorouglova sa jednom zajednickom stranicom', 'Niz trouglova sa jednom zajednickom tackom', '4'),
(26, 'BRTSI8302', 3, 26, 'Sta radi primitiva gl.STRIP()', 5, 'Niz trouglova sa jednom zajednickom stranicom	', 'Niz cetvorouglova sa jednom zajednickom tackom	', 'Niz cetvorouglova sa jednom zajednickom stranicom	', 'Niz trouglova sa jednom zajednickom tackom	', '2'),
(27, 'BRTSI8302', 3, 27, 'Kakve vrste osvetljenja postoje?', 5, 'Spekularno', 'Difuzno', 'Ambijentalno', 'Opste', '1,2,3'),
(28, 'BRTSI8302', 3, 28, 'Za koriscenje strelica u OpenGL mora se implementirati funkcija:', 5, 'arrowKeys()', 'pressedKey()', 'specialKeys()', 'releasedKey()', '3'),
(29, 'BRTSI8302', 3, 29, 'Koja je najnovija verzija OpenGL standarda?', 5, '4.3', '3.3', '3.6', '4.6', '4'),
(30, 'BRTSI8302', 3, 30, 'Kojom komandom se vrsi iscrtavanje tacaka?', 5, 'glVertex()', 'glPoints()', 'glDots()', 'glCoord()', '1'),
(31, 'BRTSI8302', 3, 31, 'Kojom od sledecih komandi mozemo zadati boju?', 5, 'glColor3f()', 'glColor4f()', 'glColor3g()', 'glColor3b()', '1,2,4'),
(32, 'BRTSI8302', 3, 32, 'Koje komande specifiraju vrstu primitive i kraj njenog koriscenja?', 5, 'glBegin()', 'glStart()', 'glFinish()', 'glEnd()', '1,4'),
(33, 'BRTSI8302', 3, 33, 'Koja pravila mora postovati poligon?', 5, 'Ne sme imati rupu', 'Mora biti nekonveksan', 'Mora biti planaran', 'Mora presecati samog sebe', '1,3'),
(34, 'BRTSI8302', 3, 34, 'Kakve vrste sencenja postoje?', 5, 'Flat ', 'Smooth', 'Textured', 'Full', '1,2'),
(35, 'BRTSI8302', 3, 35, 'Koliko vrsta matrica transformacija postoje?', 5, '2', '3', '5', '4', '2'),
(36, 'BRTSI8302', 3, 36, 'Koje naredbe manipulisu stack-om?', 5, 'glGetMatrix()', 'glPushMatrix()', 'glPullMatrix()', 'glPopMatrix()', '2,4'),
(37, 'BRTSI8302', 3, 37, 'Kamera se moze pozicionirati na koje nacine:', 5, 'Transformacija modela', 'Transformacija pogleda', 'Transformacija matrice', 'Transformacija kamere', '1,2'),
(38, 'BRTSI8302', 3, 38, 'Koji od sledecih bafera postoje u OpenGL:', 5, 'Texture buffer', 'Color buffer', 'Z-buffer', 'Stencil buffer', '1,2,3'),
(39, 'BRTSI8302', 3, 39, 'Koliko izvora svetlosti se moze implementirati u OpenGL programu?', 5, '5', '6', '1', '8', '4'),
(40, 'BRTSI8302', 3, 40, 'U skracenici RGBA koje slovo se odnosi na prozirnost?', 5, 'R', 'G', 'B', 'A', '4');

-- --------------------------------------------------------

--
-- Table structure for table `prati`
--

CREATE TABLE `prati` (
  `idStudenta` int(11) NOT NULL,
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prati`
--

INSERT INTO `prati` (`idStudenta`, `sifraKursa`) VALUES
(1, 'BRTSI6300'),
(2, 'BRTSI6300'),
(2, 'BRTSI8302'),
(3, 'BRTSI5100'),
(3, 'BRTSI6300'),
(4, 'BRTSI5100'),
(4, 'BRTSI6300'),
(4, 'BRTSI8302');

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE `profesor` (
  `idProfesora` int(11) NOT NULL,
  `fotografija` varchar(255) NOT NULL DEFAULT 'defaultpp.jpg',
  `emailProfesora` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sifraProfesora` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imeProfesora` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `prezimeProfesora` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `grad` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `drzava` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`idProfesora`, `fotografija`, `emailProfesora`, `sifraProfesora`, `imeProfesora`, `prezimeProfesora`, `grad`, `drzava`) VALUES
(1, 'slika.png', 'ericm@kg.ac.rs', 'milan123', 'Milan', 'Eric', 'Kragujevac', 'Srbija'),
(2, 'defaultpp.jpg', 'tijanas@kg.ac.rs', 'tijana2', 'Tijana', 'Sustersic', 'Kragujevac', 'Srbija'),
(3, 'defaultpp.jpg', 'adjordjevic@gmail.com', 'aca67', 'Aleksandar', 'Djordjevic', 'Kragujevac', 'Srbija'),
(4, 'defaultpp.jpg', 'fica@kg.ac.rs', 'nenad123', 'Nenad', 'Filipovic', 'Kragujevac', 'Srbija'),
(5, 'defaultpp.jpg', 'vmilovanovic@gmail.com', 'sifra123', 'Vladimir', 'Milovanovic', 'Kragujevac', 'Srbija'),
(6, 'defaultpp.jpg', 'amarkovic@yahoo.com', 'aleksa12', 'Aleksa', 'Markovic', 'Kragujevac', 'Srbija'),
(7, 'defaultpp.jpg', 'djole@gmail.com', 'Djordje', 'Djordje', 'Milenkovic', 'Beograd', 'Srbija');

-- --------------------------------------------------------

--
-- Table structure for table `radio`
--

CREATE TABLE `radio` (
  `idStudenta` int(11) NOT NULL,
  `idTesta` int(11) NOT NULL,
  `emailStudenta` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL,
  `bodovi` double NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `radio`
--

INSERT INTO `radio` (`idStudenta`, `idTesta`, `emailStudenta`, `sifraKursa`, `bodovi`) VALUES
(1, 1, 'stevanovicmladen270698@gmail.com', 'BRTSI6300', 10),
(2, 1, 'nikola.mitrevski1998@gmail.com', 'BRTSI6300', 32.5);

-- --------------------------------------------------------

--
-- Table structure for table `sifra`
--

CREATE TABLE `sifra` (
  `idSifre` int(11) NOT NULL,
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL,
  `idProfesora` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifra`
--

INSERT INTO `sifra` (`idSifre`, `sifraKursa`, `idProfesora`, `status`) VALUES
(1, 'BRTSI6300', 1, 'zauzeta'),
(2, 'BRTSI8302', 2, 'zauzeta'),
(3, 'BRTSI5100', 2, 'zauzeta');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idStudenta` int(11) NOT NULL,
  `emailStudenta` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sifraStudenta` varchar(255) CHARACTER SET latin1 NOT NULL,
  `brojIndeksa` varchar(255) CHARACTER SET latin1 NOT NULL,
  `godinaUpisa` int(11) NOT NULL,
  `imeStudenta` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `prezimeStudenta` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `godina` int(11) NOT NULL,
  `smer` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `grad` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `drzava` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `fotografija` varchar(255) NOT NULL DEFAULT 'defaultpp.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idStudenta`, `emailStudenta`, `sifraStudenta`, `brojIndeksa`, `godinaUpisa`, `imeStudenta`, `prezimeStudenta`, `godina`, `smer`, `grad`, `drzava`, `fotografija`) VALUES
(1, 'stevanovicmladen270698@gmail.com', 'mladen98', '602/2017', 2017, 'Mladen', 'Stevanovic', 4, 'RTSI', 'Smederevska Palanka', 'Srbija', 'defaultpp.jpg'),
(2, 'nikola.mitrevski1998@gmail.com', 'nikola12', '603/2017', 2017, 'Nikola', 'Mitrevski', 4, 'RTSI', 'Velika Plana', 'Srbija', 'defaultpp.jpg'),
(3, 'jovanovicana9898@gmail.com', 'ana1', '627/2017', 2017, 'Ana', 'Jovanovic', 4, 'RTSI', 'Kragujevac', 'Srbija', 'women.jfif'),
(4, 'grujic.isidora2@gmail.com', 'isidora123', '634/2017', 2017, 'Isidora', 'Grujic', 4, 'RTSI', 'Kragujevac', 'Srbija', 'defaultpp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `idTesta` int(11) NOT NULL,
  `sifraKursa` char(50) CHARACTER SET latin1 NOT NULL,
  `nazivTesta` varchar(255) CHARACTER SET latin1 NOT NULL,
  `brojPitanja` int(11) NOT NULL DEFAULT '20',
  `status` varchar(10) CHARACTER SET latin1 NOT NULL,
  `SviPoeni` double NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`idTesta`, `sifraKursa`, `nazivTesta`, `brojPitanja`, `status`, `SviPoeni`) VALUES
(1, 'BRTSI6300', 'Kolokvijum-1', 20, 'odobren', 100),
(2, 'BRTSI6300', 'Kolokvijum-2', 20, 'zatvoren', 100),
(3, 'BRTSI8302', 'Prvi_kolokvijum', 20, 'odobren', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`idAdmina`),
  ADD UNIQUE KEY `emailAdmina` (`emailAdmina`);

--
-- Indexes for table `fajl`
--
ALTER TABLE `fajl`
  ADD PRIMARY KEY (`idFajla`);

--
-- Indexes for table `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`sifraKursa`),
  ADD UNIQUE KEY `sifraKursa` (`sifraKursa`);

--
-- Indexes for table `objava`
--
ALTER TABLE `objava`
  ADD PRIMARY KEY (`ID`,`sifraKursa`,`nedelja`),
  ADD KEY `objava_fk_idx` (`sifraKursa`);

--
-- Indexes for table `pitanje`
--
ALTER TABLE `pitanje`
  ADD PRIMARY KEY (`idPitanja`,`sifraKursa`,`idTesta`),
  ADD KEY `test_fk_idx` (`sifraKursa`,`idTesta`);

--
-- Indexes for table `prati`
--
ALTER TABLE `prati`
  ADD PRIMARY KEY (`idStudenta`,`sifraKursa`),
  ADD KEY `fk_student_has_kurs_kurs1_idx` (`sifraKursa`),
  ADD KEY `fk_student_has_kurs_student1_idx` (`idStudenta`);

--
-- Indexes for table `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idProfesora`),
  ADD UNIQUE KEY `emailProfesora` (`emailProfesora`);

--
-- Indexes for table `radio`
--
ALTER TABLE `radio`
  ADD PRIMARY KEY (`idStudenta`,`idTesta`,`sifraKursa`),
  ADD KEY `fk_student_has_test_test1_idx` (`idTesta`,`sifraKursa`),
  ADD KEY `fk_student_has_test_student1_idx` (`idStudenta`);

--
-- Indexes for table `sifra`
--
ALTER TABLE `sifra`
  ADD PRIMARY KEY (`idSifre`),
  ADD UNIQUE KEY `sifraKursa` (`sifraKursa`),
  ADD KEY `pprof_fk` (`idProfesora`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudenta`),
  ADD UNIQUE KEY `emailStudenta` (`emailStudenta`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idTesta`,`sifraKursa`),
  ADD KEY `kurs_fk_idx` (`sifraKursa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `idAdmina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fajl`
--
ALTER TABLE `fajl`
  MODIFY `idFajla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `objava`
--
ALTER TABLE `objava`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pitanje`
--
ALTER TABLE `pitanje`
  MODIFY `idPitanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idProfesora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `radio`
--
ALTER TABLE `radio`
  MODIFY `idTesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sifra`
--
ALTER TABLE `sifra`
  MODIFY `idSifre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idStudenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `idTesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kurs`
--
ALTER TABLE `kurs`
  ADD CONSTRAINT `fk_profesor_has_kurs_kurs1` FOREIGN KEY (`sifraKursa`) REFERENCES `sifra` (`sifraKursa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objava`
--
ALTER TABLE `objava`
  ADD CONSTRAINT `objava_fk` FOREIGN KEY (`sifraKursa`) REFERENCES `kurs` (`sifraKursa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pitanje`
--
ALTER TABLE `pitanje`
  ADD CONSTRAINT `test_fk` FOREIGN KEY (`sifraKursa`,`idTesta`) REFERENCES `test` (`sifraKursa`, `idTesta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prati`
--
ALTER TABLE `prati`
  ADD CONSTRAINT `fk_student_has_kurs_kurs1` FOREIGN KEY (`sifraKursa`) REFERENCES `kurs` (`sifraKursa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_has_kurs_student1` FOREIGN KEY (`idStudenta`) REFERENCES `student` (`idStudenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radio`
--
ALTER TABLE `radio`
  ADD CONSTRAINT `fk_student_has_test_student1` FOREIGN KEY (`idStudenta`) REFERENCES `student` (`idStudenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_has_test_test1` FOREIGN KEY (`idTesta`,`sifraKursa`) REFERENCES `test` (`idTesta`, `sifraKursa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sifra`
--
ALTER TABLE `sifra`
  ADD CONSTRAINT `pprof_fk` FOREIGN KEY (`idProfesora`) REFERENCES `profesor` (`idProfesora`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `kurs_fk` FOREIGN KEY (`sifraKursa`) REFERENCES `kurs` (`sifraKursa`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
