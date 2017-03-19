# How to define routes?

This section explains how to use the route system:


* For an example look in */examples/routes.examples.php*
    * `'name'` defines the name of the route (required)
    * `'uri'` defines the route uri (required)
        * for GET parameters in the route use: `\$var`
        * these can later be used in the controller with: `$this->routeConfig->arguments['var']`
    * `'controller'` defines the controller which will handle the page (required)
    * `'layout'` defines the layout which will be used (required)
    * `'title'` defines an optional title for the page (if not set `'name'` will be used as the page title) (optional)