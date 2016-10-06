-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2016 at 06:56 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pro-sos-pets`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estadosigla` varchar(40) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_PK` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `estadosigla`, `nome`, `status`, `dataatualizacao`, `datacriacao`) VALUES
(1, 'RS', 'Porto Alegre', 1, NULL, '2016-10-06 00:00:00'),
(2, 'SC', 'Santa Catarina', 1, NULL, '2016-10-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE IF NOT EXISTS `pet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `raca` varchar(40) NOT NULL,
  `porte` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pet_user_FK` (`user_id`),
  KEY `pet_city_FK` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `path` varchar(100) NOT NULL,
  `default` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_pet_FK` (`pet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_PK` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_city_FK` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `pet_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_pet_FK` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`);
