-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2024 at 04:19 PM
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
-- Database: `chat-feature`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_requests`
--

CREATE TABLE `appointment_requests` (
  `id` int(11) NOT NULL,
  `request_id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `service` varchar(255) DEFAULT 'Dental Appointment',
  `preferred_date` date NOT NULL,
  `preferred_time` time NOT NULL,
  `comments` text DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') DEFAULT 'pending',
  `viewed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_requests`
--

INSERT INTO `appointment_requests` (`id`, `request_id`, `firstname`, `lastname`, `email`, `phone_number`, `service`, `preferred_date`, `preferred_time`, `comments`, `status`, `viewed`) VALUES
(1, 1699807961, 'John', 'Smith', 'john_smith@example.com', '09176090001', 'Teeth Cleaning', '2024-04-2', '10:00:00', NULL, 'confirmed', 0),
(2, 1382883353, 'Jane', 'Doe', 'jane_doe@example.com', '09176090002', 'Dental Checkup', '2024-04-2', '12:00:00', '', 'confirmed', 0),
(3, 731906361, 'Michael', 'Johnson', 'michael_johnson@example.com', '09176090003', 'Tooth Extraction', '2024-04-2', '09:30:00', '', 'confirmed', 0),
(4, 1369986069, 'Emily', 'Brown', 'emily_brown@example.com', '09176090004', 'Dental Fillings', '2024-04-2', '14:00:00', '', 'pending', 0),
(5, 540758717, 'William', 'Taylor', 'william_taylor@example.com', '09176090005', 'Root Canal Therapy', '2024-04-2', '11:30:00', '', 'confirmed', 0),
(6, 1443227303, 'Olivia', 'Martinez', 'olivia_martinez@example.com', '09176090006', 'Dental Crowns', '2024-04-2', '15:45:00', '', 'confirmed', 0),
(7, 453476536, 'Ethan', 'Anderson', 'ethan_anderson@example.com', '09176090007', 'Dental Implants', '2024-04-2', '08:15:00', '', 'confirmed', 0),
(8, 296976782, 'Sophia', 'Wilson', 'sophia_wilson@example.com', '09176090008', 'Braces', '2024-04-2', '13:20:00', '', 'confirmed', 0),
(9, 829451207, 'Liam', 'Thomas', 'liam_thomas@example.com', '09176090009', 'Teeth Whitening', '2024-04-2', '16:00:00', '', 'confirmed', 0),
(10, 715390864, 'Isabella', 'Garcia', 'isabella_garcia@example.com', '09176090010', 'Orthodontics', '2024-04-2', '18:30:00', '', 'confirmed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_trend`
--

CREATE TABLE `appointment_trend` (
  `id` int(11) NOT NULL,
  `total_appointment` int(11) DEFAULT NULL,
  `monthly_appointments` int(11) DEFAULT NULL,
  `confirmed_appointment` int(11) DEFAULT NULL,
  `pending_appointment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_trend`
--

INSERT INTO `appointment_trend` (`id`, `total_appointment`, `monthly_appointments`, `confirmed_appointment`, `pending_appointment`) VALUES
(1, 0, 0, 0, 0),
(2, 0, 0, 0, 0),
(3, 0, 0, 0, 0),
(4, 0, 0, 0, 0),
(5, 0, 0, 0, 0),
(6, 0, 0, 0, 0),
(7, 0, 0, 0, 0),
(8, 0, 0, 0, 0),
(9, 0, 0, 0, 0),
(10, 0, 0, 0, 0),
(11, 0, 0, 0, 0),
(12, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

CREATE TABLE `patient_list` (
  `patient_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `baranggay` varchar(255) DEFAULT NULL,
  `city_municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_list`
--

INSERT INTO `patient_list` (`patient_id`, `firstname`, `lastname`, `email`, `phone_number`, `date_of_birth`, `street`, `baranggay`, `city_municipality`, `province`) VALUES
(688110452, 'Franc Alvenn', 'Dela Cruz', 'francalvenndelacruz@gmail.com', '09760900764', '2024-09-24', '374 Halvanz Drv', 'Sulucan', 'Bocaue', 'Bulacan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `auth` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `status`, `auth`) VALUES
(1, 1285204382, 'Receptionist', '(1)', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Offline now', 'Receptionist'),
(2, 1285204383, 'Doc Johnny Mar', 'Cabungon', 'docjohnnymarcabungon@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Offline now', 'Doctor'),
(3, 1285204384, 'IT Administrator', '(1)', 'itadmin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Offline now', 'IT Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_requests`
--
ALTER TABLE `appointment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_trend`
--
ALTER TABLE `appointment_trend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `patient_list`
--
ALTER TABLE `patient_list`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_requests`
--
ALTER TABLE `appointment_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `appointment_trend`
--
ALTER TABLE `appointment_trend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
