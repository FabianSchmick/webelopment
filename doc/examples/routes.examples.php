<?php

/* ---------------------------------------------------------------- */
/*                    Defining routes examples                      */
/* ---------------------------------------------------------------- */

// Define your routes in app/config/routes.inc.php
return [

    // Simple route without parameters
    'home'      => [
        'name'          => 'Home',
        'uri'           => '/',
        'controller'    => \controller\IndexController::class,
        'layout'        => 'layout.tpl',
    ],

    // Complex route with parameters
    'star_wars'      => [
        'name'          => 'Star Wars',
        // Use the params in controller with: $this->routeConfig->arguments['force'] or $this->routeConfig->arguments['you']
        'uri'           => '/may/the/$force/be/with/$you',
        'controller'    => \controller\StarWarsController::class,
        'layout'        => 'layout.tpl',
    ],

];