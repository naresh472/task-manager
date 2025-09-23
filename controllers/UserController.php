<?php

require_once __DIR__."/../config.php";
require_once __DIR__."/../models/User.php";

class UserController{

    public $userModel;
    public $success = '';
    public $error = '';

    public function __construct($con)
    {
        $this->userModel = new User($con);
        session_start();
    }

  
    public function register(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm = $_POST["confirm_password"];

            if ($password !== $confirm) {
                $this->error = "Passwords do not match!";
                return;
            }

            if ($this->userModel->register($name, $email, $password)) {
                $this->success = "User registered successfully!";
            } else {
                $this->error = "Error while registering. Email might already exist!";
            }
        }
    }

    
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: index.php?page=home");
                exit;
            } else {
                $this->error = "Invalid email or password!";
            }
        }
    }
}
?>
