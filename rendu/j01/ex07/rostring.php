#!/usr/bin/php
<?php

$split = array_filter(array_map('trim', explode(" ", $argv[1])));
array_push($split, array_shift($split));

$i = 0;
$len = count($split);
foreach ($split as $word)
{	
	print($word);
	if ($i++ < $len - 1)
		print(" ");
}
if ($split[0] != false)
	print("\n");
?>
