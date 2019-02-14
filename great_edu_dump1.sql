-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: great_edu
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Table structure for table `Авторы`
--

DROP TABLE IF EXISTS `Авторы`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Авторы` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `фамилия` varchar(30) COLLATE utf8_bin NOT NULL,
  `имя` varchar(30) COLLATE utf8_bin NOT NULL,
  `отчество` varchar(30) COLLATE utf8_bin NOT NULL,
  `страна_принадлежности` varchar(50) COLLATE utf8_bin NOT NULL,
  `сферы_деятельности` int(11) NOT NULL,
  `период` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Авторы_1_idx` (`сферы_деятельности`),
  KEY `fk_Авторы_1_idx1` (`период`),
  CONSTRAINT `fk_Авторы_1` FOREIGN KEY (`период`) REFERENCES `Период` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Авторы_fk2` FOREIGN KEY (`сферы_деятельности`) REFERENCES `Сферы_деятельности` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Авторы`
--

LOCK TABLES `Авторы` WRITE;
/*!40000 ALTER TABLE `Авторы` DISABLE KEYS */;
/*!40000 ALTER TABLE `Авторы` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Цитаты`
--

DROP TABLE IF EXISTS `Цитаты`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Цитаты` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `автор` int(11) NOT NULL,
  `текст` text COLLATE utf8_bin NOT NULL,
  `источник` int(11) DEFAULT NULL,
  `тема` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Цитаты_fk0` (`автор`),
  KEY `Цитаты_fk2` (`источник`),
  KEY `fk_Цитаты_1_idx` (`тема`),
  CONSTRAINT `fk_Цитаты_1` FOREIGN KEY (`тема`) REFERENCES `Темы_произведений` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Цитаты_fk0` FOREIGN KEY (`автор`) REFERENCES `Авторы` (`id`),
  CONSTRAINT `Цитаты_fk2` FOREIGN KEY (`источник`) REFERENCES `Произведения` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Цитаты`
--

LOCK TABLES `Цитаты` WRITE;
/*!40000 ALTER TABLE `Цитаты` DISABLE KEYS */;
/*!40000 ALTER TABLE `Цитаты` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Группы_пользователей`
--

DROP TABLE IF EXISTS `Группы_пользователей`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Группы_пользователей` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(45) COLLATE utf8_bin NOT NULL,
  `разрешения` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Группы_пользователей_1_idx` (`разрешения`),
  CONSTRAINT `fk_Группы_пользователей_1` FOREIGN KEY (`разрешения`) REFERENCES `Список_разрешений` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Группы_пользователей`
--

LOCK TABLES `Группы_пользователей` WRITE;
/*!40000 ALTER TABLE `Группы_пользователей` DISABLE KEYS */;
/*!40000 ALTER TABLE `Группы_пользователей` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Комментарии`
--

DROP TABLE IF EXISTS `Комментарии`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Комментарии` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `автор` int(11) NOT NULL,
  `сообщение` text COLLATE utf8_bin NOT NULL,
  `статья` int(11) NOT NULL,
  `дата_публикации` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Комментарии_fk0` (`автор`),
  KEY `fk_Комментарии_1_idx` (`статья`),
  CONSTRAINT `fk_Комментарии_1` FOREIGN KEY (`статья`) REFERENCES `Статьи` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Комментарии_fk0` FOREIGN KEY (`автор`) REFERENCES `Пользователи` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Комментарии`
--

LOCK TABLES `Комментарии` WRITE;
/*!40000 ALTER TABLE `Комментарии` DISABLE KEYS */;
/*!40000 ALTER TABLE `Комментарии` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Период`
--

DROP TABLE IF EXISTS `Период`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Период` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Период`
--

LOCK TABLES `Период` WRITE;
/*!40000 ALTER TABLE `Период` DISABLE KEYS */;
/*!40000 ALTER TABLE `Период` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Пользователи`
--

DROP TABLE IF EXISTS `Пользователи`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Пользователи` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `никнейм` varchar(50) COLLATE utf8_bin NOT NULL,
  `почта` varchar(45) COLLATE utf8_bin NOT NULL,
  `хэш_пароля` varchar(100) COLLATE utf8_bin NOT NULL,
  `статус` int(11) NOT NULL,
  `группа` int(11) DEFAULT NULL,
  `дата_регистрации` datetime DEFAULT NULL,
  `дата_изменения` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Пользователи_1_idx` (`статус`),
  KEY `fk_Пользователи_2_idx` (`группа`),
  CONSTRAINT `fk_Пользователи_1` FOREIGN KEY (`статус`) REFERENCES `Статусы` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Пользователи_2` FOREIGN KEY (`группа`) REFERENCES `Группы_пользователей` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Пользователи`
--

LOCK TABLES `Пользователи` WRITE;
/*!40000 ALTER TABLE `Пользователи` DISABLE KEYS */;
INSERT INTO `Пользователи` VALUES (1,'test','test@test.ru','test',1,NULL,NULL,NULL),(2,'test2','test2@test.ru','test',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Пользователи` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Произведения`
--

DROP TABLE IF EXISTS `Произведения`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Произведения` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(100) COLLATE utf8_bin NOT NULL,
  `год` int(11) NOT NULL,
  `автор` int(11) NOT NULL,
  `тематика` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Произведения_1_idx` (`автор`),
  KEY `fk_Произведения_2_idx` (`тематика`),
  CONSTRAINT `fk_Произведения_1` FOREIGN KEY (`автор`) REFERENCES `Авторы` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Произведения_2` FOREIGN KEY (`тематика`) REFERENCES `Список_тем_произведений` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Произведения`
--

LOCK TABLES `Произведения` WRITE;
/*!40000 ALTER TABLE `Произведения` DISABLE KEYS */;
/*!40000 ALTER TABLE `Произведения` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Разрешения`
--

DROP TABLE IF EXISTS `Разрешения`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Разрешения` (
  `id` int(11) NOT NULL,
  `название` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Разрешения`
--

LOCK TABLES `Разрешения` WRITE;
/*!40000 ALTER TABLE `Разрешения` DISABLE KEYS */;
/*!40000 ALTER TABLE `Разрешения` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Сферы_деятельности`
--

DROP TABLE IF EXISTS `Сферы_деятельности`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Сферы_деятельности` (
  `id` int(11) NOT NULL,
  `название` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Сферы_деятельности`
--

LOCK TABLES `Сферы_деятельности` WRITE;
/*!40000 ALTER TABLE `Сферы_деятельности` DISABLE KEYS */;
/*!40000 ALTER TABLE `Сферы_деятельности` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Список_разрешений`
--

DROP TABLE IF EXISTS `Список_разрешений`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Список_разрешений` (
  `id_списка` int(11) NOT NULL,
  `id_элемента` int(11) NOT NULL,
  PRIMARY KEY (`id_списка`,`id_элемента`),
  KEY `fk1_idx` (`id_элемента`),
  CONSTRAINT `fk1` FOREIGN KEY (`id_элемента`) REFERENCES `Разрешения` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Список_разрешений`
--

LOCK TABLES `Список_разрешений` WRITE;
/*!40000 ALTER TABLE `Список_разрешений` DISABLE KEYS */;
/*!40000 ALTER TABLE `Список_разрешений` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Список_тегов`
--

DROP TABLE IF EXISTS `Список_тегов`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Список_тегов` (
  `id_списка` int(11) NOT NULL,
  `id_элемента` int(11) NOT NULL,
  PRIMARY KEY (`id_списка`,`id_элемента`),
  KEY `fk10_idx` (`id_элемента`),
  CONSTRAINT `fk10` FOREIGN KEY (`id_элемента`) REFERENCES `Теги` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Список_тегов`
--

LOCK TABLES `Список_тегов` WRITE;
/*!40000 ALTER TABLE `Список_тегов` DISABLE KEYS */;
/*!40000 ALTER TABLE `Список_тегов` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Список_тем_произведений`
--

DROP TABLE IF EXISTS `Список_тем_произведений`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Список_тем_произведений` (
  `id_списка` int(11) NOT NULL,
  `id_элемента` int(11) NOT NULL,
  PRIMARY KEY (`id_списка`,`id_элемента`),
  KEY `Список_тем_статьи_fk0` (`id_элемента`),
  CONSTRAINT `fk_Список_тем_произведений_1` FOREIGN KEY (`id_элемента`) REFERENCES `Темы_произведений` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Список_тем_произведений`
--

LOCK TABLES `Список_тем_произведений` WRITE;
/*!40000 ALTER TABLE `Список_тем_произведений` DISABLE KEYS */;
/*!40000 ALTER TABLE `Список_тем_произведений` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Список_тем_статьи`
--

DROP TABLE IF EXISTS `Список_тем_статьи`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Список_тем_статьи` (
  `id_списка` int(11) NOT NULL,
  `id_элемента` int(11) NOT NULL,
  PRIMARY KEY (`id_списка`,`id_элемента`),
  KEY `Список_тем_статьи_fk0` (`id_элемента`),
  CONSTRAINT `fk_Список_тем_статьи_1` FOREIGN KEY (`id_элемента`) REFERENCES `Темы_статей` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Список_тем_статьи`
--

LOCK TABLES `Список_тем_статьи` WRITE;
/*!40000 ALTER TABLE `Список_тем_статьи` DISABLE KEYS */;
/*!40000 ALTER TABLE `Список_тем_статьи` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Статьи`
--

DROP TABLE IF EXISTS `Статьи`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Статьи` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `темы` int(11) DEFAULT NULL,
  `автор` int(11) DEFAULT NULL,
  `теги` int(11) DEFAULT NULL,
  `дата_публикации` datetime DEFAULT NULL,
  `заголовок` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `файл_контент` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `изображение` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Статьи_1_idx` (`автор`),
  KEY `fk_Статьи_1` (`темы`),
  KEY `fk_Статьи_2_idx` (`теги`),
  CONSTRAINT `fk_Статьи_1` FOREIGN KEY (`темы`) REFERENCES `Список_тем_статьи` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Статьи_2` FOREIGN KEY (`теги`) REFERENCES `Список_тегов` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Статьи`
--

LOCK TABLES `Статьи` WRITE;
/*!40000 ALTER TABLE `Статьи` DISABLE KEYS */;
INSERT INTO `Статьи` VALUES (1,NULL,NULL,NULL,NULL,'Тестовый заголовок','post_1.txt','19222724_1555772291131415_6272807584274196775_o.jpg'),(2,NULL,NULL,NULL,NULL,'Тест2','post_2.txt','html5.jpg'),(3,NULL,NULL,NULL,NULL,'Артур Шпопенгогер сказал','post_3.txt','shpopengoger.jpg');
/*!40000 ALTER TABLE `Статьи` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Статусы`
--

DROP TABLE IF EXISTS `Статусы`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Статусы` (
  `id` int(11) NOT NULL,
  `название` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Статусы`
--

LOCK TABLES `Статусы` WRITE;
/*!40000 ALTER TABLE `Статусы` DISABLE KEYS */;
INSERT INTO `Статусы` VALUES (1,'registered');
/*!40000 ALTER TABLE `Статусы` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Теги`
--

DROP TABLE IF EXISTS `Теги`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Теги` (
  `id` int(11) NOT NULL,
  `название` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Теги`
--

LOCK TABLES `Теги` WRITE;
/*!40000 ALTER TABLE `Теги` DISABLE KEYS */;
/*!40000 ALTER TABLE `Теги` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Темы_произведений`
--

DROP TABLE IF EXISTS `Темы_произведений`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Темы_произведений` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Темы_произведений`
--

LOCK TABLES `Темы_произведений` WRITE;
/*!40000 ALTER TABLE `Темы_произведений` DISABLE KEYS */;
/*!40000 ALTER TABLE `Темы_произведений` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Темы_статей`
--

DROP TABLE IF EXISTS `Темы_статей`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Темы_статей` (
  `id` int(11) NOT NULL,
  `название` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Темы_статей`
--

LOCK TABLES `Темы_статей` WRITE;
/*!40000 ALTER TABLE `Темы_статей` DISABLE KEYS */;
/*!40000 ALTER TABLE `Темы_статей` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-14 16:43:49
