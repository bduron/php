SELECT titre, resum FROM `film` WHERE resum REGEXP '42' OR titre REGEXP '42' ORDER BY `duree_min` ASC;
