<?php

session_start();
session_unset();
session_destroy();

$url = 'http://localhost/carexperiment/';
header('Location: ' . $url);
exit();