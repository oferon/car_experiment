<?php

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'parts/game/explain.php';

$url = "http://$host$uri/$extra";

echo nl2br("Welcome to our project's website. \r\n Before you login please make sure you are using compatible hardware and software:\r\n");
echo nl2br("Hardware: pc or mac, but not iPad.\r\n");
echo nl2br("Internet browser: Google Chrome or Safari, but not Microsoft Internet Explorer.\r\n\r\n");
echo nl2br("Click <a href='$url'>here</a> to strart the game");
