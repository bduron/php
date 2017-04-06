#!/usr/bin/php
<?php


function is_valid_label($argv, $labels)
{
	


}

function create_hashtab($label, $csv, $labels, $argv)
{

	foreach ($csv as $line)
		$$label[$line[$labels[$argv[2]]]] = $line[$labels[$label]]; 

	return ($$label);
}

function main($argv, $argc)
{
	$labels = ['nom' => 0, 'prenom' => 1, 'mail' => 2, 'IP' => 3, 'pseudo' => 4];

	is_valid_label() or die ("wrong label\n"); // a completer

	file_exists($argv[1]) 
		or die ("Cannot find $argv[1]\n");

	if (($fp = fopen($argv[1], 'r')) === false)
		return (0);

	while ($csv[] = fgetcsv($fp, 0, ';'));

//	array_pop($csv);	

	print_r($csv);	

	

	$nom = create_hashtab('nom', $csv, $labels, $argv);	
	$prenom = create_hashtab('nom', $csv, $labels, $argv);	
	$mail = create_hashtab('nom', $csv, $labels, $argv);	
	$IP = create_hashtab('nom', $csv, $labels, $argv);	
	$pseudo = create_hashtab('nom', $csv, $labels, $argv);	
	print_r($nom);


	// correct error 
	fclose($argv[1]);
}

main($argv, $argc);

?>
