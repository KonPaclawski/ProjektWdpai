<?php

require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/BudgetController.php';

class Routing {

    public static function run ($url) {
        $action = explode("/", $url)[0];
        $controller = null;

        $routes = ['menu'=>['DashboardController', 'dashboard'],'login'=> ['SecurityController', 'login'], 'register'=> ['SecurityController', 'register'],
            'addBudget'=> ['BudgetController', 'addBudget'], 'budget'=> ['BudgetController', 'budget'], 'budgetSettings'=> ['BudgetController', 'budgetSettings'],];

        if (!array_key_exists($action, $routes)) {
            die("");
        }

        list($controller, $action) = $routes[$action];

        if (class_exists($controller)) {
            $object = new $controller();
            $action = $action ?: 'index';
            if (method_exists($object, $action)) {
                $object->$action();
            } else {
                die("Action not found in controller");
            }
        } else {
            die("Controller not found");
        }
    }
}
