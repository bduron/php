#!/usr/bin/php
<?php

if ($argc != 4)
{
	print("Incorrect Parameters\n");
	return (1);
}

$a = trim($argv[1]);
$b = trim($argv[3]);
$op = trim($argv[2]);

switch ($op)
{
	case "+":
		print($a + $b."\n");
		break;
	case "-":
		print($a - $b."\n");
		break;
	case "*":
		print($a * $b."\n");
		break;
	case "/":
		print($a / $b."\n");
		break;
	case "%":
		print($a % $b."\n");
		break;
	default:
		print("Incorrect Parameters\n");
}

?>
