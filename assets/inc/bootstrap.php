<?php

use \assets\inc\classes\PDODatabase;

// Include all classes, config files und functions
$files = array( 			// Array, 1 = include files, 0 = no include
	"classes" => array( 	// Classes
		"sql.class.php" => 1, 		// SQL class
		"route.class.php" => 1,		// Routing class
	),
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

$config = include('config/config.inc.php');		// Common config

if (isset($config['dbType']) &&
	isset($config['dbHost']) &&
	isset($config['dbName']) &&
	isset($config['dbUser']) &&
	isset($config['dbPassword'])) {

	$pdoDb = new PDODatabase($config['dbType'], $config['dbHost'], $config['dbName'], $config['dbUser'], $config['dbPassword']);

	$connection = $pdoDb->initializePDOObject();
}


//if(!isset($_SESSION)) { session_start(); }		// Session start