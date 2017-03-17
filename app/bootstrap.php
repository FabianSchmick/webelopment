<?php

require_once __DIR__ . "/../vendor/autoload.php";

use application\Application;


$app = new Application();

$app->run();
$app->includeFiles(['functions' => ["functions.inc.php"]]);