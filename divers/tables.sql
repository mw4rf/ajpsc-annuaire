-- Adminer 3.6.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` text NOT NULL,
  `adminpass` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo` longblob NOT NULL,
  `extension` varchar(5) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `promotion` int(11) NOT NULL DEFAULT '0',
  `nationalite` text NOT NULL,
  `naissance` date NOT NULL DEFAULT '0000-00-00',
  `adresse` text NOT NULL,
  `email` text NOT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `q5` text NOT NULL,
  `q6` text NOT NULL,
  `q7` text NOT NULL,
  `secret_question` text NOT NULL,
  `secret_reponse` text NOT NULL,
  `modif` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `ftindex` (`q1`,`q2`,`q3`,`q4`,`q5`,`q6`,`q7`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2013-02-15 18:11:31