CREATE TABLE `OBsoupVolunteers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `town` varchar(60) NOT NULL,
  `phone` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

CREATE TABLE `prOutlines` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `info` text,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

CREATE TABLE `roles` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11),
  `role` varchar(100) NOT NULL,
  `roledesc` varchar(120),
  `num` int(2),
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

CREATE TABLE `projects` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `info` text,
  `projdate` varchar(100) NOT NULL,
  `leadtime` varchar(100) NOT NULL,
  `location` varchar(120) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

CREATE TABLE `team` (
  `trid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11),
  `role` varchar(100) NOT NULL,
  `roledesc` varchar(120),
  `num` int(2),
  `id` int(11),
  PRIMARY KEY (`trid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=300 ;

SELECT *
FROM prOutlines  
WHERE oid=145

SELECT *
FROM roles  
WHERE oid=145


