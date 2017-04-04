<?php
function ft_split($str)
{
	$split = array_filter(array_map('trim', explode(" ", $str)));
	sort($split);
	return ($split);
}
?>
