CREATE TABLE `OBsoupVolunteers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;