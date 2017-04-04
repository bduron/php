#!/usr/bin/php
<?php
$ssap = [];
foreach ($argv as $arg)
{
	$split = array_filter(array_map('trim', explode(" ", $arg)));
	foreach ($split as $word)
		array_push($ssap, $word);
}	
array_shift($ssap);
sort($ssap);
foreach ($ssap as $param)
	print($param."\n");
?>
