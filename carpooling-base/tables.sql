CREATE TABLE `users` (
  `id` int AUTO_INCREMENT NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08'),
(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08'),
(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08');

-- _____________________________________________________________________________________________________


CREATE TABLE `voitures` (
  `id` int AUTO_INCREMENT NOT NULL,
  `model` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `vitesseMax` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- _____________________________________________________________________________________________________


CREATE TABLE `covoiturages` (
  `id` int AUTO_INCREMENT NOT NULL,
  `pointstart` varchar(255) NOT NULL,
  `pointend` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `available_place` int NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- _____________________________________________________________________________________________________


CREATE TABLE `reservations` (
  `id` int AUTO_INCREMENT NOT NULL,
  `name_client` varchar(255) NOT NULL,
  `tele_client` varchar(255) NOT NULL,
  `mail_client` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;