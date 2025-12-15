-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 07:12 AM
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
-- Database: `task_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` bigint(20) UNSIGNED NOT NULL,
  `TaskID` bigint(20) UNSIGNED NOT NULL,
  `UserID` bigint(20) UNSIGNED NOT NULL,
  `CommentText` text NOT NULL,
  `DatePosted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `TaskID`, `UserID`, `CommentText`, `DatePosted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'I have started setting up the development environment. Will have the initial setup done by tomorrow.', '2025-12-10 19:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(2, 1, 1, 'Great! Please make sure to include all dependencies in the documentation.', '2025-12-10 21:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(3, 2, 4, 'I found the issue! The connection pool size was too small. Fixing it now.', '2025-12-10 22:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(4, 2, 2, 'Excellent work, Bob! Please test it thoroughly before merging.', '2025-12-10 23:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(5, 3, 3, 'Started working on the user documentation. Should be ready by end of week.', '2025-12-10 20:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentID` bigint(20) UNSIGNED NOT NULL,
  `DepartmentName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentID`, `DepartmentName`, `created_at`, `updated_at`) VALUES
(1, 'IT', '2025-12-10 23:52:33', '2025-12-10 23:52:33'),
(3, 'HR', '2025-12-10 23:56:25', '2025-12-10 23:56:25'),
(4, 'Human Resources', '2025-12-11 00:17:15', '2025-12-11 00:17:15'),
(5, 'Finance', '2025-12-11 00:25:56', '2025-12-11 00:25:56'),
(6, 'Sales', '2025-12-11 00:27:36', '2025-12-11 00:27:36'),
(7, 'Marketing', '2025-12-11 00:27:36', '2025-12-11 00:27:36'),
(8, 'Operations', '2025-12-11 00:27:36', '2025-12-11 00:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_11_000001_create_departments_table', 1),
(2, '2025_12_11_000002_create_users_table', 1),
(3, '2025_12_11_000003_create_tasks_table', 1),
(4, '2025_12_11_000004_create_comments_table', 1),
(5, '2025_12_11_000005_create_reports_table', 1),
(6, '2025_12_11_000006_create_report_tasks_table', 1),
(7, '2025_12_11_000007_create_system_parameters_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ReportID` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `CreatedBy` bigint(20) UNSIGNED NOT NULL,
  `DateGenerated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`ReportID`, `Title`, `CreatedBy`, `DateGenerated`, `created_at`, `updated_at`) VALUES
(1, 'Weekly Progress Report - Week 1', 1, '2025-12-08 00:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(2, 'Monthly Status Report - December 2025', 2, '2025-12-10 00:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(3, 'Q4 Development Summary', 1, '2025-12-11 00:27:38', '2025-12-11 00:27:38', '2025-12-11 00:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `report_tasks`
--

CREATE TABLE `report_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ReportID` bigint(20) UNSIGNED NOT NULL,
  `TaskID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_parameters`
--

CREATE TABLE `system_parameters` (
  `ParameterID` bigint(20) UNSIGNED NOT NULL,
  `ParameterType` varchar(255) NOT NULL,
  `ParameterValue` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_parameters`
--

INSERT INTO `system_parameters` (`ParameterID`, `ParameterType`, `ParameterValue`, `created_at`, `updated_at`) VALUES
(1, 'max_task_deadline_days', '90', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(2, 'default_task_priority', 'medium', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(3, 'system_admin_email', 'admin@example.com', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(4, 'notification_enabled', 'true', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(5, 'task_auto_archive_days', '30', '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(6, 'max_users_per_department', '50', '2025-12-11 00:27:38', '2025-12-11 00:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Priority` varchar(255) NOT NULL DEFAULT 'medium',
  `Status` varchar(255) NOT NULL DEFAULT 'pending',
  `Deadline` datetime DEFAULT NULL,
  `CreatedBy` bigint(20) UNSIGNED NOT NULL,
  `AssignedTo` bigint(20) UNSIGNED DEFAULT NULL,
  `DepartmentID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskID`, `Title`, `Description`, `Priority`, `Status`, `Deadline`, `CreatedBy`, `AssignedTo`, `DepartmentID`, `created_at`, `updated_at`) VALUES
(1, 'Setup Development Environment', 'Configure development environment with necessary tools and dependencies', 'high', 'in_progress', '2025-12-14 08:27:38', 1, 2, 1, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(2, 'Fix Database Connection Bug', 'There is a connection timeout issue in the database module', 'critical', 'in_progress', '2025-12-12 08:27:38', 2, 4, 1, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(3, 'Create User Documentation', 'Write comprehensive documentation for end users', 'medium', 'pending', '2025-12-18 08:27:38', 1, 3, 4, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(4, 'Update Financial Reports', 'Prepare Q4 financial reports and analysis', 'high', 'pending', '2025-12-16 08:27:38', 1, 4, 5, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(5, 'Implement API Rate Limiting', 'Add rate limiting to prevent API abuse', 'medium', 'pending', '2025-12-21 08:27:38', 2, 2, 1, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(6, 'Team Meeting - Project Status', 'Quarterly meeting to discuss project status and roadmap', 'medium', 'completed', '2025-12-10 08:27:38', 1, 5, 1, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(7, 'Security Audit', 'Perform security audit and vulnerability assessment', 'critical', 'in_progress', '2025-12-13 08:27:38', 1, NULL, 1, '2025-12-11 00:27:38', '2025-12-11 00:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'active',
  `DepartmentID` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Email`, `Role`, `Status`, `DepartmentID`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', 'active', 1, NULL, '$2y$12$DzrYGm7REu8T6TzW847FmO0.9MyM9b1s9T5JWbDKGzOcOFh7Xy7U6', NULL, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(2, 'John Manager', 'john@example.com', 'manager', 'active', 1, NULL, '$2y$12$PqlvnzNnO0jsbsBc8xPqTOj1wdzt1QFIILJA4DQzE/vh8i1XgtEN2', NULL, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(3, 'Jane Smith', 'jane@example.com', 'user', 'active', 4, NULL, '$2y$12$aZnxAAmntg2e4f4mB.MIe.oNTZ1Ib2NuR91fhyvZjWCN0t9zpJ.Ty', NULL, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(4, 'Bob Johnson', 'bob@example.com', 'user', 'active', 5, NULL, '$2y$12$ZZUfDfdUf7sCvgLXxJ4PI.GZ3MUHNCpmsD/CYFgxaBT8y5MeNW.e2', NULL, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(5, 'Alice Williams', 'alice@example.com', 'user', 'active', 6, NULL, '$2y$12$80ED1eAEc9y5Mv4DBKS64OPlfo9hNjhhMWGEkyq9Myu1LGe15CQeC', NULL, '2025-12-11 00:27:38', '2025-12-11 00:27:38'),
(6, 'Charlie Brown', 'charlie@example.com', 'user', 'active', 1, NULL, '$2y$12$//rO1VNPRhP9Bgm7rRND0u8Z1B9KC8FKEISGvkxY.Qg8rt2FbUyCS', NULL, '2025-12-11 00:27:38', '2025-12-11 00:27:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `comments_taskid_foreign` (`TaskID`),
  ADD KEY `comments_userid_foreign` (`UserID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentID`),
  ADD UNIQUE KEY `departments_departmentname_unique` (`DepartmentName`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `reports_createdby_foreign` (`CreatedBy`);

--
-- Indexes for table `report_tasks`
--
ALTER TABLE `report_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_tasks_reportid_foreign` (`ReportID`),
  ADD KEY `report_tasks_taskid_foreign` (`TaskID`);

--
-- Indexes for table `system_parameters`
--
ALTER TABLE `system_parameters`
  ADD PRIMARY KEY (`ParameterID`),
  ADD UNIQUE KEY `system_parameters_parametertype_unique` (`ParameterType`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `tasks_createdby_foreign` (`CreatedBy`),
  ADD KEY `tasks_assignedto_foreign` (`AssignedTo`),
  ADD KEY `tasks_departmentid_foreign` (`DepartmentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `users_email_unique` (`Email`),
  ADD KEY `users_departmentid_foreign` (`DepartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `ReportID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report_tasks`
--
ALTER TABLE `report_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_parameters`
--
ALTER TABLE `system_parameters`
  MODIFY `ParameterID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_taskid_foreign` FOREIGN KEY (`TaskID`) REFERENCES `tasks` (`TaskID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_userid_foreign` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_createdby_foreign` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `report_tasks`
--
ALTER TABLE `report_tasks`
  ADD CONSTRAINT `report_tasks_reportid_foreign` FOREIGN KEY (`ReportID`) REFERENCES `reports` (`ReportID`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_tasks_taskid_foreign` FOREIGN KEY (`TaskID`) REFERENCES `tasks` (`TaskID`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assignedto_foreign` FOREIGN KEY (`AssignedTo`) REFERENCES `users` (`UserID`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_createdby_foreign` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_departmentid_foreign` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_departmentid_foreign` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
