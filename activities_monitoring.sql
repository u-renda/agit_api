-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2016 at 09:39 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `activities_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id_api_keys` int(1) NOT NULL,
  `key` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = inactive, 1 = active',
  `level` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id_api_keys`, `key`, `status`, `level`) VALUES
(1, 'bd6fb882067e6896c1c193376cd419Ir', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id_company` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = inactive, 1 = active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_company`, `name`, `status`, `created_date`, `updated_date`) VALUES
(96503187841744897, 'AGIT', 0, '2016-03-04 13:02:30', '2016-03-04 13:02:30'),
(96511875436511233, 'PT. Telkomsel', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96589912979013633, 'Honda', 1, '2016-05-03 15:08:19', '2016-05-03 15:08:19'),
(96591785551200256, 'coba1', 1, '2016-05-04 15:50:22', '2016-05-04 15:50:22'),
(96591785551200257, 'coba2', 1, '2016-05-04 15:54:45', '2016-05-04 15:54:45'),
(96591785551200258, 'coba3', 1, '2016-05-04 15:55:34', '2016-05-04 15:55:34'),
(96591785551200259, 'coba4', 1, '2016-05-04 15:57:10', '2016-05-04 15:57:10'),
(96591785551200260, 'coba5', 1, '2016-05-04 15:57:45', '2016-05-04 15:57:45'),
(96591785551200261, 'coba6', 1, '2016-05-04 15:59:08', '2016-05-04 15:59:08'),
(96591785551200262, 'coba7', 1, '2016-05-04 15:59:31', '2016-05-04 15:59:31'),
(96591785551200263, 'coba10', 1, '2016-05-04 16:09:27', '2016-05-04 16:09:27'),
(96598902748217344, 'coba49', 1, '2016-05-09 13:49:25', '2016-05-09 13:49:25'),
(96598902748217345, 'coba11', 1, '2016-05-09 14:20:34', '2016-05-09 14:20:34'),
(96598902748217346, 'coba12', 1, '2016-05-09 14:20:59', '2016-05-09 14:20:59'),
(96598902748217347, 'coba13', 1, '2016-05-09 14:21:36', '2016-05-09 14:21:36'),
(96598902748217348, 'coba14', 1, '2016-05-09 14:22:01', '2016-05-09 14:22:01'),
(96598902748217349, 'coba15', 1, '2016-05-09 14:25:39', '2016-05-09 14:25:39'),
(96598902748217350, 'coba16', 1, '2016-05-09 14:26:54', '2016-05-09 14:26:54'),
(96598902748217351, 'coba17', 1, '2016-05-09 14:32:08', '2016-05-09 14:32:08'),
(96598902748217352, 'coba18', 1, '2016-05-09 14:34:41', '2016-05-09 14:34:41'),
(96598902748217353, 'co8', 1, '2016-05-09 14:35:18', '2016-05-09 14:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `job_analyst`
--

CREATE TABLE `job_analyst` (
  `id_job_analyst` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_analyst`
--

