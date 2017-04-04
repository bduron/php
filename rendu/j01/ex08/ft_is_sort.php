#!/usr/bin/php
<?php

function ft_is_sort($tab)
{
	$ascending = $tab; 
	$descending = $tab; 
	
	sort($ascending);
	arsort($descending);
	print_r($tab);
	print_r($ascending);
	print_r($descending);

	if (array_diff_assoc($tab, $ascending) == false)
		return (true);
	if (array_diff_assoc($tab, $descending) == false)
		return (true);
	return (false);
}

$tab = ["z", "b", "c", "d", "e"];
if (ft_is_sort($tab))
	print("true");
else
	print("false");

?>
