<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class BudgetController extends AppController{

    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function addBudget(){
        if($this->isGet()) {
            return $this->render("addBudget");
        }

        $title = $_POST['tytul'];
        $budget = $_POST['budget'];
        $userLogin = $_SESSION['user_login'];

        $this->userRepository->addBudget($userLogin, $title, $budget);

        return $this->render("addBudget");
    }
}