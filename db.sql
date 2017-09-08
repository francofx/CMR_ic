CREATE TABLE `members` (
  `memberID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  PRIMARY KEY (`memberID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `reclamos` (
  `reclamoID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `detalle` varchar(1000) NOT NULL,
  PRIMARY KEY (`reclamoID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
