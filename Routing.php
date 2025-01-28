<?php

require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/SecurityController.php';

class Routing {

    public static function run ($url) {
        $action = explode("/", $url)[0];
        $controller = null;

        // if (!array_key_exists($action, self::$routes)) {
        //   die("Wrong url!"); // TODO 404
        // }

        if(in_array($action, ["menu", ""])) {
            $controller = "DashboardController";
            $action = 'dashboard';
        }

        if(in_array($action, ["api", ""])) {

            $controller = "DashboardController";
            $action = 'usersEndpoint';
        }

        if(in_array($action, ["add-user", ""])) {
            $controller = "DashboardController";
            $action = 'addUser';
        }

        if(in_array($action, ["login", ""])) {
            $controller = "SecurityController";
            $action = 'login';
        }
        if(in_array($action, ["register", ""])) {
            $controller = "SecurityController";
            $action = 'register';
        }
        $object = new $controller;
        $action = $action ?: 'index';

        $object->$action();
    }
}