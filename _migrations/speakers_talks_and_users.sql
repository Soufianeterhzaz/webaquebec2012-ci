CREATE TABLE IF NOT EXISTS `speakers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `site_url` varchar(512) DEFAULT '',
  `twitter_url` varchar(512) DEFAULT '',
  `bio` text,
  `photo_path` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `speakers_talks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `speaker_id` int(11) DEFAULT NULL,
  `talk_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `talks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) DEFAULT '',
  `summary` text,
  `description` text,
  `keywords` varchar(256) DEFAULT '',
  `date` date DEFAULT NULL,
  `start_hour` varchar(5) DEFAULT NULL,
  `end_hour` varchar(5) DEFAULT NULL,
  `room` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
