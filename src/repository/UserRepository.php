<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class UserRepository extends Repository {

    public function getUsers():array {
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.user');
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usersResponse = [];
        foreach($users as $user) {
            $usersResponse[] =  new User(
                $user['login'],
                $user['password'],
                $user['email'],
            );
        }

        return $usersResponse;
    }

    public function addUser(User $user): void
    {
        $stmt = $this->database->connect()->prepare
        ('INSERT INTO "user" (login, password, email, role) VALUES (?, ?, ?, ?)');


        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $user->getEmail(),
            "user"
        ]);
    }

    public function deleteUser($userLogin): void
    {
        $stmt = $this->database->connect()->prepare('DELETE FROM public.user WHERE login = :login;');
        $stmt->bindParam(':login', $userLogin, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getRole($login)
    {
        $stmt = $this->database->connect()->prepare('SELECT role FROM public.user WHERE login = :login;');
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}