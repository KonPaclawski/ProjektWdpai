<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
session_start();

class SecurityController extends AppController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    public function register(){

        if($this->isGet()) {
            return $this->render("register");
        }

        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if(isset($login) && mb_strlen(trim($login)) !== 0)  {
            $users = $this->userRepository->getUsers();
            foreach ($users as $user) {
                if ($user->getLogin() === $login || $user->getEmail() === $email) {
                    return $this->render("register");
                }
            }
        }
        else{
            return $this->render("register");
        }
        $this->userRepository->addUser(new User($login, $password, $email));
        $_SESSION['user_login'] = $login;
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
            if($user->getLogin() === $login && password_verify($password, $user->getPassword())) {
                $_SESSION['user_login'] = $login;
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/menu");
            }
        }
        return $this->render("login");

    }

}