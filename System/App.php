<?php

namespace System;

class App
{
    /**
    * Запуск приложения
    *
    * @author farZa
    * @throws \ErrorException
    */
    public static function run()
    {

        // Get the requested URI
        $path = $_SERVER['REQUEST_URI'];

        // Divide the URI by delimiter
        $pathParts = explode('/', $path);

        // Check if the requested page is index.php
        if(count($pathParts) == 5){
            $controller = 'views';
            $action = 'index';
        } else {
            // Designate controller's name
            $controller = $pathParts[4];
            // Check if the last part contains any GET parameters
            if (strstr($pathParts[5], "?")) {
                $length = strpos($pathParts[5], "?");
                // Get the name of the action
                $action = substr($pathParts[5], 0, $length);
            } else {
                // Get the name of the action
                $action = $pathParts[5];
            }
        }

        // Формируем пространство имен для контроллера
        $controller = 'Controllers\\' . ucfirst($controller) . 'Controller';
        // Формируем наименование действия
        $action = 'action' . ucfirst($action);

        // allow display errors
        ini_set("display_errors", 1);

        // Если класса не существует, выбрасывем исключение
        if (!class_exists($controller)) {
//            throw new \ErrorException('Controller does not exist');
            header('location: ../views/notfound');
        }

        // Create an object of the controller class
        $objController = new $controller;

        // If the controller doesn't have such action redirect to 404
        if (!method_exists($objController, $action)) {
//            throw new \ErrorException('Action does not exist');
            header('location: ../views/notfound');
        }

        // Вызываем действие контроллера
        $objController->$action();

    }
}
