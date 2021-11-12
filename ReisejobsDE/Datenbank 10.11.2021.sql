-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.20-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank Struktur für reisejobs
CREATE DATABASE IF NOT EXISTS `reisejobs` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `reisejobs`;

-- Exportiere Struktur von Tabelle reisejobs.Bewerber
CREATE TABLE IF NOT EXISTS `Bewerber` (
  `BewerberID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT 'Vorname',
  `Nachname` varchar(50) DEFAULT 'Nachname',
  `Beschreibung` text DEFAULT 'Deine Beschreibung',
  `Email` varchar(50) DEFAULT NULL,
  `Passwort` varchar(255) DEFAULT NULL,
  `Job` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`BewerberID`) USING BTREE,
  UNIQUE KEY `BewerberEmail` (`Email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle reisejobs.Bewerber: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `Bewerber` DISABLE KEYS */;
INSERT INTO `Bewerber` (`BewerberID`, `Name`, `Nachname`, `Beschreibung`, `Email`, `Passwort`, `Job`) VALUES
	(1, ' Marco', 'Bajtl', 'Software entwickler', 'm.bajtl@schoetex.de', '$2y$10$g3A5o.PgxS3FeHCAMf908usduY9wTM.vhs/cVUcH1cBcVb1x5EP7G', 0),
	(3, 'Dein Name', 'Dein Nachname', 'Deiner Beschreibung', 'm.bajtl@schoetex.dee', '$2y$10$/eaBqe0zMdkUOH7gJnkABOaBcJ8Tp2vNllt9RjEc7DsIUYEqR5qVK', 0),
	(4, 'Vorname', 'Nachname', 'Deine Beschreibung', 'm.bajtl@schoetex.deaa', '$2y$10$JWlwNTRAEzjzo8/ask/UJujbB4E3B2TPKFQ7wka/PRneO.Fv93hai', 0);
/*!40000 ALTER TABLE `Bewerber` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle reisejobs.Favoriten
CREATE TABLE IF NOT EXISTS `Favoriten` (
  `FavoritenID` int(11) NOT NULL AUTO_INCREMENT,
  `FKUserID` int(11) DEFAULT NULL,
  `FKJobID` int(11) DEFAULT 234,
  PRIMARY KEY (`FavoritenID`),
  KEY `FK_Favoriten_Bewerber` (`FKUserID`),
  KEY `FK_Favoriten_Jobangebote` (`FKJobID`),
  CONSTRAINT `FK_Favoriten_Bewerber` FOREIGN KEY (`FKUserID`) REFERENCES `Bewerber` (`BewerberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Favoriten_Jobangebote` FOREIGN KEY (`FKJobID`) REFERENCES `Jobangebote` (`JobID`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle reisejobs.Favoriten: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `Favoriten` DISABLE KEYS */;
INSERT INTO `Favoriten` (`FavoritenID`, `FKUserID`, `FKJobID`) VALUES
	(35, 1, NULL),
	(36, 1, NULL),
	(37, 1, 2),
	(38, 1, 3),
	(39, 1, 10),
	(40, 1, 18);
/*!40000 ALTER TABLE `Favoriten` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle reisejobs.Jobangebote
CREATE TABLE IF NOT EXISTS `Jobangebote` (
  `JobID` int(11) NOT NULL AUTO_INCREMENT,
  `FKUnternehmenID` int(11) NOT NULL DEFAULT 0,
  `Titel` varchar(50) NOT NULL DEFAULT '0',
  `Standort` varchar(50) NOT NULL DEFAULT '0',
  `PLZ` int(11) NOT NULL DEFAULT 99999,
  `Beschreibung` mediumtext NOT NULL,
  `Veroeffentlicht` date DEFAULT curdate(),
  PRIMARY KEY (`JobID`) USING BTREE,
  KEY `FK_Jobangebote_Unternehmen` (`FKUnternehmenID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle reisejobs.Jobangebote: ~5 rows (ungefähr)
/*!40000 ALTER TABLE `Jobangebote` DISABLE KEYS */;
INSERT INTO `Jobangebote` (`JobID`, `FKUnternehmenID`, `Titel`, `Standort`, `PLZ`, `Beschreibung`, `Veroeffentlicht`) VALUES
	(2, 3, 'Tester', 'Würzburg', 97070, 'tester', '2021-10-28'),
	(3, 2, 'Systemadmin', 'Lohr', 97816, 'Admin', '2021-10-28'),
	(5, 3, 'Test2', 'Marktheidenfeld', 20095, '312', '2021-10-28'),
	(10, 7, 'KFZ Mechatroniker', 'Karlstadt', 99999, 'Die Test AG steht mit einem Umsatz von 600 Mil. € und 4.000 Mitarbeitern an der Schwelle zwischen Mittelstand und Großunternehmen. Die produzierten Maschinen werden von industriellen Kunden zur Rohstoffgewinnung eingesetzt. Der Vertrieb erfolgt weltweit, wobei der Anteil Deutschlands unter 20 Prozent liegt und tendenziell weiter sinken wird. Zukünftiges Wachstum wird nicht mehr in der EU, sondern primär in Schwellländern erwartet. Leistungserstellung und Vertrieb erfolgen noch ausschließlich vom Standort in Deutschland, mittelfristig sind eine Produktion und ein eigenständiger Vertrieb in Südostasien geplant, später soll Afrika folgen. Die Wertschöpfungstiefe ist relativ groß, Veränderungen sind hier nicht geplant, auch zum Schutz des geistigen Eigentums. Damit befindet sich eine sehr heterogene Gruppe von Mitarbeitern im Unternehmen, hochqualifizierte Ingenieure, mehrsprachige Vertriebsmitarbeiter, Fachkräfte in der Verwaltung und Produktion, aber auch', '2021-10-28'),
	(18, 7, 'Flugbegleiter', 'Hamburg', 99999, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '2021-11-10');
/*!40000 ALTER TABLE `Jobangebote` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle reisejobs.Unternehmen
CREATE TABLE IF NOT EXISTS `Unternehmen` (
  `UnternehmenID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT 'Dein UnternehmensName',
  `Ort` varchar(50) DEFAULT 'Der Ort deines Unternehmens',
  `Beschreibung` mediumtext DEFAULT 'Die Beschreibung deines Unternehmens',
  `Email` varchar(50) DEFAULT NULL,
  `Passwort` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`UnternehmenID`) USING BTREE,
  UNIQUE KEY `UnternehmenEmail` (`Email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle reisejobs.Unternehmen: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `Unternehmen` DISABLE KEYS */;
INSERT INTO `Unternehmen` (`UnternehmenID`, `Name`, `Ort`, `Beschreibung`, `Email`, `Passwort`) VALUES
	(1, 'Testunternehmen1', 'Würzburg', 'Wir machen tests', 'test@unternehmen1.de', '$2y$10$/.YJsPFmI15H./vZeurPgOV88NQfl7Ms0DMTuqLnxee'),
	(2, 'Schoetex GmbH', 'Lohr', 'Wir machen IT', 'info@schoetex.de', '$2y$10$/.YJsPFmI15H./vZeurPgOV88NQfl7Ms0DMTuqLnxee'),
	(3, 'Cheapairflights', 'Marktheidenfeld', 'Die Beschreibung deines Unternehmens', 'm.bajtl@scttthoetex.de', '$2y$10$/.YJsPFmI15H./vZeurPgOV88NQfl7Ms0DMTuqLnxee'),
	(7, 'Testunternehmen', 'Würzburg', 'Die Test AG steht mit einem Umsatz von 600 Mil. € und 4.000 Mitarbeitern an der Schwelle zwischen Mittelstand und Großunternehmen. Die produzierten Maschinen werden von industriellen Kunden zur Rohstoffgewinnung eingesetzt. Der Vertrieb erfolgt weltweit, wobei der Anteil Deutschlands unter 20 Prozent liegt und tendenziell weiter sinken wird. Zukünftiges Wachstum wird nicht mehr in der EU, sondern primär in Schwellländern erwartet. Leistungserstellung und Vertrieb erfolgen noch ausschließlich vom Standort in Deutschland, mittelfristig sind eine Produktion und ein eigenständiger Vertrieb in Südostasien geplant, später soll Afrika folgen. Die Wertschöpfungstiefe ist relativ groß, Veränderungen sind hier nicht geplant, auch zum Schutz des geistigen Eigentums. Damit befindet sich eine sehr heterogene Gruppe von Mitarbeitern im Unternehmen, hochqualifizierte Ingenieure, mehrsprachige Vertriebsmitarbeiter, Fachkräfte in der Verwaltung und Produktion, aber auch Hilfskräfte in der Logistik, dem Lager, dem Werkschutz oder der Kantine.																																																																																																																																																																																																																																										', 'marcobajtl@yahoo.de', '$2y$10$xjcjF//gTaA6Eb1CKlttK.B72bSv3T65fT/wfFUXxqEUT8XYbRmca');
/*!40000 ALTER TABLE `Unternehmen` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
