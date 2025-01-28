<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function register(){
        // password_hash($password, PASSWORD_BCRYPT);
        if($this->isGet()) {
            return $this->render("register");
        }

        $login = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // TODO Weryfikacja czy taki użytkownik już istnieje


        $this->userRepository->addUser(new User($login, $password, $email));
        return $this->render("menu");
    }

    public function login() {

        if($this->isGet()) {
            return $this->render("login");
        }

        $login = $_POST['login'];
        $password = $_POST['password'];

        $users = $this->userRepository->getUsers();
        foreach($users as $user) {
            if($user->getLogin() == $login && $user->getPassword() == $password) {
                return $this->render("menu");
            }
        }
        return $this->render("login");
        // TODO logowanie usera
        // password_verify();

    }

}