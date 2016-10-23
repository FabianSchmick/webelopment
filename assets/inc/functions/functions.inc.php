<?php

// Aktive POST und SESSION anzeigen
function dumpParameter()
{
	// Session Parameter 
	echo"<h4>Sitzungsparameter SESSION</h4>";
	foreach($_SESSION as $key => $value){
		echo"<br> Key: $key, Wert: $value";
	}

	// Uebergabeparameter
	echo"<h4>Formularparameter POST</h4>";
	foreach($_POST as $key => $value){
		echo"<br> Key: $key, Wert: $value";
	}
	echo"<hr>";
}