<?php


class User
{
    private $email;
    private $password;
    private $login;

    public function __construct($login, $password, $email)
    {
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
    }

    public function getEmail(): mixed
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): mixed
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLogin(): mixed
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }



}