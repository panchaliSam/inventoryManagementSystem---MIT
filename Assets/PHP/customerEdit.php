<?php
// Include the config file for database connection
require('../Config/config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CustomerID = intval($_POST['customer_id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Check if the new email or telephone already exists in the database
    // Exclude the current customer from the check
    $checkSQL = "SELECT COUNT(*) FROM Customer WHERE (Email = ? OR Telephone = ?) AND CustomerID != ?";
    $checkStmt = $conn->prepare($checkSQL);
    $checkStmt->bind_param("ssi", $email, $telephone, $CustomerID);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo "<script>alert('Email or telephone number already exists.'); window.location.href='../Pages/customer.php';</script>";
    } else {
        // Update the customer in the database
        $sql = "UPDATE Customer SET Name = ?, Email = ?, Telephone = ? WHERE CustomerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $telephone, $CustomerID);

        if ($stmt->execute()) {
            echo "<script>alert('Customer updated successfully.'); window.location.href='../Pages/customer.php';</script>";
        } else {
            echo "<script>alert('Error updating customer: " . $stmt->error . "'); window.location.href='../Pages/customer.php';</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
