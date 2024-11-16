-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 09:15 AM
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
-- Database: `cendashdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@mail.com', '', '2023-11-30 03:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(1, 1, 'Porksilog', 'Fried pork chop with fried rice and egg.', 75.00, '65686d09e33a0.jpg'),
(2, 1, 'Hotsilog', 'Hotdog, garlic fried rice, and egg.', 50.00, '65682ca396f1b.png'),
(3, 4, 'Bibimbap Overload', '2x Egg, Meat, and Vegetable', 99.00, '65686b63c5548.jpg'),
(4, 1, 'Shangsilog', 'Shanghai, fried rice, and egg.', 45.00, '65682bf032fe9.jpg'),
(5, 2, 'Beef Shawarma', 'Solo', 69.00, '6568739e9f671.jpeg'),
(6, 2, 'Siomai Rice', '5Pcs with rice + coke float', 65.00, '6568747df3ed2.jpg'),
(17, 7, 'BLT sandwich', 'Special BLT sandwich', 65.00, '656b4462ea896.jpg'),
(18, 6, 'Eggplant Katsu', 'Eggplant Katsu over rice ', 65.00, '656b45b3a6543.jpg'),
(19, 5, 'Dark Nutella', 'Dark choco milk tea', 50.00, '656b464a23903.jpg'),
(20, 5, 'Takoyaki', 'Squid Takoyaki 4pcs', 50.00, '656b46e13e507.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(13, 23, 'in process', 'blahblah', '2023-12-01 01:27:38'),
(14, 28, 'in process', 'Hello, pa wait lang po ng order nyo. Thank you!!', '2023-12-01 09:35:51'),
(15, 30, 'in process', 'Pahintay nalang po, thank you!!', '2023-12-01 10:03:10'),
(16, 31, 'closed', 'THANK YOU PO SA PAGBILI, I LOVE YOU PO SAIRA DE MESA', '2023-12-01 10:04:19'),
(17, 57, 'in process', 'PAANTAY NALANG PO TY', '2023-12-29 08:45:32'),
(18, 57, 'closed', 'THANKS', '2023-12-29 09:07:33'),
(19, 58, 'in process', 'ASDSA', '2024-01-02 16:47:17'),
(20, 58, 'closed', 'asdas', '2024-01-02 16:47:51'),
(21, 58, 'in process', 'OTW', '2024-01-04 13:20:45'),
(22, 59, 'rejected', 's', '2024-01-06 09:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(9, 'Sairarat ', 'Sai', 'De Mesa', 'ssdemesa14@gmail.com', '09959866824', '89a6a82de47f9489f699ae1fa0b31ef7', 'Sa heart mo :3', 1, '2023-12-01 08:32:01'),
(21, 'blahblah', 'blahblah', 'blahblah', 'blahblah@gmail.com', '9999999999999', '$2y$10$pceAYkI6VtwOSwmO/J1LTexWoQ433R8OxT2K.wouFNQdw1XyKLgNG', '', 1, '2023-12-21 08:31:09'),
(24, 'raiven', 'raiven', 'raiven', 'raiven@gmail.com', '9999999999999', '3221728385b64ffd93ac5ed2a6ec787b', '', 1, '2024-01-08 10:51:46'),
(25, 'felix', 'felix', 'felix', 'felix@gmail.com', '999999999999999', '25779f8829ab7a7650e85a4cc871e6ac', '', 1, '2023-12-26 09:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_type` varchar(255) DEFAULT NULL,
  `vendor_remark` mediumtext DEFAULT NULL,
  `rs_id` int(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`, `order_type`, `vendor_remark`, `rs_id`) VALUES
(1, 4, 'Spring Rolls', 2, 6.00, 'rejected', '2022-05-27 11:43:26', NULL, NULL, 0),
(2, 4, 'Prawn Crackers', 1, 7.00, 'closed', '2022-05-27 11:11:41', NULL, NULL, 0),
(3, 5, 'Chicken Madeira', 1, 23.00, 'closed', '2022-05-27 11:42:35', NULL, NULL, 0),
(4, 5, 'Cheesy Mashed Potato', 1, 5.00, 'in process', '2022-05-27 11:42:55', NULL, NULL, 0),
(5, 5, 'Meatballs Penne Pasta', 1, 10.00, 'closed', '2022-05-27 13:18:03', NULL, NULL, 0),
(6, 5, 'Yorkshire Lamb Patties', 1, 14.00, NULL, '2022-05-27 11:40:51', NULL, NULL, 0),
(7, 6, 'Yorkshire Lamb Patties', 1, 14.00, 'closed', '2022-05-27 13:04:33', NULL, NULL, 0),
(8, 6, 'Lobster Thermidor', 1, 36.00, 'closed', '2022-05-27 13:05:24', NULL, NULL, 0),
(9, 6, 'Stuffed Jacket Potatoes', 1, 8.00, 'rejected', '2022-05-27 13:03:53', NULL, NULL, 0),
(23, 8, 'Porksilog', 1, 75.00, 'in process', '2023-12-01 01:27:38', 'Dine In', NULL, 0),
(26, 11, 'Porksilog', 1, 75.00, NULL, '2023-12-01 09:33:29', 'Take Out', NULL, 0),
(27, 11, 'Hotsilog', 1, 50.00, NULL, '2023-12-01 09:33:29', 'Take Out', NULL, 0),
(28, 11, 'Beef Shawarma', 5, 69.00, 'in process', '2023-12-01 09:35:51', 'Take Out', NULL, 0),
(29, 11, 'Siomai Rice', 1, 65.00, NULL, '2023-12-01 09:33:29', 'Take Out', NULL, 0),
(37, 7, 'Porksilog', 1, 75.00, NULL, '2023-12-17 01:06:53', 'Dine In', NULL, 0),
(38, 7, 'Hotsilog', 1, 50.00, NULL, '2023-12-17 01:06:53', 'Dine In', NULL, 0),
(58, 24, 'Eggplant Katsu', 1, 65.00, 'in process', '2024-01-04 13:20:45', 'Dine In', 'OTW', 6),
(62, 24, 'Dark Nutella', 1, 50.00, NULL, '2024-01-06 02:16:13', 'Dine In', NULL, 5),
(67, 24, 'Bibimbap Overload', 1, 99.00, NULL, '2024-01-21 07:32:44', 'Dine In', NULL, 4),
(68, 24, 'Porksilog', 1, 75.00, NULL, '2024-01-21 07:33:10', 'Dine In', NULL, 1),
(69, 24, 'Porksilog', 1, 75.00, NULL, '2024-01-21 14:32:03', 'Dine In', NULL, 1),
(70, 24, 'Porksilog', 1, 75.00, NULL, '2024-01-21 14:33:13', 'Dine In', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`rs_id`, `c_id`, `title`, `email`, `phone`, `o_hr`, `c_hr`, `o_days`, `image`, `date`) VALUES
(1, 1, 'Ate Meanns Silog', 'atemeannssilog@gmail.com', '+63123456789', '--Select your Hours--', '3pm', 'mon-sat', '658ba7b9d53ad.jpg', '2023-12-27 04:27:37'),
(2, 1, 'Eymi', 'eymi@gmail.com', '63123456789', '8am', '5pm', 'mon-fri', '6568708c75629.jpg', '2023-11-30 11:22:52'),
(4, 1, 'Caleighas', 'john.olazo@neu.edu.ph', '63123456789', '8am', '8pm', 'mon-fri', '656864b85536f.jpg', '2023-11-30 10:32:24'),
(5, 1, 'Tea Xplode Store', 'teaXplode@gmail.com', '+635532784257', '8am', '8pm', 'Mon-Sat', '656b41e5743ef.jpg', '2023-12-02 14:40:37'),
(6, 1, 'Curbs', 'curbsss@gmai.com', '+637724868290', '8am', '8pm', 'Mon-Fri', '656b428fce220.jpg', '2023-12-02 14:43:27'),
(7, 4, 'Jollibess', 'jollibessi@gmai.com', '+638386029265', '8am', '8pm', 'Mon-Sat', '656b4343b475a.jpg', '2023-12-02 14:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_group`
--

CREATE TABLE `vendor_group` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vendor_group`
--

INSERT INTO `vendor_group` (`c_id`, `c_name`, `date`) VALUES
(1, 'Meals', '2023-11-30 10:38:08'),
(2, 'Drinks', '2023-11-30 04:29:33'),
(3, 'Grilled', '2023-11-30 04:06:33'),
(4, 'Fried', '2023-11-30 04:07:30'),
(5, 'Milkshakes', '2023-11-30 04:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_users`
--

CREATE TABLE `vendor_users` (
  `vu_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vendor_users`
--

INSERT INTO `vendor_users` (`vu_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `rs_id`, `date`) VALUES
(1, 'raiven', 'raiven', 'raiven', 'raiven@gmail.com', '9999999999999', '3221728385b64ffd93ac5ed2a6ec787b', 1, '2023-12-27 02:50:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `vendor_group`
--
ALTER TABLE `vendor_group`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `vendor_users`
--
ALTER TABLE `vendor_users`
  ADD PRIMARY KEY (`vu_id`),
  ADD KEY `fk_vendor_users_restaurant` (`rs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor_group`
--
ALTER TABLE `vendor_group`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor_users`
--
ALTER TABLE `vendor_users`
  MODIFY `vu_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vendor_users`
--
ALTER TABLE `vendor_users`
  ADD CONSTRAINT `fk_vendor_users_restaurant` FOREIGN KEY (`rs_id`) REFERENCES `vendor` (`rs_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
