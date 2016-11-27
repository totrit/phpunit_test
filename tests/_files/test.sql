CREATE TABLE `dogs` (
  `name` varchar(20) NOT NULL,
  `breed` varchar(20) DEFAULT NULL,
  `owner` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `owners` (
  `name` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
