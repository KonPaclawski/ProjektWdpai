<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class UserRepository extends Repository {

    public function getUsers():array {
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.user');
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // TODO return object, you can use FETCH_CLASS to avoid iterator with foreach
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
        ('INSERT INTO "user" (login, password, email) VALUES (?, ?, ?)');


        $stmt->execute([
            $user->getLogin(),
            $user->getPassword(),
            $user->getEmail(),
        ]);
    }

    public function deleteUser($id): void
    {
        $id = (int) $id; // Ensure $id is an integer
        $stmt = $this->database->connect()->prepare('DELETE FROM public.user WHERE id = :id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addBudget($userLogin, $title, $budget) {
        $stmt = $this->database->connect()->prepare("
        INSERT INTO budgets (login, title, budget_amount) VALUES (?, ?, ?)
    ");

        $stmt->execute([$userLogin, $title, $budget]);
    }

    public function getBudgetsbyUser($userLogin){
        $stmt = $this->database->connect()->prepare("SELECT * FROM budgets WHERE login = :userLogin");
        $stmt->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}