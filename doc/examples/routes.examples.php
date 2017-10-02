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
        'controller'    => \Controller\IndexController::class,
    ],

    // Complex route with parameters
    'star_wars'      => [
        'name'          => 'Star Wars',
        // Use the params in controller with: $this->force or $this->you
        'uri'           => '/may/the/$force/be/with/$you',
        'controller'    => \Controller\StarWarsController::class,
        'layout'        => 'layoutStarWars.tpl',
    ],

];