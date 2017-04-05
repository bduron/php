#!/usr/bin/php
<?php
// WARNING doesnt not handle "9999 % 2wwww" 
if ($argc != 2)
{
	print("Incorrect Parameters\n");
	return (1);
}

$vars = sscanf($argv[1], "%d %c %d");

$a = $vars[0];
$b = $vars[2];
$op = $vars[1];

if (is_numeric($a) == false or is_numeric($b) == false)
{
	print("Syntax Error\n");
	return (1);
}	

#print_r($vars);
#print("$a $op $b\n");

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
		print("Syntax Error\n");
}

?>
