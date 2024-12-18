<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('logowanie'); 
    }
    public function projects(){
        die("projects method");
    }
}