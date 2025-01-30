<?php

require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/BudgetController.php';

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

        if(in_array($action, ["login", ""])) {
            $controller = "SecurityController";
            $action = 'login';
        }
        if(in_array($action, ["register", ""])) {
            $controller = "SecurityController";
            $action = 'register';
        }
        if(in_array($action, ["addBudget", ""])) {
            $controller = "BudgetController";
            $action = 'addBudget';
        }
        $object = new $controller;
        $action = $action ?: 'index';

        $object->$action();
    }
}