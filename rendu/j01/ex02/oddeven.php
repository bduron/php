#!/usr/bin/php
<?php 		
print("Entrez un nombre: ");
while(($num = fgets(STDIN)) != false)
{
	$num = trim($num);
	if (is_numeric($num))
	{	
		if ($num % 2 == 0)
			print("Le chiffre {$num} est Pair\n");
		elseif ($num % 2 != 0) 
			print("Le chiffre {$num} est Impair\n");
	}
	else 
		print("'{$num}' n'est pas un chiffre\n");
	print("Entrez un nombre: ");	
}
echo "\n";	
?>
