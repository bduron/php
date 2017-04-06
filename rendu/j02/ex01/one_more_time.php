#!/usr/bin/php
<?php
$matches = [];
$pattern = "/^\s*([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)\s+(\d{1,2})\s+([Jj]anvier|[Ff][eé]vrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]o[uû]t|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd][eé]cembre)\s+(\d{4})\s+(\d{2}:\d{2}:\d{2})\s*$/";
if (preg_match($pattern, $argv[1], $matches) == false)
{
	print("Wrong Format\n");
	return (1);
}
$month = ['/[Jj]anvier/' => 1, '/[Ff][eé]vrier/' => 2, '/[Mm]ars/' => 3, '/[Aa]vril/' => 4, '/[Mm]ai/' => 5, '/[Jj]uin/' => 6, '/[Jj]uillet/' => 7, '/[Aa]o[uû]t/' => 8, '/[Ss]eptembre/' => 9, '/[Oo]ctobre/' => 10, '/[Nn]ovembre/' => 11, '/[Dd][eé]cembre/' => 12];

foreach ($month as $reg => $num)
{
	if (preg_match($reg, $matches[3]) === 1)
		$matches[3] = $num;	
}

date_default_timezone_set('Europe/Berlin');
$str = date("$matches[3]/$matches[2]/$matches[4] $matches[5]");

if (($timestamp = strtotime($str)) == false)
	print("Wrong Format\n");
else
	print($timestamp."\n");

?>
