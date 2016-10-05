CREATE TABLE `user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

CREATE TABLE `pet` (
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
  KEY `pet_city_FK` (`city_id`),
  CONSTRAINT `pet_city_FK` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `pet_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `path` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_pet_FK` (`pet_id`),
  CONSTRAINT `photo_pet_FK` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estate_id` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_PK` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dataatualizacao` timestamp NULL DEFAULT NULL,
  `datacriacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `state_PK` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
