DROP TABLE IF EXISTS adiitems;

CREATE TABLE `adiitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icode` varchar(10) NOT NULL,
  `itemname` varchar(200) NOT NULL,
  `menutype` varchar(200) NOT NULL,
  `itemtype` varchar(20) NOT NULL,
  `nvegtype` varchar(200) DEFAULT NULL,
  `itemgroup` varchar(400) NOT NULL,
  `halfrate` decimal(10,2) NOT NULL,
  `fullrate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `icode` (`icode`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=latin1;

INSERT INTO adiitems VALUES("1","ABC1","ABC 1","FOOD","VEG",null,"ABC","0.00","100.00");
INSERT INTO adiitems VALUES("2","ABC2","ABC 2","FOOD","VEG",null,"ABC","0.00","100.00");
INSERT INTO adiitems VALUES("3","ABC3","ABC 3","FOOD","VEG",null,"ABC","0.00","100.00");
INSERT INTO adiitems VALUES("4","ABC4","ABC 4","FOOD","VEG",null,"ABC","0.00","100.00");
INSERT INTO adiitems VALUES("5","ABC5","ABC 5","FOOD","VEG",null,"ABC","0.00","100.00");
INSERT INTO adiitems VALUES("6","ABC6","ABC 6","FOOD","VEG",null,"ABC","0.00","100.00");
INSERT INTO adiitems VALUES("7","ABC7","ABC 7","FOOD","VEG",null,"ABC","0.00","100.00");


DROP TABLE IF EXISTS adikotdet;

CREATE TABLE `adikotdet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(11) NOT NULL,
  `itemtype` varchar(30) NOT NULL,
  `itemid` int(10) NOT NULL,
  `icode` varchar(10) NOT NULL,
  `itemname` varchar(200) NOT NULL,
  `uiprice` decimal(10,2) NOT NULL,
  `hiprice` decimal(10,2) NOT NULL,
  `uiquan` decimal(10,2) NOT NULL,
  `hiquan` decimal(10,2) NOT NULL,
  `icharge` decimal(10,2) NOT NULL,
  `idisper` decimal(10,2) NOT NULL,
  `idiscount` decimal(10,2) NOT NULL,
  `ktotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS adikotnum;

CREATE TABLE `adikotnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kotdate` datetime NOT NULL,
  `bokinum` varchar(10) DEFAULT NULL,
  `billtype` varchar(30) NOT NULL,
  `otype` varchar(20) NOT NULL,
  `waitrname` varchar(50) NOT NULL,
  `loguser` varchar(100) NOT NULL,
  `custto` varchar(200) NOT NULL,
  `custaddrs` text NOT NULL,
  `custphno` varchar(15) NOT NULL,
  `totalitems` int(10) NOT NULL,
  `totaldisper` decimal(10,2) NOT NULL,
  `totaldiscount` decimal(10,2) NOT NULL,
  `totalgrand` decimal(10,2) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS adistaffdet;

CREATE TABLE `adistaffdet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL,
  `sdepart` varchar(20) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `sidproof` varchar(100) NOT NULL,
  `sdesig` varchar(100) NOT NULL,
  `saddrs` text,
  `sphno` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS adiuserlogin;

CREATE TABLE `adiuserlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adiuname` varchar(50) NOT NULL,
  `adiupass` varchar(60) NOT NULL,
  `adiudepart` varchar(30) NOT NULL,
  PRIMARY KEY (`adiuname`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO adiuserlogin VALUES("2","user","user","RESTAURANT");


DROP TABLE IF EXISTS adiusers;

CREATE TABLE `adiusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adiname` varchar(50) NOT NULL,
  `adipass` varchar(60) NOT NULL,
  PRIMARY KEY (`adiname`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO adiusers VALUES("1","admin","admin");
INSERT INTO adiusers VALUES("3","user","user");

DROP TABLE IF EXISTS thecompinfo;

CREATE TABLE `thecompinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `caddrs` text,
  `cphno` varchar(100) NOT NULL,
  `cemail` varchar(100) NOT NULL,
  `cweb` varchar(100) NOT NULL,
  `clogo` varchar(500) NOT NULL,
  `cptitle` varchar(100) NOT NULL,
  `cslog` varchar(200) NOT NULL,
  `cregno` varchar(100) NOT NULL,
  `ctinno` varchar(100) NOT NULL,
  `cstno` varchar(100) NOT NULL,
  `cvatno` varchar(100) NOT NULL,
  `cstaxper` decimal(10,2) NOT NULL,
  `cvatper` decimal(10,2) NOT NULL,
  `sercharge` decimal(10,2) NOT NULL,
  `cparcel` decimal(10,2) NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS validation;

CREATE TABLE `validation` (
  `current_date` date NOT NULL,
  `install_date` date NOT NULL,
  `last_login_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO validation VALUES("2010-01-01","2010-01-01","2010-01-01","2050-01-01","1");