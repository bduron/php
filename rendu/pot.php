#!/usr/bin/php
<?php
$html = file_get_contents('http://www.42.fr/');
preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
print_r($matches);
foreach ($matches[1] as $img)
	copy($img, "/Users/bduron/myprojects/piscine_php/rendu/j02/ex04/imgs/".basename($img));
?>
