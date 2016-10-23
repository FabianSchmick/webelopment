<?php

// Datenbank Verbindung
function db_connect($dbserver, $dbuser, $dbpassword, $dbname)
{
	$dbh = mysqli_connect ($dbserver, $dbuser, $dbpassword)
	or die ("Fehler bei CONNECT");
	mysqli_select_db ($dbh, $dbname)
	or die ("Fehler bei SELECT_DB");

	return $dbh;
}

// Datenbank Abfrage
function db_query($sql, $dbh)
{
	$result = mysqli_query ($dbh, $sql)
	or die ("Fehler bei QUERY <br> 
	<li> Fehlernummer errno =" .mysqli_errno($dbh). " 
	<li> Fehlertext error =" .mysqli_error($dbh));

	return $result;
}

// Datenbank schliessen
function db_close($dbh)
{
	mysqli_close($dbh);
}