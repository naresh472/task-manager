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
            $ans = $_POST["favorite_movie"];

            if ($password !== $confirm) {
                $this->error = "Passwords do not match!";
                return;
            }

            if ($this->userModel->register($name, $email, $password,$ans)) {
                $this->success = "User registered successfully!";
            } else {
                $this->error = "Email already exist!";
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


    public function logout(){
        session_destroy();
        include __DIR__ . '/../views/login.php';
    }

    public function resetPassword(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["new_password"];
            $confirm = $_POST["confirm_password"];
            $ans = $_POST["favorite_movie"];

            if ($password !== $confirm) {
                $this->error = "Passwords do not match!";
                return;
            }

            if ($this->userModel->resetPassword($email,$ans,$password)) {
                $this->success = "Password changed successfully!";
            } else {
                $this->error = "User not found or security answer incorrect";
            }
        }
    }
}
?>
