<?php

namespace Mubangizi\Controllers;

use Mubangizi\Views\Page;

class Controller
{
    protected $view;

    function __construct()
    {
        $this->view = new Page;
    }

    public function index($view, $request)
    {
        $this->view->render($view, $request);
    }
}
