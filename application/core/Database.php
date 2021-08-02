<?php

namespace Core;
use PDO;
class Database {

    private static $connection = null;

    const USER = 'root';
    const PASS = '';
    const HOST = 'localhost';
    const DB = 'Books';

    public static function getConnect()
    {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        if (null === self::$connection) {
            self::$connection = new PDO("mysql:dbname=$db;host=$host",$user,$pass);
        }
        return self::$connection;
    }

    private function __clone() {}
    private function __construct() {}
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }


}