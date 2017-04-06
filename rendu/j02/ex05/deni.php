#!/usr/bin/php
<?php

function is_valid($argv, $argc, $labels)
{
	if ($argc != 3 or !array_key_exists($argv[2], $labels))
		die();	
}

function create_hashtab($label, $csv, $labels, $argv)
{
	foreach ($csv as $line)
		$tmp[$line[$labels[$argv[2]]]] = $line[$labels[$label]]; 

	return ($tmp);
}

function get_csv($argv)
{
	file_exists($argv[1]) 
		or die();

	if (($fp = fopen($argv[1], 'r')) === false)
		return (0);

	while ($csv[] = fgetcsv($fp, 0, ';'));
	array_pop($csv);	
	array_shift($csv);	
	fclose($fp);
	return ($csv);
}

function main($argv, $argc)
{
	$labels = ['nom' => 0, 'prenom' => 1, 'mail' => 2, 'IP' => 3, 'pseudo' => 4];
	is_valid($argv, $argc, $labels);

	$csv = get_csv($argv);

	$nom = create_hashtab("nom", $csv, $labels, $argv);	
	$prenom = create_hashtab('prenom', $csv, $labels, $argv);	
	$mail = create_hashtab('mail', $csv, $labels, $argv);	
	$IP = create_hashtab('IP', $csv, $labels, $argv);	
	$pseudo = create_hashtab('pseudo', $csv, $labels, $argv);	

	while(1)
	{
		print("Entrez votre commande: ");
		if (($cmd = fgets(STDIN)) === false)
			break;	
		eval($cmd); 
	}
	echo "\n";	

}

main($argv, $argc);

?>
