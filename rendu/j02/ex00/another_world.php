#!/usr/bin/php
<?php
if ($argc == 1)
	return (1);
$str = preg_replace('/\s\s+/', ' ', trim($argv[1]));	
print($str."\n");	
?>
