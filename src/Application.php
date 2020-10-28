<?php

namespace Mubangizi;

use Mubangizi\Views\Page;

class Application
{

    public $user;
    public $name;
    public $page;
    public $alert;
    public $toast;
    public $router;

    public static $paths = array(
        'views' => __DIR__ . '\Views\\',
        'pages' => __DIR__ . '\Views\Pages\\',
        'layouts' => __DIR__ . '\Layouts\\',
        'includes' => __DIR__ . '\Layouts\includes\\',
        'partials' => __DIR__ . '\Layouts\includes\partials\\',
        'forms' => __DIR__ . '\Layouts\includes\partials\forms\\'
    );

    public $gateway;
    private static $instances = array();


    protected function __construct()
    {
        session_start();

        $this->name = isset($_ENV['SITE_NAME']) ? $_ENV['SITE_NAME'] : '';
        $this->user = get_user();
        $this->router = new Route();
        $this->page = new Page(view('index'));
    }

    protected function __clone()
    {
    }

    public static function instance(): Application
    {
        $cls = get_called_class();
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
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
        list('args' => $args, 'name' => $view, 'action' => $action) = $this->router->find($request['method'], $request['url']);

        if (is_string($action)) {
            list(0 => $class, 1 => $function) = explode('@', rtrim($action));

            if (method_exists($class, $function)) (new $class())->$function($view, $request);
        } elseif (!$args) {
            call_user_func($action, $view, $request);
        } else {
            $__args = explode(',', $args);
            call_user_func($action, ...$__args);
        }
    }
}