INSERT INTO `job_analyst` (`id_job_analyst`, `name`, `description`, `created_date`, `updated_date`) VALUES
(96513057441710093, 'project', 'project yang bla bla bla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96513057441710095, 'operation support', 'melakukan blablabla...', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96548244145831939, 'diganti namanya', 'asdasd', '2016-04-04 12:04:25', '2016-04-04 12:06:16'),
(96598902748217355, 'iii', 'ooooooo', '2016-05-09 16:49:01', '2016-05-09 16:49:01'),
(96598902748217357, '111', '111www', '2016-05-09 17:04:25', '2016-05-09 17:04:25'),
(96598902748217358, '222', '222eee', '2016-05-09 17:05:04', '2016-05-09 17:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `job_role`
--

CREATE TABLE `job_role` (
  `id_job_role` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_role`
--

INSERT INTO `job_role` (`id_job_role`, `name`, `description`, `created_date`, `updated_date`) VALUES
(96513057441710103, 'Project stackholder', 'orang yang menangani blablabla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96513057441710105, 'project manager', 'orang yang mengepalai blablabla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96513057441710107, 'quality control', 'orang yang melakukan blablabla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96513057441710109, 'Developer', 'orang yang membuat blablabla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96513057441710111, 'technical consultan', 'orang yang blablabla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96513057441710113, 'viewer', 'orang yang hanya bisa blablabla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96598902748217356, 'qq', '-', '2016-05-09 16:53:41', '2016-05-09 16:53:41'),
(96598902748217359, 'ddd', 'wdqwd', '2016-05-09 17:06:02', '2016-05-09 17:06:02'),
(96598902748217360, 'xxx', 'xsweh534', '2016-05-09 17:06:39', '2016-05-09 17:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `logging`
--

CREATE TABLE `logging` (
  `id_logging` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logging`
--

INSERT INTO `logging` (`id_logging`, `id_user`, `description`, `created_date`, `updated_date`) VALUES
(96621809788518400, 96588673360855044, 'Login', '2016-05-25 08:56:29', '2016-05-25 08:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id_position` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = inactive, 1 = active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id_position`, `name`, `status`, `created_date`, `updated_date`) VALUES
(96503187841744896, 'Direktur', 1, '2016-03-04 13:01:46', '2016-03-04 13:01:46'),
(96503187841744898, 'Vice President', 1, '2016-03-04 13:09:33', '2016-03-04 13:09:33'),
(96503187841744899, 'General Manager', 1, '2016-03-04 13:09:33', '2016-03-04 13:09:33'),
(96503187841744900, 'Manager', 1, '2016-03-04 13:09:33', '2016-03-04 13:09:33'),
(96503187841744901, 'Supervisor', 1, '2016-03-04 13:09:33', '2016-03-04 13:09:33'),
(96503187841744902, 'Staff', 1, '2016-03-04 13:09:33', '2016-03-04 13:09:33'),
(96503187841744903, 'Trainee', 1, '2016-03-04 13:09:33', '2016-03-04 13:09:33'),
(96513057441710088, 'PHP Senior Programmer', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96598902748217354, 'project2', 1, '2016-05-09 16:09:37', '2016-05-09 16:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `po_name`
--

CREATE TABLE `po_name` (
  `id_po_name` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_name`
--

INSERT INTO `po_name` (`id_po_name`, `name`, `created_date`, `updated_date`) VALUES
(96588673360855041, 'HOP140119', '2016-05-02 13:16:07', '2016-05-02 13:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `id_company` bigint(20) UNSIGNED NOT NULL,
  `id_project_type` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `requirement` text NOT NULL,
  `description` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = closed, 2 = open, 3 = in progress, 4 = delay',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `finished_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `id_company`, `id_project_type`, `name`, `requirement`, `description`, `division`, `department`, `status`, `start_date`, `end_date`, `finished_date`, `created_date`, `updated_date`) VALUES
(96563851453005826, 96511875436511233, 96517482667311111, 'Medical', '', '', 'IT Planning', 'IT Change Management', 2, '2016-01-01', '2016-08-08', '0000-00-00', '2016-04-15 15:56:50', '2016-04-15 15:56:50'),
(96563851453005828, 96511875436511233, 96517482667311111, 'Dashboard', '', '', 'IT SM', 'IT SQM', 2, '2016-01-01', '2016-08-08', '0000-00-00', '2016-04-15 16:08:01', '2016-04-15 16:08:01'),
(96563851453005831, 96511875436511233, 96517482667311111, 'third project', '', '', 'IT', 'IT', 2, '2016-02-02', '2016-06-06', '0000-00-00', '2016-04-15 18:27:58', '2016-04-15 18:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `project_doc`
--

CREATE TABLE `project_doc` (
  `id_project_doc` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` tinyint(1) NOT NULL COMMENT '1 = user documentation, 2 = technical documentation',
  `description` text NOT NULL,
  `url` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_issue`
--

CREATE TABLE `project_issue` (
  `id_project_issue` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `id_project_task` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_issued` bigint(20) UNSIGNED NOT NULL,
  `category` tinyint(1) NOT NULL COMMENT '1 = critical, 2 = major, 3 = minor',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = completed, 2 = in progress',
  `end_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_task`
--

CREATE TABLE `project_task` (
  `id_project_task` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = completed, 2 = delay',
  `group_task` tinyint(1) NOT NULL COMMENT '1 = initiating, 2 = planning, 3 = executing, 4 = closing',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `finished_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `id_project_type` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_type`
--

INSERT INTO `project_type` (`id_project_type`, `name`, `created_date`, `updated_date`) VALUES
(96517482667311105, 'New App', '2016-03-14 04:30:20', '2016-03-14 04:30:20'),
(96517482667311107, 'Add Module / Function', '2016-03-14 04:30:39', '2016-03-14 04:30:39'),
(96517482667311109, 'Change Requests', '2016-03-14 04:30:53', '2016-03-14 04:30:53'),
(96517482667311111, 'Maintenance', '2016-03-14 04:31:09', '2016-03-14 04:31:09'),
(96523343317958683, 'others', '2016-03-18 10:05:05', '2016-03-18 10:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id_project_user` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_job_role` bigint(20) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id_project_user`, `id_project`, `id_user`, `id_job_role`, `created_date`, `updated_date`) VALUES
(96588673360855045, 96563851453005826, 96588673360855044, 96513057441710109, '2016-05-02 14:08:43', '2016-05-02 14:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `project_visit`
--

CREATE TABLE `project_visit` (
  `id_project_visit` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_project_task` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = requested, 2 = approved',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_position` bigint(20) UNSIGNED NOT NULL,
  `id_company` bigint(20) UNSIGNED NOT NULL,
  `id_po_name` bigint(20) UNSIGNED NOT NULL,
  `id_user_project_group` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1 = Administrator, 2 = Project Manager, 3 = Developer, 4 = Quality Control, 5 = Viewer, 6 = Project Stackholder',
  `nik` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = inactive, 1 = active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_position`, `id_company`, `id_po_name`, `id_user_project_group`, `email`, `username`, `password`, `name`, `role`, `nik`, `photo`, `status`, `created_date`, `updated_date`) VALUES
(96588673360855044, 96513057441710088, 96503187841744897, 96588673360855041, 96588673360855042, 'yurenda.basulandari@ag-it.com', 'u_renda', 'b85b1fcbb29b749cfe4fc2904a4ba03b', 'Yurenda', 1, '', '', 2, '2016-05-02 13:21:48', '2016-05-02 13:21:48'),
(96589912979013632, 96503187841744896, 96503187841744897, 96588673360855041, 96588673360855042, 'admin@blabla.com', 'admin', 'a8f5f167f44f4964e6c998dee827110c', 'admin', 1, '1', 'http://localhost/upload_agit/user/c70749db2d23a9bde9a3a7c1a49bab2d.jpg', 2, '2016-05-03 14:14:05', '2016-05-03 14:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_complaint`
--

CREATE TABLE `user_complaint` (
  `id_user_complaint` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL COMMENT 'user yang di complaint',
  `id_complained` bigint(20) UNSIGNED NOT NULL COMMENT 'user yang melakukan complaint',
  `name` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = technical, 2 = non technical',
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_overtime`
--

CREATE TABLE `user_overtime` (
  `id_user_overtime` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_project` bigint(20) UNSIGNED NOT NULL,
  `id_project_task` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = overtime, 2 = standby, 3 = on call, 4 = piket',
  `category` tinyint(1) NOT NULL COMMENT '1 = workday, 2 = holiday',
  `description` text NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = requested, 2 = confirmed',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_project_group`
--

CREATE TABLE `user_project_group` (
  `id_user_project_group` bigint(20) UNSIGNED NOT NULL,
  `id_job_analyst` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = closed, 1 = open',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_project_group`
--

INSERT INTO `user_project_group` (`id_user_project_group`, `id_job_analyst`, `name`, `description`, `status`, `created_date`, `updated_date`) VALUES
(96588673360855042, 96513057441710093, 'IT Business Partner', '', 1, '2016-05-02 13:18:11', '2016-05-02 13:18:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id_api_keys`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`),
  ADD KEY `username` (`name`);

--
-- Indexes for table `job_analyst`
--
ALTER TABLE `job_analyst`
  ADD PRIMARY KEY (`id_job_analyst`);

--
-- Indexes for table `job_role`
--
ALTER TABLE `job_role`
  ADD PRIMARY KEY (`id_job_role`);

--
-- Indexes for table `logging`
--
ALTER TABLE `logging`
  ADD PRIMARY KEY (`id_logging`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`),
  ADD KEY `username` (`name`);

--
-- Indexes for table `po_name`
--
ALTER TABLE `po_name`
  ADD PRIMARY KEY (`id_po_name`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `project_doc`
--
ALTER TABLE `project_doc`
  ADD PRIMARY KEY (`id_project_doc`),
  ADD KEY `id_project` (`id_project`);

--
-- Indexes for table `project_issue`
--
ALTER TABLE `project_issue`
  ADD PRIMARY KEY (`id_project_issue`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_project_task` (`id_project_task`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `project_task`
--
ALTER TABLE `project_task`
  ADD PRIMARY KEY (`id_project_task`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`id_project_type`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id_project_user`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_job_role` (`id_job_role`);

--
-- Indexes for table `project_visit`
--
ALTER TABLE `project_visit`
  ADD PRIMARY KEY (`id_project_visit`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_project_task` (`id_project_task`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `username` (`username`),
  ADD KEY `id_position` (`id_position`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `id_user_project_group` (`id_user_project_group`),
  ADD KEY `id_po_name` (`id_po_name`);

--
-- Indexes for table `user_complaint`
--
ALTER TABLE `user_complaint`
  ADD PRIMARY KEY (`id_user_complaint`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_overtime`
--
ALTER TABLE `user_overtime`
  ADD PRIMARY KEY (`id_user_overtime`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_project_task` (`id_project_task`);

--
-- Indexes for table `user_project_group`
--
ALTER TABLE `user_project_group`
  ADD PRIMARY KEY (`id_user_project_group`),
  ADD KEY `id_job_analyst` (`id_job_analyst`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id_api_keys` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `job_analyst`
--
ALTER TABLE `job_analyst`
  MODIFY `id_job_analyst` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `job_role`
--
ALTER TABLE `job_role`
  MODIFY `id_job_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `logging`
--
ALTER TABLE `logging`
  MODIFY `id_logging` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id_position` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `po_name`
--
ALTER TABLE `po_name`
  MODIFY `id_po_name` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `project_doc`
--
ALTER TABLE `project_doc`
  MODIFY `id_project_doc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_issue`
--
ALTER TABLE `project_issue`
  MODIFY `id_project_issue` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_task`
--
ALTER TABLE `project_task`
  MODIFY `id_project_task` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `id_project_type` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id_project_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `project_visit`
--
ALTER TABLE `project_visit`
  MODIFY `id_project_visit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `user_complaint`
--
ALTER TABLE `user_complaint`
  MODIFY `id_user_complaint` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_overtime`
--
ALTER TABLE `user_overtime`
  MODIFY `id_user_overtime` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_project_group`
--
ALTER TABLE `user_project_group`
  MODIFY `id_user_project_group` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `logging`
--
ALTER TABLE `logging`
  ADD CONSTRAINT `logging_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_doc`
--
ALTER TABLE `project_doc`
  ADD CONSTRAINT `project_doc_ibfk` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_issue`
--
ALTER TABLE `project_issue`
  ADD CONSTRAINT `project_issue_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_issue_ibfk_2` FOREIGN KEY (`id_project_task`) REFERENCES `project_task` (`id_project_task`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_issue_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_task`
--
ALTER TABLE `project_task`
  ADD CONSTRAINT `FK_project_task` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_task_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_user_ibfk_3` FOREIGN KEY (`id_job_role`) REFERENCES `job_role` (`id_job_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_visit`
--
ALTER TABLE `project_visit`
  ADD CONSTRAINT `project_visit_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_visit_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_visit_ibfk_3` FOREIGN KEY (`id_project_task`) REFERENCES `project_task` (`id_project_task`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `position` (`id_position`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_po_name`) REFERENCES `po_name` (`id_po_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`id_user_project_group`) REFERENCES `user_project_group` (`id_user_project_group`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_complaint`
--
ALTER TABLE `user_complaint`
  ADD CONSTRAINT `user_complaint_ibfk` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_overtime`
--
ALTER TABLE `user_overtime`
  ADD CONSTRAINT `user_overtime_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_overtime_ibfk_2` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_overtime_ibfk_3` FOREIGN KEY (`id_project_task`) REFERENCES `project_task` (`id_project_task`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_project_group`
--
ALTER TABLE `user_project_group`
  ADD CONSTRAINT `user_project_group_ibfk_1` FOREIGN KEY (`id_job_analyst`) REFERENCES `job_analyst` (`id_job_analyst`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
