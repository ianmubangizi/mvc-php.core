<?php

namespace Mubangizi\Views;

class Page
{

    public static $links;
    public static $data;
    public static $file;

    public static function render($name, $data = [])
    {

        if (file_exists("src/Views/$name.php")) {
            self::$file = "src/Views/$name.php";
        } else {
            self::$file = "src/Views/500.php";
        }

        self::$data = $data;
        require_once 'src/Layouts/main.php';
    }
}
