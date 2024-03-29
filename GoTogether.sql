-- Progettazione Web 
DROP DATABASE if exists gotogether; 
CREATE DATABASE gotogether; 
USE gotogether; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: gotogether
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `IdRecensione` int(11) NOT NULL AUTO_INCREMENT,
  `IdRecensore` int(11) NOT NULL,
  `IdRecensito` int(11) NOT NULL,
  `Voto` int(11) DEFAULT NULL,
  `Commento` tinytext,
  PRIMARY KEY (`IdRecensione`),
  KEY `IdRecensore` (`IdRecensore`),
  KEY `IdRecensito` (`IdRecensito`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`IdRecensore`) REFERENCES `utente` (`id`),
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`IdRecensito`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,2,1,5,'Ottimo compagno di viaggi!'),(2,1,2,3,'Viaggio divertente, proponente un po\' meno...'),(3,4,1,4,'Educato e ordinato, amante della natura'),(4,1,4,5,'Viaggio organizzato alla perfezione'),(5,3,1,4,'Ragazzo giovane divertente ci siamo divertiti nei musei'),(6,1,3,4,'CittÃ  interessante e organizzazione ottima');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposte`
--

DROP TABLE IF EXISTS `proposte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposte` (
  `IdProposta` int(11) NOT NULL AUTO_INCREMENT,
  `IdProponente` int(11) NOT NULL,
  `Nazione` varchar(100) NOT NULL,
  `Citta` varchar(100) NOT NULL,
  `DataInizio` date NOT NULL,
  `DataFine` date NOT NULL,
  `Prezzo` int(11) NOT NULL,
  `NumPersone` int(11) NOT NULL,
  `PersoneOra` int(11) DEFAULT '0',
  `titoloViaggio` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`IdProposta`),
  KEY `IdProponente` (`IdProponente`),
  CONSTRAINT `proposte_ibfk_1` FOREIGN KEY (`IdProponente`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposte`
--

