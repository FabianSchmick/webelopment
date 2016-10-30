<?php

require 'assets/inc/classes/route.class.php';

use \assets\inc\classes\Route;

$route = new Route();

$route->add('/', function() {
	require_once 'pages/frontend/index.php';
});

$route->submit();