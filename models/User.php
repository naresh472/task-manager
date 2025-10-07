<?php

class User{

    private $con;

    public function __construct($con){
        $this->con = $con;
    }

    public function register($name,$email,$password)
    {
            $query = "select id from users WHERE email = '$email'";
            $result = mysqli_query($this->con, $query);

            if (mysqli_num_rows($result) > 0)
            {
                return false;
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "insert into users (name, email, password) values ('$name', '$email', '$passwordHash')";
            $result = mysqli_query($this->con, $query);

            return $result;
    }

    public function login($email,$password)
    {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($this->con, $query);
        $user = mysqli_fetch_assoc($res);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;

        
    }
}


?>