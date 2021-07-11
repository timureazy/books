<?php
namespace Core;
class Route
{
    static function start()
    {
        $controller_name = 'main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controller_name = $routes[1];
            if(!$controller_name = stristr($controller_name, '?', true)) {
                $controller_name = $routes[1];
            }
        }

        if (!empty($routes[2])) {
            $action_name = $routes[2];
            if(!$action_name = stristr($action_name, '?', true)) {
                $action_name = $routes[2];
            }
        }

        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;

        $model_file = $model_name . '.php';
        $model_path = "application/models/" . $model_file;

        if (file_exists($model_path)) {
            include "application/models/" . $model_file;
        }

        $controller_file = $controller_name . '.php';
        $controller_path = "application/controllers/" . $controller_file;


        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } /**else {
            Route::PageNotFound();
        }**/

        $controller = 'controllers\\' . $controller_name;
        $controller_obj = new $controller();
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller_obj->$action();
        }
       /**  else
          {
          Route::PageNotFound();
          }**/

    }


    function PageNotFound()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('http/1.1 404 Not Found');
        header('Location:' . $host . '404');
    }
}