LOCK TABLES `proposte` WRITE;
/*!40000 ALTER TABLE `proposte` DISABLE KEYS */;
INSERT INTO `proposte` VALUES (1,1,'Italy','Roma','2019-10-10','2019-10-13',100,2,0,'Roma In Bici','background_Italy5d7276f423f97.jpg','Gita nella capitale alla scoperta dei suoi monumenti'),(2,1,'Germany','Berlino','2019-10-19','2019-10-21',200,2,0,'Gita alla scoperta di Berlino','background_Germany5d727797d67e0.jpg','Breve weekend alla scoperta della capitale tedesca e dei suoi monumenti risalenti alla seconda guerra mondiale'),(3,4,'Iceland','ReykjavÃ­k','2019-12-01','2019-12-10',1000,2,1,'Escursioni nella natura','background_Iceland5d7278463d37e.jpg','Viaggio in contatto con la natura e escursione con notte in  tenda'),(4,4,'Japan','Tokyo','2019-10-17','2019-10-21',1500,1,0,'Alla scoperta di una cultura diversa dalla nostra','background_Japan5d7279b3413ab.jpg','Viaggio in Giappone per conoscere una cultura distante dalla nostra e assaggiare cibo caratteristico'),(5,4,'United States','NewYork','2019-12-23','2020-02-02',1500,1,0,'Natale a NewYork','background_United_States5d727a3db04a7.jpg','Fine anno nella metropoli piÃ¹ famosa del mondo'),(6,2,'United Kingdom','Londra','2019-11-30','2019-12-04',150,2,0,'Viaggio a Londra','background_United_Kingdom5d727eb698de0.jpg','Breve viaggio nella capitale inglese, pronti per visitare tutti i suoi monumenti e musei'),(7,2,'France','Parigi','2020-03-12','2020-03-15',250,2,1,'Parigi e Dysneyland','background_France5d727fa75aad4.jpg','Viaggio a Parigi con tappa di un paio di giochi a Disneyland'),(8,3,'Spain','Barcellona','2019-10-07','2019-10-09',200,2,0,'Gita fuori porta a Barcellona','background_Spain5d728066f202b.jpg','Tappa obbligatoria se si Ã¨ amanti dei bei palazzi'),(9,3,'Spain','madrid','2020-05-08','2020-05-15',300,1,0,'Visita della capitale spagnola','background_Spain5d72819e6fe60.jpg','Visita nei luoghi in cui Ã¨ stata girata la Casa di Carta'),(10,1,'United States','Honolulu','2020-07-02','2020-07-07',3000,1,0,'Al mare a Honolulu','background_United_States5d7282743c3aa.jpg','Vacanza estiva diversa dal solito'),(11,1,'United Kingdom','Londra','2019-10-31','2019-11-03',200,2,0,'Halloween a Londra','background_United_Kingdom5d728938648d0.jpg','Vacanza a Londra in pieno autunno'),(12,1,'United States','Orlando','2020-05-29','2020-06-07',5000,4,0,'Visita dei parchi a Orlando','background_United_States5d728bf7333c4.jpg','Viaggio incentrato sulla visita dei parchi divertimento, con occhio di riguardo per Disney World e gli Universal Studios'),(13,1,'Canada','Toronto','2020-02-06','2020-02-15',2000,5,0,'Viaggio a Toronto','background_Canada5d728d9404be9.jpg','Visita di una delle cittÃ  piÃ¹ importanti del Canada'),(14,4,'Germany','Berlino','2020-02-06','2020-02-10',300,2,0,'Berlino per musei','background_Germany5d728e56efadb.jpg','Viaggio a Berlino incentrato a visitare i musei della cittÃ '),(15,2,'Spain','Barcellona','2020-02-21','2020-02-24',300,4,0,'Weekend a Barcellona','background_Spain5d728fcba2583.jpg','Breve vacanza a Barcellona in cerca di relax '),(16,2,'Greece','Mykonos','2020-07-06','2020-07-13',500,5,0,'Settimana a Mykonos','background_Greece5d72908ed696b.jpg','Vacanza incentrata sul divertimento e sul relax'),(17,2,'Portugal','Lisbona','2020-05-30','2020-06-03',150,3,0,'Visita di Lisbona','background_Portugal5d7292a5ec9a9.jpg','Visita della cittÃ  portoghese, per curiosi che vogliono visitare una cittÃ  nuova'),(18,2,'Italy','Milano','2020-01-31','2020-02-02',70,3,0,'Gita a Milano','background_Italy5d729320b881e.jpg','Breve gita fuori porta per visitare Milano'),(19,3,'Greece','Atene','2019-08-01','2019-08-07',400,2,0,'Visita dei templi greci','background_Greece5d7293f5488ac.jpg','Visita della capitale greca alla scoperta dei grandi templi'),(20,3,'Netherlands','Amsterdam','2019-10-23','2019-10-26',350,5,1,'visita di Amsterdam','background_Netherlands5d7295b8e9ce8.jpg','Visita della cittÃ  nota per i canali e per il museo dedicato a Van Gogh');
/*!40000 ALTER TABLE `proposte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propostedaaccettare`
--

DROP TABLE IF EXISTS `propostedaaccettare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propostedaaccettare` (
  `IdProposta` int(11) NOT NULL,
  `IdRichiedente` int(11) NOT NULL,
  `IdProponente` int(11) NOT NULL,
  `Accettato` tinyint(1) NOT NULL DEFAULT '0',
  `DataRichiesta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Visualizzato` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdProposta`,`IdRichiedente`),
  KEY `IdRichiedente` (`IdRichiedente`),
  KEY `IdProponente` (`IdProponente`),
  CONSTRAINT `propostedaaccettare_ibfk_1` FOREIGN KEY (`IdRichiedente`) REFERENCES `utente` (`id`),
  CONSTRAINT `propostedaaccettare_ibfk_2` FOREIGN KEY (`IdProponente`) REFERENCES `utente` (`id`),
  CONSTRAINT `propostedaaccettare_ibfk_3` FOREIGN KEY (`IdProposta`) REFERENCES `proposte` (`IdProposta`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propostedaaccettare`
--

LOCK TABLES `propostedaaccettare` WRITE;
/*!40000 ALTER TABLE `propostedaaccettare` DISABLE KEYS */;
INSERT INTO `propostedaaccettare` VALUES (3,1,4,1,'2019-09-19 14:55:52',1),(7,1,2,1,'2019-09-19 14:51:30',1),(13,3,1,0,'2019-09-19 14:51:00',0),(14,1,4,0,'2019-09-19 14:58:31',0),(18,3,2,0,'2019-09-19 14:50:45',0),(20,1,3,1,'2019-09-19 14:49:07',1);
/*!40000 ALTER TABLE `propostedaaccettare` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER aggiorna_posti
AFTER UPDATE ON propostedaaccettare
FOR EACH ROW
BEGIN

	IF((NEW.Accettato = 1) AND (NEW.Visualizzato = 1)) THEN
		UPDATE proposte SET PersoneOra = PersoneOra+1
        WHERE IdProposta = NEW.IdProposta;
	END IF;
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varbinary(100) NOT NULL,
  `datanascita` date DEFAULT NULL,
  `image` varchar(100) DEFAULT 'placeholder.png',
  `gender` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'Tommaso','Amarante','tommyc98@yahoo.it','111','1998-06-07','profile1.jpg','Maschio'),(2,'Leonardo','Talerico','leo.tale@hotmail.it','222','1998-04-23','profile2.jpg','Maschio'),(3,'Edoardo','Morucci','edo.moru@gmail.com','333','1998-04-29','profile3.jpg','Maschio'),(4,'Virginia','Imbimbo','virginia.imbimbo@gmail.com','444','1998-06-13','profile4.jpg','Femmina');
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-20 16:44:30
