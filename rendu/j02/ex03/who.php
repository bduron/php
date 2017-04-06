#!/usr/bin/php
<?php

	if (!$fp = fopen ('/var/run/utmp', 'rb'))
		return (0);
	
	if (!$data = fread($fp, 1000)) 
		return (0);
	
	$header_fmt = 'A200test';

	
	$header = unpack($header_fmt, $data);

	print_r($header);


?>
