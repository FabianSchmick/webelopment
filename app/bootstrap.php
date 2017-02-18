<?php

require_once __DIR__ . "/autoload.php";

// Optional, only required if app uses composer packages
if (file_exists(__DIR__ . "/../vendor/autoload.php")) {
	require_once __DIR__ . "/../vendor/autoload.php";
}

use database\PDODatabase;

// Include all function files
$files = array( 			// Array, 1 = include files, 0 = no include
	"functions" => array( 	// Functions
		"functions.inc.php" => 1, 	// Unordered functions
	),
);

foreach($files as $folder => $file_array) { 	// Loop Array
	foreach($file_array as $file => $include) {
		if($include) {	// If include Bit is set
			include_once($folder."/".$file); 	// Include files
		}
	}
}

$config = include('config/config.inc.php');		// Common config

// Display debug messages
if ($config['debug']) {
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
} else {
	error_reporting(0);
}

// Database object initialization
if (isset($config['dbType']) &&
	isset($config['dbHost']) &&
	isset($config['dbName']) &&
	isset($config['dbUser']) &&
	isset($config['dbPassword'])) {

	$pdoDb = new PDODatabase($config['dbType'], $config['dbHost'], $config['dbName'], $config['dbUser'], $config['dbPassword']);

	$connection = $pdoDb->initializePDOObject();
}