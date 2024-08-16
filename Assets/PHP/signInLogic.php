<?php
require('../Config/config.php'); 

session_start();

$username = $_POST['username'];
$password = mysqli_real_escape_string($conn, $_POST['pwd']);

// To prevent SQL injection
$username = mysqli_real_escape_string($conn, $username);

// Initialize session variables
$_SESSION["loggedIn"] = false;
$_SESSION["isAdmin"] = false;
$_SESSION["show_login_alert"] = true;

// Debug: Check the username and hashed password
// echo "Username: $username<br>";
// echo "Input Password (hashed): $passwordHash<br>";
// echo "Length of Input Password (hashed): " . strlen($passwordHash) . "<br>";

// Query to get the user details
$sql = "SELECT UserID, Name, Email, Telephone, Username, PasswordHash, IsAdmin
        FROM user 
        WHERE Username = '$username'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // // Debug: Show the stored hash
    // echo "Stored PasswordHash: " . $row['PasswordHash'] . "<br>";
    // echo "Length of Stored PasswordHash: " . strlen($row['PasswordHash']) . "<br>";

    // Compare the hashed password
    if (password_verify($password, $row['PasswordHash'])) {
        // If the password is correct, set the session variables
        $_SESSION["loggedIn"] = true;
        $_SESSION["userID"] = $row['UserID'];
        $_SESSION["userName"] = $row['Name'];
        $_SESSION["isAdmin"] = $row['IsAdmin'] == 1 ? true : false;
        $_SESSION["show_login_alert"] = false;

        // Redirect to the appropriate dashboard based on role
        if ($_SESSION["isAdmin"]) {
            header("Location: ../Pages/admin-dashboard.php");
        } else {
            header("Location: ../Pages/employee-dashboard.php");
        }
        exit();
    } else {
        $_SESSION["show_login_alert"] = true;
        $alertMessage = "Password does not match.";
    }
} else {
    $_SESSION["show_login_alert"] = true;
    $alertMessage = "No user found with that username.";
}
?>

<body>
    <script>
        // Show alert if login failed
        <?php if ($_SESSION["show_login_alert"]): ?>
            alert("<?php echo $alertMessage; ?>");
        <?php endif; ?>
    </script>
</body>

