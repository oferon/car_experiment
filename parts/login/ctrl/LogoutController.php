<?php

namespace carexperiment\parts\login\controller;

session_start();
session_unset();
session_destroy();

$url = 'http://localhost/carexperiment/';
header('Location: ' . $url);
exit();