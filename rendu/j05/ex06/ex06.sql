SELECT titre, resum FROM film WHERE lower(resum) REGEXP 'vincent' ORDER BY id_film ASC;
