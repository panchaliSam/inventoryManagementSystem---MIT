<?php
// signOutProcess.php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Optionally, clear cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to the login page or home page
header("Location: ../../");
exit;

?>