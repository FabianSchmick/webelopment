<?php

require_once __DIR__ . "/autoload.php";

// Optional, only required if app uses composer packages
if (file_exists(__DIR__ . "/../vendor/autoload.php")) {
	require_once __DIR__ . "/../vendor/autoload.php";
}

use application\Application;
use application\Config;


$app = new Application();

$app->run();
$app->includeFiles(['functions' => ["functions.inc.php"]]);

// Global config object
$config = new Config('config.inc.php');
