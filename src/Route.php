<?php


namespace Mubangizi;

class Route
{
    public static $urls = array();
    private static $routes = array();

    public static function set($path_args, $name, $action = 'Controller@index', ...$methods)
    {
        if (sizeof($methods) === 0) {
            $methods[] = 'GET';
            $methods[] = 'POST';
        }

        $params = explode('|', $path_args);

        foreach ($methods as $method) {
            self::$urls[$method][$name] = $path_args;

            self::$routes[$method][$params[0]] = array(
                'name' => $name,
                'args' => isset($params[1]) ? $params[1] : false,
                'action' => is_string($action)
                    ? "Mubangizi\\Controllers\\$action"
                    : $action
            );
        }
    }

    public static function get($path_args, $name, $action = 'Controller@index')
    {
        self::set($path_args, $name, $action, 'GET');
    }

    public static function post($path_args, $name, $action = 'Controller@index')
    {
        self::set($path_args, "@$name", $action, 'POST');
    }


    public static function find($method, $path)
    {
        return isset(self::$routes[$method][$path])
            ? self::$routes[$method][$path]
            : self::$routes['GET']['/page-not-found'];
    }

    public static function get_url($url, $method = false)
    {
        if (!$method) $method = strpos($url, '@') === 0 ? 'POST' : 'GET';
        return isset(Route::$urls[$method][$url]) ? Route::$urls[$method][$url] : null;
    }

    public static function to($page, $query = '')
    {
        header('Location: ' . url_for($page) . $query);
    }
}
