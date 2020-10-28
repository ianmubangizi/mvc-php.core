<?php

namespace Mubangizi\Controllers;

use Mubangizi\Application;

class Controller
{
    protected $app;
    protected $page;
    protected $router;

    public function __construct()
    {
        $this->app = Application::instance();
        $this->page = $this->app->page;
        $this->router = $this->app->router;
    }

    public function index($view, $request)
    {
        switch ($view) {
            case 'about-us';
                breadcrumbs($request, "About Us", array(crumb('Home', 'index')));
                $this->page->title("Learn About us");
                break;
            case 'contact-us';
                breadcrumbs($request, "Contact Us", array(crumb('Home', 'index')));
                $this->page->title("How to Contact us");
                break;
            case 'server-error':
                $this->page->title("Oops, Server Error");
                break;
            case 'page-not-found';
                $this->page->title("Page was not found");
                break;
            default:
                $this->page->title("");
                break;
        }
        if (isset($request['params']['alert'])) {
            switch ($request['params']['alert']) {
                case 'sign-in-success':
                    if (get_user()->role !== ANONYMOUS) {
                    }
                    break;
                case 'sign-out-success':
                    if (get_user()->role === ANONYMOUS) {
                    }
                    break;
                default:
                    break;
            }
        }
        render($this->page, $view, $request);
    }

    public function to($page, $query = '')
    {
        $this->router->to($page, $query);
    }
}
