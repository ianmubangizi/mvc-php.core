<?php

namespace Mubangizi;

class Application
{

    private $router;

    function __construct()
    {
        $this->router = new Route;
    }

    public function run()
    {
        $request = array(
            "url" => isset($_REQUEST['path']) ? '/' . $_REQUEST['path'] : '/',
            "params" => array_diff_key($_REQUEST, ['path' => '']),
            "method" => $_SERVER['REQUEST_METHOD']
        );

        $this->handle($request);
    }

    private function handle($request)
    {
        list('name' => $view, 'action' => $action) = $this->router->find($request['url']);

        list(0 => $class, 1 => $method) = explode('@', rtrim($action));

        if (method_exists($class, $method)) (new $class)->$method($view, $request);
    }
}
