-- Task Management System - SQL Dump
-- Created for Cytonn 2026 Internship Coding Challenge

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `tasks`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','in_progress','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tasks_title_due_date_unique` (`title`,`due_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Initial demonstration data
-- --------------------------------------------------------

INSERT INTO `tasks` (`id`, `title`, `due_date`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Project Documentation', '2026-04-05', 'high', 'pending', NOW(), NOW()),
(2, 'Code Review Phase 1', '2026-04-02', 'medium', 'in_progress', NOW(), NOW()),
(3, 'Submit Timesheets', '2026-03-31', 'low', 'done', NOW(), NOW());
