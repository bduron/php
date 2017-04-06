#!/usr/bin/php
<?php

function callback($matches)
{
	$matches[0] = preg_replace_callback('/>(.+?)</s',
		function ($matches2)
		{
			return strtoupper($matches2[0]);
		},
		$matches[0]);

	$matches[0] = preg_replace_callback('/".+?"/',
		function ($matches2)
		{
			return strtoupper($matches2[0]);
		},
		$matches[0]);
	return ($matches[0]);
}

function main($argc, $argv)
{
	if ($argc != 2)
		return (0);

	file_exists($argv[1]) or die("$argv[1] not found\n"); 	
	$file = file_get_contents($argv[1]) or die("Failed to open file\n");
	$test = preg_replace_callback('/<a.*?\/a>/s', "callback", $file);
	echo $test;
}

main($argc, $argv);

?>
