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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Авторы`
--

LOCK TABLES `Авторы` WRITE;
/*!40000 ALTER TABLE `Авторы` DISABLE KEYS */;
INSERT INTO `Авторы` VALUES (1,'Пушкин','Александр','Сергеевич','Российская империя',8,6),(2,'Достоевский','Федор','Михайлович','Российская империя',6,5),(3,'Маяковский','Владимир','Владимирович','СССР',5,3),(4,'Лондон','Джек',' ','США',3,2),(5,'Булгаков','Михаил','Афанасьевич','СССР',8,7);
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
  `автор` int(11) DEFAULT NULL,
  `текст` text COLLATE utf8_bin NOT NULL,
  `источник` int(11) DEFAULT NULL,
  `тема` int(11) DEFAULT NULL,
  `автор_публикации` int(11) DEFAULT NULL,
  `дата_публикации` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Цитаты_fk0` (`автор`),
  KEY `Цитаты_fk2` (`источник`),
  KEY `fk_Цитаты_1_idx` (`тема`),
  KEY `fk_Цитаты_2_idx` (`автор_публикации`),
  CONSTRAINT `fk_Цитаты_1` FOREIGN KEY (`тема`) REFERENCES `Темы_произведений` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Цитаты_2` FOREIGN KEY (`автор_публикации`) REFERENCES `Пользователи` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Цитаты_fk0` FOREIGN KEY (`автор`) REFERENCES `Авторы` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Цитаты_fk2` FOREIGN KEY (`источник`) REFERENCES `Произведения` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Цитаты`
--

