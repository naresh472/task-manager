<?php

require_once __DIR__."/config.php";


require_once __DIR__."/controllers/UserController.php";
$controller = new UserController($con);


$page = $_GET['page'] ?? 'login';

switch($page) {
    case 'register':
        $controller->register(); 
        include "./views/register.php"; 
        break;

    case 'login':
        $controller->login(); 
        include "./views/login.php"; 
        break;

    case 'home':
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
        include "./views/home.php";
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        exit;

    default:
        echo "<h2>Page not found</h2>";
        break;
}
?>
