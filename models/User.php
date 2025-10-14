<?php

class User{

    private $con;

    public function __construct($con){
        $this->con = $con;
    }

    public function register($name,$email,$password,$ans)
    {
            $query = "select id from users WHERE email = '$email'";
            $result = mysqli_query($this->con, $query);

            if (mysqli_num_rows($result) > 0)
            {
                return false;
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "insert into users (name, email, password,security_ans) values ('$name', '$email', '$passwordHash','$ans')";
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

    public function resetPassword($email, $securityAns, $newPassword)
    {
        
        $query = "SELECT id FROM users WHERE email = '$email' AND security_ans = '$securityAns'";
        $result = mysqli_query($this->con, $query);

        if (mysqli_num_rows($result) === 1) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET password = '$passwordHash' WHERE email = '$email'";
            $updateResult = mysqli_query($this->con, $updateQuery);

            return $updateResult; 
        } else {
            return false; 
        }
    }
}


?>