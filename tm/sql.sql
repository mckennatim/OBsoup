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


CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `zipcode` varchar(12) default NULL,
  `phone` varchar(100) default NULL,
  `otheremail` varchar(120) default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=302 ;

-- 
-- Dumping data for table `volunteers`
-- 

INSERT INTO `volunteers` (`id`, `email`, `name`, `password`, `town`, `phone`, `otheremail`) VALUES (300, 'mckenna.tim@gmail.com', 'Timothy S. McKenna', '3abf00fa61bfae2fff9133375e142416', NULL, NULL, NULL),
(301, 'tim@sitebuilt.net', 'Timothy S. McKenna', '3abf00fa61bfae2fff9133375e142416', NULL, NULL, NULL);



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

SELECT willdothis, role, roledesc, name
FROM  team 
LEFT JOIN volunteers
USING ( id )
WHERE id = 1

SELECT * FROM projects
LEFT JOIN team
USING ( pid )
LEFT JOIN volunteers
USING ( id )	
WHERE pid = '7'

SELECT `email` , `otheremail` , `name` , `role` , `roledesc` , `phone` , `mobile` , `orgcancall`
FROM projects
LEFT JOIN team
USING ( pid )
LEFT JOIN volunteers
USING ( id )
WHERE pid = '7'

SELECT `role`, `roledesc`, `name`, `email`, `otheremail`, `phone` , `mobile` , `orgcancall`
FROM team  
LEFT JOIN volunteers
USING ( id )
WHERE pid='7'

SELECT `pid`, `vid`,  `email`
FROM projects  
LEFT JOIN volunteers
ON volunteers. id = projects.vid
WHERE pid='13'

SELECT `zip`, `latitude`, `longitude`, `email` FROM zip_codes
LEFT JOIN volunteers
ON zip_codes.zip=volunteers.zipcode 
WHERE  email ='mckenna.tim@gmail.com'	

UPDATE volunteers SET `passwd` = '$pwd' WHERE email='$email' 