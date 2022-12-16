

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO admins(name, email, password, status)
VALUES('Nathan', 'nmdunn@admin.com', '$2y$10$tzxgJ6/ratN.qfbTKVO7feFQNvD6t/m9U04JsmAlCGHlY0iD/yejq', 'admin');
INSERT INTO admins(name, email, password, status)
VALUES('Nathan', 'nmdunn@staff.com', '$2y$10$tzxgJ6/ratN.qfbTKVO7feFQNvD6t/m9U04JsmAlCGHlY0iD/yejq', 'staff');
