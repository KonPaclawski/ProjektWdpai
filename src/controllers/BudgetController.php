<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/BudgetRepository.php';
require_once __DIR__.'/../models/Budget.php';
class BudgetController extends AppController
{

    private $budgetRepository;
    private $title;

    public function __construct()
    {
        $this->budgetRepository = new BudgetRepository();
    }

    public function addBudget()
    {
        if ($this->isGet()) {
            return $this->render("addBudget");
        }

        header('Content-Type: application/json');

        $input = file_get_contents("php://input");

        $data = json_decode($input, true);

        if ($data) {
            $categories = $data['categories'];
            $tytul = $data['tytul'];
            $budget = $data['budget'];

            foreach ($categories as $category) {
                $categoryName = $category['category_name'];

                foreach ($category['payments'] as $payment) {
                    $paymentTitle = $payment['title'];
                    $paymentAmount = $payment['amount'];
                    $paymentDate = $payment['date'];

                }
            }

            $userLogin = $_SESSION['user_login'];
            $this->budgetRepository->newBudget($userLogin, $tytul, $budget, $categories);

            exit;
        } else {
            exit;
        }
    }


    public function budget()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            header('Content-Type: application/json');
            http_response_code(200);

            $input = json_decode(file_get_contents('php://input'), true);

            if (!isset($input['title'])) {
                echo json_encode(["success" => false, "error" => "No title provided"]);
                exit;
            }

            $_SESSION['title'] = $input['title'];
            echo json_encode(["success" => true]);
            exit;
        }
        $title = $_SESSION['title'];
        $login =$_SESSION['user_login'];
        $categories = $this->budgetRepository->getCategories($title,$login);
        $amountValue = $this->budgetRepository->getBudgetData($login, $title);
        $amount = $amountValue[0]['budget_amount'];
        $budget_current = new Budget($title, $amount,$categories);
        return $this->render("budget",["budget_current" => $budget_current]);
    }

    public function budgetSettings(){
        $budget_current = $_SESSION['title'];
        if ($this->isGet()) {
            return $this->render("budgetSettings");
        }
        if ($_POST['action'] == 'usun') {
            $usun_kategorie = $_POST['usun'];
            $this->budgetRepository->updateBudget($budget_current, $usun_kategorie);
        }
        else if ($_POST['action'] == 'add') {
            $category = $_POST['category'];
            $payment_title = $_POST['payment_title'];
            $payment_amount = $_POST['payment_amount'];
            $payment_date = $_POST['payment_date'];
            $user = $_SESSION['user_login'];
            $title = $_SESSION['title'];
            $this->budgetRepository->addBudget($user,$title,$budget_current, $category, $payment_title, $payment_amount, $payment_date);
        }

        return $this->render("budgetSettings");

    }
}