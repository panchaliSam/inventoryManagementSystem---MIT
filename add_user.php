<?php

require "Assets/Config/config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $isAdmin = mysqli_real_escape_string($conn, $_POST['isAdmin']);

    // Hash the password using SHA-256
    $passwordHash = password_hash($password , PASSWORD_BCRYPT);

    // Prepare 
    $stmt = $conn->prepare("INSERT INTO user (Name, Email, Telephone, Username, PasswordHash, IsAdmin) VALUES ('$name','$email','$telephone','$username','$passwordHash','$isAdmin')");

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the add_user_form.php with a success status
        header("Location: addNewUser.php?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
