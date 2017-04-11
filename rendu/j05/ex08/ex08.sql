SELECT nom, prenom, SUBSTR(fiche_personne.date_naissance,1,10) AS 'date de naissance' FROM fiche_personne WHERE date_format(date_naissance, '%Y') = 1989 ORDER BY nom;
