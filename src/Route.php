<?php


namespace Mubangizi;

class Route
{

    public static $urls = array();
    private static $routes = array();

    public static function add($path, $name, $function = 'Controller@index')
    {
        self::$urls[$name] = $path;
        self::$routes[$path] = array(
            'name' => $name,
            'action' => "Mubangizi\\Controllers\\$function"
        );
    }

    public static function find($path)
    {
        return isset(self::$routes[$path])
            ? self::$routes[$path]
            : self::$routes['/page-not-found'];
    }
}
