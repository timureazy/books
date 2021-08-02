<?php

namespace Core;

class Request {

    public static function isPost ()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        } else {
            return false;
        }
    }

    public function isGet ()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            return true;
        } else {
            return false;
        }
    }

    public static function post ($name = null)
    {
        if($name === null) {
            return $_POST;
            }
            if(array_key_exists($name, $_POST)) {
                return $_POST["$name"];
            } else {
                return false;
                }
    }

    public static function get ($name = null)
    {
        if($name === null) {
            return $_GET;
        }
        if(array_key_exists($name, $_GET)) {
            return $_GET["$name"];
        } else {
            return false;
        }
    }

}