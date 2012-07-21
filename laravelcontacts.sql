-- 
-- Structure for table `contacts`
-- 

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- 
-- Data for table `contacts`
-- 

INSERT INTO `contacts` (`cid`, `uid`, `name`, `email`, `phone`) VALUES
  ('38', '7', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('39', '7', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('40', '7', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('41', '7', 'contact4', 'contact4@mail.com', '444444444444444'),
  ('42', '8', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('43', '8', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('44', '8', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('47', '10', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('48', '10', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('49', '10', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('50', '10', 'contact4', 'contact4@mail.com', '444444444444444'),
  ('51', '8', 'contact4', 'contact4@mail.com', '444444444444444'),
  ('52', '8', 'contact5', 'contact5@mail.com', '555555555555555'),
  ('53', '8', 'contact6', 'contact6@mail.com', '666666666666666'),
  ('54', '8', 'contact7', 'contact7@mail.com', '777777777777777'),
  ('64', '10', 'contact5', 'contact5@mail.com', '555555555555555'),
  ('65', '10', 'contact6', 'contact6@mail.com', '666666666666666'),
  ('72', '13', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('73', '13', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('74', '12', 'conatct1', 'contact1@mail.com', '111111111111111'),
  ('75', '11', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('76', '11', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('77', '11', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('78', '10', 'contact8', 'contact8@mail.com', '888888888888888'),
  ('79', '10', 'contact7', 'contact7@mail.com', '777777777777777');

-- 
-- Structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `contacts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- 
-- Data for table `users`
-- 

INSERT INTO `users` (`uid`, `email`, `password`, `contacts`) VALUES
  ('7', 'user2@mail.com', '$2a$08$w2yDyOmfVMWtsSB1kWHXn..nQPo/wO0CWWTmsUuyw7Yu0R7utccOe', '4'),
  ('8', 'user3@mail.com', '$2a$08$2gzlfCgUXhsSqvJJbyrxL.1t7qfBAX7yyxviXOo/Waj8.kd4HSGke', '7'),
  ('9', 'user4@mail.com', '$2a$08$EwJ6Osbd3AA4qyDyLG5nw.LDuzuQ4jBLHzXrT1ZaUgwQmCVoa6pqC', '0'),
  ('10', 'user1@mail.com', '$2a$08$VxFkmUEmO7RQEYhusJj7KOrtK88rYOlwP0B6liX8NmbgUkQnBgCqa', '8'),
  ('11', 'user5@mail.com', '$2a$08$jz7D6t8F7f76gQ1m8IcHM.Eyfn3QpDGPqfb7dJXuJq95oQJW3Jdlq', '3'),
  ('12', 'user6@mail.com', '$2a$08$jz7D6t8F7f76gQ1m8IcHM.Eyfn3QpDGPqfb7dJXuJq95oQJW3Jdlq', '1'),
  ('13', 'user7@mail.com', '$2a$08$jz7D6t8F7f76gQ1m8IcHM.Eyfn3QpDGPqfb7dJXuJq95oQJW3Jdlq', '2');

