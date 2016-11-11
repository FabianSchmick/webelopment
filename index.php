<?php

require 'assets/inc/classes/route.class.php';

use \assets\inc\classes\Route;

$route = new Route();

$route->add('/', function() {
	require_once 'pages/frontend/index.php';
});

$findUrl = $route->submit();

if (!$findUrl) {
	include_once 'pages/frontend/errors/404_de.html';
}