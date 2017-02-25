<?php

require_once __DIR__ . "/autoload.php";

// Optional, only required if app uses composer packages
if (file_exists(__DIR__ . "/../vendor/autoload.php")) {
	require_once __DIR__ . "/../vendor/autoload.php";
}

// Unordered functions
include_once __DIR__ . "/functions/functions.inc.php";

use database\PDODatabase;
use application\Config;


$config = new Config('config.inc.php');

// Display debug messages
if ($config->debug) {
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
} else {
	error_reporting(0);
}

// Database object initialization
if (isset($config->dbType) &&
	isset($config->dbHost) &&
	isset($config->dbName) &&
	isset($config->dbUser) &&
	isset($config->dbPassword)) {

	$pdoDb = new PDODatabase($config->dbType, $config->dbHost, $config->dbName, $config->dbUser, $config->dbPassword);

	$connection = $pdoDb->initializePDOObject();
}