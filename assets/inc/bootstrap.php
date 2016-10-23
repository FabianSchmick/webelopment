<?php

// Einbinden aller Klassen, Konfigurationsdateien und Funktionen
$files = array( 			// Array mit den Daten, eine 1 gibt an, dass das File includiert werden soll
	"classes" => array( 	// Klassen
		"sql.class.php" => 1, 		// SQL Klasse
	),
	"functions" => array( 	// Funktionen
		"functions.inc.php" => 1, 	// Unzuordbare Funktionen
	),
	"config" => array( 		// Konfigurationsdateien
		"config.inc.php" => 1, 		// Allgemeine, änderbare Config
	)
);

foreach($files as $folder => $file_array) { 	// Array durchgehen
	foreach($file_array as $file => $include) { // herunterbrechen
		if($include) {	// Wenn include Bit gesetzt
			include_once($folder."/".$file); 	// Dateien includieren
		}
	}
}

$dbh = db_connect($dbserver, $dbuser, $dbpassword, $dbname);

//if(!isset($_SESSION)) { session_start(); }		// Session starten