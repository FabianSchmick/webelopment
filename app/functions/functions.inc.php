<?php

// Active POST and SESSION
function dumpParameter()
{
	// Session Parameter 
	echo"<h4>----- SESSION -----</h4>";
	foreach($_SESSION as $key => $value){
		echo "<br> Key: $key, Value: $value";
	}

	// Post Parameter
	echo"<h4>----- POST -----</h4>";
	foreach($_POST as $key => $value){
		echo "<br> Key: $key, Value: $value";
	}
	echo "<hr>";
}