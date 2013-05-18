CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `contacts` (`id`, `uid`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'contact1', 'contact1@mail.com', '11111111111111111', '2013-05-18 17:20:59', '2013-05-18 17:20:59'),
(2, 1, 'contact2', 'contact2@mail.com', '22222222222222222', '2013-05-18 17:20:59', '2013-05-18 17:20:59'),
(3, 2, 'contact1', 'contact1@mail.com', '11111111111111111', '2013-05-18 17:20:59', '2013-05-18 17:20:59'),
(4, 2, 'contact2', 'contact2@mail.com', '22222222222222222', '2013-05-18 17:20:59', '2013-05-18 17:20:59');

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'user1@mail.com', '$2a$08$9Hmn0ZrBRZlXsBRHnEOt3.i2llvTi.3j.BSpKshIPMaYdS4rJ/fWe', '2013-05-18 17:20:59', '2013-05-18 17:20:59'),
(2, 'user2@mail.com', '$2a$08$Yo0r3elHpERb5n/ygPvDT.QivIcP1zMn731rN3gYyY1sSWLZh7VZ6', '2013-05-18 17:20:59', '2013-05-18 17:20:59');
