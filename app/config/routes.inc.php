<?php

return [

    // Define your routes here
    'home'      => [
        'name'          => 'Home',
        'uri'           => '/',
        'controller'    => \controller\IndexController::class,
        'layout'        => 'layout.tpl',
    ],

];
