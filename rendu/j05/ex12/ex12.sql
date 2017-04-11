SELECT nom, prenom FROM fiche_personne WHERE prenom REGEXP '-' OR nom REGEXP '-' ORDER BY nom, prenom ASC;
