<?php

namespace controller;

use application\Config;
use model\PDODatabase;
use view\Template;

abstract class Controller
{
    /**
     * @var array $config Config array;
     */
    protected $config = [];

    /**
     * @var PDODatabase $db PDO database object
     */
    protected $db;

    /**
     * @var array $arguments Arguments of the route
     */
    protected $arguments = [];

    /**
     * The indexAction (like main method)
     *
     * @return mixed
     */
    abstract public function indexAction();


    /**
     * Controller constructor.
     * @param Config $config The app config
     * @param PDODatabase|String $db The db object|The not used string
     * @param array $arguments Arguments of the route
     */
    public function __construct(Config $config, $db, $arguments = [])
    {
        $this->config = $config;
        $this->db = $db;
        $this->arguments = $arguments;
    }

    /**
     * Magic Setter for the arguments
     *
     * @param mixed $key The key to set
     * @param mixed $value The value to set
     */
    public function __set($key, $value)
    {
        $this->arguments[$key] = $value;
    }

    /**
     * Magic Getter for the arguments
     *
     * @param mixed $key The key to get
     * @return mixed
     */
    public function __get($key)
    {
        if(isset($this->arguments[$key])) {
            return $this->arguments[$key];
        } else {
            return null;
        }
    }

    /**
     * Renders a template
     *
     * @param string $tpl The template filename
     * @param array $vars The template variables
     * @return boolean True
     */
    public function renderTpl($tpl, $vars = [])
    {
        // Init the content with optional variables
        $profile = new Template(__DIR__ . '/../../../src/views/' . $tpl);
        $profile->set($vars);

        // Get the layout
        if (isset($this->config->route['layout'])) {
            $useLayout = $this->config->route['layout'];
        } else {
            $useLayout = $this->config->defaultLayout;
        }

        $layout = $this->renderLayout($useLayout);

        // Put layout and content together
        if (!isset($this->config->route['title'])) {
            $layout['vars']['title'] = $this->config->route['name'];
        } else {
            $layout['vars']['title'] = $this->config->route['title'];
        }
        $layout['vars']['content'] = $profile->output();
        $layout['layout']->set($layout['vars']);

        echo $layout['layout']->output();

        return true;
    }

    /**
     * Renders a layout for templates
     *
     * @param string $file The filename
     * @return array Layout and the needed layout vars
     */
    public function renderLayout($file)
    {
        // Init the layout for the content
        $layoutVars = $this->config->$file;

        $layout = new Template(__DIR__ . '/../../layout/' . $file);

        // Define the layouts variables
        foreach ($layoutVars as $key => $layoutVar) {
            if (preg_match('/\w*(.css)/', $key)) {
                $layoutVars[$key] = preg_replace('/\w*(.css)/', '/../../..' . $this->config->assetsPath .'/css/'. $layoutVar, $key);
            }

            if (preg_match('/\w*(.js)/', $key)) {
                $layoutVars[$key] = preg_replace('/\w*(.js)/', '/../../..' . $this->config->assetsPath .'/js/'. $layoutVar, $key);
            }
        }

        return [
            'layout' => $layout,
            'vars'   => $layoutVars,
        ];
    }

    /**
     * Gets the breadcrumbs of the current route
     *
     * @return array $breadcrumbs
     */
    public function getBreadcrumbs()
    {
        $routes = include __DIR__ . '/../../config/routes.inc.php';
        $breadcrumbs = array();

        // Get the subroutes from current route
        if (preg_match_all('/\/.*?(?=\/)|\/.*./', $this->config->route['uri'], $currentRouteGroups)) {
            foreach ($currentRouteGroups[0] as $i => $currentRouteGroup) {
                $uriNeedle = implode("", $currentRouteGroups[0]);
                $uriNeedle = str_replace('$', '\$', $uriNeedle);
                $uriNeedles[] = str_replace('/', '\/', $uriNeedle);
                array_pop($currentRouteGroups[0]);
            }

            // Compare the route pieces with the routes from the config file to get the breadcrumbs
            foreach ($uriNeedles as $i => $currentRouteGroup) {
                $breadcrumbs[] = $this->compareUris($currentRouteGroup, $routes);
            }
        }

        // If route '/' exists, then add it to the breadcrumbs
        foreach ($routes as $route) {
            if (preg_match_all('/^\/$/', $route['uri'], $indexRoute) && $route != $this->config->route) {
                $route['url'] = $this->getUrl($route['uri']);
                array_push($breadcrumbs, $route);
            }
        }

        // From first route to the current - remove not founded routes - reindex array
        $breadcrumbs = array_values(array_filter(array_reverse($breadcrumbs)));

        return $breadcrumbs;
    }

    /**
     * Compares URIs and returns their match
     *
     * @param string $currentUri The current uri to compare
     * @param array $compareUris The array to compare with the current
     * @return array $equalUri The match
     */
    private function compareUris($currentUri, array $compareUris)
    {
        $match = [];

        foreach ($compareUris as $compareUri) {
            if (preg_match_all('/' . $currentUri . '[\/]?(?!.)/', $compareUri['uri'], $matches)) {

                $match = $compareUri;

                // Replace the uri variables with their correct values
                preg_match_all('/\$(.*?(?=\\\)|.*?$)/', $currentUri, $vars);

                foreach ($vars[1] as $var) {
                    $match['uri'] = str_replace('$' . $var, $this->{$var}, $match['uri']);
                }

                $match['url'] = $this->getUrl($match['uri']);
            }
        }

        return $match;
    }

    /**
     * Generates an URL for an URI
     *
     * @param string $uri An URI to generate an URL for
     * @return string The generated URL
     */
    public function getUrl($uri)
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443) ? 'https://':'http://';

        return $protocol.$_SERVER['SERVER_NAME'].$uri;
    }
}