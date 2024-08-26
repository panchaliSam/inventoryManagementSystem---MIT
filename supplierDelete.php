<?php
// Include the config file for database connection
require('Config/config.php');

// Check if the supplier ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $supplierID = $_GET['id'];

    // Prepare the SQL delete query
    $sql = "DELETE FROM Supplier WHERE SupplierID = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $supplierID);

        if ($stmt->execute()) {
            echo '<script>alert("Supplier deleted successfully."); window.location.href = "viewSupplier.php";</script>';
        } else {
            echo '<script>alert("Error deleting supplier."); window.history.back();</script>';
        }

        $stmt->close();
    } else {
        echo '<script>alert("Error preparing the delete query."); window.history.back();</script>';
    }
} else {
    echo '<script>alert("Supplier ID is missing."); window.history.back();</script>';
}

// Close the database connection
$conn->close();
?>
