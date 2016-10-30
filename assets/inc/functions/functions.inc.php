<?php

// Active POST and SESSION
function dumpParameter()
{
	// Session Parameter 
	echo"<h4>Session-parameter SESSION</h4>";
	foreach($_SESSION as $key => $value){
		echo"<br> Key: $key, Value: $value";
	}

	// Uebergabeparameter
	echo"<h4>Form-parameter POST</h4>";
	foreach($_POST as $key => $value){
		echo"<br> Key: $key, Value: $value";
	}
	echo"<hr>";
}