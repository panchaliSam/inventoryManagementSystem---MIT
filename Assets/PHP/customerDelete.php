<?php
// Include the config file for database connection
require('../Config/config.php');

// Check if a customer ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $customerID = intval($_GET['id']);

    // Prepare the SQL statement to delete the customer
    $sql = "DELETE FROM Customer WHERE CustomerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerID);

    if ($stmt->execute()) {
        // Check if the customer was successfully deleted
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Customer deleted successfully.'); window.location.href='../Pages/customer.php';</script>";
        } else {
            echo "<script>alert('Customer not found or already deleted.'); window.location.href='../Pages/customer.php';</script>";
        }
    } else {
        echo "<script>alert('Error deleting customer.'); window.location.href='../Pages/customer.php';</script>";
    }

    // Close the statement
    $stmt->close();
    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('No customer ID specified.'); window.location.href='../Pages/customer.php';</script>";
}
?>
