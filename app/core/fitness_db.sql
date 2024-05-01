-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 05:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_db`
--
CREATE DATABASE IF NOT EXISTS `fitness_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitness_db`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `title`, `description`, `date`, `startTime`, `endTime`) VALUES
(1, 'Yoga 101', 'An introductory class that specializes in foundational yoga techniques.', '2024-04-18', '00:00:00', '00:00:00'),
(2, 'Meditation Workshop', 'Learn various meditation techniques to promote mindfulness and relaxation.', '2024-04-20', '10:00:00', '12:00:00'),
(3, 'Pilates for Beginners', 'A beginner-friendly Pilates class focusing on core strength and flexibility.', '2024-04-24', '18:30:00', '20:00:00'),
(4, 'Cardio Kickboxing', 'High-intensity cardio workout combined with martial arts moves.', '2024-05-05', '17:00:00', '18:30:00'),
(5, 'Tai Chi for Stress Relief', 'Gentle movements and breathing exercises to reduce stress and improve balance.', '2024-05-10', '09:30:00', '11:00:00'),
(6, 'Hatha Yoga Flow', 'A dynamic yoga class emphasizing breath with movement.', '2024-05-15', '19:00:00', '20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` mediumint(9) NOT NULL,
  `name` char(50) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `rating` int(1) DEFAULT NULL COMMENT 'Product star rating 1-5',
  `description` varchar(5000) DEFAULT NULL,
  `onSale` tinyint(1) DEFAULT NULL COMMENT 'If the item is on sale: 1, otherwise 0.',
  `discountPrice` decimal(6,2) DEFAULT NULL COMMENT 'The product discounted price',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `name`, `price`, `rating`, `description`, `onSale`, `discountPrice`, `image`) VALUES
(1, 'Dumbbell Set (10 lbs)', 30.00, 4, 'Pair of 10-pound dumbbells for strength training.', 1, 25.00, '/assets/DumbbellSet.jpg'),
(2, 'Yoga Mat', 20.00, 5, 'Non-slip yoga mat for comfortable floor exercises.', 0, 0.00, '/assets/yoga%20mat.jpg'),
(3, 'Resistance Bands Set', 40.00, 3, 'Set of resistance bands for full-body workouts.', 1, 30.00, '/assets/complete-band-pack.jpeg'),
(4, 'Jump Rope', 9.99, 5, 'Adjustable jump rope for cardio and agility training.', NULL, NULL, '/assets/jump%20ropes.jpg'),
(5, 'Foam Roller', 25.00, 5, 'High-density foam roller for muscle recovery and flexibility exercises.', 0, 0.00, '/assets/best-foam-rollers-scaled.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `roleID` int(11) NOT NULL,
  `role` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Stores all of the potential roles a user can have';

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`roleID`, `role`) VALUES
(0, 'Basic'),
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `userName`, `password`, `roleID`) VALUES
(1, 'Jalen', 'Vaughn', 'javaugh@iu.edu', 'javaugh', '$2y$10$SQqkNaKROuWpyGb07QlrZ.cg3fqMuxZKYiOgMQqt/khGfpJSi2Qf.', 1),
(5, 'Ran', 'Chang', 'ranchang@iupui.edu', 'ranchang', '$2y$10$./8nYF2Y6Z1usZRpaa3U1.LJtKNXzXiWeOcAKU1LLDREzBIpTkB2S', 0),
(6, 'admin', 'admin', 'admin@admin.com', 'admin', '$2y$10$MLsYdbWVR7YQePe0YPRXnO0aznxYIwj051O4PUR/EutHDsLv5E/Ze', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `role` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK` FOREIGN KEY (`roleID`) REFERENCES `userroles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
