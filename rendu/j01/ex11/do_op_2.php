#!/usr/bin/php
<?php
if ($argc != 2  )
{
	print("Incorrect Parameters\n");
	return (1);
}

$vars = sscanf($argv[1], "%d %c %d %s");

$a = $vars[0];
$b = $vars[2];
$op = $vars[1];

if (is_numeric($a) == false || is_numeric($b) == false 
	|| ($b == 0 && $op == '%') || ($b == 0 && $op == '/') 
	|| $vars[3] != false)
{
	print("Syntax Error\n");
	return (1);
}	

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
