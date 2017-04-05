#!/usr/bin/php
<?php

function comp($str1, $str2)
{
	$ascii = "abcdefghijklmnopqrstuvwxyz0123456789 !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	$i = 0;
	$len = (strlen($str1) < strlen($str2)) ? strlen($str1) : strlen($str2); 	

	$str1 = strtolower($str1);	
	$str2 = strtolower($str2);	
	while ($i < $len && $str1[$i] == $str2[$i])	
		$i++;			
	if (stripos($ascii, $str1[$i]) === false && stripos($ascii, $str2[$i]) === false)
		        return (ord($str1[$i]) - ord($str2[$i]));
    else if (stripos($ascii, $str1[$i]) === false && stripos($ascii, $str2[$i]) !== false)
		        return (1);
    else if (stripos($ascii, $str1[$i]) !== false && stripos($ascii, $str2[$i]) === false)
		        return (-1);
    return (stripos($ascii, $str1[$i]) - stripos($ascii, $str2[$i]));
}

$tab = [];
array_shift($argv);
foreach ($argv as $arg)
	$tab = array_merge($tab, explode(" ", $arg));

usort($tab, "comp");
foreach ($tab as $word)
	print($word."\n");

?>