LOCK TABLES `Цитаты` WRITE;
/*!40000 ALTER TABLE `Цитаты` DISABLE KEYS */;
INSERT INTO `Цитаты` VALUES (1,1,'Господи, Как же так получается, \nЧто мы путешествуем, \nУдивляясь и восхищаясь Высотой гор, \nПросторами морей, Течением рек, \nУстрашающей силой океанов \nИ движением звезд, \nА когда мы смотрим внутрь себя, \nТо не замечаем великого чуда?',1,4,1,'2019-03-01 18:25:31'),(2,1,'Любовь - это когда люди не соединяют души или тела, это когда они объединяют судьбы!',1,2,1,'2019-03-01 18:25:31'),(3,2,'Когда дети будут смотреть на великих ученых так же, как они смотрят на знаменитых актёров и музыкантов, человечество совершит большой прорыв.',2,1,2,'2019-03-01 18:25:35'),(4,3,'Я стал другим, новым человеком; а те, для кого существовал только старый «я», смеялись надо мной. Единственно разумный человек был мой портной: он каждый раз снимал заново с меня мерку, тогда как все остальные подходили ко мне со старой и воображали, что она все еще отражает мои действительные размеры.',3,2,3,'2019-03-01 20:25:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Группы_пользователей`
--

LOCK TABLES `Группы_пользователей` WRITE;
/*!40000 ALTER TABLE `Группы_пользователей` DISABLE KEYS */;
INSERT INTO `Группы_пользователей` VALUES (1,'пользователь',1),(2,'администратор',2);
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
  `автор` int(11) DEFAULT NULL,
  `сообщение` text COLLATE utf8_bin NOT NULL,
  `статья` int(11) NOT NULL,
  `дата_публикации` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Комментарии_fk0` (`автор`),
  KEY `fk_Комментарии_1_idx` (`статья`),
  CONSTRAINT `fk_Комментарии_1` FOREIGN KEY (`статья`) REFERENCES `Статьи` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Комментарии_fk0` FOREIGN KEY (`автор`) REFERENCES `Пользователи` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Комментарии`
--

LOCK TABLES `Комментарии` WRITE;
/*!40000 ALTER TABLE `Комментарии` DISABLE KEYS */;
INSERT INTO `Комментарии` VALUES (1,1,'тестовый месседж',3,'2019-02-18 16:01:44'),(2,1,'тест2',2,'2019-02-18 16:01:44'),(3,1,'тест',2,'2019-02-18 16:01:44'),(4,2,'тест3',1,'2019-02-18 16:01:44'),(5,2,'тест',2,'2019-02-18 16:01:44'),(6,1,'тест',1,'2019-02-18 16:01:44'),(7,2,'тест',3,'2019-02-18 16:01:44'),(8,2,'тест',1,'2019-02-18 16:01:44'),(9,2,'тест',2,'2019-02-18 16:01:44'),(10,1,'тест',2,'2019-02-18 16:01:44'),(11,1,'ну смотри сюда короче',3,'2019-03-07 12:45:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Период`
--

LOCK TABLES `Период` WRITE;
/*!40000 ALTER TABLE `Период` DISABLE KEYS */;
INSERT INTO `Период` VALUES (1,'Античная литература'),(2,'Средневековая литература'),(3,'Литература эпохи Возрождения'),(4,'XVII век'),(5,'XVIII век'),(6,'XIX век'),(7,'XX век'),(8,'XXI век');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Пользователи`
--

LOCK TABLES `Пользователи` WRITE;
/*!40000 ALTER TABLE `Пользователи` DISABLE KEYS */;
INSERT INTO `Пользователи` VALUES (1,'test','test@test.ru','test',1,2,'2019-02-18 16:01:44','2019-02-18 16:01:44'),(2,'test2','test2@test.ru','test',1,1,'2019-02-18 16:01:44','2019-02-18 16:01:44'),(3,'tiranid','masmkf@mail.ru','fkgokfdmgvfd',2,2,'2019-02-18 16:01:44','2019-02-18 16:01:44'),(4,'test-admin','sample@email.ru','12',1,2,'2019-03-06 09:43:34','2019-03-06 09:43:34'),(5,'test123','sample-admin@test.ru','12',1,2,'2019-03-06 15:51:52','2019-03-06 15:51:52'),(6,'test123','sample-admin@test.ru','12',1,2,'2019-03-06 15:52:45','2019-03-06 15:52:45'),(7,'test123','sample-admin@test.ru','12',1,2,'2019-03-06 15:52:46','2019-03-06 15:52:46'),(8,'test123','sample-admin@test.ru','12',1,2,'2019-03-06 15:52:46','2019-03-06 15:52:46'),(9,'test2','sample-admin@test.ru','123',1,2,'2019-03-06 15:53:44','2019-03-06 15:53:44'),(10,'test5','sample-admin@test.ru','123',1,2,'2019-03-06 15:54:52','2019-03-06 15:54:52'),(11,'test-admin','sample-admin@test.ru','1234',1,2,'2019-03-06 15:56:59','2019-03-06 15:56:59'),(12,'test-admin5','sample-admin@test.ru','123',1,2,'2019-03-06 15:58:19','2019-03-06 15:58:19'),(13,'new_user','new_user@some_email.com','555',1,1,'2019-03-07 13:41:24','2019-03-07 13:41:24'),(14,'tester_user1','email@com','123',1,1,'2019-03-07 13:48:35','2019-03-07 13:48:35'),(15,'tester_user12','email@com','12',1,1,'2019-03-07 13:50:21','2019-03-07 13:50:21'),(16,'да','мда','бда',1,1,'2019-03-06 15:52:45','2019-03-06 15:52:45'),(17,'tester_user123','email@com','12',1,1,'2019-03-07 13:54:50','2019-03-07 13:54:50'),(18,'testwerewrwe','ewrweqr','123',1,1,'2019-03-07 13:56:06','2019-03-07 13:56:06'),(19,'MonsterBoomerACDC','ti@gnida','123',1,1,'2019-03-07 13:56:34','2019-03-07 13:56:34'),(20,'wqewe','wqewqe','123',1,1,'2019-03-07 13:57:12','2019-03-07 13:57:12'),(21,'wqewe213','wqewqe','123',1,1,'2019-03-07 13:58:33','2019-03-07 13:58:33'),(22,'213213','12321','123',1,1,'2019-03-07 14:00:43','2019-03-07 14:00:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Произведения`
--

LOCK TABLES `Произведения` WRITE;
/*!40000 ALTER TABLE `Произведения` DISABLE KEYS */;
INSERT INTO `Произведения` VALUES (1,'Евгений Онегин',1825,1,1),(2,'Идиот',1868,2,1),(3,'Мастер и Маргарита',1966,5,1);
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
INSERT INTO `Разрешения` VALUES (1,'комментирование'),(2,'добавление статей'),(3,'модерация комментариев'),(4,'модерация статей'),(5,'добавление цитат');
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
INSERT INTO `Сферы_деятельности` VALUES (1,'Экономика'),(2,'Экология'),(3,'Управление'),(4,'Педагогика'),(5,'Медицина'),(6,'Физкультура'),(7,'Наука'),(8,'Искусство');
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
INSERT INTO `Список_разрешений` VALUES (1,1),(2,1),(2,2),(2,3),(2,4),(1,5),(2,5);
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
INSERT INTO `Список_тегов` VALUES (1,1),(1,2),(2,3),(3,4);
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
INSERT INTO `Список_тем_произведений` VALUES (1,1),(1,2);
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
INSERT INTO `Список_тем_статьи` VALUES (1,1),(3,1),(1,2),(2,3);
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
  CONSTRAINT `fk_Статьи_2` FOREIGN KEY (`теги`) REFERENCES `Список_тегов` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Статьи_3` FOREIGN KEY (`автор`) REFERENCES `Пользователи` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Статьи`
--

LOCK TABLES `Статьи` WRITE;
/*!40000 ALTER TABLE `Статьи` DISABLE KEYS */;
INSERT INTO `Статьи` VALUES (1,1,1,1,'2019-03-01 18:25:31','Тестовый заголовок ','post_1.txt','Снимок экрана в 2018-08-27 14-49-20.png'),(2,2,1,2,'2019-03-07 12:46:23','Тест2 даааа','post_2.txt','Снимок экрана в 2018-08-27 14-49-20.png'),(3,3,1,3,'2019-03-07 12:09:29','Артур Шпопенгогер сказал: ','post_3.txt','shpopengoger.jpg'),(4,1,1,1,'2019-03-07 20:09:29','Миша бака, не сменил TTL','post_3.txt','html5.jpg');
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
INSERT INTO `Статусы` VALUES (1,'registered'),(2,'pending'),(3,'empty'),(4,'repass');
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
INSERT INTO `Теги` VALUES (1,'философия'),(2,'любовь'),(3,'анализ'),(4,'проза'),(5,'авторское');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Темы_произведений`
--

LOCK TABLES `Темы_произведений` WRITE;
/*!40000 ALTER TABLE `Темы_произведений` DISABLE KEYS */;
INSERT INTO `Темы_произведений` VALUES (1,'Вечные темы'),(2,'Культурно-историческая тематика'),(3,'Революция'),(4,'Человек'),(5,'Любовь');
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
INSERT INTO `Темы_статей` VALUES (1,'Анализ'),(2,'Эссе'),(3,'Этюд');
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

-- Dump completed on 2019-03-07 20:11:20
