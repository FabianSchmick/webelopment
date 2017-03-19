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
            'force' => $this->routeConfig->arguments['force'],
            'you' => $this->routeConfig->arguments['you'],
        ]);
    }
}