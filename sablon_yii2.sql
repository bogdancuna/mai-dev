-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2021 at 09:17 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-8+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sablon_yii2`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('lucrator', '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, NULL, NULL),
('lucrator', 2, 'Lucrator', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user_log` int(11) NOT NULL,
  `action_log` varchar(50) NOT NULL,
  `tabela_log` varchar(50) NOT NULL,
  `id_model_log` int(11) NOT NULL,
  `changes_log` text,
  `data_log` datetime NOT NULL,
  `ip_log` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1574770459),
('m130524_201442_init', 1574770466),
('m190124_110200_add_verification_token_column_to_user_table', 1574770467);

-- --------------------------------------------------------

--
-- Table structure for table `ordonatori`
--

CREATE TABLE `ordonatori` (
  `id` int(11) NOT NULL,
  `denumire` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tip_ord` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordonatori`
--

INSERT INTO `ordonatori` (`id`, `denumire`, `tip_ord`) VALUES
(1, 'Ordonator Principal de Credite - Ministerul Afacerilor Interne', 1),
(2, 'Administraţia Naţională a Rezervelor de Stat şi Probleme Speciale', 2),
(3, 'A.N.R.S.P.S.-Unitatea Teritoriala 95 Jibou Judeţul Sălaj', 3),
(4, 'A.N.R.S.P.S.-Unitatea Teritorială 130 Cîineni Judeţul Vâlcea', 3),
(5, 'A.N.R.S.P.S.-Unitatea Teritorială 135 Dăeşti Judeţul Vâlcea', 3),
(6, 'A.N.R.S.P.S.-Unitatea Teritorială 140 Mărunţişu Judeţul Buzău', 3),
(7, 'A.N.R.S.P.S.-Unitatea Teritorială 145 Ţânţăreni Judeţul Gorj', 3),
(8, 'A.N.R.S.P.S.-Unitatea Teritorială 150 Buciumeni Judeţul Dâmboviţa', 3),
(9, 'A.N.R.S.P.S.-Unitatea Teritorială 235 Gura Ocniţei Judeţul Dâmboviţa', 3),
(10, 'A.N.R.S.P.S.-Unitatea Teritorială 240 Codlea Judeţul Braşov', 3),
(11, 'A.N.R.S.P.S.-Unitatea Teritorială 260 Porumbacu Judeţul Sibiu', 3),
(12, 'A.N.R.S.P.S.-Unitatea Teritorială 265 Valea Seacă Judeţul Bacău', 3),
(13, 'A.N.R.S.P.S.-Unitatea Teritorială 310 Barcea Judeţul Galaţi', 3),
(14, 'A.N.R.S.P.S.-Unitatea Teritorială 315 Bucecea Judeţul Botoşani', 3),
(15, 'A.N.R.S.P.S.-Unitatea Teritorială 320 Dridu Judeţul Ialomiţa', 3),
(16, 'A.N.R.S.P.S.-Unitatea Teritorială 325 Orbeni Judeţul Bacău', 3),
(17, 'A.N.R.S.P.S.-Unitatea Teritorială 330 Podoleni Judeţul Neamţ', 3),
(18, 'A.N.R.S.P.S.-Unitatea Teritorială 335 Urecheşti Judeţul Bacău', 3),
(19, 'A.N.R.S.P.S.-Unitatea Teritorială 345 Sibiu Judeţul Sibiu', 3),
(20, 'A.N.R.S.P.S.-Unitatea Teritorială 350 Popesti Leordeni Judeţul Ilfov', 3),
(21, 'A.N.R.S.P.S.-Unitatea Teritorială 355 Caransebeş Judeţul Caraş-Severin', 3),
(22, 'A.N.R.S.P.S.-Unitatea Teritorială 360 Curtea de Argeş Judeţul Argeş', 3),
(23, 'A.N.R.S.P.S.-Unitatea Teritorială 370 Ioneşti Judeţul Vâlcea', 3),
(24, 'A.N.R.S.P.S.-Unitatea Teritorială 425 Bistriţa Judeţul Neamţ', 3),
(25, 'A.N.R.S.P.S.-Unitatea Teritorială 430 Sinca Veche Judeţul Braşov', 3),
(26, 'A.N.R.S.P.S.-Unitatea Teritorială 440 Gura Vitioarei Judeţul Prahova', 3),
(27, 'A.N.R.S.P.S.-Unitatea Teritorială 515 Bucureşti', 3),
(28, 'Inspectoratul General al Poliţiei de Frontieră', 2),
(29, 'Inspectoratul Teritorial al Poliţiei de Frontieră Oradea', 3),
(30, 'Inspectoratul Teritorial al Poliţiei de Frontieră Giurgiu', 3),
(31, 'Inspectoratul Teritorial al Poliţiei de Frontieră Iaşi', 3),
(32, 'Inspectoratul Teritorial al Poliţiei de Frontieră Sighet', 3),
(33, 'Inspectoratul Teritorial al Poliţiei de Frontieră Timişoara', 3),
(34, 'Garda de Coastă', 3),
(35, 'Şcoala de pregătire a agenţilor poliţiei de frontieră Avram Iancu Oradea', 3),
(36, 'Baza de reparaţii nave Brăila', 3),
(38, 'Inspectoratul General al Poliţiei Române  ', 2),
(39, 'Direcţia Generală de Poliţie a Municipiului Bucureşti', 3),
(40, 'Inspectoratul de poliţie judeţean Alba', 3),
(41, 'Inspectoratul de poliţie judeţean Arad', 3),
(42, 'Inspectoratul de poliţie judeţean Argeş', 3),
(43, 'Inspectoratul de poliţie judeţean Bacău', 3),
(44, 'Inspectoratul de poliţie judeţean Bihor', 3),
(45, 'Inspectoratul de poliţie judeţean Bistriţa Năsăud', 3),
(46, 'Inspectoratul de poliţie judeţean Botoşani', 3),
(47, 'Inspectoratul de poliţie judeţean Brăila', 3),
(48, 'Inspectoratul de poliţie judeţean Braşov', 3),
(49, 'Inspectoratul de poliţie judeţean Buzău', 3),
(50, 'Inspectoratul de poliţie judeţean Călăraşi', 3),
(51, 'Inspectoratul de poliţie judeţean Caraş Severin', 3),
(52, 'Inspectoratul de poliţie judeţean Cluj', 3),
(53, 'Inspectoratul de poliţie judeţean Constanţa', 3),
(54, 'Inspectoratul de poliţie judeţean Covasna', 3),
(55, 'Inspectoratul de poliţie judeţean Dâmboviţa', 3),
(56, 'Inspectoratul de poliţie judeţean Dolj', 3),
(57, 'Inspectoratul de poliţie judeţean Galaţi', 3),
(58, 'Inspectoratul de poliţie judeţean Giurgiu', 3),
(59, 'Inspectoratul de poliţie judeţean Gorj', 3),
(60, 'Inspectoratul de poliţie judeţean Harghita', 3),
(61, 'Inspectoratul de poliţie judeţean Hunedoara', 3),
(62, 'Inspectoratul de poliţie judeţean Ialomiţa', 3),
(63, 'Inspectoratul de poliţie judeţean Iaşi', 3),
(64, 'Inspectoratul de poliţie judeţean Ilfov', 3),
(65, 'Inspectoratul de poliţie judeţean Maramureş', 3),
(66, 'Inspectoratul de poliţie judeţean Mehedinţi', 3),
(67, 'Inspectoratul de poliţie judeţean Mureş', 3),
(68, 'Inspectoratul de poliţie judeţean Neamţ', 3),
(69, 'Inspectoratul de poliţie judeţean Olt', 3),
(70, 'Inspectoratul de poliţie judeţean Prahova', 3),
(71, 'Inspectoratul de poliţie judeţean Sălaj', 3),
(72, 'Inspectoratul de poliţie judeţean Satu Mare', 3),
(73, 'Inspectoratul de poliţie judeţean Sibiu', 3),
(74, 'Inspectoratul de poliţie judeţean Suceava', 3),
(75, 'Inspectoratul de poliţie judeţean Teleorman', 3),
(76, 'Inspectoratul de poliţie judeţean Timiş', 3),
(77, 'Inspectoratul de poliţie judeţean Tulcea', 3),
(78, 'Inspectoratul de poliţie judeţean Vâlcea', 3),
(79, 'Inspectoratul de poliţie judeţean Vaslui', 3),
(80, 'Inspectoratul de poliţie judeţean Vrancea', 3),
(81, 'Şcoala de Agenţi de Poliţie “Vasile Lascăr” Câmpina', 3),
(82, 'Şcoala de Agenţi de Poliţie “Septimiu Mureşan”  Cluj-Napoca ', 3),
(84, 'Centrul chinologic “dr. Aurel Greblea” Sibiu', 3),
(85, 'Inspectoratul General de Aviaţie al M.A.I.', 2),
(86, 'Unitatea Specială de Aviaţie Bucureşti', 3),
(87, 'Unitatea Specială de Aviaţie Cluj-Napoca ', 3),
(88, 'Unitatea Specială de Aviaţie Iaşi ', 3),
(89, 'Unitatea Specială de Aviaţie Tulcea ', 3),
(90, 'Inspectoratul General pentru Situaţii de Urgenţă', 2),
(92, 'U.M. 0170 - Inspectoratul pentru Situaţii de Urgenţă Unirea al judeţului Alba', 3),
(93, 'U.M. 0173 - Inspectoratul pentru Situaţii de Urgenţă Vasile Goldiş al judeţului Arad', 3),
(94, 'U.M. 0175 - Inspectoratul pentru Situaţii de Urgenţă Cpt. Puică Nicolae al judeţului Argeş', 3),
(95, 'U.M. 0551 - Inspectoratul pentru Situaţii de Urgenţă Mr. Constantin Ene al judeţului Bacău', 3),
(96, 'U.M. 0176 - Inspectoratul pentru Situaţii de Urgenţă Crişana al judeţului Bihor', 3),
(97, 'U.M. 0177 - Inspectoratul pentru Situaţii de Urgenţă Bistriţa al judeţului Bistriţa-Năsăud', 3),
(98, 'U.M. 0180 - Inspectoratul pentru Situaţii de Urgenţă Nicolae Iorga al judeţului Botoşani', 3),
(99, 'U.M. 0416 - Inspectoratul pentru Situaţii de Urgenţă Ţara Bârsei al judeţului Braşov', 3),
(100, 'U.M. 0186 - Inspectoratul pentru Situaţii de Urgenţă Dunărea al judeţului Brăila', 3),
(101, 'U.M. 0196 - Inspectoratul pentru Situaţii de Urgenţă Neron Lupaşcu al judeţului Buzău', 3),
(102, 'U.M. 0207 - Inspectoratul pentru Situaţii de Urgenţă Semenic al judeţului Caraş-Severin', 3),
(103, 'U.M. 0214 - Inspectoratul pentru Situaţii de Urgenţă Barbu Ştirbei al judeţului Călăraşi', 3),
(104, 'U.M. 0427 - Inspectoratul pentru Situaţii de Urgenţă Avram Iancu al judeţului Cluj', 3),
(105, 'U.M. 0434 - Inspectoratul pentru Situaţii de Urgenţă Dobrogea al judeţului Constanţa', 3),
(106, 'U.M. 0220 - Inspectoratul pentru Situaţii de Urgenţă Mihai Viteazul al judeţului Covasna', 3),
(107, 'U.M. 0448 - Inspectoratul pentru Situaţii de Urgenţă Basarab I al judeţului Dâmboviţa', 3),
(108, 'U.M. 0394 - Inspectoratul pentru Situaţii de Urgenţă Oltenia al judeţului Dolj', 3),
(109, 'U.M. 0403 - Inspectoratul pentru Situaţii de Urgenţă Gral Ieremia Grigorescu al jud. Galaţi', 3),
(110, 'U.M. 0231 - Inspectoratul pentru Situaţii de Urgenţă Vlaşca al judeţului Giurgiu', 3),
(111, 'U.M. 0237 - Inspectoratul pentru Situaţii de Urgenţă Lt.col. Dumitru Petrescu al jud. Gorj', 3),
(112, 'U.M. 0241 - Inspectoratul pentru Situaţii de Urgenţă Oltul al judeţului Harghita', 3),
(113, 'U.M. 0245 - Inspectoratul pentru Situaţii de Urgenţă Iancu de Hunedoara al jud. Hunedoara', 3),
(114, 'U.M. 0247 - Inspectoratul pentru Situaţii de Urgenţă Barbu Catargiu al judeţului Ialomiţa', 3),
(115, 'U.M. 0253 - Inspectoratul pentru Situaţii de Urgenţă Mihail Grigore Sturza al judeţului Iaşi', 3),
(117, 'U.M. 0258 - Inspectoratul pentru Situaţii de Urgenţă Ghe. Pop de Băseşti al jud. Maramureş', 3),
(118, 'U.M. 0262 - Inspectoratul pentru Situaţii de Urgenţă Drobeta al judeţului Mehedinţi', 3),
(119, 'U.M. 0270 - Inspectoratul pentru Situaţii de Urgenţă Horea al judeţului Mureş', 3),
(120, 'U.M. 0274 - Inspectoratul pentru Situaţii de Urgenţă Petrodava al judeţului Neamţ', 3),
(121, 'U.M. 0275 - Inspectoratul pentru Situaţii de Urgenţă Matei Basarab al judeţului Olt', 3),
(122, 'U.M. 0409 - Inspectoratul pentru Situaţii de Urgenţă Şerban Cantacuzino al jud. Prahova', 3),
(123, 'U.M. 0281 - Inspectoratul pentru Situaţii de Urgenţă Someş al judeţului Satu-Mare', 3),
(124, 'U.M. 0286 - Inspectoratul pentru Situaţii de Urgenţă Porolissum al judeţului Sălaj', 3),
(125, 'U.M. 0290 - Inspectoratul pentru Situaţii de Urgenţă Cpt. Dumitru Croitoru al jud. Sibiu', 3),
(126, 'U.M. 0321 - Inspectoratul pentru Situaţii de Urgenţă Bucovina al judeţului Suceava', 3),
(127, 'U.M. 0324 - Inspectoratul pentru Situaţii de Urgenţă Al. Dimitrie Ghica al jud. Teleorman', 3),
(128, 'U.M. 0420 - Inspectoratul pentru Situaţii de Urgenţă Banat al judeţului Timiş', 3),
(129, 'U.M. 0337 - Inspectoratul pentru Situaţii de Urgenţă Delta al judeţului Tulcea', 3),
(130, 'U.M. 0345 - Inspectoratul pentru Situaţii de Urgenţă Podul Înalt al judeţului Vaslui', 3),
(131, 'U.M. 0358 - Inspectoratul pentru Situaţii de Urgenţă General Magheru al judeţului Vâlcea', 3),
(132, 'U.M. 0367 - Inspectoratul pentru Situaţii de Urgenţă Anghel Saligny al judeţului Vrancea', 3),
(134, 'U.M. 0490 - Centrul Naţional de Pregătire pentru Managementul Situaţiilor de Urgenţă Ciolpani', 3),
(135, 'U.M. 0443 - Şcoala de Subofiţeri Pompieri şi Protecţie Civilă Boldeşti', 3),
(136, 'U.M. 0333 - Baza pentru Logistică a I.G.S.U.', 3),
(137, 'U.M. 0172 - Baza de Reparaţii a Tehnicii de Intervenţie Dragalina', 3),
(138, 'U.M. 0514 - Depozitul Rezerve Proprii 209 Mizil', 3),
(139, 'U.M. 0541 - Depozitul Rezerve Proprii 213 Şinca Veche', 3),
(140, 'U.M. 0543 - Depozitul Rezerve Proprii 230 Tecuci', 3),
(141, 'U.M. 0629 – Unitatea Specială de Intervenţie în Situaţii de Urgenţă', 3),
(142, 'Inspectoratul General pentru Imigrări', 2),
(143, 'Centrul regional de cazare şi proceduri pentru solicitanţii de azil Timişoara', 3),
(144, 'Centrul regional de cazare şi proceduri pentru solicitanţii de azil Rădăuţi', 3),
(147, 'U.M. 0251 Bucureşti - Inspectoratul General al Jandarmeriei Române', 2),
(148, 'U.M. 0260 Bucureşti - Baza de Administrare şi Deservire a I.G.J.', 3),
(150, 'U.M. 0465 Bucureşti - Brigada Specială de Intervenţie a Jandarmeriei ', 3),
(152, 'U.M. 0575 Bucureşti - Direcţia Generală de Jandarmi a Municipiului Bucureşti', 3),
(155, 'U.M. 0999 Bucureşti - Şcoala de Aplicaţie pentru Ofiţeri a Jandarmeriei Române Mihai Viteazul', 3),
(156, 'U.M. 0338 Alba Iulia - Inspectoratul de Jandarmi Judeţean Alba', 3),
(157, 'U.M. 0437 Arad - Inspectoratul de Jandarmi Judeţean Arad', 3),
(158, 'U.M. 0681 Piteşti - Inspectoratul de Jandarmi Judeţean Argeş', 3),
(159, 'U.M. 0836 Bacău - Inspectoratul de Jandarmi Judeţean Bacău', 3),
(160, 'U.M. 0657 Oradea - Inspectoratul de Jandarmi Judeţean Bihor', 3),
(161, 'U.M. 0565 Bistriţa  - Inspectoratul de Jandarmi Judeţean Bistriţa Năsăud', 3),
(162, 'U.M. 0901 Botoşani  - Inspectoratul de Jandarmi Judeţean Botoşani', 3),
(163, 'U.M. 0391 Braşov  - Inspectoratul de Jandarmi Judeţean Braşov', 3),
(164, 'U.M. 0242 Brăila  - Inspectoratul de Jandarmi Judeţean Brăila', 3),
(165, 'U.M. 0838 Buzău - Inspectoratul de Jandarmi Judeţean Buzău', 3),
(166, 'U.M. 0435 Reşiţa - Inspectoratul de Jandarmi Judeţean Caraş Severin', 3),
(167, 'U.M. 0256 Călăraşi  - Inspectoratul de Jandarmi Judeţean Călăraşi', 3),
(168, 'U.M. 0701 Cluj-Napoca - Inspectoratul de Jandarmi Judeţean Cluj-Napoca', 3),
(169, 'U.M. 0406 Constanţa  - Inspectoratul de Jandarmi Judeţean Constanţa ', 3),
(170, 'U.M. 0495 Cernavodă  - Unitatea Specială 72 Jandarmi Protecţie Instituţională', 3),
(171, 'U.M. 0866 Sfântu Gheorghe - Inspectoratul de Jandarmi Judeţean Covasna', 3),
(172, 'U.M. 0705 Târgovişte - Inspectoratul de Jandarmi Judeţean Dâmboviţa', 3),
(173, 'U.M. 0654 Craiova - Inspectoratul de Jandarmi Judeţean Dolj', 3),
(174, 'U.M. 0527 Galati - Inspectoratul de Jandarmi Judeţean Galaţi', 3),
(175, 'U.M. 0329 Giurgiu - Inspectoratul de Jandarmi Judeţean Giurgiu', 3),
(176, 'U.M. 0658 Târgu Jiu - Inspectoratul de Jandarmi Judeţean Gorj', 3),
(177, 'U.M. 0586 Miercurea Ciuc  - Inspectoratul de Jandarmi Judeţean Harghita', 3),
(178, 'U.M. 0451 Deva - Inspectoratul de Jandarmi Judeţean Hunedoara', 3),
(179, 'U.M. 0412 Slobozia  - Inspectoratul de Jandarmi Judeţean Ialomiţa', 3),
(180, 'U.M. 0908 Iaşi - Inspectoratul de Jandarmi Judeţean Iaşi ', 3),
(181, 'U.M. 0596 Bucureşti - Inspectoratul de Jandarmi Judeţean Ilfov', 3),
(182, 'U.M. 0716 Baia Mare - Inspectoratul de Jandarmi Judeţean Maramureş', 3),
(183, 'U.M. 0524 Dr.Tr.Severin - Inspectoratul de Jandarmi Judeţean Mehedinţi', 3),
(184, 'U.M. 0526 Târgu Mureş  - Inspectoratul de Jandarmi Judeţean Mureş', 3),
(185, 'U.M. 0944 Piatra Neamţ  - Inspecoratul de Jandarmi Judeţean Neamţ', 3),
(186, 'U.M. 0746 Slatina - Inspectoratul de Jandarmi Judeţean Olt ', 3),
(187, 'U.M. 0756 Ploieşti - Inspectoratul de Jandarmi Judeţean Prahova', 3),
(188, 'U.M. 0326 Zalău - Inspectoratul de Jandarmi Judeţean Sălaj', 3),
(189, 'U.M. 0395 Satu Mare - Inspectoratul de Jandarmi Judeţean Satu Mare', 3),
(190, 'U.M. 0815 Sibiu - Inspectoratul de Jandarmi Judeţean Sibiu', 3),
(191, 'U.M. 0925 Suceava  - Inspectoratul de Jandarmi Judeţean Suceava', 3),
(192, 'U.M. 0723 Alexandria - Inspectoratul de Jandarmi Judeţean Teleorman', 3),
(193, 'U.M. 0520 Timişoara - Inspectoratul de Jandarmi Judeţean Timiş', 3),
(194, 'U.M. 0615 Tulcea  - Inspectoratul de Jandarmi Judeţean Tulcea  ', 3),
(195, 'U.M. 0960 Vaslui  - Inspectoratul de Jandarmi Judeţean Vaslui', 3),
(196, 'U.M. 0460 Râmnicu Vâlcea - Inspectoratul de Jandarmi Judeţean Vâlcea', 3),
(197, 'U.M. 0965 Focşani  - Inspectoratul de Jandarmi Judeţean Vrancea', 3),
(198, 'U.M. 0663 Drăgăşani - Şcoala Militara de Subofiţeri Jandarmi Gr.Al.Ghica Drăgăşani', 3),
(199, 'U.M. 0854 Fălticeni - Şcoala Militară de Subofiţeri  Jandarmi Fălticeni', 3),
(200, 'U.M. 0721 Gheorgheni  - Centrul de Perfectionare a Pregatirii Cadrelor Jandarmi Gheorgheni', 3),
(201, 'U.M. 0930 - Centrul de Perfecţionare a Pregatirii Cadrelor Jandarmi Ochiuri', 3),
(202, 'U.M. 0849 - Centrul de Perfecţionare a Pregătirii Cadrelor Jandarmi Montani Sinaia', 3),
(203, 'Instituţia Prefectului municipiului Bucureşti', 3),
(204, 'Instituţia Prefectului judeţului Alba', 3),
(205, 'Instituţia Prefectului judeţului Arad', 3),
(206, 'Instituţia Prefectului judeţului Argeş', 3),
(207, 'Instituţia Prefectului judeţului Bacău', 3),
(208, 'Instituţia Prefectului judeţului Bihor', 3),
(209, 'Instituţia Prefectului judeţului Bistriţa-Năsăud', 3),
(210, 'Instituţia Prefectului judeţului Botoşani', 3),
(211, 'Instituţia Prefectului judeţului Brăila', 3),
(212, 'Instituţia Prefectului judeţului Braşov', 3),
(213, 'Instituţia Prefectului judeţului Buzău', 3),
(214, 'Instituţia Prefectului judeţului Călăraşi', 3),
(215, 'Instituţia Prefectului judeţului Caraş-Severin', 3),
(216, 'Instituţia Prefectului judeţului Cluj', 3),
(217, 'Instituţia Prefectului judeţului Constanţa', 3),
(218, 'Instituţia Prefectului judeţului Covasna', 3),
(219, 'Instituţia Prefectului judeţului Dâmboviţa', 3),
(220, 'Instituţia Prefectului judeţului Dolj', 3),
(221, 'Instituţia Prefectului judeţului Galaţi', 3),
(222, 'Instituţia Prefectului judeţului Giurgiu', 3),
(223, 'Instituţia Prefectului judeţului Gorj', 3),
(224, 'Instituţia Prefectului judeţului Harghita', 3),
(225, 'Instituţia Prefectului judeţului Hunedoara', 3),
(226, 'Instituţia Prefectului judeţului Iaşi', 3),
(227, 'Instituţia Prefectului judeţului Ialomiţa', 3),
(228, 'Instituţia Prefectului judeţului Ilfov', 3),
(229, 'Instituţia Prefectului judeţului Maramureş', 3),
(230, 'Instituţia Prefectului judeţului Mehedinţi', 3),
(231, 'Instituţia Prefectului judeţului Mureş', 3),
(232, 'Instituţia Prefectului judeţului Neamţ', 3),
(233, 'Instituţia Prefectului judeţului Olt', 3),
(234, 'Instituţia Prefectului judeţului Prahova', 3),
(235, 'Instituţia Prefectului judeţului Satu-Mare', 3),
(236, 'Instituţia Prefectului judeţului Sălaj', 3),
(237, 'Instituţia Prefectului judeţului Sibiu', 3),
(238, 'Instituţia Prefectului judeţului Suceava', 3),
(239, 'Instituţia Prefectului judeţului Teleorman', 3),
(240, 'Instituţia Prefectului judeţului Timiş', 3),
(241, 'Instituţia Prefectului judeţului Tulcea', 3),
(242, 'Instituţia Prefectului judeţului Vâlcea', 3),
(243, 'Instituţia Prefectului judeţului Vaslui', 3),
(244, 'Instituţia Prefectului judeţului Vrancea', 3),
(245, 'Academia de Poliţie “Alexandru Ioan Cuza” Bucureşti', 3),
(246, 'Agenţia Naţională Antidrog ', 3),
(247, 'Agenţia Naţională Împotriva Traficului de Persoane ', 3),
(248, 'Arhivele Naţionale ', 3),
(249, 'Casa Sectorială de Pensii a M.A.I.', 3),
(250, 'Centrul de Formare Iniţială şi Continuă al MAI', 3),
(251, 'Centrul Multifuncţional de Pregătire Schengen al MAi', 3),
(253, 'Clubul Sportiv „Dinamo” Bucureşti ', 3),
(255, 'Direcţia Generală Anticorupţie', 3),
(257, 'DIRECŢIA GENERALĂ DE PROTECŢIE INTERNĂ', 3),
(258, 'Direcţia Generală de Paşapoarte ', 3),
(259, 'Direcţia pentru Evidenţa Persoanelor şi Administrarea Bazelor de Date  - DEPABD', 3),
(260, 'Direcţia Regim Permise de Conducere şi Înmatriculare a Vehiculelor ', 3),
(261, 'Institutul de Studii pentru Ordine Publică ', 3),
(263, 'Spitalul Clinic de Urgenţă „Avram Iancu” Oradea', 3),
(264, 'Spitalul de Urgenţă al M.A.I. „Prof. Dr. Dimitrie Gerota”  Bucureşti', 3),
(265, 'Centrul Medical de Diagnostic şi Tratament Ambulatoriu “N. Kretzulescu” Bucureşti ', 3),
(266, 'Centrul Medical de Diagnostic şi Tratament Ambulatoriu Ploieşti', 3),
(267, 'Centrul Medical de Diagnostic şi Tratament Ambulatoriu Oradea ', 3),
(306, 'Scoala de Formare Initiala si Continua a Personalului Politiei de Frontiera Iasi', 3),
(307, 'Inspectoratul pentru Situatii de Urgenta \"Dealul Spirii\" Bucuresti-Ilfov', 3),
(308, 'U.M. 0449 Craiova - Gruparea de Jandarmi Mobilă Craiova', 3),
(311, 'U.M. 0903 Bacău - Gruparea de Jandarmi Mobilă Bacău', 3),
(312, 'U.M. 0709 Tg.Mures - Gruparea de Jandarmi Mobila Mures', 3),
(313, 'U.M. 0827 Cluj - Gruparea de jandarmi Mobila Cluj', 3),
(314, 'U.M. 0805 Timisoara - Gruparea de Jandarmi Mobila Timis', 3),
(315, 'U.M. 0608 Constanta - Gruparea de Jandarmi Mobila Constanta', 3),
(316, 'U.M. 0599 Ploiesti - Gruparea de Jandarmi Mobila Ploiesti', 3),
(317, 'U.M. 0758 Brasov - Gruparea de Jandarmi Mobila Brasov', 3),
(319, 'Școala de Perfecționare a Pregătirii Personalului Poliției de Frontieră Drobeta Turnu Severin ', 3),
(320, 'Centrul de Formare și Perfecționare a Polițiștilor \" Nicolae Golescu \" Slatina', 3),
(321, 'U.M. 0407 - Centrul Național pentru Securitate la Incendii și Protecție Civilă', 3),
(344, 'DALI', 3),
(376, 'A.N.R.S.P.S. - Serviciul Administrativ', 3),
(377, 'I.G.P.F. - Serviciul Administrativ', 3),
(381, 'I.G.I. - Serviciul Administrativ', 3),
(382, 'I.G.A.V. - Biroul Administrativ', 3),
(383, 'I.G.P.R.-Serviciul Administrativ', 3),
(384, 'Aparat Central', 3),
(5264, 'CENTRUL REGIONAL DE PROCEDURI SI CAZARE A SOLICITANTILOR DE AZIL GALATI', 3),
(5265, 'Direcția Administrare pentru Comunicații și Tehnologia Informației (DACTI)', 0),
(5266, 'Corpul de Control al Ministrului (CCM)', 2),
(5267, 'Direcția Audit Public Intern (DAPI)', 0),
(5269, 'Directia Generala pentru Comunicatii si Tehnologia Informatiei (DGCTI)', 0),
(5279, 'abc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nume` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_ord` int(11) DEFAULT NULL,
  `telefon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nume`, `id_ord`, `telefon`, `email`, `status`, `auth_key`, `password_hash`, `password_reset_token`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'Administrator', 1, '123456', 'admin@gmail.com', 10, 'ggQZlVCXi8yUZuRuuRqEMv0vvsKhkl7n', '$2y$13$OIlR2fX8LOIXNHOWK4Y5wORgJ691iFhkQLxH6ibiD8V9e/Lhflu32', NULL, 1574773673, 1574773673, 'r0NBap5qB_wwxl9FWpCnU3SeYTRruohD_1574773673'),
(2, 'lucrator', 'Lucrator', 5265, '123456', 'lucrator@gmail.com', 10, 'ENMC7iPcspYiPULAFTIzorKj8n9gVHDF', '$2y$13$obErehoX7SPcU41t2QXsW.v6MsJ7pRPYisrC8NviFj6IwtqSuLOum', NULL, 1576143473, 1576143473, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user_log` (`id_user_log`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `ordonatori`
--
ALTER TABLE `ordonatori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `id_ord` (`id_ord`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ordonatori`
--
ALTER TABLE `ordonatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5280;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user_log`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_ord`) REFERENCES `ordonatori` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
