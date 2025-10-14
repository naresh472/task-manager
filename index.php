<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/controllers/TaskController.php";

$userController = new UserController($con);
$taskController = new TaskController($con);

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'register':
        $userController->register();
        include "./views/register.php";
        break;

    case 'login':
        $userController->login();
        include "./views/login.php";
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'home':
         $taskController->index();
         break;

    case 'create':
        $taskController->create();
        break;

    case 'edit':
        $taskController->edit($_GET['id']);
        break;

    case 'delete':
         $taskController->delete($_GET['id']);
         exit;
    default: 
      $taskController->dashboard();
       break;
}
?>
