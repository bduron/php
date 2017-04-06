#!/usr/bin/php
<?php

function main()
{
	date_default_timezone_set('Europe/Berlin');
	$user = get_current_user();
	$utmpx_header = 'a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad';	
	$offset = 628;
	$fp = fopen('/var/run/utmpx', 'rb') 
		or die ("utmpx file not found\n");
	
	while ((($utmpx = fread($fp, 628))))
	{	
		$who = unpack($utmpx_header, $utmpx);
			
	
		if (trim($who['type']) == 7 && trim($who['user']) === trim($user))
			$array[] = array_map("trim", $who);
	}
	array_multisort($array);
	foreach ($array as $who)
		print($who['user']."   ".$who['line']."  ".date("M  j H:i", $who['time1'])." \n");	
}

main();

?>
