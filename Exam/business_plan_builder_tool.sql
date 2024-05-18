-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 05:22 PM
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
-- Database: `business_plan_builder_tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `attachment_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`attachment_id`, `plan_id`, `section_id`, `file_name`, `created_at`) VALUES
(1, 2, 21, 'business_plan.pdf', '2024-04-29 22:00:00'),
(2, 3, 22, 'financial_projections.pdf', '2024-04-29 22:00:00'),
(3, 4, 23, 'proposal.pdf', '2024-04-29 22:00:00'),
(4, 5, 24, 'attachment5.pdf', '2024-04-29 22:00:00'),
(7, 5, 24, 'file4.pdf', '2024-04-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_plans`
--

CREATE TABLE `business_plans` (
  `plan_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_plans`
--

INSERT INTO `business_plans` (`plan_id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'Business Plan 2', '2024-04-29 22:00:00', '2024-04-29 22:00:00'),
(3, 'Business Plan 3', '2024-04-29 22:00:00', '2024-04-29 22:00:00'),
(4, 'Business Plan 4', '2024-04-29 22:00:00', '2024-04-29 22:00:00'),
(5, 'Business Plan 5', '2024-04-29 22:00:00', '2024-04-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `collaborators`
--

CREATE TABLE `collaborators` (
  `collaboration_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collaborators`
--

INSERT INTO `collaborators` (`collaboration_id`, `plan_id`, `role`, `created_at`) VALUES
(1, 2, 'viewer', '2024-04-29 22:00:00'),
(2, 3, 'editor', '2024-04-29 22:00:00'),
(3, 4, 'viewer', '2024-04-29 22:00:00'),
(5, 5, 'editor', '2024-04-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `plan_id`, `section_id`, `comment_text`, `created_at`) VALUES
(3, 2, 21, 'Comment for user 2, plan 2, section 21', '2024-05-01 12:14:27'),
(4, 3, 22, 'Comment for user 3, plan 3, section 22', '2024-05-01 12:14:38'),
(5, 4, 23, 'Comment for user 4, plan 4, section 23', '2024-05-01 12:14:51'),
(6, 5, 24, 'Comment for user 5, plan 5, section 24', '2024-05-01 12:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `plan_id`, `section_id`, `rating`, `created_at`) VALUES
(1, 2, 22, 4, '2024-05-01 12:28:49'),
(2, 3, 23, 5, '2024-05-01 12:28:49'),
(3, 4, 24, 4, '2024-05-01 12:28:49'),
(5, 3, 24, 5, '2024-05-01 12:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `target_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goal_id`, `plan_id`, `description`, `target_date`, `status`, `created_at`) VALUES
(1, 2, 'Launch new product line', '2024-10-01', 'In progress', '2024-05-01 12:27:58'),
(2, 2, 'Expand into new markets', '2025-03-01', 'Not started', '2024-05-01 12:27:58'),
(3, 3, 'Secure funding for project', '2024-07-01', 'Completed', '2024-05-01 12:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_index` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `plan_id`, `title`, `order_index`, `created_at`) VALUES
(21, 2, 'Market Analysis', 2, '2024-04-29 22:00:00'),
(22, 3, 'Financial Projections', 3, '2024-04-29 22:00:00'),
(23, 4, 'Marketing Strategy', 4, '2024-04-29 22:00:00'),
(24, 5, 'Operational Plan', 5, '2024-04-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `plan_id`, `section_id`, `description`, `due_date`, `created_at`) VALUES
(1, 2, 21, 'Complete task for plan 2, section 21', '2024-05-10', '2024-05-01 12:24:32'),
(2, 3, 22, 'Complete task for plan 3, section 22', '2024-05-05', '2024-05-01 12:24:42'),
(3, 4, 23, 'Complete task for plan 4, section 23', '2024-05-15', '2024-05-01 12:24:52'),
(4, 5, 24, 'Complete task for plan 5, section 24', '2024-05-12', '2024-05-01 12:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `template_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`template_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Detailed Business Plan', 'A comprehensive business plan template', '2024-04-29 22:00:00', '2024-04-29 22:00:00'),
(3, 'Startup Business Plan', 'A business plan template for startups', '2024-04-29 22:00:00', '2024-04-29 22:00:00'),
(4, 'Financial Business Plan', 'A business plan focused on financial aspects', '2024-04-29 22:00:00', '2024-04-29 22:00:00'),
(5, 'Sales Business Plan', 'A business plan focusing on sales strategies', '2024-04-29 22:00:00', '2024-04-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `business_plans`
--
ALTER TABLE `business_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`collaboration_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `business_plans`
--
ALTER TABLE `business_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `collaboration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `business_plans` (`plan_id`),
  ADD CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `business_plans` (`plan_id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `business_plans` (`plan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
