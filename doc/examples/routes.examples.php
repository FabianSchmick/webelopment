<?php

/* ---------------------------------------------------------------- */
/*                    Defining routes examples                      */
/* ---------------------------------------------------------------- */

$route->add('/name', function() {
    echo 'Name Home';
});

$route->add('/name/.*', function($slug) {
    echo "Name $slug";
});

$route->add('/may/the/.*/be/with/.*', function($first, $second) {
    echo "May the $first be with $second";
});