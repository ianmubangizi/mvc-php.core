<?php

namespace Mubangizi;

use PDO;

abstract class Database
{
    protected static $user = 'root';
    protected static $pass = 'root';
    protected static $port = '3306';
    protected static $type = 'mysql';
    protected static $host = 'localhost';
    protected static $name = 'database';

    public static function make_connection()
    {
        $dsn = self::$type . ':host=' . self::$host . ';dbname=' . self::$name . ';charset=utf8';
        $pdo = new PDO($dsn, self::$user, self::$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
