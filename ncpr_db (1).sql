-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 07:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(16, 'afs', 'Rane', 'fsf', 1352, 0, 101);

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
(57, 'a', 'a', 14, 2, 'lala', '14.29', 101);

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
  `customer_notif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ncpr_table`
--

INSERT INTO `ncpr_table` (`id`, `initiator`, `ncpr_num`, `date`, `part_number`, `part_name`, `process`, `urgent`, `status`, `issue`, `awpi`, `dc`, `deviation`, `repeating`, `cavity`, `machine`, `ref`, `bg`, `one`, `one_one`, `two`, `two_one`, `three`, `three_one`, `four`, `five`, `six`, `seven`, `seven_one`, `seven_two`, `eight`, `eight_one`, `nine`, `nine_one`, `recall`, `fgparts`, `shipment`, `ship_sched`, `wip`, `stop_proc`, `location`, `mcs`, `mcs_details`, `customer_notif`) VALUES
(100, 'a', '25-0001', '2025-03-12', 'a', 'a', 'a', 'on', 'open', 'a', '1', '1', 'Yes', 'Yes', '1', 'q', '1', 'a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(101, 'Cabo, Gerardo', '25-0002', '2025-03-12', '196555', 'amsdnsad', 'Area 51', 'on', 'open', 'Laro laro', 'dog', 'bakit', 'Yes', 'Yes', 'Laro dog laro dog laro dog laro dog laro dog laro dog laro dog', 'a', 'awts', 'awts123', 'yes', 'yes', 'yes', 'a', 'yes', 'a', 'yes', 'yes', 'yes', 'yes', 'a', 'a', 'yes', 'a', 'yes', 'a', 'yes', 'yes', 'yes', 'a', 'yes', 'yes', 'a', 'yes', 'a', 'yes');

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
  `part_number` int(255) NOT NULL,
  `part_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product_id`, `part_number`, `part_name`) VALUES
(1, 1234, 'amsdnsad'),
(2, 123, '1'),
(3, 12, 'jeje'),
(4, 333, 'asr'),
(5, 196555, 'amsdnsad'),
(6, 0, 'a'),
(7, 1, '1'),
(8, 131, '424');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'jr.gerardo14@gmail.com', '$2y$10$cBuROR5GuFpEDVLlBMBnLuDtcf7Hrl6PsKksFZYGAShkqe.G4sfPC', 'admin', '6f812abe9e6c9f4aff8d26cae249af68429217b221fe22cc866cf63be4fbb70b', '2025-03-03 03:53:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fomo`
--
ALTER TABLE `fomo`
  ADD PRIMARY KEY (`fomo_id`),
  ADD KEY `fk_ncpr_id` (`ncpr_id`);

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
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fomo`
--
ALTER TABLE `fomo`
  MODIFY `fomo_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ncpr_counter`
--
ALTER TABLE `ncpr_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ncpr_table`
--
ALTER TABLE `ncpr_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
