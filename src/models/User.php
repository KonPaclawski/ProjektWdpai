<?php

namespace models;

class User
{
    private $email;
    private $password;
    private $login;

    public function __construct(string $email, string $password, string $login)
    {
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }



}