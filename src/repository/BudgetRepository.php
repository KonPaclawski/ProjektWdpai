<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Budget.php';

class BudgetRepository extends Repository {

    public function newBudget($userLogin, $title, $budget, $categories) {
        // Step 1: Insert the budget into the 'budgets' table
        foreach ($categories as $category) {
            $stmt = $this->database->connect()->prepare("
            INSERT INTO budgets (login, title, budget_amount) 
            VALUES (:login, :title, :budget_amount)
        ");
            $stmt->bindParam(':login', $userLogin, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':budget_amount', $budget, PDO::PARAM_STR);
            $stmt->execute();
        }

        foreach ($categories as $category) {
            $stmt = $this->database->connect()->prepare("
            SELECT id_bud FROM budgets WHERE login = :login AND title = :title
        ");
            $stmt->bindParam(':login', $userLogin, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();

            $idData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($idData) {
                $id_bud = $idData['id_bud'];

                foreach ($category['payments'] as $payment) {
                    $stmtCategory = $this->database->connect()->prepare("
                    INSERT INTO category (title_payment, to_pay, pay_date, id_cat, category_name)
                    VALUES (:title_payment, :to_pay, :pay_date, :id_cat, :category_name)
                ");
                    $stmtCategory->bindParam(':title_payment', $payment['title'], PDO::PARAM_STR);
                    $stmtCategory->bindParam(':to_pay', $payment['amount'], PDO::PARAM_STR);
                    $stmtCategory->bindParam(':pay_date', $payment['date'], PDO::PARAM_STR);
                    $stmtCategory->bindParam(':id_cat', $id_bud, PDO::PARAM_INT);
                    $stmtCategory->bindParam(':category_name', $category['name'], PDO::PARAM_STR);
                    $stmtCategory->execute();
                }
            }
        }

        return ['status' => 'success', 'message' => 'Budget and categories added successfully'];
    }


    public function getBudgetsbyUser($userLogin) {
        $stmt = $this->database->connect()->prepare("SELECT DISTINCT title FROM budgets WHERE login = :userLogin");
        $stmt->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBudgetData($userLogin, $title) {
        $stmt = $this->database->connect()->prepare("SELECT budget_amount FROM budgets WHERE login = :userLogin AND title = :title");
        $stmt->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories($title,$login)
    {
        $stmt = $this->database->connect()->prepare("SELECT id_bud FROM budgets WHERE title = :title AND login = :login");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        $allIdData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categoriesForCategoryNames = [];

        foreach ($allIdData as $id) {
            $stmt = $this->database->connect()->prepare("SELECT category_name, title_payment, to_pay, pay_date FROM category WHERE id_cat = :id_bud");
            $stmt->bindParam(':id_bud', $id['id_bud'], PDO::PARAM_INT);
            $stmt->execute();

            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $category) {
                $categoriesForCategoryNames[$category['category_name']][] = [
                    'title_payment' => $category['title_payment'],
                    'to_pay' => $category['to_pay'],
                    'pay_date' => $category['pay_date']
                ];
            }
            return $categoriesForCategoryNames;
        }
    }
}
