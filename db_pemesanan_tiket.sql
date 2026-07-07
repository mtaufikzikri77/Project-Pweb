-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2026 at 05:11 AM
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
-- Database: `db_pemesanan_tiket`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Konser Musik'),
(2, 'Teater & Drama'),
(3, 'Olahraga'),
(4, 'Seminar & Workshop'),
(5, 'Festival Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_code` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `organizer` varchar(255) DEFAULT 'Anonim',
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_main_event` tinyint(1) DEFAULT 0,
  `price` float NOT NULL,
  `quota` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_code`, `title`, `organizer`, `description`, `location`, `event_date`, `image`, `is_main_event`, `price`, `quota`, `status`) VALUES
(2, 'EVT-1783267991', 'Tourism Ministerial Meeting', 'Anonim', 'G20 Tourism', NULL, '2029-12-20 20:30:00', '9a5db119a2b1f7b7916cb59fd03c5111.jpg', 0, 100000, 75, 'Aktif'),
(3, 'EVT-1783268423', 'Burung Perkutut Burung Merpati', 'Anonim', 'TEST', NULL, '2020-10-10 20:20:00', 'default.jpg', 0, 100000, 10000, 'Aktif'),
(4, 'EVT-1783291796', 'Wayang Event', 'Anonim', 'Wayang', 'Nusa Tenggara Barat', '2029-02-20 20:30:00', 'd02a441c26418d0e7703ca901f0f93e5.jpg', 1, 100000, 0, 'Aktif'),
(5, 'EVT-1783306806', 'Seminar Mewah', 'Bapaknya Taufik', 'Seminar Gacor', 'Lotim', '2029-02-10 20:30:00', '38a31df4bca87946adf8ac131277a24d.jpg', 0, 10000000, 1000, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id`, `event_id`, `category_id`) VALUES
(1, 4, 2),
(2, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `ticket_qty` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL,
  `check_in_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `user_id`, `event_id`, `order_date`, `ticket_qty`, `total_price`, `payment_method`, `payment_status`, `check_in_status`) VALUES
(6, 3, 4, '2026-07-06 00:57:41', 1, 100000, 'Mandiri Virtual Account', 'Pending', 'Belum'),
(7, 4, 4, '2026-07-06 01:09:00', 5, 500000, 'QRIS (GoPay/Dana/OVO)', 'Pending', 'Belum'),
(8, 3, 4, '2026-07-06 01:13:56', 995, 99500000, 'BCA Virtual Account', 'Pending', 'Belum'),
(9, 3, 2, '2026-07-06 04:18:06', 25, 2500000, 'Mandiri Virtual Account', 'Pending', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `phone`, `address`, `status`) VALUES
(2, 'eji@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '12345', 'eji', 'active'),
(3, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1, '12', 'admin', 'active'),
(4, 'joy@gmail.com', '0d5425118d7aaa57e0f18a9e0d87104b', 2, '12345', 'joy', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_code` (`event_code`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_category`
--
ALTER TABLE `event_category`
  ADD CONSTRAINT `event_category_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD CONSTRAINT `transaction_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_logs_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
