#!/usr/bin/php
<?php

function print_trimmed($str)
{
	for ($i = 0; $i < strlen($str); $i++)
	{	
		if ($str[$i + 1] != ' ' && $str[$i] == ' ')
			echo " ";
		if ($str[$i] != ' ')
			print("$str[$i]");	
	}	
}

$str = trim($argv[1]);		
print_trimmed($str);
print("\n");
?>
