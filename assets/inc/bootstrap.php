<?php

// Include all classes, config files und functions
$files = array( 			// Array, 1 = include files, 0 = no include
	"classes" => array( 	// Classes
		"sql.class.php" => 1, 		// SQL class
	),
	"functions" => array( 	// Functions
		"functions.inc.php" => 1, 	// Unordered functions
	),
	"config" => array( 		// Config Files
		"config.inc.php" => 1, 		// Common config
	)
);

foreach($files as $folder => $file_array) { 	// Loop Array
	foreach($file_array as $file => $include) {
		if($include) {	// If include Bit is set
			include_once($folder."/".$file); 	// Include files
		}
	}
}

$connection = initializePDOObject($dbType, $dbHost, $dbName, $dbUser, $dbPassword);


//if(!isset($_SESSION)) { session_start(); }		// Session start