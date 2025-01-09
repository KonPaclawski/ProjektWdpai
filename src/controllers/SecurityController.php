<?php

use models\User;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
class SecurityController extends AppController
{
    public function login_()
    {
        $user = new User(email:'jsnow@gmail.com', password:'admin', login:'jas');

        $login = $_POST["login"];
        $password = $_POST["password"];

        if($user->getLogin() !== $login){
            return $this->render('login',['messages' => ['User with this login not exist!']]);
        }
        if($user->getPassword() !== $password){
            return $this->render('login',['messages' => ['User with this password not exist!']]);
        }
        return $this->render(template:'register');
    }
}