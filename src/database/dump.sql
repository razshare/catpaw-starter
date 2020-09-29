-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.1.33-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win32
-- HeidiSQL Versione:            10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database example1
CREATE DATABASE IF NOT EXISTS `example1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `example1`;

-- Dump della struttura di tabella example1.account
CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT '0',
  `created` int(11) DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella example1.account: ~2 rows (circa)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`username`, `email`, `age`, `created`) VALUES
	('asd', 'awe', 0, 0),
	('tncrazvan', 'tangent,jotey@gmail.com', 24, 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dump della struttura di tabella example1.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `commentid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`commentid`),
  KEY `FK_comment_account` (`username`),
  CONSTRAINT `FK_comment_account` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella example1.comment: ~2 rows (circa)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`commentid`, `username`, `content`) VALUES
	(1, 'tncrazvan', 'waedqreqwer'),
	(2, 'asd', 'q4rq24');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Dump della struttura di tabella example1.vote
CREATE TABLE IF NOT EXISTS `vote` (
  `voteid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commentid` int(10) unsigned NOT NULL,
  `value` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteid`),
  KEY `FK_vote_comment` (`commentid`),
  CONSTRAINT `FK_vote_comment` FOREIGN KEY (`commentid`) REFERENCES `comment` (`commentid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella example1.vote: ~0 rows (circa)
/*!40000 ALTER TABLE `vote` DISABLE KEYS */;
INSERT INTO `vote` (`voteid`, `commentid`, `value`) VALUES
	(1, 1, 12);
/*!40000 ALTER TABLE `vote` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
