-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 11:45 AM
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
-- Database: `ncpr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_tbl`
--

CREATE TABLE `car_tbl` (
  `id` int(11) NOT NULL,
  `car_is_approved` tinyint(1) DEFAULT 0,
  `car_num_active` tinyint(1) DEFAULT 0,
  `car_num` varchar(255) DEFAULT NULL,
  `8d_report_active` varchar(255) DEFAULT NULL,
  `scar_active` tinyint(1) DEFAULT 0,
  `scar_num` varchar(255) DEFAULT NULL,
  `DRF_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_tbl`
--

INSERT INTO `car_tbl` (`id`, `car_is_approved`, `car_num_active`, `car_num`, `8d_report_active`, `scar_active`, `scar_num`, `DRF_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, NULL, NULL, 0, NULL, 6, '2025-03-20 10:33:19', '2025-03-20 10:33:19'),
(2, 0, 0, NULL, NULL, 0, NULL, 7, '2025-03-20 10:36:12', '2025-03-20 10:36:12'),
(3, 0, 0, NULL, NULL, 0, NULL, 8, '2025-03-20 10:44:52', '2025-03-20 10:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `cnc_mat_tbl`
--

CREATE TABLE `cnc_mat_tbl` (
  `id` int(11) NOT NULL,
  `nfld_item` tinyint(1) DEFAULT 0,
  `nfld_item_pur_item` tinyint(1) DEFAULT 0,
  `FE_expired` tinyint(1) DEFAULT 0,
  `local_supp` tinyint(1) DEFAULT 0,
  `imi` tinyint(1) DEFAULT 0,
  `pff` varchar(255) DEFAULT NULL,
  `CAR_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cnc_mat_tbl`
--

INSERT INTO `cnc_mat_tbl` (`id`, `nfld_item`, `nfld_item_pur_item`, `FE_expired`, `local_supp`, `imi`, `pff`, `CAR_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 0, NULL, 2, '2025-03-20 10:36:13', '2025-03-20 10:36:13'),
(2, 0, 0, 0, 0, 0, NULL, 3, '2025-03-20 10:44:52', '2025-03-20 10:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `dispo_sitioned`
--

CREATE TABLE `dispo_sitioned` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `approved_id` int(11) NOT NULL,
  `approved_role` varchar(50) NOT NULL,
  `action_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dispo_sitioned`
--

INSERT INTO `dispo_sitioned` (`id`, `status`, `approved_id`, `approved_role`, `action_date`) VALUES
(1, 'Approve', 1, 'ENGINEER', '2025-03-20 18:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `dispo_table`
--

CREATE TABLE `dispo_table` (
  `id` int(11) NOT NULL,
  `QAVCIA` varchar(255) DEFAULT NULL,
  `man` tinyint(1) DEFAULT 0,
  `man_id_num` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `method` tinyint(1) DEFAULT 0,
  `machine` tinyint(1) DEFAULT 0,
  `CNC_mat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dispo_table`
--

INSERT INTO `dispo_table` (`id`, `QAVCIA`, `man`, `man_id_num`, `name`, `method`, `machine`, `CNC_mat_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, NULL, 0, 0, 1, '2025-03-20 10:36:13', '2025-03-20 10:36:13'),
(2, NULL, 0, NULL, NULL, 0, 0, 2, '2025-03-20 10:44:52', '2025-03-20 10:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `drf_tbl`
--

CREATE TABLE `drf_tbl` (
  `id` int(11) NOT NULL,
  `NTPI_active` tinyint(1) DEFAULT 0,
  `MRB_active` varchar(255) DEFAULT NULL,
  `NFLD_active` tinyint(1) DEFAULT 0,
  `cust_is_approve` varchar(255) DEFAULT NULL,
  `doc_alert_num` varchar(255) DEFAULT NULL,
  `prod_dispo_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drf_tbl`
--

INSERT INTO `drf_tbl` (`id`, `NTPI_active`, `MRB_active`, `NFLD_active`, `cust_is_approve`, `doc_alert_num`, `prod_dispo_id`, `created_at`, `updated_at`) VALUES
(3, 0, NULL, 0, NULL, NULL, 6, '2025-03-20 10:29:01', '2025-03-20 10:29:01'),
(4, 0, NULL, 0, NULL, NULL, 7, '2025-03-20 10:30:11', '2025-03-20 10:30:11'),
(5, 0, NULL, 0, NULL, NULL, 8, '2025-03-20 10:31:27', '2025-03-20 10:31:27'),
(6, 0, NULL, 0, NULL, NULL, 9, '2025-03-20 10:33:19', '2025-03-20 10:33:19'),
(7, 0, NULL, 0, NULL, NULL, 10, '2025-03-20 10:36:12', '2025-03-20 10:36:12'),
(8, 0, NULL, 0, NULL, NULL, 11, '2025-03-20 10:44:52', '2025-03-20 10:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `fomo`
--

CREATE TABLE `fomo` (
  `fomo_id` int(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `supplier_part_name` varchar(255) NOT NULL,
  `supplier_part_number` varchar(255) NOT NULL,
  `invoice_num` int(255) NOT NULL,
  `purchase_order` int(255) NOT NULL,
  `ncpr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fomo`
--

INSERT INTO `fomo` (`fomo_id`, `supplier`, `supplier_part_name`, `supplier_part_number`, `invoice_num`, `purchase_order`, `ncpr_id`) VALUES
(16, 'afs', 'Rane', 'fsf', 1352, 0, 101),
(17, 'AD', 'ASD', 'ASD', 0, 0, 107);

-- --------------------------------------------------------

--
-- Table structure for table `key_person`
--

CREATE TABLE `key_person` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `key_person`
--

INSERT INTO `key_person` (`id`, `fname`, `lname`) VALUES
(1, 'QA', 'Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(255) NOT NULL,
  `ntdj_num` varchar(255) NOT NULL,
  `mns_num` varchar(255) NOT NULL,
  `lot_sublot_qty` int(255) NOT NULL,
  `qty_affected` int(255) NOT NULL,
  `qty_affected_text` varchar(255) NOT NULL,
  `defect_rate` varchar(255) NOT NULL,
  `ncpr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `ntdj_num`, `mns_num`, `lot_sublot_qty`, `qty_affected`, `qty_affected_text`, `defect_rate`, `ncpr_id`) VALUES
(56, 'a', 'a', 1, 1, 'a', '100.00', 100),
(57, 'a', 'a', 14, 2, 'lala', '14.29', 101),
(58, '123', '123', 123, 23, '', '18.70', 102),
(59, '123', '123', 123, 31, '', '25.20', 103),
(60, 'asd', 'asd', 12, 2, '', '16.67', 104),
(61, 'asd', 'asd', 2, 1, '', '50.00', 105),
(62, 'ASD', 'ASD', 2, 1, '', '50.00', 106),
(63, 'Q', 'W', 2, 2, 'ASDAS', '100.00', 107);

-- --------------------------------------------------------

--
-- Table structure for table `ncpr_counter`
--

CREATE TABLE `ncpr_counter` (
  `id` int(11) NOT NULL,
  `year` char(2) NOT NULL,
  `last_number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ncpr_table`
--

CREATE TABLE `ncpr_table` (
  `id` int(255) NOT NULL,
  `initiator` varchar(255) NOT NULL,
  `ncpr_num` varchar(7) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `process` varchar(255) NOT NULL,
  `urgent` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `issue` varchar(255) NOT NULL,
  `awpi` varchar(255) NOT NULL,
  `dc` varchar(255) NOT NULL,
  `deviation` varchar(255) NOT NULL,
  `repeating` varchar(255) NOT NULL,
  `cavity` varchar(255) NOT NULL,
  `machine` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `bg` varchar(255) NOT NULL,
  `one` varchar(255) NOT NULL,
  `one_one` varchar(255) NOT NULL,
  `two` varchar(255) NOT NULL,
  `two_one` varchar(255) NOT NULL,
  `three` varchar(255) NOT NULL,
  `three_one` varchar(255) NOT NULL,
  `four` varchar(255) NOT NULL,
  `five` varchar(255) NOT NULL,
  `six` varchar(255) NOT NULL,
  `seven` varchar(255) NOT NULL,
  `seven_one` varchar(255) NOT NULL,
  `seven_two` varchar(255) NOT NULL,
  `eight` varchar(255) NOT NULL,
  `eight_one` varchar(255) NOT NULL,
  `nine` varchar(255) NOT NULL,
  `nine_one` varchar(255) NOT NULL,
  `recall` varchar(255) NOT NULL,
  `fgparts` varchar(255) NOT NULL,
  `shipment` varchar(255) NOT NULL,
  `ship_sched` varchar(255) NOT NULL,
  `wip` varchar(255) NOT NULL,
  `stop_proc` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `mcs` varchar(255) NOT NULL,
  `mcs_details` varchar(255) NOT NULL,
  `customer_notif` varchar(255) NOT NULL,
  `dispo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ncpr_table`
--

INSERT INTO `ncpr_table` (`id`, `initiator`, `ncpr_num`, `date`, `part_number`, `part_name`, `process`, `urgent`, `status`, `issue`, `awpi`, `dc`, `deviation`, `repeating`, `cavity`, `machine`, `ref`, `bg`, `one`, `one_one`, `two`, `two_one`, `three`, `three_one`, `four`, `five`, `six`, `seven`, `seven_one`, `seven_two`, `eight`, `eight_one`, `nine`, `nine_one`, `recall`, `fgparts`, `shipment`, `ship_sched`, `wip`, `stop_proc`, `location`, `mcs`, `mcs_details`, `customer_notif`, `dispo_id`) VALUES
(100, 'a', '25-0001', '2025-03-12', 'a', 'a', 'a', 'on', 'open', 'a', '1', '1', 'Yes', 'Yes', '1', 'q', '1', 'a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6),
(101, 'Cabo, Gerardo', '25-0002', '2025-03-12', '196555', 'amsdnsad', 'Area 51', 'on', 'open', 'Laro laro', 'dog', 'bakit', 'Yes', 'Yes', 'Laro dog laro dog laro dog laro dog laro dog laro dog laro dog', 'a', 'awts', 'awts123', 'yes', 'yes', 'yes', 'a', 'yes', 'a', 'yes', 'yes', 'yes', 'yes', 'a', 'a', 'yes', 'a', 'yes', 'a', 'yes', 'yes', 'yes', 'a', 'yes', 'yes', 'a', 'yes', 'a', 'yes', 6),
(102, 'MARK', '25-0003', '2025-03-17', '1234', 'amsdnsad', 'sadas', 'off', 'open', 'dasd', '', '', '', '', '', '', '21321', 'adasas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6),
(103, 'MARKI', '25-0004', '2025-03-17', '1234', 'amsdnsad', 'asdas', 'off', 'open', 'asdas', '', '', '', '', '', '', 'asd', 'adas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6),
(104, 'ASDAS', '25-0005', '2025-03-17', '1234', 'amsdnsad', 'asdas', 'off', 'open', 'asd', '', '', '', '', '', '', 'asd', 'asd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6),
(105, 'ADASD', '25-0006', '2025-03-17', '123', '1', 'sadsa', 'off', 'open', 'sadsafdsf', '', '', '', '', '', '', 'dsfd', 'dfsfd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6),
(106, 'ASDR', '25-0007', '2025-03-17', '187303-001', 'AB MIKRO', 'ASD', 'off', 'open', 'ASD', '', '', '', '', '', '', 'ASD', 'ASD', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6),
(107, 'CADO', '25-0008', '2025-03-17', '187306-001', 'AB MIKRO', '213QSA', 'on', 'open', 'ASDAS', '', '', '', '', '', '', 'ASDASD', 'SADSA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ncpr_temp_table`
--

CREATE TABLE `ncpr_temp_table` (
  `id` int(11) NOT NULL,
  `ncpr_num` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ncpr_temp_table`
--

INSERT INTO `ncpr_temp_table` (`id`, `ncpr_num`, `created_at`) VALUES
(1, '25-0019', '2025-03-12 01:53:11'),
(7, '25-0020', '2025-03-12 01:55:43'),
(8, '25-0021', '2025-03-12 01:55:56'),
(9, '25-0022', '2025-03-12 01:56:03'),
(10, '25-0001', '2025-03-12 02:01:34'),
(11, '25-0002', '2025-03-12 02:01:37'),
(12, '25-0003', '2025-03-12 02:01:38'),
(13, '25-0004', '2025-03-12 02:01:42'),
(14, '25-0005', '2025-03-12 02:02:35'),
(15, '25-0006', '2025-03-12 02:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `process_area`
--

CREATE TABLE `process_area` (
  `process_id` int(255) NOT NULL,
  `process_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `product_id` int(100) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product_id`, `part_number`, `part_name`) VALUES
(2, '187303-001', 'AB MIKRO'),
(3, '187306-001', 'AB MIKRO'),
(4, '172893-001', 'AB MIKRO 0065'),
(5, '172630-001', 'AB MIKRO 1182'),
(6, '184543-001', 'AB MIKRO 1185  new pn'),
(7, '180044-001', 'AB MIKRO 1185  rev D'),
(8, '181793-001', 'AB MIKRO 1185  rev E'),
(9, '169574-001', 'AUTOSYSTEMS LH'),
(10, '169597-001', 'AUTOSYSTEMS RH'),
(11, '176687-001', 'BI-TECH'),
(12, '178492-001', 'BI-TECH'),
(13, '184619-001', 'BI-TECH'),
(14, '186683-001', 'BMW LIGHT ENGINE'),
(15, '188008-001', 'BMW LIGHT ENGINE'),
(16, '175498-001', 'BORG INDAK'),
(17, '189340-001', 'CAMBIUM 4 X 2 ANTENNA FLEX PCB'),
(18, '186411-001', 'CAMBIUM ANTENNA PCB'),
(19, '186923-001', 'CAMBIUM ANTENNA PCB '),
(20, '183938-001', 'CAMBIUM FEED PCB'),
(21, '183948-001', 'CAMBIUM MIDDLE PATCH'),
(22, '183943-001', 'CAMBIUM TOP PATCH'),
(23, '178369-001', 'CONTI KOREA D32'),
(24, '160950-001', 'CONTINENTAL AUTO 835 M2'),
(25, '189257-001', 'CONTINENTAL AUTO M2'),
(26, '181387-001', 'CONTINENTAL AUTOMOTIVE 12 LED'),
(27, '186437-001', 'CONTINENTAL AUTOMOTIVE 12 LED'),
(28, '189255-001', 'CONTINENTAL AUTOMOTIVE 12 LED '),
(29, '187166-001', 'CONTINENTAL AUTOMOTIVE 12 LED '),
(30, '189256-001', 'CONTINENTAL AUTOMOTIVE 6'),
(31, '181383-001', 'CONTINENTAL AUTOMOTIVE 6 LED'),
(32, '186436-001', 'CONTINENTAL AUTOMOTIVE 6 LED'),
(33, '187167-001', 'CONTINENTAL AUTOMOTIVE 6 LED'),
(34, '184409-001', 'CONTINENTAL AUTOMOTIVE IC POINTER RED LED'),
(35, '184410-001', 'CONTINENTAL AUTOMOTIVE IC POINTER WHITE LED'),
(36, '170031-001', 'CONTINENTAL D4/D42'),
(37, '178377-001', 'CONTINENTAL KOREA D42'),
(38, '168885-001', 'CONTINENTAL VDO POINTER'),
(39, '182083-001', 'CREE'),
(40, '183272-001', 'CREE 0094'),
(41, '182435-001', 'CREE 1245 NEW   '),
(42, '183448-001', 'CREE LEP1281'),
(43, '183736-001', 'CREE LEP1284'),
(44, '183840-001', 'CREE LEP1288B'),
(45, '188362-001', 'CSI MEDICAL BOOMERANG'),
(46, '188959-001', 'CSI MEDICAL BOOMERANG'),
(47, '185337-001', 'DELPHI '),
(48, '175174-001', 'DELPHI 1911'),
(49, '175177-001', 'DELPHI 1912'),
(50, '175179-001', 'DELPHI 2246'),
(51, '175182-001', 'DELPHI 2698'),
(52, '184799-001', 'DELPHI 27170'),
(53, '185634-001', 'DELPHI 27170'),
(54, '184807-001', 'DELPHI 27274'),
(55, '184811-001', 'DELPHI 27275'),
(56, '176139-001', 'DELPHI 421'),
(57, '176140-001', 'DELPHI 427'),
(58, '182181-001', 'DELTA'),
(59, '186514-001', 'DELTA CONTROLS ANTENNA'),
(60, '186060-001', 'DYNAMICS'),
(61, '186946-001', 'EBW DURANGO DRL LH'),
(62, '186950-001', 'EBW DURANGO DRL RH'),
(63, '183094-001', 'EBW ELECTRONICS ECE'),
(64, '181001-001', 'EBW LH '),
(65, '185143-001', 'EBW MAGNA LH'),
(66, '185145-001', 'EBW MAGNA RH'),
(67, '181003-001', 'EBW RH '),
(68, '183468-001', 'EBW U540 ECE'),
(69, '183091-001', 'EBW U540 SAE'),
(70, '183466-001', 'EBW U540 SAE '),
(71, '169270-001', 'ELECTROLUX'),
(72, '173238-001', 'FLEXTRONICS AU LH'),
(73, '173263-001', 'FLEXTRONICS AU RH'),
(74, '189469-001', 'FLEXTRONICS SARVAR'),
(75, '184307-001', 'FLEXTRONICS BMW SPEPS'),
(76, '179709-001', 'FLEXTRONICS 30 DEG'),
(77, '188717-001', 'FLEXTRONICS 30 DEG'),
(78, '183153-001', 'FLEXTRONICS BMPV'),
(79, '183744-001', 'FLEXTRONICS BMPV'),
(80, '181481-001', 'FLEXTRONICS BMW /PSA'),
(81, '179580-001', 'FLEXTRONICS BMW /PSA'),
(82, '184671-001', 'FLEXTRONICS BMW /PSA'),
(83, '177095-001', 'FLEXTRONICS C218 CL LEFT'),
(84, '177096-001', 'FLEXTRONICS C218 CL RH'),
(85, '175608-001', 'FLEXTRONICS- C218 FL LH'),
(86, '175620-001', 'FLEXTRONICS- C218 FL RH'),
(87, '175530-001', 'FLEXTRONICS- C218110 BLL INNER'),
(88, '175540-001', 'FLEXTRONICS- C218110 BLL OUTER'),
(89, '180583-001', 'FLEXTRONICS CEPS ABS'),
(90, '184539-001', 'FLEXTRONICS CEPS ABS '),
(91, '180588-001', 'FLEXTRONICS CEPS TO'),
(92, '178703-001', 'FLEXTRONICS CHRYSLER DS'),
(93, '182594-001', 'FLEXTRONICS CHRYSLER LWR'),
(94, '184452-001', 'FLEXTRONICS D544 SENSOR LH'),
(95, '184450-001', 'FLEXTRONICS D544 SENSOR RH'),
(96, '179140-001', 'FLEXTRONICS DODGE LH'),
(97, '179872-001', 'FLEXTRONICS DODGE LH APPLIQUE'),
(98, '179123-001', 'FLEXTRONICS DODGE RH'),
(99, '179873-001', 'FLEXTRONICS DODGE RH APPLIQUE'),
(100, '186751-001', 'FLEXTRONICS ETHICON LEFT'),
(101, '186750-001', 'FLEXTRONICS ETHICON RH'),
(102, '175094-001', 'FLEXTRONICS FIAT ABS'),
(103, '176303-001', 'FLEXTRONICS FIAT ABS'),
(104, '184701-001', 'FLEXTRONICS FORD LOA'),
(105, '182740-001', 'FLEXTRONICS FORD MAPLIGHT LED'),
(106, '175671-001', 'FLEXTRONICS FORD REPS'),
(107, '180727-001', 'FLEXTRONICS FORD S550'),
(108, '182590-001', 'FLEXTRONICS FORD U375'),
(109, '182811-001', 'FLEXTRONICS FORD U375'),
(110, '180331-001', 'FLEXTRONICS K2XX'),
(111, '179570-001', 'FLEXTRONICS K2XX DO '),
(112, '184551-001', 'FLEXTRONICS K2XX DO '),
(113, '183870-001', 'FLEXTRONICS MAPLAMP LONG'),
(114, '186824-001', 'FLEXTRONICS MAPLAMP LONG'),
(115, '183867-001', 'FLEXTRONICS MAPLAMP SHORT'),
(116, '186823-001', 'FLEXTRONICS MAPLAMP SHORT'),
(117, '183381-001', 'FLEXTRONICS MAPLIGHT SENSOR LH'),
(118, '183386-001', 'FLEXTRONICS MAPLIGHT SENSOR RH'),
(119, '175904-001', 'FLEXTRONICS MML W221 Left '),
(120, '175841-001', 'FLEXTRONICS MML W221 LH'),
(121, '175842-001', 'FLEXTRONICS MML W221 RH'),
(122, '175905-001', 'FLEXTRONICS MML W221 RH'),
(123, '178424-001', 'FLEXTRONICS PASSAT'),
(124, '180250-001', 'FLEXTRONICS PASSAT'),
(125, '184836-001', 'FLEXTRONICS PASSAT'),
(126, '181637-001', 'FLEXTRONICS PEUGEOT ABS'),
(127, '181638-001', 'FLEXTRONICS PEUGEOT TRQ'),
(128, '176299-001', 'FLEXTRONICS PEUGEOT TRQ2'),
(129, '185412-001', 'FLEXTRONICS PSA A88'),
(130, '186373-001', 'FLEXTRONICS PSA A88'),
(131, '186374-001', 'FLEXTRONICS PSA BMPV'),
(132, '181110-001', 'FLEXTRONICS R8 BLL/ TFL LH'),
(133, '179935-001', 'FLEXTRONICS R8 BLL/ TFL LH'),
(134, '179926-001', 'FLEXTRONICS R8 BLL/ TFL RH'),
(135, '181109-001', 'FLEXTRONICS R8 BLL/ TFL RH'),
(136, '179693-001', 'FLEXTRONICS R8 CL'),
(137, '179641-001', 'FLEXTRONICS R8 FL LH'),
(138, '179642-001', 'FLEXTRONICS R8 FL RH'),
(139, '179653-001', 'FLEXTRONICS R8 GL LH'),
(140, '179661-001', 'FLEXTRONICS R8 GL RH'),
(141, '179686-001', 'FLEXTRONICS R8 SPOT LH'),
(142, '179671-001', 'FLEXTRONICS R8 SPOT RH'),
(143, '186440-001', 'FLEXTRONICS TIMI; BMW SPEPS'),
(144, '183350-001', 'FLEXTRONICS VENTRA U502 REAR FOG'),
(145, '184602-001', 'FLEXTRONICS WZ; BMW SPEPS'),
(146, '181337-001', 'FLEXTRONICS CHRYSLER LWR'),
(147, '180493-001', 'FLEXTRONICS GM A1LL AUX LH'),
(148, '180494-001', 'FLEXTRONICS GM A1LL AUX RH'),
(149, '180491-001', 'FLEXTRONICS GM A1LL HL LH'),
(150, '180492-001', 'FLEXTRONICSGM A1LL HL RH'),
(151, '186392-001', 'FLEXTRONICS-WZ; BMW SPEPS'),
(152, '186720-001', 'FOCUS PLUS'),
(153, '186427-001', 'GEORGE SCHMITT & CO; HONEYWELL RFID'),
(154, '182336-001', 'HAITEC TO '),
(155, '176558-001', 'HARMAN BECKER SIRIUS REFRESH'),
(156, '169521-001', 'HB HDD JUMPER'),
(157, '178462-001', 'HELLA AUDI A3 INTERIOR'),
(158, '184990-001', 'HELLA AUDI A3 INTERIOR'),
(159, '180743-001', 'HELLA INSIGNIA LEFT'),
(160, '180742-001', 'HELLA INSIGNIA RIGHT'),
(161, '180490-001', 'IEE'),
(162, '168316-001', 'IEE'),
(163, '176872-001', 'INVENSYS 188 '),
(164, '176872-002', 'INVENSYS 189'),
(165, '176873-001', 'INVENSYS 190'),
(166, '176873-002', 'INVENSYS 191'),
(167, '176954-001', 'INVENSYS 192'),
(168, '176954-002', 'INVENSYS 193'),
(169, '176989-001', 'INVENSYS 194'),
(170, '176989-002', 'INVENSYS 195'),
(171, '184673-001', 'JABIL OSRAM LEFT'),
(172, '184675-001', 'JABIL OSRAM RIGHT'),
(173, '187058-001', 'JABIL OSRAM P552 LH'),
(174, '187059-001', 'JABIL OSRAM P552 LHS HB A'),
(175, '187062-001', 'JABIL OSRAM P552 LHS HB B'),
(176, '187065-001', 'JABIL OSRAM P552 LHS LH A'),
(177, '187068-001', 'JABIL OSRAM P552 LHS LH B'),
(178, '187098-001', 'JABIL OSRAM P552 RH'),
(179, '187099-001', 'JABIL OSRAM P552 RH HB A'),
(180, '187102-001', 'JABIL OSRAM P552 RH HB B'),
(181, '187105-001', 'JABIL OSRAM P552 RH LB A'),
(182, '187108-001', 'JABIL OSRAM P552 RH LB B'),
(183, '178212-001', 'JOHN-ELEC LH SHARAN '),
(184, '178216-001', 'JOHN-ELEC LH SHARAN '),
(185, '178230-001', 'JOHN-ELEC LH SHARAN '),
(186, '178234-001', 'JOHN-ELEC LH SHARAN '),
(187, '178236-001', 'JOHN-ELEC RH SHARAN'),
(188, '178210-001', 'JOHN-ELEC RH SHARAN '),
(189, '178214-001', 'JOHN-ELEC RH SHARAN '),
(190, '178228-001', 'JOHN-ELEC RH SHARAN '),
(191, '178232-001', 'JOHN-ELEC RH SHARAN '),
(192, '189110-001', 'KATECHO'),
(193, '189555-001', 'KATECHO BIOSENSOR'),
(194, '189266-001', 'KATECHO TWITCHVIEW'),
(195, '187254-001', 'KIMBALL 9BUX'),
(196, '188152-001', 'KIMBALL 9BUX '),
(197, '184605-001', 'KIMBALL 9BXX'),
(198, '182654-001', 'KIMBALL CI XX'),
(199, '184060-001', 'KIMBALL CI XX'),
(200, '184592-001', 'KIMBALL CI XX'),
(201, '181062-001', 'KUESTER BMW'),
(202, '181061-001', 'KUESTER FORD'),
(203, '181060-001', 'KUESTER RENAULT'),
(204, '173767-001', 'MASERATI'),
(205, '188138-001', 'MEDICOMP'),
(206, '188997-001', 'MEDICOMP DOUBLE'),
(207, '184795-001', 'MERIT 26982'),
(208, '184803-001', 'MERIT 27157'),
(209, '186031-001', 'MERIT 27274'),
(210, '186479-001', 'MERIT 27274'),
(211, '188024-001', 'METHODE MAPLIGHT'),
(212, '182045-001', 'MFLEX'),
(213, '162937-001', 'MID-SOUTH'),
(214, '182771-001', 'MIDTRONIC'),
(215, '185191-001', 'MIDTRONIC'),
(216, '181565-001', 'MOLEX GASKET'),
(217, '187152-001', 'MOLEX CEILING LIGHT'),
(218, '183126-001', 'MULU'),
(219, '185669-001', 'MULU'),
(220, '186835-001', 'MULU'),
(221, '180176-001', 'NEXTEER 9724'),
(222, '177547-001', 'NEXTEER JUMPER  867'),
(223, '176685-001', 'NEXTEER JUMPER 209'),
(224, '177545-001', 'NEXTEER JUMPER 862'),
(225, '188632-001', 'NINGBO YIBIN MAPLIGHT'),
(226, '186123-001', 'NYXOAH'),
(227, '183550-001', 'PREH 023'),
(228, '186208-001', 'PREH 029'),
(229, '188498-001', 'PREH 029'),
(230, '186209-001', 'PREH 030'),
(231, '188503-001', 'PREH 030'),
(232, '186210-001', 'PREH 031'),
(233, '188508-001', 'PREH 031'),
(234, '186211-001', 'PREH 032'),
(235, '188513-001', 'PREH 032'),
(236, '188784-001', 'PREH 033'),
(237, '188806-001', 'PREH 034'),
(238, '186212-001', 'PREH 037'),
(239, '188518-001', 'PREH 037'),
(240, '186213-001', 'PREH 038'),
(241, '188523-001', 'PREH 038'),
(242, '184924-001', 'PREH 041'),
(243, '185660-001', 'PREH 042'),
(244, '187596-001', 'PREH 042'),
(245, '185658-001', 'PREH 043'),
(246, '187599-001', 'PREH 043'),
(247, '188159-001', 'PREH 043'),
(248, '185659-001', 'PREH 044'),
(249, '187601-001', 'PREH 044'),
(250, '185893-001', 'PREH 045'),
(251, '187602-001', 'PREH 045'),
(252, '185661-001', 'PREH 053'),
(253, '187603-001', 'PREH 053'),
(254, '186214-001', 'PREH 055'),
(255, '188528-001', 'PREH 055'),
(256, '186215-001', 'PREH 056'),
(257, '188533-001', 'PREH 056'),
(258, '187637-001 ', 'PREH 061'),
(259, '187570-001', 'PREH 067'),
(260, '188852-001', 'PREH 067'),
(261, '187571-001', 'PREH 068'),
(262, '188853-001', 'PREH 068'),
(263, '186344-001', 'PREH 069'),
(264, '187576-001', 'PREH 069'),
(265, '188858-001', 'PREH 069'),
(266, '186345-001', 'PREH 070'),
(267, '187577-001', 'PREH 070'),
(268, '188859-001', 'PREH 070'),
(269, '187572-001', 'PREH 071'),
(270, '188854-001', 'PREH 071'),
(271, '187573-001', 'PREH 072'),
(272, '188855-001', 'PREH 072'),
(273, '187574-001', 'PREH 073'),
(274, '188856-001', 'PREH 073'),
(275, '187575-001', 'PREH 074'),
(276, '188857-001', 'PREH 074'),
(277, '186346-001', 'PREH 075'),
(278, '187578-001', 'PREH 075'),
(279, '188860-001', 'PREH 075'),
(280, '186347-001', 'PREH 076'),
(281, '187579-001', 'PREH 076'),
(282, '188861-001', 'PREH 076'),
(283, '186348-001', 'PREH 077'),
(284, '187580-001', 'PREH 077'),
(285, '188862-001', 'PREH 077'),
(286, '186349-001', 'PREH 078'),
(287, '187581-001', 'PREH 078'),
(288, '188863-001', 'PREH 078'),
(289, '187466-001', 'PREH 087'),
(290, '188063-001', 'PREH 087'),
(291, '188313-001', 'PREH 090'),
(292, '186605-001', 'PREH 090'),
(293, '186606-001', 'PREH 091'),
(294, '188314-001', 'PREH 091'),
(295, '186607-001', 'PREH 092'),
(296, '188315-001', 'PREH 092'),
(297, '186608-001', 'PREH 093'),
(298, '188316-001', 'PREH 093'),
(299, '186365-001', 'PREH 095'),
(300, '187998-001', 'PREH 114'),
(301, '187999-001', 'PREH 115'),
(302, '188000-001', 'PREH 116'),
(303, '188001-001', 'PREH 117'),
(304, '188744-001', 'PREH 170'),
(305, '188472-001', 'PREH 114'),
(306, '188476-001', 'PREH 115'),
(307, '188480-001', 'PREH 116'),
(308, '188484-001', 'PREH 117'),
(309, '181712-001', 'SCRIPTEL'),
(310, '183122-001', 'SULU'),
(311, '186850-001', 'SULU'),
(312, '186421-001', 'TAKATA 2534592-AA0 SENSOR CIRCUIT'),
(313, '186426-001', 'TAKATA 2534594-AA0 SHIELD CIRCUIT'),
(314, '182864-001', 'TAKATA 8499 SILVER CARBON'),
(315, '182868-001', 'TAKATA 8501 SILVER CARBON'),
(316, '182464-001', 'TAKATA AB MAZDA J71/J53 SENSOR'),
(317, '182465-001', 'TAKATA AB MAZDA J71/J53 SHIELD'),
(318, '179779-001', 'TAKATA C3 ALPHA SENSOR'),
(319, '184095-001', 'TAKATA CS3 A1LL SENSOR (CARBON)'),
(320, '184097-001', 'TAKATA CS3 A1LL SHIELD (CARBON)'),
(321, '184091-001', 'TAKATA CS3 A1SL/BL SENSOR (CARBON)'),
(322, '184093-001', 'TAKATA CS3 A1SL/BL SHIELD (CARBON)'),
(323, '179781-001', 'TAKATA CS3 ALPHA UNHEAT SHIELD'),
(324, '180307-001', 'TAKATA GM AILL HEATED'),
(325, '180306-001', 'TAKATA GM AILL SENSOR'),
(326, '180708-001', 'TAKATA GM -D1BLI HEATED'),
(327, '180709-001', 'TAKATA GM -D1BLI SENSOR'),
(328, '181354-001', 'TAKATA GM-ALPHA V-SERIES SENSOR '),
(329, '181358-001', 'TAKATA GM-ALPHA V-SERIES SHIELD'),
(330, '182437-001', 'TAKATA GM-D2 JCI SENSOR'),
(331, '182436-001', 'TAKATA GM-D2 JCI SHIELD'),
(332, '184055-001', 'TAKATA MAZDA AA; J12F SENSOR'),
(333, '184059-001', 'TAKATA MAZDA AA; J12F SHIELD'),
(334, '182390-001', 'TAKATA MAZDA J03 SENSOR'),
(335, '182391-001', 'TAKATA MAZDA J03 SHIELD'),
(336, '182462-001', 'TAKATA MAZDA J12A SENSOR'),
(337, '182463-001', 'TAKATA MAZDA J12A SHIELD'),
(338, '187333-001', 'TAKATA MAZDA J72 SENSOR'),
(339, '187335-001', 'TAKATA MAZDA J72 SHIELD'),
(340, '187163-001', 'TAKATA MAZDA J78 SENSOR'),
(341, '187164-001', 'TAKATA MAZDA J78 SHIELD'),
(342, '183755-001', 'TAKATA MAZDA J78A SENSOR'),
(343, '183759-001', 'TAKATA MAZDA J78A SHIELD'),
(344, '168403-001', 'TEMIC VS1'),
(345, '168419-001', 'TEMIC VS2'),
(346, '169500-001', 'TRW 500'),
(347, '183546-001', 'TRW 5110'),
(348, '183545-001', 'TRW 545'),
(349, '170559-001', 'TRW 559'),
(350, '170561-001', 'TRW 561'),
(351, '179719-001', 'TRW 6210'),
(352, '184498-001', 'TRW 7210'),
(353, '188100-001', 'TT ELECTRONICS'),
(354, '181512-001', 'TYCO'),
(355, '171312-001', 'TYCO 1312'),
(356, '174413-001', 'TYCO 4413'),
(357, '188851-502', 'UNI'),
(358, '148598-502', 'UNI BLUE'),
(359, '171052-503', 'UNI BLUE'),
(360, '174631-502', 'UNI BLUE'),
(361, '174631-503', 'UNI BLUE'),
(362, '174631-504', 'UNI BLUE'),
(363, '174631-505', 'UNI BLUE'),
(364, '174631-507', 'UNI BLUE'),
(365, '174631-522', 'UNI BLUE'),
(366, '174631-600', 'UNI BLUE'),
(367, '174632-502', 'UNI BLUE'),
(368, '174632-503', 'UNI BLUE'),
(369, '174632-504', 'UNI BLUE'),
(370, '174632-522', 'UNI BLUE'),
(371, '175129-502', 'UNI BLUE'),
(372, '175129-503', 'UNI BLUE'),
(373, '175129-504', 'UNI BLUE'),
(374, '175129-505', 'UNI BLUE'),
(375, '175129-507', 'UNI BLUE'),
(376, '175129-508', 'UNI BLUE'),
(377, '175129-509', 'UNI BLUE'),
(378, '175129-522', 'UNI BLUE'),
(379, '175217-503', 'UNI BLUE'),
(380, '175217-504', 'UNI BLUE'),
(381, '175217-505', 'UNI BLUE'),
(382, '175902-502', 'UNI BLUE'),
(383, '175902-503', 'UNI BLUE'),
(384, '175902-505', 'UNI BLUE'),
(385, '177882-502', 'UNI BLUE'),
(386, '177882-503', 'UNI BLUE'),
(387, '177882-504', 'UNI BLUE'),
(388, '177885-503', 'UNI BLUE'),
(389, '177887-502', 'UNI BLUE'),
(390, '177887-503', 'UNI BLUE'),
(391, '177887-506', 'UNI BLUE'),
(392, '177961-502', 'UNI BLUE'),
(393, '178077-502', 'UNI BLUE'),
(394, '178077-503', 'UNI BLUE'),
(395, '178077-504', 'UNI BLUE'),
(396, '178077-505', 'UNI BLUE'),
(397, '178077-506', 'UNI BLUE'),
(398, '178273-502', 'UNI BLUE'),
(399, '178273-503', 'UNI BLUE'),
(400, '178273-504', 'UNI BLUE'),
(401, '178288-502', 'UNI BLUE'),
(402, '178571-502', 'UNI BLUE'),
(403, '178571-504', 'UNI BLUE'),
(404, '188447-502', 'UNI BLUE'),
(405, '188447-503', 'UNI BLUE'),
(406, '188447-504', 'UNI BLUE'),
(407, '188447-505', 'UNI BLUE'),
(408, '188447-522', 'UNI BLUE'),
(409, '188564-502', 'UNI BLUE'),
(410, '188573-502', 'UNI BLUE'),
(411, '188573-504', 'UNI BLUE'),
(412, '188600-503', 'UNI BLUE'),
(413, '188601-503', 'UNI BLUE'),
(414, '188564-503', 'UNI BLUE'),
(415, '188573-503', 'UNI BLUE'),
(416, '188573-505', 'UNI BLUE'),
(417, '188573-507', 'UNI BLUE'),
(418, '188573-508', 'UNI BLUE'),
(419, '188573-509', 'UNI BLUE'),
(420, '188575-505', 'UNI BLUE'),
(421, '188576-502', 'UNI BLUE'),
(422, '188577-502', 'UNI BLUE'),
(423, '188613-502', 'UNI BLUE'),
(424, '188629-502', 'UNI BLUE'),
(425, '188564-522', 'UNI BLUE'),
(426, '188576-503', 'UNI BLUE'),
(427, '188575-503', 'UNI BLUE'),
(428, '188573-522', 'UNI BLUE'),
(429, '188601-502', 'UNI BLUE'),
(430, '188601-504', 'UNI BLUE'),
(431, '188769-503', 'UNI BLUE'),
(432, '188769-508', 'UNI BLUE'),
(433, '188894-502 ', 'UNI BLUE'),
(434, '188970-502', 'UNI BLUE'),
(435, '188577-503', 'UNI BLUE'),
(436, '188600-502', 'UNI BLUE'),
(437, '188613-504', 'UNI BLUE'),
(438, '188573-512', 'UNI BLUE'),
(439, '148569-508', 'UNI BLUE'),
(440, '175902-506', 'UNI BLUE'),
(441, '175129-512', 'UNI BLUE'),
(442, '174172-507', 'UNI BLUE'),
(443, '162936-502', 'UNI FABRE'),
(444, '162936-503', 'UNI FABRE'),
(445, '162936-505', 'UNI FABRE'),
(446, '162936-506', 'UNI FABRE'),
(447, '162936-507', 'UNI FABRE'),
(448, '162936-522', 'UNI FABRE'),
(449, '162936-550', 'UNI FABRE'),
(450, '163034-502', 'UNI FABRE'),
(451, '163034-508', 'UNI FABRE'),
(452, '163075-502', 'UNI FABRE'),
(453, '163075-503', 'UNI FABRE'),
(454, '163075-504', 'UNI FABRE'),
(455, '163087-502', 'UNI FABRE'),
(456, '163087-503', 'UNI FABRE'),
(457, '163087-506', 'UNI FABRE'),
(458, '163091-502', 'UNI FABRE'),
(459, '163091-503', 'UNI FABRE'),
(460, '163091-506', 'UNI FABRE'),
(461, '165921-502', 'UNI FABRE'),
(462, '165921-503', 'UNI FABRE'),
(463, '169958-502', 'UNI FABRE'),
(464, '169958-504', 'UNI FABRE'),
(465, '170430-502', 'UNI FABRE'),
(466, '170430-503', 'UNI FABRE'),
(467, '186157-502', 'UNI FABRE'),
(468, '163034-505', 'UNI FABRE'),
(469, '163075-507', 'UNI FABRE'),
(470, '163075-522', 'UNI FABRE'),
(471, '165921-504', 'UNI FABRE'),
(472, '183311-504', 'UNI FABRE'),
(473, '158549-502', 'UNI GOLD'),
(474, '158551-502', 'UNI GOLD'),
(475, '159485-501', 'UNI GOLD'),
(476, '170172-502', 'UNI GOLD'),
(477, '179395-504', 'UNI GOLD'),
(478, '180850-502', 'UNI GOLD'),
(479, '174633-502', 'UNI GREEN'),
(480, '174633-503', 'UNI GREEN'),
(481, '175868-502', 'UNI GREEN'),
(482, '175868-503', 'UNI GREEN'),
(483, '175868-504', 'UNI GREEN'),
(484, '177888-502', 'UNI GREEN'),
(485, '177888-503', 'UNI GREEN'),
(486, '177888-504', 'UNI GREEN'),
(487, '177888-505', 'UNI GREEN'),
(488, '177888-506', 'UNI GREEN'),
(489, '178003-502', 'UNI GREEN'),
(490, '178003-503', 'UNI GREEN'),
(491, '178065-502', 'UNI GREEN'),
(492, '178156-502', 'UNI GREEN'),
(493, '178420-502', 'UNI GREEN'),
(494, '178420-503', 'UNI GREEN'),
(495, '178420-504', 'UNI GREEN'),
(496, '178576-502', 'UNI GREEN'),
(497, '178576-504', 'UNI GREEN'),
(498, '178621-502', 'UNI GREEN'),
(499, '178621-504', 'UNI GREEN'),
(500, '180824-501', 'UNI GREEN'),
(501, '177888-507', 'UNI GREEN'),
(502, '178003-522', 'UNI GREEN'),
(503, '177888-522', 'UNI GREEN'),
(504, '149282-501', 'UNI ORANGE'),
(505, '149283-502', 'UNI ORANGE'),
(506, '179587-501', 'UNI ORANGE'),
(507, '179587-502', 'UNI ORANGE'),
(508, '187553-502', 'UNI ORANGE'),
(509, '177716-502', 'UNI PEARL'),
(510, '177716-503', 'UNI PEARL'),
(511, '177716-505', 'UNI PEARL'),
(512, '177716-522', 'UNI PEARL'),
(513, '177838-502', 'UNI PEARL'),
(514, '177838-504', 'UNI PEARL'),
(515, '177840-502', 'UNI PEARL'),
(516, '177840-505', 'UNI PEARL'),
(517, '177840-508', 'UNI PEARL'),
(518, '178129-502', 'UNI PEARL'),
(519, '179896-502', 'UNI PEARL'),
(520, '179896-503', 'UNI PEARL'),
(521, '186196-504', 'UNI PEARL'),
(522, '189381-502', 'UNI PEARL'),
(523, '189381-505', 'UNI PEARL'),
(524, '189382-502', 'UNI PEARL'),
(525, '189383-502', 'UNI PEARL'),
(526, '189380-502', 'UNI PEARL'),
(527, '189382-506', 'UNI PEARL'),
(528, '189382-506', 'UNI PEARL'),
(529, '189383-503', 'UNI PEARL'),
(530, '189384-502', 'UNI PEARL'),
(531, '189384-503', 'UNI PEARL'),
(532, '189383-505', 'UNI PEARL'),
(533, '148564-501', 'UNI PINK'),
(534, '148565-501', 'UNI PINK'),
(535, '148566-501', 'UNI PINK'),
(536, '148566-502', 'UNI PINK'),
(537, '148566-509', 'UNI PINK'),
(538, '148566-511', 'UNI PINK'),
(539, '148566-521', 'UNI PINK'),
(540, '148566-525', 'UNI PINK'),
(541, '148567-501', 'UNI PINK'),
(542, '148567-504', 'UNI PINK'),
(543, '148567-506', 'UNI PINK'),
(544, '148567-507', 'UNI PINK'),
(545, '148568-503', 'UNI PINK'),
(546, '148569-502', 'UNI PINK'),
(547, '148569-506', 'UNI PINK'),
(548, '148570-501', 'UNI PINK'),
(549, '148570-511', 'UNI PINK'),
(550, '148571-506', 'UNI PINK'),
(551, '148572-501', 'UNI PINK'),
(552, '148572-502', 'UNI PINK'),
(553, '148572-504', 'UNI PINK'),
(554, '148572-506', 'UNI PINK'),
(555, '148572-507', 'UNI PINK'),
(556, '148572-508', 'UNI PINK'),
(557, '148572-509', 'UNI PINK'),
(558, '148572-522', 'UNI PINK'),
(559, '148572-600', 'UNI PINK'),
(560, '148573-501', 'UNI PINK'),
(561, '148573-507', 'UNI PINK'),
(562, '148573-508', 'UNI PINK'),
(563, '148575-503', 'UNI PINK'),
(564, '148575-504', 'UNI PINK'),
(565, '148575-505', 'UNI PINK'),
(566, '148575-506', 'UNI PINK'),
(567, '148575-507', 'UNI PINK'),
(568, '148575-508', 'UNI PINK'),
(569, '148575-510', 'UNI PINK'),
(570, '148575-528', 'UNI PINK'),
(571, '148576-501', 'UNI PINK'),
(572, '148576-504', 'UNI PINK'),
(573, '148576-513', 'UNI PINK'),
(574, '148577-503', 'UNI PINK'),
(575, '184824-502', 'UNI PINK'),
(576, '184824-503', 'UNI PINK'),
(577, '148575-509 ', 'UNI PINK'),
(578, '148566-501', 'UNI PINK'),
(579, '148570-505', 'UNI PINK'),
(580, '148567-504', 'UNI PINK'),
(581, '174172-502', 'UNI RUBY'),
(582, '174172-503', 'UNI RUBY'),
(583, '174172-504', 'UNI RUBY'),
(584, '174172-505', 'UNI RUBY'),
(585, '174172-506', 'UNI RUBY'),
(586, '174172-600', 'UNI RUBY'),
(587, '176546-502', 'UNI RUBY'),
(588, '176546-504', 'UNI RUBY'),
(589, '176836-502', 'UNI RUBY'),
(590, '176836-504', 'UNI RUBY'),
(591, '179891-502', 'UNI RUBY'),
(592, '179891-503', 'UNI RUBY'),
(593, '179893-502', 'UNI RUBY'),
(594, '184573-502', 'UNI RUBY'),
(595, '186197-504', 'UNI RUBY'),
(596, '179893-506', 'UNI RUBY'),
(597, '179893-506', 'UNI RUBY'),
(598, '180460-502', 'UNI SAPPHIRE'),
(599, '182879-502', 'UNI SAPPHIRE'),
(600, '183359-502', 'UNI SAPPHIRE'),
(601, '183359-504', 'UNI SAPPHIRE'),
(602, '184918-502', 'UNI SAPPHIRE'),
(603, '148575-501', 'UNI WHITE'),
(604, '148579-501', 'UNI WHITE'),
(605, '148580-501', 'UNI WHITE'),
(606, '148580-502', 'UNI WHITE'),
(607, '148581-501', 'UNI WHITE'),
(608, '148581-503', 'UNI WHITE'),
(609, '148581-508', 'UNI WHITE'),
(610, '148581-550', 'UNI WHITE'),
(611, '148582-501', 'UNI WHITE'),
(612, '148582-502', 'UNI WHITE'),
(613, '148582-507', 'UNI WHITE'),
(614, '148582-513', 'UNI WHITE'),
(615, '148584-501', 'UNI WHITE'),
(616, '148584-507', 'UNI WHITE'),
(617, '148585-501', 'UNI WHITE'),
(618, '148585-502', 'UNI WHITE'),
(619, '148587-501', 'UNI WHITE'),
(620, '148587-502', 'UNI WHITE'),
(621, '148587-509', 'UNI WHITE'),
(622, '148587-510', 'UNI WHITE'),
(623, '148587-511', 'UNI WHITE'),
(624, '148587-600', 'UNI WHITE'),
(625, '148588-501', 'UNI WHITE'),
(626, '148588-502', 'UNI WHITE'),
(627, '148588-504', 'UNI WHITE'),
(628, '148588-506', 'UNI WHITE'),
(629, '148588-507', 'UNI WHITE'),
(630, '148588-511', 'UNI WHITE'),
(631, '148590-502', 'UNI WHITE'),
(632, '148590-504', 'UNI WHITE'),
(633, '148590-506', 'UNI WHITE'),
(634, '148590-507', 'UNI WHITE'),
(635, '148590-508', 'UNI WHITE'),
(636, '148590-509', 'UNI WHITE'),
(637, '148590-511', 'UNI WHITE'),
(638, '148590-526', 'UNI WHITE'),
(639, '148591-501', 'UNI WHITE'),
(640, '148591-502', 'UNI WHITE'),
(641, '148591-509', 'UNI WHITE'),
(642, '148592-501', 'UNI WHITE'),
(643, '148592-502', 'UNI WHITE'),
(644, '148592-507', 'UNI WHITE'),
(645, '148592-522', 'UNI WHITE'),
(646, '162806-502', 'UNI WHITE'),
(647, '174172-522', 'UNI WHITE'),
(648, '184825-502', 'UNI WHITE'),
(649, '184825-504', 'UNI WHITE'),
(650, '148587-512', 'UNI WHITE'),
(651, '148580-507', 'UNI WHITE'),
(652, '148675-501', 'UNI YELLOW'),
(653, '148676-501', 'UNI YELLOW'),
(654, '148678-501', 'UNI YELLOW'),
(655, '148678-503', 'UNI YELLOW'),
(656, '148679-501', 'UNI YELLOW'),
(657, '148681-501', 'UNI YELLOW'),
(658, '148682-501', 'UNI YELLOW'),
(659, '148682-505', 'UNI YELLOW'),
(660, '148682-507', 'UNI YELLOW'),
(661, '148682-528', 'UNI YELLOW'),
(662, '184843-502', 'UNI YELLOW'),
(663, '181405-001', 'VALEO '),
(664, '181578-001', 'VALEO Y120 '),
(665, '187197-001', 'VALEO Y150'),
(666, '171000-001', 'VDO 8-SHAPE ORANGE'),
(667, '186769-001', 'VISTEON  PSA D3 TELLTALE'),
(668, '183304-001', 'VISTEON CD4 '),
(669, '182191-001', 'VISTEON COIL'),
(670, '185011-001', 'VISTEON COIL'),
(671, '189214-001', 'VISTEON OPEL P2Q'),
(672, '188104-001', 'VISTEON P2Q LEFT'),
(673, '189444-001', 'VISTEON P2Q LH'),
(674, '189445-001', 'VISTEON P2Q RH'),
(675, '188105-001', 'VISTEON P2Q RIGHT'),
(676, '188045-001', 'VISTEON PSA D3 TELLTALE'),
(677, '188698-001', 'VISTEON PSA D3 TELLTALE'),
(678, '189132-001', 'VISTEON PSA D3 TELLTALE'),
(679, '189619-001', 'VISTEON PSA D3 TELLTALE'),
(680, '177168-001', 'WITTE MANUAL LIFT'),
(681, '177175-001', 'WITTE POWER LIFT '),
(682, '167470-001', 'XEROX  MID WALL EMI CABLE'),
(683, '181420-001', 'XEROX  MID WALL EMI CABLE'),
(684, '178888-001', 'YURA 8 SPEED SBW'),
(685, '184999-001', 'YURA ELTEC -LARGE'),
(686, '185001-001', 'YURA ELTEC -MEDIUM'),
(687, '182839-001', 'YURA ELTEC SBC'),
(688, '188301-001', 'YURA ELTEC 8 SPEED M3 SBC'),
(689, '188289-001', 'YURA ELTEC 8 SPEED M3 SBW'),
(690, '183376-001', 'YURA GEN 2 P-SOL'),
(691, '182059-001', 'YURA NON SBW 8 SPEED'),
(692, '182553-001', 'YURA SBW ELTEC'),
(693, '186528-001', 'ZOLLNER AUDI Q5 LH'),
(694, '186529-001', 'ZOLLNER AUDI Q5 RH'),
(695, '175703-001', 'ZOLLNER AUDI Q5 LH'),
(696, '175704-001', 'ZOLLNER AUDI Q5 RH'),
(697, '184036-001', 'ZOLLNER AUDI R8 ABL LH'),
(698, '181910-001', 'ZOLLNER AUDI R8 ABL RH'),
(699, '186681-001', 'ZOLLNER AUDI R8 ABL RH'),
(700, '184075-001', 'ZOLLNER AUDI R8 BL '),
(701, '186680-001', 'ZOLLNER AUDI R8 DRL RH'),
(702, '186678-001', 'ZOLLNER AUDI R8 FL LEFT'),
(703, '186679-001', 'ZOLLNER AUDI R8 FL RH'),
(704, '171677-001', 'ZOLLNER AUDI TT'),
(705, '181894-001', 'ZOLLNER AUDI TT'),
(706, ' 186682-001', 'ZOLLNER AUDI TT S-LINE'),
(707, '177850-001', 'ZOLLNER B81'),
(708, '169926-001', 'ZOLLNER BENTLEY TAIL ECE'),
(709, '180404-001', 'ZOLLNER C217'),
(710, '180833-001', 'ZOLLNER C217'),
(711, '184432-001', 'ZOLLNER C217'),
(712, '183719-001', 'ZOLLNER ELEKTRONIK'),
(713, '183662-001', 'ZOLLNER FASCIA LH'),
(714, '183680-001', 'ZOLLNER FASCIA RH'),
(715, '182110-001', 'ZOLLNER FOG LEFT'),
(716, '185693-001', 'ZOLLNER FOG LH'),
(717, '182126-001', 'ZOLLNER FOG RH'),
(718, '185695-001', 'ZOLLNER FOG RH'),
(719, '182566-001', 'ZOLLNER L550 DRL LH'),
(720, '184435-001', 'ZOLLNER L550 DRL LH'),
(721, '188650-001', 'ZOLLNER L550 DRL LH'),
(722, '182567-001', 'ZOLLNER L550 DRL RH'),
(723, '184439-001', 'ZOLLNER L550 DRL RH'),
(724, '188653-001', 'ZOLLNER L550 DRL RH'),
(725, '173178-001', 'ZOLLNER LAMBORGHINI LH'),
(726, '173174-001', 'ZOLLNER LAMBORGHINI RH'),
(727, '187046-001', 'ZOLLNER LANCIA 844DX'),
(728, '187295-001', 'ZOLLNER LANCIA 844SX'),
(729, '183637-001', 'ZOLLNER MIDDLE TAIL LH'),
(730, '183652-001', 'ZOLLNER MIDDLE TAIL RH'),
(731, '180196-001', 'ZOLLNER R8 ABL LH'),
(732, '180118-001', 'ZOLLNER R8 ABL RH'),
(733, '171843-001', 'ZOLLNER R8 BL '),
(734, '171946-001', 'ZOLLNER R8 DRL LH'),
(735, '183808-001', 'ZOLLNER R8 DRL LH'),
(736, '171954-001', 'ZOLLNER R8 DRL RH'),
(737, '180197-001', 'ZOLLNER R8 FL LH'),
(738, '180198-001', 'ZOLLNER R8 FL RH'),
(739, '173902-001', 'ZOLLNER ROVER L322'),
(740, '188849-001', 'ZOLLNER ROVER L322 TURN'),
(741, '174061-001', 'ZOLLNER T87 REAR LH'),
(742, '174062-001', 'ZOLLNER T87 REAR RH'),
(743, '184132-001', 'ZOLLNER TESLA X BODYSIDE LH'),
(744, '184502-001', 'ZOLLNER TESLA X BODYSIDE LH'),
(745, '184118-001', 'ZOLLNER TESLA X BODYSIDE RH'),
(746, '184500-001', 'ZOLLNER TESLA X BODYSIDE RH'),
(747, '184177-001', 'ZOLLNER TESLA X FASCIA TURN LH'),
(748, '184164-001', 'ZOLLNER TESLA X FASCIA TURN RH'),
(749, '184155-001', 'ZOLLNER TESLA X LIFTGATE LH'),
(750, '184506-001', 'ZOLLNER TESLA X LIFTGATE LH'),
(751, '184141-001', 'ZOLLNER TESLA X LIFTGATE RH'),
(752, '184504-001', 'ZOLLNER TESLA X LIFTGATE RH'),
(753, '184212-001', 'ZOLLNER TESLA X SIGNATURE SET LH'),
(754, '184186-001', 'ZOLLNER TESLA X SIGNATURE SET RH'),
(755, '179435-001', 'ZOLLNER X250 DRL LH'),
(756, '179432-001', 'ZOLLNER X250 DRL RH'),
(757, '186827-001', 'ZOLLNER X250 LH'),
(758, '186826-001', 'ZOLLNER X250 RH'),
(759, '163518-001', 'ZOLLNER/ OSRAM BENTLEY STOP'),
(760, '163441-001', 'ZOLLNER/ OSRAM BMW MAIN'),
(761, '163504-001', 'ZOLLNER/ OSRAM BMW RCL SIDE'),
(762, '173276-001', 'FLEX AU RH'),
(763, '189574-001', 'BMW LIGHT ENGINE'),
(764, '190035-001', 'RIVIAN POSITIVE'),
(765, '190048-001', 'RIVIAN NEGATIVE'),
(766, '190175-001', 'RIVIAN POSITIVE'),
(767, '189907-001', 'FBR '),
(768, '190177-001', 'RIVIAN NEGATIVE'),
(769, '186829-001', 'X250 Flex 2 RIGHT'),
(770, '190078-001', 'IC CKT; PREH; 13052-029/0007; ZIF CHANGE; PHL'),
(771, '190084-001', 'IC CKT; PREH; 13052-030/0007; ZIF CHANGE; PHL'),
(772, '190128-001', 'IC CKT; PREH; 13052-114/0005; ZIF CHANGE; PHL'),
(773, '190092-001', 'IC CKT; PREH; 13052-031/0006; ZIF CHANGE; PHL'),
(774, '190134-001', 'IC CKT; PREH; 13052-115/0005; ZIF CHANGE; PHL'),
(775, '190344-001', 'CKT; PRONAT; 675-1768-02;MERCURY'),
(776, '190262-001', 'FINGOOD; KATECHO; RM3397; NEUROMETRIX; QUELL; NT'),
(777, '190018-001', 'CKT; PRONAT; 675-1770-01; PROTEUS'),
(778, '190098-001', 'IC CKT; PREH; 13052-032/0006; ZIF CHANGE; PHL'),
(779, '189659-001', 'CKT ; Visteon ; VPMPLF-9G653-BC ; P5Q LEFT ; Single-Sided ; PHL'),
(780, '189600-001', 'CKT ; Visteon ; VPMPLF-9G653-AB ; P5 DN10 ; Single-Sided ; PHL'),
(781, '190140-001', 'IC CKT; PREH; 13052-116/0005; ZIF CHANGE; PHL'),
(782, '186682-001', 'CKT; Zollner ; 1472174-02 ; Audi TT s-line DRL ; Single-Sided ; PHL'),
(783, '190221-001', 'CKT; Kimball ; 38237363 ; Rev 004 ; 9BUX ; Double-Sided ; PHL'),
(784, '190146-001', 'IC CKT; PREH; 13052-117/0005; ZIF CHANGE; PHL'),
(785, '189028-001', 'SUBCKT;FLEX; 100291.40.0042;TOUCH-FOIL FBR;0600;01;PET;SILVER;CARBON;;NFD'),
(786, '190273-001', 'CKT ; Visteon ; VPJPLF-18B966-BG ; P2Q LEFT ; Single-Sided ; PHL'),
(787, '189828-001', 'IC; CKT; MCLAREN; LEFT ARTICULATION; D50074P01; ASSY; NTPI'),
(788, '190520-001', ' IC;CKT;EBW;15758; C; RH;15145&15144 ASSY TO PLATE;NFD AND NTPI'),
(789, '190493-001', 'IC;CKT;EBW;15757; C; LH;14945&14944 ASSY TO PLATE;NFD AND NTPI'),
(790, '190509-001', 'IC;SUB;EBW;14944; C; LH OUTBOARD;BLANKED;NTPI'),
(791, '190498-001', 'IC;SUB;EBW;14945; C; LH INBOARD;BLANKED;NTPI'),
(792, '189853-001', 'IC; CKT; MCLAREN; RIGHT ARTICULATION; D50051P01; ASSY; NTPI'),
(793, '190472-001', 'CKT ; TE ; 2247577-1 ; Rev D2 ; BMW Light Engine ; Double-Sided ; PHL'),
(794, '175488-001', '?IC CKT; INDAK; 56397-0C, GMT926-CHMSL; SSPE; FINISHING; PHL'),
(795, '190773-001', 'CKT; RIVIAN AUTOMOTIVE, LLC ; PT00039045-C03.1; FPC; VOLTAGE SENSE; POS; Single-Sided;'),
(796, '190077-001', 'IC SUB; CKT; PREH 13052-029/0007; MFC'),
(797, '190776-001', 'CKT; RIVIAN AUTOMOTIVE, LLC ; PT00039046; NEG; Single-Sided'),
(798, '190693-001', 'CKT; GRAKON; 2-PCB-421-100; CAP TOUCH SENSOR; ITO'),
(799, '190695-001', 'CKT; GRAKON; 2-PCB-420-100; CAP TOUCH SENSOR; ITO'),
(800, '190694-001', 'CKT; GRAKON; 2-PCB-421-200; CAP TOUCH SENSOR; ITO'),
(801, '190649-001', 'IC;CKT;EBW;15757; D; LH;BT1FG RCL LH STT; 14945 & 14944 ASSY TO PLATE;NTPI'),
(802, '190660-001', '190660-001:IC;CKT;EBW;15758; D; RH; BT1FG RCL RH STT; 15145 & 15144 ASSY TO PLATE;NTPI'),
(803, '191049-001', 'CKT; GRAKON; 2-PCB-420-100; P02; CAP TOUCH SENSOR; ITO'),
(804, '191022-001', 'CKT ; Flex ; 100454300007 rev 00 ; Volvo RLL ; Double-Sided ; PHL'),
(805, '191190-001', 'CKT ; Visteon ; VPMPLF-9G653-CD mod ; P5Q RIGHT ; Single-Sided ; PHL'),
(806, '191097-001', 'CKT ; Flex ; AAI1H-38204750 ; Rev 001 ; PCB, NCTS UP375 ; Double-Sided ; PHL'),
(807, '190874-001', 'CKT; RIVIAN AUTOMOTIVE, LLC ; PT00062061; 8S54P 7-MODULE NEG; Single-Sided; PHL'),
(808, '190890-001', 'IC CKT; PREH; 13052-192/0001; PHL'),
(809, '191102-001', 'IC;CKT;EBW;15757; D2; LH;BT1FG RCL LH STT; 14945 & 14944 ASSY TO PLATE;NTPI'),
(810, '190000-001', 'IC CKT; PREH 13052-170 / 0003; PHL'),
(811, '191189-001', 'CKT ; Visteon ; VPMPLF-9G653-BD mod ; P5Q LEFT ; Single-Sided ; PHL'),
(812, '191467-001', 'CKT; RIVIAN AUTOMOTIVE, LLC ; PT00039046; Rev C; Voltage Sense NEG; 9-module; Single-Sided'),
(813, '189420-001', 'CVLY; SUB ASSY; NT; KIMBALL; C1XX; TOP'),
(814, '184920-001', 'SubAssy Coverlay (MFC); PREH 13052-041/0003'),
(815, '191398-001', 'RIVIAN POSITIVE NEW '),
(816, '191472-001', 'IC CKT; PREH 13052-170 / 0001; PHL'),
(817, '191047-001', 'CKT; GRAKON; 2-PCB-421-100; P02; CAP TOUCH SENSOR; ITO'),
(818, '189558-001', 'IC SUB; ADHESIVE; PHL; KATECHO; RM3305; NC-DP2'),
(819, '191103-001', 'IC;CKT;EBW;15758; D2; RH; BT1FG RCL RH STT; 15145 & 15144 ASSY TO PLATE;NTPI'),
(820, '191336-001', 'IC CKT; EBW; 15850; B; RH STT; BT1UG RCL; 2 CKTS ON ALU PLATE; QPFF; NT'),
(821, '188864-001', 'SUBCKT; CKT; PREH GMBH ; AUDI SL D5 TOP; 067 PEDOT'),
(822, '190923-001', 'IC CKT; PREH; 13052-193/0002; PHL'),
(823, '190909-001', 'IC CKT; PREH; 13052-194/0001; PHL'),
(824, '191270-001', 'CKT; NANOTHINGS; ACSIP T US'),
(825, '191439-001', 'IC CKT; PREH 13052-238 / 0001; PHL'),
(826, '189424-001', 'SUBCKT ; CVLY ; Flex ; LWR/U375 ; TOP ; PHL'),
(827, '191335-001', 'IC CKT; EBW; 15849; C; LH STT; BT1UG RCL; 2 CKTS ON ALU PLATE; QPFF; NT'),
(828, '172798-001', 'IC CKT;AB MIKRO;37840055MK;FLEX 1184'),
(829, '185713-001', 'IC CKT; iEE; 00-104069-00-00; D; ALTERNATE THERMISTOR'),
(830, '190822-001', 'CKT ; Visteon ; VPMPLF-9G653-AC ; P5 DN10 ; Single-Sided ; PHL'),
(831, '191153-001', 'IC CKT; PREH; 13052-197/0001; PHL'),
(832, '187637-001', 'CKT; PREH GMBH ; 13052-061; 0005; Single-Sided'),
(833, '191852-001', 'IC CKT; EBW; 15850; C; RH STT; BT1UG RCL; 2 CKTS ON ALU PLATE; QPFF; NT'),
(834, '191844-001', 'IC CKT; EBW; 15849; D; LH STT; BT1UG RCL; 2 CKTS ON ALU PLATE; QPFF; NT'),
(835, '180234-001', 'YURA TOP COVERLAY'),
(836, '191667-001', 'CKT ; Flex ; 100454300007-N rev B ; Volvo RLL ; Double-Sided ; PHL'),
(837, '191774-001', 'IC CKT; PREH; 13052-114/0007; PHL'),
(838, '191694-001', 'IC CKT; PREH; 13052-030/0008; PHL'),
(839, '190945-001', 'IC CKT; PREH; 13052-195/0002; PHL'),
(840, '191272-001', 'CKT; NANOTHINGS; ACSIP T AU'),
(841, '191776-001', 'IC CKT; PREH; 13052-116/0007; PHL'),
(842, '191775-001', 'IC CKT; PREH; 13052-115/0007; PHL'),
(843, '191777-001', 'IC CKT; PREH; 13052-117/0007; PHL'),
(844, '191684-001', 'IC CKT; PREH; 13052-029/0008; PHL'),
(845, '191155-001', 'IC CKT; PREH; 13052-034/0005; PHL'),
(846, '191154-001', 'IC CKT; PREH; 13052-033/0501; PHL'),
(847, '192065-001', 'IC CKT; EBW; 15850; E; RH STT; BT1UG RCL; 2 CKTS ON ALU PLATE; CVLY; QPFF; PROTOTYPE; NT'),
(848, '191337-001', 'IC SUB; EBW; 15849; C; LH STT; BT1UG RCL; INBOARD SUB; BLANKED; NT'),
(849, '191701-001', 'IC CKT; PREH; 13052-031/0007; PHL'),
(850, '192090-001', 'IC CKT; PREH; 13052-193/0003; PHL'),
(851, '192091-001', 'IC CKT; PREH; 13052-194/0002; PHL'),
(852, '181740-001', 'IC CKT;BORG;57017;REV E;RIGHT HAND;FINISHING;NTPI'),
(853, '192089-001', 'IC CKT; PREH; 13052-192/0002; PHL'),
(854, '191711-001', 'IC CKT; PREH; 13052-032/0007; PHL'),
(855, '192018-001', 'CKT; PREH GMBH; 13052-218/0001; REV 0001; BMW BZM AUT F7X; PRODUCTION; CONDUCTIVE INKS'),
(856, '192092-001', 'IC CKT; PREH; 13052-195/0003; PHL'),
(857, '191932-001', 'PREH 170'),
(858, '189425-001', 'SUBCKT ; CVLY ; Flex ; LWR/U375 ; BOTTOM ; PHL'),
(859, '190104-001', 'PREH 037'),
(860, '190110-001', 'Preh 038'),
(861, '180235-001', 'IC CVLY;YURA;MED/LARGE BTM 4-UP - W/O TAB;PHIL'),
(862, '192520-001', 'CKT; RIVIAN AUTOMOTIVE, LLC ; PT00039045; Rev C; Voltage Sense POS; 9-Module; Single-Sided;'),
(863, '191048-001', ':CKT; GRAKON; 2-PCB-421-200; P02; CAP TOUCH SENSOR; ITO'),
(864, '191458-001', 'IC CKT; KYOCERA; 13000012881;005 1153 13 E; TOC; FINISHING; NT'),
(865, '192521-001', 'CKT; RIVIAN AUTOMOTIVE, LLC ; PT00039046; Rev C; Voltage Sense NEG; 9-module; Single-Sided'),
(866, '192590-001', 'CKT; PREH ROMANIA S.R.L.; 13052-253/0101; REV 0101; Porsche Cayenne E4 Climate Control; PRODUCTION; CONDUCTIVE INKS; PHL'),
(867, '192619-001', 'CKT; PREH GMBH; 13052-218/0201; REV 0201; BZM AUT F7X; PRODUCTION; CONDUCTIVE INKS; PHL'),
(868, '192790-001', 'IC CKT; JOYSON SAFETY SYSTEMS; 2552010; AA; SENSOR; PHL'),
(869, '186828-001', 'SUBCKT ; CKT ; Zollner ; X250 Flex 1 ; PHL'),
(870, '192511-001', 'PRONAT PROTEUS'),
(871, '191943-001', 'PREH 238'),
(872, '192826-001', 'METHODE MAPLIGHT'),
(873, '193022-001', 'RIVIAN R1 421-200');

-- --------------------------------------------------------

--
-- Table structure for table `prod_dispo_tbl`
--

CREATE TABLE `prod_dispo_tbl` (
  `id` int(11) NOT NULL,
  `use_as_isActive` tinyint(1) DEFAULT 0,
  `re_inspectionActive` tinyint(1) DEFAULT 0,
  `run_normalActive` tinyint(1) DEFAULT 0,
  `regrade_Active` tinyint(1) DEFAULT 0,
  `rework_Active` tinyint(1) DEFAULT 0,
  `repair_Active` tinyint(1) DEFAULT 0,
  `rework_traveler_Active` tinyint(1) DEFAULT 0,
  `scrap_Active` tinyint(1) DEFAULT 0,
  `RTV_Active` tinyint(1) DEFAULT 0,
  `yield_off` varchar(255) DEFAULT NULL,
  `da_no` varchar(255) DEFAULT NULL,
  `rework_da_no` varchar(255) DEFAULT NULL,
  `wis_no` varchar(255) DEFAULT NULL,
  `scrap_amount` decimal(10,2) DEFAULT NULL,
  `shipment_date` date DEFAULT NULL,
  `intervention_id` int(11) DEFAULT NULL,
  `rework_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod_dispo_tbl`
--

INSERT INTO `prod_dispo_tbl` (`id`, `use_as_isActive`, `re_inspectionActive`, `run_normalActive`, `regrade_Active`, `rework_Active`, `repair_Active`, `rework_traveler_Active`, `scrap_Active`, `RTV_Active`, `yield_off`, `da_no`, `rework_da_no`, `wis_no`, `scrap_amount`, `shipment_date`, `intervention_id`, `rework_type_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:21:08', '2025-03-20 10:21:08'),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:22:06', '2025-03-20 10:22:06'),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:22:35', '2025-03-20 10:22:35'),
(4, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:25:23', '2025-03-20 10:25:23'),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:27:36', '2025-03-20 10:27:36'),
(6, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:29:01', '2025-03-20 10:29:01'),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:30:11', '2025-03-20 10:30:11'),
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:31:27', '2025-03-20 10:31:27'),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:33:19', '2025-03-20 10:33:19'),
(10, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:36:12', '2025-03-20 10:36:12'),
(11, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-20 10:44:52', '2025-03-20 10:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `pwd` varchar(80) DEFAULT NULL,
  `otp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `email`, `first_name`, `last_name`, `pwd`, `otp`) VALUES
(1, 'jr.gerardo14@gmail.com', 'John', 'Doe', '123456', '815030'),
(2, 'gerardocabojr@gmail.com', 'Alice', 'Smith', 'abcdef', '272532'),
(3, 'user3@example.com', 'Bob', 'Johnson', 'password', '654321');

-- --------------------------------------------------------

--
-- Table structure for table `rework_type_tbl`
--

CREATE TABLE `rework_type_tbl` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rework_type_tbl`
--

INSERT INTO `rework_type_tbl` (`id`, `type`) VALUES
(3, 'Re-Etest'),
(4, 'Re-measure'),
(2, 'Re-plate'),
(1, 'Re-press'),
(5, 'Rework Traveler');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_file`
--

CREATE TABLE `uploaded_file` (
  `id` int(11) NOT NULL,
  `ncpr_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` enum('image','excel') NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_file`
--

INSERT INTO `uploaded_file` (`id`, `ncpr_id`, `file_name`, `file_path`, `file_type`, `uploaded_at`) VALUES
(6, 101, '96bda0839bdbf74324d4c197818bbfb1-removebg-preview (1) (1).png', 'asset/images/1741750353_96bda0839bdbf74324d4c197818bbfb1-removebg-preview (1) (1).png', 'image', '2025-03-12 03:32:33'),
(7, 101, 'admin Dashboard (4) (1).xlsx', 'asset/excel/1741750353_admin Dashboard (4) (1).xlsx', 'excel', '2025-03-12 03:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `excel_name` varchar(255) NOT NULL,
  `excel_path` varchar(500) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ncpr_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'jr.gerardo14@gmail.com', '$2y$10$cBuROR5GuFpEDVLlBMBnLuDtcf7Hrl6PsKksFZYGAShkqe.G4sfPC', 'admin', '6f812abe9e6c9f4aff8d26cae249af68429217b221fe22cc866cf63be4fbb70b', '2025-03-03 03:53:32'),
(2, 'Superadmin@gmail.com', '$2y$10$WO3Of61zzR2y3h5TEhqpv..pI2xG2B51K1ugfHhYfdhHzrmC/shE2', 'superadmin', NULL, NULL),
(8, 'staff_user', '85247db7b57a728953a751441de4aff6f9d4f43f270dd1d3fcfe9c34f4100596', 'STAFF', NULL, NULL),
(9, 'engineer_user', 'bd281514bfb9629e6e59b05b05aec19c619bd6c6097554b7cf628431cb215cc7', 'ENGINEER', NULL, NULL),
(10, 'manager_user', 'd59083b73ab80d83922748c9a37d7561dad02cceba906da487f966c8754cec5b', 'MANAGER', NULL, NULL),
(11, 'supervisor_user', 'f6d69111dd3956d12c23eb91aa4fb6503e5ad1076147c4479b21c0dacb9db1b4', 'SUPERVISOR', NULL, NULL),
(12, 'rep_user', 'e0caf2b49f5cc49d695328162856144031613d7361d3b951f17bcea09f75179f', 'REPRESENTATIVE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `created_at`, `person_id`) VALUES
(2, 'jr.gerardo14@gmail.com', '$2y$10$TYELwL2PhUlikVxs2kh6OeE.oDpj91gEooI2pKY1FPwRaj.MYKsH.', 2, '2025-03-17 06:53:25', 0),
(3, 'Superadmin@gmail.com', '$2y$10$nqr.jgUU5knN8gEWd1YlB.2VGLDPCH.fhNHeFiYwD3nGGeIk.W28C', 1, '2025-03-17 06:55:18', 0),
(4, 'qastaff1@ntphil.com', '$2y$10$./PMVLBHDHh05BPvTaON3.zvvvBFvD9RDhsZiC8zXeGNXGLVZoFVa', 7, '2025-03-17 07:02:11', 0),
(5, 'engr_user', '$2y$10$MKfvuNI6yfh4/IGo.QkrjOlt0vg1w1r8uOLgRmNRZdTJfz/7.Wrgu', 6, '2025-03-19 02:30:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL,
  `name` enum('SUPERADMIN','ADMIN','REPRESENTATIVE','MANAGER','SUPERVISOR','ENGINEER','STAFF','GUEST') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `name`) VALUES
(1, 'SUPERADMIN'),
(2, 'ADMIN'),
(3, 'REPRESENTATIVE'),
(4, 'MANAGER'),
(5, 'SUPERVISOR'),
(6, 'ENGINEER'),
(7, 'STAFF'),
(8, 'GUEST');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_tbl`
--
ALTER TABLE `car_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DRF_id` (`DRF_id`);

--
-- Indexes for table `cnc_mat_tbl`
--
ALTER TABLE `cnc_mat_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CAR_id` (`CAR_id`);

--
-- Indexes for table `dispo_sitioned`
--
ALTER TABLE `dispo_sitioned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispo_table`
--
ALTER TABLE `dispo_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CNC_mat_id` (`CNC_mat_id`);

--
-- Indexes for table `drf_tbl`
--
ALTER TABLE `drf_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_dispo_id` (`prod_dispo_id`);

--
-- Indexes for table `fomo`
--
ALTER TABLE `fomo`
  ADD PRIMARY KEY (`fomo_id`),
  ADD KEY `fk_ncpr_id` (`ncpr_id`);

--
-- Indexes for table `key_person`
--
ALTER TABLE `key_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `fk_ncpr_material` (`ncpr_id`);

--
-- Indexes for table `ncpr_counter`
--
ALTER TABLE `ncpr_counter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- Indexes for table `ncpr_table`
--
ALTER TABLE `ncpr_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ncpr_temp_table`
--
ALTER TABLE `ncpr_temp_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ncpr_num` (`ncpr_num`);

--
-- Indexes for table `process_area`
--
ALTER TABLE `process_area`
  ADD PRIMARY KEY (`process_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `prod_dispo_tbl`
--
ALTER TABLE `prod_dispo_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rework_type_id` (`rework_type_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `rework_type_tbl`
--
ALTER TABLE `rework_type_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `uploaded_file`
--
ALTER TABLE `uploaded_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ncpr_id` (`ncpr_id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ncpr_id` (`ncpr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_tbl`
--
ALTER TABLE `car_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cnc_mat_tbl`
--
ALTER TABLE `cnc_mat_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dispo_sitioned`
--
ALTER TABLE `dispo_sitioned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dispo_table`
--
ALTER TABLE `dispo_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drf_tbl`
--
ALTER TABLE `drf_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fomo`
--
ALTER TABLE `fomo`
  MODIFY `fomo_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `key_person`
--
ALTER TABLE `key_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `ncpr_counter`
--
ALTER TABLE `ncpr_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ncpr_table`
--
ALTER TABLE `ncpr_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `ncpr_temp_table`
--
ALTER TABLE `ncpr_temp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `process_area`
--
ALTER TABLE `process_area`
  MODIFY `process_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=874;

--
-- AUTO_INCREMENT for table `prod_dispo_tbl`
--
ALTER TABLE `prod_dispo_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rework_type_tbl`
--
ALTER TABLE `rework_type_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uploaded_file`
--
ALTER TABLE `uploaded_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_tbl`
--
ALTER TABLE `car_tbl`
  ADD CONSTRAINT `car_tbl_ibfk_1` FOREIGN KEY (`DRF_id`) REFERENCES `drf_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cnc_mat_tbl`
--
ALTER TABLE `cnc_mat_tbl`
  ADD CONSTRAINT `cnc_mat_tbl_ibfk_1` FOREIGN KEY (`CAR_id`) REFERENCES `car_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dispo_table`
--
ALTER TABLE `dispo_table`
  ADD CONSTRAINT `dispo_table_ibfk_1` FOREIGN KEY (`CNC_mat_id`) REFERENCES `cnc_mat_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drf_tbl`
--
ALTER TABLE `drf_tbl`
  ADD CONSTRAINT `drf_tbl_ibfk_1` FOREIGN KEY (`prod_dispo_id`) REFERENCES `prod_dispo_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fomo`
--
ALTER TABLE `fomo`
  ADD CONSTRAINT `fk_ncpr_id` FOREIGN KEY (`ncpr_id`) REFERENCES `ncpr_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_ncpr_material` FOREIGN KEY (`ncpr_id`) REFERENCES `ncpr_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prod_dispo_tbl`
--
ALTER TABLE `prod_dispo_tbl`
  ADD CONSTRAINT `prod_dispo_tbl_ibfk_1` FOREIGN KEY (`rework_type_id`) REFERENCES `rework_type_tbl` (`id`);

--
-- Constraints for table `uploaded_file`
--
ALTER TABLE `uploaded_file`
  ADD CONSTRAINT `uploaded_file_ibfk_1` FOREIGN KEY (`ncpr_id`) REFERENCES `ncpr_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD CONSTRAINT `uploaded_files_ibfk_1` FOREIGN KEY (`ncpr_id`) REFERENCES `ncpr_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
