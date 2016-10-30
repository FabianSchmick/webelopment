<?php

// Initialize PDO Object
function initializePDOObject($dbType, $dbHost, $dbName, $dbUser, $dbPassword)
{
	try{
		$connection = new PDO($dbType.':host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPassword);
	} catch(PDOException $e) {
		echo 'ERROR: '.$e->getMessage();
	}

	return $connection;
}

// Query from PDO db
function query(PDO $connection, $sql)
{
	try{
		$results = $connection->query($sql);
	} catch(PDOException $e) {
		echo 'ERROR: '.$e->getMessage();
	}

	return $results;
}

// Find All from one table
function findAll(PDO $connection, $table)
{
	try{
		$results = $connection->query('SELECT * FROM'.$table);
	} catch(PDOException $e) {
		echo 'ERROR: '.$e->getMessage();
	}

	return $results;
}