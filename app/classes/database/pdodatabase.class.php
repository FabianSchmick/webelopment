<?php

namespace database;

use PDO;
use PDOException;

class PDODatabase
{
	/**
	 * @var string $dbType Database Type (e.g. mysql)
	 */
	private $dbType = "";

	/**
	 * @var string $dbHost Database Host (e.g. localhost)
	 */
	private $dbHost = "";

	/**
	 * @var string $dbName Database Name (e.g. application)
	 */
	private $dbName = "";

	/**
	 * @var string $dbUser Database User (e.g. root)
	 */
	private $dbUser = "";

	/**
	 * @var string $dbPassword Database User Password (e.g. "")
	 */
	private $dbPassword = "";


	/**
	 * PDODatabase constructor.
	 *
	 * @param string $dbType Database Type
	 * @param string $dbHost Database Host
	 * @param string $dbName Database Name
	 * @param string $dbUser Database User
	 * @param string $dbPassword Database User Password
	 */
	public function __construct($dbType, $dbHost, $dbName, $dbUser, $dbPassword)
	{
		$this->dbType = $dbType;
		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		$this->dbUser = $dbUser;
		$this->dbPassword = $dbPassword;
	}


	/**
	 * Initialize PDO Object
	 *
	 * @return PDO $connection The db connection
	 */
	public function initializePDOObject()
	{
		try{
			$connection = new PDO($this->dbType.':host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPassword);
		} catch(PDOException $e) {
			echo 'ERROR: '.$e->getMessage();
		}

		return $connection;
	}

	/**
	 * Query from PDO db
	 *
	 * @param PDO $connection Db connection
	 * @param string $sql SQL statement
	 * @param mixed $bindings Bindings for the SQL statement
	 * @return array|bool Query result
	 */
	public function query(PDO $connection, $sql, $bindings)
	{
		$stmt = $connection->prepare($sql);
		$stmt->execute($bindings);

		$results = $stmt->fetchAll();

		return $results ? $results : false;
	}

	/**
	 * Find All from one table
	 *
	 * @param PDO $connection Db connection
	 * @param string $table The table to query
	 * @return \PDOStatement Query result
	 */
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