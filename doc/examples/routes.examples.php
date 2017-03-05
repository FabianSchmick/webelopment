<?php

/* ---------------------------------------------------------------- */
/*                    Defining routes examples                      */
/* ---------------------------------------------------------------- */

// Define your routes in app/config/routes.inc.php
return [

    // Simple route without parameters
    'home'      => [
        'name'      => 'Home',
        'uri'       => '/',
        'target'    => 'frontend/index.php'
    ],

    // Complex route with parameters
    'star_wars' => [
        'name'      => 'Star Wars',
        // Use the params in target with: $params['arguments']['force'] or $params['arguments']['you']
        'uri'       => '/may/the/$force/be/with/$you',
        'target'    => 'frontend/index.php'
    ],

];