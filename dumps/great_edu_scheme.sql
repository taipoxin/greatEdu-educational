
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


DROP TABLE IF EXISTS `Цитаты`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Цитаты` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `автор` int(11) NOT NULL,
  `текст` text COLLATE utf8_bin NOT NULL,
  `источник` int(11) DEFAULT NULL,
  `тема` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Цитаты_fk0` (`автор`),
  KEY `Цитаты_fk2` (`источник`),
  KEY `Цитаты_fk3` (`тема`),
  CONSTRAINT `Цитаты_fk0` FOREIGN KEY (`автор`) REFERENCES `Авторы` (`id`),
  CONSTRAINT `Цитаты_fk2` FOREIGN KEY (`источник`) REFERENCES `Произведения` (`id`),
  CONSTRAINT `Цитаты_fk3` FOREIGN KEY (`тема`) REFERENCES `Темы` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;


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


DROP TABLE IF EXISTS `Жанры`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Жанры` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;



DROP TABLE IF EXISTS `Комментарии`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Комментарии` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `автор` int(11) NOT NULL,
  `сообщение` text COLLATE utf8_bin NOT NULL,
  `статья` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Комментарии_fk0` (`автор`),
  KEY `fk_Комментарии_1_idx` (`статья`),
  CONSTRAINT `fk_Комментарии_1` FOREIGN KEY (`статья`) REFERENCES `Статьи` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Комментарии_fk0` FOREIGN KEY (`автор`) REFERENCES `Пользователи` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `Период`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Период` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;



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
  PRIMARY KEY (`id`),
  KEY `Пользователи_fk1` (`группа`),
  KEY `fk_Пользователи_1_idx` (`статус`),
  CONSTRAINT `fk_Пользователи_1` FOREIGN KEY (`статус`) REFERENCES `Статусы` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Пользователи_fk1` FOREIGN KEY (`группа`) REFERENCES `Группы_пользователей` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `Произведения`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Произведения` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `название` varchar(100) COLLATE utf8_bin NOT NULL,
  `год` int(11) NOT NULL,
  `автор` int(11) NOT NULL,
  `жанр` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Произведения_1_idx` (`автор`),
  KEY `fk_Произведения_2_idx` (`жанр`),
  CONSTRAINT `fk_Произведения_1` FOREIGN KEY (`автор`) REFERENCES `Авторы` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Произведения_2` FOREIGN KEY (`жанр`) REFERENCES `Жанры` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;



DROP TABLE IF EXISTS `Разрешения`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Разрешения` (
  `id` int(11) NOT NULL,
  `название` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `Сферы_деятельности`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Сферы_деятельности` (
  `id` int(11) NOT NULL,
  `название` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


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


DROP TABLE IF EXISTS `Список_тем_статьи`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Список_тем_статьи` (
  `id_списка` int(11) NOT NULL,
  `id_элемента` int(11) NOT NULL,
  PRIMARY KEY (`id_списка`,`id_элемента`),
  KEY `Список_тем_статьи_fk0` (`id_элемента`),
  CONSTRAINT `fk_Список_тем_статьи_1` FOREIGN KEY (`id_элемента`) REFERENCES `Темы` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;



DROP TABLE IF EXISTS `Статьи`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Статьи` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `темы` int(11) NOT NULL,
  `автор` int(11) NOT NULL,
  `теги` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Статьи_1_idx` (`автор`),
  KEY `fk_Статьи_1` (`темы`),
  KEY `fk_Статьи_2_idx` (`теги`),
  CONSTRAINT `fk_Статьи_1` FOREIGN KEY (`темы`) REFERENCES `Список_тем_статьи` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Статьи_2` FOREIGN KEY (`теги`) REFERENCES `Список_тегов` (`id_списка`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `Статусы`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Статусы` (
  `id` int(11) NOT NULL,
  `название` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `Теги`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Теги` (
  `id` int(11) NOT NULL,
  `название` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `Темы`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Темы` (
  `id` int(11) NOT NULL,
  `название` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
