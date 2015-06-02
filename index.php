<?php

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'parts/game/explain.php';

$url = "http://$host$uri/$extra";

echo nl2br("Welcome to our project's website. \r\n ");
echo nl2br("Compatible hardware: pc, mac, iPad, Galaxy S4/5/6.\r\n");
echo nl2br("Compatible Internet Browsers: Google Chrome, Safari, Firefox.\r\n\r\n");
echo nl2br("Click <a href='$url'>here</a> to strart the game");
