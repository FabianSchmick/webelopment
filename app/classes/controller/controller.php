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
     * The indexAction (like main method)
     *
     * @return mixed
     */
    abstract public function indexAction();


    /**
     * Controller constructor.
     * @param Config $config The app config
     * @param PDODatabase|String $db The db object|The not used string
     */
    public function __construct(Config $config, $db)
    {
        $this->config = $config;
        $this->db = $db;
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

        if (isset($layoutVars['header'])) {
            $header = new Template(__DIR__ . '/../../layout/' . $layoutVars['header']);
            $layoutVars['header'] = $header->output();
        }

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
}