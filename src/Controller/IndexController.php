<?php

namespace Controller;

class IndexController extends Controller
{
    /**
     * Handles the index page
     *
     * @return bool
     */
    public function indexAction()
    {
        return $this->renderTpl('index.tpl.php', [
            'greeting' => 'Hello World',
        ]);
    }
}