<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Budget.php';

class BudgetRepository extends Repository {

    public function newBudget($userLogin, $title, $budget, $categories) {
        foreach($categories as $category) {
            $stmt = $this->database->connect()->prepare("
            INSERT INTO budgets (login, title, budget_amount) 
            VALUES (:login, :title, :budget_amount)
        ");
            $stmt->bindParam(':login', $userLogin, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':budget_amount', $budget, PDO::PARAM_STR);
            $stmt->execute();
        }
        $stmt = $this->database->connect()->prepare("
        SELECT id_bud FROM budgets 
        WHERE login = :login AND title = :title
        ORDER BY id_bud DESC LIMIT 1
");
        $stmt->bindParam(':login', $userLogin, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();

        $idData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($idData) {
            $id_bud = $idData['id_bud'];

            foreach ($categories as $category) {
                $categoryName = $category['name'];

                foreach ($category['payments'] as $payment) {
                    $stmtCategory = $this->database->connect()->prepare("
                    INSERT INTO category (title_payment, to_pay, pay_date, id_cat, category_name)
                    VALUES (:title_payment, :to_pay, :pay_date, :id_cat, :category_name)
                ");
                    $stmtCategory->bindParam(':title_payment', $payment['title'], PDO::PARAM_STR);
                    $stmtCategory->bindParam(':to_pay', $payment['amount'], PDO::PARAM_STR);
                    $stmtCategory->bindParam(':pay_date', $payment['date'], PDO::PARAM_STR);
                    $stmtCategory->bindParam(':id_cat', $id_bud, PDO::PARAM_INT);
                    $stmtCategory->bindParam(':category_name', $categoryName, PDO::PARAM_STR);
                    $stmtCategory->execute();
                }
                $id_bud = $id_bud-1;
            }
        }
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
        }
        return $categoriesForCategoryNames;
    }

    public function updateBudget($budget_current, $usun_kategorie)
    {
        $stmt = $this->database->connect()->prepare("
        SELECT c.id_cat 
        FROM budgets b 
        JOIN category c ON b.id_bud = c.id_cat
        WHERE b.title = :title AND c.category_name = :category_name
        LIMIT 1
    ");
        $stmt->bindParam(':title', $budget_current, PDO::PARAM_STR);
        $stmt->bindParam(':category_name', $usun_kategorie, PDO::PARAM_STR);
        $stmt->execute();

        $id = $stmt->fetchColumn();  // Fetch a single id_cat

        if (!$id) {
            return;  // No category found, exit function
        }

        $stmt = $this->database->connect()->prepare("
        DELETE FROM category WHERE id_cat = :id_cat
    ");
        $stmt->bindParam(':id_cat', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addBudget($user,$title,$budget_current,$category,$payment_title,$payment_amount,$payment_date)
    {
        $stmt = $this->database->connect()->prepare("
        SELECT category_name FROM category WHERE category_name = :category_name");
        $stmt->bindParam(':category_name', $category, PDO::PARAM_STR);
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($category, $categories)) {
            $stmt = $this->database->connect()->prepare("
        SELECT id_cat FROM category WHERE category_name = :category_name");
            $stmt->bindParam(':category_name', $category, PDO::PARAM_STR);
            $stmt->execute();
            $id = $stmt->fetch(PDO::FETCH_COLUMN);
            $stmt = $this->database->connect()->prepare("INSERT INTO category (title_payment, to_pay, pay_date, id_cat, category_name) 
                                                                Values (:title_payment, :to_pay, :pay_date, :id_cat, :category_name)");
            $stmt->bindParam(':title_payment', $payment_title, PDO::PARAM_STR);
            $stmt->bindParam(':to_pay', $payment_amount, PDO::PARAM_STR);
            $stmt->bindParam(':pay_date', $payment_date, PDO::PARAM_STR);
            $stmt->bindParam(':id_cat', $id, PDO::PARAM_INT);
            $stmt->bindParam(':category_name', $category, PDO::PARAM_STR);
            $stmt->execute();
        }
        else{
            $stmt = $this->database->connect()->prepare("SELECT budget_amount FROM budgets WHERE login = :login AND title = :title");
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            $budget = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $this->database->connect()->prepare("INSERT INTO budgets (login, title,budget_amount) Values (:login, :title, :budget)");
            $stmt->bindParam(':login', $user, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':budget', $budget, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = $this->database->connect()->prepare("SELECT id_bud FROM budgets ORDER BY id_bud DESC LIMIT 1;");
            $stmt->execute();
            $id = $stmt->fetch(PDO::FETCH_COLUMN);
            $stmt = $this->database->connect()->prepare("INSERT INTO category (title_payment, to_pay, pay_date,id_cat, category_name)
                                                                Values(:title_payment, :to_pay, :pay_date, :id_cat, :category_name)");
            $stmt->bindParam(':title_payment', $payment_title, PDO::PARAM_STR);
            $stmt->bindParam(':to_pay', $payment_amount, PDO::PARAM_STR);
            $stmt->bindParam(':pay_date', $payment_date, PDO::PARAM_STR);
            $stmt->bindParam(':id_cat', $id, PDO::PARAM_INT);
            $stmt->bindParam(':category_name', $category, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

}
