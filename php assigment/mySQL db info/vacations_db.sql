-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 13 Μάη 2021 στις 23:26:40
-- Έκδοση διακομιστή: 10.4.18-MariaDB
-- Έκδοση PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `vacations_db`
--
CREATE DATABASE IF NOT EXISTS `vacations_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vacations_db`;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `first_name`, `last_name`, `password`, `email`, `user_type`) VALUES
(3, 8621000, 'admin', 'basilis', 'markou', '123', 'billmarkou94@gmail.com', 'admin'),
(5, 540609407, 'niki', 'nikoletta', 'stathi', '123', 'billmarkou94@gmail.com', 'employee'),
(11, 480440418658, 't', 't', 't', 't', 't', 'employee');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `vacation_requests`
--

CREATE TABLE `vacation_requests` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `vacation_start` date NOT NULL,
  `vacation_end` date NOT NULL,
  `reason` text NOT NULL,
  `days` mediumint(9) NOT NULL,
  `submission_date` datetime NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `vacation_requests`
--

INSERT INTO `vacation_requests` (`id`, `user_id`, `vacation_start`, `vacation_end`, `reason`, `days`, `submission_date`, `status`) VALUES
(9, 480440418658, '2021-05-14', '2021-05-18', 'vacations', 4, '2021-05-13 17:40:10', 'pending'),
(10, 480440418658, '2021-05-26', '2021-05-28', '2nd Vacations', 2, '2021-05-13 17:41:00', 'pending'),
(14, 480440418658, '2021-05-25', '2021-05-28', 'Vacations ', 3, '2021-05-13 22:11:15', 'pending');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Ευρετήρια για πίνακα `vacation_requests`
--
ALTER TABLE `vacation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT για πίνακα `vacation_requests`
--
ALTER TABLE `vacation_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `vacation_requests`
--
ALTER TABLE `vacation_requests`
  ADD CONSTRAINT `vacation_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
