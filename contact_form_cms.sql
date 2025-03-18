-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 11:37 AM
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
-- Database: `contact_form_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` bigint(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `experience` int(15) NOT NULL,
  `current_company_name` varchar(100) NOT NULL,
  `current_salary` decimal(10,0) NOT NULL,
  `expected_salary` decimal(10,0) NOT NULL,
  `notice_period` int(20) NOT NULL,
  `position` varchar(100) NOT NULL,
  `other_position` varchar(100) DEFAULT NULL,
  `work_before` enum('Yes','No') NOT NULL,
  `about_opportunity` varchar(100) NOT NULL,
  `other_opportunity` varchar(100) DEFAULT NULL,
  `referral` varchar(100) NOT NULL,
  `cv` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `email`, `date`, `fname`, `mobile_no`, `experience`, `current_company_name`, `current_salary`, `expected_salary`, `notice_period`, `position`, `other_position`, `work_before`, `about_opportunity`, `other_opportunity`, `referral`, `cv`, `created_at`) VALUES
(153, 'test11@example.com', '2023-11-01', 'John Doe', '1234567890', 5, 'Company A', 50000, 60000, 30, 'Software Engineer', NULL, 'Yes', 'Company Website', NULL, 'John Smith', 'cv1.pdf', '2024-11-13 14:21:28'),
(154, 'test23@example.com', '2023-10-01', 'Jane Smith', '9876543210', 3, 'Company B', 40000, 50000, 45, 'Data Analyst', NULL, 'No', 'LinkedIn', NULL, 'Jane Doe', 'cv2.pdf', '2024-10-13 14:21:28'),
(155, 'test33@example.com', '2023-12-01', 'Michael Brown', '4567891230', 2, 'Company C', 35000, 45000, 60, 'HR Executive', NULL, 'Yes', 'Referred by an employee of Yoanone Solutions', NULL, 'Michael Johnson', 'cv3.pdf', '2024-12-13 14:21:28'),
(156, 'test44@example.com', '2023-09-01', 'Emily Davis', '7891234560', 4, 'Company D', 48000, 58000, 30, 'Project Manager', NULL, 'No', 'Job Consultant', NULL, 'Emily White', 'cv4.pdf', '2024-09-13 14:21:28'),
(157, 'a@gmail.com', '2025-03-13', 'sneha meshramdrfyguhjkftghjnkml', '7864135875', 2, 'opkpoipo', 20000, 30000, 30, 'Quality Analyst (Data)', '', 'No', 'LinkedIn', '', '', '67d2f7b1d7e10-1.docx', '2025-03-13 15:20:17'),
(158, 'aaaaaaaaaaaaaaaa@gmail.com', '2025-03-13', 'jkj jj', '8764135875', 2, 'opkpoipo', 20000, 900000, 30, 'Social Verification', 'Developer', 'Yes', 'Company Website', '', '741', '67d2f808d3f77-1.docx', '2025-03-13 15:21:44'),
(159, 'assd@gmail.com', '2025-03-13', 'jkj jj', '7764135875', 5, 'opkpoipo', 2, 900000, 15, 'WFM', '', 'Yes', 'Other', 'naukri', '741', '67d2fb1019c9d-1.docx', '2025-03-13 15:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(16, 'm@gmail.com', '$2y$10$W2gfaO/BtzlsSZnir9sS7O4f.QPAY3u1EvRSNE7uRal0VJoLwLBry'),
(17, 'a@gmail.com', '$2y$10$oor4UZPjjo42Hxi6H.voOuvhaNt2Evb1RTsbs8NMOR/IUKwCaf5UG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
