DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(30) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `image`) VALUES
	('628df6da7f4fa202205252809', 'malik', 'moula', 'badarou@gmail.com', 'issue', 'images/profile/profile-2.jpg'),
	('798bis45', 'Guimdo', 'Lioguy', 'vianel.lioguy@gmail.com', 'poly45', 'images/profile/guimdo.jpg');


DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `id` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `date_modif` date NOT NULL,
  `id_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `list_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `list`;
/*!40000 ALTER TABLE `list` DISABLE KEYS */;
INSERT INTO `list` (`id`, `nom`, `date_creation`, `date_modif`, `id_user`) VALUES
	('629082b432f6b202205275007', 'Maison', '2022-05-27', '2022-05-27', '798bis45'),
	('6290b8ed113c8202205274111', 'malter', '2022-05-27', '2022-05-27', '798bis45'),
	('6290b8f174146202205274111', 'annis', '2022-05-27', '2022-05-27', '798bis45');
/*!40000 ALTER TABLE `list` ENABLE KEYS */;


DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` varchar(50) NOT NULL,
  `texte` varchar(200) NOT NULL,
  `id_list` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_list` (`id_list`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`id_list`) REFERENCES `list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `texte`, `id_list`, `etat`) VALUES
	('6290cdcba2b28202205271013', 'dormir', '629082b432f6b202205275007', 1),
	('6290e54c4f470202205275014', 'jouer', '629082b432f6b202205275007', 0);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;



