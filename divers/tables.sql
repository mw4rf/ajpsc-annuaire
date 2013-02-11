CREATE TABLE  `utilisateur` (
 `login` TEXT NOT NULL ,
 `pass` TEXT NOT NULL ,
 `nom` TEXT NOT NULL ,
 `prenom` TEXT NOT NULL ,
 `promotion` INT NOT NULL ,
 `nationalite` TEXT NOT NULL ,
 `naissance` DATE NOT NULL ,
 `adresse` TEXT NOT NULL ,
 `email` TEXT NOT NULL ,
 `q1` TEXT NOT NULL ,
 `q2` TEXT NOT NULL ,
 `q3` TEXT NOT NULL ,
 `q4` TEXT NOT NULL ,
 `q5` TEXT NOT NULL ,
 `q6` TEXT NOT NULL ,
 `q7` TEXT NOT NULL
) TYPE = MYISAM ;

CREATE TABLE  `admin` (
 `user` TEXT NOT NULL ,
 `pass` TEXT NOT NULL
) TYPE = MYISAM ;