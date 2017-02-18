<?php

namespace database;

use PDO;
use PDOException;

class PDODatabase
{
	/*
	 * Database Type (e.g. mysql)
	 */
	private $dbType;

	/*
	 * Database Host (e.g. localhost)
	 */
	private $dbHost;

	/*
	 * Database Name (e.g. application)
	 */
	private $dbName;

	/*
	 * Database User (e.g. root)
	 */
	private $dbUser;

	/*
	 * Database User Password (e.g. "")
	 */
	private $dbPassword;


	// Constructor
	public function __construct($dbType, $dbHost, $dbName, $dbUser, $dbPassword)
	{
		$this->dbType = $dbType;
		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		$this->dbUser = $dbUser;
		$this->dbPassword = $dbPassword;
	}


	// Initialize PDO Object
	public function initializePDOObject()
	{
		try{
			$connection = new PDO($this->dbType.':host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPassword);
		} catch(PDOException $e) {
			echo 'ERROR: '.$e->getMessage();
		}

		return $connection;
	}

	// Query from PDO db
	public function query(PDO $connection, $sql, $bindings)
	{
		$stmt = $connection->prepare($sql);
		$stmt->execute($bindings);

		$results = $stmt->fetchAll();

		return $results ? $results : false;
	}

	// Find All from one table
	public function findAll(PDO $connection, $table)
	{
		try{
			$results = $connection->query('SELECT * FROM '.$table);
		} catch(PDOException $e) {
			echo 'ERROR: '.$e->getMessage();
		}

		return $results;
	}
}