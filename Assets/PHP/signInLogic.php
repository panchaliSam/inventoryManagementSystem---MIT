<?php
session_start();
require('../Config/config.php'); 

$email = $_POST['e'];
$password = $_POST['p'];
$rememberme = $_POST['r'];

// Validate the input
if (empty($email)) {
    echo ("Please enter your Email");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Invalid Password");
} else {
    // Escape the email to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Query to get the user details
    $sql = "SELECT UserID, Name, Email, Telephone, Username, PasswordHash, IsAdmin
            FROM user 
            WHERE Email = '$email'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Hash the entered password using the same SHA-256 method
        $hashedEnteredPassword = hash('sha256', $password);

        // Compare the hashed password
        if ($hashedEnteredPassword === $row['PasswordHash']) {
            // If the password is correct, set the session variables
            $_SESSION["loggedIn"] = true;
            $_SESSION["userID"] = $row['UserID'];
            $_SESSION["userName"] = $row['Name'];
            $_SESSION["isAdmin"] = $row['IsAdmin'] == 1 ? true : false;

            // Remember me functionality
            if ($rememberme == "true") {
                setcookie("email", $email, time() + (60 * 60 * 24 * 365));
            } else {
                setcookie("email", "", time() - 3600);
            }

            // Redirect to the appropriate dashboard based on role
            if ($_SESSION["isAdmin"]) {
                header("Location: ../Pages/admin-dashboard.php");
            } else {
                header("Location: ../Pages/employee-dashboard.php");
            }
            exit();
        } else {
            echo ("Invalid Username or Password");
        }
    } else {
        echo ("Invalid Username or Password");
    }
}
?>
