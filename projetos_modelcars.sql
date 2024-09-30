-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Set-2024 às 00:13
-- Versão do servidor: 5.7.40
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetos_modelcars`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` varchar(128) NOT NULL,
  `leftTxtBlock` text NOT NULL,
  `rightTxtBlock` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `about`
--

INSERT INTO `about` (`id`, `hid`, `leftTxtBlock`, `rightTxtBlock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '917eead3d3658a2e3f8bf9a7261b08ae6dfec33c', 'LEFT', 'RIGHT', '2024-09-23 23:07:13', '2024-09-23 23:07:13', NULL),
(2, 'e3b63c0bae0bf8046855732aa9b3236653629015d1fd36a2735c21b58648322793f2a660e7d011e15362901518737547766f47328d0bb8', '<p><br></p>', '<p><br></p>', '2024-09-25 17:31:36', '2024-09-25 17:31:36', NULL),
(3, '75d6aaaa9d0fee18f4fae9070b5bee6834160934a7f561ff0e9c36d936cc13a5911b144748e421ad34160934165428870066f473f9f2d28', '<h3><br></h3>', '<p><br></p>', '2024-09-25 17:35:05', '2024-09-25 17:35:05', '2024-09-25 17:38:20'),
(4, '2b03434efca70426fd94f1aed72a205574839903744990c68026baa35b031131887e49ee54c7d6b37483990385650540866f49ee8101eb', '<p><br></p>', '<p><br></p>', '2024-09-25 20:38:16', '2024-09-25 20:38:16', '2024-09-29 20:18:30'),
(5, '77bea2afb19a9eed15128232d1b061fa936814334b38572d5cfb53960de63274b81f2cb51ffc3c39368143122968506366f9ec81a3d6a', '<p><br></p>', '<p><br></p>', '2024-09-29 21:10:41', '2024-09-29 21:10:41', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` varchar(128) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Admins do site';

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `hid`, `name`, `user`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3701c22dfe029359df72dd1c434acca3445c7caf', 'Delmir Sobrinho', 'Delmir', '$2y$10$FRFiPlrNK4tBmRuHG6oqWOh5NYLC6.yJg4BfrMGMQALUD52p6QGvS', '2024-09-19 15:04:40', '2024-09-23 18:08:27', NULL),
(2, 'bc832fb30e641fb4b7d9df5bb83cc9a29666301269ff82455d7ac5dde0bded49ebecfde9e4bc4e3d96663012133837937166f085e60eb6b', 'Ney Jr.', 'ney', '$2y$10$RoImLytPo83APBWMILP83uU2FNbJTIg2XetUaJ91Q4OE9Vh7V8RFq', '2024-09-22 21:02:30', '2024-09-22 18:20:07', '2024-09-22 19:39:26'),
(3, '16034d1207307acd4eb4a4731a2030e746736814b207e915bdce6e48349c607c5495af8d6b32d49f46736814103880406666f089fa9b0ae', 'NoÃªmio', 'noemio', '$2y$10$I0qtejxjNT4eiKGorXiUgOEhkizW2AhigMzyEqTotCcZc1mpm6VFC', '2024-09-22 21:19:54', '2024-09-22 18:19:54', '2024-09-22 19:38:52'),
(4, 'c69028c7f95b66ab65ea5c6790d69cfa9395104993485a0ab3fe7f0a4eeb8a1940fac3aed5590ce593951049172310632166f0900f5ae0f', 'XismÃ©lio', 'xismelio', '$2y$10$7rx35WUihdaONgRxwE/fj.PcTzUaL6BDiUTX2UXVLJkDWrA7Yu4MK', '2024-09-22 21:45:51', '2024-09-22 18:45:51', '2024-09-22 19:38:10'),
(5, '8eda41c69934a5f5db3bd41515bc5a7a80250313c82089e9f939125970658abcf0d320c16eadb40b80250313207971799666f09a45620dd', 'Negreto', 'babarloo', '$2y$10$txVsHluBIpE/jc4SKDew0eand5p15UlrOqlx2TH/CkJYvrQqwy1FS', '2024-09-22 22:29:25', '2024-09-25 20:38:02', NULL),
(6, 'a39a979132f4d84af477628583782fd09653562715c012dd3511fa0b35172ddf4aa50e08fb81ec5d96535627101599823866f0a35ad7730', 'Niildo Pan Keca', 'NildoXaruto', '$2y$10$4N5VHZ.Y6nraP8UIxZ.teODyaDPw2L48kxmlCuhsDx4ib7LTjt4Yu', '2024-09-22 23:08:10', '2024-09-23 11:44:38', NULL),
(7, '23cb123ba0e87ada42cff76af7bc0e45835395503a8ee4d23faa6163e811df687cd58e1ca079f9438353955063969329166f0a48911403', 'Criola', 'criolinha', '$2y$10$/wTbWhaPoMgvQb3w54lQtOgrtprifBbHL4dBosgkaqfzSUvAaF.Lu', '2024-09-22 23:13:13', '2024-09-22 20:13:13', '2024-09-22 20:15:55'),
(8, '48e13916146ae02c82259baeeb8db666327042123698c1a9dc5b5ae3b87ae8d7880410c9a0ca92f73270421276777722766f1dba9a9f77', 'Sagu Clandestino Palhares', 'Sagu', '$2y$10$bUxf1xGKGYn0jj7w2hZwiuLPtP0ucW0MUV0ZbJVnIbjqQGykmVOBq', '2024-09-23 21:20:41', '2024-09-23 18:20:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `page_id` int(11) NOT NULL,
  `banner_name` varchar(255) NOT NULL,
  `area` enum('left','center','right') NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mags`
--

DROP TABLE IF EXISTS `mags`;
CREATE TABLE IF NOT EXISTS `mags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` varchar(128) NOT NULL,
  `number` int(11) NOT NULL,
  `publication_date` date NOT NULL,
  `cover` varchar(200) NOT NULL,
  `mag` varchar(200) NOT NULL,
  `atual` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mags`
--

INSERT INTO `mags` (`id`, `hid`, `number`, `publication_date`, `cover`, `mag`, `atual`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0d1c960abc16b65a3f71e9584a18fa62', 1, '2024-08-26', 'ed_1.jpg', 'ed_1.pdf', 'F', '2024-09-29 22:45:49', '2024-09-29 22:45:49', NULL),
(2, '846b08898f2490b87ba29d449678b0dc', 2, '2024-09-23', 'ed_2.jpg', 'ed_2.pdf', 'T', '2024-09-29 23:12:57', '2024-09-30 00:12:09', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menutopo`
--

DROP TABLE IF EXISTS `menutopo`;
CREATE TABLE IF NOT EXISTS `menutopo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_item` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `page` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `menutopo`
--

INSERT INTO `menutopo` (`id`, `menu_item`, `slug`, `page`) VALUES
(1, 'Home', 'home', 1),
(2, 'About', 'about', 2),
(3, 'New', 'new', 3),
(4, 'Past Issues', 'past_issues', 4),
(5, 'Printed Copies', 'printed-copies', 5),
(6, 'Merchandising', 'merchandising', 6),
(7, 'Contact', 'contact', 7),
(8, 'Login', 'login', 8),
(9, 'Subscribe', 'subscribe', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pages`
--

INSERT INTO `pages` (`id`, `page`, `slug`, `keywords`, `description`) VALUES
(1, 'Home', 'home', 'model cars, model car racing, fun', 'Home Page'),
(2, 'About', 'about', 'model cars, model car racing, fun', 'We are fanatic about Model Car Racing'),
(3, 'New', 'new', 'model cars, model car racing, fun', 'See our new release editions.'),
(4, 'Past Issues', 'past_issues', 'model cars, model car racing, fun', 'See all about our past issues.'),
(5, 'Printed Copies', 'printed-copies', 'model cars, model car racing, fun', 'View our printed copies.'),
(6, 'Merchandising', 'merchandising', 'model cars, model car racing, fun', 'Let\'s make business.'),
(7, 'Contact', 'contact', 'model cars, model car racing, fun', 'Contact us.'),
(8, 'Login', 'login', 'model cars, model car racing, fun', 'Login our restrict area'),
(9, 'Subscribe', 'subscribe', 'model cars, model car racing, fun', 'Subscribe and have access to our editions and all our content.'),
(10, 'Forgot Password', 'forgot_password', 'Forgot Password, Password', 'Remember forgotten Passwprd'),
(11, 'Painel', 'painel', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` varchar(128) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Usuários (clientes) do site';

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `hid`, `name`, `user`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0d2b38660a03ad02b27f982a7176dc479d3a0a75', 'Delmir Teste', 'Delmir', '$2y$10$Fg36y0j/IYqyh5aGcGsW.e7jtCfw8zzBtJlGkl5ZSdJ6gvVe5OL4.$2y$10$XPfXwm8EXJ3oTkJjMetR0ukhsyXD9FQ.dgQKfTLJLrvRNmjJNELUa', '2024-09-19 01:19:00', '2024-09-19 01:19:00', NULL);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
