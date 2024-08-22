<?php
session_start();
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if(empty($email)){
    echo ("Please enter your Email");
}else if(strlen($email) > 100){
    echo ("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email");
}else if(empty($password)){
    echo ("Please enter your Password");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Invalid Password");
}else{
    $rs = Database::search("SELECT * FROM `user` WHERE `Email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){
        $d = $rs->fetch_assoc();

        // Hash the entered password using the same SHA-256 method
        $hashedEnteredPassword = hash('sha256', $password);

        // Verify the hashed password
        if ($hashedEnteredPassword === $d['PasswordHash']) {
            echo ("success");
            $_SESSION["u"] = $d;

            if($rememberme == "true"){
                setcookie("email", $email, time()+(60*60*24*365));
            }else{
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }

            exit(); // Always use exit after header to prevent further script execution
        } else {
            echo ("Invalid Username or Password");
        }
    }else{
        echo ("Invalid Username or Password");
    } 
}
?>
