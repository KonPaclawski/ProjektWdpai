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
        error_log('Raw POST data: ' . $input);  // Log raw input

        $data = json_decode($input, true);
        error_log('Decoded JSON: ' . print_r($data, true));

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
}