<?php

require_once 'AppController.php';
require_once __DIR__.'/../../DatabaseConnector.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class DashboardController extends AppController {

    private $userRepository;
    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function dashboard() {
        if (!isset($_SESSION['user_login'])) {
            return $this->render("login");
        }

        $userLogin = $_SESSION['user_login'];
        $budgets = $this->userRepository->getBudgetsByUser($userLogin);

        return $this->render("menu", ["budgets" => $budgets]);
    }




}