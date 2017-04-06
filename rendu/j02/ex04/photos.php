#!/usr/bin/php
<?php

function main($argc, $argv)
{
    if ($argc != 2)
        exit("Missing Parameters\n");
    $url = $argv[1];
    $arr = explode("/", $argv[1]);
    $path = $arr[2];
    $site = file_get_contents($argv[1]) or die($argv[1]." can't be reached\n");

    preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$site, $images);

    mkdir($path) or die("Failed to create directory\n");

    preg_match('/^https?\:\/\/[^\/]*/', $argv[1], $tmp);

    foreach($images[1] as $image)
    {
        if ($image)
            copy((($image[0] === '/') ? $tmp[0]."/".$image : $image), $path."/".basename($image));
    }
}

main($argc, $argv);

?>
