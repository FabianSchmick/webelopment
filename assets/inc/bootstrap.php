<?php

require_once "autoload.php";

// Include all functions and config files
$files = array( 			// Array, 1 = include files, 0 = no include
	"functions" => array( 	// Functions
		"functions.inc.php" => 1, 	// Unordered functions
	),
	"config" => array( 		// Config Files
		"global.config.inc.php" => 1, 		// Global config
	)
);

foreach($files as $folder => $file_array) { 	// Loop Array
	foreach($file_array as $file => $include) {
		if($include) {	// If include Bit is set
			include_once($folder."/".$file); 	// Include files
		}
	}
}

use database\PDODatabase;

$config = include('config/config.inc.php');		// Common config

// Show debug messages
if ($config['debug']) {
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
} else {
	error_reporting(0);
}

if (isset($config['dbType']) &&
	isset($config['dbHost']) &&
	isset($config['dbName']) &&
	isset($config['dbUser']) &&
	isset($config['dbPassword'])) {

	$pdoDb = new PDODatabase($config['dbType'], $config['dbHost'], $config['dbName'], $config['dbUser'], $config['dbPassword']);

	$connection = $pdoDb->initializePDOObject();
}


//if(!isset($_SESSION)) { session_start(); }		// Session start