<?php

return [

    // True will display php errors
    "debug"      => true,

    // Path for the assets
    "assetsPath" => "/assets",

    // Default layout
    'defaultLayout'  => 'layout.tpl',

    // Layout values
    "layout.tpl" => [

        "main.css"   => "main.css",
        "custom.css" => "custom.css",
        "main.js"    => "main.js",
        "favicon"    => "favicon.ico",
        "header"     => "header.tpl",

    ],

    // Database config
    "database"  => [

        "dbType"     => "mysql",
        "dbHost"     => "localhost",
        "dbName"     => "application",
        "dbUser"     => "root",
        "dbPassword" => "",

    ],

];
