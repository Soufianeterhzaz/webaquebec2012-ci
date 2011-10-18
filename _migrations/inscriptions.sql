CREATE TABLE  `inscriptions` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`created` INT NOT NULL ,
`nom_complet` VARCHAR( 120 ) NOT NULL ,
`courriel` VARCHAR( 120 ) NOT NULL ,
`telephone` VARCHAR( 120 ) NOT NULL ,
`age` VARCHAR( 2 ) NOT NULL ,
`etudiant` BOOL NOT NULL ,
`ecole` VARCHAR( 120 ) NOT NULL ,
`employeur` VARCHAR( 120 ) NOT NULL ,
`environnement` INT NOT NULL ,
`fonction` INT NOT NULL ,
`fonction_autre` INT NOT NULL ,
`profil` TEXT NOT NULL ,
`linkedin` VARCHAR( 255 ) NOT NULL ,
`twitter` VARCHAR( 50 ) NOT NULL ,
`question1` TEXT NOT NULL ,
`question2` TEXT NOT NULL ,
`question3` TEXT NOT NULL ,
`question4` TEXT NOT NULL ,
`allergies` TEXT NOT NULL ,
`urgenec_nom` VARCHAR( 120 ) NOT NULL ,
`urgence_tel` VARCHAR( 120 ) NOT NULL
) ENGINE = MYISAM ;