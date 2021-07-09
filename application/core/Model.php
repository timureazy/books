<?php
namespace Core;
use PDO;
    class Model
    {

            const USER = 'root';
            const PASS = '';
            const HOST = 'localhost';
            const DB = 'Books';

        public function connect_to_db()
        {
            $user = self::USER;
            $pass = self::PASS;
            $host = self::HOST;
            $db = self::DB;

            return $connection = new PDO("mysql:dbname=$db;host=$host",$user,$pass);

        }
    }