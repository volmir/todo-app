<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$loader = require(__DIR__ . '/../vendor/autoload.php');
$config = require(__DIR__ . '/../config/config.php');

$appication = new \App\Core\Application();
$appication->run($config);

