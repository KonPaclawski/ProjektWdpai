<?php

require_once 'AppController.php';
require_once __DIR__.'/../../DatabaseConnector.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class DashboardController extends AppController {

    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function dashboard(): void {
        $this->render("dashboard", ['name' => "Adrian", "users" => $this->userRepository->getUsers()]);
    }

    public function usersEndpoint(): void
    {
        if($this->isDelete()) {
            $this->deleteUserEndpoint();
            return;
        }

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($this->userRepository->getUsers());
    }

    public function deleteUserEndpoint(): void
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $id = $decoded['id'];

            $this->userRepository->deleteUser($decoded['id']);

            http_response_code(200);
        }
    }

}