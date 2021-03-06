CREATE TABLE IF NOT EXISTS `iron_web_inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `nom_complet` varchar(120) NOT NULL,
  `courriel` varchar(120) NOT NULL,
  `telephone` varchar(120) NOT NULL,
  `age` varchar(2) NOT NULL,
  `etudiant` tinyint(1) NOT NULL,
  `ecole` varchar(120) NOT NULL,
  `employeur` varchar(120) NOT NULL,
  `environnement` varchar(50) NOT NULL,
  `fonction` varchar(120) NOT NULL,
  `fonction_autre` int(11) NOT NULL,
  `profil` text NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `question1` text NOT NULL,
  `question2` text NOT NULL,
  `question3` text NOT NULL,
  `question4` text NOT NULL,
  `allergies` text NOT NULL,
  `urgenec_nom` varchar(120) NOT NULL,
  `urgence_tel` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
