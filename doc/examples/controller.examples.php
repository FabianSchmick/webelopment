<?php

/* ---------------------------------------------------------------- */
/*                		  Controller Example	                    */
/* ---------------------------------------------------------------- */
/* In src/controller/starWarsController.php */


namespace controller;

class StarWarsController extends Controller
{
    /**
     * Handles the star wars page
     *
     * @return bool
     */
    public function indexAction()
    {
        return $this->renderTpl('star_wars.tpl.php', [
            'force' => $this->config->route['arguments']['force'],
            'you' => $this->config->route['arguments']['you'],
        ]);
    }
}