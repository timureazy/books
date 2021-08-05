<?php
namespace Core;
use Core\Database;
    class Model
    {

        public function connect_to_db()
        {
            return Database::getConnect();
        }
    }


    $ModelAuthor = new Model(); $ModelAuthor ->connect_to_db();