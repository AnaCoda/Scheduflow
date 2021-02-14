SET @@time_zone = 'SYSTEM';

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `topics` (
  `topic_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `topicname` text NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `events` (
  `event_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `eventtopic` text NOT NULL,
  `eventname` text NOT NULL,
  `eventtime` DATE, /*Only if the eventtype is Day(0) or sUntil(2)*/
  `eventduration` int(10) NOT NULL,
  `eventtype` int(1) NOT NULL, /*(0)Single day, deletes itself after completion. (1)Indefinite, requires user deletion. (2)Until, will delete after certain calendar day*/
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
