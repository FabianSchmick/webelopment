<?php

namespace Application;

use Model\PDODatabase;

class Application
{
    /**
     * @var array $config Config array;
     */
    private $config = [];

    /**
     * @var PDODatabase $db PDO database object
     */
    private $db;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->config->loadFromFile('config.inc.php');
        $this->db = $this->initDbConnection();
    }

    /**
     * Runs the application
     */
    public function run()
    {
        $this->checkDebugMode();
    }

    /**
     * Initialises the routes defined in app/config/routes.inc.php
     */
    public function initRoutes()
    {
        $route = new Route();

        $routesConf = include __DIR__ . '/../../config/routes.inc.php';

        foreach ($routesConf as $routeConf) {

            $uri = $routeConf['uri'];

            if (preg_match_all('/\$(.*?(?=\/)|.*?$)/', $routeConf['uri'], $matches)) {
                $uri = preg_replace('/\$(.*?(?=\/)|.*?$)/', '.*', $routeConf['uri']);
            }

            $route->add($uri, $routeConf, $matches[1], function($params) {
                $this->config->route = $params['config'];

                $args = [];
                if (isset($params['arguments'])) {
                    $args = $params['arguments'];
                }

                $controller = new $params['config']['controller']($this->config, $this->db, $args);

                $controller->indexAction();
            });
        }

        $findUrl = $route->submit();

        if (!$findUrl) {
            header('HTTP/1.0 404 Not Found');
            include_once __DIR__ . '/../../../src/Views/errors/404_de.html';
        }
    }

    /**
     * Sets error reporting
     */
    public function checkDebugMode()
    {
        // Display debug messages
        if ($this->config->debug == true) {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        } else {
            error_reporting(0);
            ini_set("display_errors", 0);
        }
    }

    /**
     * Include files
     *
     * @param array $files The files to be included
     */
    public function includeFiles($files = [])
    {
        foreach($files as $folder => $file_array) { 	// Loop Array
            foreach($file_array as $file) {
                include_once __DIR__ . "/../../" . $folder . "/" . $file; 	// Include files
            }
        }
    }

    /**
     * Database object initialization
     *
     * @return \PDO|string The Db connection|Error message
     */
    public function initDbConnection()
    {
        if (!empty($this->config->database['dbType']) &&
            !empty($this->config->database['dbHost']) &&
            !empty($this->config->database['dbName']) &&
            !empty($this->config->database['dbUser']) &&
            isset($this->config->database['dbPassword'])) {

            $pdoDb = new PDODatabase(
                $this->config->database['dbType'],
                $this->config->database['dbHost'],
                $this->config->database['dbName'],
                $this->config->database['dbUser'],
                $this->config->database['dbPasswor']
            );

            $pdoDb->initializePDOObject();
        } else {
            $pdoDb = "Error - no database connection configured.";
        }

        return $pdoDb;
    }
}