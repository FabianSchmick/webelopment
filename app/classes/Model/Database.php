<?php

namespace Model;

use PDO;
use PDOException;

class Database
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
	 * @var PDO $connection Db connection
	 */
	private $connection;


	/**
	 * Database constructor.
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
		$this->initializePDOObject();
	}


	/**
	 * Initialize PDO Object
	 */
	public function initializePDOObject()
	{
		try{
			$this->connection = new PDO($this->dbType.':host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPassword, array(
			    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
		} catch(PDOException $e) {
			echo 'ERROR: '.$e->getMessage();
		}
	}

	/**
	 * Query from PDO db
	 *
	 * @param string $sql SQL statement
	 * @param array $bindings Bindings for the SQL statement
	 * @param mixed $fetch_style Controls the contents of the returned array
	 * @return array|bool Query result
	 */
	public function query($sql, $bindings = [], $fetch_style = PDO::FETCH_ASSOC)
	{
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($bindings);

		$results = $stmt->fetchAll($fetch_style);

		return $results ? $results : false;
	}

	/**
	 * Create (Insert), update and delete records
	 *
	 * @param string $sql SQL statement
	 * @param array $bindings Bindings for the SQL statement
	 * @return int Number of last affected rows
	 */
	public function cud($sql, array $bindings)
	{
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($bindings);

		return $stmt->rowCount();
	}

	/**
	 * Find All from one table
	 *
	 * @param string $table The table to query
	 * @param mixed $fetch_style Controls the contents of the returned array
	 * @return \PDOStatement Query result
	 */
	public function findAll($table, $fetch_style = PDO::FETCH_ASSOC)
	{
		try{
			$results = $this->connection->query('SELECT * FROM ' . $table)->fetchAll($fetch_style);
		} catch(PDOException $e) {
			echo 'ERROR: '.$e->getMessage();
		}

		return $results;
	}

    /**
     * Query only one from PDO db
     *
     * @param string $sql SQL statement
     * @param array $bindings Bindings for the SQL statement
     * @param mixed $fetch_style Controls the contents of the returned array
     * @return array|bool Query result
     */
	public function fetchOne($sql, $bindings = [], $fetch_style = PDO::FETCH_ASSOC)
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($bindings);

        $results = $stmt->fetch($fetch_style);

        return $results ? $results : false;
    }
}