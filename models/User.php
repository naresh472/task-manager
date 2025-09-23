<?php

class User{

    private $con;

    public function __construct($con){
        $this->con = $con;
    }

    public function register($name,$email,$password)
    {
            $stmt = mysqli_prepare($this->con, "SELECT id FROM user WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $count = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);

            if ($count > 0) {
                
                return false;
            }

            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           
            $stmt = mysqli_prepare($this->con, "INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $passwordHash);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            return $result;
    }

    public function login($email,$password)
    {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);

        return ($user && password_verify($password, $user['password'])) ? $user : false;
    }
}


?>