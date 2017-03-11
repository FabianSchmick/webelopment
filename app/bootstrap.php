<?php

require_once __DIR__ . "/../vendor/autoload.php";

use application\Application;
use application\Config;


$app = new Application();

$app->run();
$app->includeFiles(['functions' => ["functions.inc.php"]]);

// Global config object
$config = new Config('config.inc.php');
