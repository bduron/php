#!/usr/bin/php
<?php
$hash = [];
$key = $argv[1];

$i = 0;
foreach($argv as $arg)
{
	if ($i++ <= 1)
		continue; 
	$tmp = explode(":", $arg);
	$hash[$tmp[0]] = $tmp[1];
}
if ($hash[$key]) /// HOW TO CHECK IF KEY EXIST ? 
	print("$hash[$key]\n");
// FAIL ON : ./search_it\!.php "toto" "key1:val1" "key2:val2" "0:hop"
?>
